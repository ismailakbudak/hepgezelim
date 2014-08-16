<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * Update Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Update extends CI_Controller {
        
        /**
         *  Constructor
        **/    
        public function __construct(){
              parent::__construct();  
		          $this->load->model('users');               // load users model for database action
        }

        /**
         * AJAX function
         * Kullanıcının email adresini doğrulama işlemi
         *  
         * @return  JSON output status : success, fail, error
        **/    
        public function email_kod(){
            $this->login->loginKontrol2();                                                           // check user login for ajax  
            $this->lang->load('profil_controller');                                                  // profil_controller language file load
            $this->form->check( lang("pc.email_kod") ,'email_kod', 'required|is_natural|xss_clean'); // control post parameter
            if( $this->form->get_result() ){                                                         // everything is ok
                    $email_kod =  $this->input->post('email_kod', TRUE);                             // post email adress 
                    $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );         // decode userid 
                    $result = $this->users->GetUser($userid);                                        // Get user information from database
                    if($result){    
                        if( strcmp($result['email_kod'], $email_kod) == 0 ){                         // check email code is match
                               $user = array( 'email_check' => "1"  );                               // new user info
                               $result = $this->users->update($userid,$user);                        // update user info
                               if( $result == TRUE ) 
                                    $status = 'success';
                               else 
                                    $status = 'fail';
                         }
                        else{
                           $status = "mistake";
                           $text = lang("pc.wrong_email_code");
                        }   
                    }
                    else
                      $status = "fail";
            } 
            else
                 $status = "error";
            $error = $this->form->get_error();                             //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                        // JSON output     
                              'text'    => ( isset($text) ? $text : "" ),  // if text dont have value asign null
                              'message' => $error['message'] );             
            echo json_encode($result);                                     // JSON output      
        }
        
        
        /**
         * AJAX function
         * Kullanıcının hesabını dondurma işlemi
         *  
         * @return  JSON output status : success, fail, error
        **/     
        public function delete(){
            $this->login->loginKontrol2();                                                                    // user login check  
            $this->lang->load('profil_controller');                                                           // profil_controller language file load
            $this->form->check( lang("pc.description") ,'description', 'required|waypoints_match|xss_clean'); // control post parameter
            if( $this->form->get_result() ){                                                                  // everything is ok
                    $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );                  // decode userid
                    $description =array(  'user_id'    => $userid,                                            // create new delete_account model 
                                          'description' =>  $this->input->post('description'  , TRUE)  );                    
                    $result = $this->users->delete($userid,$description);                                     // set user active false 
                    if($result == TRUE)                                                                  
                        $status = 'success';
                    else 
                        $status = 'fail';
            } 
            else
                 $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'message' => $error['message'] );            
            echo json_encode($result);                                // JSON output       
        }
        
        /**
         * AJAX function
         * Email bildirimlerini güncelleme işlemi
         *  
         * @return  JSON output status : success, fail, error
        **/    
        public function notification(){
                $this->login->loginKontrol2();
                $this->lang->load('profil_controller');                                                     // profil_controller language file load
                $this->form->check( lang("pc.new_message"),  'new_message',  'required|alpha|xss_clean');   // control post parameter
                $this->form->check( lang("pc.receive_rate"), 'receive_rate', 'required|alpha|xss_clean');   // control post parameter
                $this->form->check( lang("pc.after_ride"),   'after_ride',   'required|alpha|xss_clean');   // control post parameter
                $this->form->check( lang("pc.updates"),      'updates',      'required|alpha|xss_clean');   // control post parameter
                if( $this->form->get_result() ){                                                            // everything is ok
                        $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );                                   // decode userid 
                        $notification = array(  'new_message'  =>  ( $this->input->post('new_message'  , TRUE) == 'true' ) ? 1:0,  // create new notification model 
                                                'receive_rate' =>  ( $this->input->post('receive_rate' , TRUE) == 'true' ) ? 1:0,
                                                'after_ride'   =>  ( $this->input->post('after_ride'   , TRUE) == 'true' ) ? 1:0, 
                                                'updates'      =>  ( $this->input->post('updates'      , TRUE) == 'true' ) ? 1:0 ); 
                        $this->load->model('notifications');                                                                       // load notification model for database action 
                        $result = $this->notifications->update($userid,$notification);                                             // update notification data 
                        if($result == TRUE)                                  
                            $status = 'success';
                        else 
                            $status = 'fail';
                } 
                else
                     $status = "error";
                $error = $this->form->get_error();                        //  if there is error get it from Form validation class
                $result = array(  'status'  => $status,                   // JSON output     
                                  'message' => $error['message'] );            
                echo json_encode($result);                                // JSON output                                                                                 // JSON output
        }  
        
        /**
         * AJAX function
         * Kullanıcının şifresini güncelleme işlemi
         *  
         * @return  JSON output status : success, fail, error
        **/        
        public function password(){
                $this->login->loginKontrol2();                                                                      // check user login       
                $this->lang->load('profil_controller');                                                             // profil_controller language file load
                $this->form->check( lang("pc.old_password"), 'old_password', 'required|alpha_numeric|xss_clean');   // control post parameter
                $this->form->check( lang("pc.new_password"), 'new_password', 'required|min_length[6]|max_length[20]|alpha_numeric|xss_clean');   // control post parameter
                if( $this->form->get_result() ){                                                                    // everything is ok
                          $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );                  // decode userid
                          $old_password = $this->input->post('old_password'  , TRUE);                               // user oldpassword post  
                          $result = $this->users->GetUser($userid);                                                 // get user information 
                          if( is_array( $result ) && count( $result ) > 0 ){
                                if( $result['is_face_acount'] == 0 ){  
                                     if( strcmp( $result['password'] , md5($old_password)) == 0 ){                        // check old and post password
                                         $user = array( 'password' => md5( $this->input->post('new_password'  , TRUE) ) );// new user model 
                                         $result = $this->users->update($userid,$user);                                   // update user information
                                         if($result == TRUE)             
                                              $status = 'success';
                                         else
                                              $status = 'fail';
                                     }
                                     else
                                         $status = 'mistake';
                                }
                                else{
                                     $status = 'mistake';  
                                }
                          }
                          else
                              $status = 'fail';
                } 
                else
                     $status = "error";
                $error = $this->form->get_error();                        //  if there is error get it from Form validation class
                $result = array(  'status'  => $status,                   // JSON output     
                                  'message' => $error['message'] );            
                echo json_encode($result);                                // JSON output 
        } 
        
        /**
         * AJAX function
         * Kullanıcının bilgilerini doğrulama işlemi
         *  
         * @return  JSON output status : success, fail, error
        **/    
        public function updateUser(){
                $this->login->loginKontrol2();                                                                                            // check user login  
                $this->lang->load('profil_controller');                                                                                   // profil_controller language file load
                $year = getdate();
                $year = $year['year'] - 17;     
                $this->form->check( lang("pc.name"       ) ,'name',        'required|alpha|max_length[50]|xss_clean');                    // control post parameter
                $this->form->check( lang("pc.surname"    ) ,'surname',     'required|alpha|max_length[50]|xss_clean');                    // control post parameter
                $this->form->check( lang("pc.email"      ) ,'email',       'required|valid_email|max_length[50]|xss_clean');              // control post parameter
                $this->form->check( lang("pc.birthyear"  ) ,'birthyear',   'required|greater_than[1920]|less_than['.$year.']|xss_clean'); // control post parameter
                $this->form->check( lang("pc.tel_no"     ) ,'tel_no',      'regex_match[/^([0-9 ])+$/i]|xss_clean');                      // control post parameter
                $this->form->check( lang("pc.description") ,'description', 'waypoints_match|xss_clean');                                  // control post parameter
                $this->form->check( lang("pc.tel_check"  ) ,'tel_check',   'is_natural|xss_clean');                                       // control post parameter
                $this->form->check( lang("pc.email_check") ,'email_check', 'is_natural|xss_clean');                                       // control post parameter
                if( $this->form->get_result() ){                                                                       // everything is ok
                        $user_id = $this->encrypt->decode( $this->session->userdata( 'userid') );                      // decode userid
                        $tel_no = $this->input->post('tel_no'      , TRUE);
                        if( strcmp($tel_no, "") != 0 ){
                           $where = "tel_no LIKE '%$tel_no%' AND id != $user_id";  
                           $users = $this->users->GetUserWithWhere($where);
                        }
                        else
                           $users = array();
                        if( is_array($users) && count( $users ) == 0 ){
                              $user = array(  'name'           =>  $this->input->post('name'        , TRUE),            // new user model
                                              'surname'        =>  $this->input->post('surname'     , TRUE),
                                              'email'          =>  $this->input->post('email'       , TRUE), 
                                              'tel_no'         =>  $this->input->post('tel_no'      , TRUE),
                                              'tel_visible'    =>  ($this->input->post('tel_visible' , TRUE) == 'true' ) ? 1:0 ,
                                              'birthyear'      =>  $this->input->post('birthyear'   , TRUE), 
                                              'description'    =>  $this->input->post('description' , TRUE),
                                              'tel_check'      =>  $this->input->post('tel_check'   , TRUE),   
                                              'email_check'    =>  $this->input->post('email_check' , TRUE)     ); 
                              $result = $this->users->update($user_id,$user);                                                  // update user information
                              if($result){                                                                                // new session data
                                   $userdata = array(    'name'         =>  $this->encrypt->encode( $user['name']        ),   
                                                         'surname'      =>  $this->encrypt->encode( $user['surname']     )  );
                                   $this->session->set_userdata($userdata);                                               // set new user data in the session   
                              }
                              if($result == TRUE)
                                  $status = 'success';
                              else {
                                  $status = 'fail';
                                  $text   = lang("pc.error_update"); 
                              }    
                      }
                      else{
                            $status = 'fail';
                            $text   = lang("pc.tel_using");
                      }   
                } 
                else
                    $status = "error";

                $error = $this->form->get_error();                             //  if there is error get it from Form validation class
                $result = array(  'status'  => $status,                        // JSON output     
                                  'text'    => ( isset($text) ? $text : "" ),  // if text dont have value asign null   
                                  'message' => $error['message'] );            
                echo json_encode($result);                                     // JSON output 
        } 

}// END of the Update Class

/**
 *
 * End of the file update.php
 *
 **/