<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Email_Send Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 * $send_email = array( 'receiver_user_id'  => "",
 *                      'sender_user_id'    => ""   
 *                    ); 
 */

class Send_Email extends CI_Model {
    
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    /**
     *  Add new send_email model
     *  @param  send_email  is array model
     *  @return TRUE or FALSE
    **/
    function Add( $send_email ) {
        $query = $this->db->insert('send_email_review', $send_email);
        if($query){
               if( $this->db->affected_rows() > 0 ) 
                    return TRUE;
               else
                    return FALSE;
         }
         else
            return FALSE;
    }
 

}// END of the send_email Class

/**
 *
 * End of the file send_email.php
 *
 **/

