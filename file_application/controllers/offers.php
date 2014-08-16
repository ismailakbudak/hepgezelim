<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  
 * Offers Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */


class Offers extends CI_Controller {

    /**
     *  global variable
    **/         
     public $userid;
     
    /**
     *  Constructor
    **/    
     public function __construct(){
          parent::__construct();    
          $this->load->helper("offers");
        
          // decode user id or set 0
          if( $this->session->userdata('logged_in') )
              $this->userid  = $this->encrypt->decode( $this->session->userdata('userid') );
          else
              $this->userid  = 0;  
            
     }
    
    /**
     *  Arama verilerini kaydet ve sayfayı yönlendir
     *
     *  @return  redirect 
    **/    
     public function redirect(){
          $this->lang->load('offerinfo');                                                              // load language file
          $origin            = $this->security->xss_clean( trim($this->input->get('origin')) );        // get GET[] data from URL  
          $lat               = $this->security->xss_clean( $this->input->get('lat') );                 // get GET[] data from URL  
          $lng               = $this->security->xss_clean( $this->input->get('lng') );                 // get GET[] data from URL
          $originStatus      = $this->security->xss_clean(  $this->input->get('originStatus') );       // get GET[] data from URL    
          $destination       = $this->security->xss_clean( trim($this->input->get('destination')) );   // get GET[] data from URL 
          $dLat              = $this->security->xss_clean( $this->input->get('dLat') );                // get GET[] data from URL     
          $dLng              = $this->security->xss_clean( $this->input->get('dLng') );                // get GET[] data from URL  
          $destinationStatus = $this->security->xss_clean( $this->input->get('destinationStatus') );   // get GET[] data from URL
          $range             = $this->security->xss_clean( $this->input->get('range') );               // get GET[] data from URL
          
          // if origin value is not set, redirect user to search page 
          if( strcmp($originStatus, "1") != 0 || strcmp($origin, "") == 0  || strcmp($lat, "") == 0  || strcmp($lng, "") == 0  || !isset($lat) || !isset($lng) || $lat <= 0 || $lng <= 0 )              // check origin point is set
                redirect("ara-seyahat");                                                  
          // check destination data is set
                  
          if( strcmp($destinationStatus,"1") != 0 || strcmp($destination, "") == 0 || $dLat <= 0  || $dLng <= 0 ){   
             $destination = "";
		         $destinationStatus = 0;
             $dLat = -1;
             $dLng = -1;
          } 
          // save search data to database
          $search =  array( 'user_id'           => $this->userid,   
                            'origin'            => $origin,
                            'lat'               => $lat,
                            'lng'               => $lng,
                            'originStatus'      => $originStatus,
                            'destination'       => $destination,
                            'dLat'              => $dLat,
                            'dLng'              => $dLng,
                            'destinationStatus' => $destinationStatus  );   
          $this->load->model('searched');                                     // load  searched model for database action
          $result = $this->searched->add($search);

          $sessionOrigin      = $origin;
          $sessionDestination = $destination;
          $origin = explode(",", $origin);
          $destination = explode(",", $destination);  
          $iller = array("ADANA","ADIYAMAN","AFYONKARAHISAR", "AĞRI","AMASYA","ANKARA","ANTALYA","ARTVIN","AYDIN", "BALIKESIR","BILECIK","BINGÖL","BITLIS","BOLU", "BURDUR","BURSA","ÇANAKKALE","ÇANKIRI","ÇORUM", "DENIZLI","DIYARBAKIR","EDIRNE","ELAZIĞ","ERZINCAN", "ERZURUM","ESKIŞEHIR","GAZIANTEP","GIRESUN", "GÜMÜŞHANE","HAKKARI","HATAY","ISPARTA","MERSIN", "ISTANBUL","IZMIR","KARS","KASTAMONU","KAYSERI", "KIRKLARELI","KIRŞEHIR","KOCAELI","KONYA","KÜTAHYA", "MALATYA","MANISA","KAHRAMANMARAŞ","MARDIN","MUĞLA", "MUŞ","NEVŞEHIR","NIĞDE","ORDU","RIZE","SAKARYA", "SAMSUN","SIRT","SINOP","SIVAS","TEKIRDAĞ","TOKAT", "TRABZON","TUNCELI","ŞANLIURFA","UŞAK","VAN", "YOZGAT","ZONGULDAK","AKSARAY","BAYBURT","KARAMAN", "KIRIKKALE","BATMAN","ŞIRNAK","BARTIN","ARDAHAN","IĞDIR", "YALOVA","KARABÜK","KILIS","OSMANIYE","DÜZCE");
          $place1 = "";
          $flag1  = FALSE;
          $flag2  = FALSE;
          $place2 = "";
          foreach ($origin as  $value) {
               if(  in_array(  mb_strtoupper( mb_strtolower(trim( $value ), 'utf-8'), 'utf-8')  ,  $iller ) ){
                      $place1 = trim($value);
                      $flag1  = TRUE;
                      break;
               }  
          }
          foreach ($destination as  $value) {
               if(  in_array(  mb_strtoupper( mb_strtolower( trim( $value ), 'utf-8'), 'utf-8')  ,  $iller ) ){
                      $place2 = trim($value);
                      $flag2  = TRUE;
                      break;
               }  
          }
         
          if( !$flag1 )
              $place1 = trim($origin[0]);
          if( !$flag2 )
              $place2 = trim($destination[0]);
          $searchData =  array( 'offerInfo'         => 1,
                                'offerAlertSave'    => 0,
                                'countOffer'        => 1, 
                                'origin'            => $sessionOrigin,
                                'lat'               => $lat,
                                'lng'               => $lng,
                                'originStatus'      => $originStatus,
                                'destination'       => $sessionDestination,
                                'dLat'              => $dLat,
                                'dLng'              => $dLng,
                                'destinationStatus' => $destinationStatus,
                                'place1'            => $place1, 
                                'place2'            => $place2,
                                'range'             => $range  );   
          $this->session->set_userdata( $searchData );  
         
          $query= "origin=$place1&lat=$lat&lng=$lng&destination=$place2&dLat=$dLat&dLng=$dLng&originStatus=$originStatus&destinationStatus=$destinationStatus&range=$range";    
          if( strcmp(lang('lang'), "tr") == 0 )
                redirect("ara-seyahat-sonuc?$query");
          else
                redirect("search-travel-result?$query");
     }

    /**
     * Arama sonuçlarını göster
     * 
     *  
     * @return HTML views
    **/         
     public function search( ){
          $this->lang->load('offerinfo');                                                              // load language file
          $origin            = $this->security->xss_clean( trim($this->input->get('origin')) );        // get GET[] data from URL  
          $lat               = $this->security->xss_clean( $this->input->get('lat') );                 // get GET[] data from URL  
          $lng               = $this->security->xss_clean( $this->input->get('lng') );                 // get GET[] data from URL
          $originStatus      = $this->security->xss_clean(  $this->input->get('originStatus') );       // get GET[] data from URL    
          $destination       = $this->security->xss_clean( trim($this->input->get('destination')) );   // get GET[] data from URL 
          $dLat              = $this->security->xss_clean( $this->input->get('dLat') );                // get GET[] data from URL     
          $dLng              = $this->security->xss_clean( $this->input->get('dLng') );                // get GET[] data from URL  
          $destinationStatus = $this->security->xss_clean( $this->input->get('destinationStatus') );   // get GET[] data from URL
          $range             = $this->security->xss_clean( $this->input->get('range') );               // get GET[] data from URL
          if( strcmp($originStatus, "1") != 0 && strcmp($origin, "") == 0 && $this->session->userdata('offerInfo') ){
               $this->session->set_userdata('countOffer', $this->session->userdata('countOffer') + 1 );
               if( $this->session->userdata('countOffer') >= 4 ){
                   $searchData =  array( 'offerInfo'         => 0,
                                         'offerAlertSave'    => 1,
                                         'countOffer'        =>"", 
                                         'origin'            =>"",   
                                         'lat'               =>"",   
                                         'lng'               =>"",   
                                         'originStatus'      =>"",   
                                         'destination'       =>"",   
                                         'dLat'              =>"",   
                                         'dLng'              =>"",   
                                         'destinationStatus' =>"",
                                         'place1'            =>"", 
                                         'place2'            =>"",
                                         'range'             =>""     ); 
                  $this->session->unset_userdata($searchData);
                  redirect("ara-seyahat");
               }
               $origin            = $this->session->userdata('place1'            );   // get GET[] data from URL  
               $lat               = $this->session->userdata('lat'               );   // get GET[] data from URL  
               $lng               = $this->session->userdata('lng'               );   // get GET[] data from URL
               $originStatus      = $this->session->userdata('originStatus'      );   // get GET[] data from URL    
               $destination       = $this->session->userdata('place2'            );   // get GET[] data from URL 
               $dLat              = $this->session->userdata('dLat'              );   // get GET[] data from URL     
               $dLng              = $this->session->userdata('dLng'              );   // get GET[] data from URL  
               $destinationStatus = $this->session->userdata('destinationStatus' );   // get GET[] data from URL
          }
         
          // if origin value is not set, redirect user to search page 
          if( strcmp($originStatus, "1") != 0 || strcmp($origin, "") == 0  || strcmp($lat, "") == 0  || strcmp($lng, "") == 0  || !isset($lat) || !isset($lng) || $lat <= 0 || $lng <= 0 )              // check origin point is set
                redirect("ara-seyahat");                                                 
          // check destination data is set      
          if( strcmp($destinationStatus,"1") != 0 || strcmp($destination, "") == 0 || $dLat <= 0  || $dLng <= 0 ){    
             $destination = "";
		         $destinationStatus = 0;
             $dLat = -1;
             $dLng = -1;
          } 
          $this->load->model('offersdb');                                                // load offersdb model for database action   
          $this->load->model('users');                                                   // load users model for database action   
          $this->load->helper('search');
          $limit = 3;
          $offset = 0;
          $results = $this->offersdb->search($origin, $destination,$lat, $lng, $dLat, $dLng, $range,  $limit, $offset);
          $counts  = $this->offersdb->searchCount($origin, $destination,$lat, $lng, $dLat, $dLng, $range,  $limit, $offset);
          $levels  = $this->users->GetUserLevels();
          if( is_array($results) && is_array($levels) ) {
              $on                       = 'departure_date';
              $results                  = array_sort($results, $on, $order=SORT_ASC);
              $urlString                = "?origin=$origin&lat=$lat&lng=$lng&destination=$destination&dLat=$dLat&dLng=$dLng&originStatus=$originStatus&destinationStatus=$destinationStatus&range=$range"; 
              $urlWithoutRange          = "?origin=$origin&lat=$lat&lng=$lng&destination=$destination&dLat=$dLat&dLng=$dLng&originStatus=$originStatus&destinationStatus=$destinationStatus"; 
              $data['getDataUrl']       = $urlString;  
              $data['urlWithoutRange']  = $urlWithoutRange;  
              $data['range']            = $range;
              
              $data['x1']      = $lat;  
              $data['x2']      = $dLat;  
              $data['y1']      = $lng;  
              $data['y2']      = $dLng;  
              $data['status1'] = $originStatus;  
              $data['status2'] = $destinationStatus;  
             
              $data['offset']      = $limit + $offset; 
              $data['origin']      = $origin;  
              $data['destination'] = $destination;  
              $data['results']     = $results;                      
              $data['counts']      = $counts;  
              $data['levels']      = $levels;  
              
              $this->lang->load('search');                       // load language file
              $this->login->general( $data );                    // load views
              $this->load->view('main/searchResult');            // load views
              $this->load->view('include/footer');               // load views
          }
          else{
              show_404('offer');
          }  
          
     }

    /**
     * AJAX function
     * AJAX ile arama verilerini yükle 
     * 
     * @return JSON $array teklif listesi
    **/   
    function searchAjax( $OFFSET ){
          $this->lang->load('offerinfo');                                                              // load language file
          $origin            = $this->security->xss_clean( trim($this->input->get('origin')) );        // get GET[] data from URL  
          $lat               = $this->security->xss_clean( $this->input->get('lat') );                 // get GET[] data from URL  
          $lng               = $this->security->xss_clean( $this->input->get('lng') );                 // get GET[] data from URL
          $originStatus      = $this->security->xss_clean(  $this->input->get('originStatus') );       // get GET[] data from URL    
          $destination       = $this->security->xss_clean( trim($this->input->get('destination')) );   // get GET[] data from URL 
          $dLat              = $this->security->xss_clean( $this->input->get('dLat') );                // get GET[] data from URL     
          $dLng              = $this->security->xss_clean( $this->input->get('dLng') );                // get GET[] data from URL  
          $destinationStatus = $this->security->xss_clean( $this->input->get('destinationStatus') );   // get GET[] data from URL
          $range             = $this->security->xss_clean( $this->input->get('range') );               // get GET[] data from URL
         
          // check origin point is set    
          if(  strcmp($originStatus, "1") == 0 && strcmp($origin, "") != 0 && is_numeric($OFFSET) &&  $OFFSET != 0 ){           
               // check destination data is set
               if( strcmp($destinationStatus,"1") != 0 || strcmp($destination, "") == 0 )     
                    $destination = "";
                $this->load->model('offersdb');                    // load offersdb model for database action                                                  
                $this->load->helper('search');
                $this->lang->load('search');                       // load language file
              
                $limit = 3;
                $offset = $OFFSET;
                $offers = $this->offersdb->search($origin, $destination,$lat, $lng, $dLat, $dLng, $range, $limit, $offset);     
                if( is_array( $offers ) ){
                    
                      $on      = 'departure_date';
                      $results = array_sort($offers, $on, $order=SORT_ASC);
                      $offset     = $OFFSET + $limit;
                      if( count($offers) > 0 ){
                           $date       = date('Y'); 
                           $countPrice = $results['countPrice'];
                           $offers     = array();
                           foreach ($results['offers'] as $v) 
                                $offers[]  = writeOffer($v,$date, $countPrice, $offset);   
                           $results['countPrice'] = $countPrice; 
                           $results['offers']     = $offers;
                      }else{
                           $results['offers'] = array();      
                      }
                      $status  = "success ";
                }else{
                    $status = "error";
                }
          }
          else                                                                   // origin not initialized
                $status = "error"; 
          
          $result = array(  'status'     => $status,                             // JSON output     
                            'results'    => isset($results) ? $results : array(),
                            'text'       => isset($text)  ? $text : ""  );    
          echo json_encode($result);                                             // JSON output   
    }
    
    /**
     * Arama sayfasından alınan veriler ile teklif detaylarını göster
     * 
     * @param  $url_title 
     * @return HTML view
     * tip 0 -> ride_offer_id,  1 -> date_id
     **/    
    public function detailSearch($url_title ){
            $this->lang->load('offerinfo');          // load language file
            if( ! isset($url_title) ){
                   show_404('offer');  
            }
            $url = explode("-", $url_title);
            
            if( count($url) == 6 ){
                    $this->load->helper('offer_detail_search'); // load offer_detail_helper file
                    $this->load->model('offersdb');             // load offersdb model for database action  
                    $this->load->model('look_at');              // load look_at model for database action  
                 
                    $origin      = $url[0];
                    $destination = $url[1];
                    $id          = $url[2] ;
                    $tip         = $url[3] ;
                    $no          = $url[4] ;
                    $WoID        = $url[5] ;
                    $lang        = lang('lang');
					
                    if( ! is_numeric($id) ||  ! is_numeric($tip) || !is_numeric($no) ||  !is_numeric($WoID) ||
                         $tip < 0  || $tip > 1 || $no < 1 || $no > 8  ){
                       show_404('offer'); exit;  
                    }  
                  
				            $offer       = $this->offersdb->GetOfferForSearchResult(  $id,  $tip,  $no,   $WoID   );   // get offer
                    
                    if( is_array($offer) && count($offer) > 0 ){
                        $offer['foto_name']     = photoCheckCar($offer);                                       // check photo car is exist 
                        $offer['user']['foto']  = photoCheckUser($offer['user']);                              // check photo car is exist 
                        $offer['no']            = $no;
                        $offer['tip']           = $tip;
                        $offer['id']            = urlencode( base64_encode(  $offer['ride_offer_id'] ) );  
                        foreach ($offer['user']['ratings'] as &$value)
                             $value['foto']     = photoCheckUser($value);
                          
                        // page loads
                        $page = "";
                        $is_reverse = false; 
					              $scale_time = 150.86;
                        if( $no == 1 ){                   // Tek seferlik GİDİŞ no way 
                              $page                       = "search1";
                        } 
                        else if( $no == 2 ){              // Tek seferlik DÖNÜŞ no way 
                              $temp                       = $offer['origin'];
                              $offer['origin']            = $offer['destination'];
                              $offer['destination']       = $temp;
							                // change map direction
							                $temp                    = $offer['originMap'];
                              $offer['originMap']      = $offer['destinationMap'];
                              $offer['destinationMap'] = $temp;
									   
                              $temp                       = $offer['departure_date'];
                              $offer['departure_date']    = $offer['return_date'];
                              $offer['return_date']       = $temp;
                              $temp                       = $offer['departure_time'];
                              $offer['departure_time']    = $offer['return_time'];
                              $offer['return_time']       = $temp;
                              $temp                       = $offer['explain_departure'];
                              $offer['explain_departure'] = $offer['explain_return'];
                              $offer['explain_return']    = $temp;
                              $page                       = "search1";
                              $is_reverse                 = true;
                        } 
                        else if( $no == 3 ){              // Çok seferlik GİDİŞ no way 
                              $page                       = "search1";
                              $offer['rutinDates']        =  array( array('date' => $offer['date'], 'is_return' => $offer['is_return'] ) );
                        }    
                        else if( $no == 4 ){             // Çok seferlik DÖNÜŞ no way 
                              $temp                       = $offer['origin'];
                              $offer['origin']            = $offer['destination'];
                              $offer['destination']       = $temp;
							                // change map direction
							                $temp                    = $offer['originMap'];
                              $offer['originMap']      = $offer['destinationMap'];
                              $offer['destinationMap'] = $temp;
									            $temp                       = $offer['departure_date'];
                              $offer['departure_date']    = $offer['return_date'];
                              $offer['return_date']       = $temp;
                              $temp                       = $offer['departure_time'];
                              $offer['departure_time']    = $offer['return_time'];
                              $offer['return_time']       = $temp;
                              $temp                       = $offer['explain_departure'];
                              $offer['explain_departure'] = $offer['explain_return'];
                              $offer['explain_return']    = $temp;
                              $page                       = "search1";
                              $offer['rutinDates']        =  array( array('date' => $offer['date'], 'is_return' => $offer['is_return'] ) );
                              $is_reverse                 = true;   
                        } 
                        else if( $no == 5 ){        // Tek seferlik GİDİŞ yes way 
                                        $ways     = array();
                                        $way_points = $offer['way_points'];
                                        foreach ($way_points as $way) {                                         
                                                $way_origin      =  $way['departure_place'];     // split origin point by comma
                                                $way_destination =  $way['arrivial_place'];      // split origin point by comma
                                                if( !in_array($way_origin , $ways)  )            // if it is not in array add origin 
                                                     $ways[] = $way_origin;
                                                if( !in_array($way_destination , $ways)  )       // if it is not in array add destination
                                                     $ways[] = $way_destination;
                                                 
							                          }        
                                        $index_origin      = array_search($offer['origin'], $ways);
                                        $index_destination = array_search($offer['destination'], $ways);
                                        if( $index_origin != 0 ){  // for date configuretion
                                             $offer['estimated'] = 1;
                                        }
                                        $data['ways']        = $ways;  
                                        $page = "searchDeparture";
                        } 
                        else if( $no == 6 ){        // Tek seferlik DÖNÜŞ yes way 
                                       $ways     = array();
                                       $way_points = $offer['way_points'];                       // array for waypoints 
                                       foreach ($way_points as $way) {                                         
                                               $way_origin      =   $way['departure_place'];     // split origin point by comma
                                               $way_destination =   $way['arrivial_place'];      // split origin point by comma
                                               if( !in_array($way_origin , $ways)  )             // if it is not in array add origin 
                                                    $ways[] = $way_origin;
                                               if( !in_array($way_destination , $ways)  )        // if it is not in array add destination
                                                    $ways[] = $way_destination;
                                       }  
                                       $temp                 = $offer['origin'];
                                       $offer['origin']      = $offer['destination'];
                                       $offer['destination'] = $temp;
                                       // change map direction
									                     $temp                    = $offer['originMap'];
                                       $offer['originMap']      = $offer['destinationMap'];
                                       $offer['destinationMap'] = $temp;
									                     // change date
                                       $temp                    = $offer['departure_date'];
                                       $offer['departure_date'] = $offer['return_date'];
                                       $offer['return_date']    = $temp;
                                       // change time
                                       $temp                    = $offer['departure_time'];
                                       $offer['departure_time'] = $offer['return_time'];
                                       $offer['return_time']    = $temp;
                                       
                                       // change explain
                                       $temp                       = $offer['explain_departure'];
                                       $offer['explain_departure'] = $offer['explain_return'];
                                       $offer['explain_return']    = $temp;
                                       // change way points
                                       $waysReturn = array();
                                       for ($i= count($ways) -1; $i >= 0 ; $i--) 
                                           $waysReturn[] = $ways[$i];    
                                       
									                     $index_origin      = array_search($offer['origin'], $ways);
                                       $index_destination = array_search($offer['destination'], $ways);
                                       
                                       if( $index_origin != count($ways) - 1 ){  // for date configuretion
                                           $offer['estimated'] = 1;
                                       } 
                                       $data['ways']        = $waysReturn; 
                                       $is_reverse          = true;
                                       $page                = "searchReturn"; 
                                        
                        } 
                        else if( $no == 7 ){        // Çok seferlik GİDİŞ yes way 
                                        // url e göre seyahati biçimlendirme kısmı       
                                        $offer['rutinDates'] =  array( array('date' => $offer['date'], 'is_return' => $offer['is_return'] ) );
                                        $ways     = array();
                                        $way_points = $offer['way_points'];
                                        foreach ($way_points as $way) {                                         
                                                $way_origin      = $way['departure_place'];      // split origin point by comma
                                                $way_destination = $way['arrivial_place'] ;      // split origin point by comma
                                                if( !in_array($way_origin , $ways)  )            // if it is not in array add origin 
                                                     $ways[] = $way_origin;
                                                if( !in_array($way_destination , $ways)  )       // if it is not in array add destination
                                                     $ways[] = $way_destination;
                                        }
                                        $index_origin      = array_search( $offer['origin'],       $ways);
                                        $index_destination = array_search( $offer['destination'],  $ways);
                                        if( $index_origin != 0 ){  // for date configuretion
                                            $offer['estimated']             = 1;
                                        } 
                                        $data['ways']        = $ways;  
                                        $page                = "searchDeparture";
                               
                        } 
                        else if( $no == 8 ){        // Çok seferlik DÖNÜŞ yes way 
                                       // url e göre seyahati biçimlendirme kısmı       
                                       $offer['rutinDates'] =  array( array('date' => $offer['date'], 'is_return' => $offer['is_return'] ) );
                                       $ways     = array();
                                       $way_points = $offer['way_points'];                       // array for waypoints 
                                       foreach ($way_points as $way) {                                         
                                               $way_origin      =  $way['departure_place'];     // split origin point by comma
                                               $way_destination =  $way['arrivial_place'];      // split origin point by comma
                                               if( !in_array($way_origin , $ways)  )            // if it is not in array add origin 
                                                    $ways[] = $way_origin;
                                               if( !in_array($way_destination , $ways)  )       // if it is not in array add destination
                                                    $ways[] = $way_destination;
                                       }
                                       $temp                 = $offer['origin'];
                                       $offer['origin']      = $offer['destination'];
                                       $offer['destination'] = $temp;
									   
									                     // change map direction
									                     $temp                    = $offer['originMap'];
                                       $offer['originMap']      = $offer['destinationMap'];
                                       $offer['destinationMap'] = $temp;
									   

                                       // change date
                                       $temp                    = $offer['departure_date'];
                                       $offer['departure_date'] = $offer['return_date'];
                                       $offer['return_date']    = $temp;
                                       // change time
                                       $temp                    = $offer['departure_time'];
                                       $offer['departure_time'] = $offer['return_time'];
                                       $offer['return_time']    = $temp;
                                       
                                       // change explain
                                       $temp                       = $offer['explain_departure'];
                                       $offer['explain_departure'] = $offer['explain_return'];
                                       $offer['explain_return']    = $temp;
                                       // change way points
                                       $waysReturn = array();
                                       for ($i= count($ways) -1; $i >= 0 ; $i--) 
                                           $waysReturn[] = $ways[$i];    
                                       
                                       $index_origin      = array_search( $offer['origin'],       $ways);
                                       $index_destination = array_search( $offer['destination'],  $ways);
                                       
                                       if( $index_origin != count($ways) - 1 ){  // for date configuretion
                                           $offer['estimated']             = 1;
                                       }
                                       $data['ways']        = $waysReturn; 
                                       $is_reverse          = true;
                                       $page                = "searchReturn"; 
                        }
                        else{
                            show_404('offer');
                            exit();
                        }
                       
                        // done 
                        // check offer does belongs to login user if not add look_at new model
                        $data['own_offer'] = ( strcmp($this->userid, $offer['user_id']) == 0 ) ? 1 : 0;    // this offer is it belong to session user    
                        if( !$data['own_offer']  ){
                        	       $link  = strcmp($lang, "tr") == 0 ? "seyahat-" : "travel-";
							                   $link  .= $url_title;                                                     // if offer does not belong to logined user 
                                 $this->look_at->add(  array(  'ride_offer_id' => $offer['ride_offer_id'], 
                                                               'origin'        => $offer['origin'],
                                                               'destination'   => $offer['destination'],
                                                               'user_id'       => $this->userid,
                                                               'path'          => $link ) );               // add new look_at model
                        }
                        
                        $offer['is_reverse']    = $is_reverse;
                        $data['is_reverse']     = $is_reverse;
                        $data['offer']          = $offer;                        // send offer to view
                       
					              $this->login->general( $data);                           // load views
                        $this->load->view('offers/'. $page );                    // load views
                        $this->load->view('include/footer' );                    // load views
                    }  
                    else{                          // offer alınırken hata oluştu 
                         show_404('offer');        // show error page
                    }
             }
            else{                                  // count($url) != 5
                   show_404('offer');              // show error page
            }                       
    }

    /**
     * Teklif detaylarını göster
     * 
     * @param  $url_title  teklife ait origin, destination ve offer_id içerir 
     * @return HTML view
    **/    
    public function detail($url_title ){
              $this->lang->load('offerinfo');                          // load language file
              $this->load->helper('offer_detail');                     // load offer_detail_helper file
              $data['active'] = '#offers';                             // active profile menu
              $this->load->model('offersdb');                          // load offersdb model for database action   
              $this->load->model('way_points');                        // load way_points model for database action 
              $this->load->model('rutin_trips');                       // load rutin_trips model for database action
              if( ! isset($url_title) ){
                  show_404('offer'); 
                  exit;  
              }
              $url = explode("-", $url_title);
              $offerid = $url[ count($url) - 1 ];
              $offer_id =  $offerid; // base64_decode( urldecode( $offerid ) );               // decode offer id
              $offerid  =  urlencode( base64_encode( $offerid ) );
              $offer = $this->offersdb->GetOffer($offer_id );                                 // get offer
              if( $offer && count($url) == 3 ){
                    $this->load->model('users');                                              // load user modal for database   
                    $this->load->model('look_at');                                            // load look_at model for database action  
                    $this->load->model('cars');                                               // load cars model for database action  
                    $this->load->model('leave_times');                                        // load leave_times model for database action  
                    $this->load->model('luggages');                                           // load luggages model for database action  
                    $this->load->model('messages');                                           // load messages model for database action  
                    $this->load->model('ratings_db');                                         // load ratings_db model for database action  
                    $luggage         = $this->luggages->GetLuggage($offer['luggage_id'] );             // get all luggages options  
                    $leave_time      = $this->leave_times->GetLeaveTime( $offer['leave_time_id'] );    // get all leave times options 
                    $user            = $this->users->GetUserAllInfo($offer['user_id']);                // get user      
                    $car             = $this->cars->GetCar($offer['car_id']);                          // get offer car 
                    $offers_count    = $this->offersdb->GetUserOfferCount( $offer['user_id'] ); 
                    $ratings         = $this->ratings_db->GetUserRatingsSide( $offer['user_id']  );
                    $way_points      = $this->way_points->GetOfferWays($offer_id);                     // get offer waypoints  
                    if( $user && $car && $leave_time && $luggage  && is_array($ratings) && is_array($way_points)  ){
                              $look_count            =  $this->look_at->GetLookCount( $offer_id ) ;    // get looked people count for this offerid    
                              $offer['no_encryp_id'] = $offer_id;
                              $offer['look_count']   = (count($look_count) > 0)  ? $look_count : array('ride_offer_id' => $offerid, 'look' => '0' );  // if there is no data for view assign it 0
                              $user['foto']          = photoCheckUser($user); 
                              $user['offer_count']   = $offers_count['offers_count']; 
                              foreach ($ratings as &$value)
                                   $value['foto'] = photoCheckUser($value);
                              
                              $user['ratings']       = $ratings;
                              $user['total']         = $this->ratings_db->totalRating( $offer['user_id']  );           // send total value to view
                              $user['avg']           = $this->ratings_db->GetUserAverageRatings( $offer['user_id'] );  // send avg value to view
                              $data['user']          = $user;                                                          // send to user info to view
                              
                              $login_userid        = ($this->session->userdata('logged_in') == true ) ? $this->encrypt->decode( $this->session->userdata( 'userid') ) : "-1"; 
                              $data['own_offer']   = ( strcmp($login_userid, $offer['user_id']) == 0 ) ? 1 : 0;    // this offer is it belong to session user    
                              $car['foto_name']    = photoCheckCar($car);                                          // check photo car is exist 
                              
                              if( !$data['own_offer']  ){                                                          // if offer does not belong to logined user 
                                       $link  = strcmp(lang('lang'), "tr") == 0 ? "detay-" : "detail-";
							                         $link  .= $url_title;                                                       // if offer does not belong to logined user 
                                
                                       $this->look_at->add(  array(  'ride_offer_id' => $offer_id, 
                                                                     'origin'        => $offer['origin'],
                                                                     'destination'   => $offer['destination'],
                                                                     'user_id'       => $this->userid,
                                                                     'path'          => $link ) );                 // add new look_at model
                              }
                              // url e göre seyahati biçimlendirme kısmı       
                              $origin      = explode(",", $offer['origin']);                        // split origin point by comma
                              $origin      = temizle($origin[0]);                                   // take first array value  
                              $destination = explode(",", $offer['destination']);                   // split destination point tby comma 
                              $destination = temizle($destination[0]);                              // take array first value  
                             
                              if( $offer['trip_type'] == "1" ){
                                   // change date
                                   $offer['departure_date_normal'] = $offer['departure_date'];
                                   $offer['return_date_normal']    = $offer['return_date'];
                                   // change time
                                   $offer['departure_time_normal'] = $offer['departure_time'];
                                   $offer['return_time_normal']    = $offer['return_time'];
                                   $rutinDates = $this->offersdb->getRutinDates($offer_id);
                                   if( $rutinDates ){
                                      $offer['rutinDates'] = $rutinDates;
                                   }
                                   else{
                                        show_404("offer");                                         // page could not found  
                                        exit;
                                   } 
                              }  
                              if( strcmp($url[0], $origin) == 0 &&  strcmp($url[1], $destination) == 0 ){ // eğer istek origin ve destination içinse                       
                                      // gidiş yolculuğunu göster
                                      $data['is_reverse']  = false;
                                      $offer['is_reverse'] = false;
                                      $offer['car']        = $car;                             // send car to view
                                      $offer['way_points'] = $way_points;
                                      $offer['leave_time'] = $leave_time;                      // send leave_time to view
                                      $offer['luggage']    = $luggage;                         // send luggage to view
                                      $offer['id']         = $offerid;                         // send offer_id to view 
                                      $data['offer']       = $offer;                           // send offer to view
                                      $this->login->general( $data);                           // load views
                                      $this->load->view('offer/detail');                       // load views
                                      $this->load->view('include/footer');                     // load views
                              }
                              else if( $offer['round_trip'] == 1 && strcmp($url[1], $origin) == 0 &&  strcmp($url[0], $destination) == 0 ){ // eğer istek origin ve destination için dönüş ise 
                                      // dönüş yolculuğunu göster
                                      // change points
                                      $temp                 = $offer['origin'];
                                      $offer['origin']      = $offer['destination'];
                                      $offer['destination'] = $temp;

                                      // change date
                                      $temp                    = $offer['departure_date'];
                                      $offer['departure_date'] = $offer['return_date'];
                                      $offer['return_date']    = $temp;
                                      // change time
                                      $temp                    = $offer['departure_time'];
                                      $offer['departure_time'] = $offer['return_time'];
                                      $offer['return_time']    = $temp;
                                      // change explain
                                      $temp                       = $offer['explain_departure'];
                                      $offer['explain_departure'] = $offer['explain_return'];
                                      $offer['explain_return']    = $temp;
                                      // change way points
                                      $data['is_reverse']  = true ;
                                      $offer['is_reverse'] = true; 
                                      $offer['car']        = $car;                             // send car to view
                                      $offer['way_points'] = $way_points;
                                      $offer['leave_time'] = $leave_time;                      // send leave_time to view
                                      $offer['luggage']    = $luggage;                         // send luggage to view
                                      $offer['id']         = $offerid;                         // send offer_id to view 
                                      $data['offer']       = $offer;                           // send offer to view
                                      $this->login->general( $data);                           // load views
                                      $this->load->view('offer/detail');                       // load views
                                      $this->load->view('include/footer');                     // load views
                              }
                              else{
                                  show_404("offer");//redirect('offers');        // page could not found   
                              }    
                    }
                    else{                                                           
                        show_404("offer");// redirect('offers'); // page could not found   
                    }
              }
              else{
                   show_404("offer");//redirect('offers');        // page could not found   
              }     
    }

   /*********************************** Private methods for using *************************************************************/
    /**
     *  Sayfaları yükleme metodu
     *
     *  @param  $data    sayfa içeriklerini tutan dizi 
     *  @param  $content  yüklencek sayfanın ismi
     *  @return HTML view
    **/    
    private function loadContent( $data = array(),  $viewContent  ){
               $this->login->loadViewHead( $data);                   //load views
               $this->load->view('offer/offerHead' );                //load views
               $this->load->view('offer/'.$viewContent );            //load views
               $this->load->view('offer/offerFoot' );                //load views
               $this->login->loadViewHeadFoot();                     //load views
    } 



} // END of the Offers Class
/**
 * End of the file offer
 **/