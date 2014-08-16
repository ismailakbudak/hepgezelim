<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *   
 * Contact Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Contact extends CI_Controller {
    
     /**
      * Constructor
     **/
     public function __construct(){
            parent::__construct();
            $this->load->model('contacts');                 // load contact model for database action 
     }

    /**
     *  İletişim sayfası yüklenir
     *  
     *  @return HTML view   
    **/
    public function index(){
              $this->lang->load('contact');                                                         // load contact page language
              $data = array('email'=> "");
              if( $this->session->userdata('logged_in') ){
                      $this->load->model('users');
                      $userid =  $this->encrypt->decode( $this->session->userdata('userid') );      // decode userid 
                      $user = $this->users->GetUserAllInfo( $userid );    
                      if( is_array( $user ) && count( $user ) > 0 ) 
                              $data['email'] =  $user['email'];
              } 
              $this->login->general( $data );               // call general load view
              $this->load->view('contact/contact');
              $this->load->view('include/footer');          // load views
    }
   
    /**
     * İletişim başarıyla eklendi sayfası
     *  
     * @return HTML view   
    **/
    public function success(){
              $this->lang->load('contact');                  // load contact page language
              $this->login->general();                       // call general load view
              $this->load->view('contact/contactSuccess');   // load views
              $this->load->view('include/footer');           // load views
    }
    
    
    /**
     * Kullanıcı şikayet sayfası
     * 
     * @param $userid  şifreli şikayet edilecek user_id 
     * @return HTML view
    **/
    public function complain( $userid ){
              if( ! isset( $userid ) )   // Check isset userid
                   show_404();
             
              // Get user information
              $this->load->model('users');
              $user = $this->users->GetUserAllInfo( base64_decode( urldecode( $userid ) ) );    
              if( is_array( $user ) && count( $user ) > 0 ) {
              
                    $this->lang->load('contact');  // load contact page language
                    $data = array('email'=> "");
                    if( $this->session->userdata('logged_in') ){
                            $this->load->model('users');
                            $userid =  $this->encrypt->decode( $this->session->userdata('userid') );      // decode userid 
                            $user2  =  $this->users->GetUserAllInfo( $userid );    
                             if( is_array( $user2 ) && count( $user2 ) > 0 ) 
                                    $data['email'] =  $user2['email'];
                    } 
                    $user['foto'] =  photoCheckUser($user);
                    $data['user'] =  $user;
                    $this->login->general( $data );               // call general load view
                    $this->load->view('contact/complain');        // load views
                    $this->load->view('include/footer');          // load views
              }else{
                 show_404('hata');
              }
    }
    
    /**
     * Şikayet başarıyla eklendi sayfası
     *  
     * @return HTML view   
    **/
    public function success2(){
              $this->lang->load('contact');                 // load contact page language
              $this->login->general();                      // call general load view
              $this->load->view('contact/contactSuccess2'); // load views
              $this->load->view('include/footer');          // load views
    }
    

    /**
     *  AJAX Method
     *  İletişim sayfası mesajını kaydetme işlemi 
     *  
     *  @return JSON output status: success, fail, error 
    **/
    public function saveMessage( ){
             
             $this->lang->load('contact');                                                                             // load contact page language
             $this->form->check(lang('cc.user') ,    'user',    'required|alpha|xss_clean');                           // check post data
             $this->form->check(lang('cc.issue') ,   'issue',   'required|alpha|xss_clean');                           // check post data
             $this->form->check(lang('cc.subject') , 'subject', 'required|max_length[50]|xss_clean');                  // check post data
             $this->form->check(lang('cc.message') , 'message', 'required|min_length[10]|max_length[350]|xss_clean');  // check post data
             $this->form->check(lang('cc.mail') ,    'mail',    'required|valid_email|max_length[70]|xss_clean');      // check post data
             if( $this->form->get_result() ){                                        
                      
                      // Check does user log in
                      if( $this->session->userdata('logged_in') )
                            $userid =  $this->encrypt->decode( $this->session->userdata('userid') );      // decode userid 
                      else
                            $userid = 0;
                      
                      // prepare contact model for database
                      $contact = array( 'user_id'   => $userid,
                                        'user_type' => $this->input->post('user',     TRUE),
                                        'issue'     => $this->input->post('issue',     TRUE),
                                        'subject'   => $this->input->post('subject',     TRUE),
                                        'message'   => $this->input->post('message',     TRUE),
                                        'email'     => $this->input->post('mail',     TRUE)  );
                      
                      // Save model to contact database
                      $result = $this->contacts->Add($contact);
                      $status = ($result == TRUE) ? "success" : "fail";
                      $text = ($result == TRUE) ? lang('cc.successAdd') : lang("cc.failAdd"); 
             }       
             else
                 $status = "error";

             $error = $this->form->get_error();  
             $result = array( 'status'  => $status, 
                              'text'    => isset($text) ? $text :"",
                              'message' => $error['message'] );          // JSON output
             echo json_encode($result);                                  // JSON output
    }

    /**
     * AJAX Method
     * Kullanıcı şikayet sayfası şikayet kayıt etme metodu
     *
     * @return JSON output status: success, fail, error
    **/
    public function saveComplain( ){

             $this->lang->load('contact');                                                                                 // load contact page language
             $this->form->check(lang('cc.id') ,       'user_id',    'required|xss_clean');                                 // check post data
             $this->form->check(lang('cc.complain') , 'complain',   'required|min_length[10]|max_length[350]|xss_clean');  // check post data
             $this->form->check(lang('cc.mail') ,     'mail',       'required|valid_email|max_length[70]|xss_clean');      // check post data
             if( $this->form->get_result() ){                                        
                      
                      // Check does user log in
                      if( $this->session->userdata('logged_in') )
                            $userid =  $this->encrypt->decode( $this->session->userdata('userid') );      // decode userid 
                      else
                            $userid = 0;
                      
                      $complain_user_id = base64_decode(urldecode(  $this->input->post('user_id',     TRUE)  ));
                      
                      if( $userid  != $complain_user_id  ){ 
                             // prepare complain model for database
                             $complain = array( 'user_id'          => $userid,
                                               'complain_user_id' => $complain_user_id,
                                               'complain'         => $this->input->post('complain',     TRUE),
                                               'email'            => $this->input->post('mail',     TRUE)  );
                             
                             // Save model to contact database
                             $this->load->model("complain");
                             $result = $this->complain->Add($complain);
                             $status = ($result == TRUE) ? "success" : "fail";
                             $text = ($result == TRUE) ? lang('cc.successAddcomplain') : lang("cc.failAddcomplain"); 
                     }
                     else{
                          $status = "fail";
                          $text   = lang("cc.complainSameUser"); 
                     }

             }       
             else
                 $status = "error";

             $error = $this->form->get_error();  
             $result = array( 'status'  => $status, 
                              'text'    => isset($text) ? $text :"",
                              'message' => $error['message'] );          // JSON output
             echo json_encode($result);                                  // JSON output
    }

}// END of the Contact class
/* 
 *  End of the file Contact
 */   