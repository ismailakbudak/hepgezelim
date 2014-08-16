<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Block_User Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  $block = array(
 *            'user_id'           => "",
 *            'blocked_user_id'  => "",
 *            'explain'           => "",
 *         );
 * 
 */

class Block_User extends CI_Model {

    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    /**
     *  Add new blocked_user model
     *  @parameter  blocked_user
     *  RETURN TRUE or FALSE
    **/    
    function Add( $blocked_user ) {
    	
		$blocked_user['created_at'] = date('Y-m-d H:i:s');
		
        $query = $this->db->insert('block_user', $blocked_user);
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
     *  Remove blocked_user model
     *  @parameter  block_id
     *  RETURN TRUE or FALSE
    **/ 
    function delete( $block_id ){
         $query = $this->db -> where('id', $block_id)
                            -> delete('block_user');
         if($query){
               return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
         }
         else
            return FALSE;
    }

    /**
     *  Get block user if exist
     *  @parameter  receiver_userid
     *  RETURN rows or FALSE
    **/
    function IsThereBlock( $user_id , $blocked_user_id ){
         $block =  array('user_id' => $user_id, 'blocked_user_id' => $blocked_user_id );  
         $query = $this->db->get_where('block_user', $block );
          if($query){
             $result =  $query->result_array();
             return $result;
          }
          else
            return FALSE;
    }
    
   /**
     *  Get blocked user      
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/   
    function GetBlockedUsers($user_id){
            $query = $this->db -> select('*, block_user.id as block_id, block_user.created_at ')
                               -> from('block_user')
                               -> join('users', 'users.id = block_user.blocked_user_id')
                               -> where('block_user.user_id', $user_id)
                               -> get();   
            if( $query )
                  return  $query->result_array();
            else
                  return FALSE;
    }
 
 }// END of the Block_User Class

/**
 *
 * End of the file block_user.php
 *
 **/