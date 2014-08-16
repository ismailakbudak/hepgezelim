<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DEVELOPER İsmail AKBUDAK 
 * Admin_Hepgezelim Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 * Tamamlandı 11-04-2014 tarihinde
 */

class Admin_Hepgezelim extends CI_Controller {
       
        /**
          * Constructor
         **/
         public function __construct(){
                parent::__construct();
              
			    // sunucuda zaman geri olduğu için
                date_default_timezone_set('Europe/Istanbul');  
         
                //$this->lang->load("admin")
                $this->load->model("admin_db");     // load model file 
         }

     /************************************** DONE ***************************************/    
      
        /**
         * Load view   home page 
         *
         * @return  HTML home view
        **/    
	      public function index(){  
               $data = $this->admin->loginKontrol();                            // check admin logged in

               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view('application/main' );       
               $this->load->view('admin_hepgezelim/include/footer');            // load views
	      }

        /**
         *  Load view adminlogin page
         * 
         * @return   HTML login page 
        **/    
        public function login_view(){   
               $this->load->view('admin_hepgezelim/include/template');   // load views
               $this->load->view('admin_hepgezelim/admin_main/login');   // load views 
        }

        /**
         * Load view   get uploaded images consider them
         *  
         * @return  HTML view
        **/    
        public function car_photo_view(){  
              $data   =  $this->admin->loginKontrol();                           // check admin logged in

              $images =  $this->admin_db->GetCarImages();
              if(  ! is_array( $images ) )
                      show_404('admin');  
              
              foreach ($images as &$value )
                 $value['foto_name'] =  photoCheckCar($value);
              
              $data['images'] = $images;

              $this->load->view('admin_hepgezelim/include/header',$data);      // load views
              $this->load->view("admin_hepgezelim/admin_main/car_photo_view",$data);
              $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }
        
        /**
         * Load view   get approval images consider them
         * 
         * @param $OFFSET  select data from cars start point 
         * @return  HTML view
        **/    
        function car_photo_approval_view( $OFFSET ){  
              $data   =  $this->admin->loginKontrol();                           // check admin logged in
              if( !is_numeric( $OFFSET ) || $OFFSET < 0 )
                   $OFFSET = 0;
              
              $LIMIT = 50;
              $images =  $this->admin_db->GetCarImagesApproval( $LIMIT, $OFFSET );
              if(  ! is_array( $images ) ) 
                      show_404('admin');  
             
              foreach ($images as &$value )
                 $value['foto_name'] =  photoCheckCar($value);
                
              $data['LIMIT'] =   $LIMIT; 
              $data['OFFSET'] = $OFFSET + $LIMIT;          
              $data['images'] = $images;
              $this->load->view('admin_hepgezelim/include/header',$data);      // load views
              $this->load->view("admin_hepgezelim/admin_main2/car_photo_approval_view",$data);
              $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }
 
  
        /**
         * Load view   get uploaded images consider them
         *  
         * @return  HTML view
        **/    
        public function user_photo_view(){  
              $data =  $this->admin->loginKontrol();                           // check admin logged in

              $images =  $this->admin_db->GetUserImages();
              if(  ! is_array( $images ) )
                      show_404('admin');  

              foreach ($images as &$value ) 
                 $value['foto'] =  photoCheckUser($value);

              $data['images'] = $images;
              $this->load->view('admin_hepgezelim/include/header',$data);      // load views
              $this->load->view("admin_hepgezelim/admin_main/user_photo_view",$data);
              $this->load->view('admin_hepgezelim/include/footer');            // load views  
        }

        
        /**
         * Load view   get approval images consider them
         * 
         * @param $OFFSET  select data from users start point 
         * @return  HTML view
        **/    
        function user_photo_approval_view( $OFFSET ){  
              $data   =  $this->admin->loginKontrol();                           // check admin logged in

              if( !is_numeric( $OFFSET ) || $OFFSET < 0 )
                   $OFFSET = 0;
              

              $LIMIT = 50;
              $images =  $this->admin_db->GetUserImagesApproval( $LIMIT, $OFFSET );
              if(  ! is_array( $images ) ) 
                      show_404('admin');  
             
              foreach ($images as &$value ) 
                 $value['foto'] =  photoCheckUser($value);

              $data['LIMIT'] =   $LIMIT; 
              $data['OFFSET'] = $OFFSET + $LIMIT;          
              $data['images'] = $images;
              $this->load->view('admin_hepgezelim/include/header',$data);      // load views
              $this->load->view("admin_hepgezelim/admin_main2/user_photo_approval_view",$data);
              $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }

  
        /**
         * Load view  message notification consider the message if required add ban user
         *  
         * @return  HTML view
        **/    
        public function alert_user_view(){  
               $data =  $this->admin->loginKontrol();                           // check admin logged in 
               
               $alerts =  $this->admin_db->GetAlerts();
               if(  ! is_array( $alerts ) )
                      show_404('admin');  

               $data['alerts'] = $alerts;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/alert_user_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views  
        }
         

        /**
         * Load view that banned users
         *  
         * @return  HTML view
        **/    
        public function banned_user_view( $OFFSET = 0 ){
               $data =  $this->admin->loginKontrol();                           // check admin logged in 
                

               if( !isset( $OFFSET ) || $OFFSET < 0 )
                   $OFFSET = 0;

               $LIMIT = 50;
               $bans =  $this->admin_db->GetBannedUsers( $LIMIT , $OFFSET );
               if(  ! is_array( $bans ) )
                      show_404('admin');  

               foreach ($bans as &$value ) 
                    $value['foto'] =  photoCheckUser($value);

               $data['LIMIT']  = $LIMIT; 
               $data['OFFSET'] = $OFFSET + $LIMIT;   
               $data['bans']   = $bans;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/banned_user_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views     
        } 

        /**
         * Load view  complain users
         *  
         * @return  HTML view
        **/    
        public function complain_user_view(){  
               $data =  $this->admin->loginKontrol();                           // check admin logged in 
                
                
               $complains =  $this->admin_db->GetComplains();
               if(  ! is_array( $complains ) )
                      show_404('admin');  

               $data['complains'] = $complains;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/complain_user_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }
          
        /**
         * Load view  contacts result
         *  
         * @return  HTML view
        **/    
        public function contact_view(){  
               $data =  $this->admin->loginKontrol();                           // check admin logged in
                
                 
               $contacts =  $this->admin_db->GetContacts();
               if(  ! is_array( $contacts ) )
                      show_404('admin');  

               $data['contacts'] = $contacts;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/contact_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }
        
        /**
         * Load view  contacts result
         *  
         * @return  HTML view
        **/    
        public function content_contact_view( $ISSUE_URL ){  
               $data =  $this->admin->loginKontrol();                           // check admin logged in
                

               if( !isset($ISSUE_URL) )
                   $ISSUE_URL = "diger";  

               $contents =  $this->admin_db->GetContactContents( $ISSUE_URL );
               if(  ! is_array( $contents ) )
                      show_404('admin');  
               
               $data['contents'] = $contents;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main2/content_contact_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }

 
        /**
         * Load view delete acount reasons
         *  
         * @return HTML view
        **/    
        public function delete_acount_view(){  
               $data =  $this->admin->loginKontrol();                           // check admin logged in
               
               
               $reasons =  $this->admin_db->GetDeleteAcountReasons( );
               if(  ! is_array( $reasons ) )
                      show_404('admin');  
               
               $data['reasons'] = $reasons;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/delete_acount_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }

        /**
         * Load view  HTML get problems  
         *
         * @return  HTML view
        **/    
        public function problem_view(){  
               $data =  $this->admin->loginKontrol();                           // check admin logged in 
               

               $problems =  $this->admin_db->GetProblems( );
               if(  ! is_array( $problems ) )
                      show_404('admin');  
               
               $data['problems'] = $problems;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/problem_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }
		
		/**
         * Load view  HTML get user reviews  
         *
         * @return  HTML view
        **/    
        public function user_review_view( $user_id ){
        	   $data =  $this->admin->loginKontrol();                           // check admin logged in 
                
               if( !isset( $user_id ) ) 
			         show_404('admin');
			   
			   $user_id = my_decode( $user_id );  
               
               $this->load->model('ratings_db');
			   $this->load->model('users');
			   
               $reviews =  $this->ratings_db->GetUserGivenRatingsWithUser( $user_id );
			   $user    =  $this->users->GetUser( $user_id ); 
               if(  ! is_array( $reviews ) || !is_array( $user ) || count($user ) == 0 )
                      show_404('admin');  
               
               $data['reviews'] = $reviews;
			   $data['user']    = $user;
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view("admin_hepgezelim/admin_main/user_review_view",$data);
               $this->load->view('admin_hepgezelim/include/footer');            // load views 
        }

      /******************************** END OF THE DONE **********************************/
      /******************************  AJAX  FUNCTIONS   ***********************************/
      /******************************  AJAX  FUNCTIONS   ***********************************/
      /******************************  AJAX  FUNCTIONS   ***********************************/
      /************************************** DONE ***************************************/
        
        
        
        /**
          *  AJAX function
          *  Delete Review process  
          *  
          *  @return   JSON output
         **/      
        public function delete_review(){
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $rating_id    = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $this->load->model('ratings_db');
                      $result       = $this->ratings_db->delete( $rating_id );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("ac.$status");
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
          *  AJAX function
          *  Problem readed  
          *  
          *  @return   JSON output
         **/      
        public function problem_readed_process(){
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $id           = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $table        = "problems";
                      $update_data  = array('is_read' => 1 );
                      $result       = $this->admin_db->update($table , $id , $update_data );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("ac.$status");
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
          *  AJAX function
          *  Delete acount reasons  content readed  
          *  
          *  @return   JSON output
         **/      
        public function delete_acount_readed_process(){
              $this->admin->loginKontrol2();                                                  // check admin logged in
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $id           = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $table        = "delete_acount";
                      $update_data  = array('is_read' => 1 );
                      $result       = $this->admin_db->update($table , $id , $update_data );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("ac.$status");
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
          *  AJAX function
          *  Contact   add readed for table 
          *  
          *  @return   JSON output
         **/      
        public function contact_readed_process(){
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $id           = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $table        = "contact";
                      $update_data  = array('is_read' => 1 );
                      $result       = $this->admin_db->update($table , $id , $update_data );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("ac.$status");
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
          *  AJAX function
          *  Complain user add readed for table 
          *  
          *  @return   JSON output
         **/      
        public function complain_user_readed_process(){
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $id           = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $table        = "complain";
                      $update_data  = array('is_read' => 1 );
                      $result       = $this->admin_db->update($table , $id , $update_data );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("ac.$status");
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
          *  AJAX function
          *  Alert user ban user process
          *  
          *  @return   JSON output
         **/      
        public function user_ban_process(){
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,     'id',      'required|xss_clean');        // check post data
              $this->form->check(lang('ac.process') ,'process', 'required|alpha|xss_clean');  // check post data
              if( $this->form->get_result() ){                                        
                      $id           = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $process      = $this->input->post('process', TRUE);
                      $table        = "users";
                     
                      if(  strcmp($process, "add") == 0 ){
                          $update_data  = array('ban' => 1 );
                          $result       = $this->admin_db->update($table , $id , $update_data );
                          $status       = ( $result == TRUE) ?  'success' : 'fail';
                          $text         = lang("ac.$status");
                      }
                      else if(  strcmp($process, "remove") == 0 ){
                          $update_data  = array('ban' => 0 );
                          $result       = $this->admin_db->update($table , $id , $update_data );
                          $status       = ( $result == TRUE) ?  'success' : 'fail';
                          $text         = lang("ac.$status");
                      }
                      else{
                             $status = "fail";
                             $text = lang("ac.wrong-process"); 
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
       
        /**
          *  AJAX function
          *  Alert user add warn user process
          *  
          *  @return   JSON output
         **/      
        public function user_warn_process(){
              $this->admin->loginKontrol2();                                                            // check admin logged in
             

              $this->form->check(lang('ac.id') ,     'user_id',      'required|xss_clean');        // check post data
              $this->form->check(lang('ac.message'), 'message',      'required|max_length[300]|xss_clean');             // check post data
              $this->form->check(lang('ac.message'), 'message_en',   'required|max_length[300]|xss_clean');             // check post data
              $this->form->check(lang('ac.type'),    'type',         'required|alpha|xss_clean');             // check post data
              if( $this->form->get_result() ){                                        
                      $admin_id     = $this->encrypt->decode( $this->session->userdata('admin_userid')     );
                      $user_id      = my_decode( $this->input->post('user_id', TRUE) );                  // decode car id 
                      $message      =   $this->input->post('message', TRUE) ;                            // decode car id 
                      $message_en   =   $this->input->post('message_en', TRUE) ;                            // decode car id 
                      $type         =   $this->input->post('type', TRUE) ;                            // decode car id 
                      
                      $warning      = array( 'user_id'    => $user_id, 
                                             'warning'    => $message, 
                                             'warning_en' => $message_en,
                                             'admin_id'   => $admin_id, 
                                             'type'       => $type );
                      $result       = $this->admin_db->addWarning( $warning );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $status         = "success";
                      $text           = lang("ac.$status");
                         
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
          *  AJAX function
          *  Alert user add readed for table 
          *  
          *  @return   JSON output
         **/      
        public function alert_user_readed_process(){
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              if( $this->form->get_result() ){                                        
                      $id           = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $table        = "alert_user";
                      $update_data  = array('is_read' => 1 );
                      $result       = $this->admin_db->update($table , $id , $update_data );
                      
                      $status       = ( $result == TRUE) ?  'success' : 'fail';
                      $text         = lang("ac.$status");
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
          *  AJAX function
          *  CAr photo is it valid or invalid 
          *  
          *  @return   JSON output
         **/ 
        public function user_foto_process(){  
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              $this->form->check(lang('ac.process') ,'process', 'required|alpha|xss_clean');  // check post data
              if( $this->form->get_result() ){                                        
                      $id      = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $process = $this->input->post('process', TRUE);
                       
                      $this->load->model('users');
                                                  
                      // invalid kısmı tamamlandı
                      if( strcmp($process, 'invalid') == 0 ){
                             $user  = $this->admin_db->GetUser( $id );

                             if( is_array($user) ){
                                     if( count($user) > 0 ){
                                                  $array = explode('/', $user['foto'] );                                         // split image url pattern '/'
                                                  $file_name = $array[ count($array)-1 ];                                   // array last element is file name
                        
                                                  $path   = realpath( new_getcwd()."/assets/");                                          // get path for upload  
                                                  // if user photo is not default photo remove it from directory
                                                  if( strcmp($file_name, 'male.png') != 0 && strcmp($file_name, 'female.png') != 0 && file_exists( realpath( $path.'/'. $file_name) ))
                                                       unlink( realpath( $path.'/'. $file_name ) );                   
                                                  
                                                  $foto  =  get_path() .'assets/';
                                                  $foto .= ($user['sex'] == 1) ? 'male.png':'female.png'; 
                                                  $user = array(  'foto' => $foto, 'foto_onay' => 1, 'foto_exist' => 0 );                      // change photo onay info
                                                  $result = $this->users->update($id,$user);                                // update user  
                          
                                                  $status = ( $result == TRUE) ?  'success' : 'fail';
                                                  $text   = lang("ac.$status");
                                     } 
                                     else{
                                           $status = "fail";
                                           $text = lang("ac.not-exist");    
                                     }
                              }else{
                                     $status = "fail";
                                     $text = lang("fail");       
                               }
                      }
                      else if( strcmp($process, "valid") == 0){
                              $user = array(  'foto_onay' => 1, 'foto_exist' => 1 );                      // change photo onay info
                              $result = $this->users->update($id,$user); 
                              $status = ( $result == TRUE) ?  'success' : 'fail';
                              $text   = lang("ac.$status");
                                     
                      }
                      else{
                             $status = "fail";
                             $text = lang("ac.wrong-process"); 
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

        /**
          *  AJAX function
          *  CAr photo is it valid or invalid 
          *  
          *  @return   JSON output
         **/ 
        public function car_foto_process(){  
              $this->admin->loginKontrol2();                                                  // check admin logged in 
             

              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              $this->form->check(lang('ac.process') ,'process', 'required|alpha|xss_clean');  // check post data
              if( $this->form->get_result() ){                                        
                      $id      = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $process = $this->input->post('process', TRUE);
                      
                      $this->load->model('cars');
                      
                      // invalid kısmı tamamlandı
                      if( strcmp($process, 'invalid') == 0 ){
                             $car  = $this->cars->GetCar( $id );
                             if( is_array($car) ){
                                     if( count($car) > 0 ){
                                                 $path    = realpath( new_getcwd()."/cars/");           // get path
                                                 $new_car = array('foto_name' => "car.png", 'foto_onay' => 1, 'foto_exist' => 0 );
                                                 $result = $this->cars->Update($id, $new_car);
                                                 if( $result ){
                                                     $file_name = $car['foto_name'];                                                              // car photo name
                                                     if( strcmp($file_name, 'car.png') != 0  && file_exists( realpath( $path.'/'. $file_name) ) ) // is exist car image if there is remove it
                                                          unlink( realpath( $path.'/'. $file_name ) );  
                                                 }
                                                 $status = ( $result == TRUE) ?  'success' : 'fail';
                                                 $text   = lang("ac.$status");
                                     } 
                                     else{
                                           $status = "fail";
                                           $text = lang("ac.not-exist");    
                                     }
                              }else{
                                     $status = "fail";
                                     $text = lang("fail");       
                               }
                      }
                      else if( strcmp($process, "valid") == 0){
                              $new_car = array( 'foto_onay' => 1, 'foto_exist' => 1 );
                              $result = $this->cars->Update($id, $new_car);
                              $status = ( $result == TRUE) ?  'success' : 'fail';
                              $text   = lang("ac.$status");
                                     
                      }
                      else{
                             $status = "fail";
                             $text = lang("ac.wrong-process"); 
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
             
        /**
         *  AJAX function
         *  Check post data are they a user data if it is set sessıon admin data  
         *  @return  JSON object
        **/ 
        public function loginProcess(){  
            //$this->admin->loginKontrol2();           // check admin logged in 
           
            
            $this->form->check( lang('ac.username'), 'username', 'required|alpha_numeric|max_length[50]|xss_clean');   // check post data       
            $this->form->check( lang('ac.password'), 'password',  'required|alpha_numeric|max_length[50]|xss_clean');   // check post data       
            if( $this->form->get_result() ){       
                 $post_pass     =     $this->input->post('password',TRUE);                         // user password    
                 $post_username =    $this->input->post('username',TRUE);                            // user email adress
                 $result = $this->admin_db->Login($username = $post_username , $password = $post_pass); // if password and email matches from database return user otherwise return false 
                 if($result){
                         if($result['is_active'] == '1'){                                          // create user information set for session
                               $userdata = array( 'admin_userid'       =>  $this->encrypt->encode( $result['id']          ),
                                                  'admin_username'     =>  $this->encrypt->encode( $result['username']    ), 
                                                  'admin_logged_in'    =>  TRUE   );
                               $this->session->set_userdata($userdata);                          // start session and set data
                               $status =  "login";                                         
                          }
                          else{
                               $status =  "fail";
                               $text   =  lang('ac.not-active'); 
                          }
                 }
                 else{
                     $status = "fail";
                     $text   =  lang('ac.wrong-username');
                 }
            }
            else
                    $status = "error";
            $error = $this->form->get_error();                       //  if there is error get it from Form validation class           
            $result = array( 'status'  => $status, 
                             'text'    => isset($text) ? $text : "",
                             'message' => $error['message'] );       // JSON output
            echo json_encode($result);                               // JSON output  
        } 

        /**
         *  Method fo sessıon destroy log out process
         *  Log out process
         * 
         *  @return  Redirect Main page
        **/ 
        public function logoutProcess(){  
               $this->admin->loginKontrol2();                      // check admin logged in
               $newdata = array(  'admin_userid'      =>  '',
                                  'admin_username'    =>  '', 
                                  'admin_logged_in'   => FALSE );
               $this->session->unset_userdata($newdata);              // session destroy  
               $this->session->sess_destroy();
               redirect('admin_hepgezelim/'); 
        } 

}// END of the Admin_Hepgezelim Class
/**
 * End of the file Admin_Hepgezelim.php
 **/