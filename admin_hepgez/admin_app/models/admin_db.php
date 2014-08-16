<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Admin_Db Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  
 */

class Admin_Db extends CI_Model {
    
    public $LIMIT;

    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
        $this->LIMIT = 50;
    }
     

    /**
     *  Get user password and email 
     *
     *  @param $username   
     *  @param $password
     *
     *  @return row or FALSE
    **/
    function  Login($username , $password ){
          $user = array('username' => $username , 'password' => md5($password)  ); //, 'is_active' => '1'
          $query = $this->db->get_where('admin_users', $user  );
          if( $query )
               return $query->row_array();
          else
               return false;
    }

    /**
     *  Get user password and email 
     *  
     *  @return array or FALSE
    **/
    function GetDataCounts(){
            
            $counts = array();
            $counts['user_photo_count'   ] = -1; // bakılmayı bekleyen kullanıcı foto onayları   // users table    
            $counts['car_photo_count'    ] = -1; // bakılmayı bekleyen araç foto onayları        // cars table
            $counts['alert_user_count'   ] = -1; // bakılmayı bekleyen mesaj şikayetleri         // alert_user table
            $counts['complain_count'     ] = -1; // bakılmayı bekleyen şikayetler                // complain table 
            $counts['contact_count'      ] = -1; // bakılmayı bekleyen iletişimler               // contact table
            $counts['delete_acount_count'] = -1; // bakılmayı bekleyen silme nedenleri           // delete_acount table
            $counts['problem_count'      ] = -1; // bakılmayı bekleyen problemeler               // problems table
            $counts['search_count'       ] = -1; // bakılmayı bekleyen aramalar                  // searched table
           // users foto_onay = 0   
           $query = $this->db -> select( "COUNT(id) AS num" )
                              -> where('foto_onay', 0 )
                              -> get('users');
           // cars foto_onay = 0   
           $query2 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('foto_onay', 0 )
                               -> get('cars');
           // alert_user is_read = 0   
           $query3 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('is_read', 0 )
                               -> where('received_user_id !=', 0 )
                               -> where('sender_user_id !=', 0 )
                               -> where('message_id !=', 0 )
                               -> get('alert_user');
           // complain user is_read = 0   
           $query4 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('is_read', 0 )
                               -> get('complain');
           // contact  is_read = 0   
           $query5 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('is_read', 0 )
                               -> get('contact');
           // delete_acount  is_read = 0   
           $query6 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('is_read', 0 )
                               -> get('delete_acount');
           // problems  is_read = 0   
           $query7 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('is_read', 0 )
                               -> get('problems');
           
           // searched  is_active = 0   
           $query8 = $this->db -> select( "COUNT(id) AS num" )
                               -> where('is_active', 0 )
                               -> get('searched');
           
		                                         
           // for users photo
           if(  $query && $query2 && $query3 && $query4  && $query5 && $query6 && $query7 && $query8 ){
                $result                        = $query->row_array();
                $counts['user_photo_count']    = $result['num'];

                $result                        = $query2->row_array();
                $counts['car_photo_count']     = $result['num'];

                $result                        = $query3->row_array();
                $counts['alert_user_count']    = $result['num'];

                $result                        = $query4->row_array();
                $counts['complain_count']      = $result['num'];

                $result                        = $query5->row_array();
                $counts['contact_count']       = $result['num'];

                $result                        = $query6->row_array();
                $counts['delete_acount_count'] = $result['num'];

                $result                        = $query7->row_array();
                $counts['problem_count']       = $result['num'];
				
				$result                        = $query8->row_array();
                $counts['search_count']        = $result['num'];
           }    
          
          return $counts;
    }

    /**
     *  Get changing car images   
     *  
     *  @return rows or FALSE
    **/
    function GetCarImages(){
          
           // cars foto_onay = 0   
           $query  = $this->db -> select("*")
                               -> where('foto_onay', 0 )
                               -> limit( $this->LIMIT )
                               -> get('cars');
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;  
    }

    /**
     *  Get approval car images   
     *  @param $LIMIT count of row
     *  @param $OFFSET start point
     *  @return rows or FALSE
    **/
    function GetCarImagesApproval($LIMIT, $OFFSET ){

           // cars foto_onay = 0   
           $query  = $this->db -> select("*")
                               -> where('foto_exist', 1 )
                               -> limit( $LIMIT, $OFFSET)
                               -> get('cars');
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;  
    }

    /**
     *  Get changing user images   
     *  
     *  @return rows or FALSE
    **/
    function GetUserImages(){
          
           // cars foto_onay = 0   
           $query  = $this->db -> select("*")
                               -> where('foto_onay', 0 )
                               -> limit( $this->LIMIT )
                               -> get('users');
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;  
    }

    /**
     *  Get approval user images   
     *  
     *  @param $LIMIT count of row
     *  @param $OFFSET start point
     *  @return rows or FALSE
    **/
    function GetUserImagesApproval($LIMIT, $OFFSET ){

           // cars foto_onay = 0   
           $query  = $this->db -> select("*")
                               -> where('foto_exist', 1 )
                               -> limit( $LIMIT, $OFFSET)
                               -> get('users');
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;  
    }
  
    /**
     *  Get alerted messages   
     *  
     *  @return rows or FALSE
    **/
    function GetAlerts(){
          
           // alert_user is_read = 0   
           $query  = $this->db -> select("A.*, M.message, U.name s_name, U.surname s_surname, U.foto s_foto ,
                                                          US.name r_name, US.surname r_surname, US.foto r_foto   ")
                               -> join('messages M', 'M.id = A.message_id')
                               -> join('users U', 'U.id = A.sender_user_id'  )
                               -> join('users US', 'US.id = A.received_user_id'  )
                               -> where('A.is_read', 0 )
							   -> limit( $this->LIMIT )
                               -> get('alert_user A');
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;  
    }

    /**
     *  Update $table variable table with $id and $update data    
     *
     *  @param $table name of the table
     *  @param $id   id of the update_data
     *  @param $update_data  updated variables
     *  @return TRUE or FALSE
    **/
    function update($table , $id , $update_data ){
           $query = $this->db -> where('id', $id)
                              -> update($table, $update_data); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;
    }

    /**
     *  Delete $table variable table with $id and $update data    
     *
     *  @param $table name of the table
     *  @param $id   id of the update_data 
     *  @return TRUE or FALSE
    **/
    function delete($table , $id ){
           $query = $this->db -> where('id', $id)
                              -> delete($table); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return FALSE;
    }
	
    /**
     *  Add new value to warning_user table 
     *
     *  @param $warning  user warning message 
     *  @return TRUE or FALSE
    **/
    function addWarning( $warning ){
    	$warning['created_at'] = date('Y-m-d H:i:s');
	    
        $query = $this->db->insert("warnings", $warning);
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
     *  Get banned users 
     *
     *   
     *  @param $LIMIT count of row
     *  @param $OFFSET start point
     *  @return rows or FALSE
    **/
    function GetBannedUsers( $LIMIT , $OFFSET ){
           // users ban = 1   
           $query  = $this->db -> select("*")
                               -> where('ban', 1 )
                               -> limit( $LIMIT, $OFFSET)
                               -> get('users');
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;  
    }

    /**
     *  Get complains about the user   
     *
     *    
     *  @return rows or FALSE
    **/
    function GetComplains(){
           
            // complain user is_read = 0  üye olmayan lardan şikayetler 
            $query = $this->db -> select( "C.*, U.name s_name, U.surname s_surname, U.foto s_foto ,
                                                US.name r_name, US.surname r_surname, US.foto r_foto   " )
			                   -> from( 'complain C' )
		                       -> join('users U', 'U.id = C.user_id'  )
                               -> join('users US', 'US.id = C.complain_user_id'  )
                               -> where('C.is_read', 0 ) 
                               -> limit( $this->LIMIT )
                               -> get();  
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;                      
    }

    /**
     *  Get contacts    
     *
     *    
     *  @return rows or FALSE
    **/
    function GetContacts(){
           
            // complain user is_read = 0  üye olmayan lardan şikayetler 
            $query = $this->db -> select( "*, COUNT('id') num " )
                               -> where('is_read', 0 )
                               -> group_by('issue')  
                               -> get('contact');  
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;                      
    }

    /**
     *  Get contacts  contents about the parameter $ISSUE_URL  
     *
     *  @param $ISSUE_URL is about contents  url variable 
     *  @return rows or FALSE
    **/
    function GetContactContents( $ISSUE_URL ){
           
            // complain user is_read = 0  üye olmayan lardan şikayetler 
            $query = $this->db -> select( "*" )
                               -> where('is_read', 0 )
                               -> like('url', $ISSUE_URL )
                               -> limit( $this->LIMIT )
                               -> get('contact');  
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;                      
    }

    /**
     *  Get reasons    
     *
     *   
     *  @return rows or FALSE
    **/
    function GetDeleteAcountReasons(  ){
           
            // complain user is_read = 0  üye olmayan lardan şikayetler 
            $query = $this->db -> select( "*" )
                               -> where('is_read', 0 ) 
                               -> limit( $this->LIMIT )
                               -> get('delete_acount');  
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;                      
    }
     
    /**
     *  Get problems about the site    
     *
     *   
     *  @return rows or FALSE
    **/
    function GetProblems(  ){
           
            // complain user is_read = 0  üye olmayan lardan şikayetler 
            $query = $this->db -> select( "*" )
                               -> where('is_read', 0 ) 
                               -> limit( $this->LIMIT )
                               -> get('problems');  
            if( $query )
                 return $query->result_array();                    
            else
                 return FALSE;                      
    }
    

    /**
     *  Get user with id
     *
     *   
     *  @return rows or FALSE
    **/
    function  GetUser( $id ){  
            $query = $this->db -> where('id', $id ) 
                               -> get('users');  
            if( $query )
                 return $query->row_array();                    
            else
                 return FALSE;                      
    } 
    

}// END of the Admin_Db Class

/**
 *
 * End of the file Admin_Db.php
 *
 **/

