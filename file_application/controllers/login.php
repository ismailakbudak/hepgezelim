<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  
 * Login Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Login extends CI_Controller {
	   
     /**
      * Constructor
     **/
     public function __construct(){
            parent::__construct();
            $this->load->model('users');              // load users model for database action
     }

    /**
     * Giriş sayfası yüklenir
     * 
     * @return HTML view 
    **/ 
    public function index(){

        $this->lang->load('login_controller');                   // load login_controller language file
        $data =  $this->login->generalTemplate();
        if(  isset($_REQUEST['result']) ){                       // is exist result in the url so there is some message 
              $val = $_REQUEST['result'];                        // get message number 
              if( $val == "1" ){
                 $type= "info";                                  // alert type
                 $title =  lang("l.tebrik");                     // alert title
                 $content = lang("l.successcomplete");           // alert content
                 $data['val'] =  alert($type, $title, $content); // send alert to view
              }
        }
        $this->load->view('include/headerTemplate',$data);       // load views
        $this->load->view('main/login');
        $this->load->view('include/footer');
    }
    
    /**
     * AJAX function
     * Giriş işlemi
     *  
     * @return JSON output status : success, fail, ban  
    **/ 
    public function checkLogin(){
            $this->load->model('users');                                                                     // load users model for database action
            $sifre = ( strcmp(lang('lang'), 'en' ) == 0 ) ?  " şifre " :  " password ";
            $this->form->check(  $sifre, 'password', 'required|alpha_numeric|max_length[50]|xss_clean');     // check post data       
            $this->form->check( 'e-mail',    'email',    'required|valid_email|max_length[50]|xss_clean');   // check post data       
            if( $this->form->get_result() ){       
      		       $post_pass =     $this->input->post('password',TRUE);                         // user password    
                 $post_email =    $this->input->post('email',TRUE);                            // user email adress
                 $result = $this->users->Login($email = $post_email , $password = $post_pass); // if password and email matches from database return user otherwise return false 
                 if($result){
                 	  if($result['ban'] != '1'){                                                  // check does user banned? 
                         if($result['active'] == '1'){                                          // create user information set for session
                              $userdata = array( 'userid'       =>  $this->encrypt->encode( $result['id']          ),
                                                 'name'         =>  $this->encrypt->encode( $result['name']        ),   
                                                 'surname'      =>  $this->encrypt->encode( $result['surname']     ),
                                                 'sex'          =>  $this->encrypt->encode( $result['sex']         ),
                                                 'foto'         =>  $this->encrypt->encode( $result['foto']        ),
                                                 'logged_in'    =>  TRUE   );
                               $this->session->set_userdata($userdata);                          // start session and set data
                               $user_id    =  $result['id'];                                     // userid 
                               $this->users->levelUpdate( $user_id );   
                               $seen_last  =  date('Y-m-d H:i:s');                               // get current time                  
                               $seen_times =  $result['seen_times'] + 1;                         // increase seentimes
                               $user = array(  'seen_last'  =>  $seen_last,                     
                                               'seen_times' =>  $seen_times  ); 
                               $result = $this->users->update($user_id,$user);                   // save new user data
                 	             $status =  "login";                                         
                          }
                          else{
                               $status =  "not-active";
                               $text   = lang("g.not-active");
                          }     
                    }
                    else
                      $status =  "ban";
                 }
                 else
                 	   $status = "error";
            }
            else
                    $status = "error2";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class           
            $result = array( 'status'  => $status, 
                             'text'    => isset( $text ) ? $text : "",
                             'message' => $error['message'] );       // JSON output
            echo json_encode($result);                               // JSON output  
	 }
   
   
    /**
     * Çıkış işlemi Session siliniyor
     *  
     * @return redirect main page
    **/ 
   public function logOut(){
      	   $newdata = array(  'userid'         =>  '',
                              'name'           =>  '',
                              'surname'        =>  '',
                              'sex'            =>  '',
                              'birthyear'      =>  '',
                              'foto'           =>  '',
                              'logged_in'      => FALSE   );
            $this->session->unset_userdata($newdata);           // session destroy  
            $this->session->sess_destroy();
            redirect('main/');
   }




}
/* End of file login.php */
/* Location: ./application/controllers/login.php */