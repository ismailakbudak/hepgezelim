 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
/** 
 *  
 * Offer Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */


class Offer extends CI_Controller {
     
    /**
     *   Global variable
     **/
     public $userid, $data;
     
    /**
     * Constructor   
    **/
    public function __construct(){

          parent::__construct();
          $this->data = $this->login->loginKontrol();                                     // check user login or not if not redirect main
          $this->load->helper("offer");                                                   // load helper file for action 
          $this->userid =  $this->encrypt->decode( $this->session->userdata( 'userid') ); // set global variable
          $this->data['active'] = '#offers';                                              // active profile menu
          $this->load->model('offersdb');                                                 // load offersdb model for database action
          $this->load->model('way_points');                                               // load way_points model for database action
          $this->load->model('look_at');                                                  // load look_at model for database action  
          $this->load->model('rutin_trips');                                              // load rutin_trips model for database action
    }

    /*****  for Views method
    =============================================*/    

    /**
     *  Kullanıcının aktif olan tekliflerini listeler 
     *   
     *  @return HTML view
    **/
    public function index(){
               $this->lang->load('offer_controller');                     // load offer_controller language file
               $this->lang->load('offerinfo');                            // load offerinfo language file
               $this->data['active_side'] = '#upcoming';                  // active sidebar menu
               $offers = $this->offersdb->GetUserOffer($this->userid );   // get users up-date offers   $user_id, $numrows, $start
               if( is_array($offers ) ){
                     foreach ($offers as &$value){                                          
                         $value['way_points'] =  $this->way_points->GetOfferWays($value['id']);   // get offer waypoints
                         $look_count =  $this->look_at->GetLookCount($value['id']) ;              // get looked people count for this offerid    
                         if(count($look_count) > 0)                                               
                              $value['look_count'] = $look_count;
                         else 
                            $value['look_count'] = array('ride_offer_id' => $value['id'], 'look' => '0' );
                         if( strcmp( $value['trip_type'], "1" ) == 0 ){                           // if there is get offer trip days   
                            $rutin_trip =  $this->rutin_trips->GetOfferDays($value['id']);        // get trip days for this offerid 
                            if(count($rutin_trip) > 0)                                     
                                   $value['rutin_trip'] = $rutin_trip;
                            else
                                   $value['rutin_trip'] = array( 0 => array('id' => 0, "is_return" => "-1", "day" => ""));        
                         }
                         $value['normal_id'] = $value['id'];
                         $value['id'] =  urlencode(base64_encode($value['id']));                   // encypt again offerid for security
                     }
                     $this->data['offers'] = $offers;                                              // load views
                     $viewContent = 'indexOffer';                                                  // load views  
                     $this->loadContent( $this->data ,  $viewContent);                             // load views 
               }else{
                  show_404('hata');
               }      
    }
    
    /**
     *  Kullanıcının aktif olmayan tekliflerini listeler 
     *   
     *  @return HTML view
    **/
    public function passed(){
               $this->lang->load('offer_controller');                              // load offer_controller language file
               $this->lang->load('offerinfo');                                     // load offerinfo language file
               $this->data['active_side'] = '#passed';                             // active sidebar menu
               $offers = $this->offersdb->GetUserOfferOutofDate($this->userid );   // get users up-date offers $user_id, $numrows, $start
               if( is_array($offers ) ){
                     foreach ($offers as &$value){                                          
                         $value['way_points'] =  $this->way_points->GetOfferWays($value['id']);   // get offer waypoints
                         $look_count =  $this->look_at->GetLookCount($value['id']) ;              // get looked people count for this offerid    
                         if(count($look_count) > 0)                                               
                              $value['look_count'] = $look_count;
                         else 
                            $value['look_count'] = array('ride_offer_id' => $value['id'], 'look' => '0' );
                         if( strcmp( $value['trip_type'], "1" ) == 0 ){                           // if there is get offer trip days   
                            $rutin_trip =  $this->rutin_trips->GetOfferDays($value['id']);        // get trip days for this offerid 
                            if(count($rutin_trip) > 0)                                     
                                   $value['rutin_trip'] = $rutin_trip;
                            else
                                   $value['rutin_trip'] = array( 0 => array('id' => 0, "is_return" => "-1", "day" => ""));        
                         }
                         $value['normal_id'] = $value['id'];
                         $value['id'] =  urlencode(base64_encode($value['id']));                   // encypt again offerid for security
                     }
                     $this->data['offers'] = $offers;                                              // load views
                     $viewContent = 'indexOffer';                                                  // load views  
                     $this->loadContent( $this->data ,  $viewContent);                             // load views 
               }else{
                  show_404('hata');
               }      
    }
  
    /**
     *  Teklife gözatanları listeler
     *   
     *  @param  $offerid şifrelenmiş teklif id 
     *  @return HTML view
    **/
    public function showList( $offerid ){
                 if( !isset($offerid) )                                                          // check offerid is set                    
                     show_404();//redirect( "offer" );
                 
                 $this->data['active_side'] = '';                                                // active sidebar menu
                 $this->lang->load('offer_controller');                                          // load offer_controller language file
                 $this->lang->load('offerinfo'); 

                 $offer_id = base64_decode( urldecode( $offerid ) );
                 $where = array( 'user_id' => $this->userid, 'id' => $offer_id );
                 $offer = $this->offersdb->Get($where );                                        // get users up-date offers   $user_id, $numrows, $start
                 $look_list = $this->look_at->GetLookList($offer_id);                           // get look list user
                 if( is_array( $offer )  && count($offer) > 0 && is_array( $look_list ) ){                                          
                       $waypoints =  $this->way_points->GetOfferWays($offer['id']);             // get offer waypoints
                       if( is_array( $waypoints ) ){
                               $offer['way_points'] = $waypoints;
                               foreach ($look_list as $value) 
                                      $value['foto'] = photoCheckUser($value);
                                  
                               $offer['look_list']  =  $look_list ;                                     // send look list to view
                               $look_count =  $this->look_at->GetLookCount($offer['id']) ;              // get looked people count for this offerid    
                               if( is_array($look_count) && count($look_count) > 0)                                               
                                    $offer['look_count'] = $look_count;
                               else 
                                  $offer['look_count'] = array('ride_offer_id' => $offer['id'], 'look' => '0' );
                               if( strcmp( $offer['trip_type'], "1" ) == 0 ){                           // if there is get offer trip days   
                                  $rutin_trip =  $this->rutin_trips->GetOfferDays($offer['id']);        // get trip days for this offerid 
                                  if( is_array($rutin_trip ) && count($rutin_trip) > 0)                                     
                                         $offer['rutin_trip'] = $rutin_trip;
                                  else
                                         $offer['rutin_trip'] = array( 0 => array('id' => 0, "is_return" => "-1", "day" => ""));        
                               }
                               $offer['normal_id'] = $offer['id'];
                               $offer['id'] =  $offerid;                                                   // encypt again offerid for security
                               
                               $this->data['offer'] = $offer;                                              // load views
          
                               $viewContent = 'view_list';                                          // load views  
                               $this->loadContent( $this->data ,  $viewContent);                    // load views 
                        }else{
                              show_404('hata'); 
                        }      
                 }
                 else{
                     show_404('hata'); 
                 }
    }

    /**
     *  Teklif güncelleme sayfası
     *   
     *  @param  $offerid şifrelenmiş teklif id 
     *  @return HTML view
    **/
    public function update( $offerid ){
              if( !isset($offerid) )                                               // check offer_id is set                    
                   show_404(); 
                 
              $this->lang->load('offer_controller');                               // load offer_controller language file
              $this->lang->load('offerinfo'); 
                   
              $offer_id =  base64_decode(urldecode($offerid));                     // decode offer_id
              $offer = $this->offersdb->GetOffer($offer_id );                      // get offer
              if( is_array( $offer ) && count( $offer ) > 0 ){
                    
                  if( $offer['user_id'] == $this->userid ){

		                    $waypoints =  $this->way_points->GetOfferWays($offer_id);       // get offer waypoints
		                    $str_way = "";
		                    if( is_array($waypoints) && count($waypoints) > 0  ){           // check count of way_points 
		                           $str_way = "";
		                          if( count($waypoints ) == 2 ){                            // there is only one waypoint  
		                                $str_way .= $waypoints[0]['arrivial_place'];
		                          }
		                          else{                                                     // there are a lot of  waypoints more than at lease 2  
		                               $count = count($waypoints); 
		                               $str_way .= $waypoints[0]['arrivial_place'] . '?';   // question mark is using for split on view page   
		                               for ($i=1; $i < $count - 1 ; $i++) { 
		                                     $str_way .= $waypoints[$i]['arrivial_place'] . '?';  // question mark is using for split on view page
		                                } 
		                          }
		                    }
		                    
		                    $departure_days = ""; 
		                    $return_days    = ""; 
		                    if( strcmp( $offer['trip_type'], "1" ) == 0 ){                            // if there is get offer trip days   
		                           $rutin_trip =  $this->rutin_trips->GetOfferDays($offer_id);        // get trip days for this offerid 
		                           if( is_array($rutin_trip) && count($rutin_trip) > 0){
		                                        foreach ( $rutin_trip as $day) {
		                                              if( $day["is_return"] == 0 )
		                                                  $departure_days .= $day['day'] .'?';       // question mark is using for split on view page 
		                                             else
		                                                 $return_days .= $day['day'] . '?';          // question mark is using for split on view page
		                                        }   
		                           }                
		                    }    
		                  
		                    $offer_data = array(  'session_id'    =>  $this->session->userdata('session_id'),
		                                         'user_id'        =>  $this->userid                         ,
		                                         'ride_offer_id'  =>  $offer_id                            ,  // create offer first model for session
		                                         'round_trip'     =>  $offer['round_trip'      ], 
		                                         'origin'         =>  $offer['origin'          ],
		                                         'destination'    =>  $offer['destination'     ],
		                                         'way_points'     =>   $str_way,
		                                         'departure_date' =>  $offer['departure_date'  ],
		                                         'departure_time' =>  $offer['departure_time'  ],
		                                         'return_date'    =>  $offer['return_date'     ],
		                                         'return_time'    =>  $offer['return_time'     ],
		                                         'departure_days' =>  $departure_days           ,
		                                         'return_days'    =>  $return_days              ,
		                                         'trip_type'      =>  $offer['trip_type'       ]     );
		                    $result = $this->offersdb->set_offer_data($offer_data);                               // set session user data
		                    if( $result ){
				                    $offer_data['offer_id_code'] = $this->encrypt->encode($offer_data['ride_offer_id']);
				                    $data['test'] = $offer_data;                              // send userdata to view
				                    $this->login->general( $data);                            // load views
				                    $this->load->view('offer/offerUpdate');                   // load views
				                    $this->load->view('include/footer');                      // load views
							          }else{
					              			 show_404('hata');
					              }
                  }else{
						          show_404('hata');  			 
                  }
              }else{  
                  show_404('hata'); 
              }    
     }
     

     /**
      *  Teklif güncelleme sayfası ilk sayfaya dönüş
      *   
      *   
      *  @return HTML view
     **/
     function updateToUpdate(){
              $this->lang->load('offer_controller');  // load offer_controller language file
              $this->lang->load('offerinfo');         // load offerinfo language file
            
              $offer_data = $this->offersdb->get_offer_data( $this->userid );
        			if( is_array($offer_data ) && count($offer_data) > 0 ){
        			             $offer_data['offer_id_code'] = $this->encrypt->encode($offer_data['ride_offer_id']);
        		               $data['test'] =  $offer_data;                           // send userdata to view
                         
                           $this->login->general( $data);                          // load views
                           $this->load->view('offer/offerUpdateToUpdate');         // load views
                           $this->load->view('include/footer');                    // load views
              }else{ 
        			   show_404('hata');
              }
                     
     }

     /**
      *  Teklif güncelleme sayfası ikinci sayfa
      *   
      *   
      *  @return HTML view
     **/   
     function update2(){
     	     
     	    $this->lang->load('offer_controller');                                          // load offer_controller language file
          $this->lang->load('offerinfo'); 
          $offer_data = $this->offersdb->get_offer_data( $this->userid );                 // get offer updated data
			    if( is_array($offer_data ) && count($offer_data) > 0 ){
				        $offer = $this->offersdb->GetOffer(  $offer_data['ride_offer_id'] );      // get offer
		            if( is_array( $offer ) && count( $offer ) > 0 ){
		                    
		                    $this->load->model('luggages');             // load luggages model for database
		                    $this->load->model('leave_times');          // load leavetimes model for database
		                    $this->load->model('cars');                 // load cars model for database
		                   
		                    $luggages    = $this->luggages->GetAll();                      // get all luggages options  
		                    $leave_times = $this->leave_times->GetAll();                   // get all leave times options 
		                    $cars        = $this->cars->GetUserCars( $this->userid );      // get all user cars
		            
		                    $data['luggages']    = $luggages;                    // send luggages data to view
		                    $data['leave_times'] = $leave_times;                 // send leavetimes data to view
		                    $offer_data['offer_id_code'] = $this->encrypt->encode($offer_data['ride_offer_id']);
		                    $data['test']        = $offer_data;                      // send userdata to view
		                    $data['cars']        = $cars;
		                    $data['offer']       =  $offer;                          // send offer information to view
		                    
		                    $this->login->general( $data );                   // load views
		                    $this->load->view('offer/offerUpdate2');          // load views
		                    $this->load->view('include/footer');              // load views              
		            }else{  
		                show_404('hata'); 
                }    
		    }else{  
		        show_404('hata'); 
        }    
     } 

    /***********************************  For ajax method ********************************************************************/
     

     /**
      *  Kullanıcıya mesaj gönder
      *   
      *   
      *  @return JSON output status: success, fail, error
     **/   
     function contactDriver(){
            $this->lang->load('offer_controller');                                                                       // load offer_controller language file
            $this->lang->load('offerinfo');                                                                              // load offerinfo language file 
            $this->form->check( lang('oc.user_id' ), 'user_id',  'required|xss_clean');                                  // check post data
            $this->form->check( lang('oc.message' ), 'message',  'required|min_length[20]|max_length[400]|xss_clean');   // check post data
            $this->form->check( lang('oc.id'      ), 'offer_id', 'required|xss_clean');                                  // check post data
            if( $this->form->get_result() ){   
                    $sender_user_id   = $this->userid;                                                     // session user_id
                    $receiver_user_id = $this->encrypt->decode( $this->input->post('user_id', TRUE)  );    // decode receiver user id
                    $offer_id         =  base64_decode(  $this->input->post('offer_id', TRUE)  );          // decode receiver user id
                    if( $sender_user_id != 0 && $receiver_user_id != 0 ){
		                    if( strcmp($receiver_user_id, $sender_user_id) != 0  ){                            // compare user ids is it same   
		                               $this->load->model("block_user");                                                
		                               $result = $this->block_user->isthereblock(  $receiver_user_id, $sender_user_id  );  // get is there a blocked user
		                               if( count($result) == 0 ){                                                         
		                                        $this->load->model("messages");                                            // create message model
		                                        $message = array(  'ride_offer_id'     => $offer_id                          ,  
		                                                           'user_id'           => $sender_user_id                    ,
		                                                           'received_user_id'  => $receiver_user_id                  ,
		                                                           'readed_sender'     => 1                                  , 
		                                                           'message'           => $this->input->post('message', TRUE)  );
		                                        $result = $this->messages->add( $message );                                  // add message to database  
		                                        $status = ( $result ) ? "success" : "fail";                                  // change status   
		                                        $text = ( $result ) ? lang("oc.send-success") : lang("oc.send-fail");        // set message                
		                                        $this->sendEmail( $sender_user_id , $receiver_user_id , $offer_id  );        // send email to receiver  
		                               }
		                               else{
		                                    $status = "mistake";       
		                                    $text = lang("oc.block"); 
		                               }
		                    }
		                    else{
		                           $status = "mistake";
		                           $text = lang("oc.send-error"); 
		                    }         
                    }else{
		                    $status = "mistake";
		                    $text = lang("oc.try-again"); 
		            }                 
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'text'    => ( isset($text) ) ? $text : ""  );    
            echo json_encode($result);                                          // JSON output 

     }

     /**
      *  Kullanıcıya mesaj gönderme işlemi ile birlikte kullanıcıya mail gönderme işlemi
      *   
      *  @param $sender_userid
      *  @param $receiver_user_id
      *  @param $offer_id
      *  @return JSON output status: success, fail, error
     **/     
    private function sendEmail( $sender_userid , $receiver_user_id , $offer_id  ){
          $this->lang->load('offer_controller');                                               // load offer_controller language file
          $this->lang->load('offerinfo');                                                      // load offerinfo language file
          $this->load->model('users');
          $this->load->model('notifications');
          $sender       =  $this->users->GetUser($sender_userid);                              // get user information  
          $receiver     =  $this->users->GetUser($receiver_user_id);                           // get user information  
          $offer        =  $this->offersdb->GetOffer($offer_id );                              // get offer
          $notification =  $this->notifications->GetNotification( $receiver_user_id );        // get user _notifiactions
          if( $sender && $receiver && $offer && $notification ){
              if( strcmp( $notification['new_message'], "1") == 0 ){
                   $this->load->helper('email');
                   $this->lang->load('email_controller');                                   // email language
                   $this->load->library('email');                                           // load library for email
                   $recipient = $receiver['email'];                                         // receiver adress
                   $subject = lang('me.private-message');                                   // subject from language file
                   $message = mailSendMessageUser( $receiver, $sender, $offer, $this->lang->lang()); 
                   $this->email->set_newline("\r\n");                              
                   $this->email->from('hep@hepgezelim.com', lang('e.name') ); // sender name
                   $this->email->to($recipient);                              // receiver
                   $this->email->subject($subject);                           // subject
                   $this->email->message($message);                           // message 
                   if($this->email->send())                                   // send email 
                      return true;
                   else
                      return false;   
              }
          }
          else
              return FALSE;
    }

    /************************************* Puplic methods for ajax *********************************************************/
    
    /**
     *  AJAX function
     *  Teklif günceleme 1.sayfası için triptype 0 
     *
     *  
     *  @return JSON status : success, fail, error
    **/      
    public function createOffer1Update(){
          	 
            $this->lang->load('offer_controller');                                                                                // load car_controller language file
            $this->form->check( lang('oc.round_trip')     ,'round_trip',     'required|xss_clean');                               // check post data
            $this->form->check( lang('oc.origin')         ,'origin',         'required|max_length[100]|xss_clean');               // check post data
            $this->form->check( lang('oc.destination')    ,'destination',    'required|max_length[100]|xss_clean');               // check post data
            $this->form->check( lang('oc.way_points')     ,'way_points',     'waypoints_match|xss_clean');                        // check post data
            $this->form->check( lang('oc.departure_date') ,'departure_date', 'required|is_date|exact_length[10]|xss_clean');      // check post data
            $this->form->check( lang('oc.departure_time') ,'departure_time', 'required|is_time|exact_length[5] |xss_clean');      // check post data
            if(  strcmp( trim($this->input->post('round_trip',     TRUE)), "true") == 0 ){                                                                     // is trip twoway
                 $this->form->check( lang('oc.return_date') ,'return_date' ,  'required|is_date|exact_length[10]|xss_clean');     // check post data
                 $this->form->check( lang('oc.return_time') ,'return_time' ,  'required|is_time|exact_length[5] |xss_clean');     // check post data
                 $date1 = trim( $this->input->post('departure_date', TRUE) ) . " " . trim( $this->input->post('departure_time', TRUE) );
                 $date2 = trim( $this->input->post('return_date',    TRUE) ) . " " . trim( $this->input->post('return_time',    TRUE) );       
                 $this->form->date_compare($date1, $date2, lang("oc.departure"), lang("oc.return") );                              // compare my dates if return date doe not after the departure date return false 
                 $round_trip = 'true';
      			}
      			else{
      				   $round_trip = 'false';
      			}		    
          
            $this->form->check_names( 'origin', 'destination', 'way_points' );
            if( $this->form->get_result() ){                                        
                 
                          $offer_data = array(  'user_id'        =>  $this->userid                         ,
                                               'round_trip'     =>  $round_trip,                                // create offer first model for session
                                               'origin'         =>  $this->input->post('origin',         TRUE),
                                               'destination'    =>  $this->input->post('destination',    TRUE),
                                               'way_points'     =>  $this->input->post('way_points',     TRUE),
                                               'departure_date' =>  $this->input->post('departure_date', TRUE),
                                               'departure_time' =>  $this->input->post('departure_time', TRUE),
                                               'return_date'    =>  $this->input->post('return_date',    TRUE),
                                               'return_time'    =>  $this->input->post('return_time',    TRUE),
                                               'departure_days' =>  ""                                        ,
                                               'return_days'    =>  ""                                        ,
                                               'trip_type'      =>  0          );
                            $result = $this->offersdb->update_offer_data($offer_data);                          // set session user data
                            $status =  $result ? "success" :  "fail";
           }
           else
                 $status = "error";
           $error = $this->form->get_error();                        //  if there is error get it from Form validation class
           $result = array(  'status'  => $status,                   // JSON output     
                             'message' => $error['message'] );      
           echo json_encode($result);                                // JSON output      
    }

    /**
     *  AJAX function
     *  Teklif günceleme 1.sayfası için triptype 1
     *
     *  
     *  @return JSON status : success, fail, error
    **/   
    public function createOffer2Update(){
    	     
            $this->lang->load('offer_controller');                                                                            // load car_controller language file
            $this->form->check( lang('oc.round_trip')     ,'round_trip',     'required|xss_clean');                           // check post data
            $this->form->check( lang('oc.origin')         ,'origin',         'required|max_length[100]|xss_clean');           // check post data
            $this->form->check( lang('oc.destination')    ,'destination',    'required|max_length[100]|xss_clean');           // check post data
            $this->form->check( lang('oc.way_points')     ,'way_points',     'waypoints_match|xss_clean');                    // check post data
            $this->form->check( lang('oc.departure_date') ,'departure_date', 'required|is_date|exact_length[10]|xss_clean');  // check post data
            $this->form->check( lang('oc.departure_time') ,'departure_time', 'required|is_time|exact_length[5] |xss_clean');  // check post data
            $this->form->check( lang('oc.return_date')    ,'return_date' ,   'required|is_date|exact_length[10]|xss_clean');  // check post data
            $this->form->check( lang('oc.return_time')    ,'return_time' ,   'required|is_time|exact_length[5] |xss_clean');  // check post data
            $this->form->check( lang('oc.departure_days') ,'departure_days' ,'required|is_day|xss_clean');                    // check post data
            
            $start             = trim( $this->input->post('departure_date', TRUE) ) . " " . trim( $this->input->post('departure_time', TRUE) );
            $end               = trim( $this->input->post('return_date',    TRUE) ) . " " . trim( $this->input->post('return_time',    TRUE) );       
            $round_trip        = $this->input->post('round_trip',     TRUE);
            $departure_days    = $this->input->post('departure_days',     TRUE);
            $return_days       = $this->input->post('return_days',     TRUE);
            $this->form->date_compare($start, $end, lang("oc.start"), lang("oc.finish") );                                    // compare my dates if return date doe not after the departure date return false 
            if( strcmp( trim($round_trip) , "true") == 0  ){                                                                  // is trip twoway   
                   $this->form->check( lang('oc.return_days')    ,'return_days' , 'required|is_day|xss_clean');               // check post data
			             $round_trip = 'true';
			      }else{
			      	     $round_trip = 'false';
			      }		    
            $result = $this->form->date_check(  $start, $end, $round_trip , $departure_days , $return_days  );
            $this->form->check_names( 'origin', 'destination', 'way_points' );
            if( $this->form->get_result() && count($result) > 0 ){   
                               $offer_data = array(  'user_id'        =>  $this->userid                         ,
                                                    'round_trip'      =>  $round_trip,                                    // create offer first model for session
                                                    'origin'          =>  $this->input->post('origin',         TRUE),
                                                    'destination'     =>  $this->input->post('destination',    TRUE),
                                                    'way_points'      =>  $this->input->post('way_points',     TRUE),
                                                    'departure_date'  =>  $this->input->post('departure_date', TRUE),
                                                    'departure_time'  =>  $this->input->post('departure_time', TRUE),
                                                    'return_date'     =>  $this->input->post('return_date',    TRUE),
                                                    'return_time'     =>  $this->input->post('return_time',    TRUE),
                                                    'departure_days'  =>  $this->input->post('departure_days', TRUE),
                                                    'return_days'     =>  $this->input->post('return_days',    TRUE),
                                                    'trip_type'       =>  1           );
                                $result = $this->offersdb->update_offer_data($offer_data);                               // set session user data
                                $status =  $result ? "success" :  "fail";
                             
            }
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'message' => $error['message'] );    
            echo json_encode($result);                                // JSON output                    
    }
  
    /**
     *  AJAX function
     *  Teklif günceleme 2.sayfa için
     *
     *  
     *  @return JSON status : success, fail, error
    **/  
    function updateOfferAjax(){
            $this->lang->load('offer_controller');    // load offer_controller language file
            $this->lang->load('offerinfo');           // load offerinfo language file
            $this->load->helper("offers");
            $this->load->helper("ajax");
            $this->form->check( lang('oc.inputPrices'      ), 'inputPrices',              'regex_match[/^([0-9 ?])+$/i]|xss_clean');          // check post data
            $this->form->check( lang('oc.inputPricesColor' ), 'inputPricesColor',         'regex_match[/^([a-z ?])+$/i]|xss_clean');          // check post data
            $this->form->check( lang('oc.DistancesWay'     ), 'DistancesWay',             'regex_match[/^([0-9 .?])+$/i]|xss_clean');         // check post data
            $this->form->check( lang('oc.TimesWay'         ), 'TimesWay',                 'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.car_id'           ), 'car_id',                   'required|is_natural_no_zero|xss_clean');           // check post data
            $this->form->check( lang('oc.luggage_id'       ), 'luggage_id',               'required|is_natural_no_zero|xss_clean');           // check post data
            $this->form->check( lang('oc.leave_time_id'    ), 'leave_time_id',            'required|is_natural_no_zero|xss_clean');           // check post data
            $this->form->check( lang('oc.price_per_pass'   ), 'price_per_passenger' ,     'required|is_natural|xss_clean');                   // check post data
            $this->form->check( lang('oc.number_of_seats'  ), 'number_of_seats' ,         'required|greater_than[0]|less_than[9]|xss_clean'); // check post data
            $this->form->check( lang('oc.realDistance'     ), 'realDistance' ,            'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.realTime'         ), 'realTime' ,                'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.totalDistance'    ), 'totalDistance' ,           'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.totalTime'        ), 'totalTime' ,               'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.price_per_color'  ), 'price_per_passenger_color','regex_match[/^([a-z ?])+$/i]|xss_clean');          // check post data
            $this->form->check( lang('oc.explain_departure'), 'explain_departure' ,       'max_length[250]|xss_clean');                         // check post data
            $this->form->check( lang('oc.explain_return'   ), 'explain_return' ,          'max_length[250]|xss_clean');                       // check post data
            $this->form->check( lang('oc.locations'        ), 'locations' ,               'check_array|xss_clean');                           // check post data
            $this->form->check( lang('oc.expectedPrices'   ), 'expectedPrices' ,          'check_array|xss_clean');                           // check post data
            if( $this->form->get_result() ){
            	  $offer_data = $this->offersdb->get_offer_data( $this->userid );
			          if( is_array($offer_data ) && count($offer_data) > 0 ){
			                                        
                            $offer_id = $offer_data['ride_offer_id'];
                            //added after
                            $locations      =  $this->input->post('locations'      , TRUE);
                            $expectedPrices =  $this->input->post('expectedPrices' , TRUE);
                            unset( $expectedPrices[0] );
                            $post_way_points           =  $offer_data[ 'way_points'];                        // waypoints name like istanbul?Denizli     
                            $post_round_trip           =  $offer_data[ 'round_trip' ];                       // two way or one way trip  
                            $post_input_prices         =  $this->input->post('inputPrices',      TRUE);      // waypoints prices like 4?5
                            $post_input_prices_color   =  $this->input->post('inputPricesColor', TRUE);      // waypoints prices color like red?orange 
                            $post_input_distances      =  $this->input->post('DistancesWay',     TRUE);      // waypoints distances like 234km?221km          
                            $post_input_times          =  $this->input->post('TimesWay',         TRUE);      // waypoints distance hour like 34 dk?3 saat
                            $post_departure_days       =  $offer_data['departure_days' ];                    // departure days like pazartesi?salı
                            $post_return_days          =  $offer_data['return_days'];                        // return days like pazartesi?salı
                             if( $offer_data[ 'trip_type'] == 1 ){
                                 $start          = trim( $offer_data['departure_date'] ) . " " . trim($offer_data['departure_time'] );
                                 $end            = trim( $offer_data['return_date'   ] ) . " " . trim( $offer_data['return_time'] );       
                                 $round_trip     = $post_round_trip;                                                         // $this->input->post('round_trip',     TRUE);
                                 $departure_days = $post_departure_days;                                                     //$this->input->post('departure_days',     TRUE);
                                 $return_days    = $post_return_days;                                                        //$this->input->post('return_days',     TRUE);
                                 $result         = $this->form->date_check(  $start, $end, $round_trip , $departure_days , $return_days  );
                                 $rutin_trip_dates = $result; 
                            } else{
                                 $rutin_trip_dates = array();
                            } 
                            $post_round_trip           = ( strcmp( $post_round_trip , 'true') == 0 ) ? 1 : 0;                           // trip is two way or not 
                          
                            // update offer model for database 
                            $ride_offer = array( 'user_id'              => $this->userid            ,   
                                                 'car_id'               => $this->input->post('car_id',                    TRUE) ,
                                                 'luggage_id'           => $this->input->post('luggage_id',                TRUE) ,
                                                 'leave_time_id'        => $this->input->post('leave_time_id',             TRUE) ,
                                                 'trip_type'            => $offer_data['trip_type'                ] ,   
                                                 'origin'               => $offer_data[ 'origin'                  ] ,
                                                 'destination'          => $offer_data[ 'destination'             ] ,
                                                 'departure_date'       => $offer_data[ 'departure_date'          ] ,
                                                 'departure_time'       => $offer_data[ 'departure_time'          ] ,
                                                 'return_date'          => $offer_data[ 'return_date'             ] ,
                                                 'return_time'          => $offer_data[ 'return_time'             ] ,
                                                 'round_trip'           => $post_round_trip                                      ,
                                                 'price_per_passenger'  => $this->input->post('price_per_passenger',       TRUE) ,
                                                 'real_distance'        => $this->input->post('realDistance',              TRUE) ,             
                                                 'real_time'            => $this->input->post('realTime',                  TRUE) ,            
                                                 'total_distance'       => $this->input->post('totalDistance',             TRUE) ,            
                                                 'total_time'           => $this->input->post('totalTime',                 TRUE) ,              
                                                 'price_class'          => $this->input->post('price_per_passenger_color', TRUE) , 
                                                 'number_of_seats'      => $this->input->post('number_of_seats',           TRUE) ,
                                                 'explain_departure'    => $this->input->post('explain_departure',         TRUE) ,
                                                 'explain_return'       => $this->input->post('explain_return',            TRUE)  );
                            
                             $waypoints = array();
                             $ways_offer = array(); 
                             $days = array(); 
                             if( trim($post_way_points) != "" ){                              // way points is null or not 
                                    $points = explode('?', $post_way_points);                 // way points split 
                                    $prices = explode('?', $post_input_prices);               // way points price split
                                    $pricesColor = explode('?', $post_input_prices_color);    // way points price color split 
                                    $distances = explode('?', $post_input_distances);         // way points distance split
                                    $times = explode('?', $post_input_times);                 // way points distances time split 
                                    $waypoint =  array(  'ride_offer_id'       =>   $offer_id,
                                                         'departure_place'     =>   $ride_offer['origin'] ,        
                                                         'arrivial_place'      =>   $points[0]            ,
                                                         'price'               =>   $prices[0]            ,
                                                         'distance'            =>   $distances[0]         ,
                                                         'time'                =>   $times[0]             ,
                                                         'price_class'         =>   $pricesColor[0]        );                   
                                    $waypoints[] =  $waypoint ;
                                    $ways_offer[] = $waypoint ;  
                                    for ($i=0; $i < count($points) - 1; $i++) { 
                                           $waypoint =  array(  'ride_offer_id'       =>   $offer_id,
                                                                'departure_place'     =>   $points[ $i]     ,        
                                                                'arrivial_place'      =>   $points[ $i + 1] ,
                                                                'price'               =>   $prices[$i + 1]  ,
                                                                'distance'            =>   $distances[$i + 1]      ,
                                                                'time'                =>   $times[$i + 1]          ,
                                                                'price_class'         =>   $pricesColor[$i + 1] );      
                                           $waypoints[] =  $waypoint ;
                                           $ways_offer[] = $waypoint ;
                                    }
                                    $waypoint =  array(  'ride_offer_id'       =>   $offer_id,
                                                         'departure_place'     =>   $points[ count($points) -1 ]  ,         
                                                         'arrivial_place'      =>   $ride_offer['destination']    , 
                                                         'price'               =>   $prices[count($prices) - 1]   ,
                                                         'distance'            =>   $distances[count($distances) - 1],
                                                         'time'                =>   $times[count($times) - 1]          ,
                                                         'price_class'         =>   $pricesColor[count($pricesColor) - 1] );      
                                    $waypoints[] =  $waypoint ;
                                    $ways_offer[] = $waypoint ;  
                             }  
                             foreach ($expectedPrices as $val ) {
                                   $price = 0; 
                                   $flag = false;
                                   foreach ($waypoints as $way) {
                                       if(  strcmp( $way['departure_place'], $val['origin'] ) == 0 )
                                          $flag = true;
                                       if( $flag ){
                                            $price +=  $way['price']; 
                                       }   
                                       if(  strcmp( $way['arrivial_place'], $val['destination'] ) == 0 ){
                                          $flag = false;
                                          break; 
                                       }
                                   } 
                                   $colour = getColour( $price);
                                    
                                  $ways_offer[] = array( 'departure_place' => $val['origin'],
                                                         'arrivial_place'  => $val['destination'],
                                                         'distance'        => $val['distance'],
                                                         'time'            => $val['time'],
                                                         'price_class'     => $colour,
                                                         'price'           => $price 
                                                       ); 
                             }

                             // ana yolculuğu ekle
                             $ways_offer[] = array(    'departure_place' => $ride_offer['origin'],
                                                       'arrivial_place'  => $ride_offer['destination'],
                                                       'distance'        => $ride_offer['total_distance'],
                                                       'time'            => $ride_offer['total_time'],
                                                       'price_class'     => $ride_offer['price_class'],
                                                       'price'           => $ride_offer['price_per_passenger'] 
                                                     ); 
							  			 
                             foreach ($ways_offer as &$value) {
                                 $result = getLocation( $value , $locations  );
                                 $value['ride_offer_id'] = $offer_id;
                             }  
                            
                             if( strcmp($ride_offer['trip_type'] , "1") == 0 ){                    // if trip type is rutin trip there is departure days and return days
                                    $post_departure_days = trim($post_departure_days);     
                                    $post_return_days = trim($post_return_days);     
                                    $go = explode('?', $post_departure_days);                       // departure days split    
                                    if(  count($go) > 0 ){
                                              foreach ($go as &$day) {
                                                  $days[] =  array( 'ride_offer_id' => $offer_id,
                                                                    'is_return'     =>   0        , 
                                                                    'day'           =>   $day      );
                                              }
                                              if( strcmp("1", $ride_offer['round_trip'] ) == 0 ){  // if trip is two way there is some return days
                                                   $back = explode('?', $post_return_days);        // return days split     
                                                   foreach ($back as &$day) {
                                                           $days[] =  array(  'ride_offer_id' => $offer_id ,
                                                                              'is_return'     =>   1        , 
                                                                              'day'           =>   $day      );
                                                   }            
                                              }
                                    }
                            }
                            
                            $result = $this->offersdb->updateOfferAll( $offer_id,
                                                                       $rutin_trip_dates, 
                                                                       $ride_offer, 
                                                                       $waypoints,
                                                                       $ways_offer,
                                                                       $days         ); 
                            
                             
                            if($result){                                                                                          // offer has been updated succesfully unset session data       
                                  $origin      = $offer_data['origin'       ];
                                  $destination = $offer_data['destination'  ];
                                  $origin      = explode(',',$origin);
                                  $origin      = $origin[0];
                                  $destination = explode(',',$destination);
                                  $destination = $destination[0];   
                                  $name = urlCreate( $this->lang->lang(), $origin, $destination, $offer_id );  
                                  $status = 'success';
						                }else{
                                 $status = "fail"; 
                            }     
                  }else{
				              $status = "fail"; 
                  }    
            }else{
                  $status = "error"; 
            }
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'path'    =>  isset($name) ? $name : "" );    
            echo json_encode($result);                                          // JSON output 

    }

     /**
      *   AJAX function
      *   Teklif için koltuk sayısını arttır
      *   
      *   @return JSON output status : success, fail, error
      *  
      **/
     public function increaseSeatCount(){
           $this->lang->load('offer_controller');                                                       // load offer_controller language file
           $this->lang->load('offerinfo');                                                              // load offerinfo language file   
           $this->form->check(lang('oc.id')          ,'offer_id',    'required|xss_clean');             // check post data       
           if( $this->form->get_result() ){  
                   $offer_id =   base64_decode( urldecode( $this->input->post('offer_id', TRUE) ) ); 
                   $offer = $this->offersdb->GetOffer($offer_id );                                      // get offer
                   if( is_array( $offer ) && count($offer) > 0  ){
                        if( $offer['number_of_seats']  < 7 ){                                         // check offer seat count   
                            $new_offer = array( "number_of_seats" => $offer['number_of_seats'] + 1 ); // increase seat count 
                             $result = $this->offersdb->UpdateOffer($offer_id, $new_offer);           // update offer information
                             if( $result ){                                                                 
                                  $offer = $this->offersdb->GetOffer($offer_id );                     // get offer again
                                  if( is_array( $offer ) && count($offer) > 0  ){
                                     $text = $offer['number_of_seats'];                                  // write seat count
                                     $status =  "success";
                                  }else{
                                     $status =  "fail"; 
                                  }   
                             }
                             else{
                                $status =  "fail";
                             }
                        }
                        else{
                            $text = lang("oc.moreseat"); 
                            $status =  "fail";
                        }
                   }
                   else{
                      $status =  "fail";      
                   }
           }
           else{ 
               $status = "error";
           }   
           $error = $this->form->get_error();                                              //  if there is error get it from Form validation class  
           $result = array( 'status'  => $status, 
                            'message' => $error['message'],
                            'text'    => isset($text) ? $text : lang( $status )  );       // JSON output
           echo json_encode($result);                                                     // JSON output             
     }

      /**
       *   AJAX function
       *   Teklif için koltuk sayısını azalt
       *
       *   
       *   @return JSON output status : success, fail, error
       *  
       **/
     public function decreaseSeatCount(){
           $this->lang->load('offer_controller');                                                      // load offer_controller language file
           $this->lang->load('offerinfo');                                                             // load offerinfo language file 
           $this->form->check(lang('oc.id')          ,'offer_id',    'required|xss_clean');            // check post data       
           if( $this->form->get_result() ){  
                   $offer_id =   base64_decode( urldecode( $this->input->post('offer_id', TRUE) ) ); 
                   $offer = $this->offersdb->GetOffer($offer_id );                                     // get offer
                   if( is_array( $offer ) && count($offer) > 0  ){
                        if( $offer['number_of_seats']  > 0 ){                                          // check offer seat count   
                             $new_offer = array( "number_of_seats" => $offer['number_of_seats'] - 1 ); // decrease seat count 
                             $result = $this->offersdb->UpdateOffer($offer_id, $new_offer);            // update offer information
                             if( $result ){                                                                 
                                  $offer = $this->offersdb->GetOffer($offer_id );                      // get offer again
                                  if( is_array( $offer ) && count($offer) > 0  ){
                                      $text = $offer['number_of_seats'];                               // write seat count
                                      $status =  "success";
                                  }else{
                                      $status =  "fail";
                                  }
                             }
                             else{
                                $status =  "fail";
                             }
                        }
                        else{
                            $text = lang("oc.lessseat"); 
                            $status =  "fail";
                        }
                   }
                   else{
                      $status =  "fail";      
                   }
           }
           else{
                $status = "error";
           }
           $error = $this->form->get_error();                                             //  if there is error get it from Form validation class  
           $result = array( 'status'  => $status, 
                            'message' => $error['message'], 
                            'text'    => isset($text) ? $text : lang( $status )  );       // JSON output
           echo json_encode($result);                                                     // JSON output             
     }

      /**
       *  AJAX function
       *  Teklif silme işlemi
       *  
       *  @param  $id
       *  @return JSON output status : success, fail, error
       *  
       **/
     public function deleteOffer(){
              $this->lang->load('offer_controller');                                                       // load offer_controller language file
              $this->lang->load('offerinfo');                                                              // load offerinfo language file 
              $this->form->check(lang('oc.id')          ,'offer_id',    'required|xss_clean');             // check post data       
              if( $this->form->get_result() ){  
                      $offer_id = base64_decode( urldecode( $this->input->post('offer_id', TRUE) ) );      // post offerid
                      $offer = $this->offersdb->GetOffer($offer_id );                                      // get offer
                      if( is_array( $offer ) && count($offer) > 0 ){
                          if( $offer['user_id'] == $this->userid ){
                               // Delete çıkarıldı
                               //$status = ($this->offersdb->deleteOffer($offer_id) == TRUE ) ? 'success' : "fail";   // delete offer all information
                               $offer = array( 'is_active'   =>  0 );
                               $result = $this->offersdb->UpdateOffer($offer_id, $offer);                             // update  offer rreturn date info
                               $status = ($result ? 'success' : 'fail' );  
                          }
                          else{
                               $status =  "fail";
                               $text   = lang('permission');
                          }     
                      }
                      else{
                          $status =  "fail";
                      }
              }
              else{
                    $status = "error";
              }      
              $error = $this->form->get_error();                       //  if there is error get it from Form validation class           
              $result = array( 'status'  => $status, 
                               'text'    => isset($text) ? $text : lang('fail'), 
                               'message' => $error['message'] );       // JSON output
              echo json_encode($result);                               // JSON output  
    }

    /**
     *   AJAX  function
     *   Teklife dönüş tarihi ekle
     *
     *   @return  JSON output status : success, fail, error
    **/
    public function addReturnDate(){
              $this->lang->load('offer_controller');  // load offer_controller language file
              $this->lang->load('offerinfo');         // load offerinfo language file
              $this->form->check(lang('oc.id')          ,'offer_id',    'required|xss_clean');                           // check post data       
              $this->form->check(lang('oc.return_date') ,'return_date', 'required|is_date|exact_length[10]|xss_clean');  // check post data       
              $this->form->check(lang('oc.return_time') ,'return_time', 'required|is_time|exact_length[5] |xss_clean');  // check post data       
              if( $this->form->get_result() ){  
                      $offer_id = base64_decode( urldecode( $this->input->post('offer_id', TRUE) ) );                    // post offerid
                      $return_date      = $this->input->post('return_date', TRUE);                                       // post data
                      $return_time      = $this->input->post('return_time', TRUE);                                       // post data 
                      $offer = $this->offersdb->GetOffer($offer_id);                                                     // get offer information
                      if( is_array( $offer ) && count($offer) > 0  ){                                
                            $times = explode(":", $offer["departure_time"]);                                             // our dataabse departure date like 12:30:00                                
                            $now = date("i") + 2;

                            $date1 = date('Y-m-d H:') . $now;//$offer['departure_date'] . " " . trim($times[0] . ":" . $times[1] );                // i want to use 12:30 becouse of my method
                            $date2 = trim($return_date) . " " . trim($return_time) ;                                       // becauseof my method again date must be like 2014-02-03 12:30
                            if($this->form->date_compare($date1, $date2, lang("oc.departure"), lang("oc.return") )){       // compare my dates if return date doe not after the departure date return false 
                                  $offer = array( 'return_date'  =>  $return_date,                                         // add return date info into to offer
                                                  'return_time'  =>  $return_time, 
                                                  'round_trip'   =>  1 );
                                  $result = $this->offersdb->UpdateOffer($offer_id, $offer);                               // update  offer rreturn date info
                                  $status = ($result ? 'success' : 'fail' );
                            }
                            else{
                                  $status = "error";
                            }      
                      }
                      else{
                          $status = "fail";           
                      }    
              }
              else{
                    $status = "error";
              }      
              $error = $this->form->get_error();                        //  if there is error get it from Form validation class           
              $result = array( 'status'  => $status, 
                               'message' => $error['message'] );       // JSON output
              echo json_encode($result);                               // JSON output  
    }
    
    /**
     *   AJAX  function
     *   Teklife dönüş günleri ekle
     *
     *   @return  JSON output status : success, fail, error
    **/
    public function addReturnDays(){
            $this->lang->load('offer_controller');    // load offer_controller language file
            $this->lang->load('offerinfo');           // load offerinfo language file

            $this->form->check( lang('oc.id')         , 'offer_id',    'required|xss_clean');                          // check post data       
            $this->form->check( lang('oc.return_days'), 'return_days', 'required|is_day|xss_clean');                   // check post data
            $this->form->check( lang('oc.return_time'), 'return_time', 'required|is_time|exact_length[5] |xss_clean'); // check post data

            if( $this->form->get_result() ){                                                                           // is there any error   
                      $offer_id = base64_decode( urldecode( $this->input->post('offer_id', TRUE) ) );
                      $days_array = explode('?', $this->input->post('return_days', TRUE) );
                      $offer = $this->offersdb->GetOffer($offer_id);                                                    // get offer info from database 
                      if( is_array( $offer ) && count($offer) > 0  ){
                              $return_days    =  $this->input->post('return_days', TRUE);
                              $start = $offer['departure_date'] . " " . $offer['departure_time'];
                              $end   = $offer['return_date'] . " " . $offer['return_time'];
                              $rutin_trip_dates = $this->form->date_check_return(  $start, $end, $return_days  );
                              if(  count($rutin_trip_dates) > 0 ){
                                      if(  count($days_array) > 0 ){
                                             $new_rutin_days  =  array();                                               // trip days model 
                                             foreach ($days_array as $day) {
                                                  $model =  array(   'ride_offer_id' =>   $offer_id,
                                                                     'is_return'     =>   1,                            // for return 1 otherwise 0 
                                                                     'day'           =>   $day ); 
                                                  array_push( $new_rutin_days, $model );                                // add new model 
                                             }          
                                             $result1 = $this->offersdb->addDays( $rutin_trip_dates, $new_rutin_days, $offer_id);                    // save offer return days
                                             if($result1){  
                                                   $new_offer  = array( 'return_time' =>   $this->input->post('return_time', TRUE) ,
                                                                        'round_trip'   =>  1  );
                                                   $result = $this->offersdb->UpdateOffer($offer_id, $new_offer);           // update offer information
                                                   if( $result ){                                                                 
                                                        $text = lang("oc.successAddReturnDays");      
                                                        $status =  "success";
                                                   }
                                                   else{
                                                      $status =  "fail"; 
                                                   }
                                             }     
                                             else{
                                                  $status = 'fail';  
                                              }    
                                      }
                                      else{
                                          $status = "fail";
                                      }    
                              }               
                              else{
                                   $status = "error";             
                              }     
                      }
                      else{
                          $status = "fail";               
                      }    
            }        
            else{
                $status = "error";
            }    
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class           
            $result = array( 'status'  => $status, 
                             'text'    => ( isset($text) ? $text : lang( $status ) ),     
                             'message' => $error['message'] );       // JSON output
            echo json_encode($result);                               // JSON output  
    }

    /**
     *  AJAX function 
     *  Teklif kopyalama işlemi 
     *   
     *  @return JSON otput  status : success, fail, error
    **/
    public function copyOffer(){
              $this->lang->load('offer_controller');   // load offer_controller language file
              $this->lang->load('offerinfo');          // load offerinfo language file 
              $this->form->check(lang('oc.id')             ,'offer_id',       'required|xss_clean');                           // check post data       
              $this->form->check(lang('oc.departure_date') ,'departure_date', 'required|is_date|exact_length[10]|xss_clean');  // check post data       
              $this->form->check(lang('oc.departure_time') ,'departure_time', 'required|is_time|exact_length[5] |xss_clean');  // check post data       
              if( $this->form->get_result() ){                                                                                 // is there any error   
                        $offer_id = base64_decode( urldecode( $this->input->post('offer_id', TRUE) ) );                        // decode offerid
                        $offer = $this->offersdb->GetOffer($offer_id);                                                         // get offer info from database 
                        if( is_array( $offer ) && count($offer) > 0  ){                                                                                            
                                $round_trip     = $offer['round_trip'];                                                               // previous trip's twoway  
                                $departure_date = $this->input->post('departure_date', TRUE);                                         // post data
                                $departure_time = $this->input->post('departure_time', TRUE);                                         // post data 
                                $val1 = strtotime( $departure_date . " " . $departure_time  );
                                $now = strtotime(date('Y-m-d H:i:s')) + 59 * 60;
                                if( $now < $val1 ){
                                     $return_date    = $this->input->post('return_date',    TRUE);                                     // get post data to field 
                                     $return_time    = $this->input->post('return_time',    TRUE);                                     // get post data to field
                                     $rutin_trip_dates = array();
                                     $rutin_trips =  $this->rutin_trips->GetOfferDays($offer_id);    // get offer trip days  from databse 
                                     if( $offer['trip_type'] == 1 ){  // is trip routine 
                                          $this->form->check(lang('oc.return_date')    ,'return_date',  'required|is_date|exact_length[10]|xss_clean');  // check post data       
                                          $this->form->check(lang('oc.return_time')    ,'return_time',  'required|is_time|exact_length[5] |xss_clean');  // check post data       
                                          $start = trim($departure_date) . " " . trim($departure_time) ; 
                                          $end = trim($return_date) . " " . trim($return_time) ; 
                                          $this->form->date_compare($start, $end, lang("oc.departure"), lang("oc.return") );  
                                          if( is_array($rutin_trips)  ){                                  // create new offer model   
                                                if($round_trip)
                                                    $round_trip_ses ="true";
                                                 else
                                                     $round_trip_ses = "0"; 
                                                $departure_days = "";
                                                $return_days = "";
                                                foreach ($rutin_trips as $value) {
                                                     if( $value['is_return'] == 1 )
                                                         $return_days .= $value['day'] .'?'; 
                                                     else
                                                          $departure_days .= $value['day'] .'?'; 
                                                }
                                                $rutin_trip_dates = $this->form->date_check(  $start, $end, $round_trip_ses , $departure_days , $return_days  );
                                          }
                                          else{
                                              $status = 'fail';
                                          }    
                                     }
                                     else{
                                          if(  strcmp(trim($return_date) ,"") == 0 ){                                               // if there is no return date this trip is one way  
                                                $return_date  = "";                                                                 // we dont need this data
                                                $return_time  = "";                                                                 // we dont need this data 
                                                $round_trip   = 0;                                                                  // our trip is one way     
                                          }
                                          else{
                                               $this->form->check(lang('oc.return_date')    ,'return_date',    'required|is_date|exact_length[10]|xss_clean');  // check post data       
                                               $this->form->check(lang('oc.return_time')    ,'return_time',    'required|is_time|exact_length[5] |xss_clean');  // check post data       
                                               $date1 = trim($departure_date) . " " . trim($departure_time) ; 
                                               $date2 = trim($return_date) . " " . trim($return_time) ; 
                                               $this->form->date_compare($date1, $date2, lang("oc.departure"), lang("oc.return") );  
                                               $round_trip = 1;                                                                      // our trip is two way  
                                          }
                                     }    
                                     if( $this->form->get_result() ){                                                                // is there any error     
                                                 $way_points =  $this->way_points->GetOfferWays($offer_id);               // get offer waypoints from database  
                                                 $ways_offer =  $this->way_points->GetOfferWaysOffer($offer_id);               // get offer waypoints from database  
                                                 if( is_array($way_points) && is_array( $ways_offer ) && is_array($rutin_trips) ){                                            
                                                                     

                                                                     unset($offer['id'], $offer['created_at'], $offer['updated_at'], $offer['is_active']  );                
                                                                     $offer['departure_date' ] = $this->input->post('departure_date', TRUE); 
                                                                     $offer['departure_time' ] = $this->input->post('departure_time', TRUE); 
                                                                     $offer['return_date'    ] = $return_date ;
                                                                     $offer['return_time'    ] = $return_time ;
                                                                     $offer['round_trip'     ] = $round_trip  ;
                                                                     
                                                                     
                                                                     if(count($rutin_trips) > 0){
                                                                            foreach ($rutin_trips as &$value) {
                                                                                  unset($value['id'], $value['ride_offer_id'],  $value['created_at'], $value['updated_at']   );                
                                                                            }   
                                                                     }
                                                                     if( count($way_points) > 0){
                                                                            foreach ($way_points as &$value) {                     // create new model      
                                                                                 unset($value['id'], $value['ride_offer_id'],  $value['created_at'], $value['updated_at']   );                
                                                                             }
                                                                     }  
                                                                     if( count($ways_offer) > 0){
                                                                            foreach ($ways_offer as &$value) {                     // create new model      
                                                                                 unset($value['id'], $value['ride_offer_id'],  $value['created_at'], $value['updated_at']   );                
                                                                             }
                                                                     }
                                                                     $offer_id = $this->offersdb->saveOffer( $rutin_trip_dates, 
                                                                                                             $offer, 
                                                                                                             $way_points,
                                                                                                             $ways_offer,
                                                                                                             $rutin_trips       ); 
                                                                      
                                                                     if($offer_id){  
                                                                          $status = 'success';
                                                                          $text = lang("oc.successcopy");
                                                                          $origin      = explode(',',$offer['origin']);
                                                                          $origin      = $origin[0];
                                                                          $destination = explode(',',$offer['destination']);
                                                                          $destination = $destination[0];   
                                                                          $name = urlCreate( $this->lang->lang(), $origin, $destination, $offer_id ); 
                                                                     }     
                                                                     else{
                                                                          $status = 'fail';
                                                                     }   
                                                 }        
                                                 else{
                                                     $status = 'fail';
                                                 }    
                                     }
                                     else{
                                          $status = "error";  
                                     }
                                }         
                                else{
                                   $status = "fail"; 
                                   $text   =  lang("oc.date-invalid");
                                }          
                        }
                        else{
                            $status = 'fail';
                        }    
              }
              else{
                  $status = "error";
              }
              $error = $this->form->get_error();                        //  if there is error get it from Form validation class           
              $result = array( 'status'  => $status, 
                               'text'    => ( isset( $text ) ? $text : lang( $status ) ),     
                               'path'    =>  isset($name) ? $name : ""   ,   
                               'message' => $error['message'] );       // JSON output
              echo json_encode($result);                               // JSON output  
    }
    

    /*********************************** Private Functions for using methods*******************************************************/
    
    /**
     * Sayfa yükleme metodu  
     *
     * @param  $data sayfa içeriği için bilgiler 
     * @param  $content  yüklenecek olan içerik sayfası
     * @return HTML view
    **/
    private function loadContent( $data = array(),  $viewContent  ){
               $this->login->loadViewHead( $data);
               $this->load->view('offer/offerHead' );
               $this->load->view('offer/'.$viewContent );
               $this->load->view('offer/offerFoot' );
               $this->login->loadViewHeadFoot();
    }   



} // END of the Offer Class
/**
 * End of the file offer
 **/