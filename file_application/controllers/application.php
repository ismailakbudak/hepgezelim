<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * Application Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Application extends CI_Controller {
       
        /**
          * Constructor
         **/
         public function __construct(){
                parent::__construct();
			   }

       /**
        *  Şartlar-Koşullar sayfasını yükler
        *  
        *  @return  HTML view
       **/    
	     public function terms(){  
               $this->login->general();                     // load views
               $this->load->view('application/terms');      // load views
               $this->load->view('include/footer');         // load views
	      }
       
       /**
        *   Gizlilik sayfasını yükler
        *
        *   @return HTML view
       **/    
       public function privacy(){  
               $this->login->general();                       // load views
               $this->load->view('application/privacy');      // load views
               $this->load->view('include/footer');           // load views
       }
       
       /**
        * Site içindeki kullanıcı seviyesi bilgi sayfasını yükler
        *  
        * @return HTML view
       **/    
       public function level(){
              
               $this->lang->load("level");              // load language file
               $this->login->general();                 // load views
               $this->load->view('application/level');  // load views
               $this->load->view('include/footer');     // load views
       }
      
      /**
        *  AJAX function
        *  Yeni problem ekleme metodu
        *  
        *  @return JSON output status: success, fail, error
       **/
       public function problem(){
             $this->form->check(lang('g.problemName') ,  'problem', 'required|min_length[20]|max_length[500]|xss_clean');  // check post data
             $this->form->check(lang('g.emailName') ,    'email',   'max_length[70]|xss_clean');                           // check post data
             if( $this->form->get_result() ){                                        
                      
                      // prepare contact model for database
                      $problem = array( 'problem'   => $this->input->post('problem',     TRUE), 
                                        'email'     => $this->input->post('email',     TRUE)  );
                    
                      // Save model to contact database
                      $this->load->model('contacts');
                      $result = $this->contacts->AddProblem($problem);
                      if( $result )
                          $status = "success";
                      else
                          $status = "fail";
                      $text = ($result == TRUE) ? lang('g.successAddProblem') : lang("g.failAddProblem"); 
             }       
             else
                 $status = "error";

             $error = $this->form->get_error();  
             $result = array( 'status'  => $status, 
                              'text'    => isset($text) ? $text :"",
                              'message' => $error['message'] );          // JSON output
             echo json_encode($result);                                  // JSON output
       }

}// END of the Application Class
/**
 * End of the file Application.php
 **/