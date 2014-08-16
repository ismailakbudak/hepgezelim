<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Offersdb Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Offersdb extends CI_Model {
    
    /**
     * global variable  
    **/     
    public $table;
    
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
        $this->table = 'ride_offers';
    } 

    /**
     *  Update offer method
     *  @parameter offerid, offer
     *  RETURN TRUE or FALSE
    **/
    function UpdateOffer($offer_id, $offer){
    	    // sunucuda zaman geri olduğu için
    	    $offer['updated_at'] =  date('Y-m-d H:i:s');
            $offer['explain_approval']  = 0;                                             
            $this->db->where('id', $offer_id);
            $query = $this->db->update($this->table, $offer); 
            if($query)
                 return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
            else
                 return false;
    }
  
    /****
     | 
     |  Delete offer information with id
     |  @parameter offerid
     |  @RETURN TRUE or FALSE
     |
     ****/   
    function deleteOffer($offer_id){

            $this->db->trans_begin();  // because of so many action we need to check all result 
            //$query1 =  $this->db->delete('way_points', array('ride_offer_id' => $offer_id));
            //$query2 =  $this->db->delete('rutin_trip', array('ride_offer_id' => $offer_id));
            //$query4 =  $this->db->delete('rutin_trip_dates', array('ride_offer_id' => $offer_id));
            //$query5 =  $this->db->delete('ways_offer', array('ride_offer_id' => $offer_id));
            $query3 =  $this->db->delete('ride_offers', array('id'           => $offer_id));
            if($query3 ){    // && $query2 && $query1 && $query4 && $query5 ){
                   if($this->db->affected_rows() > 0) 
                      $result = TRUE;
                   else 
                       $result = FALSE;
            }      
            else{
                  $result = FALSE;
            }
            if ($this->db->trans_status() == FALSE || $result == FALSE){ 
                  $this->db->trans_rollback();                                // there is some error rollback
                  return FALSE;
            }
            else{
                  $this->db->trans_commit();                                  // everything is ok commit actions.
                  return TRUE;
            } 
    } 

    /**
     *  Get offer information with id
     *  @parameter offerid
     *  RETURN row or FALSE
    **/
    function GetOffer($offer_id){
           $this->db->where('id =', $offer_id);
           $query = $this->db->get($this->table);   
           if($query)
              return  $query->row_array(); 
           else
             return FALSE;
    }
    

    /**
     *  Save offer return days
     *  @parameter offer-id and days
     *  RETURN TRUE or FALSE
    **/
    function addDays($rutin_trip_dates, $new_rutin_days, $offer_id){
            $this->db->trans_begin();                                           // because of so many action we need to check all result 
            $result = TRUE;
            if( count($rutin_trip_dates) > 0 ){
                  foreach ($rutin_trip_dates as &$value) {
                        $value['ride_offer_id'] = $offer_id;
                  }
                  $query = $this->db->insert_batch('rutin_trip_dates', $rutin_trip_dates);
                  if( $query ){
                         if( $this->db->affected_rows() > 0 )
                             $result = TRUE;
                         else
                               $result = FALSE;
                  }
                  else
                      $result = FALSE;
            }
            if( $result && count($new_rutin_days) > 0 ){
                      $query = $this->db->insert_batch('rutin_trip', $new_rutin_days);
                      if( $query ){
                             if( $this->db->affected_rows() > 0 )
                                 $result = TRUE;
                             else
                                   $result = FALSE;
                      }
                      else
                          $result = FALSE;
            }
            else
                $result = FALSE;
             if ($this->db->trans_status() == FALSE || $result == FALSE){ 
                 $this->db->trans_rollback();                                // there is some error rollback
                 return FALSE;
             }
             else{
                 $this->db->trans_commit();                                  // everything is ok commit actions.
                 return TRUE;
             }
    }

    /**
     *  Save offer method
     *  @parameter offer, waypoints_prices, waypoints_price_color, waypoints_distance, waypoints_distance_time, departure_days, return_days 
     *  RETURN TRUE or FALSE
    **/
    function saveOffer( $rutin_trip_dates, 
                        $ride_offer, 
                        $waypoints,
                        $ways_offer,
                        $days     ) 
    {        
             $ride_offer['is_way'] = ( count($waypoints) > 0 ) ? 1 : 0;
            
             // Email alarmlarını kontrol et
             $addAlerts = array();              // Tüm eklenen alert id lerin tutulduğu dizi
             $range = 0.5;                      // Position'a göre aramada kullanılan yarıçap alanı yaklaşık 50 km 
              // sunucuda zaman geri olduğu için
    	     $date = date('Y-m-d');             // Bugünün tarihi
             $user_id = $ride_offer['user_id']; // Teklifi yapan kullanıcının id si
             foreach ($ways_offer as $offer ) {

                     // her bir sefer için position ve origin destination kısımlarını al   
                     $origin      = $offer['departure_place']; 
                     $destination = $offer['arrivial_place'];
                     $min_lat     = $offer['lat']  - $range; 
                     $max_lat     = $offer['lat']  + $range;
                     $min_lng     = $offer['lng']  - $range;
                     $max_lng     = $offer['lng']  + $range;
                     $min_dLat    = $offer['dLat'] - $range;
                     $max_dLat    = $offer['dLat'] + $range;
                     $min_dLng    = $offer['dLng'] - $range;
                     $max_dLng    = $offer['dLng'] + $range;
                     
                     // Normal yolculuklar için where clause  origin ve destination  değerlendiriliyor  position > 0 olması gerek
                     $one      = "( place1 LIKE '%$origin%' AND  place2 LIKE '%$destination%' )  OR
                                  (   ( lat >= $min_lat  AND  lat <= $max_lat AND lng >= $min_lng  AND  lng <= $max_lng )
                                       AND 
                                      ( dLat >= $min_dLat  AND  dLat <= $max_dLat AND  dLng >= $min_dLng  AND  dLng <= $max_dLng )
                                   ) ";
                     
                     // Normal yolculuklar için where clause  origin  değerlendiriliyor  position < 0 olması gerek
                     $one2      = "( place1 LIKE '%$origin%'  )  OR
                                   ( lat >= $min_lat  AND  lat <= $max_lat AND lng >= $min_lng  AND  lng <= $max_lng ) ";
                     
                     // Normal yolculukları al origin, destination ve  position > 0 değerlendir
                     $where = "$one  AND date >='{$date}' AND dLat > 0 AND  dLng > 0 AND user_id != $user_id ";
                     $query  = $this->db -> distinct('id')
                                         -> select('id,place1,place2' )
                                         -> from('email_alerts')
                                         -> where( $where )
                                         -> get();
                     // Normal yolculuklar al origin,  position < 0 değerlendir
                     $where   = "$one2  AND date >='{$date}' AND dLat < 0 AND  dLng < 0 AND user_id != $user_id";
                     $query3  = $this->db -> distinct('id')
                                         -> select('id,place1,place2' )
                                         -> from('email_alerts')
                                         -> where( $where )
                                         -> get();  

                     // Çift yönlü yolculuklar için veri çekme 
                     $query2 = TRUE;
                     $query4 = TRUE;
                     if( $ride_offer['round_trip'] == 1 ){

                           // Dönüş yolculukları where clause origin, destination ve  position > 0 değerlendir Origin ve destination değiştir
                           $oneReverse     = "( place1 LIKE '%$destination%' AND  place2 LIKE '%$origin%' )  OR
                                              (   ( dLat >= $min_lat  AND  dLat <= $max_lat AND  dLng >= $min_lng  AND  dLng <= $max_lng  )
                                                   AND 
                                                  ( lat >= $min_dLat  AND  lat <= $max_dLat AND lng >= $min_dLng  AND  lng <= $max_dLng )
                                               ) ";    

                           // Dönüş yolculukları al origin, destination ve  position > 0 değerlendir
                           $where   = "$oneReverse AND date >='{$date}' AND dLat > 0 AND  dLng > 0  AND user_id != $user_id";
                           $query2  = $this->db -> distinct('id')
                                                -> select('id,place1,place2' )
                                                -> from('email_alerts')
                                                -> where( $where )
                                                -> get();  
                           // Dönüş yolculukları where clause origin, destination ve  position < 0 değerlendir Origin ve destination değiştir
                            $oneReverse2     = "( place1 LIKE '%$destination%'  )  OR
                                               ( lat >= $min_dLat  AND  lat <= $max_dLat AND  lng >= $min_dLng  AND  lng <= $max_dLng  ) ";    
                           // Dönüş yolculukları al origin, destination ve  position < 0 değerlendir
                           $where   = "$oneReverse2 AND date >='{$date}' AND dLat < 0 AND  dLng < 0 AND user_id != $user_id";
                           $query4  = $this->db -> distinct('id')
                                                -> select('id,place1,place2' )
                                                -> from('email_alerts')
                                                -> where( $where )
                                                -> get(); 
  				    
                     }
                      
                     // Veriler alındı hata varmı yok mu kontrol et 
                     if( $query && $query2 && $query3 && $query4 ){
                          // Gidiş yolculukları için dönüş seferleri position > 0 
                          $result  = $query ->result_array();
                          // Gidiş yolculukları için dönüş seferleri position < 0
                          $result3 = $query3 ->result_array();
                          
						  
                          // Gidiş yolculuğu ve position > 0
                          if( is_array($result) && count($result ) > 0 ){
                               foreach ($result as $val) {
                                   if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                          $addAlerts[ $val['id'] ] = array( 'email_alert_id' => $val['id']  );
                               }
                          }
                          // Gidiş yolculuğu ve position < 0 
                          if( is_array($result3) &&  count($result3) > 0 ){
                               foreach ($result3 as $val) {
                                   if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                          $addAlerts[ $val['id'] ] = array( 'email_alert_id' => $val['id'] );
                               }
                          }
                              			 
                          // Dönüş yolculukları için değerlendirme
                          if( $ride_offer['round_trip'] == 1 ){
                             	 
                              // Dönüş yolculukları için dönüş seferleri position > 0 
                              $result = $query2->result_array();
                              // Dönüş yolculukları için dönüş seferleri position < 0 
                              $result4 = $query4->result_array();
                              
							  // Dönüş yolculuğu ve position > 0
                              if( is_array($result) &&  count($result) > 0 ){
                                   foreach ($result as $val) {
                                        if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                                $addAlerts[ $val['id'] ] = array( 'email_alert_id' => $val['id'] );
                                   }
                              }
                              
                              // Dönüş yolculuğu ve position < 0
                              if( is_array($result4) &&  count($result4) > 0 ){
                                   foreach ($result4 as $val) {
                                        if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                                $addAlerts[ $val['id'] ] = array(  'email_alert_id' => $val['id'] );
                                   } 
                              }
                          }
                     }                         
             }
              
			   
		     // sunucuda zaman geri olduğu için
    	     $ride_offer['created_at'] = date('Y-m-d H:i:s');
		
             // Begin to add data  
             $this->db->trans_begin();                                                                      // because of so many action we need to check all result 
             $query = $this->db->insert('ride_offers', $ride_offer);                                        // save offer  
             $result = TRUE;
             $offer_id = -1;                                                                                // set offerid begining value   
             if($query ){
                  if ( $this->db->affected_rows() > 0 ){
                                    $offer_id = $this->db->insert_id();                                     // get inserted id      
                                    if( $offer_id > 0 ){
                                         
                                          // save email allerts
                                          if( $result && count($addAlerts) > 0 ){
                                              $send_emails = array(); 
                                              foreach ($addAlerts as &$value) {
                                                     $value['ride_offer_id'] = $offer_id;
                                                     $send_emails[] = array( 'email_alert_id'  => $value['email_alert_id'] );

                                              }                                              
                                              $query = $this->db->insert_batch('email_alerts_result', $addAlerts);
                                              
                                              // send_email_alert
                                              $query2 = TRUE;
                                              if( count( $send_emails ) > 0 )
                                                  $query2 = $this->db->insert_batch('send_email_alert', $send_emails);
                                              
                                              // send_email_user Seyahat sonrası hatırlatmalar için   
                                              $trip_date = $ride_offer['departure_date'];
                                              if( $ride_offer['round_trip'] == 1 )
                                                 $trip_date = $ride_offer['return_date'];
                                              $send_email_user = array( 'user_id'       => $ride_offer['user_id'], 
                                                                        'type'          => 'offer', 
                                                                        'ride_offer_id' => $offer_id,
                                                                        'last_date'     => $trip_date );    
                                              $query3 = $this->db->insert('send_email_users', $send_email_user);


                                              if( $query && $query2 && $query3 ){
                                                     if( $this->db->affected_rows() > 0 )
                                                         $result = TRUE;
                                                     else
                                                         $result = FALSE;
                                              }
                                              else
                                                  $result = FALSE;
                                          }


                                          // save multiple dates
                                          if( $result && count($rutin_trip_dates) > 0 ){
                                              foreach ($rutin_trip_dates as &$value) {
                                                    $value['ride_offer_id'] = $offer_id;
                                              }                                              
                                              $query = $this->db->insert_batch('rutin_trip_dates', $rutin_trip_dates);
                                              if( $query ){
                                                     if( $this->db->affected_rows() > 0 )
                                                         $result = TRUE;
                                                     else
                                                           $result = FALSE;
                                              }
                                              else
                                                  $result = FALSE;
                                          }
                                          
                                          // save ways points 
                                          if( $result &&   count($waypoints) > 0 ){                               // way points is null or not 
                                      	          foreach ($waypoints as &$value) {
                                                         $value['ride_offer_id'] = $offer_id; 
                                                  }
                                                  $query = $this->db->insert_batch('way_points', $waypoints);
                                                  if( $query ){
                                                         if( $this->db->affected_rows() > 0 )
                                                             $result = TRUE;
                                                         else
                                                               $result = FALSE;
                                                  }
                                                  else
                                                      $result = FALSE;
                                          }
                                          // save ways_offer 
                                          if( $result &&   count($ways_offer) > 0 ){                               // way points is null or not 
                                                  foreach ($ways_offer as &$value) 
                                                         $value['ride_offer_id'] = $offer_id; 
                                                  $query = $this->db->insert_batch('ways_offer', $ways_offer);
												  $query = $this->db->insert_batch('offer_created', $ways_offer);
                                                  if( $query ){
                                                         if( $this->db->affected_rows() > 0 )
                                                             $result = TRUE;
                                                         else
                                                               $result = FALSE;
                                                  }
                                                  else
                                                      $result = FALSE;                                                    
                                          }
                                          
                                          // save trip days
                                          if( $result && count($days) > 0 ){                                                               
                                                foreach ($days as &$day) {
                                                       $day['ride_offer_id'] = $offer_id;
                                                }
                                                $query = $this->db->insert_batch('rutin_trip', $days);
                                                if( $query ){
                                                       if( $this->db->affected_rows() > 0 )
                                                           $result = TRUE;
                                                       else
                                                             $result = FALSE;
                                                }
                                                else
                                                      $result = FALSE;     
                                          }       
                                    }            
                                    else 
                                          $result = FALSE;    
                  }
                  else
                  	 $result = FALSE;	
             }
             else
                $result = FALSE;

             if ($this->db->trans_status() == FALSE || $result == FALSE){ 
                 $this->db->trans_rollback();                                // there is some error rollback
                 return FALSE;
             }
             else{
                 $this->db->trans_commit();                                  // everything is ok commit actions.
                 return $offer_id;
             }
    }
     
    /**
     *  Update offer method
     *  @parameter offer, waypoints_prices, waypoints_price_color, waypoints_distance, waypoints_distance_time, departure_days, return_days 
     *  RETURN TRUE or FALSE
    **/
    function updateOfferAll( $offer_id,
                             $rutin_trip_dates, 
                             $ride_offer, 
                             $waypoints,
                             $ways_offer,
                             $days         ) 
    {         
           
             // Email alarmlarını kontrol et
             $addAlerts = array();              // Tüm eklenen alert id lerin tutulduğu dizi
             $range = 0.5;                      // Position'a göre aramada kullanılan yarıçap alanı yaklaşık 50 km 
              // sunucuda zaman geri olduğu için
    	     $date = date('Y-m-d');             // Bugünün tarihi
             $user_id = $ride_offer['user_id']; // Teklifi yapan kullanıcının id si
          
             foreach ($ways_offer as $offer ) {

                     // her bir sefer için position ve origin destination kısımlarını al   
                     $origin      = $offer['departure_place']; 
                     $destination = $offer['arrivial_place'];
                     $min_lat     = $offer['lat']  - $range; 
                     $max_lat     = $offer['lat']  + $range;
                     $min_lng     = $offer['lng']  - $range;
                     $max_lng     = $offer['lng']  + $range;
                     $min_dLat    = $offer['dLat'] - $range;
                     $max_dLat    = $offer['dLat'] + $range;
                     $min_dLng    = $offer['dLng'] - $range;
                     $max_dLng    = $offer['dLng'] + $range;
                     
                     // Normal yolculuklar için where clause  origin ve destination  değerlendiriliyor  position > 0 olması gerek
                     $one      = "( place1 LIKE '%$origin%' AND  place2 LIKE '%$destination%' )  OR
                                  (   ( lat >= $min_lat  AND  lat <= $max_lat AND lng >= $min_lng  AND  lng <= $max_lng )
                                       AND 
                                      ( dLat >= $min_dLat  AND  dLat <= $max_dLat AND  dLng >= $min_dLng  AND  dLng <= $max_dLng )
                                   ) ";
                     
                     // Normal yolculuklar için where clause  origin  değerlendiriliyor  position < 0 olması gerek
                     $one2      = "( place1 LIKE '%$origin%'  )  OR
                                   ( lat >= $min_lat  AND  lat <= $max_lat AND lng >= $min_lng  AND  lng <= $max_lng ) ";
                     
                     // Normal yolculukları al origin, destination ve  position > 0 değerlendir
                     $where = "$one  AND date >='{$date}' AND dLat > 0 AND  dLng > 0 AND user_id != $user_id ";
                     $query  = $this->db -> distinct('id')
                                         -> select('id,place1,place2' )
                                         -> from('email_alerts')
                                         -> where( $where )
                                         -> get();
                     // Normal yolculuklar al origin,  position < 0 değerlendir
                     $where   = "$one2  AND date >='{$date}' AND dLat < 0 AND  dLng < 0 AND user_id != $user_id";
                     $query3  = $this->db -> distinct('id')
                                         -> select('id,place1,place2' )
                                         -> from('email_alerts')
                                         -> where( $where )
                                         -> get();  

                     // Çift yönlü yolculuklar için veri çekme 
                     $query2 = TRUE;
                     $query4 = TRUE;
                     if( $ride_offer['round_trip'] == 1 ){

                           // Dönüş yolculukları where clause origin, destination ve  position > 0 değerlendir Origin ve destination değiştir
                           $oneReverse     = "( place1 LIKE '%$destination%' AND  place2 LIKE '%$origin%' )  OR
                                              (   ( dLat >= $min_lat  AND  dLat <= $max_lat AND  dLng >= $min_lng  AND  dLng <= $max_lng  )
                                                   AND 
                                                  ( lat >= $min_dLat  AND  lat <= $max_dLat AND lng >= $min_dLng  AND  lng <= $max_dLng )
                                               ) ";    

                           // Dönüş yolculukları al origin, destination ve  position > 0 değerlendir
                           $where   = "$oneReverse AND date >='{$date}' AND dLat > 0 AND  dLng > 0  AND user_id != $user_id";
                           $query2  = $this->db -> distinct('id')
                                                -> select('id,place1,place2' )
                                                -> from('email_alerts')
                                                -> where( $where )
                                                -> get();  
                           // Dönüş yolculukları where clause origin, destination ve  position < 0 değerlendir Origin ve destination değiştir
                            $oneReverse2     = "( place1 LIKE '%$destination%'  )  OR
                                               ( lat >= $min_dLat  AND  lat <= $max_dLat AND  lng >= $min_dLng  AND  lng <= $max_dLng  ) ";    
                           // Dönüş yolculukları al origin, destination ve  position < 0 değerlendir
                           $where   = "$oneReverse2 AND date >='{$date}' AND dLat < 0 AND  dLng < 0 AND user_id != $user_id";
                           $query4  = $this->db -> distinct('id')
                                                -> select('id,place1,place2' )
                                                -> from('email_alerts')
                                                -> where( $where )
                                                -> get(); 
  				    
                     }
                      
                     // Veriler alındı hata varmı yok mu kontrol et 
                     if( $query && $query2 && $query3 && $query4 ){
                          // Gidiş yolculukları için dönüş seferleri position > 0 
                          $result  = $query ->result_array();
                          // Gidiş yolculukları için dönüş seferleri position < 0
                          $result3 = $query3 ->result_array();
                          
                          // Gidiş yolculuğu ve position > 0
                          if( is_array($result) && count($result ) > 0 ){
                               foreach ($result as $val) {
                                   if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                          $addAlerts[ $val['id'] ] = array( 'email_alert_id' => $val['id']  );
                               }
                          }
                          // Gidiş yolculuğu ve position < 0 
                          if( is_array($result3) &&  count($result3) > 0 ){
                               foreach ($result3 as $val) {
                                   if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                          $addAlerts[ $val['id'] ] = array( 'email_alert_id' => $val['id'] );
                               }
                          }

                          // Dönüş yolculukları için değerlendirme
                          if( $ride_offer['round_trip'] == 1 ){
                              // Dönüş yolculukları için dönüş seferleri position > 0 
                              $result = $query2->result_array();
                              // Dönüş yolculukları için dönüş seferleri position < 0 
                              $result4 = $query4->result_array();


                              // Dönüş yolculuğu ve position > 0
                              if( is_array($result) &&  count($result) > 0 ){
                                   foreach ($result as $val) {
                                        if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                                $addAlerts[ $val['id'] ] = array( 'email_alert_id' => $val['id'] );
                                   }
                              }
                              
                              // Dönüş yolculuğu ve position < 0
                              if( is_array($result4) &&  count($result4) > 0 ){
                                   foreach ($result4 as $val) {
                                        if(  ! array_key_exists($val['id'],  $addAlerts ) )
                                                $addAlerts[ $val['id'] ] = array(  'email_alert_id' => $val['id'] );
                                   } 
                              }
                          }
                     }                         
             }
             
              
             $ride_offer['is_way'] = ( count($waypoints) > 0 ) ? 1 : 0;
             $this->db->trans_begin();   
			 // sunucuda zaman geri olduğu için
    	    // because of so many action we need to check all result  
             $ride_offer['updated_at'] =  date('Y-m-d H:i:s');    
             $ride_offer['explain_approval']  = 0;                                          
             $query1 =  $this->db->delete('way_points',  array('ride_offer_id' => $offer_id));              // delete old data  
             $query2 =  $this->db->delete('rutin_trip',  array('ride_offer_id' => $offer_id));              // delete old data        
             $query3 =  $this->db->delete('rutin_trip_dates',  array('ride_offer_id' => $offer_id));              // delete old data        
             $query5 =  $this->db->delete('ways_offer',  array('ride_offer_id' => $offer_id));              // delete old data        
             $query5 =  $this->db->delete('email_alerts_result',  array('ride_offer_id' => $offer_id));              // delete old data        
             $query6 =  $this->db->delete('send_email_users',  array('ride_offer_id' => $offer_id));              // delete old data        
             $query7 =  $this->db->delete('look_at',  array('ride_offer_id' => $offer_id));              // delete old data        
             
             $query4 =  $this->db->update('ride_offers', $ride_offer, array('id' => $offer_id));            // update offer   
             $result = TRUE; 
             if($query1 && $query2 && $query3 && $query4 && $query5 &&  $query6 ){      

                                          // save email allerts
                                          if( $result && count($addAlerts) > 0 ){
                                              $send_emails = array(); 
                                              foreach ($addAlerts as &$value) {
                                                     $value['ride_offer_id'] = $offer_id;
                                                     $send_emails[] = array( 'email_alert_id'  => $value['email_alert_id']  );

                                              }                                              
                                              $query = $this->db->insert_batch('email_alerts_result', $addAlerts);
                                              
                                              // send_email_alert için
                                              $query2 = TRUE;
                                              if( count( $send_emails ) > 0 )
                                                  $query2 = $this->db->insert_batch('send_email_alert', $send_emails);
                                              

                                              // send_email_user Seyahat sonrası hatırlatmalar için   
                                              $trip_date = $ride_offer['departure_date'];
                                              if( $ride_offer['round_trip'] == 1 )
                                                 $trip_date = $ride_offer['return_date'];
                                              $send_email_user = array( 'user_id'       => $ride_offer['user_id'], 
                                                                        'type'          => 'offer', 
                                                                        'ride_offer_id' => $offer_id,
                                                                        'last_date'     => $trip_date );    
                                              $query3 = $this->db->insert('send_email_users', $send_email_user);


                                              if( $query && $query2 && $query3 ){
                                                     if( $this->db->affected_rows() > 0 )
                                                         $result = TRUE;
                                                     else
                                                         $result = FALSE;
                                              }
                                              else
                                                  $result = FALSE;
                                          }

                                          // save multiple dates
                                          if( $result && count($rutin_trip_dates) > 0 ){
                                              foreach ($rutin_trip_dates as &$value) {
                                                    $value['ride_offer_id'] = $offer_id; 
                                              }
                                              $query = $this->db->insert_batch('rutin_trip_dates', $rutin_trip_dates);
                                                if( $query ){
                                                       if( $this->db->affected_rows() > 0 )
                                                           $result = TRUE;
                                                       else
                                                             $result = FALSE;
                                                }
                                                else
                                                      $result = FALSE;  
                                          }
                                          // save ways points 
                                          if( $result &&   count($waypoints) > 0 ){                               // way points is null or not 
                                                  $query = $this->db->insert_batch('way_points', $waypoints);
                                                  if( $query ){
                                                         if( $this->db->affected_rows() > 0 )
                                                             $result = TRUE;
                                                         else
                                                               $result = FALSE;
                                                  }
                                                  else
                                                        $result = FALSE;  
                                          }
                                          // save ways_offer 
                                          if( $result &&   count($ways_offer) > 0 ){                               // way points is null or not 
                                                  $query = $this->db->insert_batch('ways_offer', $ways_offer);
									   	          $query = $this->db->insert_batch('offer_created', $ways_offer);
                                                  if( $query ){
                                                         if( $this->db->affected_rows() > 0 )
                                                             $result = TRUE;
                                                         else
                                                               $result = FALSE;
                                                  }
                                                  else
                                                        $result = FALSE;  
                                          }
                                          
                                          // save trip days
                                          if( $result && count($days) > 0 ){                                                               
                                                  $query = $this->db->insert_batch('rutin_trip', $days);
                                                  if( $query ){
                                                         if( $this->db->affected_rows() > 0 )
                                                             $result = TRUE;
                                                         else
                                                               $result = FALSE;
                                                  }
                                                  else
                                                        $result = FALSE; 
                                          }
             }
             else
                $result = FALSE;
               
             if ($this->db->trans_status() == FALSE || $result == FALSE){ 
                 $this->db->trans_rollback();                                // there is some error rollback
                 return FALSE;
             }
             else{
                 $this->db->trans_commit();                                  // everything is ok commit actions.
                 return $offer_id;
             }
    }

    /**
     *  Get user offers
     *  @parameter user id
     *  RETURN rows or FALSE
    **/
    function GetUserOffer( $user_id  ){
        	 	
           $date = date('Y-m-d H:i:s');    // current date
           //$where = "CONCAT(`name`,' ',`surname`) LIKE '$name%' AND id != $user_id";  

           $where = "user_id ='$user_id' AND ( CONCAT(departure_date,' ',departure_time) >='{$date}' OR CONCAT(return_date,' ', return_time)  >='{$date}')";
           $this->db -> where($where)
                     -> order_by("departure_date", "asc")
                     -> distinct(); 

           $query = $this->db->get($this->table);   
           if($query)
               return  $query->result_array(); 
           else
              return FALSE;
    }
  
    /**
     *  Get offer rutin Dates with where parameter
     *  @parameter offer_id
     *  RETURN rows or FALSE
    **/  
    function getRutinDates($offer_id){
           $query = $this->db -> where('ride_offer_id',$offer_id)
                              -> get('rutin_trip_dates');   
           if($query)
               return  $query->result_array(); 
           else
              return FALSE;

    }

    /**
     *  Get user offers with where parameter
     *  @parameter user id
     *  RETURN rows or FALSE
    **/
    function Get( $where  ){
           $query = $this->db -> where($where)
                              -> get($this->table);   
           if($query)
               return  $query->row_array(); 
           else
              return FALSE;
    }

    /**
     *  Get user offers count as count
     *  @parameter user id
     *  RETURN row or FALSE
    **/
    function GetUserOfferCount( $user_id ){
         $query =$this->db -> select('user_id, COUNT(id) AS offers_count  ')
                           -> where('user_id =', $user_id)
                           -> group_by('user_id')
                           -> get($this->table);   
         if($query){
            $result = $query->row_array() ; 
            if( $result )
                return $result;
            else{
                $result['offers_count'] = 0;    
            }
            return $result; 
         }
         else
           return FALSE;
    }
    
    /***
     |
     |  Get user offers that is passed
     |  @parameter user id
     |  RETURN rows or FALSE
     |
    ***/  
    function GetUserOfferOutofDate( $user_id ){
    	    
           $date = date('Y-m-d H:i:s');    // current date
           $where = "user_id ='$user_id' AND CONCAT(departure_date,' ',departure_time)  <'{$date}' AND CONCAT(return_date,' ', return_time) <'{$date}'";
           $this->db->where($where)
                    ->order_by("departure_date", "asc"); 

           $query = $this->db->get($this->table);   
           if($query)
              return  $query->result_array(); 
           else
             return FALSE;
    }
 
    /***
     *
     * Search offers
     *
     * @param $origin is departure point 
     * @param $destination  is arrivial point
     * @param $LIMIT  is how many rows display
     * @param $OFFSET is row start point
     * @return rows or FALSE
     *
    **/   
    function search( $origin, $destination, $lat, $lng, $dLat, $dLng, $range, $LIMIT, $OFFSET ){
        	 
		  $date = date('Y-m-d H:i:s');     // current date
          // tip 0 tekseferlik yolculuk ride_offer_id 
          // tip 1 çok seferli yolculuk  date_id
          // no hangi gruptan geldiğini   
          $range = explode("-", $range);
         if( count($range) == 2 )
             $range = $range[0].".".$range[1];
         else
             $range = 0.2;

         $min_lat   = $lat - $range; 
         $max_lat   = $lat + $range;
         $min_lng   = $lng - $range;
         $max_lng   = $lng + $range;
         if( $dLat != -1 && $dLng != -1  ){
             $min_dLat  = $dLat - $range;
             $max_dLat  = $dLat + $range;
             $min_dLng  = $dLng - $range;
             $max_dLng  = $dLng + $range;
             $twoway    = TRUE;
         }
         else{
              $min_dLat  = "true";
              $max_dLat  = "true";
              $min_dLng  = "true";
              $max_dLng  = "true";
              $twoway    = FALSE;
         } 
        
         // düz
         $second =  $twoway  ? "AND ( WO.dLat >= $min_dLat  AND  WO.dLat <= $max_dLat AND  WO.dLng >= $min_dLng  AND  WO.dLng <= $max_dLng )" : "";   
         $one    = "( WO.departure_place LIKE '%$origin%' AND  WO.arrivial_place LIKE '%$destination%' )  OR
                    (  ( WO.lat >= $min_lat  AND  WO.lat <= $max_lat AND WO.lng >= $min_lng  AND  WO.lng <= $max_lng )
                        $second
                     ) ";
         
         // tersleri için
         $secondReverse  =  $twoway  ? "AND ( WO.lat >= $min_dLat  AND  WO.lat <= $max_dLat AND WO.lng >= $min_dLng  AND  WO.lng <= $max_dLng )" : "";   
         $oneReverse     = "( WO.departure_place LIKE '%$destination%' AND  WO.arrivial_place LIKE '%$origin%' )  OR
                            (  ( WO.dLat >= $min_lat  AND  WO.dLat <= $max_lat AND  WO.dLng >= $min_lng  AND  WO.dLng <= $max_lng  )
                                $secondReverse
                             ) ";
         // NO:1 Tek seferlik GİDİŞ için  way pointsin içinde olmayanları seç
         // R -> ride_offers
         $where = "( $one )         AND 
                   R.trip_type = 0  AND
                   R.is_active = 1  AND 
                   R.is_way    = 0  AND 
                   CONCAT(R.departure_date,' ',R.departure_time) >='{$date}' ";
         $query1 = $this->db -> select('R.id AS ride_offer_id,
                                        0 AS tip,
                                        0 AS is_way, 
                                        R.created_at, 
                                        WO.id,
                                        WO.departure_place AS origin,
                                        WO.arrivial_place AS destination,
                                        WO.price AS price_per_passenger,
                                        WO.price_class AS price_class,
                                        R.departure_date,
                                        R.departure_time,
                                        R.number_of_seats,     
                                        U.name,
                                        U.surname,
                                        U.sex,
                                        U.foto,
                                        U.face_check,
                                        U.birthyear,
                                        U.friends,
                                        L.level,
                                        L.tr_level,
                                        L.en_level,
                                        P.like_chat,
                                        P.like_pet,
                                        P.like_smoke,
                                        P.like_music,
                                        C.make,
                                        C.model,
                                        C.comfort,
                                        (SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average,
                                        (SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,         
                                        1 AS no ', FALSE )
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where )
                             -> order_by("R.departure_date", "asc")
                             -> limit( $LIMIT, $OFFSET)
                             -> get();
        
          //echo "Gidiş için <br>";
          //echo $this->db->last_query();

         // NO:2  Tek seferlik DONUS için  way pointsin içinde olmayanları seç
         // R -> ride_offers
         $whereTers = "( $oneReverse )   AND 
                       R.trip_type = 0   AND
                       R.round_trip = 1  AND
                       R.is_active = 1   AND  
                       R.is_way    = 0   AND               
                       CONCAT(R.return_date,' ',R.return_time) >='{$date}' ";
         $query1Ters = $this->db  -> select('R.id AS ride_offer_id,
                                             0 AS tip, 
                                             0 AS is_way,
                                             R.created_at, 
                                             WO.id,
                                             WO.departure_place AS destination,
                                             WO.arrivial_place AS origin,
                                             WO.price AS price_per_passenger,
                                             WO.price_class AS price_class,
                                             R.return_date AS departure_date,
                                             R.return_time AS departure_time,
                                             R.number_of_seats,     
                                             U.name,
                                             U.surname,
                                             U.sex,
                                             U.foto,
                                             U.face_check,
                                             U.birthyear,
                                             U.friends,
                                             L.level,
                                             L.tr_level,
                                             L.en_level,
                                             P.like_chat,
                                             P.like_pet,
                                             P.like_smoke,
                                             P.like_music, 
                                             C.make,
                                             C.model,
                                             C.comfort,
                                             (SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average,  
                                             (SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,     
                                             2 AS no  ',FALSE)
                                  -> from('ways_offer AS WO')
                                  -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                  -> join('users AS U', 'U.id = R.user_id')
                                  -> join('preferences AS P', 'U.id = P.user_id')
                                  -> join('user_level AS L',  'U.level_id = L.level_id')
                                  -> join('cars AS C',  'C.id = R.car_id')
                                  -> where( $whereTers )
                                  -> order_by("R.return_date", "asc")
                                  -> limit( $LIMIT, $OFFSET)
                                  -> get();                   
          //echo "<br><br>Donus icin <br>";
          //echo $this->db->last_query();

         // NO:3 Çok seferlik seyahatlerden seç  Gidişler çin way pointsin içinde olmayanları seç
         // R -> ride_offers  T -> rutin_trip_dates
         $where2 = "( $one )         AND 
                    R.trip_type = 1  AND
                    R.is_active = 1  AND 
                    T.is_return = 0  AND   
                    R.is_way    = 0  AND    
                    CONCAT(T.date,' ',R.departure_time) >='{$date}' ";
         $query2 = $this->db -> select('R.id AS ride_offer_id,
                                        T.id AS date_id,
                                        1 AS tip,
                                        0 AS is_way,  
                                        R.created_at, 
                                        WO.id,
                                        WO.departure_place AS origin,
                                        WO.arrivial_place AS destination,
                                        WO.price AS price_per_passenger,
                                        WO.price_class AS price_class,
                                        T.date AS departure_date,
                                        R.departure_time,
                                        R.number_of_seats,     
                                        U.name,
                                        U.surname,
                                        U.birthyear,
                                        U.sex,
                                        U.foto,
                                        U.face_check,
                                        U.friends,
                                        L.level,
                                        L.tr_level,
                                        L.en_level,
                                        P.like_chat,
                                        P.like_pet,
                                        P.like_smoke,
                                        P.like_music,
                                        C.make,
                                        C.model,
                                        C.comfort,
                                        (SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average, 
                                        (SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,         
                                        3 AS no ', FALSE)
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where2 )
                             -> order_by("T.date", "asc")
                             -> limit( $LIMIT, $OFFSET)
                             -> get();
         
         //echo "Cok seferlik Gidis icin <br>";
         //echo $this->db->last_query();

         // NO:4 Çok seferlik DONUS çin  way pointsin içinde olmayanları seç   
         // R -> ride_offers  T -> rutin_trip_dates
         $where2Ters = "( $oneReverse )  AND 
                        R.trip_type = 1  AND
                        R.is_active = 1  AND 
                        T.is_return = 1  AND 
                        R.is_way    = 0  AND      
                        CONCAT(T.date,' ',R.return_time) >='{$date}'";

         $query2Ters = $this->db -> select('R.id AS ride_offer_id, 
                                            T.id AS date_id,
                                            1 AS tip,
                                            0 AS is_way, 
                                            WO.id,
                                            WO.departure_place AS destination,
                                            WO.arrivial_place AS origin,
                                            WO.price AS price_per_passenger,
                                            WO.price_class AS price_class,
                                            R.created_at,   
                                            T.date AS departure_date, 
                                            R.return_time AS departure_time,
                                            R.number_of_seats,     
                                            U.name,
                                            U.surname,
                                            U.sex,
                                            U.foto,
                                            U.face_check,
                                            U.birthyear,
                                            U.friends,
                                            L.level,
                                            L.tr_level,
                                            L.en_level,
                                            P.like_chat,
                                            P.like_pet,
                                            P.like_smoke,
                                            P.like_music, 
                                            C.make,
                                            C.model,
                                            C.comfort, 
                                            ( SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average, 
                                            ( SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,       
                                            4 AS no ', FALSE)
                                 -> from('ways_offer AS WO')
                                 -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                 -> join('users AS U', 'U.id = R.user_id')
                                 -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                                 -> join('preferences AS P', 'U.id = P.user_id')
                                 -> join('user_level AS L',  'U.level_id = L.level_id')
                                 -> join('cars AS C',  'C.id = R.car_id')
                                 -> where( $where2Ters )
                                 -> order_by("T.date", "asc")
                                 -> limit( $LIMIT, $OFFSET)
                                 -> get();                   
         
         //echo "Cok seferlik donus icin <br>";
         //echo $this->db->last_query();


         /****************************************************************************/
         /****************************************************************************/
         /*    CHANGE ALL OF THEM                                                    */
         /*****************************************************************************/  
         /*****************************************************************************/  
         /*****************************************************************************/  
         /*****************************************************************************/
         
         // NO:5 Waypoints  Tek seferlik seyahatlerden seç Gidişler için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers   W -> way_points
         $where = "( $one )         AND 
                   R.trip_type = 0  AND
                   R.is_active = 1  AND 
                   R.is_way    = 1  AND 
                   CONCAT(R.departure_date,' ',R.departure_time) >='{$date}' ";
         $query3 = $this->db -> select('R.id AS ride_offer_id,
                                        0 AS tip,
                                        1 AS is_way, 
                                        R.created_at, 
                                        WO.id,
                                        WO.departure_place AS origin,
                                        WO.arrivial_place AS destination,
                                        WO.price AS price_per_passenger,
                                        WO.price_class AS price_class,
                                        R.departure_date,
                                        R.departure_time,
                                        R.number_of_seats,     
                                        U.name,
                                        U.surname,
                                        U.sex,
                                        U.foto,
                                        U.face_check,
                                        U.birthyear,
                                        U.friends,
                                        L.level,
                                        L.tr_level,
                                        L.en_level,
                                        P.like_chat,
                                        P.like_pet,
                                        P.like_smoke,
                                        P.like_music,
                                        C.make,
                                        C.model,
                                        C.comfort,
                                        (SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average,
                                        (SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,         
                                        5 AS no ', FALSE )
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where )
                             -> order_by("R.departure_date", "asc")
                             -> limit( $LIMIT, $OFFSET)
                             -> get();
        
          //echo "Gidiş için <br>";
          //echo $this->db->last_query();

         // NO:6 Waypoints Tek seferlik DONUS için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers   W -> way_points
           //Gereksiz `R`.`departure_date` AS `return_date`, 
           //Gereksiz `R`.`departure_time` AS `return_time`,
         $whereTers = "( $oneReverse )   AND 
                       R.trip_type = 0   AND
                       R.round_trip = 1  AND
                       R.is_active = 1   AND  
                       R.is_way    = 1   AND               
                       CONCAT(R.return_date,' ',R.return_time) >='{$date}' ";
         $query3Ters = $this->db  -> select('R.id AS ride_offer_id,
                                             0 AS tip, 
                                             1 AS is_way,
                                             R.created_at, 
                                             WO.id,
                                             WO.departure_place AS destination,
                                             WO.arrivial_place AS origin,
                                             WO.price AS price_per_passenger,
                                             WO.price_class AS price_class,
                                             R.return_date AS departure_date,
                                             R.return_time AS departure_time,
                                             R.number_of_seats,     
                                             U.name,
                                             U.surname,
                                             U.sex,
                                             U.foto,
                                             U.face_check,
                                             U.birthyear,
                                             U.friends,
                                             L.level,
                                             L.tr_level,
                                             L.en_level,
                                             P.like_chat,
                                             P.like_pet,
                                             P.like_smoke,
                                             P.like_music, 
                                             C.make,
                                             C.model,
                                             C.comfort,
                                             (SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average,  
                                             (SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,     
                                             6 AS no  ',FALSE)
                                  -> from('ways_offer AS WO')
                                  -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                  -> join('users AS U', 'U.id = R.user_id')
                                  -> join('preferences AS P', 'U.id = P.user_id')
                                  -> join('user_level AS L',  'U.level_id = L.level_id')
                                  -> join('cars AS C',  'C.id = R.car_id')
                                  -> where( $whereTers )
                                  -> order_by("R.return_date", "asc")
                                  -> limit( $LIMIT, $OFFSET)
                                  -> get();                   
          //echo "<br><br>Donus icin <br>";
          //echo $this->db->last_query();

          // NO:7 Waypoints Çok seferlik seyahatlerden seç Gidişler için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers  W -> way_points  T -> rutin_trip_dates
         $where2 = "( $one )         AND 
                    R.trip_type = 1  AND
                    R.is_active = 1  AND 
                    T.is_return = 0  AND   
                    R.is_way    = 1  AND    
                    CONCAT(T.date,' ',R.departure_time) >='{$date}' ";
         $query4 = $this->db -> select('R.id AS ride_offer_id,
                                        T.id AS date_id,
                                        1 AS tip,
                                        1 AS is_way,  
                                        R.created_at, 
                                        WO.id,
                                        WO.departure_place AS origin,
                                        WO.arrivial_place AS destination,
                                        WO.price AS price_per_passenger,
                                        WO.price_class AS price_class,
                                        T.date AS departure_date,
                                        R.departure_time,
                                        R.number_of_seats,     
                                        U.name,
                                        U.surname,
                                        U.birthyear,
                                        U.sex,
                                        U.foto,
                                        U.face_check,
                                        U.friends,
                                        L.level,
                                        L.tr_level,
                                        L.en_level,
                                        P.like_chat,
                                        P.like_pet,
                                        P.like_smoke,
                                        P.like_music,
                                        C.make,
                                        C.model,
                                        C.comfort,
                                        (SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average, 
                                        (SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,         
                                        7 AS no ', FALSE)
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where2 )
                             -> order_by("T.date", "asc")
                             -> limit( $LIMIT, $OFFSET)
                             -> get();
         
         //echo "Cok seferlik Gidis icin <br>";
         //echo $this->db->last_query();

         // NO:8 Waypoints  Çok seferlik  DONUS için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers  T -> rutin_trip_dates  W -> way_points
         $where2Ters = "( $oneReverse )  AND 
                        R.trip_type = 1  AND
                        R.is_active = 1  AND 
                        T.is_return = 1  AND 
                        R.is_way    = 1  AND      
                        CONCAT(T.date,' ',R.return_time) >='{$date}'";

         $query4Ters = $this->db -> select('R.id AS ride_offer_id, 
                                            T.id AS date_id,
                                            1 AS tip,
                                            1 AS is_way, 
                                            WO.id,
                                            WO.departure_place AS destination,
                                            WO.arrivial_place AS origin,
                                            WO.price AS price_per_passenger,
                                            WO.price_class AS price_class,
                                            R.created_at,   
                                            T.date AS departure_date, 
                                            R.return_time AS departure_time,
                                            R.number_of_seats,     
                                            U.name,
                                            U.surname,
                                            U.sex,
                                            U.foto,
                                            U.face_check,
                                            U.birthyear,
                                            U.friends,
                                            L.level,
                                            L.tr_level,
                                            L.en_level,
                                            P.like_chat,
                                            P.like_pet,
                                            P.like_smoke,
                                            P.like_music, 
                                            C.make,
                                            C.model,
                                            C.comfort, 
                                            ( SELECT AVG(rate) FROM ratings WHERE received_userid = U.id ) AS average, 
                                            ( SELECT COUNT(id) FROM ratings WHERE received_userid = U.id ) AS number,       
                                            8 AS no ', FALSE)
                                 -> from('ways_offer AS WO')
                                 -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                 -> join('users AS U', 'U.id = R.user_id')
                                 -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                                 -> join('preferences AS P', 'U.id = P.user_id')
                                 -> join('user_level AS L',  'U.level_id = L.level_id')
                                 -> join('cars AS C',  'C.id = R.car_id')
                                 -> where( $where2Ters )
                                 -> order_by("T.date", "asc")
                                 -> limit( $LIMIT, $OFFSET)
                                 -> get();                   
         
         //echo "Cok seferlik donus icin <br>";
         //echo $this->db->last_query();

         if($query1 && $query1Ters && $query2 && $query2Ters && $query3 && $query3Ters && $query4 && $query4Ters ){
               
               $result      = $query1->result_array() ;       // tek seferlik gidiş seyahatleri   
               $resultTers  = $query1Ters->result_array() ;   // tek seferlik dönüş seyahatleri              
               $result2     = $query2->result_array() ;       // cok seferlik gidiş seyahatleri
               $result2Ters = $query2Ters->result_array() ;   // cok seferlik dönüş seyahatleri
               $result3     = $query3->result_array() ;       // Waypoints tek seferlik gidiş seyahatleri 
               $result3Ters = $query3Ters->result_array() ;   // Waypoints tek seferlik dönüş seyahatleri 
               $result4     = $query4->result_array() ;       // Waypoints çok seferlik gidiş seyahatleri
               $result4Ters = $query4Ters->result_array() ;   // Waypoints çok seferlik dönüş seyahatleri
              
               // Waypoints Gidiş  Tek sefer
               foreach ($result3 as &$value) {
                        $query2 = $this->db -> select('W.id, W.departure_place, W.arrivial_place, W.distance, W.price')
                                            -> where('ride_offer_id',  $value['ride_offer_id']  )
                                            -> get('way_points AS W');
                        if(  $query2 ){
                                      $allWays = $query2->result_array();
                                      $value['is_go'] = 1;
                                      $value['all_ways'] = $allWays;    
                        }
                        else
                            return FALSE;             
               } 

               // Waypoints Dönüş  Tek sefer
               foreach ($result3Ters as &$value) {
                        $query2 = $this->db -> select('W.id, W.departure_place, W.arrivial_place, W.distance, W.price')
                                             -> where('ride_offer_id',  $value['ride_offer_id']  )
                                             -> get('way_points AS W');
                        if( $query2 ){
                                      $allWays = $query2->result_array();
                                      $value['is_go'] = 0;
                                      $value['all_ways'] = $allWays; 
                        }
                        else
                            return FALSE;           
               }  
                // Waypoints Gidiş Çok sefer
               foreach ($result4 as &$value) {
                        $query2 = $this->db -> select('W.id, W.departure_place, W.arrivial_place, W.distance, W.price')
                                            -> where('ride_offer_id',  $value['ride_offer_id']  )
                                            -> get('way_points AS W');
                        if(  $query2 ){
                                      $allWays = $query2->result_array();
                                      $value['is_go'] = 1;
                                      $value['all_ways'] = $allWays; 
                        }
                        else
                            return FALSE;             
               } 
                
               // Waypoints Dönüş Çok sefer
               foreach ($result4Ters as &$value) {
                        $query2 = $this->db -> select('W.id, W.departure_place, W.arrivial_place, W.distance, W.price')
                                            -> where('ride_offer_id',  $value['ride_offer_id']  )
                                            -> get('way_points AS W');
                        if( $query2 ){
                                        $allWays = $query2->result_array();
                                        $value['is_go'] = 0;
                                        $value['all_ways'] = $allWays; 
                        }
                        else
                            return FALSE;             
               } 
              
               // Merge results
               $searched = array_merge( $result, $resultTers, $result2, $result2Ters,
                                        $result3, $result3Ters, $result4, $result4Ters  );   
               
               // Display results 
              // $this-> display( $result, $resultTers, $result2, $result2Ters, $result3, $result3Ters, $result4, $result4Ters, $searched );                    
                
              return $searched; // return search results
         }
         else
           return FALSE;
    } 


      /***
     *
     * Search total count of offers
     *
     * @param $origin is departure point 
     * @param $destination  is arrivial point
     * @param $LIMIT  is how many rows display
     * @param $OFFSET is row start point
     * @return row or FALSE
     *
    **/   
    function searchCount( $origin, $destination, $lat, $lng, $dLat, $dLng, $range, $LIMIT, $OFFSET ){
             	
          $date = date('Y-m-d H:i:s');     // current date
          // tip 0 tekseferlik yolculuk ride_offer_id 
          // tip 1 çok seferli yolculuk  date_id
          // no hangi gruptan geldiğini   
          $range = explode("-", $range);
         if( count($range) == 2 )
             $range = $range[0].".".$range[1];
         else
             $range = 0.2;

         $min_lat   = $lat - $range; 
         $max_lat   = $lat + $range;
         $min_lng   = $lng - $range;
         $max_lng   = $lng + $range;
         if( $dLat != -1 && $dLng != -1  ){
             $min_dLat  = $dLat - $range;
             $max_dLat  = $dLat + $range;
             $min_dLng  = $dLng - $range;
             $max_dLng  = $dLng + $range;
             $twoway    = TRUE;
         }
         else{
              $min_dLat  = "true";
              $max_dLat  = "true";
              $min_dLng  = "true";
              $max_dLng  = "true";
              $twoway    = FALSE;
         } 
        
         // düz
         $second =  $twoway  ? "AND ( WO.dLat >= $min_dLat  AND  WO.dLat <= $max_dLat AND  WO.dLng >= $min_dLng  AND  WO.dLng <= $max_dLng )" : "";   
         $one    = "( WO.departure_place LIKE '%$origin%' AND  WO.arrivial_place LIKE '%$destination%' )  OR
                    (  ( WO.lat >= $min_lat  AND  WO.lat <= $max_lat AND WO.lng >= $min_lng  AND  WO.lng <= $max_lng )
                        $second
                     ) ";
         
         // tersleri için
         $secondReverse  =  $twoway  ? "AND ( WO.lat >= $min_dLat  AND  WO.lat <= $max_dLat AND WO.lng >= $min_dLng  AND  WO.lng <= $max_dLng )" : "";   
         $oneReverse     = "( WO.departure_place LIKE '%$destination%' AND  WO.arrivial_place LIKE '%$origin%' )  OR
                            (  ( WO.dLat >= $min_lat  AND  WO.dLat <= $max_lat AND  WO.dLng >= $min_lng  AND  WO.dLng <= $max_lng  )
                                $secondReverse
                             ) ";
         // NO:1 Tek seferlik GİDİŞ için  way pointsin içinde olmayanları seç
         // R -> ride_offers
         $where = "( $one )         AND 
                   R.trip_type = 0  AND
                   R.is_active = 1  AND 
                   R.is_way    = 0  AND 
                   CONCAT(R.departure_date,' ',R.departure_time) >='{$date}' ";
         $query1 = $this->db -> select('COUNT(R.id) AS num' )
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where ) 
                             -> get();
        
          //echo "Gidiş için <br>";
          //echo $this->db->last_query();
         // NO:2  Tek seferlik DONUS için  way pointsin içinde olmayanları seç
         // R -> ride_offers
         $whereTers = "( $oneReverse )   AND 
                       R.trip_type = 0   AND
                       R.round_trip = 1  AND
                       R.is_active = 1   AND  
                       R.is_way    = 0   AND               
                       CONCAT(R.return_date,' ',R.return_time) >='{$date}' ";
         $query1Ters = $this->db  -> select('COUNT(R.id) AS num')
                                  -> from('ways_offer AS WO')
                                  -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                  -> join('users AS U', 'U.id = R.user_id')
                                  -> join('preferences AS P', 'U.id = P.user_id')
                                  -> join('user_level AS L',  'U.level_id = L.level_id')
                                  -> join('cars AS C',  'C.id = R.car_id')
                                  -> where( $whereTers ) 
                                  -> get();                   
          //echo "<br><br>Donus icin <br>";
          //echo $this->db->last_query();
         // NO:3 Çok seferlik seyahatlerden seç  Gidişler çin way pointsin içinde olmayanları seç
         // R -> ride_offers  T -> rutin_trip_dates
         $where2 = "( $one )         AND 
                    R.trip_type = 1  AND
                    R.is_active = 1  AND 
                    T.is_return = 0  AND   
                    R.is_way    = 0  AND    
                    CONCAT(T.date,' ',R.departure_time) >='{$date}' ";
         $query2 = $this->db -> select('COUNT(R.id) AS num')
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where2 ) 
                             -> get();
         
         //echo "Cok seferlik Gidis icin <br>";
         //echo $this->db->last_query();
         // NO:4 Çok seferlik DONUS çin  way pointsin içinde olmayanları seç   
         // R -> ride_offers  T -> rutin_trip_dates
         $where2Ters = "( $oneReverse )  AND 
                        R.trip_type = 1  AND
                        R.is_active = 1  AND 
                        T.is_return = 1  AND 
                        R.is_way    = 0  AND      
                        CONCAT(T.date,' ',R.return_time) >='{$date}'";
         $query2Ters = $this->db -> select('COUNT(R.id) AS num')
                                 -> from('ways_offer AS WO')
                                 -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                 -> join('users AS U', 'U.id = R.user_id')
                                 -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                                 -> join('preferences AS P', 'U.id = P.user_id')
                                 -> join('user_level AS L',  'U.level_id = L.level_id')
                                 -> join('cars AS C',  'C.id = R.car_id')
                                 -> where( $where2Ters ) 
                                 -> get();                   
         
         //echo "Cok seferlik donus icin <br>";
         //echo $this->db->last_query();

         /****************************************************************************/
         /****************************************************************************/
         /*    CHANGE ALL OF THEM                                                    */
         /*****************************************************************************/  
         /*****************************************************************************/  
         /*****************************************************************************/  
         /*****************************************************************************/
         
         // NO:5 Waypoints  Tek seferlik seyahatlerden seç Gidişler için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers   W -> way_points
         $where = "( $one )         AND 
                   R.trip_type = 0  AND
                   R.is_active = 1  AND 
                   R.is_way    = 1  AND 
                   CONCAT(R.departure_date,' ',R.departure_time) >='{$date}' ";
         $query3 = $this->db -> select('COUNT(R.id) AS num' )
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where ) 
                             -> get();
        
          //echo "Gidiş için <br>";
          //echo $this->db->last_query();
         // NO:6 Waypoints Tek seferlik DONUS için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers   W -> way_points
           //Gereksiz `R`.`departure_date` AS `return_date`, 
           //Gereksiz `R`.`departure_time` AS `return_time`,
         $whereTers = "( $oneReverse )   AND 
                       R.trip_type = 0   AND
                       R.round_trip = 1  AND
                       R.is_active = 1   AND 
                       R.is_way    = 1   AND               
                       CONCAT(R.return_date,' ',R.return_time) >='{$date}' ";
         $query3Ters = $this->db  -> select('COUNT(R.id) AS num')
                                  -> from('ways_offer AS WO')
                                  -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                  -> join('users AS U', 'U.id = R.user_id')
                                  -> join('preferences AS P', 'U.id = P.user_id')
                                  -> join('user_level AS L',  'U.level_id = L.level_id')
                                  -> join('cars AS C',  'C.id = R.car_id')
                                  -> where( $whereTers ) 
                                  -> get();                   
          //echo "<br><br>Donus icin <br>";
          //echo $this->db->last_query();
          // NO:7 Waypoints Çok seferlik seyahatlerden seç Gidişler için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers  W -> way_points  T -> rutin_trip_dates
         $where2 = "( $one )         AND 
                    R.trip_type = 1  AND
                    R.is_active = 1  AND 
                    T.is_return = 0  AND   
                    R.is_way    = 1  AND    
                    CONCAT(T.date,' ',R.departure_time) >='{$date}' ";
         $query4 = $this->db -> select('COUNT(R.id) AS num')
                             -> from('ways_offer AS WO')
                             -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                             -> join('users AS U', 'U.id = R.user_id')
                             -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                             -> join('preferences AS P', 'U.id = P.user_id')
                             -> join('user_level AS L',  'U.level_id = L.level_id')
                             -> join('cars AS C',  'C.id = R.car_id')
                             -> where( $where2 ) 
                             -> get();
         
         //echo "Cok seferlik Gidis icin <br>";
         //echo $this->db->last_query();
         // NO:8 Waypoints  Çok seferlik  DONUS için  farklı way points deki gidiş ve geliş yeri için arama yapılcak
         // R -> ride_offers  T -> rutin_trip_dates  W -> way_points
         $where2Ters = "( $oneReverse )  AND 
                        R.trip_type = 1  AND
                        R.is_active = 1  AND 
                        T.is_return = 1  AND 
                        R.is_way    = 1  AND      
                        CONCAT(T.date,' ',R.return_time) >='{$date}'";
         $query4Ters = $this->db -> select('COUNT(R.id) AS num')
                                 -> from('ways_offer AS WO')
                                 -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                 -> join('users AS U', 'U.id = R.user_id')
                                 -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                                 -> join('preferences AS P', 'U.id = P.user_id')
                                 -> join('user_level AS L',  'U.level_id = L.level_id')
                                 -> join('cars AS C',  'C.id = R.car_id')
                                 -> where( $where2Ters ) 
                                 -> get();                   
         
         //echo "Cok seferlik donus icin <br>";
         //echo $this->db->last_query();
         if($query1 && $query1Ters && $query2 && $query2Ters && $query3 && $query3Ters && $query4 && $query4Ters ){
               
               $result      = $query1->result_array() ;       // tek seferlik gidiş seyahatleri   
               $resultTers  = $query1Ters->result_array() ;   // tek seferlik dönüş seyahatleri              
               $result2     = $query2->result_array() ;       // cok seferlik gidiş seyahatleri
               $result2Ters = $query2Ters->result_array() ;   // cok seferlik dönüş seyahatleri
               $result3     = $query3->result_array() ;       // Waypoints tek seferlik gidiş seyahatleri 
               $result3Ters = $query3Ters->result_array() ;   // Waypoints tek seferlik dönüş seyahatleri 
               $result4     = $query4->result_array() ;       // Waypoints çok seferlik gidiş seyahatleri
               $result4Ters = $query4Ters->result_array() ;   // Waypoints çok seferlik dönüş seyahatleri
              
               // Merge results
               $searched = array_merge( $result, $resultTers, $result2, $result2Ters,
                                        $result3, $result3Ters, $result4, $result4Ters  );   
       
               $count = 0;
               foreach ($searched as $val) 
                   $count += $val['num'];
               
               return $count; // return search results total count
         }
         else
           return FALSE;
    } 
    
    /***
     *
     * Offers detailSearch method
     *
     * @param $id is offer_id or date_id 
     * @param $tip  is  id types ride_offer_id or date_id
     * @param $no  is  which sql query
     * @return rows or FALSE
     *
    **/ 
    function GetOfferForSearchResult(  $id,  $tip,  $no,  $WoID   ){
          if( $tip == 0 ){ // ride_offer_id
                   $where = "R.is_active = 1  AND  WO.id  = $WoID    ";
                   $query = $this->db -> select('     R.id AS ride_offer_id,
                                                      R.origin AS originMap,
                                                      R.destination AS destinationMap,
                                                      R.user_id, 
                                                      R.created_at,
                                                      WO.departure_place AS origin,
                                                      WO.arrivial_place AS destination,
                                                      WO.price AS price_per_passenger,
                                                      WO.price_class AS price_class,
                                                      R.trip_type,
                                                      R.round_trip, 
                                                      R.departure_date,
                                                      R.departure_time,
                                                      R.return_date,
                                                      R.return_time,
                                                      R.number_of_seats,     
                                                      R.explain_departure,
                                                      R.explain_return,
                                                      LT.time,
                                                      LT.timeen,
                                                      L.size,
                                                      L.sizeen,
                                                      C.id AS car_id,
                                                      C.foto_name,
                                                      C.make,
                                                      C.model,
                                                      C.comfort,
                                                      ( SELECT COUNT(id) FROM look_at WHERE ride_offer_id = R.id ) AS look')
                                       
                                       -> from('ways_offer AS WO')
                                       -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                       -> join('cars AS C',         'C.id = R.car_id')
                                       -> join('leave_times AS LT', 'LT.id = R.leave_time_id')
                                       -> join('luggages AS L',     'L.id = R.luggage_id')
                                       -> where( $where )
                                       -> get();  
          } 
          else{  // date_id
                        $where2Ters = "R.is_active = 1  AND  T.id  = $id  AND  WO.id  = $WoID ";
                        $query = $this->db -> select('R.id AS ride_offer_id, 
                                                      R.user_id,
                                                      R.origin AS originMap,
                                                      R.destination AS destinationMap,
                                                      T.id AS date_id,
                                                      T.date, 
                                                      T.is_return,
                                                      R.created_at,
                                                      WO.departure_place AS origin,
                                                      WO.arrivial_place AS destination,
                                                      WO.price AS price_per_passenger,
                                                      WO.price_class AS price_class,
                                                      R.trip_type,
                                                      R.round_trip, 
                                                      R.departure_date,
                                                      R.departure_time,
                                                      R.return_date,
                                                      R.return_time,
                                                      R.number_of_seats,     
                                                      R.explain_departure,
                                                      R.explain_return,
                                                      LT.time,
                                                      LT.timeen,
                                                      L.size,
                                                      L.sizeen,
                                                      C.id AS car_id,
                                                      C.foto_name,
                                                      C.make,
                                                      C.model,
                                                      C.comfort,
                                                      ( SELECT COUNT(id) FROM look_at WHERE ride_offer_id = R.id ) AS look')
                                                -> from('ways_offer AS WO')
                                                -> join('ride_offers AS R', 'WO.ride_offer_id = R.id')
                                                -> join('rutin_trip_dates AS T', 'T.ride_offer_id = R.id')
                                                -> join('cars AS C',  'C.id = R.car_id')
                                                -> join('leave_times AS LT', 'LT.id = R.leave_time_id')
                                                -> join('luggages AS L',     'L.id = R.luggage_id')
                                                -> where( $where2Ters ) 
                                                -> get();   
          }
           
          if( $query ){
              $offer = $query->row_array(); 
              if( is_array($offer) && count($offer) > 0 ){
                    $query  =  $this->db -> select('W.departure_place, W.arrivial_place, W.distance, W.price')
                                         -> where('ride_offer_id',  $offer['ride_offer_id']  )
                                         -> get('way_points AS W');
                    $query2 =  $this->db -> select('*,
                                                   (SELECT COUNT(id) FROM ride_offers WHERE user_id = '.$offer["user_id"].' ) AS offer_count,
                                                   (SELECT AVG(rate) FROM ratings WHERE received_userid = '.$offer["user_id"].' ) AS avg,
                                                   (SELECT COUNT(id) FROM ratings WHERE received_userid = '.$offer["user_id"].' ) AS total,  
                                                   users.id as id')
                                         -> from('users')
                                         -> join('preferences', 'users.id = preferences.user_id')
                                         -> join('user_level',  'users.level_id = user_level.level_id')
                                         -> where('users.id', $offer['user_id'] )
                                         -> get();
                     $query3 = $this->db -> select("*, ratings.created_at")
                                         -> from("ratings")
                                         -> join('users', 'users.id = ratings.given_userid') 
                                         -> where('received_userid', $offer['user_id'])
                                         -> limit(5)
                                         -> get();                     

                    if( $query && $query2 && $query3 ){                     
                         $ways     = $query->result_array();
                         $users    = $query2->row_array();
                         $ratings  = $query3->result_array();
                         if( is_array($ways) && is_array($users) && is_array($ratings) ){  
                                $offer['way_points'] = $ways;
                                $users['ratings']    = $ratings;
                                $offer['user']      = $users;
                                return $offer;
                         }
                         else
                             return FALSE;                
                    }
                    else
                        return FALSE;            
              }
              else
                  return FALSE;
          }
          else
             return FALSE;
    }

    /***
     *
     * Offers get method for last, today and best offer
     * 
     * @return array or FALSE
     *
    **/ 
    function GetOfersForMain(){
         $LIMIT = 4;
         $OFFSET = 0;
         //   U.foto_exist = 1 AND 
             
         $date = date("Y-m-d H:i:s");
         $where = "R.is_active = 1  AND 
                   CONCAT(R.departure_date,' ',R.departure_time) >='{$date}' ";
         
         // Son eklenen teklifleri al
         $query1 = $this->db -> select('R.id AS ride_offer_id, 
                                        R.destination,
                                        R.origin,
                                        R.price_per_passenger,
                                        R.price_class,
                                        R.departure_date,
                                        U.name,
                                        U.surname,
                                        U.sex,
                                        U.foto,
                                        U.face_check,
                                        U.birthyear'  )
                                 -> from('ride_offers AS R') 
                                 -> join('users AS U', 'U.id = R.user_id')   
                                 -> where( $where  )
                                 -> order_by("R.id", "desc")
                                 -> limit( $LIMIT, $OFFSET)
                                 -> get();   
          
          // Yakın tarihte olan teklifleri al
          $query2 = $this->db -> select('R.id AS ride_offer_id, 
                                         R.destination,
                                         R.origin,
                                         R.price_per_passenger,
                                         R.price_class,
                                         R.departure_date,
                                         U.name,
                                         U.surname,
                                         U.sex,
                                         U.foto,
                                         U.face_check,
                                         U.birthyear'  )
                                 -> from('ride_offers AS R') 
                                 -> join('users AS U', 'U.id = R.user_id')   
                                 -> where( $where  )
                                 -> order_by("R.departure_date", "asc")
                                 -> limit( $LIMIT, $OFFSET)
                                 -> get();  
          
          // En iyi fiyatlı tekliflerden yakın tarihte olanları al
          $where .= " AND R.price_class LIKE 'green' ";
          $query3 = $this->db -> select('R.id AS ride_offer_id, 
                                         R.destination,
                                         R.origin,
                                         R.price_per_passenger,
                                         R.price_class,
                                         R.departure_date,
                                         U.name,
                                         U.surname,
                                         U.sex,
                                         U.foto,
                                         U.face_check,
                                         U.birthyear'  )
                                 -> from('ride_offers AS R') 
                                 -> join('users AS U', 'U.id = R.user_id')   
                                 -> where( $where  )
                                 -> order_by("R.departure_date", "asc")
                                 -> limit( $LIMIT, $OFFSET)
                                 -> get();      
                                                                                 
         if( $query1 && $query2 && $query3 ){
              return array( 'last'  => $query1->result_array(),
                            'today' => $query2->result_array(),
                            'best'  => $query3->result_array()   ); 
         } 
         else{
            return FALSE;
         }                         
    }


/**********************************************************************************************/
/**********************************************************************************************/
/**********************************************************************************************/ 
/********************************     ride_offer_update     ***********************************/
/**********************************************************************************************/
/**********************************************************************************************/
/**********************************************************************************************/

    /**
     *  Add new ride_offer_update model
     *  @param  $offerdata ride_offer_update model array
     *  @return TRUE or FALSE
    **/
	function set_offer_data( $offerdata ){   
           
		    $query  = $this->db->delete('ride_offer_update',array('user_id' => $offerdata['user_id'])  );
			$query2 = $this->db->insert('ride_offer_update', $offerdata); 
            if($query && $query2 )
                 return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
            else
                 return false;
	}
   
    /**
     *  Update  ride_offer_update model
     *  @param  $offerdata ride_offer_update model array
     *  @return TRUE or FALSE
    **/
	function update_offer_data( $offerdata ){   
           
		    $query = $this->db -> where('user_id', $offerdata['user_id'])
		                       -> update('ride_offer_update', $offerdata); 
            if($query  )
                 return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
            else
                 return false;
	}
	
	  
	/**
     *  Get ride_offer_update model with user_id
     *  @param  $offerdata ride_offer_update model array
     *  @return TRUE or FALSE
    **/
	function get_offer_data( $user_id ){   
           
		    $query = $this->db -> where('user_id', $user_id )
		                       -> get('ride_offer_update'); 
            if($query  )
                 return $query->row_array();
            else
                 return false;
	}
	
	
	
	
/**********************************************************************************************/
/**********************************************************************************************/
/******************************** Kullaılmıyor          ***************************************/
/**********************************************************************************************/
/**********************************************************************************************/

    // dispaly result of search result
    function display( $result, $resultTers, $result2, $result2Ters, $result3, $result3Ters, $result4, $result4Ters, $searched      ){
               echo "<html> <head> <title></title><meta charset='utf-8'>  </head><body>";
               echo "<br>";  
               echo "GİDİŞ için Tek seferlik Seyahatler ". count($result) ." tane <br>";
               foreach ($result as $value) {
                       echo  "Tip --- ". $value['no']  ." -- id --> " .$value['id'] . " --- RO id -> ". $value['ride_offer_id']  ." PRİCE->". $value['price_per_passenger'] ." ".  $value['origin'] ." ". $value['destination'] ." ---TARİH---------->".$value['departure_date'] ."--------------".$value['departure_time']  ;
                       echo "<br>";    
               }   

               echo "<br>";  
               echo "DÖNÜŞ için Tek seferlik Seyahatler ". count($resultTers) ." tane <br>";
               foreach ($resultTers as $value) {
                       echo  "Tip --- ". $value['no']  ." -- id --> " .$value['id'] .  " --- RO id -> ". $value['ride_offer_id']  ." PRİCE->". $value['price_per_passenger'] ." ".  $value['origin'] ." ". $value['destination'] ." ---TARİH---------->".$value['departure_date'] ."--------------".$value['departure_time']  ;
                       echo "<br>";    
               }  
               
               echo "<br>";
               echo "GİDİŞ için Çok seferlik Seyahatler ". count($result2) ." tane <br>";
               foreach ($result2 as $value) {
                       echo  "Tip --- ". $value['no']  ." -- id --> " .$value['id'] .  " --- RO id -> ". $value['ride_offer_id'] ." PRİCE->". $value['price_per_passenger'] ." ". $value['origin'] ." ". $value['destination'] ."---TARİH---------->".$value['departure_date'] ."----------------".$value['departure_time']  ;
                       echo "<br>";    
               }
               echo "<br>";
               echo "DÖNÜŞ için Çok seferlik Seyahatler ". count($result2Ters) ." tane <br>";
               foreach ($result2Ters as $value) {
                       echo  "Tip --- ". $value['no']   ." -- id --> " .$value['id'] . " --- RO id -> ". $value['ride_offer_id'] ." PRİCE->". $value['price_per_passenger'] ." ". $value['origin'] ." ". $value['destination'] ."---TARİH---------->".$value['departure_date'] ."----------------".$value['departure_time']  ;
                       echo "<br>";    
               }  
               
               echo "<br>";  
               echo " Waypoints GİDİŞ için tek seferlik Seyahatler ayrı waypoiints ". count($result3) ." tane <br>";
               foreach ($result3 as $value) {
                       //print_r($value);
                       //echo "<br>"; 
                       echo  "Tip --- ". $value['no']  ." -- id --> " .$value['id'] ." ---RO--> ". $value['ride_offer_id'] ." PRİCE->". $value['price_per_passenger'] ." ". $value['origin'] ." ". $value['destination'] ."---TARİH---------->".$value['departure_date'] ."----------------".$value['departure_time']  ;
                       echo "<br>";    
               }
               
               echo "<br>";  
               echo " Waypoints DÖNÜŞ için tek seferlik Seyahatler ayrı waypoiints ". count($result3Ters) ." tane <br>";
               foreach ($result3Ters as $value) {
                       //print_r($value);
                       //echo "<br>"; 
                       echo  "Tip --- ". $value['no']  ." -- id --> " .$value['id'] ." ---RO--> ". $value['ride_offer_id'] ." PRİCE->". $value['price_per_passenger'] ." ". $value['origin'] ." ". $value['destination'] ."---TARİH---------->".$value['departure_date'] ."----------------".$value['departure_time']  ;
                       echo "<br>";    
               }
               echo " <br> Waypoints GİDİŞ için çok seferlik Seyahatler ayrı waypoiints ". count($result4) ." tane <br>";
               foreach ($result4 as $value) {
                       //print_r($value);
                       //echo "<br>"; 
                       echo  "Tip --- ". $value['no']  ." -- id --> " .$value['id'] ." ---RO--> ". $value['ride_offer_id'] ." PRİCE->". $value['price_per_passenger'] ." ". $value['origin'] ." ". $value['destination'] ."---TARİH---------->".$value['departure_date'] ."----------------".$value['departure_time']  ;
                       echo "<br>";    
               }
                              
               echo "<br>";  
               echo " Waypoints DÖNÜŞ Çok seferlik Seyahatler ayrı waypoiints ". count($result4Ters) ." tane <br>";
               foreach ($result4Ters as $value) {
                       //print_r($value);
                       //echo "<br>"; 
                       echo  "Tip --- ". $value['no'] ." -- id --> " .$value['id'] ." ---RO--> ". $value['ride_offer_id'] ." PRİCE->". $value['price_per_passenger'] ." ". $value['origin'] ." ". $value['destination'] ."---TARİH---------->".$value['departure_date'] ."----------------".$value['departure_time']  ;
                       echo "<br>";    
               }
                   

               echo "<br>";
               echo "<br>";
               echo "<br>";
               echo "Total Count : " . count($searched);
               echo "<br>";
               echo "<br>";
               echo "<br>";
               
               foreach ($searched as $value) {
                   print_r($value);
                   echo "<br><br><br>New value<br>";
                   //echo "<br> İD -> " . $value['ride_offer_id'];
               }

               echo "</body></html>";
               exit;
    }    

}// END of the Offersdb Class

/**
 *
 * End of the file offersdb.php
 *
 **/
