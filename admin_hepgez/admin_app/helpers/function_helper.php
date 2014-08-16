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

       
        /***
         |      
         |   Check user photo is acceptable 
         |   @parameter user 
         |   Retrun  photo path 
        ***/
        function photoCheckUser($user){
        	
             $foto = $user['foto'];                                                         // check user photo is exist
             if( strcmp($foto, "") != 0 ){
                   $path   =   realpath( new_getcwd()."/assets/" );                                       // get path  
                   $array = explode('/', $foto);                                                  // split url "/" 
                   if( count($array) > 2 &&  strcmp( trim($array[ count($array) - 2 ]) , "assets") == 0 ){              // does url belong us
                       $file_name = $array[ count($array) - 1 ];                                  // last element is file name
                       
                       if( file_exists(   $path."/" .$file_name)  ){                      // is exist or not if there is file use it else use default image  
                              $foto =  $foto;
					   }
                       else {
                              $foto  =  get_path() .'assets/';
                              $foto .= ($user['sex'] == 1) ? 'male.png':'female.png'; 
                       }
                   }
                   else
                       $foto =  $foto;
              }else{
                  $foto  =  get_path() .'assets/';
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
                
                $path   = realpath( new_getcwd()."/cars/");                    // get path
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