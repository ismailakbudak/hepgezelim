<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Searched Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Searched extends CI_Model {
     
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    } 

   /**
     *  Add new searched model  
     *  @parameter look_at  
     *  RETURN row or FALSE
    **/    
     function Add($search){
            $query =$this->db -> insert( 'searched' , $search );  
            if($query){
                 if( $this->db->affected_rows() > 0 ) 
                    return TRUE;
                 else
                    return FALSE;
            }
            else
              return FALSE;
     }

     /**
     *  Get most searched places origin  
     *  RETURN row or FALSE
    **/    
     function GetMost(){ 
            $LIMIT = 18;
            // most searched offer 
            $query =$this->db  -> select ('origin, lat, lng, count("origin") as num ')
                               -> group_by('origin')
                               -> limit( $LIMIT )
                               -> order_by("num", "desc" )
                               -> get('searched'); 

            // most created offer 
            $query2 =$this->db -> select ('departure_place as origin, lat, lng, count("departure_place") as num ')
                               -> group_by('departure_place')
                               -> limit( $LIMIT )
                               -> order_by("num", "desc" )
                               -> get('offer_created');                      

            if( $query && $query2 )
                 return array( 'mostSearched' => $query->result_array(), 'mostCreated' =>  $query2->result_array() );
            else
                 return FALSE;
     }
     
	/**
     *  Get most searched places origin  
     *  RETURN row or FALSE
    **/    
     function GetSearchNotActive(){ 
            $LIMIT = 18;
            // most searched offer 
            $query =$this->db  -> select ('id,origin, lat, lng')
			                   -> where( "is_active", 0 ) 
                               -> limit( $LIMIT ) 
                               -> get('searched'); 

            if( $query  )
                 return   $query->result_array();
            else
                 return FALSE;
     }
	 

}// END of the Searched Class

/**
 *
 * End of the file Searched.php
 *
 **/
