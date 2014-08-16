<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

        /**
         *    Write offer waypoints return HTML view 
         *   
         *   @param  $array
         *   @param  $on
         *   @param  $order
         *   @return HTML string
        **/
       function waysWriteSearch( &$offer ){
                 
                $waysHTML = "";
                $result = array( );
                $org         = $offer['origin'];
			    $origin      = explode(",", $offer['origin']);
                $origin      = $origin[0];
                
				$dst         = $offer['destination'];
                $destination = explode(",", $offer['destination']);
                $destination = $destination[0];
                
                if( $offer['is_way'] == 0 ){
                      $waysHTML = "<div class='routes active' title='$org' > $origin </div>  
                                   <span style='float:left; padding-top: 3px;' > → </span> 
                                   <div class='routes active' title='$dst' > $destination </div>";
                }else{
                    
                    $way_points = $offer['all_ways'];
                    $ways     = array();
                    foreach ($way_points as $way) {                                         
                           $way_origin      = explode(",", $way['departure_place']);     // split origin point by comma
                           $way_origin      = $way_origin[0];                            // take first array value  
                           
                           // ekledim
                           $way_origin      =   $way['departure_place'];     // split origin point by comma
                           
                           $way_destination = explode(",", $way['arrivial_place']);      // split origin point by comma
                           $way_destination = $way_destination[0];                       // take first array value  
                          
                          // ekledim
                           $way_destination = $way['arrivial_place'];      // split origin point by comma
                          
                           if( !in_array($way_origin , $ways)  )                         // if it is not in array add origin 
                                $ways[] = $way_origin;
                           if( !in_array($way_destination , $ways)  )                    // if it is not in array add destination
                                $ways[] = $way_destination;
                    }

                    if( $offer['is_go'] == 1 ){
                           for ($i=0; $i < count($ways ) ; $i++ ) {
                           	     $str  =  $ways[$i];  
                                 $str2 = explode(",", $str );
							     $str2 = $str2[0];  
                                if(  strcmp($str , $org ) == 0 )
                                   $waysHTML .= "<strong title='$str' style='font-size:20px;' >" . $str2 ."</strong> → " ;
                                else if( strcmp($str , $dst ) == 0 &&  $i != count($ways) -1 )
                                    $waysHTML .= "<strong title='$str' style='font-size:20px;'>" . $str2 ."</strong> → " ;
                                else if( strcmp($str , $dst ) == 0 &&  $i == count($ways) -1 )
                                    $waysHTML .= "<strong title='$str' style='font-size:20px;'>" . $str2 ."</strong>" ;
                                else if( $i == count( $ways) -1  )
                                     $waysHTML .= "<span title='$str'> $str2 </span>"; 
                                else
                                     $waysHTML .=  "<span title='$str'> $str2 </span> → "; 
                           }
                          
                         //$waysHTML = " Gidiş için hazırla ";
                    }
                    else{ // $offer['is_go'] == 0   // Dönüş için hazırla
                            $waysReturn = array();
                            for ($i= count($ways) -1; $i >= 0 ; $i--) 
                                 $waysReturn[] = $ways[$i];    
                            
                            for ($i=0; $i < count($waysReturn ) ; $i++ ) {
                                 $str =  $waysReturn[$i]; 	 
                                 $str2 = explode(",", $str );
							     $str2 = $str2[0]; 
                                 if(  strcmp($str , $org ) == 0 )
                                    $waysHTML .= "<strong title='$str' style='font-size:20px;' >" . $str2 ."</strong> → " ;
                                 else if( strcmp($str , $dst ) == 0 &&  $i != count($waysReturn) -1 )
                                     $waysHTML .= "<strong title='$str' style='font-size:20px;'>" . $str2 ."</strong> → " ;
                                 else if( strcmp($str , $dst ) == 0 &&  $i == count($waysReturn) -1 )
                                     $waysHTML .= "<strong title='$str2' style='font-size:20px;'>" . $str2 ."</strong>" ;
                                 else if( $i == count( $waysReturn) -1  )
                                      $waysHTML .= "<span title='$str'> $str2 </span>" ; 
                                 else
                                      $waysHTML .=  "<span title='$str'> $str2 </span> → "; 
                            }     
                    }   
                }       
                $result['waysHTML'] = $waysHTML;  
                return $result;      
       }
   
       /**
        *    Array sort function 
        *   
        *   @param  $array sıralanacak dizi
        *   @param  $on    sıralanacak özellik
        *   @param  $order ascendinf or descending
        *   @return array  
       **/
       function array_sort($array, $on, $order=SORT_ASC){
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort($sortable_array);
                    break;
                    case SORT_DESC:
                        arsort($sortable_array);
                    break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[] = $array[$k];
                }
            }
            // count of levels
            $countLevel = array();

            // count of price
            $countPrice =  array('low'    => 0, 
                                 'middle' => 0,
                                 'high'   => 0);
            // count of photo
            $countPhoto = array('with'    => 0, 'without' => 0  );
            // count of car comfort
            $countCarComfort = array('1' => 0, 
                                     '2' => 0,
                                     '3' => 0,
                                     '4' => 0,
                                     '5' => 0 );
            //count of date
            $countDate = array( 'today'     => 0,
                                '1days'     => 0,
                                '2days'     => 0,
                                '3days'     => 0,
                                '4days'     => 0,
                                '5daysOver' => 0  );
            //count of time // 1_2 - 2_3 gibi 
            $countTimes = array('00_04' => 0,  '04_08' => 0, '08_12' => 0, '12_16' => 0,  '16_20' => 0, '20_24' => 0  );
            //count of user average
            $countAverage = array('0_1' => 0, '1_2' => 0, '2_3' => 0,'3_4' => 0,'4_5' => 0 , 'five' => 0);
            
            $today     = strtotime(date('Y-m-d'));
            $minTime   = 24;
            $maxTime   = 0;

            foreach ($new_array as &$value) {
                    // Count of levels
                    
                     if( isset($countLevel[ $value['level'] ]) )
                         $countLevel[ $value['level'] ]++;
                     else
                         $countLevel[ $value['level'] ] = 1;
                    
                     // Count of car comforts
                    if( $value['comfort'] == 1 )
                        $countCarComfort['1']++;
                    else if( $value['comfort'] == 2 )
                        $countCarComfort['2']++;
                    else if( $value['comfort'] == 3 )
                        $countCarComfort['3']++;
                    else if( $value['comfort'] == 4 )
                        $countCarComfort['4']++;
                    else if( $value['comfort'] == 5 )
                        $countCarComfort['5']++;

                    // count of dates
                    $date      = strtotime(date('Y-m-d',strtotime($value['departure_date'])));
                    $days1  = $today + (60*60*24);
                    $days2  = $today + (60*60*24 * 2);
                    $days3  = $today + (60*60*24 * 3);
                    $days4  = $today + (60*60*24 * 4);
                    if( $date <= $today ){
                        $countDate['today']++;
                        $value['date_group'] = 0;  
                    }else if( $date <= $days1 ){
                        $countDate['1days']++;
                        $value['date_group'] = 1;  
                    }else if( $date <= $days2 ){
                        $countDate['2days']++;
                        $value['date_group'] = 2;  
                    }else if( $date <= $days3 ){
                        $countDate['3days']++;  
                        $value['date_group'] = 3;  
                    }else if( $date <= $days4 ){
                        $countDate['4days']++; 
                        $value['date_group'] = 4;  
                    }else{ 
                        $countDate['5daysOver']++; 
                        $value['date_group'] = 5;  
                    }
                    // count of times
                    $t = explode(':', $value['departure_time']);
                    if( $minTime > $t[0] )
                        $minTime = $t[0];
                    if( $maxTime < $t[0] )
                       $maxTime = $t[0];

                    $time =  $t[0] * 60 * 60 + $t[1] * 60;
                    $value['trip_time'] = $time; 
                    $time1 = 4*60*60;
                    $time2 = 8*60*60;
                    $time3 = 12*60*60;
                    $time4 = 16*60*60;
                    $time5 = 20*60*60;
                    if( $time > 0 && $time <= $time1){
                          $countTimes['00_04']++;
                          $value['time_group'] = 0;  
                    }else if( $time >= $time1 && $time < $time2){
                          $countTimes['04_08']++;
                         $value['time_group'] = 1;  
                    }else if( $time >= $time2 && $time < $time3){
                          $countTimes['08_12']++;
                         $value['time_group'] = 2;  
                    }else if( $time >= $time3 && $time < $time4){
                          $countTimes['12_16']++;
                         $value['time_group'] = 3;  
                    }else if( $time >= $time4 && $time < $time5){
                          $countTimes['16_20']++;
                         $value['time_group'] = 4;  
                    }else {
                         $countTimes['20_24']++;
                         $value['time_group'] = 5;  
                    }
                    // count of Average
                    if( $value['average'] >= 0 && $value['average'] < 1)
                          $countAverage['0_1']++;
                    else if( $value['average'] >= 1 && $value['average'] < 2)
                          $countAverage['1_2']++;
                    else if( $value['average'] >= 2 && $value['average'] < 3)
                          $countAverage['2_3']++;
                    else if( $value['average'] >= 3 && $value['average'] < 4)
                          $countAverage['3_4']++;
                    else if( $value['average'] >= 4 && $value['average'] < 5 )
                         $countAverage['4_5']++;
                    else if( $value['average'] == 5 )
                         $countAverage['five']++;
                    else    
                         $countAverage['0_1']++;

                    //Count of photo
                    $photoArray     = photoCheckUserReturnArray($value);
                    $value['foto']  = $photoArray['foto'];
                    if( $photoArray['is_photo'] == 1 ){
                        $countPhoto['with']++;
                        $value['withPhoto'] = 'with';
                    }
                    else{
                        $countPhoto['without']++;
                        $value['withPhoto'] = 'without';
                    }    
                    $start          = explode(",", $value['origin'] );
                    $end            = explode(",", $value['destination'] );
                    $name           = "flag2"; 
                    $tip            = $value['tip'];
                    $no             = $value['no'];
                    $woId           = $value['id'];
                    $id             = (  $tip == 0 ) ? $value['ride_offer_id'] :  $value['date_id']; 
                    $value['path']  = urlCreate( lang('lang'), $start[0], $end[0], $id , $name , $tip, $no , $woId );  
            } 
            
            $trip_time =  array('min' => $minTime + 0, 'max' => $maxTime + 0 );
            return  array('offers'          => $new_array, 
                          'countLevel'      => $countLevel,
                          'countPrice'      => $countPrice,
                          'countPhoto'      => $countPhoto,
                          'countCarComfort' => $countCarComfort,
                          'countDate'       => $countDate,
                          'countTimes'      => $countTimes,
                          'countAverage'    => $countAverage,
                          'trip_time'       => $trip_time  );
       }   
             
       /**
        *    
        *   
        *   @param    
        *   @return    
       **/
      function photoCheckUserReturnArray($user){
           $foto = $user['foto'];                                                         // check user photo is exist
           $is_photo = 1;
           if( strcmp($foto, "") != 0 ){
                 $path   = realpath(getcwd()."/assets/");                                       // get path  
                 $array = explode('/', $foto);                                                  // split url "/" 
                 if( count($array) > 2 &&  strcmp( trim($array[ count($array) - 2 ]) , "assets") == 0 ){              // does url belong us
                     $file_name = $array[ count($array) - 1 ];                                  // last element is file name
                     if( file_exists( realpath( $path.'/'. $file_name) ) ){                      // is exist or not if there is file use it else use default image  
                            $foto =  $foto;
                            if(  strcmp( $file_name , "male.png") == 0 || strcmp( $file_name , "female.png") == 0 )
                                 $is_photo = 0;
                     }       
                     else {
                            $foto  =  base_url() .'assets/';
                            $foto .= ($user['sex'] == 1) ? 'male.png':'female.png'; 
                            $is_photo = 0;
                     }
                 }
                 else
                     $foto =  $foto;
            }else{
                $foto  =  base_url() .'assets/';
                $foto .= ($user['sex'] == 1) ? 'male.png':'female.png'; 
                $is_photo = 0;
            }       
           return array('foto'=> $foto , 'is_photo' => $is_photo);;
      } 

       
       /**
        *   Create date2 only mounth adn year
        *   
        *   @param    
        *   @return    
       **/
      function dateConvertSearch( $date2, $lang ) {   

              $time      = date('H:i', strtotime($date2));
              $date      = strtotime(date('Y-m-d',strtotime($date2)));
              $today     = strtotime(date('Y-m-d'));
            
              $day1    = $today + (60*60*24 );
              $day2    = $today + (60*60*24 * 2);
              $day3    = $today + (60*60*24 * 3);
              $day4    = $today + (60*60*24 * 4);
              
              if( $date <= $today )
                  $date = "Today" ;
              else if( $date <= $day1 )
                  $date = "Tomorrow" ;
              else if( $date <= $day2 )
                  $date = "2 days later "; 
              else if( $date <= $day3 )
                  $date = "3 days later "; 
              else if( $date <= $day4 )
                  $date = "4 days later ";  
              else
                  $date = date_format(date_create(  $date2  ), 'l jS F Y ');
              
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
                                 "Tomorrow" => "Yarın",
                                 " days ago " => " gün önce ",
                                 "days later" => " gün sonra " 
                             );
             if( strcmp($lang, "tr") == 0 ) 
                  return strtr($date, $aylarIng);// . " " . $date2;
             else      
                 return $date; 
      }

 
       /**
        *     write all offer
        *   
        *   @param    
        *   @return    
       **/      
      function writeOffer($v, $date, &$countPrice, $offset ){
              /*  
              tip 0    -> ride_offer_id,  1 -> date_id
              is_way 0 -> "",  1 -> way_point_id
                               1 -> price_uniqe   
              */
              $username = $v['name'];
              $age      =  $date - $v['birthyear'] . lang("age");
              $alt      = $username ." ". $v['surname'] ." ( ". $age  ." )" ;
              $name     = $username; // ." ". $v['surname'];
              $path     = $v['foto'];
              $level    =  ( strcmp( lang('lang'), "tr") == 0 ) ? $v['tr_level'] : $v['en_level']; 
              $v['average'] = isset($v['average']) ? $v['average'] : 0;
              $average  =  number_format( $v['average'], 1, ".", "");
              $displayVote = ( $average > 0 ) ? "" : "display:none;";     
              $displayFace = ( $v['face_check'] == 1 ) ? "" : "display:none;";     
              
              $prefrenceHtml = "";
              $test = "rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc '&gt;  &lt;strong class='green'  &gt; TEST &lt;/strong&gt;  TEST &lt;/span&gt;\" data-trigger='hover' data-html='true'"; 
              $chat  = ($v['like_chat']  != "1") ? ( ($v['like_chat']  == "0" ) ? "no" : "yes") : "" ; 
              $smoke = ($v['like_pet']   != "1") ? ( ($v['like_pet']   == "0" ) ? "no" : "yes") : "" ;
              $pet   = ($v['like_smoke'] != "1") ? ( ($v['like_smoke'] == "0" ) ? "no" : "yes") : "" ;
              $music = ($v['like_music'] != "1") ? ( ($v['like_music'] == "0" ) ? "no" : "yes") : "" ; 
              if( strcmp("", $chat)  != 0 )
                 $prefrenceHtml .=  "<span  class='tip chat_$chat   ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$chat   ."'&gt;  ".lang("sr.chat-" .$chat )  ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
              if( strcmp("", $music) != 0 )
                 $prefrenceHtml .=  "<span  class='tip music_$music ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$music  ."'&gt;  ".lang("sr.music-" .$music ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
              if( strcmp("", $smoke) != 0 )
                 $prefrenceHtml .=  "<span  class='tip smoke_$smoke ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$smoke  ."'&gt;  ".lang("sr.smoke-" .$smoke ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
              if( strcmp("", $pet  ) != 0 )
                 $prefrenceHtml .=  "<span  class=' tip pet_$pet    ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side popover-desc colour-".$pet    ."'&gt;  ".lang("sr.pet-" .$pet )   ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";  

              $result = waysWriteSearch($v);
              $ways   = $result['waysHTML'];
              //print_r($result);
              //$priceClass = $result['price_class'];
              //$v['price_class'] =  $priceClass;
              // Count of prices
              

              // fiyatı yeniden say 
              $priceClass = $v['price_class'];
              if(  strcmp( $priceClass , 'green') == 0 )
                  $countPrice['low']++;
              else if( strcmp( $priceClass , 'orange') == 0 )
                  $countPrice['middle']++;
              else if( strcmp( $priceClass , 'red') ==  0 )
                  $countPrice['high']++;
               
              //$v['price_per_passenger'] = $result['price_per_passenger'];
              //$v['priceCertain'] = "yes";
              //if( $v['is_way'] == 1  && $v['price_uniqe'] == 0 ){
              //        $v['price_per_passenger'] = $v['price_per_passenger'] ; 
              //        $v['priceCertain'] = "no";
              //        $priceClass = "";
              //}

              $title =  'rel="popover" data-placement="top" data-content=\' &lt;span class="row row-side popover-desc "&gt;  &lt;strong class="green"  &gt;'. lang("od.green") .' &lt;/strong&gt;'.  lang("od.low")    .'&lt;/span&gt; 
                                                                            &lt;span class="row row-side popover-desc "&gt;  &lt;strong class="orange" &gt; '.lang("od.orange") .'&lt;/strong&gt; '. lang("od.normal")  .'&lt;/span&gt;
                                                                            &lt;span class="row row-side popover-desc "&gt;  &lt;strong class="red"    &gt; '.lang("od.red")    .'&lt;/strong&gt; '. lang("od.high")    .'&lt;/span&gt; \' data-trigger="hover" data-html="true"';
              $val = "<li class='list-group-item offer row' data-offset='$offset'  > 
                         <a  class='see' href='". new_url( $v['path'] ) ."' data-date='".strtotime( $v['departure_date'] .' '.$v['departure_time'] ) ."' 
                                                        data-price='{$v['price_per_passenger']}'
                                                        data-level='{$v['level']}'
                                                        data-seat='{$v['number_of_seats']}'
                                                        data-price_class='{$v['price_class']}'
                                                        data-photo='{$v['withPhoto']}'
                                                        data-car='{$v['comfort']}'
                                                        data-trip_date='{$v['departure_date']}'
                                                        data-date_group='{$v['date_group']}'
                                                        data-time_group='{$v['time_group']}'
                                                        data-trip_time='{$v['trip_time']}'
                                                        data-avg='{$v['average']}'  > 
                                <div class='col-lg-3 user-info'>   
                                    <div class='row'>
                                        <div class='col-lg-4 left foto'> 
                                           <img class='tip pic-img' title='$alt' alt='$alt' src='$path' width='60' height='70' style='width: 60px; height: 70px' >
                                        </div>
                                        <div class='col-lg-8 left name'>
                                            <div class='row ad'> $name </div>
                                            <div class='row'> $age </div>  
                                            <div class='row'> $level </div>  
                                        </div>
                                    </div>
                                    <div class='row alt-info'>
                                        <div class='row pad' style='$displayVote' >
                                             <span class='star-small star-". number_format( $v['average'], 1, "-", "") ."' title='". $average ." / 5' ></span>
                                             <div class='vote' >". $v['number']  ."  ".  lang("sr.receive") ." </div> 
                                        </div>
                                        <div class='row pad' style='$displayFace' >
                                             <span class='glyphicon icon-facebook' style='float:left; height: 20px; width:1.4em; margin-top:5px'></span>
                                             <div class='face' >". $v['friends']  ."  ".  lang("sr.friends") ." </div> 
                                        </div>
                                        <div class='row prf-container'>
                                               $prefrenceHtml
                                        </div>
                                    </div>
                                </div>
                                <div class='col-lg-7 left-border offer-info'>
                                      <div class='row date-title'>
                                         <div class='side' > <i class='glyphicon glyphicon-calendar ' style='margin-right:0px;'></i>
                                               ". dateConvertSearch( $v['departure_date'], lang('lang') ) ." 
                                         </div>
                                         <div class='side' style='color: #3a87ad;'> <i class='text-info glyphicon glyphicon-time ' style='margin-right:0px;'></i>
                                               ". substr($v['departure_time'],0,5) ." 
                                         </div>
                                      </div>
                                      <div class='row ways' > $ways </div>    
                                      <div class='row colour-yes point-departure' > ". lang("sr.origin") ." {$v['origin']} </div>
                                      <div class='row colour-no point-arrivial' > {$v['destination']} </div>
                                      <div class='row ' ><i class='icon-car' ></i>  {$v['make']} {$v['model']}  <span title='" . lang("sr.comfort".$v['comfort']  ) ."' class='tip rating-car  star_{$v['comfort']} '></span> </div>
                                </div>
                                <div class='col-lg-2 price-info'> 
                                      <div class='row price $priceClass'  $title > {$v['price_per_passenger']} ₺  </div>
                                      <div class='row desc $priceClass' > ". lang("sr.price_per") ." </div>
                                      <div class='row koltuk'> <strong class='seat'> {$v['number_of_seats']} </strong> ". lang("sr.left-seat")."</div>
                                </div>    
                         </a>
                     </li>
                    "; 
                    // <div class='row'> RO->id : {$v['ride_offer_id']} No : {$v['no']}  Tip : {$v['tip']}  Is_way : {$v['is_way']}  class:{$v['price_class']}   </div> 
              return $val;
      }
 
      /**
        *   Level content Write  
        *   
        *   @param    
        *   @return    
       **/ 
      function levelContentWrite($levels, $countLevel , $allCount ) {
             $valLevel = ""; 
             foreach ($levels as $value) {
                  $name   = lang('lang')."_level"; 
                  $count  = 0;
                  $class  = "none-display";
                  $checked = "";
                  if( array_key_exists( $value['level'] , $countLevel ) ){
                        $name    = lang('lang')."_level";
                        $count   =  $countLevel[ $value['level']]; 
                        $class = "display";
                         
                  }
                  $val =  $value[$name] . " <span>(<strong class='badge badge-level' >". $count ."</strong>)</span> ";
                  $name  = $value['level'];
                  $valLevel .= "<div data-level='{$value['level']}' class='radio $class'>
                                  <label>
                                     <input type='radio' name='optionsRadiosLevel'  value='$name' > $val
                                  </label>
                                </div> ";
                 
             }
             $valLevel = " <div class='bs-docs-section clearfix levels'>
                               <div class='row row-side side-info ' >
                                  <div  class='title' >". lang("sr.experience") ."</div>
                               </div>
                               <div class='row row-side numbers'> 
                                       <div  data-level='all' class='radio'>
                                         <label>
                                            <input type='radio' name='optionsRadiosLevel'  value='all' checked=''> 
                                            ". lang('sr.all') . " <span>(<strong class='badge badge-level' >". $allCount ."</strong>)</span> 
                                         </label>
                                       </div> 
                                       $valLevel
                               </div>
                           </div>"; 
              return $valLevel;  
      }

      
      /**
        *    Price content write
        *   
        *   @param    
        *   @return    
       **/
      function priceContentWrite( $countPrice ){
            $valPrice = "";
            foreach ($countPrice as $key => $value) {
                 $name    =  lang( "sr." . $key); 
                 if( strcmp($key, 'low') == 0 )
                     $data = "green";
                 else if( strcmp($key, 'middle') == 0 )
                     $data = "orange";
                 else if( strcmp($key, 'high') == 0 )
                     $data = "red";
                 else 
                      $data = "";
                 $show  =  ( $value == 0) ? " none-display " : "";
                 $val =  $name . " <span>(<strong class='badge badge-price' >". $value ."</strong>)</span> ";
                 $valPrice .= "<div  class='checkbox $key'>
                                 <label>
                                   <input  data-price='{$data}' name='checkboxPrice' type='checkbox' checked > $val
                                 </label>
                               </div> ";
                   
            }
            $valPrice = " <div class='bs-docs-section clearfix prices'>
                              <div class='row row-side side-info ' >
                                 <div  class='title' >". lang("sr.price") ."</div>
                              </div>
                              <div class='row row-side numbers'> 
                                      $valPrice 
                              </div>
                          </div>"; 
            return $valPrice;  
      }

      
      /**
        *   Photo content Write 
        *   
        *   @param    
        *   @return    
       **/
      function photoContentWrite($countPhoto,  $allCount ) {
              $valPhoto = ""; 
              $class  = "none-display";
              $count = $countPhoto['with'];
              if(  $count != 0  ) 
                    $class = "display";
              
              $val =  lang("sr.withPhoto") . " <span>(<strong class='badge badge-photo'>". $count ."</strong>)</span> ";
              $valPhoto .= "<div data-photo='with' class='radio $class'>
                              <label>
                                 <input type='radio' name='optionsRadiosPhoto'  value='with' > $val
                              </label>
                            </div> ";
             
              $class  = "none-display";
              $count = $countPhoto['without'];
              if(  $count != 0  ) 
                   $class = "display";

              $val =  lang("sr.withoutPhoto") . " <span>(<strong class='badge badge-photo'>". $count ."</strong>)</span> ";
              $valPhoto .= "<div data-photo='without' class='radio $class'>
                              <label>
                                 <input type='radio' name='optionsRadiosPhoto'  value='without' > $val
                              </label>
                            </div> ";

             $valPhoto = " <div class='bs-docs-section clearfix photos'>
                               <div class='row row-side side-info ' >
                                  <div  class='title' >". lang("sr.photo") ."</div>
                               </div>
                               <div class='row row-side numbers'> 
                                       <div data-photo='all' class='radio '>
                                         <label>
                                            <input type='radio' name='optionsRadiosPhoto'  value='all' checked=''> 
                                            ". lang('sr.all') . " <span>(<strong class='badge badge-photo'>". $allCount ."</strong>)</span> 
                                         </label>
                                       </div> 
                                       $valPhoto
                               </div>
                           </div>"; 
              return $valPhoto;  
      }

    
      /**
        *    Car content write 
        *   
        *   @param    
        *   @return    
       **/
      function carContentWrite($countCarComfort,  $allCount ){
             $valCar = ""; 
             $asiriLuks = $countCarComfort[5];
             $luksUstu  = $countCarComfort[4] + $asiriLuks;
             $rahat     = $countCarComfort[3] + $luksUstu;
             
             foreach ($countCarComfort as $key => $value) {
                  $name   = "sr.comfort_" . $key; 
                  if( $key != 1 && $key != 2 ){
                      if( $key == 2 )
                         $count = $orta;
                      else if(  $key == 3 )
                         $count = $rahat;
                      else if(  $key == 4 )
                         $count = $luksUstu;
                      else if(  $key == 5 )
                         $count = $asiriLuks;
                          
                      $class  = "none-display";
                      if( $count != 0 ){
                            $class = "display";
                      }
                      $val =  lang($name) . " <span>(<strong class='badge badge-car'>". $count ."</strong>)</span> ";
                      $name = $key;
                      $valCar .= "<div data-car='$key' class='radio $class'>
                                      <label>
                                         <input type='radio' name='optionsRadiosCar'  value='$name' > $val
                                      </label>
                                    </div> ";
                 } 
             }
             $valCar = " <div class='bs-docs-section clearfix cars'>
                               <div class='row row-side side-info ' >
                                  <div  class='title' >". lang("sr.comfortGroup") ."</div>
                               </div>
                               <div class='row row-side numbers'> 
                                       <div  data-car='all' class='radio'>
                                         <label>
                                            <input type='radio' name='optionsRadiosCar'  value='all' checked=''> 
                                            ". lang('sr.alltype') . " <span>(<strong class='badge badge-car'>". $allCount ."</strong>)</span> 
                                         </label>
                                       </div> 
                                       $valCar 
                               </div>
                           </div>"; 
              return $valCar;  
      }

      
      /**
        *  Date content write  
        *   
        *   @param    
        *   @return    
       **/
      function dateContentWrite($countDate,  $allCount ){
             $valDate = ""; 
             
             foreach ($countDate as $key => $value) {
                      $name   = lang( "sr.". $key ); 
                      $class  = "none-display";
                      if( $value != 0 ){
                            $class = "display";
                      }
                      $val = "$name <span>(<strong class='badge badge-date'>". $value ."</strong>)</span> ";
                      if(  strcmp( $key , "today") == 0 ){
                          $data = 0;
                      }else if(  strcmp( $key , "1days") == 0 ){
                          $data = 1;
                      }else if(  strcmp( $key , "2days") == 0 ){
                          $data = 2;
                      }else if(  strcmp( $key , "3days") == 0 ){
                          $data = 3;
                      }else if(  strcmp( $key , "4days") == 0 ){
                          $data = 4;
                      }else if(  strcmp( $key , "5daysOver") == 0 ){
                          $data = 5;
                      }
                      $valDate .= "<div data-date='$data' class='radio $class'>
                                      <label>
                                         <input type='radio' name='optionsRadiosDate'  value='$data' > $val
                                      </label>
                                    </div> ";
             }
             $valDate = " <div class='bs-docs-section clearfix dates'>
                               <div class='row row-side side-info ' >
                                  <div  class='title' >". lang("sr.date") ."</div>
                               </div>
                               <div class='row row-side numbers'> 
                                       <div  data-date='all' class='radio'>
                                         <label>
                                            <input type='radio' name='optionsRadiosDate'  value='all' checked=''> 
                                            ". lang('sr.alltype') . " <span>(<strong class='badge badge-date'>". $allCount ."</strong>)</span> 
                                         </label>
                                       </div> 
                                       $valDate 
                               </div>
                           </div>"; 
              return $valDate; 
      }


      
      /**
        *   Times content write
        *   
        *   @param    
        *   @return    
       **/
      function timesContentWrite($countTimes,  $allCount ){
             $valDate = ""; 
             foreach ($countTimes as $key => $value) {
                      $name   = lang( "sr.". $key ); 
                      $class  = "none-display";
                      if( $value != 0 ){
                            $class = "display";
                      }
                      $val = "$name <span>(<strong class='badge badge-times'>". $value ."</strong>)</span> ";
                      if(  strcmp( $key , "00_04") == 0 ){
                           $data = 0;
                      }else if(  strcmp( $key , "04_08") == 0 ){
                          $data = 1;
                      }else if(  strcmp( $key , "08_12") == 0 ){
                          $data = 2;
                      }else if(  strcmp( $key , "12_16") == 0 ){
                          $data = 3;
                      }else if(  strcmp( $key , "16_20") == 0 ){
                          $data = 4;
                      }else if(  strcmp( $key , "20_24") == 0 ){
                          $data = 5;
                      }
                      $valDate .= "<div data-times='$data' class='radio $class'>
                                      <label>
                                         <input type='radio' name='optionsRadiosTime'  value='$data' > $val
                                      </label>
                                    </div> ";
             }
             $valDate = " <div class='bs-docs-section clearfix times'>
                               <div class='row row-side side-info ' >
                                  <div  class='title' >". lang("sr.times") ."</div>
                               </div>
                               <div class='row row-side numbers'> 
                                       <div  data-times='all' class='radio'>
                                         <label>
                                            <input type='radio' name='optionsRadiosTime'  value='all' checked=''> 
                                            ". lang('sr.alltype') . " <span>(<strong class='badge badge-times'>". $allCount ."</strong>)</span> 
                                         </label>
                                       </div>
                                       $valDate 
                               </div>
                           </div>"; 
              return $valDate; 
      }

 
      /**
        *    Average content write
        *   
        *   @param    
        *   @return    
       **/
      function averageContentWrite($countAverage,  $allCount ){
            $valAvg = ""; 
            $five       = $countAverage['five'];  
            $fiveFour   = $countAverage['4_5'] + $five;
            $threeFour  = $countAverage['3_4'] + $fiveFour;
            $twoThree   = $countAverage['2_3'] + $threeFour;
          
            // oylaması 2 üzeri olanlar için 
            $name   = lang( "sr.2_3"); 
            $class  = "none-display";
            if( $twoThree != 0 ){
                  $class = "display";
            }
            $val  = "$name <span>(<strong class='badge badge-average'>". $twoThree ."</strong>)</span> ";
            $data =   2;
            $valAvg .= "<div data-averages='$data' class='radio $class'>
                            <label>
                               <input type='radio' name='optionsRadiosAverage'  value='$data' > $val
                            </label>
                          </div> ";

            // oylaması 3 üzeri olanlar için 
            $name   = lang( "sr.3_4"); 
            $class  = "none-display";
            if( $threeFour != 0 ){
                  $class = "display";
            }
            $val  = "$name <span>(<strong class='badge badge-average'>". $threeFour ."</strong>)</span> ";
            $data =   3;
            $valAvg .= "<div data-averages='$data' class='radio $class'>
                            <label>
                               <input type='radio' name='optionsRadiosAverage'  value='$data' > $val
                            </label>
                          </div> ";

            // oylaması 4 üzeri olanlar için
            $name   = lang( "sr.4_5"); 
            $class  = "none-display";
            if( $fiveFour != 0 ){
                  $class = "display";
            }
            $val  = "$name <span>(<strong class='badge badge-average'>". $fiveFour ."</strong>)</span> ";
            $data =   4;
            $valAvg .= "<div data-averages='$data' class='radio $class'>
                            <label>
                               <input type='radio' name='optionsRadiosAverage'  value='$data' > $val
                            </label>
                          </div> ";            

             // oylaması 5 üzeri olanlar için
            $name   = lang( "sr.five"); 
            $class  = "none-display";
            if( $five != 0 ){
                  $class = "display";
            }
            $val  = "$name <span>(<strong class='badge badge-average'>". $five ."</strong>)</span> ";
            $data =   5;
            $valAvg .= "<div data-averages='$data' class='radio $class'>
                            <label>
                               <input type='radio' name='optionsRadiosAverage'  value='$data' > $val
                            </label>
                          </div> ";              

            $valAvg = " <div class='bs-docs-section clearfix averages'>
                               <div class='row row-side side-info ' >
                                  <div  class='title' >". lang("sr.averages") ."</div>
                               </div>
                               <div class='row row-side numbers'> 
                                       <div  data-averages='all' class='radio'>
                                         <label>
                                            <input type='radio' name='optionsRadiosAverage'  value='all' checked=''> 
                                            ". lang('sr.alltype') . " <span>(<strong class='badge badge-average'>". $allCount ."</strong>)</span> 
                                         </label>
                                       </div>
                                       $valAvg 
                               </div>
                           </div>"; 
              return $valAvg; 

      }

       