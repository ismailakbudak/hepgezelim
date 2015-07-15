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
 * $leave_times = array(
 *                      'id'       => "",
 *                      'time'     => "",
 *                      'timeen'   => "", 
 *                    ); 
 */

class Leave_Times extends CI_Model {
     
    /**
     * Constructor  
    **/ 
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
   
    /**
     *  Get all leave times option from database
     *  @parameter  no
     *  RETURN rows or FALSE
    **/
    function GetAll(){
          $query = $this->db->get('leave_times');
          if($query){
             $result =  $query->result_array(); // row_array() ilk satırı döndürür 
             return $result;
          }
          else
            return false;
    }

    /**
     *  Get leave_time information
     *  @parameter  no
     *  RETURN row or FALSE
    **/     
    function GetLeaveTime($leaveTimeid){
          $this->db->where('id', $leaveTimeid);
          $query = $this->db->get('leave_times');
          if($query){
             $result =  $query->row_array(); // row_array() ilk satırı döndürür 
             return $result;
          }
          else
            return false;
    } 
    

}// END of the Lave_Times Class

/**
 *
 * End of the file leave_times.php
 *
 **/


    