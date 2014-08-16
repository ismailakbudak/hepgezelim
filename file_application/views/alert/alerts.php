   
   <style type="text/css">
    .my.well{ background-color: #FFFFFF;}
    .create{ font-size: 12px;  font-style: italic; }
    .copy-date{ margin-top: 10px; display: none; }
    .copy-date .alert{ margin-bottom: 0px; } 
    .datepicker{ float:  left; width: 150px; border-radius: 20px;  margin-right: 5px; text-align: center; font-size: 16px; padding: 3px; }
    .inputSave{ float: left; width: 150px; }
    .glyphicon-calendar{ float: left; font-size: 28px; margin-right: 5px}
    .notify{background-color: rgba(231, 244, 255, 0.43);}
    .alert-badge1{ background-color: #28AEEC; font-size: 20px; }
    .alert-badge{ font-size: 20px; }
    .offers .glyphicon-calendar { font-size: 20px; float: none; } 

   </style>
   <?php
    // Create date2 only mounth adn year 
     function convert( $date2, $lang ) {       
           
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
   ?>
   <div class="row row-side">
        <div class='col-lg-12 no-padding' >
        	<div class="my well"  style="min-height:300px" >
          	     <legend> <h2 style='color: rgba(4, 4, 5, 0.61);' ><?= lang('a.title') ?></h2> </legend>
          	     <? 
                   $offers = $alerts['offers'];
                   $alerts = $alerts['alerts'];
                   if( count($alerts) > 0 ){ 
                        foreach ($alerts as $alert) {    
                        	
                                $alert['place2'] = strcmp($alert['place2'], "") == 0 ? lang("a.any_place") : $alert['place2'];
                                $alert['number'] = $alert['number'] + 0;
                                $is_one = ($alert['number'] > 0 ) ? 1 : 0;  
                                if( $is_one == 1 )
                                    $badge           = "<a href='#' class='show-offer' title='".lang('a.show-offers')."' > <span class='badge alert-badge1' > {$alert['number']} </span> <strong class='text-primary'> ".  lang('a.offer')  . "</strong> </a>";
                                else
                                    $badge           = "<span class='badge alert-badge' > 0 </span> ";  
                          ?> 
                                <div class="alert alert-primary notify" data-id='<?= $alert['id'] ?>' style='border: 1px solid rgba(167, 167, 167, 0.52);'>
                                     <a  class="delete-alert right"  title="<?= lang("a.delete")?>" href="#" >  
                                     	 <i class='text-danger glyphicon glyphicon-trash three'> </i> </a>
                                     <a   class="copy-alert right"  title="<?= lang("a.copy")?>" href="#" >  
                                     	 <i class=" glyphicon glyphicon-repeat three" > </i> </a>
                                     <h4 > <?= $alert['place1'] . " → " . $alert['place2'] ." ". $badge?>   </h4> 
                                     <p>  <?= lang('a.trip_date') . convert( $alert['date'], lang('lang'))   ?> </p>
                                     <p class='text-right create'> <?=  lang('a.created') . dateConvert3( $alert['created_at'], lang('lang') )  ?> </p>
                                     <div class="row" > 
                                          <div class='col-lg-12' > 
                                            <?    
                                                 foreach ($offers as $offer) {
                                                      if( $alert['id'] == $offer['id'] ){ 
                                                           $departures = explode("|", $offer['departure']);
                                                           $arrivials  = explode("|", $offer['arrivial']); 
                                                           
                                                           ?>
                                                             <div class="row offers" style='display:none' >
                                                                <div class='col-lg-12' > 
                                                                    <hr>    
                                                                    <?
                                                                       $origin      = explode( ",", $offer['origin'] );
                                                                       $origin      = $origin[0];
                                                                       $destination = explode( ",", $offer['destination'] );
                                                                       $destination = $destination[0];
                                                                       $offer_id    = $offer['ride_offer_id'];
                                                                       $path        = new_url( urlCreate( lang('lang'), $origin, $destination, $offer_id) );

                                                                       $val = "";
                                                                       if( count($departures) > 1 ){
                                                                           for ($i=0; $i < count($departures) ; $i++ ) { 
                                                                                  $str = explode(  ",", $departures[$i]);
                                                                                  if( $i == 0)
                                                                                      $val .= "<strong class='text-primary' style='font-size:20px;' >" . $str[0] ."</strong>→" ;
                                                                                   else{  
                                                                                       $val .= $str[0] . " →"; 
                                                                                   }
                                                                             }
                                                                             $str2 = explode(  ",", $offer['destination'] ) ;  
                                                                             $val .= "<strong class='text-primary' style='font-size:20px;'>" . $str2[0] ."</strong>" ;
                                                                       }else{
                                                                            $str  = explode( ",", $offer['origin'] );
                                                                            $str2 = explode( ",", $offer['destination'] );
                                                                            $val = "<strong class='text-primary' style='font-size:20px;' >" . $str[0] ."→". $str2[0] ."</strong>" ;
                                                                       }
                                                                       $round_trip = $offer['round_trip'] == 1 ? " <i class='text-danger glyphicon glyphicon-calendar' style='margin-left:60px;' ></i> 
                                                                                                                      <strong style='font-size:18px; ' title='". lang("a.return") ."' >". convert( $offer['return_date'], lang('lang') ) ."</strong> " : "";

                                                                       echo  "<div class='col-lg-5'> <i class='text-success glyphicon glyphicon-calendar  '></i> 
                                                                                        <strong style='font-size:18px; '  title=' ". lang("a.departure") ."' >". convert( $offer['departure_date'], lang('lang') ) ."</strong> 
                                                                                        $round_trip  
                                                                               </div>";
                                                                       echo  "<div class='col-lg-5'> $val  </div>";
                                                                       echo  "<div class='col-lg-2'> <a class='click' href='$path' style='margin-left:20px;'  ><i class='glyphicon glyphicon-eye-open two'></i> ". lang('a.see-offer') ." </a> </div>";
                                                                    ?>
                                                                </div>
                                                             </div> 
                                                    <? }
                                                 }
                                            ?>

                                          </div>
                                     </div>
                                     <div class='row copy-date' >
                                          <div class='col-lg-12'>
                                            <div class='bs-example'>
                                              <div class='alert alert-dismissable alert-info' style="padding-bottom: 40px;">
                                                       <button type='button' class='close exit-alert' title='<?= lang('close') ?>'>&times;</button>
                                                       <i class='glyphicon glyphicon-calendar'></i>
                                                       <input type='text' class='form-control input-sm datepicker' placeholder='<?= lang("a.calender")?>'  >
                                                       <button type='button' class='btn btn-sm btn-primary  inputSave' data-id='<?= $alert['id'] ?>'  ><?= lang('a.copySave') ?></button>
                                              </div>
                                            </div>
                                          </div> 
                                     </div> 	 
                                </div> 
                 <?     }
                    }
                    else{  ?>
                            <div class="bs-example">
                                <div class="alert alert-dismissable alert-primary">
                                  <h4 > <?= lang("a.hello") . " " . $username ?> ! </h4>
                                  <p><?= lang('a.empty') ?> </p>
                                  <p><?= lang('a.empty2') ?>  <a href="<?= new_url("ara-seyahat") ?>" class="alert-link"> <?= lang("a.search") ?></a> </p>
                                </div>
                            </div>  
                 <?  } ?>
            </div>     
        </div>           
   </div> 
   <script src="<?php  echo  base_url() . 'scripts/partial/alerts.js'  ?>"></script>    
 