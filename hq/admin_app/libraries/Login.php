<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DEVELOPER İsmail AKBUDAK 
 * Login Libraries
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class CI_Login {
    
    // for global variable  
	protected $CI;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		//log_message('debug', "Login Class Initialized");
	}
    
    /**
     * General function for general views
     * @parameter | no
     * @output    | view
    **/ 
    public function generalTemplate( ){

            $data = array();        
            $this->CI->load->model('users');                                                   // load alert model
            $result = $this->CI->users->getGeneralCount();         
            $data['member_count']        = $result['member_count']; 
            $data['offer_count']         = $result['offer_count'];
            $data['offer_count_updated'] = $result['offer_count_updated']; 

            if($this->CI->session->userdata('logged_in')){                                                      // does user logged in? 
                      $name      =  $this->CI->encrypt->decode( $this->CI->session->userdata('name')       );   // decode user name
                      $surname   =  $this->CI->encrypt->decode( $this->CI->session->userdata('surname')    );   // decode user surname    
                      $foto      =  $this->CI->encrypt->decode( $this->CI->session->userdata('foto')       );   // decode user foto url
                      $sex       =  $this->CI->encrypt->decode( $this->CI->session->userdata('sex')        );   // decode user sex
                      $data['username'] = $name  ;                                                              // send name to view  
                      $user = array("foto" => $foto , "sex" => $sex );
                      $data['fotoname'] =  photoCheckUser($user);
                      $this->CI->load->model('messages');                                                  // load messages model  
                      $this->CI->load->model('alerts');                                                    // load allerts model
                      $received_user_id            = $this->CI->encrypt->decode( $this->CI->session->userdata('userid') );// decode user id   
                      $data['mesage_count']        = $this->CI->messages->GetUnreadMessages($received_user_id);               // get unread messages    
                      $data['alert_count']         = $this->CI->alerts->GetUnreadAlerts($received_user_id);                   // get unread allers    
            }
            return $data;
    }

    /**
     * General function for general views
     * @parameter | no
     * @output    | view
    **/ 
    public function general( $data = array() ){        
             // If user has offer create it and redirect it
         
            $this->CI->load->model('users');                                                   // load alert model
            $result = $this->CI->users->getGeneralCount();         
            $data['member_count']        = $result['member_count']; 
            $data['offer_count']         = $result['offer_count'];
            $data['offer_count_updated'] = $result['offer_count_updated']; 

            if($this->CI->session->userdata('logged_in')){                                                      // does user logged in? 
                      $name      =  $this->CI->encrypt->decode( $this->CI->session->userdata('name')       );   // decode user name
                      $surname   =  $this->CI->encrypt->decode( $this->CI->session->userdata('surname')    );   // decode user surname    
                      $foto      =  $this->CI->encrypt->decode( $this->CI->session->userdata('foto')       );   // decode user foto url
                      $sex       =  $this->CI->encrypt->decode( $this->CI->session->userdata('sex')        );   // decode user sex
                      $data['username'] = $name  ;                                                              // send name to view  
                      $user = array("foto" => $foto , "sex" => $sex );
                      $data['fotoname'] =  photoCheckUser($user);
                      $this->CI->load->model('messages');                                                  // load messages model  
                      $this->CI->load->model('alerts');                                                    // load allerts model
                      $received_user_id            = $this->CI->encrypt->decode( $this->CI->session->userdata('userid') );// decode user id   
                      $data['mesage_count']        = $this->CI->messages->GetUnreadMessages($received_user_id);               // get unread messages    
                      $data['alert_count']         = $this->CI->alerts->GetUnreadAlerts($received_user_id);                   // get unread allers    
                      $this->CI->load->view('include/headerUser',$data);                                   // load views   
              }    
              else
                   $this->CI->load->view('include/headerNonuser',$data);                                   // load views  
    } 

    /**
     *   Login controle if there is session return user data like name, unread message count
     *   @parameter no
     *   @output array
    **/ 
    public function loginKontrol(){
            $this->CI->load->model('users');                                                   // load alert model
            $result = $this->CI->users->getGeneralCount();         
            $data['member_count']        = $result['member_count']; 
            $data['offer_count']         = $result['offer_count'];
            $data['offer_count_updated'] = $result['offer_count_updated']; 
                     
           if( $this->CI->session->userdata('logged_in' )){                                     // Session information user login or not
                     $name    =  $this->CI->encrypt->decode( $this->CI->session->userdata('name')     ); // Session user data name  encypted
                     $surname =  $this->CI->encrypt->decode( $this->CI->session->userdata('surname')  ); // Session user data surname  encypted    
                     $foto    =  $this->CI->encrypt->decode( $this->CI->session->userdata('foto')     ); // Session user data foto url encypted
                     $sex     =  $this->CI->encrypt->decode( $this->CI->session->userdata('sex')     );  // Session user data sex encypted
                     $data['username'] = $name  ;                                                            // send name to view  
                     $user = array("foto" => $foto , "sex" => $sex );
                     $data['fotoname'] =  photoCheckUser($user);
                     $this->CI->load->model('messages');                                                  // load messages model 
                     $this->CI->load->model('alerts');                                                    // load alert model
                     $received_user_id            = $this->CI->encrypt->decode( $this->CI->session->userdata('userid') );// decode userid from session  
                     $data['mesage_count']        = $this->CI->messages->GetUnreadMessages($received_user_id);               // unread messages of user     
                     $data['alert_count']         = $this->CI->alerts->GetUnreadAlerts($received_user_id);                   // unread alerts of user
                     return $data;                                                                    // return all this->CI data
            }
            else
                    show_404('login');  //redirect("main");                                                                  // not login so redirect to main 
    }

    /**
     *   Load view header
     *   @parameter no
     *   @output views
    **/    
    public function loadViewHead( $data = array() ){
             $this->CI->load->view('include/headerUser',$data);
             $this->CI->load->view('include/headerProfile');
    }
    
    /**
     *   Load view footer
     *   @parameter no
     *   @output views
    **/ 
    public function loadViewHeadFoot(){
             $this->CI->load->view('include/footerProfile');
             $this->CI->load->view('include/footer');
    }
    /**
     *   Login controle 2 if there is session or not
     *   @parameter no
     *   @output 
    **/ 
    public function loginKontrol2(){
            if( $this->CI->session->userdata('logged_in' ))
                return true; 
            else{
                  show_404('login');//redirect("main");
                  exit;
            }     
    }
} // END Login Class

/* End of file Login.php */
/* Location: ./application/libraries/Login.php */
