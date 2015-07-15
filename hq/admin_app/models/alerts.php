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
 * $alert = array(
 *                 'user_id'  => "",
 *                 'explain'  => "",
 *               ); 
 */

class Alerts extends CI_Model {
    
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    /**
     *  Add new alert model
     *  @parameter alert
     *  RETURN TRUE or FALSE
    **/
    //function Add( $alert ) {
    //    $query = $this->db->insert('alerts', $alert);
    //    if($query){
    //           if( $this->db->affected_rows() > 0 ) 
    //                return TRUE;
    //           else
    //                return FALSE;
    //     }
    //     else
    //        return FALSE;
    //}

    /**
     *  User update Method
     *  @parameter userid, user
     *  RETURN TRUE or FALSE
    **/
    function Update($user_id, $where){
            $query =  $this->db -> where('user_id', $user_id)
                                -> update('alerts', $where); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;
    }
    

    /**
     *  Get unread alerts number
     *  @parameter  userid
     *  RETURN number or 0
    **/
    function GetUnreadAlerts( $user_id ){
         
         //$where = "CONCAT(`name`,' ',`surname`) LIKE '$name%' AND id != $user_id";  
         $where  = "user_id = $user_id AND (  (arac = 0 AND arac_again=1) 
                                              OR tercih     = 0 
                                              OR bio        = 0 
                                              OR photo      = 0 
                                              OR email      = 0 
                                              OR face       = 0 
                                              OR extra_read = 0 )"; 
         $query  = $this->db -> where( $where )
                             -> get('alerts');
          if($query){
             $result =  $query->row_array();
             if( $result )
                 return 1;
             else
                 return 0;
          }
          else
            return 0;
    }

     /**
     *  Get unread alerts
     *  @parameter  userid
     *  RETURN rows or FALSE
    **/
    function GetUnreadAlertsContent( $user_id ){
          $where  = "user_id = $user_id AND (  (arac = 0 AND arac_again=1) 
                                              OR tercih     = 0 
                                              OR bio        = 0 
                                              OR photo      = 0 
                                              OR email      = 0 
                                              OR face       = 0 
                                              OR extra_read = 0 )"; 
         $query  = $this->db -> where( $where )
                             -> get('alerts');
          if($query){
             $result =  $query->row_array();
             return $result;
          }
          else
              return FALSE;
    }
    
 
}// END of the Alerts Class

/**
 *
 * End of the file alerts.php
 *
 **/

