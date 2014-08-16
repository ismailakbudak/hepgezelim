<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
          /**
           *    Html view de yer alan veriyi şifrele
           *   
           *   @param    
           *   @return    
          **/                   
          function my_encode( $data ){
             return urlencode( base64_encode( $data ));
          }
               
          /**
           *   Html view de yer alan veriyi şifrele 
           *   
           *   @param    
           *   @return    
          **/ 
          function my_decode( $data ){
             return  base64_decode( urldecode( $data ));
          }
       
          /**
           *   
           *   
           *   @param    
           *   @return    
          **/ 
          function enToTr($day, $lang){
                           $days = array(  "Monday"   => "Pazartesi"  ,  
                                           "Tuesday"  => "Salı"       ,  
                                           "Wednesday"=> "Çarşamba"   ,  
                                           "Thursday" => "Perşembe"   ,  
                                           "Friday"   => "Cuma"       ,  
                                           "Saturday" => "Cumartesi"  ,  
                                           "Sunday"   => "Pazar"       
                                     );
                        if( strcmp($lang, "tr") == 0 ) 
                             return strtr($day, $days);
                        else      
                            return $day; 
          }    
 
          /**
           *   
           *   
           *   @param    
           *   @return    
          **/ 
          function urlCreate( $lang, $origin, $destination, $offer_id , $name = "flag", $tip="", $no = "", $woId = "" ){
               if( strcmp($name, "flag") == 0 ){
                    $name = ( strcmp($lang, "tr") == 0 ) ? 'detay-': 'detail-'; 
                    $name .=  temizle($origin) ."-". temizle($destination)."-" . $offer_id; 
               }else if( strcmp("flag2", $name) == 0 ) {
                    $name = ( strcmp($lang, "tr") == 0 ) ? 'seyahat-': 'travel-'; 
                    $name .=  temizle($origin) ."-". temizle($destination)."-". $offer_id."-".$tip."-".$no."-".$woId; 
               }
               return $name;
          }
       
          /**
           *   
           *   
           *   @param    
           *   @return    
          **/ 
          function temizle($tr1) {
               $turkce=array("ş","Ş","ı","ü","Ü","ö","Ö","ç","Ç","ğ","Ğ","İ", " ");
               $duzgun=array("s","s","i","u","u","o","o","c","c","g","g","i", "" );
               $tr1 = str_replace($turkce,$duzgun,$tr1);
               $tr1 = preg_replace("@[^a-z0-9\_]+@i","",$tr1);
               return strtolower($tr1);
          }
 
          /**
           *   
           *   
           *   @param    
           *   @return    
          **/ 
          function tr($date, $lang){
                      $aylarIng = array( "January" => "Ocak", 
                                         "February" =>"Şubat", 
                                         "March"=>"Mart", 
                                         "April"=>"Nisan", 
                                         "May"=>"Mayıs", 
                                         "June"=>"Haziran", 
                                         "July"=>"Temmuz", 
                                         "August"=>"Ağustos", 
                                         "September"=>"Eylül", 
                                         "October"=>"Ekim", 
                                         "November"=>"Kasım", 
                                         "December"=>"Aralık",
                                         "Monday"=>"Pazartesi", 
                                         "Tuesday"=>"Salı", 
                                         "Wednesday"=>"Çarşamba", 
                                         "Thursday"=>"Perşembe", 
                                         "Friday"=>"Cuma", 
                                         "Saturday"=>"Cumartesi", 
                                         "Sunday"=>"Pazar",
                                         "nd"=>"",
                                         "th"=>"",
                                         "st"=>"",
                                         "rd"=>"" 
                                     );
                        //$aylarTr = array_flip( $aylarIng );
                        if( strcmp($lang, "tr") == 0 ) 
                             return strtr($date, $aylarIng);
                        else      
                            return $date; 
           }


          /*******
            | sidebar user  detail 
            | @parameter |  user
            | @return    |  html content
            |    
           ****/
          function getSideBar(  $user, $title ,$lang ){
              
              $username = $user['name'];
              $date = date('Y');
              $age =  $date - $user['birthyear'] . lang("sd.age");
              $alt = $username ." ". $user['surname'] ." ( ". $age  ." )" ;
              $path = $user['foto'];
              
              $val = link_tag( base_url('styles/side_bar.css') );
              $val .="<div class='row row-side '>
                           <div class='well trip-content'>
                                  <fieldset class='content-side'>
                                           <div class='row row-side driver-header'>
                                                    <h4 class='driver-h' >$title</h4>
                                           </div>
                                           <div class='row row-side'>
                                                   <div class='row row-side'>
                                                      <div class='col-xs-5 no-padding'>
                                                           <a href='". new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ."'> 
                                                                <img class='pic-img' alt='$alt' title='$alt' src='$path'  width='115' height='140' style='width:115px; height:140px;' >
                                                           </a>   
                                                      </div>
                                                      <div class='col-xs-7 no-padding'>
                                                            <div class='row row-side text-primary' style='font-size:25px; font-weight:bold'  >  $username </div>
                                                            <div class='row row-side'             style='font-size:15px'>  $age    </div>
                                                            <div class='row row-side prf-container '>";
                                                            
                                                                      $test = "rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc '&gt;  &lt;strong class='green'  &gt; TEST &lt;/strong&gt;  TEST &lt;/span&gt;\" data-trigger='hover' data-html='true'"; 
                                                                      $chat  = ($user['like_chat']  != "1") ? ( ($user['like_chat']  == "0" ) ? "no" : "yes") : "" ; 
                                                                      $smoke = ($user['like_pet']   != "1") ? ( ($user['like_pet']   == "0" ) ? "no" : "yes") : "" ;
                                                                      $pet   = ($user['like_smoke'] != "1") ? ( ($user['like_smoke'] == "0" ) ? "no" : "yes") : "" ;
                                                                      $music = ($user['like_music'] != "1") ? ( ($user['like_music'] == "0" ) ? "no" : "yes") : "" ; 
                                                                      if( strcmp("", $chat)  != 0 )
                                                                         $val .=  "<span  class='tip chat_$chat   ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$chat   ."'&gt;  ".lang("sd.chat-" .$chat )  ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                      if( strcmp("", $music) != 0 )
                                                                         $val .=  "<span  class='tip music_$music ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$music  ."'&gt;  ".lang("sd.music-" .$music ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                      if( strcmp("", $smoke) != 0 )
                                                                         $val .=  "<span  class='tip smoke_$smoke ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$smoke  ."'&gt;  ".lang("sd.smoke-" .$smoke ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                      if( strcmp("", $pet  ) != 0 )
                                                                         $val .=  "<span  class=' tip pet_$pet    ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$pet    ."'&gt;  ".lang("sd.pet-" .$pet )   ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";  
                                                              
                                              $val .=   " </div>
                                                      </div>
                                                  </div>
                                                  <div class='row row-side' style='padding-top:15px;' >";
                                                if( $user['total'] > 0  ){       
                                                      $val.= "<div style='float:left; font-weight:bold; font-size:16px; padding:5px '>  " . $user['total'] ." ". lang("rating") ." —</div> 
                                                             <span class='star-large star-". number_format($user['avg'], 1, '-', '.') ."' style='float:left' title='". number_format($user['avg'], 1, '.', '.')    ." / 5' ></span> 
                                                             <div style='float:left; font-weight:bold; font-size:16px; padding:5px '>  ". number_format($user['avg'], 1, '.', '.')  ." / 5 </div> ";
                                                }
                                       $val .="  </div>
                                           </div>";
                                                $verifications = array(); 
                                                 
                                                if( $user['email_check'] ){
                                                      $email = "<div class='row row-side verification'>
                                                                      <i class='col-xs-1 text-primary glyphicon ' style='width: 1em; font-weight:bold;' >@</i> 
                                                                      <div class='col-xs-8 text-verified text-success'> 
                                                                            ".  lang("sd.email")  ."
                                                                      </div>
                                                                      <i class='col-xs-2 validated'></i> 
                                                               </div>";
                                                       $verifications[] = $email;         
                                                }
                                                $phone = ""; 
                                                if( $user['tel_check'] ){               
                                                       $phone = "<div class='row row-side verification'>
                                                                        <i class='col-xs-2 text-primary  glyphicon glyphicon-phone '></i> 
                                                                        <div class='col-xs-8 text-verified text-success'> 
                                                                             ".  lang("sd.phone")  ."
                                                                        </div>
                                                                        <i class='col-xs-2 validated'></i> 
                                                                </div>";
                                                        $verifications[] = $phone;
                                                }
                                                $face = ""; 
                                                if( $user['face_check'] ){          
                                                      $face = "<div class='row row-side verification'>
                                                                        <i class='col-xs-2 text-primary  glyphicon icon-facebook ' style='height: 23px; width:1em; margin-top:5px'></i> 
                                                                        <div class='col-xs-8 text-verified text-success'> 
                                                                           ".   $user['friends'] ." ".  lang("sd.friends")   ." 
                                                                        </div>
                                                                        <i class='col-xs-2 validated'></i>   
                                                                </div>";
                                                      $verifications[] = $face;          
                                                 }                
                                                 if( count($verifications) > 0 ){
                                                      $result = "<div class='row row-side verified-title'>
                                                                   <div class='row row-side'>
                                                                        <h4 class='driver-h' > ". lang("sd.verification") ." </h4>
                                                                   </div>"; 
                                                                  foreach ($verifications as $value)
                                                                       $result .= $value;         
                                                       $result .="</div>";
                                                       $val .= $result;  
                                                 }
                                              

                                   $val .="<div class='row row-side verified-title'>
                                                  <div class='row row-side'>
                                                       <h4 class='driver-h' >". lang('sd.activity') ."</h4>  
                                                  </div>
                                                  <div class='row row-side'>
                                                       <a href='#' class='text-primary' >  </a>
                                                  </div> 
                                                
                                                  <div class='row row-side' style='margin-top:10px'>
                                                          <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-map-marker two ' ></i>   </div>
                                                          <div class='col-xs-10 no-padding'>".  $user['offer_count'] . lang('sd.offer') ."</div>
                                                  </div> 
                                                  <div class='row row-side' style='margin-top:10px'>
                                                          <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-share-alt two ' ></i>   </div>
                                                          <div class='col-xs-10 no-padding'>".  $user['response_rate']  ." % " . lang('sd.response')  ."</div>
                                                  </div> 
                                                
                                                  <div class='row row-side' style='margin-top:10px'>
                                                          <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-time two ' ></i>   </div>
                                                          <div class='col-xs-10 no-padding'>".  lang('sd.last-online') ." ".  dateConvert3( $user['seen_last'], $lang) ."</div>
                                                  </div> 
                                                  <div class='row row-side' style='margin-top:10px'>
                                                          <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-log-in two' ></i>  </div>
                                                          <div class='col-xs-10 no-padding'>".   sprintf( lang('sd.seen_times' ), $user['seen_times'] ) ."</div>
                                                  </div> 
                                                  <div class='row row-side' style='margin-top:10px'>
                                                          <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-calendar two' ></i>  </div>
                                                          <div class='col-xs-10 no-padding'>".   lang('sd.member-since') ." ". dateConvert2( $user['created_at'] , $lang )   ."</div>
                                                  </div> 

                                                  
                                                  <div class='row row-side' style='margin-top:30px'>
                                                       <a href='".  new_url('user/show/'.  urlencode(base64_encode($user['user_id']) )) ."' class='text-primary' > → ". lang('sd.show-profil') ."</a>
                                                  </div> 
                                           </div>
                                  </fieldset>
                           </div>  
                                
                       </div>
                       
                       <div class='row row-side' >";
                       if( count($user['ratings']) > 0  ){
                            $val .= "<style type='text/css'>
                                           .date{   text-align: right;
                                                    padding-top: 10px;
                                                    width:260px; 
                                                    color: #666; 
                                                    font-size: 13px; 
                                                    font-style: italic; }
                                          .commnet{ margin-top: 10px;  }
                                          .msg-comment-sender-sm {
                                                         float:left;   
                                                         max-width: 275px;
                                                         width: 275px;
                                                         min-width: 275px;
                                                         border: 1.4px solid #ccc;
                                                         -webkit-border-radius: 3px;
                                                         -moz-border-radius: 3px;
                                                         -ms-border-radius: 3px;
                                                         -o-border-radius: 3px;
                                                         border-radius: 3px;
                                                         padding-top: 10px;
                                                         padding-left: 0px;
                                                         padding-bottom: 10px;
                                                         padding-right: 0px;
                                                         overflow: hidden;
                                                         zoom: 1;
                                                         margin-top: 15px;
                                                         margin-left: 10px; }
                                          .msg-photo-container-right-sm{padding-right: 25px;}

                                          .msg-photo-container-left-sm { display: block; position: relative; float:left; }
                                          .msg-photo-container-left-sm:before {
                                                                border-top: 0px solid rgba(0,0,0,0);
                                                                border-bottom: 17px solid rgba(0,0,0,0);
                                                                border-right: 13px solid #ccc;
                                                                top: 22px;
                                                                right: -11px;
                                                                z-index: 1; }
                                          .msg-photo-container-left-sm:before, 
                                          .msg-photo-container-left-sm:after {
                                                               content: '';
                                                               position: absolute;
                                                               height: 0;
                                                               width: 0; }
                                          .msg-photo-container-left-sm:after {
                                                               border-top: 0px solid rgba(0,0,0,0);
                                                               border-bottom: 14px solid rgba(0,0,0,0);
                                                               border-right: 11px solid #FFFFFF;
                                                               top: 23px;
                                                               z-index: 2;
                                                               right: -12px; }
                                          .user{ padding-left:10px; padding-bottom:5px; padding-right: 10px; }   
                                          .rate-sm{    font-size: 14px;
                                                       padding-left: 10px; 
                                                       width: 260px; 
                                                       font-weight: bold;}                    
                                  </style>";
                                   foreach ($user['ratings'] as $rating) {
                                         $username = $rating['name'];
                                         $date = date('Y');
                                         $age =  $date - $rating['birthyear'] . lang("age");
                                         $alt = $username ." ". $rating['surname'] ." ( ". $age  ." ) " ;
                                         $path = $rating['foto'];
                                         $val .="<div class='row row-side commnet'> 
                                                    <div class='msg-photo-container-left-sm'>
                                                           <a href='". new_url("user/show/" .urlencode( base64_encode( $rating['given_userid'] ) ) ) ."'> 
                                                             <img class='tip pic-img' title='$alt' alt='$alt' src='$path' width='60' height='70' style='float:right;  width: 60px; height: 70px' >
                                                           </a>
                                                    </div>
                                                       
                                                     <div  class='msg-comment-sender-sm review'>
                                                          <div class='row row-side'>
                                                             <div class='rate-sm'>
                                                                   <strong class='row row-side' style='float:left; padding-right:15px;'> ". lang("vote") . $rating['rate']." / 5 </strong>
                                                                   <span style='float:left' class='star-small star-". $rating['rate'] ."' title='". $rating['rate']   ." / 5' ></span>
                                                             </div>
                                                           </div>
                                                         <div class='row row-side  user'> <strong>". lang("rg.giver") ." ". $rating['name'] ." : </strong> `" . $rating['comment'] . "´</div>
                                                          <div class='date'>". dateConvert2($rating['created_at'], $lang ) . "
                                                                  <a href='". new_url("contact/complain/" . urlencode(base64_encode($rating['given_userid'])) ) ."'> 
                                                                      <i title='". lang("alert") ."' class='text-danger glyphicon glyphicon-flag one' ></i> 
                                                                  </a>
                                                          </div> 
                                                            
                                                    </div>
                                                </div>";
                                    }  
                       }     
                $val .="</div>";                           
                return $val;
          }
       
        /***
         |      
         |   Check user photo is acceptable 
         |   @parameter user 
         |   Retrun  photo path 
        ***/
        function photoCheckUser($user){
             $foto = $user['foto'];                                                         // check user photo is exist
             if( strcmp($foto, "") != 0 ){
                   $path   = realpath(getcwd()."/assets/");                                       // get path  
                   $array = explode('/', $foto);                                                  // split url "/" 
                   if( count($array) > 2 &&  strcmp( trim($array[ count($array) - 2 ]) , "assets") == 0 ){              // does url belong us
                       $file_name = $array[ count($array) - 1 ];                                  // last element is file name
                       if( file_exists( realpath( $path.'/'. $file_name) ) )                      // is exist or not if there is file use it else use default image  
                              $foto =  $foto;
                       else {
                              $foto  =  base_url() .'assets/';
                              $foto .= ($user['sex'] == 1) ? 'male.png':'female.png'; 
                       }
                   }
                   else
                       $foto =  $foto;
              }else{
                  $foto  =  base_url() .'assets/';
                  $foto .= ($user['sex'] == 1) ? 'male.png':'female.png'; 
              }       
             return $foto;
        } 
    
        /***
         |      
         |   Check car photo is acceptable 
         |   @parameter car 
         |   Retrun  photo path 
        ***/
        function photoCheckCar($car){
                
                $path   = realpath(getcwd()."/cars/");                    // get path
                $file_name = $car['foto_name'];                           // car's photo name 
                if( file_exists( realpath( $path.'/'. $file_name) ))      // car image is exist   
                    $foto_name = $car['foto_name'];                       // car image url
                else          
                     $foto_name = 'car.png';                              // not-exist car image use default 
                return $foto_name;
        } 

       /**
        *   Javascript error language file return
        *   
        *   @param    
        *   @return   HTML content
       **/  
       function createErrorObject(){
            $val =          "lang:'" . lang('g.lang') . "'," .
                            "error:'" . lang('g.error') . "'," .
                            "error_send:'" . lang('g.error_send') . "'," .
                            "invalid_email:'" . lang('g.invalid_email') . "'," .
                            "blank_pass:'" . lang('g.blank_pass') . "'," .
                            "ban:'" . lang('g.ban'). "'," .
                            "wrong_data:'" . lang('g.wrong_data'). "'," .
                            "edit_info:'" . lang('g.edit_info'). "'," .
                            "warning:'" . lang('g.warning'). "'," .
                            "sel_sex:'" . lang('g.sel_sex'). "'," .
                            "blank_name:'" . lang('g.blank_name'). "'," .
                            "blank_surname:'" . lang('g.blank_surname'). "'," .
                            "pass_length:'" . lang('g.pass_length'). "'," .
                            "pass_match:'" . lang('g.pass_match'). "'," .
                            "sel_birth:'" . lang('g.sel_birth'). "'," .
                            "blank_cap:'" . lang('g.blank_cap'). "'," .
                            "email_using:'" . lang('g.email_using'). "'," .
                            "wrong_cap:'" . lang('g.wrong_cap'). "'," .
                            "sign_failed:'" . lang('g.sign_failed') ."',"    .
                            "error_update:'" . lang('g.error_update') . "',"  .    
                            "fail_update:'" . lang('g.fail_update') . "',"   .
                            "success_update:'" . lang('g.success_update') . "'," .
                            "error_occurred:'" . lang('g.error_occurred') . "'," .
                            "refresh:'" . lang('g.refreshPage') . "'," .
                            "enter_int:'" . lang('g.enter_int') ."'";

            return $val;
       }
  
      /**
       *   Javascript errror language file return
       *   
       *   @param    
       *   @return   HTML content
      **/ 
     function offerRideError(){
                 $val =   "er.blank_travel='". lang('g.blank_travel') ."';" .             
                          "er.blank_start_point='". lang('g.blank_start_point') ."';" .        
                          "er.blank_destination_point ='". lang('g.blank_destination_point') ."';" .  
                          "er.blank_start_date='". lang('g.blank_start_date') ."';" .         
                          "er.blank_return_date='". lang('g.blank_return_date') ."';" .        
                          "er.blank_finih_date='". lang('g.blank_finih_date') ."';" .         
                          "er.same_date='". lang('g.same_date') ."';" .                
                          "er.fail='". lang('g.fail') ."';" .                     
                          "er.blank_travel_day='". lang('g.blank_travel_day') ."';" .         
                          "er.blank_travel_day_return ='". lang('g.blank_travel_day_return') ."';" .  
                          "er.total_seyahat='". lang('g.total_seyahat') ."';" .            
                          "er.total_time='". lang('g.total_time') ."';" .               
                          "er.saat='". lang('g.saat') ."';" .                     
                          "er.dakika='". lang('g.dakika') ."';".
                          "er.position='". lang('g.position') ."';". 
                          "er.sel_car='". lang('g.sel_car') ."';". 
                          "er.sel_luggage='". lang('g.sel_luggage') ."';". 
                          "er.sel_leavetime='". lang('g.sel_leavetime') ."';". 
                          "er.condition='". lang('g.condition') ."';". 
                          "er.max_num='". lang('g.max_num') ."';". 
                          "er.min_num='". lang('g.min_num') ."';". 
                          "er.real_distance='". lang('g.real_distance') ."';". 
                          "er.real_time='". lang('g.real_time') ."';". 
                          "er.saatS='". lang('g.saatS') ."';". 
                          "er.dakikaS='". lang('g.dakikaS') ."';" 
                          ;
           return $val;               
      }
	  
    /**
     *   Alert message with half width 
     *   
     *   @param    
     *   @return   HTML content
    **/ 
   function alert($type, $title, $content ){
         $val= " <div class='col-lg-6'>
                           <div class='alert alert-dismissable alert-$type'>
                              <button type='button' class='close' title='".lang("close")."' data-dismiss='alert'>&times;</button>
                              <strong>$title </strong>  $content
                           </div>
                         </div> ";
         return $val;                
    }

    /**
     *  Alert message with full width 
     *   
     *   @param    
     *   @return    HTML content
    **/ 
    function alertWide ($type, $title, $content ){
         $val= " <div class='col-lg-12'>
                           <div class='alert alert-dismissable alert-$type'>
                              <button type='button' class='close' title='".lang("close")."' data-dismiss='alert'>&times;</button>
                              <strong>$title </strong>  $content
                           </div>
                         </div> ";
         return $val;                
    }
    
     
     /**
      *   Create date  , day and time   
      *   Exp: 24 Nisan Cumartesi 2012 - 03:30
      *   @param    
      *   @return    
     **/ 
     function dateConvert( $date2, $lang ) {       
            $time      = date('H:i', strtotime($date2));
            $date      = strtotime(date('Y-m-d',strtotime($date2)));
            $today     = strtotime(date('Y-m-d'));
            $yesterday = $today - (60*60*24);
            $twoday    = $today - (60*60*24 * 2);
            $threeday  = $today - (60*60*24 * 3);
            
            if( $date == $today )
                $date = "Today - " . $time;
            else if( $date == $yesterday )
                $date = "Yesterday - " . $time;
            else if( $date == $twoday )
                $date = "2 days ago - " . $time; 
            else if( $date == $threeday )
                $date = "3 days ago - " . $time;   
            else
                $date = date_format(date_create(  $date2  ), ' l jS F Y - H:i');
            
            $aylarIng = array( "January" => "Ocak", 
                               "February" =>"Şubat", 
                               "March"=>"Mart", 
                               "April"=>"Nisan", 
                               "May"=>"Mayıs", 
                               "June"=>"Haziran", 
                               "July"=>"Temmuz", 
                               "August"=>"Ağustos", 
                               "September"=>"Eylül", 
                               "October"=>"Ekim", 
                               "November"=>"Kasım", 
                               "December"=>"Aralık",
                               "Monday"=>"Pazartesi", 
                               "Tuesday"=>"Salı", 
                               "Wednesday"=>"Çarşamba", 
                               "Thursday"=>"Perşembe", 
                               "Friday"=>"Cuma", 
                               "Saturday"=>"Cumartesi", 
                               "Sunday"=>"Pazar",
                               "nd"=>"",
                               "th"=>"",
                               "st"=>"",
                               "rd"=>"",
                               "Today"=> "Bugün",
                               "Yesterday" => "Dün",
                               " days ago " => " gün önce "
                           );

            if( strcmp($lang, "tr") == 0 ) 
                 return strtr($date, $aylarIng);
            else      
                return $date; 
     }
         
     /**
      *   Create date  adn day
      *   Exp: 24 Nisan Cumartesi 2012 
      *   @param    
      *   @return    
     **/ 
     function dateConvert3( $date2, $lang ) {       
            $time      = date('H:i', strtotime($date2));
            $date      = strtotime(date('Y-m-d',strtotime($date2)));
            $today     = strtotime(date('Y-m-d'));
            $yesterday = $today - (60*60*24);
            $twoday    = $today - (60*60*24 * 2);
            $threeday  = $today - (60*60*24 * 3);
            
            if( $date == $today )
                $date = "Today - " . $time;
            else if( $date == $yesterday )
                $date = "Yesterday - " . $time;
            else if( $date == $twoday )
                $date = "2 days ago - " . $time; 
            else if( $date == $threeday )
                $date = "3 days ago - " . $time;   
            else
                $date = date_format(date_create(  $date2  ), ' l jS F Y');
            
            $aylarIng = array( "January" => "Ocak", 
                               "February" =>"Şubat", 
                               "March"=>"Mart", 
                               "April"=>"Nisan", 
                               "May"=>"Mayıs", 
                               "June"=>"Haziran", 
                               "July"=>"Temmuz", 
                               "August"=>"Ağustos", 
                               "September"=>"Eylül", 
                               "October"=>"Ekim", 
                               "November"=>"Kasım", 
                               "December"=>"Aralık",
                               "Monday"=>"Pazartesi", 
                               "Tuesday"=>"Salı", 
                               "Wednesday"=>"Çarşamba", 
                               "Thursday"=>"Perşembe", 
                               "Friday"=>"Cuma", 
                               "Saturday"=>"Cumartesi", 
                               "Sunday"=>"Pazar",
                               "nd"=>"",
                               "th"=>"",
                               "st"=>"",
                               "rd"=>"",
                               "Today"=> "Bugün",
                               "Yesterday" => "Dün",
                               " days ago " => " gün önce "
                           );

            if( strcmp($lang, "tr") == 0 ) 
                 return strtr($date, $aylarIng);
            else      
                return $date; 
     }
     
     /**
      *   Create date2 only mounth adn year  
      *   Exp: 24 nisan 2012 
      *   @param    
      *   @return    
     **/  
     function dateConvert2( $date2, $lang ) {       
            $time      = date('H:i', strtotime($date2));
            $date      = strtotime(date('Y-m-d',strtotime($date2)));
            $today     = strtotime(date('Y-m-d'));
            $yesterday = $today - (60*60*24);
            $twoday    = $today - (60*60*24 * 2);
            $threeday  = $today - (60*60*24 * 3);
          
            if( $date == $today )
                $date = "Today - " . $time;
            else if( $date == $yesterday )
                $date = "Yesterday - " . $time;
            else if( $date == $twoday )
                $date = "2 days ago - " . $time; 
            else if( $date == $threeday )
                $date = "3 days ago - " . $time; 
            else
                $date = date_format(date_create(  $date2  ), ' jS F Y ');
            
            $aylarIng = array( "January" => "Ocak", 
                               "February" =>"Şubat", 
                               "March"=>"Mart", 
                               "April"=>"Nisan", 
                               "May"=>"Mayıs", 
                               "June"=>"Haziran", 
                               "July"=>"Temmuz", 
                               "August"=>"Ağustos", 
                               "September"=>"Eylül", 
                               "October"=>"Ekim", 
                               "November"=>"Kasım", 
                               "December"=>"Aralık",
                               "Monday"=>"Pazartesi", 
                               "Tuesday"=>"Salı", 
                               "Wednesday"=>"Çarşamba", 
                               "Thursday"=>"Perşembe", 
                               "Friday"=>"Cuma", 
                               "Saturday"=>"Cumartesi", 
                               "Sunday"=>"Pazar",
                               "nd"=>"",
                               "th"=>"",
                               "st"=>"",
                               "rd"=>"",
                               "Today"=> "Bugün",
                               "Yesterday" => "Dün",
                               " days ago " => " gün önce "
                           );

            if( strcmp($lang, "tr") == 0 ) 
                 return strtr($date, $aylarIng);
            else      
                return $date; 
     }



/* End of file default.php */
/* Location: ./application/controllers/Main.php */
?>