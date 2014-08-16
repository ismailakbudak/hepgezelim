<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
     


   /*******
    | sidebar for offer detail Member verifications  content
    | @parameter |  user
    | @return    |  html content
    |    
   ****/
   function getMemberVerification($user){
           $verifications = array(); 
           if( $user['email_check'] ){
                 $email = "<div class='row verification'>
                                 <i class='col-xs-1 text-primary glyphicon ' style='width: 1em;' >@</i> 
                                 <div class='col-xs-8 text-verified text-success'> 
                                       ".lang("od.email")."
                                 </div>
                                 <i class='col-xs-2 validated'></i> 
                          </div>";
                  $verifications[] = $email;         
           }
           
           $phone = ""; 
           if( $user['tel_check'] ){               
                  $phone = "<div class='row verification'>
                                   <i class='col-xs-2 text-primary  glyphicon glyphicon-phone '></i> 
                                   <div class='col-xs-8 text-verified text-success'> 
                                        ".lang("od.phone")."
                                   </div>
                                   <i class='col-xs-2 validated'></i> 
                           </div>";
                   $verifications[] = $phone;
           }
           $face = ""; 
           if( $user['face_check'] ){          
                 $face = "<div class='row verification'>
                                   <i class='col-xs-2 text-primary  glyphicon icon-facebook ' style='height: 23px; width:1em; margin-top:5px'></i> 
                                   <div class='col-xs-8 text-verified text-success'> 
                                      ". $user['friends'] ." ".lang("od.friends")." 
                                   </div>
                                   <i class='col-xs-2 validated'></i>   
                           </div>";
                 $verifications[] = $face;          
            }                
            if( count($verifications) > 0 ){
                 $val = "<div class='row verified-title'>
                              <div class='row'>
                                   <h4 class='driver-h' > ". lang("od.verification") ." </h4>
                              </div>"; 
                             foreach ($verifications as $value)
                                  $val .= $value;         
                  $val .="</div>";
            }
            return  ( isset( $val ) ) ? $val : "";              
   }

   /****
   |  Write tripdate content
   |  @parameter | offer , lang
   |  @return    | html content 
   |
  ****/  
    function tripDateContent($offer, $lang){
    	    $content = "";
            $estimated = isset( $offer['estimated'] ) ? ( ( $offer['estimated'] ==  1 ) ? lang("od.estimated") : "" ) : "";   
            if( $offer['trip_type'] == "0" ){
		                   $departure=" <div class='row out-row' style='padding-right: 8px; padding-left: 8px;' >
		                                      <div class='row alt-cizgi' >   
		                                           <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:2px;' >
		                                              ". lang('od.date')  ."  
		                                           </label>
		                                           <div class='col-lg-8 no-padding5'>
		                                               <div class='col-lg-12 no-padding'> 
		                                                      <i class='text-success glyphicon glyphicon-calendar two' style='margin-right:0px;'></i> 
		                                                      ". tr(date_format(date_create($offer['departure_date']), ' l jS F Y'), $lang) ."
		                                               </div>
		                                           </div>
		                                      </div>
		                                      <div class='row alt-cizgi' >       
		                                             <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:5px;' >
		                                              ". lang('od.time')  ."  
		                                             </label>
		                                             <div class='col-lg-8 no-padding5'>
		                                                    <i class='text-success glyphicon glyphicon-time two date-location' ></i> 
		                                                    <div class='time2'>". substr($offer['departure_time'], 0, -3) ." ". $estimated ."</div>
		                                             </div>
		                                      </div>
		                                </div>";
                           $return ="<div class='row out-row' style='padding-right: 8px; padding-left: 8px;'  >
                                              <div class='row alt-cizgi'>    
                                                    <label for='datepickerEnd' class='col-lg-4 control-label' style='padding-top:2px;'>
                                                     " .lang('od.dateR') ."
                                                    </label>
                                                    <div class='col-lg-8 no-padding5'>
                                                          <div class='col-lg-12 no-padding'> 
                                                                 <i class='text-danger glyphicon glyphicon-calendar two' style='margin-right:0px;' ></i> 
                                                                 ". tr(date_format(date_create($offer['return_date']), ' l jS F Y'), $lang ) ."
                                                          </div>
                                                    </div>      
                                              </div>          
                                              <div class='row alt-cizgi' > 
                                                      <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:5px;' >
                                                       ". lang('od.timeR')  ."  
                                                      </label>           
                                                      <div class='col-lg-8 no-padding5'>
                                                             <i class='text-danger glyphicon glyphicon-time two date-location' ></i> 
                                                             <div class='time2'>". substr( $offer['return_time'], 0 , -3 ) ."</div>
                                                      </div>     
                                              </div>      
                                    </div>";
                           $content  = $departure;           
                           $content .= ( $offer['round_trip'] == "1") ? $return : "";    
            }
            else{
                          $content  = "";
                          $currentDate = strtotime(date('d-m-Y H:i:s'));
                          $dateArr = array();
                          
                          if( $offer['is_reverse'] == 1 ){
                              $return = $offer['departure_time'];
                              $departure =  $offer['return_time'];
                          }
                          else{
                                 $departure = $offer['departure_time'];
                                 $return  =  $offer['return_time'];
                          }
                          foreach ($offer['rutinDates'] as $value) {
                              if( $offer['is_reverse'] == 0 ){
                                  if( $value['is_return'] == 0 ){
                                      if( $currentDate <= strtotime( $value['date'] ." ". $departure )  ){
                                            if(  strcmp( $lang , "tr" ) == 0 )
                                                 $dateArr[] =   array('date' => tr(date_format( date_create(  $value['date']  ), ' l jS F Y'), "tr" ) , 'is_return' => 0);
                                            else
                                                 $dateArr[] =   array('date' => date_format( date_create(  $value['date']  ), ' l jS F Y') , 'is_return' => 0);
                                      }
                                  }
                                  else{
                                      if( $currentDate <= strtotime( $value['date'] ." ". $return )  ){
                                            if(  strcmp( $lang , "tr" ) == 0 )
                                                 $dateArr[] =   array('date' => tr(date_format( date_create(  $value['date']  ), ' l jS F Y'), "tr" ) , 'is_return' => 1 );
                                            else
                                                 $dateArr[] =   array('date' => date_format( date_create(  $value['date']  ), ' l jS F Y') , 'is_return' =>1 );
                                      }
                                  }
                              }
                              else{
                                  if( $value['is_return'] == 0 ){
                                      if( $currentDate <= strtotime( $value['date'] ." ". $departure )  ){
                                            if(  strcmp( $lang , "tr" ) == 0 )
                                                 $dateArr[] =   array('date' => tr(date_format( date_create(  $value['date']  ), ' l jS F Y'), "tr" ) , 'is_return' => 1 );
                                            else
                                                 $dateArr[] =   array('date' => date_format( date_create(  $value['date']  ), ' l jS F Y') , 'is_return' => 1 );
                                      }
                                  }
                                  else{
                                      if( $currentDate <= strtotime( $value['date'] ." ". $return )  ){
                                            if(  strcmp( $lang , "tr" ) == 0 )
                                                 $dateArr[] =   array('date' => tr(date_format( date_create(  $value['date']  ), ' l jS F Y'), "tr" ) , 'is_return' => 0 );
                                            else
                                                 $dateArr[] =   array('date' => date_format( date_create(  $value['date']  ), ' l jS F Y') , 'is_return' => 0 );
                                      }
                                  }
                              }
                          }      
                          $start = " <div class='row out-row' style='padding-right: 8px; padding-left: 8px;' >
                                                   <div class='row alt-cizgi' >   
                                                        <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:2px;' >
                                                           ". lang('od.start')  .":  
                                                        </label>
                                                        <div class='col-lg-8 no-padding5'>
                                                            <div class='col-lg-8 no-padding'> 
                                                                   <i class='text-success glyphicon glyphicon-calendar two' style='margin-right:0px;'></i> 
                                                                   ". $offer['departure_date'] . "
                                                            </div>
                                                        </div>
                                                   </div>
                                                   <div class='row alt-cizgi' >    
                                                             <label for='datepickerEnd' class='col-lg-4 control-label' style='padding-top:2px;'>
                                                              " .lang('od.finish') .":
                                                             </label>
                                                             <div class='col-lg-8 no-padding5'>
                                                                   <div class='col-lg-8 no-padding'> 
                                                                          <i class='text-danger glyphicon glyphicon-calendar two' style='margin-right:0px;' ></i> 
                                                                          ". $offer['return_date']  ."
                                                                   </div>
                                                             </div>      
                                                   </div>
                                             </div>";
                          $return_time = "<div class='row  alt-cizgi ' > 
                                                     <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:5px;' >
                                                      ". lang('od.timeRs')  ."  
                                                     </label>           
                                                     <div class='col-lg-8 no-padding5'>
                                                            <i class='text-danger glyphicon glyphicon-time two date-location' ></i> 
                                                            <div class='time2'>". substr( $offer['return_time'], 0 , -3 ) ."</div>
                                                     </div>     
                                             </div>";      
                          $return_time =  ( $offer['round_trip'] ) ? $return_time : "";                   
                          $time = " <div class='row out-row' style='padding-right: 8px; padding-left: 8px;'  > 
                                                    <div class='row alt-cizgi' >       
                                                       <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:5px;' >
                                                        ". lang('od.times')  ."  
                                                       </label>
                                                       <div class='col-lg-8 no-padding5'>
                                                              <i class='text-success glyphicon glyphicon-time two date-location' ></i> 
                                                              <div class='time2'>". substr($offer['departure_time'], 0, -3) ." ". $estimated ." </div>
                                                       </div>
                                                    </div>". $return_time ."        
                                    </div>";
                           $dates = "";   
                            if( count($dateArr) > 0 ){
                                     foreach ($dateArr as $date) {
                                            $departure = " <div class='row out-row' style='padding-right: 8px; padding-left: 8px;'>
                                                               <div class='row alt-cizgi' >   
                                                                    <label for='datepickerStart' class='col-lg-4 control-label ' style='padding-top:2px;' >
                                                                       ". lang('od.date')  ."  
                                                                    </label>
                                                                    <div class='col-lg-8 no-padding5'>
                                                                        <div class='col-lg-12 no-padding'> 
                                                                               <i class='text-success glyphicon glyphicon-calendar two' style='margin-right:0px;'></i> 
                                                                               ". $date['date'] . "
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                         </div>";
                                             $return = " <div class='row out-row' style='padding-right: 8px; padding-left: 8px;' >
                                                                   <div class='row alt-cizgi'>    
                                                                         <label for='datepickerEnd' class='col-lg-4 control-label' style='padding-top:2px;'>
                                                                          " .lang('od.dateR') ."
                                                                         </label>
                                                                         <div class='col-lg-8 no-padding5'>
                                                                               <div class='col-lg-12 no-padding'> 
                                                                                      <i class='text-danger glyphicon glyphicon-calendar two' style='margin-right:0px;' ></i> 
                                                                                      ". $date['date']  ."
                                                                               </div>
                                                                         </div>      
                                                                   </div>      
                                                         </div>";
                                              $dates .= ($date['is_return'] == 0 ) ? $departure : "";  
                                              $dates .= ($date['is_return'] == 1 ) ? $return : "";             
                                     }
                              }
                              else{
                                    $dates = " <div class='row out-row alt-cizgi' style=' padding:15px; ' >
                                                               <label for='datepickerEnd' class='col-lg-12 text-danger text-center' style='padding-top:2px;'>
                                                                " .lang('od.no-date') ."
                                                               </label>     
                                               </div>"; 
                              }       

                          $content  .= $start;
                          $content  .= $time;
                          $content  .= $dates;  
            }
            return $content;              	
    }
 
     /****
     |  Write user misiing contents or detail about the offer 
     |  @parameter | offer , own_offer ,user
     |  @return    | html content 
     |
    ****/     
    function detailMissing( $offer, $own_offer , $user ){
    	  $content = "";
    	  if( strcmp( trim($offer['explain_departure']) , "") != 0  ){
                   
                   $username = $user['name'];
                   $date = date('Y');
                   $age =  $date - $user['birthyear'] . lang("od.age");
                   $alt = $username ." ". $user['surname'] ."(". $age  .")" ; 
                   // explain about the departure
                   //$offer['explain_departure'] = ( $offer['explain_approval'] ) ?  $offer['explain_departure'] : lang("od.approval");
                   $val  = "<div class='col-lg-3' >
                                  <a href='". new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ."'> 
                                      <img class='pic-img' title='$alt' alt='$alt' src='".  $user['foto'] ."' width='100px' height='120px' >
                                  </a>
                            </div> 
                            <div class='col-lg-9 explain'>
                                   `` ". ucfirst( trim($offer['explain_departure']) )  ." ´´  
                            </div>  
                           ";
                   $content = $val;        
           }
           else if( $own_offer )
                  $content = "<div class='blank-explain explain' ><a href='". new_url('offer/update/'. $offer['id'])  ."'>". lang("od.adddesc") ."</a></div>";      

           return $content;    
    }
    
  /****
   |  Write waypoints content 
   |  @parameter | offer
   |  @return    | html content 
   |
  ****/   
  function wayPoints($offer){
  	     $val = "";
         if( count($offer['way_points']) > 0 ){
             for ($i=0; $i < count($offer['way_points']) ; $i++ ) {
                    $str0 = $offer['way_points'][$i]['departure_place'] ;	 
                    $str = explode(  ",", $str0 );
                    if( $i == 0)
                        $val .= "<strong title='$str0' class='text-primary' style='font-size:20px;' >" . $str[0] ."</strong>→" ;
                     else{
                         //$offer_id = $offer['no_encryp_id'];
                         //$lang = lang('lang');
                         //$originU = $str[0];
                         //$destination = explode(",", $offer['destination']);
                         //$destinationU = $destination[0];
                         //$path = new_url(urlCreate( $lang, $originU, $destinationU, $offer_id )) ;
                         //$val .= "<a class='click' style='color: #555;' href='$path'>" . $str[0] . "</a>  →";

                         $val .= "<span title='$str0' >". $str[0] . " </span> →"; 
                     }
               }
			   $str0 = $offer['way_points'][ count($offer['way_points'])- 1]['arrivial_place'];
               $str2 = explode(  ",", $str0 ); //$offer['destination'] );
               $val .= "<strong title='$str0' class='text-primary' style='font-size:20px;'>" . $str2[0] ."</strong>" ;
         }else{
              $str = explode(  ",", $offer['origin'] );
              $str2 = explode(  ",", $offer['destination'] );
              $val .= "<strong  class='text-primary' style='font-size:20px;' > <span title='{$offer['origin']}'>" . $str[0] ."</span>  → <span title='{$offer['destination']}'>". $str2[0] ." </span> </strong>" ;
         }
         return $val;
  }

  /****
   |  Write waypoints content 
   |  @parameter | offer
   |  @return    | html content 
   |
  ****/   
/*
    function waysWrite($ways,$waysName, $origin, $destination, $offer_id){
         $val = "";
         if( count($ways ) > 0 ){
               for ($i=0; $i < count($ways ) ; $i++ ) { 
                    $str  = ucfirst($ways[$i]);
                    $str2 = $waysName[$ways[$i]];
                    if(  strcmp($str , $origin ) == 0 )
                       $val .= "<strong class='text-primary' style='font-size:20px;' >" . $str2 ."</strong>→" ;
                    else if( strcmp($str , $destination ) == 0 &&  $i != count($ways) -1 ){
                        $val .= "<strong class='text-primary' style='font-size:20px;'>" . $str2 ."</strong>→" ;
                    }
                    else if( strcmp($str , $destination ) == 0 &&  $i == count($ways) -1 ){
                        $val .= "<strong class='text-primary' style='font-size:20px;'>" . $str2 ."</strong>" ;
                    } 
                    else if( $i == count( $ways) -1  ){
                         //$val .= $str ; 
                         //$lang = lang('lang');
                         //$originU = $origin;
                         //$destinationU = $str;
                         //$path = new_url(urlCreate( $lang, $originU, $destinationU, $offer_id )) ;
                         //$val .= "<a class='click' style='color: #555;' href='$path'>" . $str2 . "</a> "; 
                         $val .=  $str2 ; 
                    }   
                    else{
                        // $lang = lang('lang');
                        // $originU = $str;
                        // $destinationU = $destination;
                        // $path = new_url(urlCreate( $lang, $originU, $destinationU, $offer_id )) ;
                        // $val .= "<a class='click' style='color: #555;' href='$path'>" . $str2 . "</a>  →"; 
                         $val .=   $str2 . "  →"; 
                    }     
               }
              
         }
         return $val;
  }
*/

  /****
   |  Write waypoints content 
   |  @parameter | offer
   |  @return    | html content 
   |
  ****/   
  function wayPointsReverse($offer){
         $val = "";
         if( count($offer['way_points']) > 0 ){
               for ($i= count($offer['way_points']) - 1;  $i >= 0; $i-- ) {
                    $str0 =  $offer['way_points'][$i]['arrivial_place'];	 
                    $str = explode(  ",", $str0 );
                    if( $i ==  count($offer['way_points']) - 1 )
                       $val .= "<strong title='$str0' class='text-primary' style='font-size:20px;' >" . $str[0] ."</strong>→" ;
                     else{
                         // $offer_id = $offer['no_encryp_id'];
                         // $lang = lang('lang');
                         // $originU = $str[0];
                         // $destination = explode(",", $offer['destination']);
                         // $destinationU = $destination[0];
                         // $path = new_url(urlCreate( $lang, $originU, $destinationU, $offer_id  )) ;
                         // $val .= "<a class='click' style='color: #555;' href='$path'>" . $str[0] . "</a>  →"; 
                         $val .= "<span title='$str0' >". $str[0] . " </span> →";
                     }    
               }
			   $str0 = $offer['way_points'][0]['departure_place'];
               $str2 = explode(  ",", $str0 ); //$offer['destination'] );
               $val .= "<strong title='$str0' class='text-primary' style='font-size:20px;'>" . $str2[0] ."</strong>" ;
         }else{
              $str = explode(  ",", $offer['origin'] );
              $str2 = explode(  ",", $offer['destination'] );
              $val .= "<strong  class='text-primary' style='font-size:20px;' > <span title='{$offer['origin']}'>" . $str[0] ."</span>  → <span title='{$offer['destination']}'>". $str2[0] ." </span> </strong>" ;
         }
         return $val;
  }

  /****
   |  Manage this offer content
   |  @parameter | offer
   |  @return    | html content 
   |
  ****/ 
  function manageOffer( $offer ){
  	  $val=" <div class='col-lg-12'  > 
                          <div class='well'>
                                <form class='bs-example form-horizontal'>
                                    <fieldset>
                                        <legend> ". lang("od.manage") ."
                                            <a href='". new_url('offer/update/'.$offer['id'] ) ."'> <i title='". lang('update') ."' class=' glyphicon glyphicon-pencil icon3 one right'></i>  </a> 
                                            <a href='". new_url('offer') ."'> <i title='". lang('od.offer') ."' class=' glyphicon glyphicon-briefcase one right'></i></a>  
                                            <a class='delete-offer' data-toggle='modal' href='#delete-modal' data-id='".$offer['id']."' ><i title='".lang('io.titledelete')."' class=' glyphicon glyphicon-trash icon3  one right'></i></a>
                                            <a href='". new_url('offer/showList/'.$offer['id'] ) ."' ><i title='".lang('io.titleshowlist')."'   class=' glyphicon glyphicon-user icon3 one right'></i></a>
                                            <a href='#' ><i title='".lang('io.titlecopy')."'   class=' glyphicon glyphicon-repeat icon3 one right'></i></a>
                                        </legend>
                                    </fieldset>
                                </form>
                                <div class='row repeat-trip' style='display: none;' >
                                      <div class='col-lg-12'>
                                        <div class='bs-example'>
                                          <div class='alert alert-dismissable alert-info'>
                                                   <button type='button' class='close exit' title='".lang('io.titleclose')."'>&times;</button>
                                                   <i class='glyphicon glyphicon-calendar sol' title='".lang('io.titletripdate')."'></i>
                                                   <input type='text' class='form-control input-sm dateMy datepickerStart' placeholder='".lang('io.pldeparture' .$offer['trip_type']   )."' title='".lang('io.titletripdate')."'>
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
                                            <input type='text' class='form-control input-sm dateMy datepickerEnd' title='".lang('io.titlereturndateinfo')."' placeholder='".lang('io.plreturn' .$offer['trip_type'] )."'>
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
                                            <button type='button' class='btn btn-sm btn-primary width-100 inputSave' style='margin-left:20px' data-id='{$offer['id']}' data-type='{$offer['trip_type']}' >".lang('io.copy')."</button>
                                  
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div> 
                       </div> ";
                  
         return $val;    
  } // end of the function manageoffer



  /***
   *  End of the file
   **/
