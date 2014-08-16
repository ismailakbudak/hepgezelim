<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DEVELOPER İsmail AKBUDAK 
 * Profil Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Profil extends CI_Controller {
       
        /**
          * Constructor
         **/
         public function __construct(){
                parent::__construct();
			   }

        /******************************************     Public Functions with views *******************************************************/
       /**
        * Kontrol panlei sayfasını yükler
        * 
        *  
        * @return HTML view
       **/    
	     public function index(){  
		        	 	$data = $this->login->loginKontrol();                                         // check user login  
                $this->lang->load('profil_controller');                                       // load profil_controller language file
                $this->load->model('users');                                                  // load users model for database action
                $this->load->model('offersdb');                                               // load offersdb model for database action
                $this->load->model('messages');                                               // load messages model for database action
                $this->load->model('cars');                                                   // load cars model for database action
                $this->load->model('alerts');                                                 // load alerts model for database action
                $this->load->model('ratings_db');                                             // load ratings_db model for database action
                $this->load->model('look_at');                                                // load look_at model for database action
                $this->lang->load('dashboard');                                               // load dasboard language file
                
                $userid                 =  $this->encrypt->decode( $this->session->userdata('userid') );      // decode userid 
                $user                   = $this->users->GetUserAllInfo( $userid );    
                $warnings               = $this->users->GetUserWarnings( $userid );    
                $offers_count           = $this->offersdb->GetUserOfferCount( $userid ); 
                $cars                   = $this->cars->GetUserCars( $userid ); 
                $avg                    = $this->ratings_db->GetUserAverageRatings( $userid );
                $alerts                 = $this->alerts->GetUnreadAlertsContent($userid);
                $messagesInbox          = $this->messages->unreadInbox( $userid ); 
                $messagesSent           = $this->messages->unreadSent($userid);
                $last_offers            = $this->look_at->GetUserLookList($userid);
                
                if( is_array( $user ) && count($user) > 0 && is_array($offers_count) &&  is_array($cars) 
                      && is_array($alerts) &&  is_array($messagesInbox) && is_array($messagesSent) 
                      && is_array($last_offers) && count($user) > 0 && is_array($warnings)  ){ 
                      $user['foto'] = photoCheckUser($user);                                          // check user photo use default 
                      $photo = explode("/", $user['foto']);
                      if( strcmp('male.png', $photo[count($photo) - 1 ]) == 0 ||  strcmp('female.png', $photo[count($photo) - 1 ]) == 0 )  
                           $user['foto'] = "-1";
                      
                      $user['total']          = $this->ratings_db->totalRating( $userid  );           // send total value to view
                      $user['avg']            = $avg;                                                 // send avg value to view
                      $user['offer_count']    = $offers_count['offers_count']; 
                      foreach ($cars as &$value) 
                           $value['foto_name'] = photoCheckCar($value);                               // not-exist car image use default 
                      $user['cars']            = $cars; 
                   
                      $data['last_offers']     = $last_offers;
                      $data['alert']           = $alerts;
                      $data['warnings']        = $warnings;
                      $data['messagesInbox']   = $messagesInbox;
                      $data['messagesSent']    = $messagesSent;
                      $data['user']            = $user;                                    // send user array to view 
                      $data['active']          = '#dashroad';                              // active profil menu 
                      $this->login->loadViewHead( $data);                                  // load views
                      $this->load->view('profil/dashroad');                                // load view
                      $this->login->loadViewHeadFoot();                                    // load views
	              }else{
                     show_404('hata');
                }
        }
        
       /**
        *  Profil sayfasını yükler
        *  
        *  @param $page aktif profil sayfası
        *  @return HTML view
       **/    
        public function profile( $page ='' ){
                $data = $this->login->loginKontrol( );                                        // check user login
                $this->lang->load('profil_controller');                                       // load profil_controller language file

                $data['active'] = '#profile';
                $this->load->model('users');                                                  // load users mode lfor database action   
                $page = trim($page );                                                         // get page name from url 
                $data['active_side'] = '#'.$page;                                             // active sidebar menu
                $userid    =  $this->encrypt->decode( $this->session->userdata('userid') );   // decode userid            
                $user      = $this->users->GetUser($userid);                                  // get user information  
                
                if( ! is_array( $user ) || count($user ) == 0 ){
                    show_404();
                    exit;
                }
                       
                if( strcmp($page, 'info') == 0){                                       
                    $user['id']   = $this->encrypt->encode( $user['id'] );;        // decode user id
                    $viewContent  = 'profile/info';                               // load view    
                }
                else if( strcmp($page, 'foto') == 0){
                    $viewContent =  'profile/foto';                               // load view
                }   
                else if( strcmp($page, 'preference') == 0){
                    $this->load->model('preferences');                            // load preferences model
                    $preference = $this->preferences->GetPreference($userid);     // get user preference settings
                    if($preference)                                           
                        $data['preference'] = $preference;                        // send to preference data to view  
                    else                                                          // there is no user's preference settings send default  
                         $data['preference'] = array('like_chat' => 1,'like_music' => 1,'like_smoke' => 1,'like_pet' => 1, 'explain' =>"" );                        
                    $viewContent =  'profile/preference';                         // load view
                }
                else if( strcmp($page, 'verification') == 0){            
                    $viewContent =  'profile/verification';                       // load view 
                }
                else if( strcmp($page, 'cars') == 0){
                    $this->load->model('cars');                                   // load model cars
                    $cars = $this->cars->GetUserCars($userid);                    // get user all cars   
                    foreach ($cars as &$value){ 
                        $value['normalid'] =   $value['id'] ;                     // add new column
                        $value['id'] =  $this->encrypt->encode( $value['id'] );   // encrypt car id 
                        $value['foto_name'] = photoCheckCar($value);              // not-exist car image use default 
                    }               
                    $data['cars'] = $cars;                                        // send car information to view
                    $viewContent =  'profile/cars';                               // load view               
                }
                else if( strcmp($page, 'notification') == 0){             
                    $this->load->model('notifications');                            // load notifications model
                    $notification = $this->notifications->GetNotification($userid); // get user's notfiacation from database
                    $data['email'] = $user['email']; // decode user email adress
                    if( $notification )
                        $data['notification'] = $notification;                     // send user's notfication data to view  
                    else{
                        $data['notification'] = array( 'new_message' => 0,         // if there is no user's notification
                                                       'after_ride' => 0, 
                                                       'receive_rate' => 0, 
                                                       'updates' => 0);
                    }
                    $viewContent =  'profile/notification';                        // load view 
                }
                else if( strcmp($page, 'socialmedia') == 0){
                    $viewContent =  'profile/socialmedia';                         // load view
                }
                else if( strcmp($page, 'password') == 0){
                    $viewContent =  'profile/password';                            // load view
                }
                else if( strcmp($page, 'delete') == 0){            
                    $viewContent =  'profile/delete';                               // load view
                }
                else{
                    $user['id'] = $this->encrypt->encode( $user['id'] );            // encrypt userid
                    $viewContent =  'profile/info';                                 // load view
                    $data['active_side'] = '#info';                                 // default active sidebar menu 
                }
                $data['user'] = $user;                                              // user information send it to view    
                $viewHead    =  'profile/profileHead';                              // load view 
                $viewFoot    =  'profile/profileFoot';                              // load view 
                $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot);     // load views
        }      

        /********************************* Action  Methods ****************************************************************/
      
       /**
        * Bildirimleri güncelleme işlemi
        *
        *  
        * @return JSON output status: success, fail, error
       **/   
        public function updateAlerts(){
               $this->login->loginKontrol2();
               $this->lang->load('profil_controller');                                              // load profil_controller language file
               $this->form->check( "element", 'element', 'required|alpha|xss_clean');               // check post data
               if( $this->form->get_result() ){            
                       $this->load->model('alerts');                                                // load alerts model for database action
                       $element   = $this->input->post('element',TRUE);                             // Get post data
                       $user_id   = $this->encrypt->decode( $this->session->userdata('userid') );   // decode userid 
                       if( strcmp("arac", $element) == 0 ){
                          $where = array( "arac" => 1);
                       }else if( strcmp("aracagain", $element) == 0 ){
                         $where = array( "arac_again" => 0);
                       }else if( strcmp("tercih", $element) == 0 ){
                          $where = array( "tercih" => 1);
                       }else if( strcmp("bio", $element) == 0 ){
                         $where = array( "bio" => 1);
                       }else if( strcmp("photo", $element) == 0 ){
                         $where = array( "photo" => 1); 
                       }else if( strcmp("phone", $element) == 0 ){
                         $where = array( "phone" => 1);
                       }else if( strcmp("email", $element) == 0 ){
                         $where = array( "email" => 1);
                       }else if( strcmp("face", $element) == 0 ){
                         $where = array( "face" => 1);
                       }else{
                         $where = array( "extra_read" => 1);
                       } 
                       $result = $this->alerts->Update($user_id, $where);
                       if( $result ){ 
                          $status = "success";
                       }
                       else{
                          $text   = lang("g.error_update"); 
                          $status = "success";
                       }   
               }
               else 
                   $status = "error";
               $error = $this->form->get_error();                                    //  if there is error get it from Form validation class
               $result = array(  'status'    => $status,                             // JSON output     
                                 'message'   => $error['message'],
                                 'text'      => isset($text)  ? $text : ""  );     
               echo json_encode($result);                                            // JSON output    
        }

       /**
        * Tercihleri güncelleme metodu
        * 
        *  
        * @return HTML view
       **/    
        public function preference(){
             $data = $this->login->loginKontrol( );                                       // check user login   
             $this->lang->load('profil_controller');                                      // load profil_controller language file

             $this->form->check( "" ,'chat',       'required|is_natural|xss_clean');                                                  // check post data       
             $this->form->check( "" ,'music',      'required|is_natural|xss_clean');                                                  // check post data       
             $this->form->check( "" ,'smoke',      'required|is_natural|xss_clean');                                                  // check post data       
             $this->form->check( "" ,'pet',        'required|is_natural|xss_clean');                                                  // check post data       
             $this->form->check( "" ,'explain',    'waypoints_match|xss_clean'    );                                                  // check post data       
             if( $this->form->get_result() ){                 
                     $preference = array(                                                 // create preference model
                                         'like_chat '   =>  $this->input->post('chat',    TRUE), 
                                         'like_music'   =>  $this->input->post('music',   TRUE),
                                         'like_smoke'   =>  $this->input->post('smoke',   TRUE),
                                         'like_pet  '   =>  $this->input->post('pet',     TRUE),
                                         'explain   '   =>  $this->input->post('explain', TRUE) 
                                        );
                     $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );     // decode userid
                     $this->load->model('preferences');                                           // load preferences model for database action        
                     $result = $this->preferences->update($userid,$preference);                   // update preference
              }
              else
                    $status = "error";
              $error = $this->form->get_error();                        //  if there is error get it from Form validation class
              $result = array(  'status'  => $status,                   // JSON output     
                                'message' => $error['message'] );            
              redirect("profil/profile/preference");                    // redirect preference page
        }  
 
       /**
        *  Profil fotoğrafı yükleme sayfası
        *   
        *  @return HTML view
       **/    
        public function upload(){
                   $data = $this->login->loginKontrol( );                                            // check user login 
                   $this->lang->load('profil_controller');                                           // load profil_controller language file
                   $data['active_side'] = '#foto';                                                   // active sidebar menu 
                   $path   = realpath(getcwd()."/assets/");                                          // get path for upload  
                   $config['upload_path'] = $path;                                                   // upload path 
                   $config['allowed_types'] = 'jpg|png|JPG|PNG';                                     // allowed image types
                   $config['max_size']  = '2048';                                                    // maximum image size 2mb
                   $config['max_width']  = '600';                                                    // maximum image width
                   $config['max_height']  = '600';                                                   // maximum image height
                   $this->load->library('upload', $config);                                          // load upload library
                   if(  $this->upload->do_upload() ){                                                // start uploading
                           $success = array('upload_data' => $this->upload->data());                 // file uploaded successfully get information
                           $zfile = $success['upload_data']['full_path'];                            // get file path
                           chmod($zfile,0777);                                                       // CHMOD file     
                           $foto =  base_url().'assets/'. $success['upload_data']['raw_name'] . $success['upload_data']['file_ext'] ; // new photo directory
                           $id = $this->encrypt->decode( $this->session->userdata( 'userid') );      // decode userid 
                           $prevfoto = $this->encrypt->decode( $this->session->userdata( 'foto') );  // get user previous photo directory     
                           $array = explode('/', $prevfoto);                                         // split image url pattern '/'
                           $file_name = $array[ count($array)-1 ];                                   // array last element is file name

                           // if user photo is not default photo remove it from directory
                           if( strcmp($file_name, 'male.png') != 0 && strcmp($file_name, 'female.png') != 0 && file_exists( realpath( $path.'/'. $file_name) ))
                                unlink( realpath( $path.'/'. $file_name ) );                   
                           $user = array(  'foto' => $foto, 'foto_onay' => 0 );                      // change photo onay info
                           $this->load->model('users');                                              // load users model for database action
                           $result = $this->users->update($id,$user);                                // update user  
                           $data['active'] = '#profile';                                             // active profile menu
                           if($result){                                                              /// user has been updated successfully
                                  $type             = 'success';                                     // alert type
                                  $title            = lang("p.tebrik");                              // alert title from file profil controller
                                  $content          =  lang("p.savesuccess");                        // alert content from file profil_controller 
                                  $data['result']   = alertWide($type, $title, $content);            // send alert data to view    
                                  $data['error']    = $success;                                      // send information to view
                                  $data['fotoname'] = $foto;                                          // send photo name to view
                                  $userdata         = array(   'foto' =>  $this->encrypt->encode($foto ) );  // session new data
                                  $this->session->set_userdata($userdata);                           // cheange photo directory in the session  
                            }
                            else{                                                                    /// failed user update information 
                                   $type           = 'danger';                                       // alert type 
                                   $title          = lang("p.sory");                                 // alert title from language file profil_controller  
                                   $content        = lang("p.updatefail");                           // alert content from language file profil_controller
                                   $data['result'] = alertWide($type, $title, $content);             // send alert data to view  
                            }       
                           $viewHead    =  'profile/profileHead';                                    // load view  
                           $viewContent =  'profile/foto';                                           // load view
                           $viewFoot    =  'profile/profileFoot';                                    // load view
                           $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot);           // load views        
                   }
                   else{                                                                             /// upload failed
                           $error = array('error' => $this->upload->display_errors());               // get upload error  
                           $data['active'] = '#profile';                                             // active profile menu
                           $type= 'danger';                                                          // alert type 
                           $title =  lang("p.sory");                                                 // alert title 
                           $content = $error['error'];                                               // alert content from language file
                           $data['result'] = alertWide($type, $title, $content);                     // send alert data to view 
                           $data['error'] = $error;                                                  // send error data to view
                           $viewHead    =  'profile/profileHead';                                    // load view
                           $viewContent =  'profile/foto';                                           // load view
                           $viewFoot    =  'profile/profileFoot';                                    // load view 
                           $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot);           // load views
                   }
         }

        /*******************************   Private Functions for using methods  ***********************************************/
   
       /**
        *  Sayfaları yükleme metodu
        *
        *  @param  $data 
        *  @param  $head 
        *  @param  $content 
        *  @param  $foot 
        *  @return HTML view
       **/    
       private function loadProfil( $data = array(), $viewHead, $viewContent, $viewFoot ){
                $this->login->loadViewHead( $data);                 // load views from login class
                $this->load->view('profil/'.$viewHead );            // load view
                $this->load->view('profil/'.$viewContent);          // load view
                $this->load->view('profil/'.$viewFoot );            // load view   
                $this->login->loadViewHeadFoot();                   // load views from login class
       }

        /**
          *  AJAX function
          *  Uyarılar okundu işlemi 
          *  
          *  @return   JSON output status: success, fail, error
         **/      
        public function warning_readed_process(){
              $this->login->loginKontrol2();                                          // check admin logged in 
              $this->lang->load('profil_controller');                                 // load profil_controller language file
              $this->form->check( ' id ',    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $id      = my_decode( $this->input->post('id', TRUE) );         // decode car id 
                      $table        = "warnings";
                      $update_data  = array('is_read' => 1 );
                      $this->load->model('admin_db');
                      $result       = $this->admin_db->update($table , $id , $update_data );
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("pc.readed-$status");
              }       
              else
                  $status = "error";
              $error = $this->form->get_error();  
              $result = array( 'status'  => $status, 
                               'text'    => isset($text) ? $text :"",
                               'message' => $error['message'] );          // JSON output
              echo json_encode($result);                                  // JSON output
        }


}// END of the Profil Class
/**
 * End of the file Profil.php
 **/