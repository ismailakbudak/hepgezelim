<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Users Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */

class Users extends CI_Model {
    
    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    /** 
     *   Add new user method 
     *  @parameter user
     *  RETURN TRUE or FALSE
    **/
    function Add( $user ) {
        
       $this->db->trans_begin();                                            // I will create some info so i need to use transection      
       $result = TRUE;
	   
       // sunucuda zaman geri olduğu için
       $user['created_at'] = date('Y-m-d H:i:s');
			 
       $query = $this->db->insert('users', $user);                          // Save user
       if($query){
           $user_id =  $this->db->insert_id();                              // Get inserted data id
           if(isset($user_id) && $user_id > 0 ){ 
                $value = array('user_id' => $user_id ); 
                $query1 = $this->db->insert('alerts' , $value);        // save new preferences for user
                $query2 = $this->db->insert('preferences' , $value);        // save new preferences for user
                $query3 = $this->db->insert('notifications' , $value); // save new notifications for user
                $query4 = $this->db->insert('cars', $value );
                if($query1 && $query2 && $query3 && $query4 ){
                    if($this->db->affected_rows() > 0)
                       $result =  TRUE; 
                    else
                        $result =  FALSE;
                }
                else
                    $result = false;   
            }
            else
              $result = false;
        }  
        else
            $result = false;

        if ($this->db->trans_status() == FALSE || $result == FALSE){  // everything is ok or not
             $this->db->trans_rollback();                             // there is some worng thing rollback
             return FALSE;
        }
        else{
            $this->db->trans_commit();                                // everything is ok commit actions
            return TRUE;
        }  
    }
    
    /**
     *  User update Method
     *  @parameter userid, user
     *  RETURN TRUE or FALSE
    **/
    function Update($id, $user){
    	   // sunucuda zaman geri olduğu için
           date_default_timezone_set('Europe/Istanbul');
           
           $user['updated_at'] =  date('Y-m-d H:i:s');  
           $this->db->where('id', $id);
           $query = $this->db->update('users', $user); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;
    }
    
    /**
     *  Check email is using or not 
     *  @parameter  email
     *  RETURN TRUE or FALSE
    **/
    function Search(  $email ) {
          $user = array('email' => $email );
          $query = $this->db->get_where('users', $user ,10 );
          if($query){
               $result =  $query->result_array(); 
               return (count($result) > 0) ? TRUE : FALSE;
           }
           else
               return false;
    }
    
    /**
     *  Check email is using or not 
     *  @parameter  email
     *  RETURN TRUE or FALSE
    **/
    function Search2(  $email ) {
          $user = array('email' => $email );
          $query = $this->db->get_where('users', $user ,1 );
          if($query){
               $result =  $query->row_array(); 
               return $result;
           }
           else
               return false;
    }

    /**
     *  Get user password and email 
     *  @parameter email, password
     *  RETURN row or FALSE
    **/
    function Login($email , $password){
          $user = array('email' => $email , 'password' => md5($password)   );
          $query = $this->db->get_where('users', $user  );
          if( $query )
            return $query->row_array();
          else
            return false;
    }

    /**
     *  Get user Levels
     *  @parameterno
     *  RETURN row or FALSE
    **/
    function GetUserLevels(){
        $query  = $this->db -> get( 'user_level' );
        if( $query )
            return $query->result_array();
        else
            return false;
    }
    
    /**
     *  Level update user in login controller 
     *  @parameter email, password
     *  RETURN row or FALSE
    **/    
    function levelUpdate( $user_id ){
          $query1 = $this->db -> select('COUNT(id) as number')
                              -> from('ride_offers')
                              -> where('user_id', $user_id)
                              -> get();
          $query2 = $this->db -> select('*, users.created_at as since, users.description as abaoutme')
                              -> from('users')
                              -> join('preferences', 'users.id = preferences.user_id')
                              -> join('user_level',  'users.level_id = user_level.level_id')
                              -> where('users.id', $user_id)
                              -> get();
          $query3 = $this->db -> select('COUNT(id) as number')
                              -> from('ratings')
                              -> where('received_userid', $user_id)
                              -> where('rate > 2')
                              -> get();

          if( $query1 && $query2 && $query3 ){
             $result1 = $query1->row_array(); // number
             $flag = TRUE;
             if( $result1 )
                   $offer_count = $result1['number'];
             else
                  $flag = FALSE;
                    
             $result2 = $query2->row_array();
             if( $result2 ){
                  $face_check  = $result2['face_check'];
                  $tel_check   = $result2['tel_check'];
                  $email_check = $result2['email_check'];
                  $since       = $result2['since'];
                  $like_chat   = $result2['like_chat'];
                  $like_pet    = $result2['like_pet'];
                  $like_smoke  = $result2['like_smoke'];
                  $like_music  = $result2['like_music'];
             }
             else
                 $flag = FALSE;
             
             $result3 = $query3->row_array(); // number
             if( $result3 )
                   $rating_count = $result3['number'];
             else
                   $flag = FALSE;
              
              if( $flag ){
                   // yaptığı teklif sayısı // 1-2 +5    3-5 +10     6-11  +15    12> +20
                   $puan = 15;
                   if( $offer_count >= 1 && $offer_count < 3 )     
                        $puan += 5;
                   else if( $offer_count >= 3 && $offer_count < 6 )     
                        $puan += 10;
                   else if( $offer_count >= 6 && $offer_count < 12 )     
                        $puan += 15;
                   else if( $offer_count >= 12 )     
                        $puan += 20;
                   
                   // Aldığı yorumlar  // 1-2 +5    3-5 +10     6-11  +15    12> +25
                   if( $rating_count >= 1 && $rating_count < 3 )
                        $puan += 5;
                   else if( $rating_count >= 3 && $rating_count < 6 )     
                        $puan += 10;
                   else if( $rating_count >= 6 && $rating_count < 12 )     
                        $puan += 15;
                   else if( $rating_count >= 12 )     
                        $puan += 25;
                     
                   // Üyelik süresi      // 1-2 +5    3-5 +10     6-11  +15    12> +20
                   // sunucuda zaman geri olduğu için
                   date_default_timezone_set('Europe/Istanbul');
        
                   $now  = strtotime(date("Y-m-d H:i:s"));
                   $date = strtotime( $since);
                   $diff = $now - $date; 
                   $mounth =  number_format( ($diff/( 24*60*60 )) / 30, 0 , "","");
                   
                    if( $mounth >= 1 && $mounth < 3 )
                         $puan += 5;
                    else if( $mounth >= 3 && $mounth < 6 )     
                         $puan += 10;
                    else if( $mounth >= 6 && $mounth < 12 )     
                         $puan += 15;
                    else if( $mounth >= 12 )     
                         $puan += 20;
                    
                    // Doğrulama kontrolleri    // face +3    tel  +4     email   +3    
                    $where = array();
                    if( $face_check  != 0 )
                        $puan += 3; 
                    else
                       $where['face'] = 0;

                    if( $tel_check   != 0 )
                        $puan += 4; 
                    else
                        $where['phone'] = 0;

                    if( $email_check != 0 )
                        $puan += 3; 
                    else
                        $where['email'] = 0;
                    
                    

                    // Tercihler ile ilgili işlmler  // chat +2    music +2     pet +2   smoke +2
                    $flag = TRUE;
                    if( $like_chat  != 1 )
                           $puan += 2;
                    else
                        $flag = FALSE;

                    if( $like_pet   != 1 )
                           $puan += 2; 
                    else
                        $flag = FALSE;

                    if( $like_smoke != 1 )
                           $puan += 2; 
                    else
                        $flag = FALSE;

                    if( $like_music != 1 )
                           $puan += 2; 
                    else
                        $flag = FALSE;
                    
                    if( !$flag )  
                        $where['tercih'] = 0;
                    
                    $array =  explode("/", $result2['foto']);
                    $foto = $array[count($array)-1];
                    if( strcmp($foto,  'male.png') == 0 ||  strcmp($foto,  'female.png') == 0 ) 
                         $where['photo'] = 0;
                    if(  strcmp($result2['description'], "") == 0 )
                         $where['bio'] = 0;
 
                    $level = 1;
                    if( $puan >= 35 && $puan < 50 )
                         $level = 2;
                    else if( $puan >= 50 && $puan < 60 )     
                         $level = 3;
                    else if( $puan >= 60 && $puan < 75 )     
                         $level = 4;
                    else if( $puan >= 75 )     
                         $level = 5;
                    
					// USER RESPONSE RATE SET 
					// gelen mesajları getir
				         $query1 =$this->db -> select ('ride_offer_id, user_id, received_user_id, is_answer')
				                            -> where("received_user_id" , $user_id)
				                            -> where("is_answer" , 0)
				                            -> group_by('ride_offer_id')
				                            -> group_by('user_id')
				                            -> get('messages');                       
				        
				         // gonderilen mesajlara cevapları getir
				         $query2 =$this->db -> select ('ride_offer_id, user_id, received_user_id, is_answer')
				                            -> where("received_user_id" , $user_id)
				                            -> where("is_answer" , 1)
				                            -> group_by('ride_offer_id')
				                            -> group_by('user_id')
				                            -> get('messages');      
				
				          if($query1 && $query2 ){
				              $gelen      =  $query1->result_array(); // gelen
				              $gonderilen =  $query2->result_array(); // gönderilen
				              $verilen    = 0;
				              $verilmeyen = 0;
				              
				              if( count( $gonderilen) > 0 && count($gelen) > 0 ){
				                   foreach ($gelen as $got) {
				                      $flag_nooffer = FALSE;
				                      foreach ($gonderilen as $send) {
				                          $flag = FALSE;
				                          if( $send['ride_offer_id'] == $got['ride_offer_id'] && $send['user_id'] == $got['user_id']  ){
				                               if( $send['received_user_id']  ==  $got['received_user_id'] ){
				                                   $verilen +=  1;
				                                   $flag = TRUE;
				                                   $flag_nooffer = FALSE;
				                                   break;
				                               }
				                               if( !$flag )
				                                   $verilmeyen += 1;
				                          }
				                          else{
				                              $flag_nooffer = TRUE;
				                          }     
				                      }
				                       if( $flag_nooffer )
				                             $verilmeyen += 1;
				                   }
				                   $divide  = $verilen;                                         // verilen cevap sayısı   
				                   $diveder = $verilen + $verilmeyen;                           // toplam mesajlaşma sayısı
				                   
				              }else if( count( $gonderilen) == 0  && count( $gelen) > 0 ){
				                   $verilmeyen = count( $gelen);                               // gonderilen mesaj yok gelen var  
				                   $divide  = 0;                                               // etkisiz bir bölünme  
				                   $diveder = $verilen  + $verilmeyen;                         // toplam mesajlaşma sayısı
				              }
				              else if( count( $gonderilen) > 0  && count( $gelen) == 0 ){      // gonderilen var gelen yok
				                   $divide  = 1;                                               // etkisiz bir bölünme  
				                   $diveder = 1;                                               // etkisiz bölünme
				              }     
				              else {                                                           // ne gelen mesaj nede cevap verilen mesaj ikiside yok
				                   $divide  = 1;                                               // etkisiz bir bölünme  
				                   $diveder = 1;                                               // etkisiz bir bölünme
				              }          
				              $value = ( $divide / $diveder )  * 100;
				              if( $value >= 100 )
				                  $value = 100;
				              $response_rate =  number_format( $value , 2, ",","");            // NUMBER OF RESPONSE RATE VALUE
				          }
                          else
							 $response_rate = 90; 
	  
					
                    $query  = $this->db -> select('*')
                                        -> from('user_level')
                                        -> where('level', $level)
                                        -> get();
                    $query2 =  $this->db -> where('user_id', $user_id)
                                         -> update('alerts', $where); 
                    if( $query ){
                        $result = $query->row_array();
                        if( $result ){
                              $level_id = $result['level_id'];
                              $user = array( 'level_id' => $level_id , 'level_percent' => $puan, 'response_rate'=> $response_rate    ); 
                              $this->db -> where('id', $user_id)
                                        -> update('users', $user);      
                        }
                    }
              }
          }
    }                               

     /**
     *  Getuser all information from users-preferences with userid 
     *  @parameter userid
     *  RETURN row or FALSE
    **/
    function GetUserAllInfo($userid){
          $this->db -> select('*, users.id as id, users.created_at')
                    -> from('users')
                    -> join('preferences', 'users.id = preferences.user_id')
                    -> join('user_level',  'users.level_id = user_level.level_id')
                    -> where('users.active', 1)
                    -> where('users.id', $userid);
          
          $query = $this->db->get();
          if($query)
               return  $query->row_array();
          else
               return false;
    }

    /**
     *  Getuser with userid 
     *  @parameter userid
     *  RETURN row or FALSE
    **/
    function GetUser($userid){
          $user = array('id' => $userid, 'active' => 1 );  
          $query = $this->db->get_where('users', $user, 1 );
          if($query)
               return  $query->row_array();
          else
               return false;
    }
   
    /**
     *  Getuser    with email adress 
     *  @parameter email
     *  RETURN row or FALSE
    **/
   function GetUserWithEmail($email){
          $user = array('email' => $email, 'active' => 1 );  
          $query = $this->db->get_where('users', $user );
          if($query)
               return  $query->row_array(); // Row array for one result
          else
               return false;
    }
    
    /**
     *  Getuser  with where parameters 
     *  @parameter where
     *  RETURN rows or FALSE
    **/
   function GetUserWithWhere($where){
          $query = $this->db->where( $where )
                            ->order_by("birthyear", "desc") 
                            ->limit(9)
                            ->get('users'); 
          if($query)
               return  $query->result_array(); // Row array for one result
          else
               return false;
    }
    

    /**
     *  Getuser  with where parameters 
     *  @parameter where
     *  RETURN rows or FALSE
    **/
   function GetUserWithLimit($where, $start, $row_count ){
          $query = $this->db->where( $where )
                            ->order_by("birthyear", "desc")
                            ->limit( $row_count, $start)
                            ->get('users'); 
          if($query)
               return  $query->result_array(); // Row array for one result
          else
               return false;
    }

    /**
     *  Delete user function  
     *  @parameter userid , description
     *  RETURN TRUE or FALSE
    **/
    function delete($user_id, $description){
        $this->db->trans_begin();
        $result = TRUE;
	      $description['created_at'] = date('Y-m-d H:i:s');
	   
        $query = $this->db->insert('delete_acount', $description);        // insert reason for deleting accounts
        
        $notification = array(  'updates' => 0,
                                'after_ride' => 0 ,
                                'new_message' => 0 ,
                                'receive_rate' => 0 );

        $query2 = $this->db -> where('user_id', $user_id)
                            -> update('notifications', $notification); 

        ///$query3 = $this->db -> where('given_userid  =', $user_id)
        ///                    -> or_where('received_userid =', $user_id) 
        ///                    -> delete('ratings');  
        ///$query4 = $this->db -> where('user_id  =', $user_id)
        ///                    -> or_where('received_user_id =', $user_id) 
        ///                    -> delete('messages');                      
        // && $query2 && $query3  && $query4

        if( $query && $query2 ){
               $this->db->where('user_id', $user_id);                     // set user offers not-active
               $offer = array( 'is_active' => 0 );
               $query2 = $this->db->update('ride_offers', $offer);        // update information
               if($query2){
                           $this->db->where('id', $user_id);
                           $user = array( 'active' => 0 );                // set user not-active  
                           $query3 = $this->db->update('users', $user);   // update information
                           if($query3){
                                 if($this->db->affected_rows() >= 0)
                                     $result =  TRUE; 
                                 else
                                     $result =  FALSE;
                           }        
                           else
                               $result = false;        
               }      
               else
                  $result = false;
        }
        else
           $result = false;

        if ($this->db->trans_status() == FALSE || $result == FALSE){   
             $this->db->trans_rollback();                                 // there is some problem rollback
             return FALSE;
        }
        else{
            $this->db->trans_commit();                                     // everything is ok commit actions  
            return TRUE;
        } 
    } 
      
    /**
     *  Get user warnings 
     *
     *  @param  $user_id 
     *  @return rows or FALSE
    **/      
    function GetUserWarnings( $user_id ){

            $query = $this->db -> where('user_id',$user_id )
                               -> where('is_read', 0 )
                               -> get('warnings');
            if( $query )
                  return $query->result_array();
            else
                  return FALSE;                           

    }
      

    /**
     *  Get genral information  total offer count, total member count and count of valid offer
     *  RETURN array or FALSE
    **/    
     function getGeneralCount(){

           $date = date('Y-m-d H:i:s');    // current date

           $where = "is_active = 1  AND ( CONCAT(departure_date,' ',departure_time) >='{$date}' OR CONCAT(return_date,' ', return_time)  >='{$date}' )";
           $query = $this->db -> select( 'COUNT(id) as count' )
                              -> where($where)
                              -> get( "ride_offers" );
           $query2 = $this->db -> select( 'COUNT(id) as count' )
                               -> get( "ride_offers" );
           $query3 = $this->db -> select( 'COUNT(id) as count' )
                               -> get( "users" );
                              
           if($query && $query2 && $query3 ){
               $offer_count_updated = $query->row_array();
               $offer_count = $query2->row_array();
               $member_count = $query3->row_array();
                

               return array('offer_count' => $offer_count['count'], 
                            'member_count' =>   $member_count['count'], 
                            'offer_count_updated' =>  $offer_count_updated['count'] );
           } 
           else{
               return array('offer_count' => 0, 'member_count' => 0, 'offer_count_updated' => 0 );
           }
     }


}// END of the Users Class

/**
 *
 * End of the file users.php
 *
 **/