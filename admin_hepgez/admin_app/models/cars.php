<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Cars Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  $car = array(
 *           'user_id'          => "",
 *           'foto_name'        => "",
 *           'make'             => "",
 *           'model'            => "",
 *           'comfort'          => "",
 *           'number_of_seats'  => "",
 *           'colour'           => "",
 *           'type'             => "",
 *           'explain'          => ""
 *        ); 
 */

class Cars extends CI_Model {

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
        $this->table = 'cars';
    }

    /**
     *  Add new car model
     *  @parameter car
     *  RETURN carid or FALSE
    **/
    function Add( $car ) {
    	// Zaman serverda farklı olduğu için Türkiye Saatini al
    	$car['created_at'] = date('Y-m-d H:i:s');
		
        $query = $this->db->insert($this->table, $car);
        if($query){
               if( $this->db->affected_rows() > 0 ) {
                   $car_id = $this->db->insert_id();
                   if($car_id > 0)
                       return $car_id;
                   else
                       return FALSE;
               }
               else
                 return FALSE;
         }
         else
            return FALSE;
    }
    
    /**
     *  Delete car
     *  @parameter carid
     *  RETURN TRUE or FALSE
    **/    
    function Delete($car_id){
         $this->db->where('id', $car_id);
         $query =  $this->db->delete($this->table);
          if($query){
               return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
         }
         else
            return FALSE;
    }

    /**
     *  Update car
     *  @parameter carid, car
     *  RETURN TRUE or FALSE
    **/     
    function Update($carid, $car){
           $car['updated_at'] =  date('Y-m-d H:i:s');  
           $this->db->where('id', $carid);
           $query = $this->db->update($this->table, $car); 
            
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;
    }


    /**
     * Get car information
     *  @parameter carid
     *  RETURN row or FALSE
    **/
    function GetCar( $car_id ){
         $car =  array('id' => $car_id);  
         $query = $this->db->get_where($this->table, $car );
          if($query){
             $result =  $query->row_array(); // row_array() ilk satırı döndürür 
             return $result;
          }
          else
            return FALSE;
    } 

    /**
     * Get car information
     *  @parameter carid
     *  RETURN row or FALSE
    **/
    function checkCar( $car_id ){
         $car =  array('car_id' => $car_id);  
         $query = $this->db->get_where('ride_offers', $car );
          if($query){
             $result =  $query->result_array(); 
             return $result;
          }
          else
            return FALSE;
    } 

    /**
     *  Get user's all car
     *  @parameter userid
     *  RETURN rows or FALSE
    **/
    function GetUserCars( $user_id ){
         $car =  array('user_id' => $user_id);  
         $query = $this->db->get_where($this->table, $car );
          if($query){
             $result =  $query->result_array(); // row_array() ilk satırı döndürür 
             return $result;
          }
          else
            return FALSE;
    }
    
        
}// END of the Cars Class

/**
 *
 * End of the file cars.php
 *
 **/
