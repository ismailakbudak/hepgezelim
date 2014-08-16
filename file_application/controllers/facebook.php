<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *   
 * Facebook Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Facebook extends CI_Controller {
    
    /**
     *  global variable
    **/         
     public $user_id, $data;

    /**
     *  Constructor
    **/    
    public function __construct(){
         parent::__construct();    
    }
 
     /**
     *  AJAX function  
     *  Facebook kulalnıcısı kayıt işlemi  
     *
     *  @return JSON output status: success, fail, error
     **/
     public function signup(){
           
           $this->lang->load('facebook');                                                                          // load language file
           $this->form->check( lang('f.id') ,          'id',          'required|xss_clean');                       // check post data
           $this->form->check( lang('f.gender') ,      'gender',      'required|alpha|xss_clean');                 // check post data
           $this->form->check( lang('f.first_name') ,  'first_name',  'required|alpha|max_length[50]|xss_clean');  // check post data
           $this->form->check( lang('f.last_name') ,   'last_name',   'required|alpha|max_length[50]|xss_clean');  // check post data
           $this->form->check( lang('f.email') ,       'email',       'required|valid_email|xss_clean');           // check post data
           $this->form->check( lang('f.birthday') ,    'birthday',    'required|xss_clean');                       // check post data
           $this->form->check( lang('f.friends') ,     'friends',     'required|is_natural|xss_clean');            // check post data
           $this->form->check( lang('f.picture') ,     'picture',     'xss_clean');                                // check post data
           if( $this->form->get_result() ){       
                  
                  $sex       = trim( $this->input->post('gender',   TRUE ) );
                  $sex       = ( strcmp(  $sex, "male" ) == 0 ) ? 1 : 2 ;
                  $birthday  = explode("/", $this->input->post('birthday',   TRUE ) );
                  $birthyear = $birthday[ count($birthday) -1 ];  
                  
                  $year = getdate();
                  $year = $year['year'] - 17;   
                  if( is_numeric($birthyear) && $birthyear > 1930 &&  $birthyear < $year ){    // age controle   
                          $post_foto = $this->input->post('picture',   TRUE );
                          if( strcmp( trim(  $post_foto  ), "") == 0  ){
                                    $post_foto  =     base_url() . 'assets/' ;                // get path 
                                    $post_foto .=   ($sex == 1) ? 'male.png' : 'female.png';  // user default image
                          }
                          
                          // post data
                          $email    =  $this->input->post('email',TRUE) ;
                          $password =  $this->input->post('id',TRUE) ;

                          $this->load->model('users');
                          $result = $this->users->Search2(  $email   );                      // check email adress is using or not
                          if(  is_array( $result ) && count($result) > 0 ){
                                
                                if( $result['is_face_acount'] == 1 && strcmp( trim($result['password'] ), md5( $password ) ) == 0 ){
                                     // kullanıcının kendisi
                                     $status = 'face_member';
                                     $text   =  lang("f.face_member");
                                }
                                else{
                                      // başka kullanıcı
                                      $status = 'emailusing';
                                      $text   =  lang("f.email-using");
                                }
                          } 
                          else if( is_array($result) && count($result) == 0 ){ 
                                  // for email
                                  $email_kod =  rand(1,99999);                                                  // create random code
                                  $user = array(    'password'       =>  md5( $password )                     , // create new user model
                                                    'email'          => $email                                ,
                                                    'name'           => $this->input->post('first_name',TRUE) ,
                                                    'surname'        => $this->input->post('last_name',TRUE)  ,
                                                    'sex'            => $sex                                  ,
                                                    'is_face_acount' => 1                                     ,
                                                    'birthyear'      => $birthyear                            ,
                                                    'foto'           => $post_foto                            ,
                                                    'foto_onay'      => 0                                     , 
                                                    'face_check'     => 1                                     ,
                                                    'email_check'    => 1                                     ,
                                                    'friends'        => $this->input->post('friends',  TRUE ) ,
                                                    'email_kod'      => $email_kod   );
                                  
                                  // save user;
                                  $result1 = $this->users->Add( $user );                                       // save user
                                  if( $result1 ){                                                              // user has been saved successfully                                        
                                        $result = $this->users->Login( $email, $password  );                   // access user data from database
                                        if($result){ 
                                            $userdata = array(   'userid'       =>  $this->encrypt->encode( $result['id']          ),
                                                                 'name'         =>  $this->encrypt->encode( $result['name']        ),   
                                                                 'surname'      =>  $this->encrypt->encode( $result['surname']     ),
                                                                 'sex'          =>  $this->encrypt->encode( $result['sex']         ),
                                                                 'foto'         =>  $this->encrypt->encode( $result['foto']        ),
                                                                 'logged_in'    =>  TRUE  );
                                           
                                            // set session data  
                                           $this->session->set_userdata($userdata);
                                           
                                           // send email to new user 
                                           $name = $this->encrypt->decode( $this->session->userdata( 'name' ) );                          // decode user name
                                           //$this->sendMail($result['name'] , $result['email'] , $result['email_kod'], FALSE );  
                                        }                       
                                  }
                                  $status = ($result1 == TRUE)  ? "success" :  'fail';  
                          }else{
                                $status = 'emailusing';
                                $text   =  lang("f.email-using");
                          }
                  }else{
                         $status = "fail";
                         $text   = lang("f.age-invalid");
                  }            
            }
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] . "  " . lang("f.face_error" )  );      
            echo json_encode($result);                               // JSON output
     }

    /**
     * AJAX function
     * Facebook hesabı ile giriş işlemi 
     * 
     * @return JSON output status: success,fail,error
     **/
     public function login(){
           $this->lang->load('facebook');                                                                    // load language file
           $this->form->check( lang('f.id') ,          'id',          'required|xss_clean');                 // check post data
           $this->form->check( lang('f.email') ,       'email',       'required|valid_email|xss_clean');     // check post data
           $this->form->check( lang('f.friends') ,     'friends',     'is_natural|xss_clean');               // check post data
           if( $this->form->get_result() ){ 
                  
                          $email    =  $this->input->post('email',TRUE) ;
                          $password =  $this->input->post('id',TRUE) ;

                          $this->load->model('users');
                          $result = $this->users->Login( $email, $password  );                              // access user data from database
                          if($result && $result['is_face_acount'] == 1 ){ 
                               if($result['ban'] != '1'){                                                   // check does user banned? 
                                     if($result['active'] == '1'){                                          // create user information set for session
                                          $userdata = array(    'userid'       =>  $this->encrypt->encode( $result['id']          ),
                                                                'name'         =>  $this->encrypt->encode( $result['name']        ),   
                                                                'surname'      =>  $this->encrypt->encode( $result['surname']     ),
                                                                'sex'          =>  $this->encrypt->encode( $result['sex']         ),
                                                                'foto'         =>  $this->encrypt->encode( $result['foto']        ),
                                                                'logged_in'    =>  TRUE  );
                                           // set session data  
                                          $this->session->set_userdata($userdata);
                                          $user_id    =  $result['id'];                                     // userid 
                                          $this->users->levelUpdate( $user_id );   
                                          $seen_last  =  date('Y-m-d H:i:s');                               // get current time                  
                                          $seen_times =  $result['seen_times'] + 1;                         // increase seentimes
                                          $user = array(  'seen_last'  =>  $seen_last,  
                                                          'friends'    =>  $this->input->post('friends',TRUE),                  
                                                          'seen_times' =>  $seen_times  ); 
                                          $result = $this->users->update($user_id,$user);                   // save new user data
                                          $status =  "login";                                         
                                   }
                                   else{
                                        $status =  "not-active";
                                        $text   = lang("f.not-active");
                                   }     
                             }
                             else{
                                  $status =  "ban";
                                  $text   = lang("f.ban");
                             }
                          }
                          else{
                                $status = "error";
                                $text   = lang("f.wrong_data");  
                          }        
            }                     
            else
                  $status = "error2";

            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] . "  " . lang("f.face_error" )  );      
            echo json_encode($result);                               // JSON output
     }
   

     /** 
      *  Email gönderme fonksiyonu
      *
      *  @param  $name 
      *  @param  $email
      *  @param  $kod
      *  @param  $again
      *  @return TRUE or FALSE  
     **/
     private function sendMail( $name, $email, $kod ,$again ){
          
                   $this->load->helper('email');             // helper function about the email 
                   $this->lang->load('email_controller');    // email language
                   $recipient = $email;                                      // receiver adress
                   $subject = lang('e.subjectVerify');                       // subject from language file
                   $message = mailNewUser($name,  $kod, $again);             // mail content
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
    

    /**
     *   AJAX function
     *   Facebook fotoğrafımı kullan işlemi   
     *
     *   @return JSON output
     **/
     public function foto(){
          
           $this->lang->load('facebook');                                                                    // load language file
           $this->form->check( lang('f.id') ,          'id',          'required|xss_clean');                 // check post data
           $this->form->check( lang('f.email') ,       'email',       'required|valid_email|xss_clean');     // check post data
           $this->form->check( lang('f.picture') ,     'picture',     'xss_clean');                          // check post data
           if( $this->form->get_result() ){ 
                          
                          $email     =  $this->input->post('email',TRUE) ;
                          $password  =  $this->input->post('id',TRUE) ;
                      
                          $post_foto = $this->input->post('picture',   TRUE );
                          
                          if( strcmp( trim(  $post_foto  ), "") != 0  && $this->session->userdata( 'logged_in') ){
                                       
                                        $this->load->model('users');
                                        $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );         // decode userid 
                                        $result = $this->users->GetUser($userid);                                        // Get user information from database
                                      

                                        if( is_array( $result ) && count( $result ) > 0 ){ 
                                                   $user    = array(  'foto'      =>  $post_foto, 
                                                                      'foto_onay' =>   0  ); 
                                                   $result  = $this->users->update($userid,$user);                   // save new user data
                                                   $status  =  ( $result == TRUE ) ? "success" : "fail";
                                                   $text    =  ( $result == TRUE ) ? lang("f.foto_succ") :  lang("f.foto_fail");                                          
                                                   $dizi = array( 'foto' => $this->encrypt->encode( $post_foto ) );
                                                   $this->session->set_userdata($dizi ); 
                                        } 
                                        else{
                                              $status  = "fail";  
                                              $text    = lang("f.foto_fail");
                                        }     
                          }else{
                                $status  = "fail";  
                                $text    = lang("f.foto_fail");
                          } 
                          
            }                     
            else
                  $status = "error2";

            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] . "  " . lang("f.face_error" )  );      
            echo json_encode($result);                               // JSON output
     }

    /**
     *  AJAX function 
     *  Facebook arkadaş listemi doğrulama
     *
     *  @return JSON output status: success,fail,error
     **/
     public function verification(){
          
           $this->lang->load('facebook');                                                                    // load language file
           $this->form->check( lang('f.id') ,          'id',          'required|xss_clean');                 // check post data
           $this->form->check( lang('f.email') ,       'email',       'required|valid_email|xss_clean');     // check post data
           $this->form->check( lang('f.friends') ,     'friends',     'is_natural|xss_clean');               // check post data
           if( $this->form->get_result() ){ 
                   
                          $email    =  $this->input->post('email',TRUE) ;
                          $password =  $this->input->post('id',TRUE) ;
                         
                          if( $this->session->userdata( 'logged_in')  ){
                                  
                                  $this->load->model('users');
                                  $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );         // decode userid 
                                  $result = $this->users->GetUser($userid);                                        // Get user information from database
                              
                                  if( is_array( $result ) && count( $result ) > 0 ){ 
                                           
                                             $user    = array(  'friends'    =>  $this->input->post('friends',TRUE),
                                                                'face_check' =>   1 ); 
                                             $result  = $this->users->update($userid,$user);                   // save new user data
                                             $status  = ( $result == TRUE ) ? "success" : "fail"; 
                                             $text    = ( $result == TRUE ) ? lang("f.verfy_succ") :  lang("f.verfy_fail");                                         
                                  }
                                  else{
                                        $status = "fail";  
                                        $text    =  lang("f.verfy_fail");     
                                  } 
                         }
                        else{
                              $status = "fail";  
                              $text    =  lang("f.verfy_fail");     
                        }                  
            }                     
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] . "  " . lang("f.face_error" )  );      
            echo json_encode($result);                               // JSON output
     }
     

}// END of the Facebook class
/* 
 *  End of the file Facebook.php
 */   