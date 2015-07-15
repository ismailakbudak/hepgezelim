<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DEVELOPER İsmail AKBUDAK 
 * Login_Admin Libraries
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class CI_Admin {
    
    // for global variable  
	protected $CI;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		log_message('debug', "Login Class Initialized");
	}
    


    /**
     *   Login_Admin controle if there is session return user data like name, unread message count
     *   @parameter no
     *   @output array
    **/ 
    public function loginKontrol(){
           if( $this->CI->session->userdata('admin_logged_in' )){                                                           // Session information user login or not
                     $username         =  $this->CI->encrypt->decode( $this->CI->session->userdata('admin_username')     ); // Session user data name  encypted
                     $data['username'] =  $username  ;                                                                      // send name to view  
                     $data['fotoname'] =  base_url('assets/admin.png');
                     $this->CI->load->model('admin_db');                                // load admin_db model 
                     $counts = $this->CI->admin_db->GetDataCounts();

                     $data['car_photo_count'    ]   = $counts['car_photo_count'    ];   // bakılmayı bekleyen araç foto onayları        // cars table
                     $data['user_photo_count'   ]   = $counts['user_photo_count'   ];   // bakılmayı bekleyen kullanıcı foto onayları   // users table    
                     $data['alert_user_count'   ]   = $counts['alert_user_count'   ];   // bakılmayı bekleyen mesaj şikayetleri         // alert_user table
                     $data['complain_count'     ]   = $counts['complain_count'     ];   // bakılmayı bekleyen şikayetler                // complain table 
                     $data['contact_count'      ]   = $counts['contact_count'      ];   // bakılmayı bekleyen iletişimler               // contact table
                     $data['delete_acount_count']   = $counts['delete_acount_count'];   // bakılmayı bekleyen silme nedenleri           // delete_acount table
                     $data['problem_count'      ]   = $counts['problem_count'      ];   // bakılmayı bekleyen problemeler               // problems table
                     $data['search_count'       ]   = $counts['search_count'      ];   // bakılmayı bekleyen searchler               // searched table
                     return $data;                                                      // return all this->CI data
            }
            else
                 redirect("admin_hepgezelim/login_view");                                                                  // not login so redirect to main 
    }

    /**
     *   Load view header
     *   @parameter no
     *   @output views
    **/    
    public function loadViewHead( $data = array() ){
             $this->CI->load->view('admin_hepgezelim/include/headerUser',$data);
             $this->CI->load->view('admin_hepgezelim/include/headerProfile');
    }
    
    /**
     *   Load view footer
     *   @parameter no
     *   @output views
    **/ 
    public function loadViewHeadFoot(){
             $this->CI->load->view('admin_hepgezelim/include/footerProfile');
             $this->CI->load->view('admin_hepgezelim/include/footer');
    }
    /**
     *   Login controle 2 if there is session or not
     *   @parameter no
     *   @output 
    **/ 
    public function loginKontrol2(){
            if( $this->CI->session->userdata('admin_logged_in' ))
                return true; 
            else{
                  redirect("admin_hepgezelim/login_view");
                  exit;
            }     
    }
} // END Login_Admin Class

/* End of file Login_Admin.php */
/* Location: ./application/libraries/Login_Admin.php */
