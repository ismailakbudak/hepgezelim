<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Way_Points Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Way_Points extends CI_Model {
    
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
        $this->table = 'way_points';
    }

    /**
     *  Get offer waypoints 
     *  @parameter offerid
     *  RETURN rows or FALSE
    **/
    function GetOfferWays($offer_id){
           $this->db->where('ride_offer_id =', $offer_id);
           $query = $this->db->get($this->table);   
           if($query){
              $result =  $query->result_array();
              if( count($result) == 1 )
                    $result = array(array());

               return $result;      
           }
           else
             return FALSE;
    } 
    /**
     *  Get offer ways_offers 
     *  @parameter offerid
     *  RETURN rows or FALSE
    **/
    function GetOfferWaysOffer($offer_id){
           $this->db->where('ride_offer_id =', $offer_id);
           $query = $this->db->get('ways_offer');   
           if($query){
               $result =  $query->result_array();
               return $result;      
           }
           else
             return FALSE;
    } 

    



}// END of the Way_Points Class

/**
 *
 * End of the file way_points.php
 *
 **/