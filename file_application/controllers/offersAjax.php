<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * OffersAjax Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class OffersAjax extends CI_Controller {
     
     /**
      * Constructor
     **/
     public function __construct(){
            parent::__construct();
	 }

    /************************************* Puplic methods for ajax *********************************************************/
    
    /**
     * AJAX function
     * Teklif oluşturma işlemi 1.sayfa için triptype 0 
     *  
     * @return JSON output status : success, fail, error
    **/      
    public function createOffer1(){
            $this->lang->load('offer_controller');                                                                                // load car_controller language file
            $this->form->check( lang('oc.round_trip')     ,'round_trip',     'required|xss_clean');                               // check post data
            $this->form->check( lang('oc.origin')         ,'origin',         'required|max_length[100]|xss_clean');               // check post data
            $this->form->check( lang('oc.destination')    ,'destination',    'required|max_length[100]|xss_clean');               // check post data
            $this->form->check( lang('oc.way_points')     ,'way_points',     'waypoints_match|xss_clean');                        // check post data
            $this->form->check( lang('oc.departure_date') ,'departure_date', 'required|is_date|exact_length[10]|xss_clean');      // check post data
            $this->form->check( lang('oc.departure_time') ,'departure_time', 'required|is_time|exact_length[5] |xss_clean');      // check post data
            if( $this->input->post('round_trip',     TRUE) == "true" ){                                                                     // is trip twoway
                 $this->form->check( lang('oc.return_date') ,'return_date' ,  'required|is_date|exact_length[10]|xss_clean');     // check post data
                 $this->form->check( lang('oc.return_time') ,'return_time' ,  'required|is_time|exact_length[5] |xss_clean');     // check post data
                 $date1 = trim( $this->input->post('departure_date', TRUE) ) . " " . trim( $this->input->post('departure_time', TRUE) );
                 $date2 = trim( $this->input->post('return_date',    TRUE) ) . " " . trim( $this->input->post('return_time',    TRUE) );       
                 $this->form->date_compare($date1, $date2, lang("oc.departure"), lang("oc.return") );                              // compare my dates if return date doe not after the departure date return false 
            }
            $this->form->check_names( 'origin', 'destination', 'way_points' );
            if( $this->form->get_result() ){                                        
                 
                          $offerdata = array(  'round_trip'     =>  $this->input->post('round_trip',     TRUE), // create offer first model for session
                                               'origin'         =>  $this->input->post('origin',         TRUE),
                                               'destination'    =>  $this->input->post('destination',    TRUE),
                                               'way_points'     =>  $this->input->post('way_points',     TRUE),
                                               'departure_date' =>  $this->input->post('departure_date', TRUE),
                                               'departure_time' =>  $this->input->post('departure_time', TRUE),
                                               'return_date'    =>  $this->input->post('return_date',    TRUE),
                                               'return_time'    =>  $this->input->post('return_time',    TRUE),
                                               'departure_days' =>  ""                                        ,
                                               'return_days'    =>  ""                                        ,
                                               'trip_type'      =>  0                                         , 
                                               'offer'          =>  TRUE      );
                            $this->session->set_userdata($offerdata);                                            // set session user data
                            $status = "success";                           
               
           }
           else
                 $status = "error";
           $error = $this->form->get_error();                        //  if there is error get it from Form validation class
           $result = array(  'status'  => $status,                   // JSON output     
                             'message' => $error['message'] );      
           echo json_encode($result);                                // JSON output      
    }

    /**
     * AJAX function
     * Teklif oluşturma işlemi 1.sayfa için triptype 1 
     *  
     * @return JSON output status : success, fail, error
    **/            
    public function createOffer2(){
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
            $this->form->date_compare($start, $end, lang("oc.start"), lang("oc.finish") );                             // compare my dates if return date doe not after the departure date return false 
            if( $round_trip == "true"  )                                                                               // is trip twoway   
                   $this->form->check( lang('oc.return_days')    ,'return_days' , 'required|is_day|xss_clean');        // check post data
            
            $this->form->check_names( 'origin', 'destination', 'way_points' );
            $result = $this->form->date_check(  $start, $end, $round_trip , $departure_days , $return_days  );
            if( $this->form->get_result() && count($result) > 0 ){   
                               $offerdata = array(  'round_trip'      =>  $this->input->post('round_trip',     TRUE),  // create offer first model for session
                                                    'origin'          =>  $this->input->post('origin',         TRUE),
                                                    'destination'     =>  $this->input->post('destination',    TRUE),
                                                    'way_points'      =>  $this->input->post('way_points',     TRUE),
                                                    'departure_date'  =>  $this->input->post('departure_date', TRUE),
                                                    'departure_time'  =>  $this->input->post('departure_time', TRUE),
                                                    'return_date'     =>  $this->input->post('return_date',    TRUE),
                                                    'return_time'     =>  $this->input->post('return_time',    TRUE),
                                                    'departure_days'  =>  $this->input->post('departure_days', TRUE),
                                                    'return_days'     =>  $this->input->post('return_days',    TRUE),
                                                    'trip_type'       =>  1                                         , 
                                                    'offer'           =>  TRUE        );
                                $this->session->set_userdata($offerdata);                               // set session user data
                                $status = "success";
                    
            }
            else
                  $status = "error";
            $error = $this->form->get_error();                        //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                   // JSON output     
                              'message' => $error['message'] );    
            echo json_encode($result);                                // JSON output                    
    }
  
  
    /**
     * AJAX function
     * Teklif tamamlama işlemi 
     *  
     * @return JSON output status : success, fail, error
    **/         
    public function createOffer(){ 
           $this->lang->load('offer_controller');                                           // load car_controller language file
           $user_id  =  $this->encrypt->decode( $this->session->userdata( 'userid') );      // decode userid 
           $this->saveOffer( $user_id );       
    }

    /**
     * AJAX function
     * Teklif tamamlama işlemi 
     *  
     * @return JSON output status : success, fail, error, path
    **/     
    private function saveOffer( $user_id ){
            $this->lang->load('offer_controller');                                                                                            // load car_controller language file
            $this->load->helper("offers");
            $this->load->helper("ajax");
            $this->form->check( lang('oc.inputPrices'      ), 'inputPrices',              'regex_match[/^([0-9 ?])+$/i]|xss_clean');          // check post data
            $this->form->check( lang('oc.inputPricesColor' ), 'inputPricesColor',         'regex_match[/^([a-z ?])+$/i]|xss_clean');          // check post data
            $this->form->check( lang('oc.DistancesWay'     ), 'DistancesWay',             'regex_match[/^([0-9 .?])+$/i]|xss_clean');         // check post data
            $this->form->check( lang('oc.TimesWay'         ), 'TimesWay',                 'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.car_id'           ), 'car_id',                   'required|is_natural_no_zero|xss_clean');           // check post data
            $this->form->check( lang('oc.luggage_id'       ), 'luggage_id',               'required|is_natural_no_zero|xss_clean');           // check post data
            $this->form->check( lang('oc.leave_time_id'    ), 'leave_time_id',            'required|is_natural_no_zero|xss_clean');           // check post data
            $this->form->check( lang('oc.price_per_pass'   ), 'price_per_passenger' ,     'required|is_natural|xss_clean');           // check post data
            $this->form->check( lang('oc.number_of_seats'  ), 'number_of_seats' ,         'required|greater_than[0]|less_than[9]|xss_clean'); // check post data
            $this->form->check( lang('oc.realDistance'     ), 'realDistance' ,            'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.realTime'         ), 'realTime' ,                'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.totalDistance'    ), 'totalDistance' ,           'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.totalTime'        ), 'totalTime' ,               'waypoints_match|xss_clean');                       // check post data
            $this->form->check( lang('oc.price_per_color'  ), 'price_per_passenger_color','regex_match[/^([a-z ?])+$/i]|xss_clean');          // check post data
            $this->form->check( lang('oc.explain_departure'), 'explain_departure' ,       'max_length[250]|xss_clean');                                       // check post data
            $this->form->check( lang('oc.explain_return'   ), 'explain_return' ,          'max_length[250]|xss_clean');                        // check post data
            $this->form->check( lang('oc.locations'        ), 'locations' ,               'check_array|xss_clean');                       // check post data
            $this->form->check( lang('oc.expectedPrices'   ), 'expectedPrices' ,          'check_array|xss_clean');                                        // check post data
            if( $this->form->get_result() ){                                        
                            $post_user_id              =  $user_id;                                                                 // decode userid 
                            $post_way_points           =  $this->session->userdata( 'way_points'     );                       // waypoints name like istanbul?Denizli     
                            $post_round_trip           =  $this->session->userdata( 'round_trip'     );                       // two way or one way trip  
                            $post_input_prices         =  $this->input->post('inputPrices',      TRUE);                       // waypoints prices like 4?5
                            $post_input_prices_color   =  $this->input->post('inputPricesColor', TRUE);                       // waypoints prices color like red?orange 
                            $post_input_distances      =  $this->input->post('DistancesWay',     TRUE);                       // waypoints distances like 234km?221km          
                            $post_input_times          =  $this->input->post('TimesWay',         TRUE);                       // waypoints distance hour like 34 dk?3 saat
                            $post_departure_days       =  $this->session->userdata('departure_days' );                        // departure days like pazartesi?salı
                            $post_return_days          =  $this->session->userdata('return_days'    );                        // return days like pazartesi?salı
                            
                            //added after
                            $locations      =  $this->input->post('locations'      , TRUE);
                            $expectedPrices =  $this->input->post('expectedPrices' , TRUE);
                            unset( $expectedPrices[0] );
                            if( $this->session->userdata( 'trip_type') == "1" ){
                                 $start          = trim( $this->session->userdata('departure_date' ) ). " " . trim( $this->session->userdata('departure_time' ) );
                                 $end            = trim( $this->session->userdata('return_date'   ) ). " " . trim( $this->session->userdata('return_time' ) );       
                                 $round_trip     = $post_round_trip;     // $this->input->post('round_trip',     TRUE);
                                 $departure_days = $post_departure_days; //$this->input->post('departure_days',     TRUE);
                                 $return_days    = $post_return_days;    //$this->input->post('return_days',     TRUE);
                                 $result = $this->form->date_check(  $start, $end, $round_trip , $departure_days , $return_days  );
                                 $rutin_trip_dates = $result; 
                            } else{
                                 $rutin_trip_dates = array();
                            } 
                            $post_round_trip           = ( strcmp( $post_round_trip , 'true') == 0 ) ? 1 : 0;                           // trip is two way or not 
                           
                            $is_active = 1;
                            if( $user_id == -1 ){
                                 $car = array( 'user_id' => $user_id  );
                                 $this->load->model('cars');
                                 $car_id =   $this->cars->Add($car);  
                                 $is_active = 0;   
                            }
                            else{
                                 $car_id = $this->input->post('car_id', TRUE);
                            }
                            $ride_offer = array( 'user_id'              => $post_user_id                                  ,   // create offer model for database
                                                 'car_id'               => $car_id ,
                                                 'luggage_id'           => $this->input->post('luggage_id',                TRUE) ,
                                                 'leave_time_id'        => $this->input->post('leave_time_id',             TRUE) ,
                                                 'trip_type'            => $this->session->userdata('trip_type'                ) ,   
                                                 'origin'               => $this->session->userdata( 'origin'                  ) ,
                                                 'destination'          => $this->session->userdata( 'destination'             ) ,
                                                 'departure_date'       => $this->session->userdata( 'departure_date'          ) ,
                                                 'departure_time'       => $this->session->userdata( 'departure_time'          ) ,
                                                 'return_date'          => $this->session->userdata( 'return_date'             ) ,
                                                 'return_time'          => $this->session->userdata( 'return_time'             ) ,
                                                 'round_trip'           => $post_round_trip                                      ,
                                                 'price_per_passenger'  => $this->input->post('price_per_passenger',       TRUE) ,
                                                 'is_active'            =>  $is_active ,
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
                                    $waypoint =  array(  'departure_place'     =>   $ride_offer['origin'] ,        
                                                         'arrivial_place'      =>   $points[0]            ,
                                                         'price'               =>   $prices[0]            ,
                                                         'distance'            =>   $distances[0]         ,
                                                         'time'                =>   $times[0]             ,
                                                         'price_class'         =>   $pricesColor[0]        );                   
                                    $waypoints[] =  $waypoint ;
                                    $ways_offer[] = $waypoint ;  
                                    for ($i=0; $i < count($points) - 1; $i++) { 
                                           $waypoint =  array(  'departure_place'     =>   $points[ $i]     ,        
                                                                'arrivial_place'      =>   $points[ $i + 1] ,
                                                                'price'               =>   $prices[$i + 1]  ,
                                                                'distance'            =>   $distances[$i + 1]      ,
                                                                'time'                =>   $times[$i + 1]          ,
                                                                'price_class'         =>   $pricesColor[$i + 1] );      
                                           $waypoints[] =  $waypoint ;
                                           $ways_offer[] = $waypoint ;
                                    }
                                    $waypoint =  array(  'departure_place'     =>   $points[ count($points) -1 ]  ,         
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
                             }  
                             if( strcmp($ride_offer['trip_type'] , "1") == 0 ){                     // if trip type is rutin trip there is departure days and return days
                                    $post_departure_days = trim($post_departure_days);     
                                    $post_return_days = trim($post_return_days);     
                                    $go = explode('?', $post_departure_days);                       // departure days split    
                                    if(  count($go) > 0 ){
                                              foreach ($go as $day) {
                                                  $days[] =  array( 'is_return'     =>   0        , 
                                                                    'day'           =>   $day      );
                                              }
                                              if( strcmp("1", $ride_offer['round_trip'] ) == 0 ){  // if trip is two way there is some return days
                                                   $back = explode('?', $post_return_days);        // return days split     
                                                   foreach ($back as $day) {
                                                           $days[] =  array(  'is_return'     =>   1        , 
                                                                              'day'           =>   $day      );
                                                   }            
                                              }
                                    }
                            }
                            $this->load->model('offersdb');                                                                         // load offersdb model 
                            $offer_id = $this->offersdb->saveOffer( $rutin_trip_dates, 
                                                                    $ride_offer, 
                                                                    $waypoints,
                                                                    $ways_offer,
                                                                    $days    ); 
                            if($offer_id){                                                                                          // offer has been saved succesfully unset session data       
                                  $origin      = $this->session->userdata('origin'       );
                                  $destination = $this->session->userdata('destination'  );
                                  $origin      = explode(',',$origin);
                                  $origin      = $origin[0];
                                  $destination = explode(',',$destination);
                                  $destination = $destination[0];   
                                  $name = urlCreate( $this->lang->lang(), $origin, $destination, $offer_id ); 
                                  $status = 'success';
                            }    
                            else{ 
                                 $status = "fail";
                                 $name = "null";
                            }
            }
            else{
                  $status = "error";
                  $name = "null";
            }
            $error = $this->form->get_error();                                  //  if there is error get it from Form validation class
            $result = array(  'status'  => $status,                             // JSON output     
                              'message' => $error['message'],
                              'path'    => $name    );
            echo json_encode($result);                                          // JSON output 
                                                                                // set session data for complete offer 
    }

} // END of the OffersAjax Class
/**
 * End of the file OffersAjax.php
 **/