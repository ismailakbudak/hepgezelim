
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
   /**
    *   Return offer locations lat and lng 
    *   
    *   @param    
    *   @return    
   **/  
  function getLocation( &$offer , $locations  ){
          $result = 0;
          foreach ($locations as $val) {
                 if(  strcmp( $val['name'] , $offer['departure_place'] )  == 0 ){
                     $offer['lat'] = $val['lat'];
                     $offer['lng'] = $val['lng'];
                     $result++;
                 }
                 if(  strcmp( $val['name'] , $offer['arrivial_place'] )  == 0 ){
                 	 $offer['dLat'] = $val['lat'];
                     $offer['dLng'] = $val['lng'];
                     $result++;
                 }
                 if( $result == 2 )
                 	break;
          }
          return $result;     
   }
  