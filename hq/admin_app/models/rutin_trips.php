<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Rutin_Trips Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Rutin_Trips extends CI_Model {
    
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
        $this->table = 'rutin_trip';
    }
        
    /**
     *  Get offers days
     *  @parameter offerid
     *  RETURN rows or FALSE
    **/
    function GetOfferDays($ride_offer_id){
    	   $this->db->where('ride_offer_id =', $ride_offer_id);
           $query = $this->db->get($this->table);   
           if($query)
              return  $query->result_array(); 
           else
             return FALSE;
    } 


}// END of the Rutin_Trips Class

/**
 *
 * End of the file rutin_trips.php
 *
 **/        