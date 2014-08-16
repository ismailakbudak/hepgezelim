<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Preferences Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 * $preference = array(
 *                     'user_id'    => "",
 *                     'like_chat'  => "",
 *                     'like_music'  => "",
 *                     'like_smoke'  => "",
 *                     'like_pet'  => "",
 *                     'explain'    => "",
 *                    );
 */

class Preferences extends CI_Model {
 
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
        $this->table = 'preferences';
    }

    /**
     *  Update prefrences model
     *  @parameter  userid, preference
     *  RETURN TRUE or FALSE
    **/
    function Update($userid, $preference){ 
           $this->db->where('user_id', $userid);
           $query = $this->db->update($this->table, $preference); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;
    }
    
    /**
     *  Get user preferences settings
     *  @parameter userid
     *  RETURN row or FALSE
    **/
    function GetPreference( $user_id ){
         $where =  array('user_id' => $user_id);  
         $query = $this->db->get_where($this->table , $where );
          if($query)
             return  $query->row_array();
          else
            return FALSE;
    }
    

}// END of the Preferences Class

/**
 *
 * End of the file preferences.php
 *
 **/