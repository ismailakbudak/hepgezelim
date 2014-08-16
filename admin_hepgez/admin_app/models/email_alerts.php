<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Email_Alerts Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 * $leave_times = array(
 *                      'id'       => "",
 *                      'time'     => "",
 *                      'timeen'   => "", 
 *                    ); 
 */

class Email_Alerts extends CI_Model {
     
    /**
     * Constructor  
    **/ 
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    /**
     *  Save email alert 
     *  @parameter $alert
     *  RETURN TRUE or FALSE
    **/
    function add( $alert ){
    	$alert['created_at'] = date('Y-m-d H:i:s');
	    
	    $query = $this->db->insert('email_alerts', $alert);
        if( $query ){
             if( $this->db->affected_rows() > 0 )
                 return TRUE;
             else
                 return FALSE;      
        }
        else
             return FALSE;
             
    }
   
    /**
     *  Delete user email_alerts  
     *  @parameter  alert_id
     *  RETURN TRUE or FALSE
    **/
    function  delete($alert_id){
        $query = $this->db -> where('id', $alert_id)
                           -> delete('email_alerts');
        if($query){
              return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        }
        else
           return FALSE;
    }  

    /**
     *  Get user email_alerts  
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/
    function GetEmailAlerts( $user_id ){
         
         $query   = $this->db -> select("*,  E.created_at, ( SELECT COUNT(id) 
                                              FROM email_alerts_result AS EE 
                                              WHERE EE.email_alert_id = E.id GROUP BY('id')  ) AS number ")
                              -> from( 'email_alerts E' ) 
                              -> where('user_id',$user_id )
                              -> order_by("date", "asc")
                              -> get();

         $query2  = $this->db -> select("R.*, EE.created_at,  E.ride_offer_id, EE.id, 
                                             ( SELECT group_concat( W.departure_place SEPARATOR '|' ) 
                                               FROM way_points AS W 
                                               WHERE W.ride_offer_id = E.ride_offer_id GROUP BY('W.ride_offer_id')  ) AS departure,
                                               ( SELECT group_concat( W.arrivial_place SEPARATOR '|' ) 
                                               FROM way_points AS W 
                                               WHERE W.ride_offer_id = E.ride_offer_id GROUP BY('W.ride_offer_id')  ) AS arrivial ")
                              -> from( 'email_alerts_result E' ) 
                              -> join('ride_offers R', 'R.id = E.ride_offer_id')
                              -> join( 'email_alerts EE', 'EE.id = E.email_alert_id' ) 
                              -> where('EE.user_id',$user_id )
                              -> get();
                                                 
          if($query && $query2)
              return  array( 'alerts' => $query->result_array(), 'offers' => $query2->result_array() );
          else
              return 0;
    } 

    /**
     *  Get user email_alerts  
     *  @parameter  alert_id
     *  RETURN row or FALSE
    **/
    function getAlert( $alert_id ){
         
         $query  = $this->db -> where('id',$alert_id )
                             -> get('email_alerts');
          if($query)
              return  $query->row_array();
          else
              return 0;
    }    

}// END of the Email_Alerts Class

/**
 *
 * End of the file Email_Alerts.php
 *
 **/


