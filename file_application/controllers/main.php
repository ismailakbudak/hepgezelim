<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Main Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */
class Main extends CI_Controller {
      
     /**
      * Constructor
     **/
     public function __construct(){
            parent::__construct();
     } 
     
    /**
     * Anasayfa yükleniyor  
     *  
     * @return HTML view
    **/
    public function index(){ 
            
            // If there is no language in the url default tr do it  
            if( strcmp( $this->uri->segment(1), "" ) == 0 )  
                   redirect("tr/main");
            
            $this->load->helper('search');
            $this->load->model('offersdb');        // load offers model
            $this->load->model('searched');        // load searched model
            
            $offers = $this->offersdb->GetOfersForMain();
            $result   = $this->searched->GetMost();
            if(  ! is_array(  $offers )   )
                $offers   =    array(  'last'  => array(), 'today' => array(), 'best'  => array() );
            if(  ! is_array(  $result )   ){
                  $mostSearched =    array( );
                  $mostCreated  =    array( );
            }
            else{
                  $mostSearched = $result['mostSearched'];
                  $mostCreated  = $result['mostCreated'];
            } 

            foreach ($offers as  &$value) {
                 foreach ($value as &$val ) 
                     $val['foto'] = photoCheckUser($val);
            }

            $data['offers']         = $offers;
            $data['mostSearched']   = $mostSearched;
            $data['mostCreated']    = $mostCreated;

            $this->login->general( $data );        // call general load view
	   	      $this->load->view('main/main');        // load views
	   	      $this->load->view('include/footer');   // load views
            
	   }

    /**
     * Teklif verme sayfasının ilk bölümü
     *  
     * @return HTML view
    **/	   
     public function offerRide(){ 
              $this->login->general();                    // call general load view
	   	        $this->load->view('main/offerRide');        // load view  
	   	        $this->load->view('include/footer');        // load view 
	   }

    /**
     * Teklif verme sayfasının ikinci bölümü
     *   
     * @return HTML view
    **/
     public function offerRide2(){

              $this->load->model('luggages');             // load luggages model for database
              $this->load->model('leave_times');          // load leavetimes model for database
              $this->load->model('cars');                 // load cars model for database
              $userid = $this->encrypt->decode( $this->session->userdata('userid') );  // decode userid 
              $luggages = $this->luggages->GetAll();            // get all luggages options  
              $leave_times = $this->leave_times->GetAll();      // get all leave times options 
              $cars = $this->cars->GetUserCars( $userid );      // get all user cars
              $data['luggages'] = $luggages;                    // send luggages data to view
              
              $data['leave_times'] = $leave_times;              // send leavetimes data to view
              $test = $this->session->all_userdata();
              if( $this->session->userdata('logged_in')  )      // does user logged in? if it is load cars data to view 
                    $data['cars'] = $cars;
			  
			        // if never user logged in we need to define this
		   	      $test['logged_in'] =  isset($test['logged_in']) ? $test['logged_in'] : 'false'; 
			   
              $offer =  $this->session->userdata('offer') ;         // send offer information to view
              $data['test'] =  $test;                               // send userdata to view
             
              $this->login->general( $data );                       // load views
      	    	if( $offer )
                     $this->load->view('main/offerRide2');          // load views 
      	    	else
                     $this->load->view('main/offerRide');           // load views
              $this->load->view('include/footer');                  // load views
    }

    /**
     * Teklif verme sayfasının ilk bölümüne dönüş
     *  
     * @return HTML view
    **/
    public function offerUpdate(){
             // if user do not create first offer option redirect them to there
             if( $this->session->userdata('offer') && $this->session->userdata('offer') == "1"  ){
                   $data['test'] = $this->session->all_userdata();  // send userdata to view
                   $this->login->general( $data);                   // load views
                   $this->load->view('main/offerUpdate');           // load views
                   $this->load->view('include/footer');             // load views
              }
              else 
                  $this->offerRide();   
     }

    /**
     * Nasıl sayfası yüklenir
     *  
     * @return HTML view
    **/
    public function works(){           
               $this->login->general();              // load views
  		         $this->load->view('main/works');      // load views
  		         $this->load->view('include/footer');  // load views
  	}

    /**
     *  Teklif arama sayfası yüklenir
     *  
     *  @return HTML view
    **/    
    public function offers(){
              $this->login->general();              // load views
              $this->load->view('main/search');     // load views
              $this->load->view('include/footer');  // load views
    }


}

/* End of file main.php */
/* Location: ./application/controllers/Main.php */
?>