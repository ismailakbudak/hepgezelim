<?php

/**
 * DEVELOPER İsmail AKBUDAK 
 * Messages Model
 *
 * @package     CodeIgniter
 * @category    Model
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 *  $message = array( 
 *            'ride_offer_id'     => "", 
 *            'user_id'           => "",
 *            'received_user_id'  => "",
 *            'message'           => "",
 *            'archived'          => "",
 *         );
 * 
 */

class Messages extends CI_Model {

    /**
     * Constructor  
    **/
    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    /**
     *  Add new message model
     *  @parameter  message
     *  RETURN TRUE or FALSE
    **/    
    function Add( $message ) {
    	// sunucuda zaman geri olduğu için
    	 $message['created_at'] = date('Y-m-d H:i:s');
		   
        $query = $this->db->insert('messages', $message);
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
     *  Update message for sender user 
     *  @parameter | offer_id , sender_user_id , message
     *  @RETURN    | rows or FALSE
    **/
    function update( $where, $message ){
           $query = $this->db-> where( $where )
                             -> update('messages', $message); 
           if($query)
                return ($this->db->affected_rows() >= 0) ? TRUE : FALSE; // if there is error returns -1
           else
                return false;

    }   
    
    /**
     *  Get user response rate 
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/
    function GetUserResponseRate( $user_id ){
         
        /*
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
             
		 */
		   
		  /*
              echo "gonderilen <br>";
              foreach ($gonderilen as $value) {
                  print_r($value);
                  echo "<br>";
              }
              echo "<br>";
              echo "gelen <br>";
              foreach ($gelen as $value) {
                  print_r($value);
                  echo "<br>";
              }
              */
              /*
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
              $value =  number_format( $value , 2, ",","");
			   
              return $value;     
            
          }
          else
              return FALSE;
			   */
			    return -1;				
    }

    /**
     *  Get unread messages
     *  @parameter  receiver_userid
     *  RETURN rows or FALSE
    **/
    function GetUnreadMessages( $received_user_id ){
          $message =  array('received_user_id' => $received_user_id, 
                            'readed_receive'   => 0, 
                            'receive_archived' => 0,
                            'receive_visible'  => 1  ); 
          
          $message2 = array( 'user_id'          => $received_user_id, 
                             'readed_sender'    => 0, 
                             'sender_archived'  => 0,
                             'is_answer'        => 1,   
                             'send_visible'     => 1  ); 

         //$query  = $this->db->get_where('messages', $message );

         $query  = $this->db -> select('COUNT("id") as number')                              
                             -> from('messages')
                             -> join('users', 'users.id = messages.user_id')
                             -> where($message )
                             -> where('ride_offer_id >', 0 )
							 -> where('user_id >', 0 )
							 -> where('received_user_id >', 0 ) 
                             -> get();
         $query2 = $this->db -> select('COUNT("id") as number')                              
                             -> from('messages')
                             -> join('users', 'users.id = messages.received_user_id')
                             -> where($message2 )
                             -> where('ride_offer_id >', 0 )
							 -> where('user_id >', 0 )
							 -> where('received_user_id >', 0 ) 
                             -> get();
                                                    
         //$query2 = $this->db->get_where('messages', $message2 );
  
         if($query && $query2){
             $result  =  $query->row_array();
             $result2 =  $query2->row_array();
             $result  =  $result['number'] + $result2['number'];
             return $result;
          }
          else
            return 0;
    }
    

    /**
     *  Get user's sent messages
     *  @parameter  user_id
     *  RETURN row or FALSE
    **/        
    function unreadInbox($received_user_id){
          $message =  array('received_user_id' => $received_user_id, 
                            'readed_receive'   => 0, 
                            'receive_archived' => 0,   
                            'receive_visible'  => 1  ); 

          $query  = $this->db -> select('COUNT("id") as number')                              
                              -> from('messages')
                              -> join('users', 'users.id = messages.user_id')
                              -> where($message )
                              -> where('ride_offer_id >', 0 )
							  -> where('user_id >', 0 )
							  -> where('received_user_id >', 0 ) 
                              -> get();
          if($query ){
               $result  =  $query->row_array();
               return $result;
          }
          else
               return FALSE;
  
    }
    
    /**
     *  Get user's sent messages
     *  @parameter  user_id
     *  RETURN row or FALSE
    **/        
    function unreadSent($sender_user_id){
          $message = array(    'user_id'          => $sender_user_id, 
                               'readed_sender'    => 0, 
                               'sender_archived'  => 0,
                               'is_answer'        => 1,   
                               'send_visible'     => 1  ); 
          $query  = $this->db -> select('COUNT("id") as number')                              
                              -> from('messages')
                              -> join('users', 'users.id = messages.received_user_id')
                              -> where($message )
                              -> where('ride_offer_id >', 0 )
							  -> where('user_id >', 0 )
							  -> where('received_user_id >', 0 ) 
                              -> get();
          if($query){
             $result =  $query->row_array();
             return $result;
          }
          else
             return FALSE;
    }


      /**
     *  Get user's sent messages
     *  @parameter  user_id
     *  RETURN row or FALSE
    **/        
    function unreadInboxContent($received_user_id){
          $message =  array('received_user_id' => $received_user_id, 
                            'readed_receive'   => 0, 
                            'receive_archived' => 0,   
                            'receive_visible'  => 1  ); 

          $query  = $this->db -> select('*')                              
                              -> from('messages')
                              -> join('users', 'users.id = messages.user_id')
                              -> where($message )
                              -> where('ride_offer_id >', 0 )
							  -> where('user_id >', 0 )
							  -> where('received_user_id >', 0 ) 
                              -> get();
          if($query ){
               $result  =  $query->result_array();
               return $result;
          }
          else
               return FALSE;
  
    }
    
    /**
     *  Get user's sent messages
     *  @parameter  user_id
     *  RETURN row or FALSE
    **/        
    function unreadSentContent($sender_user_id){
          $message = array(    'user_id'          => $sender_user_id, 
                               'readed_sender'    => 0, 
                               'sender_archived'  => 0,
                               'is_answer'        => 1,   
                               'send_visible'     => 1  ); 
          $query  = $this->db -> select('*')                              
                              -> from('messages')
                              -> join('users', 'users.id = messages.received_user_id')
                              -> where($message )
                              -> where('ride_offer_id >', 0 )
							  -> where('user_id >', 0 )
							  -> where('received_user_id >', 0 ) 
                              -> get();
          if($query){
             $result =  $query->result_array();
             return $result;
          }
          else
             return FALSE;
    }

    /**
     *  Get user's sent messages
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/    
    function getSent( $sender_user_id ){
           $query = $this->db -> select('*, COUNT("id") as number, messages.created_at,  messages.ride_offer_id, users.id as received_userid '  )
                              -> from('messages')
                              -> join('ride_offers', 'ride_offers.id = messages.ride_offer_id')
                              -> join('users', 'users.id = messages.received_user_id')
                              -> where('messages.user_id', $sender_user_id)
                              -> where('send_visible', "1")
                              -> where('sender_archived', "0") 
                              -> group_by('messages.ride_offer_id')
                              -> group_by('messages.user_id')
                              -> group_by('messages.readed_sender')
                              -> get();   
            if( $query )
                  return  $query->result_array();
            else
                  return FALSE;
    } 

    /**
     *  Get user's inbox messages
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/         
    function getInbox( $received_user_id ){
           $query = $this->db -> select('*, COUNT("id") as number, messages.created_at, messages.ride_offer_id, users.id as sender_userid '  )
                              -> from('messages')
                              -> join('ride_offers', 'ride_offers.id = messages.ride_offer_id')
                              -> join('users', 'users.id = messages.user_id')
                              -> where('messages.received_user_id', $received_user_id)
                              -> where('receive_visible', "1")
                              -> where('receive_archived', "0")
                              -> group_by('messages.ride_offer_id')
                              -> group_by('messages.user_id')
                              -> group_by('messages.readed_receive')
                              -> get();   
            if( $query )
                 return  $query->result_array();
            else
                 return FALSE;
    }

    /**
     *  Get user's inbox archived messages
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/         
    function getArchivedInbox( $user_id ){
            $received_user_id = $user_id; 
            $query = $this->db -> select('*, COUNT("id") as number, messages.created_at, messages.ride_offer_id, users.id as sender_userid '  )
                              -> from('messages')
                              -> join('ride_offers', 'ride_offers.id = messages.ride_offer_id')
                              -> join('users', 'users.id = messages.user_id')
                              -> where('messages.received_user_id', $received_user_id)
                              -> where('receive_visible', "1")
                              -> where('receive_archived', "1")
                              -> group_by('messages.ride_offer_id')
                              -> group_by('messages.user_id')
                              -> get();   
            if( $query )
                 return  $query->result_array();
            else
                 return FALSE;
    }
     
    /**
     *  Get user's sent archived messages
     *  @parameter  user_id
     *  RETURN rows or FALSE
    **/         
    function getArchivedSend( $sender_user_id ){
            $query = $this->db -> select('*, COUNT("id") as number, messages.created_at,  messages.ride_offer_id, users.id as received_userid '  )
                              -> from('messages')
                              -> join('ride_offers', 'ride_offers.id = messages.ride_offer_id')
                              -> join('users', 'users.id = messages.received_user_id')
                              -> where('messages.user_id', $sender_user_id)
                              -> where('send_visible', "1")
                              -> where('sender_archived', "1")
                              -> group_by('messages.ride_offer_id')
                              -> group_by('messages.user_id')
                              -> get();   
            if( $query )
                  return  $query->result_array();
            else
                  return FALSE;
    } 

     
    /*****
     |  Get user's conversation
     |  @parameter  user_id
     |  RETURN rows or FALSE
     |
    *****/         
    function getConversationInbox( $offer_id, $sender_id, $received_userid ){
           $query = $this->db -> from('messages')
                              -> where('messages.received_user_id', $received_userid)
                              -> where('messages.user_id',          $sender_id)
                              -> where('messages.ride_offer_id',    $offer_id)
                              -> where('receive_visible', "1")
                              -> where('receive_archived', "0")
                              -> order_by("created_at", "asc") 
                              -> get();   
            if( $query )
                 return  $query->result_array();
            else
                 return FALSE;
    } 
    
    /*****
     |  Get user's conversation that is archived
     |  @parameter  user_id
     |  RETURN rows or FALSE
     |
    *****/         
    function getConversationInboxArchive( $offer_id, $sender_id, $received_userid ){
           $query = $this->db -> from('messages')
                              -> where('messages.received_user_id', $received_userid)
                              -> where('messages.user_id',          $sender_id)
                              -> where('messages.ride_offer_id',    $offer_id)
                              -> where('receive_visible', "1")
                              -> where('receive_archived', "1")
                              -> order_by("created_at", "asc") 
                              -> get();   
            if( $query )
                 return  $query->result_array();
            else
                 return FALSE;
    } 
      
    /*****
     |  Get user's conversation
     |  @parameter  user_id
     |  RETURN rows or FALSE
     |
    *****/         
    function getConversationSent( $offer_id, $sender_id, $received_userid ){
           $query = $this->db -> from('messages')
                              -> where('messages.received_user_id', $received_userid)
                              -> where('messages.user_id',          $sender_id)
                              -> where('messages.ride_offer_id',    $offer_id)
                              -> where('send_visible', "1")
                              -> where('sender_archived', "0")
                              -> order_by("created_at", "asc") 
                              -> get();   
            if( $query )
                 return  $query->result_array();
            else
                 return FALSE;
    } 
    

    /*****
     |  Get user's conversation
     |  @parameter  user_id
     |  RETURN rows or FALSE
     |
    *****/         
    function getConversationSentArchive( $offer_id, $sender_id, $received_userid ){
            $query = $this->db -> from('messages')
                              -> where('messages.received_user_id', $received_userid)
                              -> where('messages.user_id',          $sender_id)
                              -> where('messages.ride_offer_id',    $offer_id)
                              -> where('send_visible', "1")
                              -> where('sender_archived', "1")
                              -> order_by("created_at", "asc") 
                              -> get();   
            if( $query )
                 return  $query->result_array();
            else
                 return FALSE;
      
    }
  


 }// END of the Messages Class

/**
 *
 * End of the file messages.php
 *
 **/