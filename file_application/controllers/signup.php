<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Signup Controller
 * There is some method for sending email
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class SignUp extends CI_Controller {
    
    /**
     *  Constructor
    **/
    public function __construct(){
          parent::__construct();
		      $this->load->helper('email');             // helper function about the email  
     }
   
    /**
     *  Kullanıcı üyelik sayfası
     *
     *  @return HTML view  
    **/
    public function index(){
        $data =  $this->login->generalTemplate();
        $this->lang->load('email_controller');                   // email language
        if(  isset($_REQUEST['result']) ){                       // give message to user about the completing offer
              $val = $_REQUEST['result'];                        // from url is set result       
              if( $val == "1" ){                   
                 $type= "info";                                  // alert type
                 $title = lang('e.tebrik');                      // alert title
                 $content = lang('e.content');                   // alert content
                 $data['val'] =  alert($type, $title, $content); // send alert data to view
              }
         }
         $this->load->helper('captcha');                        // load captcha helper file
                                                                // captcha config  
         $vals = array(  'img_path'   => 'captcha/',
                         'img_url'  => base_url(). 'captcha/',
                         'font_path'  => 'fonts/textb.ttf',
                         'img_width'  => '110',
                         'img_height' => '30',
                         'expiration' => 7200 );
         $cap = create_captcha($vals);                         // create captcha
         $this->session->set_userdata($cap);                   // set user session data     
         $data['captcha'] = $cap['image'];                     // send image path to view
         $this->load->view('include/headerTemplate',$data);    // load view
         $this->load->view('signup/newuser');                  // load view 
         $this->load->view('include/footer');                  // load view 
    }
    
 
    /**
     *  Şifremi unuttum sayfası 
     *   
     *  @return HTML view  
    **/
    public function forgotPassword(){
        $this->lang->load('email_controller');                         // email language
        $data =  $this->login->generalTemplate();
        $this->load->view('include/headerTemplate',$data );            // load view
        $this->load->view('signup/password');                          // load view
        $this->load->view('include/footer');                           // load view 
    }

    
    /**
     *  Email kontrol metodu
     *  
     *  @return JSON output status : success, fail, error 
    **/
    public function checkEmailUsing(){
            $this->lang->load('email_controller');                                                   // email language
            $this->form->check('e-mail' ,'email', 'required|valid_email|max_length[50]|xss_clean');  // control post parameter
            if( $this->form->get_result() ){                                                         // everything is ok
                  $post_email =    $this->input->post('email',TRUE);    // post email adress
                  if( $this->checkEmail($post_email) )                  // check from private function 
                        $status = 'emailusing';                 
                  else
                        $status =  "not";
            }
            else
                $status = "fail";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'message' => $error['message'] );            
            echo json_encode($result);                                // JSON output 
    } 
    
    /**
     *  Kullanıcı kayıt işlemi
     *  
     *  @return JSON output status : success, fail, error 
    **/
    public function createUser(){
            $this->lang->load('email_controller');                    // email language
            $year = getdate();
            $year = $year['year'] - 17;     
            $this->form->check( lang("pc.sex")       ,'sex',       'required|is_natural_no_zero|xss_clean');                               // control post parameter
            $this->form->check( lang("pc.name")      ,'name',      'required|alpha|max_length[50]|xss_clean');                                    // control post parameter
            $this->form->check( lang("pc.surname")   ,'surname',   'required|alpha|max_length[50]|xss_clean');                                    // control post parameter
            $this->form->check( lang("pc.email")     ,'email',     'required|valid_email|max_length[50]|xss_clean');               // control post parameter
            $this->form->check( lang("pc.password")  ,'password',  'required|min_length[6]|max_length[20]|alpha_numeric|xss_clean');                            // control post parameter
            $this->form->check( lang("pc.birthyear") ,'birthyear', 'required|less_than['.$year.']|greater_than[1930]|xss_clean');  // control post parameter
            $this->form->check( lang("pc.captcha")   ,'captcha',   'required|is_natural|xss_clean');                               // control post parameter
            if( $this->form->get_result() ){                                              // everything is ok
                            $post_captcha =  $this->input->post('captcha',TRUE);          // post captcha code
                            $post_email   =  $this->input->post('email',TRUE) ;           // post email address     
                            $post_sex     =  $this->input->post('sex',TRUE) ;             // post user sex 
                            $post_pass    =  $this->input->post('password',TRUE);         // post password 
                            $post_foto =     base_url() . 'assets/' ;                     // get path 
                            $post_foto .=   ($post_sex == 1) ? 'male.png' : 'female.png'; // user default image
                            $post_email_kod =  rand(1,99999);                             // create random code
                            $cap = $this->session->userdata("word");                      // get captcha code from session 
                            $this->load->model('users');                                  // load users model 
                            if( $this->checkEmail($post_email) )                          //  check email is using
                                 $status = 'emailusing';
                            else if(strcmp($post_captcha, $cap) != 0)                     // check captcha code
                                 $status =  "mistake";
                            else{
                                     $user = array(   'password'  =>  md5( $this->input->post('password',TRUE) ),                     // create new user model
                                                      'email'     => $this->input->post('email',TRUE)           ,
                                                      'name'      => $this->input->post('name',TRUE)            ,
                                                      'surname'   => $this->input->post('surname',TRUE)         ,
                                                      'sex'       => $this->input->post('sex',TRUE)             ,
                                                      'birthyear' => $this->input->post('birthyear',TRUE)       ,
                                                      'foto'      => $post_foto,
                                                      'email_kod' => $post_email_kod  );
                                    $result1 = $this->users->Add( $user );                                                              // save user
                                    if( $result1 == TRUE){                                                                              // user has been saved successfully                                        
                                        $result = $this->users->Login($email = $post_email , $password = $post_pass);                   // access user data from database
                                        if($result){ 
                                              $userdata = array(                                                                        // create session data for login
                                                                   'userid'       =>  $this->encrypt->encode( $result['id']          ),
                                                                   'name'         =>  $this->encrypt->encode( $result['name']        ),   
                                                                   'surname'      =>  $this->encrypt->encode( $result['surname']     ),
                                                                   'sex'          =>  $this->encrypt->encode( $result['sex']         ),
                                                                   'foto'         =>  $this->encrypt->encode( $result['foto']        ),
                                                                   'logged_in'    =>  TRUE  );
                                             $this->session->set_userdata($userdata);                                                    // set session data    
                                          }
                                          $name = $this->encrypt->decode( $this->session->userdata( 'name' ) );                          // decode user name
                                          $this->sendMail($name, $post_email, $post_email_kod, $again = FALSE );                         // send email to new user 
                                    }
                                    if($result1 == TRUE)
                                         $status = "success";
                                    else
                                        $status =  'fail';
                            }     
              } 
              else
                  $status = "error";
              $error = $this->form->get_error();                        //  if there is error get it from Form validation class
              $result = array(  'status'  => $status,                   // JSON output     
                                'message' => $error['message'] );            
              echo json_encode($result);                                // JSON output 
    }
     
    /**
     *  Captcha oluşturma metodu 
     *  
     *  @return image
    **/
     public function createCaptcha(){

                   $this->load->helper('captcha');                     // load captcha helper file
                   $vals = array( 'img_path'   => 'captcha/',          // set captcha config
                                  'img_url'  => base_url(). 'captcha/',
                                  'font_path'  => 'fonts/textb.ttf',
                                  'img_width'  => '110',
                                  'img_height' => '30',
                                  'expiration' => 7200   );
                    $cap = create_captcha($vals);                      // create captcha
                    $this->session->set_userdata($cap);                // set session captcha data
                    echo $cap['image'];                                // write image  
     }
     
     /**
      *  Email gönderme işlemi
      *  
      *  @return JSON output status : success, fail, error 
     **/
     public function resendEmail(){
            $this->lang->load('email_controller');                                             // email language
            $user_id = $this->encrypt->decode( $this->session->userdata( 'userid' ) );         // decode userid
            $this->load->model('users');                                                       // load users mode lfor database action   
            $user = $this->users->GetUser($user_id);                                           // get user information  
            if( is_array( $user ) && count($user) > 0 ) {      
                   $post_email =  $user['email'] ;                                                   // decode user email data
                   $name = $this->encrypt->decode( $this->session->userdata( 'name' ) );             // decode user name
                   $post_email_kod =  rand(1,99999);                                                 // creating random code  
                   $result = $this->sendMail(  $name, $post_email, $post_email_kod, $again = TRUE ); // send again activation code 
                   if($result){
                           $user = array(  'email_kod'      =>  $post_email_kod,                     // update user info for activation code  
                                           'email_check'    =>  "0"  ); 
                           $this->load->model('users');                                              // load users model    
                           $result = $this->users->update($user_id,$user);                           // update user information 
                           if($result == TRUE)                  
                               $status = 'success';
                           else
                               $status =  'fail';
                   }
                   else
                      $status = "fail";
            }
            else{
                   $status = "fail";
            }        
            $result = array( 'status' => $status );                                            // JSON output
            echo json_encode($result);                                                         // JSON output
     }
   
    /**
     *  Şifremi unuttum işlemi
     *  
     *  @return JSON output status : success, fail, error 
    **/
    public function forgotPasswordAction(){
           $this->lang->load('email_controller');                                                   // email language
           $this->form->check('e-mail' ,'email', 'required|valid_email|max_length[50]|xss_clean');  // control post parameter
           if( $this->form->get_result() ){                                                         // everything is ok
                $post_email =  $this->input->post('email',TRUE);
                $this->load->model('users');                                                        // load users model
                $result = $this->users->GetUserWithEmail($post_email);                              // Get user information from database
                if($result){ 
                    $userid = $result['id'];                                                        // id for this user email
                    $password = rand(100000,999999);                                                // new password for user
                    $user = array( 'password' => md5($password) , 
					               'is_face_acount' => "0"       );                                           // encypt and update user password 
                    $result = $this->users->update($userid,$user);                                  // update user information 
                    if($result){
                          $this->load->library('email');                                            // load library    
                          $recipient = $post_email;                                                 // Email adress that is sending password
                          $subject = lang('e.subjectPassword');
                          $message = mailNewPassword($result['name'], $password , $post_email );    // true resend false fisrst sending
                          $this->email->set_newline("\r\n");
                          $this->email->from('hep@hepgezelim.com', lang('e.name') );                // sender name
                          $this->email->to($recipient);                                             // Receiver
                          $this->email->subject($subject);                                          // Subject 
                          $this->email->message($message);                                          // Message created from email_helper
                          if($this->email->send()){                                                 // send action   
                              $status = "success";                
                              $text = lang("e.sended");
                          }
                          else{ 
                             $status = "mistake";
                             $text = lang("e.notsended");
                          }    
                    }
                    else{ 
                          $status = "mistake";
                          $text = lang("e.userupdate");
                     }      
                }
                else{
                     $status = "mistake";
                     $text = lang("e.nouser");
                }    
           }
           else
              $status = "fail";
           $error = $this->form->get_error();                        //  if there is error get it from Form validation class
           $result = array(  'status'  => $status,                   // JSON output     
                             'text'    => ( isset($text)?$text:"" ), 
                             'message' => $error['message'] );            
           echo json_encode($result);                                // JSON output 
    }
  

     /********  Private functions for using in functions *****************************************************************/   
    
     /**
      *  Parametredeki email kullanılıyor mu kontrol eden metot
      *  
      *  @param  $post_email  kullanılıp kullanılmadığı kontrol edilecek emial adresi
      *  @return  TRUE or FALSE
     **/
     private function checkEmail($post_email){                      
            $this->load->model('users');                            // load users model
            $result = $this->users->Search( $email = $post_email ); // check email adress is using or not
            return $result;                                         // return TRUE or FALSE 
     }
     
     /**
      *  Email gönderme işlemi
      *  
      *  @param  $name 
      *  @param  $email
      *  @param  $kod
      *  @param  $again
      *  @return  TRUE or FALSE
     **/
     private function sendMail( $name, $email, $kod ,$again ){
                   $recipient = $email;                                      // receiver adress
                   $subject = lang('e.subjectVerify');                       // subject from language file
                   $message = mailNewUser($name,  $kod, $again, $email);     // mail content
                   $this->load->library('email');                            // load library for email
                   $this->email->set_newline("\r\n");                              
                   $this->email->from('hep@hepgezelim.com', lang('e.name') ); // sender name
                   $this->email->to($recipient);                             // receiver
                   $this->email->subject($subject);                          // subject
                   $this->email->message($message);                          // message 
                   if($this->email->send())                                  // send email 
                      return true;
                   else
                      return false;     
     }
     

      

  
}// END of the Signup Class

/**
 *
 * End of the file signup.php
 *
 **/