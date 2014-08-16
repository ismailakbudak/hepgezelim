<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Luggages Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Luggages extends CI_Model {
    
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    /**
     *  Get luggage information
     *  @parameter  no
     *  RETURN row or FALSE
    **/     
    function GetLuggage($luggage_id){
          $this->db->where('id', $luggage_id);
          $query = $this->db->get('luggages');
          if($query){
             $result =  $query->row_array(); // row_array() ilk satırı döndürür 
             return $result;
          }
          else
            return false;
    } 

    /**
     *  Get all luggages information
     *  @parameter  no
     *  RETURN rows or FALSE
    **/     
    function GetAll(){
          $query = $this->db->get('luggages');
          if($query){
             $result =  $query->result_array(); // row_array() ilk satırı döndürür 
             return $result;
          }
          else
            return false;
    }
    

}// END of the Luggages Class

/**
 *
 * End of the file luggages.php
 *
 **/