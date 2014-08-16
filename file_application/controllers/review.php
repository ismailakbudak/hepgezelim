<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * Review Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Review extends CI_Controller {
    
    /**
     *  Global variable
    **/
    public $data , $user_id;

    /**
     * Constructor
    **/
    public function __construct(){
           parent::__construct();
		     
           $this->data           = $this->login->loginKontrol();                                  // check user_login
           $this->user_id        = $this->encrypt->decode( $this->session->userdata( 'userid') ); // set global variable user_id
           $this->data['active'] = '#reviews';                                                    // active profil menu    
           $this->load->model('messages');                                                        // load messages model  for database action                 
           $this->load->model('ratings_db');                                                      // load messages model  for database action                 
    } 
     
    

    /**
     *  Kullanıcının aldığı oyları gösterir
     *  
     * 
     *  @return HTML view
     *
    **/   
    public function index(){
                $this->lang->load('review');                // load messages language file for main
                $this->data['active_rating'] = '#receive';  // active review menu
                $receive             = $this->ratings_db->GetUserRatingsWithUser( $this->user_id );
                $groupedRatings      = $this->ratings_db->GetGroupedRatings( $this->user_id );
                $avg                 = $this->ratings_db->GetUserAverageRatings( $this->user_id );
                $givenRateUseridList = $this->ratings_db->GetUserListGivenRate( $this->user_id );
                $receive             = $this->checkFoto($receive);
                if( is_array($receive) && is_array($groupedRatings) && is_array($givenRateUseridList) ){   
                   $this->data['givenRateUseridList'] = $givenRateUseridList; 
                   $this->data['receive']             = $receive; 
                   $this->data['avg']                 = $avg; 
                   $this->data['groupedRatings']      = $groupedRatings; 
                   $this->loadView('review/receive' );   // load views 
                }else{
                    show_404('hata');
                }   
    }
    
    /**
     *  Kullanıcının verdiği oyları gösterir
     *  
     * 
     *  @return HTML view
     *
    **/   
    public function given(){
        $this->lang->load('review');                                       // load messages language file for main
        $this->data['active_rating'] = '#given';                           // active review menu    
        $given = $this->ratings_db->GetUserGivenRatingsWithUser( $this->user_id );
        if( is_array($given) ){
           $given = $this->checkFoto($given);
           $this->data['given'] = $given;
           $this->loadView('review/given' );                               // load views  
        }else{
          show_404('hata');
        }   
    }
            
    
    /**
     *  Oy verme işlemi sayfasını yükler
     *   
     * 
     *  @return HTML view
     *
     **/  
    public function leaveRating(){
        $this->lang->load('review');                            // load messages language file for main
        $this->data['active_rating'] = '#give-rate';            // active review menu    
        $this->loadView('review/leaveRating' );                 // load views  
    
    }

    /**
     *   Kullanıcıya oy verme sayfasında kullanıcı bilgileri gösterlir
     *     
     *  @param   $user_id oy verilecek kullanıcının id si
     *  @return HTML view
     *
    **/  
    public function giveRating($user_id){
            if( !isset($user_id) )                                                            // check user id is set
                show_404(); 
            
            $this->lang->load('review');                                                      // load messages language file for main
            $rate_userid  = base64_decode( urldecode($user_id) );
            $this->load->model('users');
            $user = $this->users->GetUserAllInfo($rate_userid);                               // get user information  
            if( $user && strcmp($rate_userid, $this->user_id ) != 0  ){       
                    $user['foto']                = photoCheckUser($user);                     // check user foto is exist
                    $total                       = $this->ratings_db->totalRating( $rate_userid  );
                    $avg                         = $this->ratings_db->GetUserAverageRatings( $rate_userid );
                    $this->data['total']         = $total;                             // send total value to view
                    $this->data['avg']           = $avg;                               // send avg value to view
                    $this->data['user']          = $user;                              // send user to view
                    $this->data['active_rating'] = '#give-rate';                       // active review menu    
                    $this->loadView('review/giveRating' );                             // load views  
            
            }
            else{
                show_404(); 
            } 
    }

   /***********************************************     Ajaxs Functions for using methods **********************************************/

    /**
     *  Kullanıcı fotoğraflarını kontrol eme işlemi
     *     
     *  @param  $array  fotoğrafları kontrol edilecek kullanıcı listesi
     *  @return $array  fotoğrafları kontrol edilmiş kullanıcılar
     *
     **/    
    private function checkFoto($array){
         if( is_array( $array)  ){
             foreach ($array as &$value) 
                  $value['foto']   =  photoCheckUser($value);
              return $array;
         } 
         else
              return array();
    }

    /**
      *  AJAX function
      *  Kullanıcıya oy verme işlemi 
      *  
      *  @return   JSON output status: success, fail, error
     **/    
    public function giveRateAction(){
            $this->lang->load('review');                                                                                  // load messages language file for main
            $this->form->check( lang('rc.userid'),    'who_give',    'required|xss_clean');                               // check post data
            $this->form->check( lang('rc.userid'),    'who_receive', 'required|xss_clean');                               // check post data
            $this->form->check( lang('rc.star'),      'star',        'required|greater_than[0]|less_than[6]|xss_clean');  // check post data
            $this->form->check( lang('rc.review'),    'review',      'required|min_length[5]|max_length[300]|xss_clean'); // check post data
            $this->form->check( lang('rc.is_driver'), 'is_driver',   'required|is_natural|less_than[2]|xss_clean');       // check post data
            $this->form->check( lang('rc.skill'),     'skill',       'required|xss_clean');                               // check post data
            if( $this->form->get_result() ){   
                  $is_driver   = $this->input->post('is_driver',TRUE);                                                    // post is_driver value
                  $skill       = $this->input->post('skill',TRUE);                                                        // post skill value
                  $who_give    = base64_decode( $this->input->post('who_give',TRUE) );
                  $who_receive = base64_decode( $this->input->post('who_receive',TRUE) );
	                if( $who_receive != 0 && $who_give != 0 ){
					              $result = $this->ratings_db->is_there( $who_give , $who_receive );
	                      if( !$result ){
	                            if(  strcmp( $is_driver, "0") == 0 )
	                                  $skill = "no-skill";
	                            $ratings = array( 'given_userid'      => $who_give,
	                                              'received_userid'   => $who_receive,
	                                              'rate'              => $this->input->post('star',TRUE),
	                                              'comment'           => $this->input->post('review',TRUE),
	                                              'is_driver'         => $is_driver,
	                                              'skill'             => $skill );
	                            $result = $this->ratings_db->add( $ratings );                    
	                            $status = $result ? "success" : "fail"; 
	                            $text   = $result ? lang("rc.send_success") : lang("rc.send_fail"); 
	                            $this->sendEmail( $who_give , $who_receive );
	                      }
	                      else{
	                            $status = "mistake"; 
	                            $text   = lang("rc.there_is");
	                      } 
	                } 
                  else{
	                      $status = "mistake"; 
	                      $text   = lang("rc.try-later");
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


   /***********************************************     Private Functions for using methods **********************************************/
    
     /**
       *   
       *  Kullanıcılara yorum aldıklarına dair email gönderen metot
       *  
       *  @param  $given_userid      oy veren kullanıcı   
       *  @param  $received_userid   oy alan kullanıcı
       *  @return  TRUE or FALSE
      **/      
     private function sendEmail( $given_userid , $received_userid ){
          
          $this->load->model('users');
          $this->load->model('offersdb');
          $this->load->model('notifications');
          $this->lang->load('review');                                                      // load messages language file for main
          $sender       =  $this->users->GetUser($given_userid);                            // get user information  
          $receiver     =  $this->users->GetUser($received_userid);                         // get user information  
          $notification =  $this->notifications->GetNotification( $received_userid );       // get user _notifiactions
          if( $sender && $receiver && $notification ){
                if( strcmp( $notification['receive_rate'], "1") == 0 ){
                      $this->load->model('send_email');
                      $send_email = array( 'receiver_user_id'  => $receiver['id'],
                                           'sender_user_id'    => $sender['id'] );
                      $result = $this->send_email->Add( $send_email );
                      return $result ? TRUE : FALSE;
                      /*
                      $this->load->helper('email');
                      $this->lang->load('email_controller');                                // email language
                      $this->load->library('email');                                        // load library for email
                      $recipient = $receiver['email'];                                      // receiver adress
                      $subject = lang('re.new_rate');                                       // subject from language file
                      $message = mailNewReview( $receiver, $sender, $this->lang->lang()); 
                      $this->email->set_newline("\r\n");                              
                      $this->email->from('hep@hepgezelim.com', lang('e.name') );            // sender name
                      $this->email->to($recipient);                                         // receiver
                      $this->email->subject($subject);                                      // subject
                      $this->email->message($message);                                      // message 
                      if($this->email->send())                                              // send email 
                         return true;
                      else
                         return false;   
                      */   
                }  
          }
          else
              return FALSE;
          
    }


    /**
     *  Sayfaları yükleme metodu
     *
     *  @param  $content
     *  @return HTML view
    **/ 
    private function loadView($content='review/reviews'){
          $this->login->loadViewHead( $this->data);            // load views
          $this->load->view('review/_reviewHead');             // load views
          $this->load->view($content);                         // load views
          $this->load->view('review/_reviewFoot');             // load views
          $this->login->loadViewHeadFoot();                    // load views 
    }



}// END of the Review Class

/**
 *
 * End of the file review.php
 *
 **/