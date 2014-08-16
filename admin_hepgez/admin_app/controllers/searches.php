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

class Searches extends CI_Controller {
       
        /**
          * Constructor
         **/
         public function __construct(){
                parent::__construct();
              
			    // sunucuda zaman geri olduğu için
                date_default_timezone_set('Europe/Istanbul');  
         
                $this->load->model("searched");     // load model file 
         }

     /************************************** DONE ***************************************/    
      
        /**
         * Load view   home page 
         *
         * @return  HTML home view
        **/    
	   public function index(){  
               $data = $this->admin->loginKontrol();                            // check admin logged in
               $this->lang->load("search");                                     // load language file 
               
              
               $searched =  $this->searched->GetSearchNotActive();
               if(  ! is_array( $searched ) )
                      show_404('admin');  
              
 
              
               $data['searched'] = $searched;
			  
               $this->load->view('admin_hepgezelim/include/header',$data);      // load views
               $this->load->view('search/new');                                 // load views
               $this->load->view('admin_hepgezelim/include/footer');            // load views
	   }
		  
		/**
          *  AJAX function
          *  CAr photo is it valid or invalid 
          *  
          *  @return   JSON output
         **/ 
        public function search_process(){  
              $this->admin->loginKontrol2();                                                  // check admin logged in 
              $this->form->check(lang('ac.id') ,    'id',      'required|xss_clean');        // check post data
              $this->form->check(lang('ac.process') ,'process', 'required|alpha|xss_clean');  // check post data
              if( $this->form->get_result() ){                                        
                      $id      = my_decode( $this->input->post('id', TRUE) );                  // decode car id 
                      $process = $this->input->post('process', TRUE);
                      $this->load->model("admin_db");
                      // invalid kısmı tamamlandı
                      
                      if( strcmp($process, 'valid') == 0 ){
                           $table        = "searched";
                           $update_data  = array('is_active' => 1 );
                           $result       = $this->admin_db->update($table , $id , $update_data );
                           $status       = ( $result == TRUE) ?  'success' : 'fail';
                           $text         = lang("ac.$status");      
                      }
                      else if( strcmp($process, "invalid") == 0){
                           $table        = "searched"; 
                           $result       = $this->admin_db->delete($table , $id );
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
		  
}
