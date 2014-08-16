<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Notifications Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *   $notification = array(
 *                          'offer_publish_success'    => "",
 *                          'offer_update_success'  => "",
 *                          'new_message'  => "",
 *                          'after_ride'  => "",
 *                          'receive_rate'  => "",
 *                          'updates'    => "",
 *                       );
 */

class Notifications extends CI_Model {

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
        $this->table = 'notifications';
    }

    /**
     *  Update notification model
     *  @parameter  userid, notification 
     *  RETURN TRUE or FALSE
    **/ 
    function Update($userid, $notification){
    	   
		   // sunucuda zaman geri olduğu için
    	
           $notification['updated_at'] =  date('Y-m-d H:i:s');     
           $this->db->where('user_id', $userid);
           $query = $this->db->update($this->table, $notification); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;
    }
    
    /**
     *  Get user notification settings
     *  @parameter  userid
     *  RETURN row or FALSE
    **/
    function GetNotification( $user_id ){
          $where =  array('user_id' => $user_id);  
          $query = $this->db->get_where($this->table , $where );
          if($query)
             return  $query->row_array(); 
          else
            return FALSE;
    }
    

}// END of the Notifications Class

/**
 *
 * End of the file notifications.php
 *
 **/