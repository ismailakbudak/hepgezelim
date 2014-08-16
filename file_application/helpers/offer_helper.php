<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


         /**
          *  Zamanı dile göre cevir
          *   
          *   @param    
          *   @return    
         **/       
        function timeLang($time, $lang){
                       $en = array(     "saat"      => "hr"   ,
                                        "sa"        => "hr"   ,   
                                        "dakika"    => "min"  , 
                                        "dk"        => "min"      
                                       );
                       $tr = array(    "hr"      => "saat"   ,
                                       "saat"    => "saat"   ,   
                                       "sa"      => "saat"   ,   
                                       "min"     => "dk"     ,
                                       "dakika"  => "dk"  ,  
                                       "minute"  => "dakika"      
                                       );
                      if( strcmp($lang, "en") == 0 ) 
                          return strtr($time, $en);
                      else      
                         return strtr($time, $tr);
        } 
     
         /**
          *   Günleri dile göre cevir 
          *   
          *   @param    
          *   @return    
         **/         
        function en($day, $lang){
                         $days = array(  "Pazartesi" => "Monday"    ,  
                                         "Salı"      => "Tuesday"   ,  
                                         "Çarşamba"  => "Wednesday" ,  
                                         "Perşembe"  => "Thursday"  ,  
                                         "Cuma"      => "Friday"    ,  
                                         "Cumartesi" => "Saturday"  ,  
                                         "Pazar"     => "Sunday"     
                                   );
                      if( strcmp($lang, "en") == 0 ) 
                           return strtr($day, $days);
                      else      
                          return $day; 
        }

       
         /**
          *   Return one way trip content
          *   
          *   @param    
          *   @return html content
          *    
         **/  
        function oneTrip($value, $lang, $row_count = 0 ){
                   $origin      = explode(',',$value['origin']);
                   $origin      = $origin[0];
                   $destination = explode(',',$value['destination']);
                   $destination = $destination[0];   
                   $base = new_url();
                   $url_detail  = $base . urlCreate( $lang, $origin, $destination, $value['normal_id'] );
                   $url_update  = $base .'offer/update/'.$value['id'];
                   $url_show    =  new_url('offer/showList/'.$value['id'] ); 
                   $url_look    = $base .'offers/look/'.$value['id']; 
                   $val = " <div class='panel panel-primary' data-count='". $row_count ."'>
                        <div class='panel-heading'>
                            <h3 class='panel-title'>
                                {$origin} 
                                   <i class='yellow glyphicon glyphicon-arrow-right icon4' title='".lang('io.titleonetime')."'></i>
                                {$destination}
                                <a href='{$url_update}' ><i title='".lang('io.titleupdate')."' class=' glyphicon glyphicon-pencil icon3 right'></i></a>
                                <a class='delete-offer' data-toggle='modal' href='#delete-modal' data-id='".$value['id']."' ><i title='".lang('io.titledelete')."'     class=' glyphicon glyphicon-trash icon3 right'></i></a>
                                <a href='{$url_detail}' ><i title='".lang('io.titleshow')."'   class=' glyphicon glyphicon-eye-open icon3 right'></i></a>
                                <a href='{$url_show}' ><i title='".lang('io.titleshowlist')."'   class=' glyphicon glyphicon-user icon3 right'></i></a>
                                <a href='#' ><i title='".lang('io.titlecopy')."'   class=' glyphicon glyphicon-repeat icon3 right'></i></a>
                            </h3>
                          </div>
                           <div class='panel-body'>
                             <div class='row row-ofer repeat-trip' style='display: none;' >
                                <div class='col-lg-12'>
                                  <div class='bs-example'>
                                    <div class='alert alert-dismissable alert-info'>
                                             <button type='button' class='close exit' title='".lang('io.titleclose')."'>&times;</button>
                                             <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titletripdate')."'></i>
                                             <input type='text' class='form-control input-sm date datepickerStart' placeholder='".lang('io.pldeparture')."' title='".lang('io.titletripdate')."'>
                                             <i class='glyphicon glyphicon-time sol2' title='".lang('io.titletriphour')."'></i>
                                             <div class='time' title='".lang('io.titletriphour')."'>
                                                            <select class='form-control input-sm' id='datepickerStartTimeHour'>  ";  
                                                            for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .= "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .= "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .= "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }              
                           $val .= "                                               
                                                  </select>
                                     </div>
                                     <label class='dod'>:</label>
                                     <div class='time' title='".lang('io.titletriphour')."'>
                                                   <select class='form-control input-sm' id='datepickerStartTimeSecond'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titlereturndate')."'></i>
                                      <input type='text' class='form-control input-sm date datepickerEnd' title='".lang('io.titlereturndateinfo')."' placeholder='".lang('io.plreturn')."'>
                                      <i class='glyphicon glyphicon-time sol2' title='".lang('io.titlereturnhour')."' ></i>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                    <select class='form-control input-sm' id='datepickerReturnTimeHr'> ";
                                                            for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .= "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .=  "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .=  "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }                   
                        $val .= "                                                
                                                   </select>
                                      </div>
                                      <label class='dod'>:</label>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                   <select class='form-control input-sm' id='datepickerReturnTimeMin'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <button type='button' class='btn btn-sm btn-primary width-100 inputSave' style='margin-left:20px' data-id='{$value['id']}' >".lang('io.copy')."</button>
                            
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class='row row-ofer'> 
                          <div class='col-lg-9 '>
                           <blockquote  class='col-lg-12 safari'>
                                <span class='row row-ofer edit-row' >";
                             
                            $date =   tr(date_format(date_create($value['departure_date']), ' l jS F Y'), $lang) ;
                            $times = explode(':', $value['departure_time']);
                            $time = $times[0].":".$times[1]; 
                           
                      $val.=     "   <i class='text-success glyphicon glyphicon-calendar two' title='".lang('io.titledeparturedate')."' ></i>  {$date}   
                                     <i class='text-success glyphicon glyphicon-time icon4 two' title='".lang('io.titledeparturetime')."'></i> {$time}
                                </span>
                                <span class='row row-ofer edit-row'>
                                     <i class='text-info glyphicon glyphicon-map-marker two' title='".lang('io.titleroute')."' ></i>";
                                     
                                   if( count($value['way_points']) > 0 ){
                                        for ($i=0; $i < count($value['way_points']) ; $i++ ) { 
                                            $str0 = $value['way_points'][$i]['departure_place'];
										    $str = explode(  ",", $str0 );
                                            if( $i == 0)
                                               $val .= "<strong title='$str0' >" . $str[0] ."</strong>→" ;
                                             else
                                                $val .= "<span  title='$str0' >". $str[0] . "</span> →"; 
                                         }
                                         $str2 = explode(  ",", $value['destination'] );
                                         $val .= "<strong title='{$value['destination']}' >" . $str2[0] ."</strong>" ;
                                   }else{
                                         $str = explode(  ",", $value['origin'] );
                                         $str2 = explode(  ",", $value['destination'] );
                                         $val .= "<strong> <span title='{$value['origin']}' > " . $str[0] ." </span> → <span title='{$value['destination']}' > ". $str2[0] ." </span> </strong>" ;
                                   }
                                   $totaltime = timeLang($value['total_time'],$lang);
                            $val .=" <i class='text-info glyphicon glyphicon-road icon4 two' title='".lang('io.titletriplength')."'></i> {$value['total_distance']}
                                     <i class='text-info glyphicon glyphicon-time icon4 two' title='".lang('io.titletriptime')."'></i> {$totaltime}
                               
                                </span>
                                <span class='row row-ofer '>
                                     <i class='text-danger glyphicon glyphicon-calendar two' title='".lang('io.titlereturndate')."'></i>
                                     <a href='#' data-id='{$value['id']}' ><i title='".lang('io.titlereturndateadd')."' class=' glyphicon glyphicon-paperclip icon two '></i></a>
                              </span>
                            </blockquote>  
                           </div>
                          <div class='col-lg-3 '>
                              <blockquote class='pull-right' style='border-color: rgba(0, 0, 0, 0.15); height:100px; '>  
                                     <span class='row row-ofer  width-200' style='float:left'>
                                          <span class='badge' style='background-image:linear-gradient(#ff6707,#dd5600 60%,#c94e00)'>{$value['look_count']['look']}</span>".lang('io.countshow')." 
                                     </span>
                                     <span class='row row-ofer  width-200' style='float:left'>          
                                         <span class='badge seat' style='background-image:linear-gradient(#ff6707,#dd5600 60%,#c94e00);'>{$value['number_of_seats']}</span>".lang('io.leftseat')."
                                         <large class='{$value['price_class']}' ";
                                  $val .= '                             rel="popover" data-placement="top" data-content=\'&lt;span class="row popover-desc "&gt;  &lt;strong class="green"  &gt;'. lang("od.green") .' &lt;/strong&gt;'.  lang("od.low")    .'&lt;/span&gt; 
                                                                                                                          &lt;span class="row popover-desc "&gt;  &lt;strong class="orange" &gt; '.lang("od.orange") .'&lt;/strong&gt; '. lang("od.normal")  .'&lt;/span&gt;
                                                                                                                          &lt;span class="row popover-desc "&gt;  &lt;strong class="red"    &gt; '.lang("od.red")    .'&lt;/strong&gt; '. lang("od.high")    .'&lt;/span&gt;\' data-trigger="hover" data-html="true"';
                                  $val .= "                              style='margin-right:20px;'>
                                      {$value['price_per_passenger']} ₺ 
                                         </large>
                                     </span>
                                    <span class='row row-ofer  width-200'  style='float:left'>
                                            <a href='#' data-id='{$value['id']}'  title='".lang('io.titleminusseat')."'><i  class='glyphicon glyphicon-minus-sign two'></i> </a>
                                            <a href='#' data-id='{$value['id']}' title='".lang('io.titleplusseat')."'><i  class='glyphicon glyphicon-plus-sign  two '></i> </a>
                                    </span>

                              </blockquote>   
                          </div>
                       </div>
                       <div class='row row-ofer add-return-trip' style='display: none;' >
                         <div class='col-lg-12'>
                           <div class='bs-example'>
                             <div class='alert alert-dismissable alert-info'>
                                     <button type='button' class='close exit2' title='".lang('io.titleclose')."'>&times;</button>
                                      <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titlereturndate')."'></i>
                                      <input type='text' class='form-control input-sm date datepickerEndDate' data-date='{$value['departure_date']}' data-time='{$value['departure_time']}' title='".lang('io.titlereturndate')."' 
                                      placeholder='".lang('io.plreturn')."'>
                                      <i class='glyphicon glyphicon-time sol2' title='".lang('io.titlereturnhour')."' ></i>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                    <select class='form-control input-sm' id='datepickerStartTimeHour'> ";
                                                            for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .=  "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .=  "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .=  "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }                    
                          $val .= "                                                
                                                   </select>
                                      </div>
                                      <label class='dod'>:</label>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                   <select class='form-control input-sm' id='datepickerStartTimeMinute'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <button type='button' data-id='{$value['id']}' class='btn btn-sm btn-primary width-100 inputAddRetunDate' style='margin-left:20px' >".lang('io.save')."</button>
                            
                                    </div>
                                  </div>
                                </div>
                              </div>    
                            </div>
                         </div> ";
            return $val;
        }// END of the oneTrip() function
      
         /**
          *   Return two way trip content
          *   
          *   @param    
          *   @return html content
          *    
         **/         
        function twoTrip($value, $lang, $row_count = 0 ){ 
                   $origin      = explode(',',$value['origin']);
                   $origin      = $origin[0];
                   $destination = explode(',',$value['destination']);
                   $destination = $destination[0];   
                   $base        = new_url();
                   $url_update  = $base .'offer/update/'.$value['id'];
                   $url_detail  = $base . urlCreate( $lang, $origin, $destination, $value['normal_id'] );
                   $url_show    =  new_url('offer/showList/'.$value['id'] );
                   $url_look    = $base .'offers/look/'.$value['id'];
                   $val = " <div class='panel panel-primary' data-count='". $row_count ."'>
                         <div class='panel-heading'>
                            <h3 class='panel-title'>
                                 {$origin} 
                                   <i class='yellow glyphicon glyphicon-arrow-left icon1' title='".lang('io.titletwoway')."'></i>
                                   <i class='yellow glyphicon glyphicon-arrow-right icon2' title='".lang('io.titletwoway')."'></i>
                                {$destination}
                                <a href='{$url_update}' ><i title='".lang('io.titleupdate')."' class=' glyphicon glyphicon-pencil icon3 right'></i></a>
                                <a class='delete-offer' data-toggle='modal' href='#delete-modal' data-id='".$value['id']."' ><i title='".lang('io.titledelete')."' class=' glyphicon glyphicon-trash icon3 right'></i></a>
                                <a href='{$url_detail}' ><i title='".lang('io.titleshow')."' class=' glyphicon glyphicon-eye-open icon3 right'></i></a>
                                <a href='{$url_show}' ><i title='".lang('io.titleshowlist')."' class=' glyphicon glyphicon-user icon3 right'></i></a>
                                <a href='#' ><i title='".lang('io.titlecopy')."'   class=' glyphicon glyphicon-repeat icon3 right'></i></a>
                            </h3>
                          </div>
                          <div class='panel-body ' >
                           <div class='row row-ofer repeat-trip' style='display: none;' >
                                <div class='col-lg-12'>
                                  <div class='bs-example'>
                                    <div class='alert alert-dismissable alert-info'>
                                      <button type='button' class='close exit' title='".lang('io.titleclose')."'>&times;</button>
                                     <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titletripdate')."'></i>
                                     <input type='text' class='form-control input-sm date datepickerStart' placeholder='".lang('io.pldeparture')."' title='".lang('io.titletripdate')."'>
                                     <i class='glyphicon glyphicon-time sol2' title='".lang('io.titletriphour')."'></i>
                                     <div class='time' title='".lang('io.titletriphour')."'>
                                                    <select class='form-control input-sm' id='datepickerStartTimeHour'>";
                                                            for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .= "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .= "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .= "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }                   
                         $val .= "                                                  
                                                   </select>
                                     </div>
                                     <label class='dod'>:</label>
                                     <div class='time' title='".lang('io.titletriphour')."'>
                                                   <select class='form-control input-sm' id='datepickerStartTimeSecond'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titlereturndate')."'></i>
                                      <input type='text' class='form-control input-sm date datepickerEnd' title='".lang('io.titlereturndateinfo')."' 
                                      placeholder='".lang('io.plreturn')."'>
                                      <i class='glyphicon glyphicon-time sol2' title='".lang('io.titlereturnhour')."' ></i>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                    <select class='form-control input-sm' id='datepickerReturnTimeHr'>";
                                                     
                                                           for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .= "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .= "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .= "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }                     
                             $val .= "
                                                   </select>
                                      </div>
                                      <label class='dod'>:</label>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                   <select class='form-control input-sm' id='datepickerReturnTimeMin'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <button type='button'  class='btn btn-sm btn-primary width-100 inputSave' style='margin-left:20px' data-id='{$value['id']}' >".lang('io.copy')."</button>
                            </div>
                          </div>
                            </div>
                         </div>
                         <div class='row row-ofer'> 
                           <div class='col-lg-9 '>
                             <blockquote  class='col-lg-12 safari'>
                                <span class='row row-ofer edit-row' >";
                             
                            $date =   tr(date_format(date_create($value['departure_date']), ' l jS F Y'), $lang) ;
                            $times = explode(':', $value['departure_time']);
                            $time = $times[0].":".$times[1]; 
                           
                      $val.=     "   <i class='text-success glyphicon glyphicon-calendar two' title='".lang('io.titledeparturedate')."' ></i>  {$date}   
                                     <i class='text-success glyphicon glyphicon-time icon4 two' title='".lang('io.titledeparturetime')."'></i> {$time}
                                </span>
                                <span class='row row-ofer edit-row'>
                                     <i class='text-info glyphicon glyphicon-map-marker two' title='".lang('io.titleroute')."' ></i>";
                                     
                                    if( count($value['way_points']) > 0 ){
                                        for ($i=0; $i < count($value['way_points']) ; $i++ ) { 
                                            $str0 = $value['way_points'][$i]['departure_place'];
										    $str = explode(  ",", $str0 );
                                            if( $i == 0)
                                               $val .= "<strong title='$str0' >" . $str[0] ."</strong>→" ;
                                             else
                                                $val .= "<span  title='$str0' >". $str[0] . "</span> →"; 
                                         }
                                         $str2 = explode(  ",", $value['destination'] );
                                         $val .= "<strong title='{$value['destination']}' >" . $str2[0] ."</strong>" ;
                                   }else{
                                         $str = explode(  ",", $value['origin'] );
                                         $str2 = explode(  ",", $value['destination'] );
                                         $val .= "<strong> <span title='{$value['origin']}' > " . $str[0] ." </span> → <span title='{$value['destination']}' > ". $str2[0] ." </span> </strong>" ;
                                   }
                                  $totaltime = timeLang($value['total_time'],$lang);
                            $val .=" <i class='text-info glyphicon glyphicon-road icon4 two' title='".lang('io.titletriplength')."'></i> {$value['total_distance']}
                                     <i class='text-info glyphicon glyphicon-time icon4 two' title='".lang('io.titletriptime')."'></i> {$totaltime}
                                </span>
                                <span class='row row-ofer'>";
                            
                                $date =   tr(date_format(date_create($value['return_date']), ' l jS F Y'), $lang) ;
                                $times = explode(':', $value['return_time']);
                                $time = $times[0].":".$times[1]; 

                            $val .=" <i class='text-danger glyphicon glyphicon-calendar two' title='".lang('io.titlereturndate')."'></i>  {$date} 
                                     <i class='text-danger glyphicon glyphicon-time icon4 two' title='".lang('io.titledeparturetime')."'></i>  {$time} 
                               </span>
                             </blockquote>  
                         </div>
                         <div class='col-lg-3 '>
                             <blockquote class='pull-right' style='border-color: rgba(0, 0, 0, 0.15); height:100px'>  
                                       <span class='row row-ofer  width-200' style='float:left' >
                                          <span class='badge' style='background-image:linear-gradient(#ff6707,#dd5600 60%,#c94e00)'>{$value['look_count']['look']}</span> ".lang('io.countshow')."
                                     </span>
                                     <span class='row row-ofer  width-200' style='float:left'>          
                                         <span class='badge seat' style='background-image:linear-gradient(#ff6707,#dd5600 60%,#c94e00);'>{$value['number_of_seats']}</span> ".lang('io.leftseat')."
                                         <large class='{$value['price_class']}'";
                                  $val .= '                             rel="popover" data-placement="top" data-content=\'&lt;span class="row popover-desc "&gt;  &lt;strong class="green"  &gt;'. lang("od.green") .' &lt;/strong&gt;'.  lang("od.low")    .'&lt;/span&gt; 
                                                                                                                          &lt;span class="row popover-desc "&gt;  &lt;strong class="orange" &gt; '.lang("od.orange") .'&lt;/strong&gt; '. lang("od.normal")  .'&lt;/span&gt;
                                                                                                                          &lt;span class="row popover-desc "&gt;  &lt;strong class="red"    &gt; '.lang("od.red")    .'&lt;/strong&gt; '. lang("od.high")    .'&lt;/span&gt;\' data-trigger="hover" data-html="true"';
                                  $val .= "                              style='margin-right:20px;'>
                                      {$value['price_per_passenger']} ₺ 
                                         </large>
                                     </span>
                                    <span class='row row-ofer  width-200'  style='float:left'>
                                            <a href='#' data-id='{$value['id']}'  title='".lang('io.titleminusseat')."'><i  class='glyphicon glyphicon-minus-sign two'></i> </a>
                                            <a href='#' data-id='{$value['id']}' title='".lang('io.titleplusseat')."'><i  class='glyphicon glyphicon-plus-sign  two '></i> </a>
                                    </span>
                             </blockquote>   
                         </div>
                           </div>      
                          </div>
                          </div> ";
            return $val;
        }// END of the twoWayTrip() function
            
 
        /**
          *    Return rutin trip content 
          *   $value = offer , $lang = language, $count for buttonset
          *   @param    
          *   @return
          *    
         **/             
        function rutinTrip($value, $lang, &$count, $row_count = 0 ){
                  $origin      = explode(',',$value['origin']);
                  $origin      = $origin[0];
                  $destination = explode(',',$value['destination']);
                  $destination = $destination[0];      
                  $base        = new_url();
                  $url_update  = $base .'offer/update/'.$value['id'];
                  $url_detail  = $base . urlCreate( $lang, $origin, $destination, $value['normal_id'] );
                  $url_show    =  new_url('offer/showList/'.$value['id'] ); 
                  $url_look    = $base .'offers/look/'.$value['id'];
                  $val = " <div class='panel panel-primary' data-count='". $row_count ."'>
                        <div class='panel-heading  panel-heading-my'>
                           <h3 class='panel-title'>
                                 <i class='glyphicon glyphicon-retweet icon4 yellow' title='".lang('io.titlerutin')."'></i>
                                {$origin}";
                  if( $value['round_trip'] == "1"){ 
                       $val .= " <i class='yellow glyphicon glyphicon-arrow-left icon1' title='".lang('io.titletwoway')."'></i>
                                 <i class='yellow glyphicon glyphicon-arrow-right icon2' title='".lang('io.titletwoway')."'></i>";
                  }
                  else{
                       $val .= "<i class='yellow glyphicon glyphicon-arrow-right icon4' title='".lang('io.titleonetime')."'></i>"; 
                  }               
                  
                  $val .= "    {$destination}
                                <a href='{$url_update}' ><i title='".lang('io.titleupdate')."' class=' glyphicon glyphicon-pencil icon3 right'></i></a>
                                <a class='delete-offer' data-toggle='modal' href='#delete-modal' data-id='".$value['id']."' ><i title='".lang('io.titledelete')."' class=' glyphicon glyphicon-trash icon3 right'></i></a>
                                <a href='{$url_detail}' ><i title='".lang('io.titleshow')."'  class=' glyphicon glyphicon-eye-open icon3 right'></i></a>
                                <a href='{$url_show}' ><i title='".lang('io.titleshowlist')."'   class=' glyphicon glyphicon-user icon3 right'></i></a>
                                <a href='#' ><i title='".lang('io.titlecopy')."'   class=' glyphicon glyphicon-repeat icon3 right'></i></a>
                            </h3>
                          </div>
                          <div class='panel-body ' >
                           <div class='row row-ofer repeat-trip' style='display: none;' >
                                <div class='col-lg-12'>
                                  <div class='bs-example'>
                                    <div class='alert alert-dismissable alert-info'>
                                      <button type='button' class='close exit' title='".lang('io.titleclose')."'>&times;</button>
                                     <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titletripdate')."'></i>
                                     <input type='text' class='form-control input-sm date datepickerStart' placeholder='".lang('io.start')."' title='".lang('io.titlestartrutintrip')."'>
                                     <i class='glyphicon glyphicon-time sol2' title='".lang('io.titletriphour')."'></i>
                                     <div class='time' title='".lang('io.titletriphour')."'>
                                                    <select class='form-control input-sm' id='datepickerStartTimeHour'>";
                                                            for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .= "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .= "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .= "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }                   
                         $val .= "                                                  
                                                   </select>
                                     </div>
                                     <label class='dod'>:</label>
                                     <div class='time' title='".lang('io.titletriphour')."'>
                                                   <select class='form-control input-sm' id='datepickerStartTimeSecond'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titlereturndate')."'></i>
                                      <input type='text' class='form-control input-sm date datepickerEnd' title='".lang('io.titlefinishrutintrip')."' placeholder='".lang('io.plfinish')."'>
                                      <i class='glyphicon glyphicon-time sol2' title='".lang('io.titlereturnhour')."' ></i>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                    <select class='form-control input-sm' id='datepickerReturnTimeHr'>";
                                                     
                                                           for ($i=0; $i < 24; $i++){
                                                                if($i < 10) 
                                                                    $val .= "<option value='0{$i}'> 0$i </option>";
                                                                 else{
                                                                      if($i == 12)
                                                                          $val .= "<option selected value='{$i}'> $i </option>"; 
                                                                       else
                                                                          $val .= "<option value='{$i}'> $i </option>"; 
                                                                  }     
                                                             }                     
                             $val .= "
                                                   </select>
                                      </div>
                                      <label class='dod'>:</label>
                                      <div class='time' title='".lang('io.titlereturnhour')."'>
                                                   <select class='form-control input-sm' id='datepickerReturnTimeMin'>
                                                     <option value='00'>00</option>
                                                     <option value='10'>10</option>
                                                     <option value='20'>20</option>
                                                     <option value='30' selected >30</option>
                                                     <option value='40'>40</option>
                                                     <option value='50'>50</option>
                                                   </select>
                                      </div>
                                      <button type='button'  class='btn btn-sm btn-primary width-100 inputSave' style='margin-left:20px' data-id='{$value['id']}' data-type='1' >".lang('io.copy')."</button>
                            </div>
                          </div>
                            </div>
                         </div>
                         <div class='row row-ofer'> 
                           <div class='col-lg-9 '>
                             <blockquote  class='col-lg-12 safari'>
                                <span class='row row-ofer edit-row' >";
                                       $date =   tr(date_format(date_create($value['departure_date']), ' l jS F Y'), $lang) ;
                                       $times = explode(':', $value['departure_time']);
                                       $time = $times[0].":".$times[1]; 
                           $val.="    <i class='text-success glyphicon glyphicon-calendar two' title='".lang('io.titlestartdate')."' ></i> {$date}   
                                      <i class='text-success glyphicon glyphicon-time icon4 two' title='".lang('io.titledeparturetime')."'></i> {$time} 
                                      <strong title='".lang('io.titletravelday')."'> ";
                                      $return = 0;
                                      foreach ($value['rutin_trip'] as $day) {
                                             if( $day["is_return"] == 0)
                                                   $val .= " " . en($day['day'], $lang);
                                             else
                                                 $return++;
                                      }
                         $val.="</strong>
                                </span>
                                <span class='row row-ofer edit-row'>";                            
                                       $date =   tr(date_format(date_create($value['return_date']), ' l jS F Y'), $lang) ;
                                       $times = explode(':', $value['return_time']);
                                       $time = $times[0].":".$times[1]; 
                            $val .="  <i class='text-danger glyphicon glyphicon-calendar two' title='".lang('io.titlefinishdate')."'></i>  {$date}";
                                      if( $return > 0)
                                           $val .=" <i class='text-danger glyphicon glyphicon-time icon4 two' title='".lang('io.titlereturnhour')."'></i>  {$time}";  
                                      else{  // there is no return days
                                           $val .= "<a href='#' data-id='{$value['id']}' style='margin-left:20px;' ><i title='".lang('io.titlereturndaysadd')."' class=' glyphicon glyphicon-paperclip icon two '></i></a>";
                                           $count += 1;
                                      }  
                            $val .=  "<strong title='".lang('io.titletraveldayreturn')."'>"; 
                                      foreach ($value['rutin_trip'] as $day) {
                                             if( $day["is_return"] == 1)
                                                   $val .= "  " . en($day['day'],$lang);
                                      }
                           $val .=" </strong>
                                </span>
                                <span class='row row-ofer '>
                                     <i class='text-info glyphicon glyphicon-map-marker two' title='".lang('io.titleroute')."' ></i>";
                                     
                                   if( count($value['way_points']) > 0 ){
                                        for ($i=0; $i < count($value['way_points']) ; $i++ ) { 
                                            $str0 = $value['way_points'][$i]['departure_place'];
										    $str = explode(  ",", $str0 );
                                            if( $i == 0)
                                               $val .= "<strong title='$str0' >" . $str[0] ."</strong>→" ;
                                             else
                                                $val .= "<span  title='$str0' >". $str[0] . "</span> →"; 
                                         }
                                         $str2 = explode(  ",", $value['destination'] );
                                         $val .= "<strong title='{$value['destination']}' >" . $str2[0] ."</strong>" ;
                                   }else{
                                         $str = explode(  ",", $value['origin'] );
                                         $str2 = explode(  ",", $value['destination'] );
                                         $val .= "<strong> <span title='{$value['origin']}' > " . $str[0] ." </span> → <span title='{$value['destination']}' > ". $str2[0] ." </span> </strong>" ;
                                   }
                                  $totaltime = timeLang($value['total_time'],$lang);
                            $val .=" <i class='text-info glyphicon glyphicon-road icon4 two' title='".lang('io.titletriplength')."'></i> {$value['total_distance']}
                                     <i class='text-info glyphicon glyphicon-time icon4 two' title='".lang('io.titletriptime')."'></i> {$totaltime}
                                </span>";

                              
                       $val .="</blockquote>  
                           </div>
                              <div class='col-lg-3 '>
                                     <blockquote class='pull-right' style='border-color: rgba(0, 0, 0, 0.15); height:100px'>  
                                                  <span class='row row-ofer  width-200' style='float:left' >
                                                     <span class='badge' style='background-image:linear-gradient(#ff6707,#dd5600 60%,#c94e00)'>{$value['look_count']['look']}</span>".lang('io.countshow')." 
                                                </span>
                                                <span class='row row-ofer  width-200' style='float:left' >          
                                                    <span class='badge seat' style='background-image:linear-gradient(#ff6707,#dd5600 60%,#c94e00);'>{$value['number_of_seats']}</span>".lang('io.leftseat')."  
                                                    <large class='{$value['price_class']}'   ";                        
                                  $val .= '                             rel="popover" data-placement="top" data-content=\'&lt;span class="row popover-desc "&gt;  &lt;strong class="green"  &gt;'. lang("od.green") .' &lt;/strong&gt;'.  lang("od.low")    .'&lt;/span&gt; 
                                                                                                                          &lt;span class="row popover-desc "&gt;  &lt;strong class="orange" &gt; '.lang("od.orange") .'&lt;/strong&gt; '. lang("od.normal")  .'&lt;/span&gt;
                                                                                                                          &lt;span class="row popover-desc "&gt;  &lt;strong class="red"    &gt; '.lang("od.red")    .'&lt;/strong&gt; '. lang("od.high")    .'&lt;/span&gt;\' data-trigger="hover" data-html="true"';
                                  $val .= "                              style='margin-right:20px;'>
                                                        {$value['price_per_passenger']} ₺ 
                                                    </large>
                                                </span>
                                               <span class='row row-ofer  width-200' style='float:left' >
                                                       <a href='#' data-id='{$value['id']}'  title='".lang('io.titleminusseat')."'><i  class='glyphicon glyphicon-minus-sign two'></i> </a>
                                                       <a href='#' data-id='{$value['id']}' title='".lang('io.titleplusseat')."'><i  class='glyphicon glyphicon-plus-sign  two '></i> </a>
                                               </span>
                                        </blockquote>   
                                    </div>
                              </div>
                              <div class='row row-ofer add-return-trip' style='display: none;' >
                                <div class='col-lg-12'>
                                  <div class='bs-example'>
                                    <div class='alert alert-dismissable alert-primary' style='padding-top: 0px;padding-bottom: 0px;' >
                                            <button type='button' class='close exit2' title='".lang('io.titleclose')."'>&times;</button>
                                            <div id='weekDaysReturn". $count ."' class='col-lg-8 pad-0 weekDaysReturn' title='". lang('io.tripdaysTitle') ."'>
                                                                   <input type='checkbox' class='day' id='check". $count . "111'>
                                                                   <label data-name='Pazartesi' class='day-label' for='check". $count ."111'>". lang('io.mon') ."</label>
                                                                   <input type='checkbox' class='day' id='check". $count ."222'>
                                                                   <label data-name='Salı' class='day-label' for='check". $count ."222'>". lang('io.tue') ."</label>
                                                                   <input type='checkbox'  class='day' id='check". $count ."333'>
                                                                   <label data-name='Çarşamba' class='day-label' for='check". $count ."333'>". lang('io.wed') ."</label>
                                                                   <input type='checkbox' class='day' id='check". $count ."444'>
                                                                   <label data-name='Perşembe' class='day-label' for='check". $count ."444'>". lang('io.thu') ."</label>
                                                                   <input type='checkbox' class='day' id='check". $count ."555'>
                                                                   <label data-name='Cuma'  class='day-label' for='check". $count ."555'>". lang('io.fri') ."</label>
                                                                   <input type='checkbox' class='day' id='check". $count ."666'>
                                                                   <label data-name='Cumartesi'  class='day-label' for='check". $count ."666'>". lang('io.sat') ."</label>
                                                                   <input type='checkbox' class='day' id='check". $count ."777'>
                                                                   <label data-name='Pazar' class='day-label' for='check". $count ."777'>". lang('io.sun') ."</label>
                                            </div>
                                            <div class='col-lg-2' style='padding-right: 0px; padding-left: 0px;' >
                                                     <i class='glyphicon glyphicon-time sol2' title='".lang('io.titlereturnhour')."' ></i>
                                                     <div class='time' title='".lang('io.titlereturnhour')."'>
                                                                   <select class='form-control input-sm' id='datepickerReturnTimeHr'>";
                                                                    
                                                                          for ($i=0; $i < 24; $i++){
                                                                               if($i < 10) 
                                                                                   $val .= "<option value='0{$i}'> 0$i </option>";
                                                                                else{
                                                                                     if($i == 12)
                                                                                         $val .= "<option selected value='{$i}'> $i </option>"; 
                                                                                      else
                                                                                         $val .= "<option value='{$i}'> $i </option>"; 
                                                                                 }     
                                                                            }                     
                                            $val .= "
                                                                  </select>
                                                     </div>
                                                     <label class='dod'>:</label>
                                                     <div class='time' title='".lang('io.titlereturnhour')."'>
                                                                  <select class='form-control input-sm' id='datepickerReturnTimeMin'>
                                                                    <option value='00'>00</option>
                                                                    <option value='10'>10</option>
                                                                    <option value='20'>20</option>
                                                                    <option value='30' selected >30</option>
                                                                    <option value='40'>40</option>
                                                                    <option value='50'>50</option>
                                                                  </select>
                                                     </div> 
                                            </div>                        
                                            <button type='button' data-id='{$value['id']}' class='btn btn-sm btn-primary width-100 inputAddRetunDays' style='margin-left:20px' >".lang('io.save')."</button>
                                    </div>
                                  </div>
                                </div>
                              </div>   

                             </div>
                          </div> ";
                 return $val;
        } 
        // END of the rutinTrip() function

?>