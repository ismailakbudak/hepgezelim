<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Alerts Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Look_At extends CI_Model {
    
    /**
     * Constructor  
    **/     
    public $table;
   
    /**
     * Constructor  
    **/
     function __construct(){
         parent::__construct();
         $this->db = $this->load->database('default', TRUE);
         $this->table = 'look_at';
     }
     
      /**
     *  Add new loook_at model  
     *  @parameter look_at  
     *  RETURN row or FALSE
    **/    
     function Add($look_at){
            //$query2 = $this->db -> like('path', $look_at['path'] )
            //                    -> limit(1) 
            //                    -> get('look_at');
            //if( $query2 ){
            //    $result = $query2->row_array();
            //    if(  count($result) == 0 ){
            	
    	              // sunucuda zaman geri olduğu için
    				  $look_at['created_at'] = date('Y-m-d H:i:s');
		
                      $query = $this->db -> insert( 'look_at' , $look_at );  
                      if($query){
                           if( $this->db->affected_rows() > 0 ) 
                              return TRUE;
                           else
                              return FALSE;
                      }
                      else
                          return FALSE;
            //    } 
            //    else{
            //          return TRUE;
            //    }   
            //}
            //else
            //  return FALSE;
     } 

    /**
     *  Get looked count to offer  
     *  @parameter offerid  
     *  RETURN row or FALSE
    **/    
     function GetLookCount($offer_id){
            $query =$this->db -> select('ride_offer_id, COUNT(id) AS look  ')
                              -> where('ride_offer_id =', $offer_id)
                              -> group_by('ride_offer_id')
                              -> get($this->table);   
            if($query)
               return  $query->row_array(); 
            else
              return FALSE;
     } 
    
    /**
     *  Get looked count to offer  
     *  @parameter offerid  
     *  RETURN rows or FALSE
    **/    
     function GetLookList($offer_id){

           $query = $this->db -> select('*, COUNT(user_id) AS number')
                              -> from('look_at')
                              -> join('users', 'users.id = look_at.user_id')
                              -> where('user_id >', 0)
							  -> where('ride_offer_id =', $offer_id)
							  -> group_by('user_id')
                              -> get();    
            if($query)
               return  $query->result_array(); 
            else
              return FALSE;
     }


    /**
     *  Get offers thats are user looked   
     *  @parameter $user_id
     *  RETURN rows or FALSE
    **/    
     function GetUserLookList($user_id){
           $query = $this->db -> select('path, look_at.origin, look_at.destination,  MAX(look_at.created_at) AS created_at ')
                              -> from('look_at')
                              -> join('ride_offers', 'ride_offers.id = look_at.ride_offer_id')
                              -> where('look_at.user_id =', $user_id)
                              -> order_by("created_at", "DESC")
                              -> group_by('path') 
                              -> limit(15) 
                              -> get();    
            if($query)
               return  $query->result_array(); 
            else
              return FALSE;
     }

     


}// END of the Look_At Class

/**
 *
 * End of the file look_at.php
 *
 **/