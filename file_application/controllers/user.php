<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * DEVELOPER İsmail AKBUDAK 
 * Offer Controller
 *
 * @package     CodeIgniter
 * @category    Controller
 * @author      İsmail AKBUDAK
 * @link        http://ismailakbudak.com
 * 
 */


class User extends CI_Controller {

    /**
     * Global variable
     **/
     public $userid, $data;
     
    /**
     * Constructor   
    **/
    public function __construct(){
          parent::__construct();
		      $this->load->model('users');  // load users model for database action   
    }

    /**
     *  Kullanıcının profilini görüntüle
     *  
     *  @param  şifreli kullanıcı id
     *  @return HTML view
     *
     **/
    public function show($user_id){
            if( ! isset( $user_id ) )
                   show_404(); 
            $this->lang->load('user');                                                              // load user language file
            $userid    = my_decode($user_id);
            $this->load->model('offersdb');
            $this->load->model('ratings_db');                                                       // load ratings_db model for database action  
            $this->load->model('cars');                                                             // load ratings_db model for database action  
            $user                   = $this->users->GetUserAllInfo( $userid );                      // get user      
            $offers_count           = $this->offersdb->GetUserOfferCount( $userid ); 
            $cars                   = $this->cars->GetUserCars( $userid ); 
            $ratings             = $this->ratings_db->GetUserRatingsWithUser( $userid );
            $groupedRatings      = $this->ratings_db->GetGroupedRatings( $userid );
            $avg                 = $this->ratings_db->GetUserAverageRatings( $userid );
            $ratings             = $this->checkFoto($ratings);
                
            if( is_array( $user ) && count($user) > 0 && is_array($offers_count) &&  is_array($cars)  ){ 
                   $user['total']          = $this->ratings_db->totalRating( $userid  );           // send total value to view
                   $user['avg']            = $avg;                                                 // send avg value to view
                   $user['foto']           = photoCheckUser($user); 
                   $user['offer_count']    = $offers_count['offers_count']; 
                    foreach ($cars as &$value) 
                        $value['foto_name'] = photoCheckCar($value);                               // not-exist car image use default 
                   $user['cars']           = $cars; 
                  
                   $data['ratings']             = $ratings; 
                   $data['avg']                 = $avg; 
                   $data['groupedRatings']      = $groupedRatings; 
                   $data['user']                = $user;
                   $this->login->general($data);               // call general load view
                   $this->load->view('user/publicProfile');    // load view  
                   $this->load->view('include/footer');        // load view 
                   
            }
            else
                 show_404('hata');

    }
       

   /**
     *     Kullanıcı fotoğraflarını kontrol eden metot
     *      
     *     @param $array kullanıcı listesi 
     *     @return $array fotoğrafı kontrol edilmiş kullanıcı listesi
     *
     **/    
    private function checkFoto($array){
         if( is_array( $array)  ){
             foreach ($array as &$value) 
                  $value['foto']   =  photoCheckUser($value);
              return $array;
         } 
         else
              return array();
    }

    
     /**
      *   AJAX function
      *   Kullanıcıları ismine göre getirip liste olarak döndüren metot 
      *  
      *   @return JSON user list 
      *
      **/
    public function getUserWithName(){
            $this->lang->load('user');                                                                         // load user language file
            $this->form->check( lang('uc.name'), 'name', 'required|xss_clean');                                // check post data
            if( $this->form->get_result() ){                    
                      $name   = $this->input->post('name',TRUE);                                               // get post data
                      $user_id =  $this->encrypt->decode( $this->session->userdata( 'userid') );               // set global variable user_id
                      $where = "CONCAT(`name`,' ',`surname`) LIKE '$name%' AND id != $user_id AND active = 1"; // where criterion
                      $result = $this->users->GetUserWithWhere($where);                                        // get all user match the where criterion 
                      if( is_array($result)  ){
                            if( count($result) > 0 ){
                              $date = date('Y'); 
                              foreach ($result as &$user){ 
                                   $user['id']    = urlencode(base64_encode($user['id']));  // encrypt all user id
                                   $user['foto']  = photoCheckUser( $user );                // check user foto is exist  
                                   $user['where'] = "name";  
                                   $user['start'] = "9";
                                   $age =  $date - $user['birthyear'] . lang("age");
                                   $alt = $user['name'] ." ". $user['surname'] ."(". $age  .")" ;
                                   $user['age']   = $age;
                                   $user['alt']   = $alt;
                              }     
                              $userlist = $result;                                       // send all user to view        
                              $status = "success";
                            }
                            else{
                              $text = alertWide ('danger', "", lang("uc.no-user") );
                              $status = "mistake";
                            }
                      }
                      else{
                          $status = "fail";
                          $text = lang("uc.fail-get");
                      }
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                    //  if there is error get it from Form validation class
            $result = array(  'status'    => $status,                             // JSON output     
                              'message'   => $error['message'],
                              'user_list' => isset($userlist) ? $userlist : array(),
                              'text'      => isset($text)  ? $text : ""  );    
            echo json_encode($result);                                          // JSON output     
    } 

     /**
      *   AJAX function
      *   Kullanıcıları telefon numarasına göre getirip liste olarak döndüren metot 
      *  
      *   @return JSON user list 
      *
      **/
    public function getUserWithTel(){
            $this->lang->load('user');                                                                        // load user language file
            $this->form->check( lang('uc.tel-no'), 'tel', 'required|regex_match[/^([0-9 ])+$/i]|xss_clean');  // check post data
            if( $this->form->get_result() ){            
                      $tel   = $this->input->post('tel',TRUE);                                                // get post data
                      $user_id =  $this->encrypt->decode( $this->session->userdata( 'userid') );              // set global variable user_id
                      $where = array('tel_no =' => $tel,
                                     'active =' => 1,   
                                     'id !='    => $user_id );                                                // where criterion
                      $result = $this->users->GetUserWithWhere($where);                                       // get all user match the where criterion 
                      if( is_array($result)  ){
                            if( count($result) > 0 ){
                              $date = date('Y'); 
                              foreach ($result as &$user){ 
                                   $user['id']   = urlencode(base64_encode($user['id']));  // encrypt all user id
                                   $user['foto'] = photoCheckUser( $user );                // check user foto is exist  
                                   $user['where'] = "tel";
                                   $user['start'] = "10";
                                   $age =  $date - $user['birthyear'] . lang("age");
                                   $alt = $user['name'] ." ". $user['surname'] ."(". $age  .")" ;
                                   $user['age']   = $age;
                                   $user['alt']   = $alt;
                                   
                              }     
                              $userlist = $result;                                       // send all user to view        
                              $status = "success";
                            }
                            else{
                              $text = alertWide ('danger', "", lang("uc.no-user") );
                              $status = "mistake";
                            }
                      }
                      else{
                          $status = "fail";
                          $text = lang("uc.fail-get");
                      }
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                    //  if there is error get it from Form validation class
            $result = array(  'status'    => $status,                             // JSON output     
                              'message'   => $error['message'],
                              'user_list' => isset($userlist) ? $userlist : array(),
                              'text'      => isset($text)  ? $text : ""  );    
            echo json_encode($result);                                            // JSON output     
    } 
    
     /**
      *   AJAX function
      *   Kullanıcının email adresini onaylama işlemi
      *  
      *   @return HTML view 
      *
      **/
    public function verify(){
            $this->lang->load('user');   
            $email = $this->security->xss_clean( $this->input->get('onay') );  
            if( isset($email) ){
                 $email = my_decode( $email );
                 $this->load->model('users');                            // load users model
                 $result = $this->users->GetUserWithEmail( $email );     // check email adress is using or not
                 if( is_array($result) && count($result) > 0 ){
                               $userid = $result['id']; 
                               $user = array( 'email_check' => "1"  );                               // new user info
                               $result = $this->users->update($userid,$user);                        // update user info
                               if( $result == TRUE ) {
                                       redirect("user/show/" . my_encode( $userid ) );
                               }
                               else{
                                    $this->login->general();                    // call general load view
                                    $this->load->view('user/error');            // load view  
                                    $this->load->view('include/footer');        // load view 
                               } 

                 }else{
                   show_404('hata');
                 } 
            }else{
               show_404('hata');
            }
    } 
    
    /**
     *   
     *   Kullanıcının şifresini yeniden oluşturması  
     *  
     *   @return HTML view
     *
     **/
    public function password(){
            $this->lang->load('user');   
            $email = $this->security->xss_clean( $this->input->get('new') );  
            if( isset($email) ){
                 $new   = $email;
                 $email = my_decode( $email );
                 $this->load->model('users');                            // load users model
                 $result = $this->users->GetUserWithEmail( $email );     // check email adress is using or not
                 if( is_array($result) && count($result) > 0 ){
                              $this->lang->load('email_controller');                         // email language
                              $data =  $this->login->generalTemplate();
                              $data['new'] = my_encode( $result['id'] );
                              $this->load->view('include/headerTemplate',$data );            // load view
                              $this->load->view('signup/new_password');                      // load view
                              $this->load->view('include/footer');                           // load view 
                 }else{
                   show_404('hata');
                 } 
            }else{
               show_404('hata');
            }
    }

    /**
     *   AJAX function
     *   Kullanıcının şifresini yeniden oluşturması işlemi
     *  
     *   @return JSON user list 
     *
     **/    
    public function new_password(){
                $this->lang->load('user');   
                $this->form->check( lang("u.new_data"), 'new_data',       'required|xss_clean');                     // control post parameter
                $this->form->check( lang("u.newPassword"), 'newPassword',    'required|min_length[6]|max_length[20]|alpha_numeric|xss_clean');   // control post parameter
                if( $this->form->get_result() ){                                                                    // everything is ok
                          $userid       = my_decode( $this->input->post('new_data'  , TRUE) );                      // decode userid
                          $newPassword  = $this->input->post('newPassword'  , TRUE);                                // user oldpassword post  
                          
                          $result = $this->users->GetUser($userid);                                                 // get user information 
                          if( is_array( $result ) && count( $result ) > 0 ){
                                if( $result['is_face_acount'] == 0 ){  
                                         $user = array( 'password' => md5(  $newPassword  ) );                      // new user model 
                                         $result = $this->users->update($userid,$user);                             // update user information
                                         if($result == TRUE)  {           
                                              $status = 'success';
                                              $text = lang('u.password_success');
                                         }
                                         else
                                              $status = 'fail';

                                            
                                }
                                else{
                                     $status = 'fail';  
                                }
                          }
                          else
                              $status = 'fail';
                } 
                else
                     $status = "error";
                $error = $this->form->get_error();                        //  if there is error get it from Form validation class
                $result = array(  'status'  => $status,                   // JSON output    
                                  'text'    => isset($text) ? $text : lang('fail'),  
                                  'message' => $error['message'] );            
                echo json_encode($result);                                // JSON output 
    }

    /***
     |   not completed
     |   Get User list from start point
     |   @param  $id
     |   @return view
     |  
     ****/
     public function getUsers($start){
         
           // $user_id =  $this->encrypt->decode( $this->session->userdata( 'userid') ); // set global variable user_id
           // $where = "CONCAT(`name`,' ',`surname`) LIKE 'a%' AND id != $user_id";            // where criterion
           // $users = $this->users->GetUserWithLimit($where, 3, 3 ); //  $start, $row_count 
           // foreach ($users as $value) {
           //    echo $value['id'] . "<br>";
           // }
           //exit;
            $this->lang->load('user');                                                                             // load user language file
            $this->form->check( lang('uc.name'), 'name', 'required|xss_clean');                                    // check post data
            if( $this->form->get_result() ){            
                      if( isset($start) && $start != 0 && is_numeric($start) ){
                              $name   = $this->input->post('name',TRUE);                                           // get post data
                              $user_id =  $this->encrypt->decode( $this->session->userdata( 'userid') );           // set global variable user_id
                              $where = "CONCAT(`name`,' ',`surname`) LIKE '$name%' AND id != $user_id";            // where criterion

                              $row_count =  9;                                                                     // show first 4 offers ascending by departure  
                              $users = $this->users->GetUserWithLimit($where, $start, $row_count );                // get users up-date offers   $user_id, $numrows, $start                                      
                              $start    =   $start + $row_count;                        
                              if( is_array($users) ){
                                   $date = date('Y');
                                   if(  count( $users ) == $row_count ){
                                               foreach ($users as &$user){ 
                                                    $user['id']    = urlencode(base64_encode($user['id']));  // encrypt all user id
                                                    $user['foto']  = photoCheckUser( $user );                // check user foto is exist  
                                                    $user['where'] = "name";  
                                                    $user['start'] = $start;
                                                    $age =  $date - $user['birthyear'] . lang("age");
                                                    $alt = $user['name'] ." ". $user['surname'] ."(". $age  .")" ;
                                                    $user['age']   = $age;
                                                    $user['alt']   = $alt;
                                               }     
                                               $userlist = $users;                                           // send all user to view        
                                               $status = "success";
                                   }
                                   else{
                                              foreach ($users as &$user){ 
                                                    $user['id']    = urlencode(base64_encode($user['id']));  // encrypt all user id
                                                    $user['foto']  = photoCheckUser( $user );                // check user foto is exist  
                                                    $user['where'] = "name";  
                                                    $user['start'] = "0";
                                                    $age =  $date - $user['birthyear'] . lang("age");
                                                    $alt = $user['name'] ." ". $user['surname'] ."(". $age  .")" ;
                                                    $user['age']   = $age;
                                                    $user['alt']   = $alt;
                                               }     
                                               $userlist = $users;                                       // send all user to view        
                                               $status = "success";
                                   }
                              }
                              else
                                   $status = "fail";
                              
                      }
                      else 
                         $status = "fail";
            }
            else 
                $status = "error";
            $error = $this->form->get_error();                                    //  if there is error get it from Form validation class
            $result = array(  'status'    => $status,                             // JSON output     
                              'message'   => $error['message'],
                              'user_list' => isset($userlist) ? $userlist : array(),
                              'text'      => isset($text)  ? $text : ""  );    
            echo json_encode($result);                                          // JSON output   
     }
 

} // END of the User Class
/**
 * End of the file User.php
 **/