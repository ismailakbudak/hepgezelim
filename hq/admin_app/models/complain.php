<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Complain Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  $complain = array(  'user_id'           => "",
 *                     'user_type'         => "",
 *                     'issue'             => "",
 *                     'subject'           => "",
 *                     'message'           => "",
 *                     'email'             => "",
 *                     'created_at'        => ""    );
 * 
 */

class Complain extends CI_Model {

    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    /**
     *  Add new contact model
     *  @parameter  contact
     *  RETURN TRUE or FALSE
    **/    
    function Add( $complain ) {
    	// Zaman serverda farklı olduğu için Türkiye Saatini al
    	$complain['created_at'] = date('Y-m-d H:i:s');
		
        $query = $this->db->insert('complain', $complain);
        if($query){
               if( $this->db->affected_rows() > 0 ) 
                    return TRUE;
               else
                    return FALSE;
         }
         else
            return FALSE;
    }



 }// END of the Complain Class

/**
 *
 * End of the file complain.php
 *
 **/