<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * Alert Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Alert extends CI_Controller {
    
    /**
     *   global değişkenler
    **/         
     public $user_id, $data;

    /**
     *  Constructor
    **/    
    public function __construct(){
         parent::__construct();    
         $this->data           = $this->login->loginKontrol();                                     // check user_login
         $this->user_id        = $this->encrypt->decode( $this->session->userdata( 'userid') );    // set global variable user_id
         $this->load->model('email_alerts');                                                       // load email alerts model for database action   
    }

    /** 
     *   Bildirimlerin anasayfası yüklenir
     *
     *   @return HTML view
    **/
    public function index(){
                $this->lang->load('alert');                                        // load language file
                $this->data['active'] = '#allerts';	                               // Active part      
                $alerts = $this->email_alerts->GetEmailAlerts( $this->user_id );   // Get email alerts
                if( is_array($alerts) ){
                    $this->data['alerts'] = $alerts;
                    $this->login->loadViewHead( $this->data);                      // Load view upper  
                    $this->load->view('alert/alerts');                             // Load view for content
                    $this->login->loadViewHeadFoot();                              // Load view for footer 
                }
                else{
                    show_404('hata'); 
                }    
    }

    /**
     *  AJAX function 
     *  Bildirim oluşturma metodu
     * 
     *  @return JSON output status: succuss, fail, error
    **/
    public function createAlert(){
           $this->login->loginKontrol2();
           $this->lang->load('alert');                                                                      // load language file
           $this->form->check( lang('a.date') ,'date', 'required|is_date|exact_length[10]|xss_clean');      // check post data
           if( $this->form->get_result() ){ 
                if( $this->session->userdata('offerAlertSave') == 0 ){                                       
                      if( $this->session->userdata('offerInfo') ){
                             
                             $flag = TRUE;
                             $destinationStatus  = $this->session->userdata('destinationStatus' );          // get GET[] data from URL                 
                             $originStatus       = $this->session->userdata('originStatus'      );          // get GET[] data from URL    
                             $origin             = $this->session->userdata('origin'            );
                             $destination        = $this->session->userdata('destination'       );
                             $dLat               = $this->session->userdata('dLat');
                             $dLng               = $this->session->userdata('dLng'); 
                             if( strcmp($originStatus, "1") != 0 || strcmp($origin, "") == 0  ){             // check origin point is set
                                 $flag = FALSE;
                             }
                             if( strcmp($destinationStatus,"1") != 0 || strcmp($destination, "") == 0 ){     // check destination data is set
                                $destination       = "-1";
                                $destinationStatus = "-1";
                                $dLng              = "-1";
                                $dLat              = "-1";
                             }
                             
                             if( $flag ){
                                   $alert = array( 'user_id'           => $this->user_id, 
                                                   'place1'            => $this->session->userdata('place1' ),
                                                   'place2'            => $this->session->userdata('place2' ),
                                                   'date'              => $this->input->post('date',   TRUE ),
                                                   'origin'            => $origin,     
                                                   'lat'               => $this->session->userdata('lat'    ),     
                                                   'lng'               => $this->session->userdata('lng'    ),     
                                                   'destination'       => $destination,     
                                                   'dLat'              => $dLat,     
                                                   'dLng'              => $dLng   );  
                                    $status = "success";
                                    $result = $this->email_alerts->add( $alert );
                                    $text   = $result ?  lang("a.success") : lang('a.error');  
                                    if( $result ){
                                         $searchData =  array( 'offerAlertSave'    => 1 ); 
                                         $this->session->set_userdata($searchData);
                                    }  
                             }else{
                                   $status = "fail";
                                   $text   = lang("a.sessionInfo2");
                             } 
                      }else{
                             $status = "fail";
                             $text   = lang("a.sessionInfo");
                      }
                }else{
                    $status = "fail";
                    $text   = lang("a.savedBefore");
                }
            }
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] );      
            echo json_encode($result);                                // JSON output
    }

    /**
     *   AJAX function
     *   Bildirim silme metodu
     *
     *   @return JSON output status: succuss, fail, error
    **/
    public function delete(){

            $this->login->loginKontrol2();
            $this->lang->load('alert');                                                     // load language file
            $this->form->check( lang('a.alert_id') ,'alert_id', 'required|xss_clean');      // check post data
            if( $this->form->get_result() ){ 
                 $alert_id = $this->input->post('alert_id',   TRUE );
                 $result = $this->email_alerts->delete($alert_id); 
                 if( $result )
                     $status = "success";
                 else 
                     $status = "fail";
                 $text = lang("a." . $status ."Delete");  
            }
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] );      
            echo json_encode($result);                               // JSON output
    }

    /**
     *  AJAX function 
     *  Bildirim kopyalama metodu
     * 
     *  @return JSON output status: succuss, fail, error
    **/
    public function copy(){

           $this->login->loginKontrol2();
           $this->lang->load('alert');                                                                      // load language file
           $this->form->check( lang('a.alert_id') ,'alert_id', 'required|xss_clean');                       // check post data
           $this->form->check( lang('a.date') ,'date', 'required|is_date|exact_length[10]|xss_clean');      // check post data
           if( $this->form->get_result() ){ 
                  $alert_id  = $this->input->post('alert_id',   TRUE );
                  $date      = $this->input->post('date',   TRUE );
                  $alert     = $this->email_alerts->getAlert($alert_id);
                  
                  if( is_array( $alert ) && count($alert) > 0 ){
                       if(  strcmp($date, $alert['date'] ) != 0 ){
                               unset($alert['id'], $alert['created_at'] );
                               $alert['date'] = $date;
                               $result = $this->email_alerts->add( $alert );
                               $status = $result ?  "success" : "fail";
                               $text   = $result ?  lang("a.successCopy") : lang('a.failCopy');  
                        }
                        else{
                              $status = "fail";
                              $text   = lang("a.sameDate");
                        }             
                  }else{
                     $status = "fail";
                     $text   = lang("a.emptyAlert");
                  }
            }
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'text'    => isset($text) ? $text : "", 
                              'message' => $error['message'] );      
            echo json_encode($result);                               // JSON output
    }


}// END of the Alert class
/* 
 *  End of the file Alert
 */   