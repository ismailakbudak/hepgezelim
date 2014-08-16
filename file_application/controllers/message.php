<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  
 * Message Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Message extends CI_Controller {
    
    /**
     * global variable
    **/
    public $data , $user_id;

    /**
     * Constructor
    **/
    public function __construct(){
           parent::__construct();
         
           $this->data           = $this->login->loginKontrol();                                  // check user_login
           $this->data['active'] = "#messages";
           $this->user_id        = $this->encrypt->decode( $this->session->userdata( 'userid') ); // set global variable user_id
           $this->load->model('messages');                                                        // load messages model  for database action                 
           $unreadSent  = $this->messages->unreadSent(  $this->user_id );
           $unreadInbox = $this->messages->unreadInbox(  $this->user_id );
           $this->data['unreadInbox'] = is_array($unreadInbox) ? $unreadInbox['number'] : 0 ;
           $this->data['unreadSent']  = is_array($unreadSent) ? $unreadSent['number'] : 0 ;        
    } 
     
    /**
     * Mesajlarım bölümü gelen mesajlar gösterilir
     * 
     * @return HTML view
    **/
    public function index(){
                $this->lang->load('message');                                                 // load messages language file for main
                $this->data['active_side'] = '#inbox';                                        // active message menu
                $inbox_messages      = $this->messages->getInbox( $this->user_id );           // get sent messages
                $this->data['inbox'] = $this->checkFoto( $inbox_messages );                   // send data to view
                $this->loadViewMessage();                                                     // load views
    }
    
    /**
     * Mesajlarım bölümü kullanıcının gönderdiği mesajlar gösterilir
     *  
     * @return HTML view
    **/
    public function send(){
                $this->lang->load('message');                                              // load messages language file for main
                $this->data['active_side'] = '#send';                                      // active message menu
                $sent_messages      = $this->messages->getSent( $this->user_id );          // get sent messages received_user_id
                $this->data['sent'] = $this->checkFoto( $sent_messages );                  // send data to view
                $this->loadViewMessage('message/sent');                                    // load views
    }

    /**
     * Arşivlenen mesajların gösterildiği bölüm
     *  
     * @return HTML view
    **/
    public function archieve(){
                $this->lang->load('message');                                                                // load messages language file for main
                $this->data['active_side']  = '#archieve';                                                   // active message menu
                $archived_messagesInbox     = $this->messages->getArchivedInbox( $this->user_id );           // get sent messages received_user_id
                $this->data['archiveInbox'] = $this->checkFoto( $archived_messagesInbox );    
                $archived_messagesSent      = $this->messages->getArchivedSend( $this->user_id );            // get sent messages received_user_id
                $this->data['archiveSent']  = $this->checkFoto( $archived_messagesSent );   
                $this->loadViewMessage('message/archieve');                                                  // load views
    }

    /**
     * Mesajlaşmaya engellenen kullanıcılar gösterilir 
     * 
     * @return HTML view
    **/
    public function block(){     
                $this->lang->load('message');                                               // load messages language file for main
                $this->data['active_side'] = '#blocked';                                    // active message menu
                $this->load->model('block_user');                                           // load block_user model
                $blocks = $this->block_user->GetBlockedUsers($this->user_id);               // get blocked user 
                $this->data['blocks'] =  $this->checkFoto( $blocks ); 
                $this->loadViewMessage('message/block');                                    // load views
    }

    /**
     *  Gelen kutusu için mesajlaşma bölümü
     *  
     * @param  offer_id  şifreli  mesajlaşılan teklif id
     * @param  sender_id  şifreli  mesajlaşılan kullanıcı id 
     * @return HTML view
    **/     
    public function inbox($offer_id, $sender_id){
         if( !isset($offer_id) || !isset($sender_id) )
                show_404();
         
         $this->load->model('users');
         $this->load->model('offersdb');
         $this->data['active_side'] = '#inbox';                                        // active message menu
         $message['offer_id']       =  $offer_id;
         $message['sender_id']      =  $sender_id; 
         $offer_id                  =  base64_decode( urldecode( $offer_id )  );
         $sender_id                 =  base64_decode( urldecode( $sender_id ) );
         $message['normal_offer_id'] =  $offer_id;
         $received_user_id          =  $this->user_id;                                 // session user_id
         $conversation              =  $this->messages->getConversationInbox( $offer_id, $sender_id, $received_user_id ); 
         $sender                    =  $this->users->GetUser($sender_id);                              // get user information  
         $receiver                  =  $this->users->GetUser($received_user_id);                       // get user information  
         $offer                     =  $this->offersdb->GetOffer($offer_id );                          // get offer
         $sideBar                   =  $this->sideBar( $sender_id ); 
         if( $conversation && $sender && $receiver && $offer && $sideBar ){   
               $this->lang->load('message');                                                          // load messages language file for main
           
               $message_update   =  array( 'readed_receive'   => 1  );                                 // add readed 1 to message      
               $where            =  array( 'user_id'          => $sender_id,                        
                                           'received_user_id' => $received_user_id,   
                                           'ride_offer_id'    => $offer_id    );
               $result           =  $this->messages->update( $where,  $message_update );               // update message to database  
               $this->data['side_user']     =  $sideBar;       
               $sender['foto']              =  photoCheckUser($sender);                                // check photo is exist
               $receiver['foto']            =  photoCheckUser($receiver);                              // check photo is exist 
               $this->data['conversation']  =  $conversation;                                          
               $this->data['sender']        =  $sender; 
               $this->data['receiver']      =  $receiver; 
               $this->data['offer']         =  $offer; 
               $this->data['message']       =  $message;                
               $this->loadViewMessage('message/contentInbox');                                    // load views 
         }
         else{
              show_404('hata');      
         }
    }
   
  
    /**
     *  AJAX function
     *  Gelen kutusundan kullanıcıya mesaj gönderme işlemi
     *  
     *  @return JSON output status: success, fail, eroor
     * 
     **/
    function sendMessageFromInbox(){
            $this->lang->load('message');                                                                       // load messages language file for main
            $this->form->check( lang('mc.userid'  ), 'sender_userid',  'required|xss_clean');                   // check post data
            $this->form->check( lang('mc.message' ), 'message',        'required|max_length[200]|xss_clean');   // check post data
            $this->form->check( lang('mc.offer_id'), 'offer_id',       'required|xss_clean');                   // check post data
            if( $this->form->get_result() ){   
                    $receiver_user_id = $this->user_id;                                                         // session user_id
                    $sender_userid    = $this->encrypt->decode( $this->input->post('sender_userid', TRUE)  );  // decode receiver user id
                    $offer_id         = $this->encrypt->decode( $this->input->post('offer_id', TRUE)  );       // decode receiver user id
                    $this->load->model("block_user");                                                
                    $result = $this->block_user->isthereblock(   $sender_userid, $receiver_user_id  );          // get is there a blocked user
                    if( $sender_userid != 0 && $receiver_user_id != 0 ){
                         if( count($result) == 0 && $this->idControl($sender_userid , $receiver_user_id, $offer_id ) ){                                                         
                                  $message = array(  'ride_offer_id'     => $offer_id                          ,  
                                                     'user_id'           => $sender_userid                     ,
                                                     'is_answer'         => 1                                  ,
                                                     'readed_receive'    => 1                                  ,
                                                     'received_user_id'  => $receiver_user_id                  ,
                                                     'message'           => $this->input->post('message', TRUE)  );
                                  $result = $this->messages->add( $message );                                // add message to database  
                                  $status = ( $result ) ? "success" : "fail";                                // change status   
                                  $text = ( $result ) ? lang("mc.send-success") : lang("mc.send-fail");      // set message  
                                  $this->sendEmail( $sender_userid , $receiver_user_id , $offer_id  );       // send email to receiver       
                         }
                         else{
                              $status = "mistake";       
                              $text = lang("mc.block"); 
                         }
                    }else{
                            $status = "fail";       
                            $text = lang("mc.try-later"); 
                    }                               
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }
    
    /**
     *  AJAX function  
     *  Kullanıcnın mesajını bildirme gelen kutusu için
     *   
     *  @return JSON output status: success, fail, error
     *
     **/
    public function alertUserReceiver(){
            $this->lang->load('message');                                                                    // load messages language file for main
            $this->form->check( lang('mc.message_id'), 'message_id',    'required|xss_clean');               // check post data
            $this->form->check( lang('mc.userid'),     'sender_userid', 'required|xss_clean');               // check post data
            if( $this->form->get_result() ){   
                    $received_user_id   =  $this->user_id;                                                      // session user_id
                    $message_id         =  $this->encrypt->decode( $this->input->post('message_id', TRUE));     // decode receiver user id
                    $sender_userid      =  $this->encrypt->decode( $this->input->post('sender_userid', TRUE));  // decode sender user id
                    $this->load->model("alert_user");
                    $alert_user         =  array( 'sender_user_id'    => $received_user_id,
                                                  'received_user_id'  => $sender_userid,   
                                                  'message_id'        => $message_id    );
                    $result = $this->alert_user->checkAlert( $alert_user );
                    if( is_array($result) ){
                        if( count($result) == 0 ){
                           $result             =  $this->alert_user->add( $alert_user);                                 // add alert_user to database  
                           $status             = ( $result ) ? "success" : "fail";                                      // change status   
                           $text               = ( $result ) ? lang("mc.alert-success") : lang("mc.alert-fail");        // set text                
                        }
                        else{
                            $status             = "fail";                        // change status   
                            $text               =  lang("mc.added_before");      // set text                
                        } 
                    }  
                    else{
                         $status             = "fail";                        // change status   
                         $text               =  lang("mc.alert-fail");        // set text                
                    }
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }


    /**
     *  
     *  Gönderilen mesajlar daki konuşmayı yükler
     *
     * @param  offer_id  şifreli  mesajlaşılan teklif id
     * @param  received_userid  şifreli  mesajlaşılan kullanıcı id 
     * @return HTML view
     *
     **/    
    public function sent($offer_id, $received_userid){
          if( !isset($offer_id) || !isset($received_userid) )
                show_404();
         
         $this->load->model('users');
         $this->load->model('offersdb');
         $this->data['active_side']  = '#send';                                        // active message menu
         $message['offer_id']        =  $offer_id;
         $message['received_userid'] =  $received_userid; 
         $offer_id                   =  base64_decode( urldecode( $offer_id )  );
         $received_userid            =  base64_decode( urldecode( $received_userid ) );
         $message['normal_offer_id'] =  $offer_id;
         $sender_id                 =  $this->user_id;                                 // session user_id
         $conversation              =  $this->messages->getConversationSent( $offer_id, $sender_id, $received_userid ); 
         $sender                    =  $this->users->GetUser($sender_id);                              // get user information  
         $receiver                  =  $this->users->GetUser($received_userid);                        // get user information  
         $offer                     =  $this->offersdb->GetOffer($offer_id );                          // get offer
         $sideBar                   =  $this->sideBar( $received_userid ); 
         if( $conversation && $sender && $receiver && $offer && $sideBar){
               $this->lang->load('message');                                                          // load messages language file for main
              
               $message_update              =  array( 'readed_sender'   => 1  );                                 // add readed 1 to message      
               $where                       =  array( 'user_id'          => $sender_id,                        
                                                      'received_user_id' => $received_userid,   
                                                      'ride_offer_id'    => $offer_id    );
               $result                      =  $this->messages->update( $where,  $message_update );               // update message to database  
               $this->data['side_user']     =  $sideBar;       
               $sender['foto']              =  photoCheckUser($sender);                                // check photo is exist
               $receiver['foto']            =  photoCheckUser($receiver);                              // check photo is exist 
               $this->data['conversation']  =  $conversation;                                          
               $this->data['sender']        =  $sender; 
               $this->data['receiver']      =  $receiver; 
               $this->data['offer']         =  $offer; 
               $this->data['message']       =  $message; 
               $this->loadViewMessage('message/contentSent');                                          // load views 
         }
         else
             show_404('hata');       
    }
     
    /**
     *   AJAX function 
     *   Gönderilen mesajlar kısmından kullanıcıya mesaj gönderme işlemi
     *
     *   @return JSON output status: success, fail, error
     *  
     **/
    function sendMessageFromSend(){
            $this->lang->load('message');                                                                         // load messages language file for main
            $this->form->check( lang('mc.userid'  ), 'received_userid',  'required|xss_clean');                   // check post data
            $this->form->check( lang('mc.message' ), 'message',          'required|max_length[200]|xss_clean');   // check post data
            $this->form->check( lang('mc.offer_id'), 'offer_id',         'required|xss_clean');                   // check post data
            if( $this->form->get_result() ){   
                    $sender_userid    = $this->user_id;                                                          // session user_id
                    $received_userid  = $this->encrypt->decode( $this->input->post('received_userid', TRUE)  );  // decode receiver user id
                    $offer_id         = $this->encrypt->decode( $this->input->post('offer_id', TRUE)  );         // decode receiver user id
                    if( $sender_userid != 0 && $received_userid != 0 ){
                          $this->load->model("block_user");                                                
                          $result = $this->block_user->isthereblock(  $received_userid, $sender_userid  );          // get is there a blocked user
                          if( count($result) == 0 && $this->idControl($sender_userid , $received_userid, $offer_id ) ){                                                         
                                   $message = array(  'ride_offer_id'     => $offer_id                          ,  
                                                      'user_id'           => $sender_userid                     ,
                                                      'received_user_id'  => $received_userid                  ,
                                                      'message'           => $this->input->post('message', TRUE)  );
                                   $result = $this->messages->add( $message );                                // add message to database  
                                   $status = ( $result ) ? "success" : "fail";                                // change status   
                                   $text = ( $result ) ? lang("mc.send-success") : lang("mc.send-fail");      // set message   
                                   $this->sendEmail( $sender_userid , $received_userid , $offer_id  );        // send email to receiver         
                          }
                          else{
                               $status = "mistake";       
                               $text = lang("mc.block"); 
                          }
                    }else{
                            $status = "fail";       
                            $text = lang("mc.try-later"); 
                    }                                
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }
    
    /**
     *   AJAX function
     *   Gönderilenler kutusu için kullanıcıyı bildirme işlemi   
     *   
     *   @return JSON output status: success, fail, error
     *
     **/
    public function alertUserSender(){ 
            $this->lang->load('message');                                                                      // load messages language file for main
            $this->form->check( lang('mc.message_id'), 'message_id',      'required|xss_clean');               // check post data
            $this->form->check( lang('mc.userid'),     'received_userid', 'required|xss_clean');               // check post data
            if( $this->form->get_result() ){   
                    $sender_userid      =  $this->user_id;                                                        // session user_id
                    $message_id         =  $this->encrypt->decode( $this->input->post('message_id', TRUE));       // decode receiver user id
                    $received_userid    =  $this->encrypt->decode( $this->input->post('received_userid', TRUE));  // decode sender user id
                    $this->load->model("alert_user");
                    $alert_user         =  array( 'sender_user_id'    => $sender_userid,
                                                  'received_user_id'  => $received_userid,   
                                                  'message_id'        => $message_id    );
                    $result = $this->alert_user->checkAlert( $alert_user );
                    if( is_array($result) ){
                        if( count($result) == 0 ){
                           $result             =  $this->alert_user->add( $alert_user);                                 // add alert_user to database  
                           $status             = ( $result ) ? "success" : "fail";                                      // change status   
                           $text               = ( $result ) ? lang("mc.alert-success") : lang("mc.alert-fail");        // set text                
                        }
                        else{
                            $status             = "fail";                          // change status   
                            $text               =  lang("mc.added_before");        // set text                
                        } 
                    }  
                    else{
                         $status             = "fail";                        // change status   
                         $text               =  lang("mc.alert-fail");        // set text                
                    }    
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }


    /**
     *    Arşiv kısmından gelen kutusu için konuşma sayfası 
     *
     *   @param  $offer_id  şifreli  mesajlaşılan teklif id
     *   @param  $sender_id  şifreli  mesajlaşılan kullanıcı id 
     *   @return HTML view
     *
     **/    
    public function inboxArchive($offer_id, $sender_id){
         if( !isset($offer_id) || !isset($sender_id) )
                show_404();
         
         $this->load->model('users');
         $this->load->model('offersdb');
         $this->data['active_side'] = '#archieve';                                      // active message menu
         $message['offer_id']       =  $offer_id;
         $message['sender_id']      =  $sender_id; 
         $offer_id                  =  base64_decode( urldecode( $offer_id )  );
         $sender_id                 =  base64_decode( urldecode( $sender_id ) );
         $message['normal_offer_id'] =  $offer_id;
         $received_user_id          =  $this->user_id;                                 // session user_id
         $conversation              =  $this->messages->getConversationInboxArchive( $offer_id, $sender_id, $received_user_id ); 
         $sender                    =  $this->users->GetUser($sender_id);                              // get user information  
         $receiver                  =  $this->users->GetUser($received_user_id);                       // get user information  
         $offer                     =  $this->offersdb->GetOffer($offer_id );                          // get offer
         $sideBar                   =  $this->sideBar( $sender_id ); 
         if( $conversation && $sender && $receiver && $offer && $sideBar ){   
               $this->lang->load('message');                                                           // load messages language file for main
           
               $sender['foto']              =  photoCheckUser($sender);                                // check photo is exist
               $receiver['foto']            =  photoCheckUser($receiver);                              // check photo is exist 
               $this->data['side_user']     =  $sideBar;       
               $this->data['conversation']  =  $conversation;                                          
               $this->data['sender']        =  $sender; 
               $this->data['receiver']      =  $receiver; 
               $this->data['offer']         =  $offer; 
               $this->data['message']       =  $message; 
               $this->loadViewMessage('message/contentInboxArchive');                                    // load views 
         }
         else
              show_404();    
 
    }


    /**
     *   Arşiv kısmında gönderilen mesajlar için konuşma sayfası  
     *
     *   @param  $offer_id  şifreli  mesajlaşılan teklif id
     *   @param  $received_userid  şifreli  mesajlaşılan kullanıcı id 
     *   @return HTML view  
     *
    **/    
    public function sentArchive($offer_id, $received_userid){
          if( !isset($offer_id) || !isset($received_userid) )
                show_404();
         
         $this->load->model('users');
         $this->load->model('offersdb');
         $this->data['active_side']  = '#archieve';                                                     // active message menu
         $message['offer_id']        =  $offer_id;
         $message['received_userid'] =  $received_userid; 
         $offer_id                   =  base64_decode( urldecode( $offer_id )  );
         $received_userid            =  base64_decode( urldecode( $received_userid ) );
         $message['normal_offer_id'] =  $offer_id;
         $sender_id                 =  $this->user_id;                                 // session user_id
         $conversation              =  $this->messages->getConversationSentArchive( $offer_id, $sender_id, $received_userid ); 
         $sender                    =  $this->users->GetUser($sender_id);                              // get user information  
         $receiver                  =  $this->users->GetUser($received_userid);                        // get user information  
         $offer                     =  $this->offersdb->GetOffer($offer_id );                          // get offer
         $sideBar                   =  $this->sideBar( $received_userid ); 
         if( $conversation && $sender && $receiver && $offer && $sideBar ){   
               $this->lang->load('message');                                                           // load messages language file for main
               
               $sender['foto']              =  photoCheckUser($sender);                                // check photo is exist
               $receiver['foto']            =  photoCheckUser($receiver);                              // check photo is exist 
               $this->data['conversation']  =  $conversation;                                          
               $this->data['side_user']     =  $sideBar;       
               $this->data['sender']        =  $sender; 
               $this->data['receiver']      =  $receiver; 
               $this->data['offer']         =  $offer; 
               $this->data['message']       =  $message; 
               $this->loadViewMessage('message/contentSentArchive');                                          // load views 
         }
         else
              show_404();      
    }


    /***************************************     Private Functions for using methods  *******************************************************/

    /**
     *   Kullanmıyoruz
     *   Mail gönderme işlemi 
     *
     *   @param  $sender_userid  
     *   @param  $receiver_user_id
     *   @param  $offer_id
     *   @return  TRUE or FALSE
     *  
    **/      
    private function sendEmail( $sender_userid , $receiver_user_id , $offer_id  ){
          /*
          $this->load->model('users');
          $this->load->model('offersdb');
          $this->load->model('notifications');
          $sender      =  $this->users->GetUser($sender_userid);                              // get user information  
          $receiver    =  $this->users->GetUser($receiver_user_id);                           // get user information  
          $offer       =  $this->offersdb->GetOffer($offer_id );                              // get offer
          $notification =  $this->notifications->GetNotification( $receiver_user_id );        // get user _notifiactions
          if( $sender && $receiver && $offer && $notification){
              if( strcmp( $notification['new_message'], "1") == 0 ){
                   $this->lang->load('message');                                                          // load messages language file for main
           
                   $this->load->helper('email');
                   $this->lang->load('email_controller');                                     // email language
                   $this->load->library('email');                                             // load library for email
                   $recipient = $receiver['email'];                                           // receiver adress
                   $subject = lang('me.private-message');                                     // subject from language file
                   $message = mailSendMessageUser( $receiver, $sender, $offer, $this->lang->lang()); 
                   $this->email->set_newline("\r\n");                              
                   $this->email->from('hep@hepgezelim.com', lang('e.name') );                 // sender name
                   $this->email->to($recipient);                                              // receiver
                   $this->email->subject($subject);                                           // subject
                   $this->email->message($message);                                           // message 
                   if($this->email->send())                                                   // send email 
                      return true;
                   else
                      return false; 
               }         
          }
          else
              return FALSE;
         */     
    }

    /**
     *   Konuşma kısımlarında mesajlaşılan kullanıcının yan profil bilgileri
     *     
     *   @param  $user_id
     *   @return $user kullanıcı bilgileri yada FALSE 
     *  
     **/
    private function sideBar($user_id){
               $this->load->model('users');
               $this->load->model('offersdb');
               $this->load->model('ratings_db');                                                       // load ratings_db model for database action  
               $user                   = $this->users->GetUserAllInfo( $user_id );                     // get user      
               $offers_count           = $this->offersdb->GetUserOfferCount( $user_id ); 
               $ratings                = $this->ratings_db->GetUserRatingsSide( $user_id  );
               if( is_array($user) && is_array($offers_count)  && is_array( $ratings ) ){ 
                      $user['total']          = $this->ratings_db->totalRating( $user_id  );           // send total value to view
                      $user['avg']            = $this->ratings_db->GetUserAverageRatings( $user_id );  // send avg value to view
                      $user['foto']           = photoCheckUser($user); 
                      $user['offer_count']    = $offers_count['offers_count']; 
                      foreach ($ratings as &$value)
                             $value['foto'] = photoCheckUser($value);
                             
                      $user['ratings']        = $ratings;
                      return $user;
               }
               else{
                     return FALSE;
               }

    }
     
      
   /**
     *  Kullanıcı fotoğraflarını inceleme metodu     
     *     
     *  @param   $array fotoğrafı kontrol edilecek kullanıcı listesi
     *  @return  $array kontrol edilmiş kullanıcı listesi
     *
    **/    
    private function checkFoto($array){
         if( is_array( $array ) ){
             foreach ($array as &$value) 
                  $value['foto']   =  photoCheckUser($value);
              return $array;
         } 
         else
              return array();
    }
    
   /**
    *   Id leri  kontrol eden metot eğer id den herhangi biri sıfır ise false döner
    *     
    *   @param   $sender_userid 
    *   @param   $receiver_user_id 
    *   @param   $offer_id 
    *   @return  hepsi sıfırdan farklı ise TRUE yada herhangi biri sıfır ise FALSE
    **/ 
    private function idControl($sender_userid , $receiver_user_id, $offer_id ){
        if( strcmp($sender_userid, "0") == 0 || strcmp($receiver_user_id, "0") == 0  || strcmp($offer_id, "0") == 0   )
             return FALSE;
         else
             return TRUE;
    }

   /**
     *  HTML sayfalarını yükler
     *
     *  @param  İçerik dosyasının ismi
     *  @return HTML view
     *
    **/  
    private function loadViewMessage($content='message/inbox'){
        
          $this->login->loadViewHead( $this->data);            // load views
          $this->load->view('message/messageHead');            // load views
          $this->load->view($content);                         // load views
          $this->load->view('message/messageFoot');            // load views
          $this->login->loadViewHeadFoot();                    // load views 
    }

   /**
     *   AJAX function
     *   Kullanıcı mesajlaşma engelini kaldır
     *    
     *   @return JSON output status: success, fail, error
     *
     **/
    public function removeBlock(){
          $this->lang->load('message');                                                           // load messages language file for main
          $this->form->check( lang('mc.block_id'),   'block_id', 'required|xss_clean');           // check post data
          if( $this->form->get_result() ){   
                    $block_id  =  $this->encrypt->decode( $this->input->post('block_id', TRUE));   // decode receiver user id
                    $this->load->model('block_user');                                              // load block_user model
                    $result    =  $this->block_user->delete( $block_id );                          // add message to database  
                    $status    =  $result ? "success" : "fail";                                    // change status   
                    $text      =  $result ? lang("mc.remove-success") : lang("mc.remove-fail");    // set message                
          }
          else 
              $status = "error";
          $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
          $result = array(  'status'  => $status,                             // JSON output     
                            'message' => $error['message'],
                            'text'    => ( isset($text) ) ? $text : ""  );    
          echo json_encode($result);                                          // JSON output 
    }   

    //=================== For Sent box action ===============================================//
    //====================================================================================//

   /**
     *   AJAX function  
     *   Gönderici için konuşmayı silme metotdu
     *   
     *   @return JSON output status: success, fail, error
     *
    **/
    public function deleteConversationSender(){
           $this->lang->load('message');                                                                     // load messages language file for main
           $this->form->check( lang('mc.offer_id'), 'offer_id',        'required|xss_clean');                // check post data
           $this->form->check( lang('mc.userid'),   'received_userid', 'required|xss_clean');                // check post data
           if( $this->form->get_result() ){   
                    $sender_user_id   =  $this->user_id;                                                      // session user_id
                    $offer_id         =  $this->encrypt->decode( $this->input->post('offer_id', TRUE));       // decode receiver user id
                    $received_userid =  $this->encrypt->decode( $this->input->post('received_userid', TRUE)); // decode sender user id
                    $message          =  array( 'send_visible'     => 0  );
                    $where            =  array( 'user_id'          => $sender_user_id,
                                                'received_user_id' => $received_userid,   
                                                'readed_sender'    => 1             , 
                                                'sender_archived'  => 0             ,  
                                                'ride_offer_id'    => $offer_id    );
                    $result           =  $this->messages->update( $where,  $message );                        // add message to database  
                    $status           = ( $result ) ? "success" : "fail";                                     // change status   
                    $text             = ( $result ) ? lang("mc.delete-success") : lang("mc.delete-fail");     // set message                
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }
  
    /**
      *   AJAX function 
      *   Gönderici arşivi için konuşmayı silen metot  
      *    
      *   @return JSON output status: success, fail, error
      *
      **/
    public function deleteConversationSenderArchive(){
           $this->lang->load('message');                                                                     // load messages language file for main
           $this->form->check( lang('mc.offer_id'), 'offer_id',        'required|xss_clean');                // check post data
           $this->form->check( lang('mc.userid'),   'received_userid', 'required|xss_clean');                // check post data
           if( $this->form->get_result() ){   
                    $sender_user_id   =  $this->user_id;                                                      // session user_id
                    $offer_id         =  $this->encrypt->decode( $this->input->post('offer_id', TRUE));       // decode receiver user id
                    $received_userid =  $this->encrypt->decode( $this->input->post('received_userid', TRUE)); // decode sender user id
                    $message          =  array( 'send_visible'     => 0  );
                    $where            =  array( 'user_id'          => $sender_user_id,
                                                'received_user_id' => $received_userid,   
                                                'sender_archived'  => 1             ,  
                                                'ride_offer_id'    => $offer_id    );
                    $result           =  $this->messages->update( $where,  $message );                        // add message to database  
                    $status           = ( $result ) ? "success" : "fail";                                     // change status   
                    $text             = ( $result ) ? lang("mc.delete-success") : lang("mc.delete-fail");     // set message                
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }


    /**
      *   AJAX function
      *   Gönderici için konuşmayı arşivle 
      *    
      *   @return JSON output status: success, fail, error 
      * 
      **/   
    public function archieveConversationSender(){
            $this->lang->load('message');                                                                    // load messages language file for main
            $this->form->check( lang('mc.offer_id'), 'offer_id',      'required|xss_clean');                 // check post data
            $this->form->check( lang('mc.userid'),   'received_userid', 'required|xss_clean');               // check post data
            if( $this->form->get_result() ){   
                    $sender_user_id     =  $this->user_id;                                                        // session user_id
                    $offer_id           =  $this->encrypt->decode( $this->input->post('offer_id', TRUE));         // decode receiver user id
                    $received_userid    =  $this->encrypt->decode( $this->input->post('received_userid', TRUE));  // decode sender user id
                    $message            =  array( 'sender_archived'  => 1  );
                    $where              =  array( 'user_id'          => $sender_user_id,   
                                                  'received_user_id' => $received_userid,
                                                  'readed_sender'    => 1              ,
                                                  'ride_offer_id'    => $offer_id    );
                    $result             =  $this->messages->update( $where,  $message );                         // add message to database  
                    $status             = ( $result ) ? "success" : "fail";                                      // change status   
                    $text               = ( $result ) ? lang("success") : lang("fail");                          // set message                
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }

    /**
      *  AJAX function 
      *  Gönderen için kullanıcıyı engelleme metodu     
      *   
      *  @return JSON output status: success, fail, error
      *
      **/
    public function blockUserSender(){
            $this->lang->load('message');                                                                         // load messages language file for main
            $this->form->check( lang('mc.explain'),  'explain',         'required|max_length[150]|xss_clean');    // check post data
            $this->form->check( lang('mc.userid'),   'received_userid', 'required|xss_clean');                    // check post data
            if( $this->form->get_result() ){   
                    $sender_user_id       =  $this->user_id;                                                        // session user_id
                    $explain              =  $this->input->post('explain', TRUE);                                   // user explain
                    $received_userid      =  $this->encrypt->decode( $this->input->post('received_userid', TRUE));  // decode sender user id
                    $this->load->model("block_user");
                    $block = array( 'user_id'           => $sender_user_id,
                                    'blocked_user_id'   => $received_userid,
                                    'explain'           => $explain  );
                    $array = $this->block_user->IsThereBlock( $block['user_id'] , $block['blocked_user_id'] );
                    if( count($array) == 0 ) {
                            $result             =  $this->block_user->add( $block );                                     // add message to database  
                            $status             = ( $result ) ? "success" : "fail";                                      // change status   
                            $text               = ( $result ) ? lang("mc.there-block") : lang("fail");                   // set message                
                    }
                    else{
                            $status =  "success";                                             // change status   
                            $text   =  lang("mc.there-block");                                // set message                
                    } 
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }
   
    //=================== For inbox action ===============================================//
    //====================================================================================//
  
    /**
      *   AJAX function
      *   Gelen mesajlar kutusu konuşma için mesajları arşivle   
      *    
      *   @return JSON output status: success, fail, error
      *
      **/   
    public function archieveConversationReceiver(){
            $this->lang->load('message');                                                                  // load messages language file for main
            $this->form->check( lang('mc.offer_id'), 'offer_id',      'required|xss_clean');               // check post data
            $this->form->check( lang('mc.userid'),   'sender_userid', 'required|xss_clean');               // check post data
            if( $this->form->get_result() ){   
                    $received_user_id   =  $this->user_id;                                                      // session user_id
                    $offer_id           =  $this->encrypt->decode( $this->input->post('offer_id', TRUE));       // decode receiver user id
                    $sender_userid      =  $this->encrypt->decode( $this->input->post('sender_userid', TRUE));  // decode sender user id
                    $message            =  array( 'receive_archived' => 1  );
                    $where              =  array( 'received_user_id' => $received_user_id,
                                                  'user_id'          => $sender_userid,   
                                                  'readed_receive'   => 1              ,
                                                  'ride_offer_id'    => $offer_id    );
                    $result             =  $this->messages->update( $where,  $message );                         // add message to database  
                    $status             = ( $result ) ? "success" : "fail";                                      // change status   
                    $text               = ( $result ) ? lang("success") : lang("fail");                          // set message                
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
     }

    /**
      *   AJAX function
      *   Gelen mesajlar kutusu konuşma için mesajları silme   
      *    
      *   @return JSON output status: success, fail, error
      *
      **/  
    public function deleteConversationReceiver(){
            $this->lang->load('message');                                                                  // load messages language file for main
            $this->form->check( lang('mc.offer_id'), 'offer_id',      'required|xss_clean');               // check post data
            $this->form->check( lang('mc.userid'),   'sender_userid', 'required|xss_clean');               // check post data
            if( $this->form->get_result() ){   
                    $received_user_id   =  $this->user_id;                                                      // session user_id
                    $offer_id           =  $this->encrypt->decode( $this->input->post('offer_id', TRUE));       // decode receiver user id
                    $sender_userid      =  $this->encrypt->decode( $this->input->post('sender_userid', TRUE));  // decode sender user id
                    $message            =  array( 'receive_visible'  => 0  );
                    $where              =  array( 'received_user_id' => $received_user_id,
                                                  'user_id'          => $sender_userid,
                                                  'readed_receive'   => 1             ,  
                                                  'receive_archived' => 0             ,   
                                                  'ride_offer_id'    => $offer_id    );
                    $result             =  $this->messages->update( $where,  $message );                         // add message to database  
                    $status             = ( $result ) ? "success" : "fail";                                      // change status   
                    $text               = ( $result ) ? lang("mc.delete-success") : lang("mc.delete-fail");      // set message                
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }

    /**
      *   AJAX function
      *   Gelen mesajlar arşivi konuşma için mesajları silme   
      *    
      *   @return JSON output status: success, fail, error
      *
      **/  
    public function deleteConversationReceiverArchive(){
            $this->lang->load('message');                                                                  // load messages language file for main
            $this->form->check( lang('mc.offer_id'), 'offer_id',      'required|xss_clean');               // check post data
            $this->form->check( lang('mc.userid'),   'sender_userid', 'required|xss_clean');               // check post data
            if( $this->form->get_result() ){   
                    $received_user_id   =  $this->user_id;                                                      // session user_id
                    $offer_id           =  $this->encrypt->decode( $this->input->post('offer_id', TRUE));       // decode receiver user id
                    $sender_userid      =  $this->encrypt->decode( $this->input->post('sender_userid', TRUE));  // decode sender user id
                    $message            =  array( 'receive_visible'  => 0  );
                    $where              =  array( 'received_user_id' => $received_user_id,
                                                  'user_id'          => $sender_userid,
                                                  'receive_archived' => 1             ,   
                                                  'ride_offer_id'    => $offer_id    );
                    $result             =  $this->messages->update( $where,  $message );                         // add message to database  
                    $status             = ( $result ) ? "success" : "fail";                                      // change status   
                    $text               = ( $result ) ? lang("mc.delete-success") : lang("mc.delete-fail");      // set message                
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }

    
    /**
      *   AJAX function
      *   Gelen mesajlar için kullanıcı engelleme
      *    
      *   @return JSON output status: success, fail, error
      *
      **/  
    public function blockUserReceiver(){
            $this->lang->load('message');                                                                       // load messages language file for main
            $this->form->check( lang('mc.explain'),  'explain',       'required|max_length[150]|xss_clean');    // check post data
            $this->form->check( lang('mc.userid'),   'sender_userid', 'required|xss_clean');                    // check post data
            if( $this->form->get_result() ){   
                    $received_user_id   =  $this->user_id;                                                      // session user_id
                    $explain            =  $this->input->post('explain', TRUE);                                 // user explain
                    $sender_userid      =  $this->encrypt->decode( $this->input->post('sender_userid', TRUE));  // decode sender user id
                    $this->load->model("block_user");
                    $block = array( 'user_id'           => $received_user_id,
                                    'blocked_user_id'   => $sender_userid,
                                    'explain'           => $explain  );
                    $array = $this->block_user->IsThereBlock( $block['user_id'] , $block['blocked_user_id'] );
                    if( count($array) == 0 ) {
                            $result             =  $this->block_user->add( $block );                                     // add message to database  
                            $status             = ( $result ) ? "success" : "fail";                                      // change status   
                            $text               = ( $result ) ? lang("mc.there-block") : lang("fail");                   // set message                
                    }
                    else{
                            $status =  "success";                                             // change status   
                            $text   =  lang("mc.there-block");                                // set message                
                    } 
            } 
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 
    }

   
} // END of the Msssage Class
/** 
 * End of the file offer
**/