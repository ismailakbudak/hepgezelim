<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Contacts Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  $contact = array(  'user_id'           => "",
 *                     'user_type'         => "",
 *                     'issue'             => "",
 *                     'subject'           => "",
 *                     'message'           => "",
 *                     'email'             => "",
 *                     'created_at'        => ""    );
 * 
 */

class Contacts extends CI_Model {

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
    function Add( $contact ) {
        $contact['url'] = temizle($contact['issue']);
		// sunucuda zaman geri olduğu için
    	$contact['created_at'] = date('Y-m-d H:i:s');
					  
        $query = $this->db->insert('contact', $contact);
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
     *  Add new problem model
     *  @parameter  problem
     *  RETURN TRUE or FALSE
    **/    
    function AddProblem( $problem ) {
        $problem['created_at'] = date('Y-m-d H:i:s');
		$query = $this->db->insert('problems', $problem);
        if($query){
               if( $this->db->affected_rows() > 0 ) 
                    return TRUE;
               else
                    return FALSE;
         }
         else
            return FALSE;
    }


 

 }// END of the Contacts Class

/**
 *
 * End of the file Contacts.php
 *
 **/