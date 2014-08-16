<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Alert_User Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 * $alert = array( 'sender_user_id'  => "",
 *                 'received_user_id'  => "",
 *                 'offer_id'  => "",
 *                 'explain'  => "",
 *                 'is_read' => "" 
 *               ); 
 */

class Alert_User extends CI_Model {
    
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    /**
     *  Add new alert_user model
     *  @param  alert_user  is array model
     *  @return TRUE or FALSE
    **/
    function Add( $alert_user ) {
        $alert_user['created_at'] = date('Y-m-d H:i:s');
	    
        $query = $this->db->insert('alert_user', $alert_user);
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
     *  Check alert_user model is exist for parameter
     *  @param  $alert_user, is array model   
     *  @return TRUE or FALSE
    **/
    function checkAlert( $alert_user ) {
        $query = $this->db->get_where('alert_user', $alert_user);
        if($query){
              return $query->row_array(); 
        }
        else
            return FALSE;
    }

}// END of the Alert_User Class

/**
 *
 * End of the file Alert_User.php
 *
 **/

