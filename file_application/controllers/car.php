<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * Car Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Car extends CI_Controller {
        
         /**
          * Constructor
         **/
         public function __construct(){
                parent::__construct();
                $this->load->model('cars');                      // load cars model for database action 
         }

        /**
         *  AJAX function 
         *  Araç silme metodu
         *   
         *  @return JSON status : success, fail, error
        **/  
        public function delete(){
             $this->login->loginKontrol2();                                  // login control for ajax 
             $this->lang->load('car_controller');                            // load car_controller language file
             $this->form->check(lang('c.car') ,'id', 'required|xss_clean');  // check post data
             if( $this->form->get_result() ){                                        
                     $post_id =  $this->input->post('id', TRUE);             // encrypted car id
                     $id = $this->encrypt->decode( $post_id );               // decode car id 
                     $result = $this->cars->checkCar( $id );
                     if( is_array($result) && count($result) == 0 ){
                            if( strcmp($id, '0') != 0 ){    
                                   $path   = realpath(getcwd()."/cars/");           // get path
                                   $car =  $this->cars->GetCar($id);                // get car info for delete image if it is not default  
                                   if($car){
                                       $file_name = $car['foto_name'];                                                              // car photo name
                                       if( strcmp($file_name, 'car.png') != 0  && file_exists( realpath( $path.'/'. $file_name) ) ) // is exist car image if there is remove it
                                            unlink( realpath( $path.'/'. $file_name ) );  
                                   }
                                   $result = $this->cars->delete($id);      // delete car from database
                                  if( $result == TRUE) 
                                      $status = 'success';
                                  else
                                      $status = 'fail';
                            }
                            else
                                  $status = "fail";
                      }else{
                         $status = "fail";
                         $text = lang("c.using");       
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
         *  Araç güncelleme işlemi
         *  
         *  @return   JSON output status: success, fail, error
        **/  
        public function updateAction(){
            
                $this->login->loginKontrol2();          // login control for ajax 
                $this->lang->load('car_controller');    // load car_controller language file
                $this->form->check(lang('c.car')        ,'carid',      'required|xss_clean');                                                  // check post data       
                $this->form->check(lang('c.make')       ,'make',       'required|max_length[30]|xss_clean');                                   // check post data       
                $this->form->check(lang('c.model')      ,'model',      'required|max_length[30]|xss_clean');                                   // check post data       
                $this->form->check(lang('c.comfort')    ,'comfort',    'required|is_natural_no_zero|greater_than[0]|less_than[6]|xss_clean');  // check post data       
                $this->form->check(lang('c.seat_count') ,'seat_count', 'required|is_natural_no_zero|greater_than[1]|less_than[8]|xss_clean');  // check post data       
                $this->form->check(lang('c.colour')     ,'colour',     'max_length[30]|xss_clean');                                            // check post data       
                if( $this->form->get_result() ){     
                        $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );           // decode userid    
                        $carid =  $this->encrypt->decode( $this->input->post('carid', TRUE) );             // encypted carid   
                        $car = array(   'make'             =>  $this->input->post('make'      , TRUE),     // create new car model
                                        'model'            =>  $this->input->post('model'     , TRUE),
                                        'comfort'          =>  $this->input->post('comfort'   , TRUE), 
                                        'number_of_seats'  =>  $this->input->post('seat_count', TRUE),
                                        'colour'           =>  $this->input->post('colour'    , TRUE ),
                                     ); 
                      
                       $result =  $this->cars->update($carid , $car);          // update car on databse 
                       if( $result == TRUE)                               
                           $status = 'success';
                       else
                           $status = 'fail';
                }
                else
                    $status = "error";
               $error = $this->form->get_error();                        //  if there is error get it from Form validation class           
               $result = array( 'status'  => $status, 
                                'message' => $error['message'] );       // JSON output
               echo json_encode($result);                               // JSON output 
        }   
        
        /**
         *  AJAX function
         *  Yeni araç ekleme işlemi
         *   
         *  @return JSON output status : success, fail, error
        **/  
        public function addAction(){  
              $this->login->loginKontrol2();          // login control for ajax 
              $this->lang->load('car_controller');    // load car_controller language file
              $this->form->check(lang('c.make')       ,'make',       'required|max_length[30]|xss_clean');                                    // check post data       
              $this->form->check(lang('c.model')      ,'model',      'required|max_length[30]|xss_clean');                                    // check post data       
              $this->form->check(lang('c.comfort')    ,'comfort',    'required|is_natural_no_zero|greater_than[0]|less_than[6]|xss_clean');   // check post data       
              $this->form->check(lang('c.seat_count') ,'seat_count', 'required|is_natural_no_zero|greater_than[1]|less_than[8]|xss_clean');   // check post data       
              $this->form->check(lang('c.colour')     ,'colour',     'max_length[30]|xss_clean');                                             // check post data       
              if( $this->form->get_result() ){     
                     $userid = $this->encrypt->decode( $this->session->userdata( 'userid') );     // decode userid      
                     $car = array(   'user_id'          =>  $userid,                              // create new car model    
                                     'foto_name'        =>  'car.png',
                                     'make'             =>  $this->input->post('make'      , TRUE), 
                                     'model'            =>  $this->input->post('model'     , TRUE),
                                     'comfort'          =>  $this->input->post('comfort'   , TRUE), 
                                     'number_of_seats'  =>  $this->input->post('seat_count', TRUE),
                                     'colour'           =>  $this->input->post('colour'    , TRUE),
                                     'type'             => "",
                                     'explain'          => ""  ); 
                        
                      $car_id =  $this->cars->Add($car);                                           // add new car model to database  
                      if( $car_id == TRUE) 
                          $status = 'success';
                      else
                          $status = 'fail';
              }
              else
                    $status = "error";
              $error = $this->form->get_error();                        //  if there is error get it from Form validation class           
              $result = array( 'status'  => $status, 
                               'message' => $error['message'] );       // JSON output
              echo json_encode($result);                               // JSON output  
        }

        /*********************************  Functions for views *********************************************************************/ 
        
        /**
         *  Yeni araç ekleme sayfası 
         *   
         *  @return  HTML  views
        **/  
        public function add(){
                $data = $this->login->loginKontrol();                                    // does user login or not
                $userid = $this->encrypt->decode( $this->session->userdata( 'userid') ); // decode userid 
                $data['active'] = '#profile';                                            // active profile menu
                $data['active_side'] = '#cars';                                          // active side bar menu
                $viewContent =  'profile/carAdd';                                        // load views
                $viewHead    =  'profile/profileHead';
                $viewFoot    =  'profile/profileFoot';                
                $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot);          // load views
        }  
         
        /**
         *  Araç güncelleme sayfası
         *
         *  @param  $carid şifreli araç id
         *  @return HTML view
        **/  
        public function update( $carid ){
                $data = $this->login->loginKontrol( );                                   // does user login or not
                $userid = $this->encrypt->decode( $this->session->userdata( 'userid') ); // decode userid 
                $data['active'] = '#profile';                                            // active profile menu
                $carid =  base64_decode( urldecode( $carid ) );                          // encrypted car id from usrl segment four
                $data['active_side'] = '#cars';                                          // active side bar menu
                $car =  $this->cars->GetCar($carid);                                     // get car info from database 
                if( is_array( $car) && count($car ) > 0 ){
                       $car['id'] = $this->encrypt->encode( $car['id'] );                // encrypt carid
                       $data['car'] = $car;                                              // send car information to view
                       $viewContent =  'profile/carUpdate';                              // views name
                       $viewHead    =  'profile/profileHead';
                       $viewFoot    =  'profile/profileFoot';                
                       $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot); // load views
                }
                else{
                     show_404('hata');                                                       // redirect user's cars list
                }     
        }
        
        /**
          *  Araç resmi yükleme sayfası
          *  
          *  @param  $carid şifreli araç id
          *  @return  HTML view
         **/  
         public function upload( $carid ){
                $data = $this->login->loginKontrol( );                                   // does user login or not
                $userid = $this->encrypt->decode( $this->session->userdata( 'userid') ); // decode userid 
                $data['active'] = '#profile';                                            // active profile menu
                $carid =  base64_decode( urldecode(  $carid ) );    // encypted car id from url  
                $data['active_side'] = '#cars';                                          // active side bar menu
                $car =  $this->cars->GetCar($carid);                                     // get car info from database
                if( is_array($car) && count($car) > 0 ){ 
                    $path   = realpath(getcwd()."/cars/");                                   // create path
                    $file_name = $car['foto_name'];                                          // car photo name
                    $data['carid'] = $this->uri->segment(4);                                 // encrypted car id from usrl segment four 
                    if( file_exists( realpath( $path.'/'. $file_name) ))                     // is exist car image if there is use it otherwise use default       
                        $data['carfotoname'] = base_url(). 'cars/'.$car['foto_name'];
                    else
                         $data['carfotoname'] = base_url(). 'cars/car.png';

                    $viewContent =  'profile/carUpload';                                // Load views
                    $viewHead    =  'profile/profileHead';
                    $viewFoot    =  'profile/profileFoot';                
                    $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot);     // loading other  views   
                }else{
                    show_404('hata');
                }  
         }
          
        /**
         *  Araç resmi yükleme işlemi
         *
         *  @param  $carid şifreli araç id
         *  @return  HTML view
        **/  
         public function uploadAction( $carid ){
                   $data = $this->login->loginKontrol( );                                   // check user does login
                   $this->lang->load('car_controller');                                     // load car_controller language file
                   $data['active_side'] = '#cars';                                          // active side bar menu
                   $userid = $this->encrypt->decode( $this->session->userdata( 'userid') ); // decode user id
                   
                   $path   = realpath(getcwd()."/cars/");         // create path for upload
                   $config['upload_path'] = $path;                // upload path  
                   $config['allowed_types'] = 'jpg|png|JPG|PNG';  // allowed file types 
                   $config['max_size']  = '100';                  // maximum size
                   $config['max_width']  = '600';                 // maximum height 
                   $config['max_height']  = '600';                // maximum width
                    

                   $this->load->library('upload', $config);                               // load upload library with my config  
                   if( $this->upload->do_upload() ){                                      // starting upload 
                           $success = array('upload_data' => $this->upload->data());      // upload information   
                           $zfile = $success['upload_data']['full_path'];                 // get file path
                           chmod($zfile,0777);                                            // CHMOD file     
                           $foto =  $success['upload_data']['raw_name'] . $success['upload_data']['file_ext'] ;         // foto url  
                           $carid =  base64_decode( urldecode( $carid ) );                        // car id from url
                           $car =  $this->cars->GetCar($carid);                                                         // get car information
                           if( is_array($car) && count($car) > 0 ){ 

                                 $file_name = $car['foto_name'];                                                              // car photo name
                                 if( strcmp($file_name, 'car.png') != 0  && file_exists( realpath( $path.'/'. $file_name) ) ) // old image if is exist remove it  
                                      unlink( realpath( $path.'/'. $file_name ) );           
                                 $car = array(  'foto_name' => $foto, 'foto_onay' => 0 );     // updating car info
                                 $result =  $this->cars->update($carid , $car);               // update car image url on database
                                 $data['active'] = '#profile';                                // active profile menu 
                                 if($result){
                                        $type= 'success';                                     // alert type
                                        $title = lang("c.tebrik");                            // alert title 
                                        $content = lang("c.savesuccess");                     // alert content 
                                        $data['result'] = alertWide($type, $title, $content); // send alert to view
                                        $data['error'] = $success;
                                  }
                                  else{
                                        $type= 'danger';                                      // alert type
                                        $title = lang('c.sory');                              // alert title 
                                        $content = lang('c.updatefail');                      // alert content 
                                        $data['result'] = alertWide($type, $title, $content); // send alert to view
                                  }
                                  $viewHead    =  'profile/profileHead';                      // load views
                                  $viewContent =  'profile/cars';
                                  $viewFoot    =  'profile/profileFoot';  
                                  $cars = $this->cars->GetUserCars($userid);                   // get user cars
                                  if( is_array($cars) ){
                                       foreach ($cars as &$value){                               
                                           $value['normalid'] =   $value['id'] ;                    // create new collumn
                                           $value['id'] =  $this->encrypt->encode( $value['id'] );  // encrypt car id for security
                                           $path   = realpath(getcwd()."/cars/");                   // get path
                                           $file_name = $value['foto_name'];                        // car photo name
                                           if( file_exists( realpath( $path.'/'. $file_name) ))     // is exist car image if there is use it otherwise use default one   
                                               $value['foto_name'] = $value['foto_name'];              
                                           else
                                               $value['foto_name'] = 'car.png';
                                       }
                                       $data['cars'] = $cars;                                          // send cars to view
                                       $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot); // loadviews for success page  
                                  }else{
                                    show_404('hata');
                                  }
                                        
                            }else{
                                  show_404('hata');
                            }      
                 }                                                                 // upload failed
                 else{
                       $error = array('error' => $this->upload->display_errors()); // send errors to view
                       $data = $this->login->loginKontrol( );                      // bring login data
                       $data['active'] = '#profile';                               // active profile menu
                       $type= 'danger';                                            // Type of allert                 
                       $title = lang('c.sory');                                    // alert tittle 
                       $content = $error['error'];                                 // error message
                       $data['result'] = alertWide($type, $title, $content);       // send alert to view
                       $data['error'] = $error;                                
                       $viewHead    =  'profile/profileHead';                      // Load views
                       $viewContent =  'profile/cars';
                       $viewFoot    =  'profile/profileFoot';  
                       $cars = $this->cars->GetUserCars($userid);                  // get user cars
                       if( is_array($cars) ){
                            foreach ($cars as &$value){ 
                                $value['normalid'] =   $value['id'] ;                   // create new column 
                                $value['id'] =  $this->encrypt->encode( $value['id'] ); // encode car id
                                $path   = realpath(getcwd()."/cars/");                  // get path
                                $file_name = $value['foto_name'];                       // car photo name      
                                if( file_exists( realpath( $path.'/'. $file_name) ))    // is exist car image if there is use it otherwise use default one
                                    $value['foto_name'] = $value['foto_name'];
                                else
                                     $value['foto_name'] = 'car.png';
                            }
                            $data['cars'] = $cars;                                           // Send cars to view 
                            $this->loadProfil( $data , $viewHead, $viewContent, $viewFoot);  // call private function for loa dviews
                        }else{
                             show_404('hata');
                        }    
                }   
         } 


        /****************  Private methods for using each method        ************************************/

        /**
         *  Load views 
         *  @param    DATA,HEAD,CONTENT,FOOT
         *  @return  HTML view 
        **/  
        private function loadProfil( $data = array(), $viewHead, $viewContent, $viewFoot ){
                 $this->login->loadViewHead( $data);         // Call login class function       
                 $this->load->view('profil/'.$viewHead );    // Load views    
                 $this->load->view('profil/'.$viewContent);  // Load views
                 $this->load->view('profil/'.$viewFoot );    // Load views 
                 $this->login->loadViewHeadFoot();           // Call login class function  
        }

} // END of the Car class
/* 
 *  End of the file 
 */
    