<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Ratings_Db Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  $ratings = array(
 *            'given_userid'      => "",
 *            'received_userid'   => "",
 *            'rate'              => "",
 *            'comment'           => "",
 *            'is_driver'         => "",
 *            'skill'             => "",
 *         );
 * 
 */

class Ratings_Db extends CI_Model {

    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    /*****
      |      
      |  Add rating model
      |  @parameter rating
      |  RETURN true or FALSE
      |
    *****/
    function Add( $rating ) {
        // sunucuda zaman geri olduğu için
        $rating['created_at'] = date('Y-m-d H:i:s');
			 
        $query = $this->db->insert('ratings', $rating);
        if($query){
               return ($this->db->affected_rows() > 0 ) ? TRUE: FALSE;
        }
        else
            return FALSE;
    }
	
	    /****
     | 
     |  Delete rating information with id
     |  @parameter $rating_id
     |  @RETURN TRUE or FALSE
     |
     ****/   
    function delete($rating_id){
            $query =  $this->db->delete('ratings', array('id'           => $rating_id));
            if($query ){     
                   if($this->db->affected_rows() > 0) 
                      return TRUE;
                   else 
                       return FALSE;
            }      
            else
                  return FALSE; 
    } 

    /*****
      |      
      |  Rating controle is there before rating
      |  @parameter rating
      |  RETURN true or FALSE
      |
    *****/
    function is_there( $given_userid , $received_userid ) {
          $query = $this->db->where('received_userid', $received_userid)
                            ->where('given_userid', $given_userid) 
                            ->get('ratings');
          if($query){
              $row =  $query->row_array(); 
              return count($row) > 0 ? TRUE : FALSE;
          }
          else
             return TRUE;
    }

    /***
     |
     |  Get user ratings from database 
     |  @parameter | userid 
     |  @RETURN     | rows or FALSE
     | 
    ***/ 
    function GetUserRatings( $user_id ){
          $query = $this->db-> select("*, ratings.created_at")
                            -> from("ratings")
                            -> where('received_userid', $user_id)
                            -> join('users', 'users.id = ratings.given_userid') 
                            -> get();
          if($query)
             return $query->result_array(); 
          else
             return false;
    }
    
    /***
     |
     |  Get user ratings from database 
     |  @parameter | userid 
     |  @RETURN     | rows or FALSE
     | 
    ***/ 
    function GetUserRatingsSide( $user_id ){
          $query = $this->db-> select("*, ratings.created_at")
                            -> from("ratings")
                            -> where('received_userid', $user_id)
                            -> join('users', 'users.id = ratings.given_userid')
                            -> limit(5) 
                            -> get();
          if($query)
             return $query->result_array(); 
          else
             return false;
    }
    

    /***
     |
     |  Get user ratings from database 
     |  @parameter | userid 
     |  @RETURN     | rows or FALSE
     | 
    ***/ 
    function GetUserRatingsWithUser( $user_id  ){
          $query = $this->db-> select("*, ratings.created_at")
                            -> from("ratings")
                            -> where('received_userid', $user_id)
                            -> join('users', 'users.id = ratings.given_userid') 
                            -> get();
          if($query)
             return $query->result_array(); 
          else
             return false;
    }

    /***
     |
     |  Get user ratings from database 
     |  @parameter | userid 
     |  @RETURN     | rows or FALSE
     | 
    ***/ 
    function GetUserGivenRatings( $user_id  ){
          $query = $this->db->where('given_userid', $user_id)
                            ->get('ratings');
          if($query)
             return $query->result_array(); 
          else
             return false;
    }


    /***
     |
     |  Get user list given ratings 
     |  @parameter | userid 
     |  @RETURN     | rows or FALSE
     | 
    ***/ 
    function GetUserListGivenRate( $user_id  ){
          $query = $this->db -> select( "received_userid as id" )
                             -> where('given_userid', $user_id)
                             -> get('ratings');
          if($query)
             return $query->result_array(); 
          else
             return false;
    }


    /***
     |
     |  Get user ratings from database 
     |  @parameter | userid 
     |  @RETURN     | rows or FALSE
     | 
    ***/ 
    function GetUserGivenRatingsWithUser( $user_id  ){
          $query = $this->db-> select("*, ratings.created_at, ratings.id rating_id")
                            -> from("ratings")
                            -> where('given_userid', $user_id)
                            -> join('users', 'users.id = ratings.received_userid') 
                            -> get();
          if($query)
             return $query->result_array(); 
          else
             return false;
    }

    /***
     |
     |  Get user ratings average  
     |  @parameter | userid 
     |  @RETURN    | average or FALSE
     | 
    ***/ 
    function GetUserAverageRatings( $user_id  ){
          $query = $this->db->select(" AVG(rate) as average, ")
                            ->from("ratings")
                            ->where('received_userid', $user_id)
                            ->get();
          if($query){
                 $result =  $query->row_array();
                 return $result['average'];
          }     
          else
            return false;
    }

    /***
     |
     |  Get user total ratings count  
     |  @parameter | userid 
     |  @RETURN    | average or FALSE
     | 
    ***/ 
    function totalRating( $user_id  ){
          $query = $this->db->select("COUNT(id) as number")
                            ->from("ratings")
                            ->where('received_userid', $user_id)
                            ->get();
          if($query){
                 $result =  $query->row_array();
                 return $result['number'];
          }     
          else
            return false;
    }

    
    /***
     |
     |  Get user ratings grouped by value  
     |  @parameter | userid 
     |  @RETURN    | average or FALSE
     | 
    ***/ 
    function GetGroupedRatings( $user_id  ){
          $query = $this->db-> select("*, AVG(rate) as average, COUNT(rate) as number ")
                            -> from("ratings")
                            -> where('received_userid', $user_id)
                            -> group_by('rate')
                            -> get();
          if($query){
                 $result =  $query->result_array();
                 return $result;
          }     
          else
            return false;
    }

 }// END of the Ratings_Db Class

/**
 *
 * End of the file Ratings_Db.php
 *
 **/    