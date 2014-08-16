     
      <?    $this->lang->load('main'); ?>
     <!--  Map css  -->
     <?php echo link_tag( base_url() . 'styles/map-main.css'); ?>
 
     <?php
            $this->lang->load('offerinfo');

            // Create date2 only mounth adn year 
            function dateConvertSlider( $date2, $lang ) {   

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
                                       "Tomorrow" => "Yarın",
                                       " days ago " => " gün önce ",
                                       "days later" => " gün sonra " 
                                   );
                   if( strcmp($lang, "tr") == 0 ) 
                        return strtr($date, $aylarIng);// . " " . $date2;
                   else      
                       return $date; 
            }

            // write offer information  
            function writeContent( $offer, $lang ){
                  // offer data
                  $origin      = explode(',',$offer['origin']);
                  $origin      = trim($origin[0]);
                  $destination = explode(',',$offer['destination']);
                  $destination =  trim($destination[0]);  
                  $url_detail  =  new_url( urlCreate( $lang, $origin, $destination,  $offer['ride_offer_id'] ) );
                  $titleO      = $origin;
                  $titleD      = $destination; 
                  if( strlen($origin) > 11 ){
                      $origin =  explode(" ", $origin);
                      $origin = $origin[0];
                      if( strlen($origin) > 11 )
                         $origin = substr($origin,0,10) ."..";
                  }

                  if( strlen($destination) > 11 ){
                      $destination =  explode(" ", $destination);
                      $destination = $destination[0];
                      if( strlen($destination) > 11 )
                         $destination =  substr($destination,0,10) ."..";
                  }

                  
                  
                  // user data           
                  $username = $offer['name'];
                  $date     = date('Y');
                  $age      =  $date - $offer['birthyear'] . lang("age");
                  $alt      = $username ." ". $offer['surname'] ." ( ". $age  ." )" ;
                  $path     = $offer['foto'];
                 // for date  title='".lang("m.departure")."'

                  $val = " <a href='$url_detail' >
                                   <div class='row detail' > 
                                       <div class='col-lg-3' >
                                           <img class='tip pic-img' title='$alt' alt='$alt' src='$path'  width='60' height='70' style='  width: 60px; height: 70px'   >
                                       </div>
                                       <div class='col-lg-8 no-padding direction' >
                                          <div class='row' >
                                             <p > <i class='text-danger glyphicon glyphicon-map-marker' ></i> 
                                                    <strong title='$titleO'  > $origin </strong> → 
                                                    <strong title='$titleD'  > $destination </strong>
                                             </p>
                                           </div>
                                           <div class='row' >
                                               <div class='col-lg-8 no-padding' >
                                                  <p class='date'  ><i class='text-primary glyphicon glyphicon-calendar' ></i> ". dateConvertSlider( $offer['departure_date'], lang('lang') ) ." </p>
                                               </div>
                                               <div class='col-lg-4 no-padding price-info' >
                                                 <div class='price {$offer['price_class']}'   > {$offer['price_per_passenger']} ₺  </div>  
                                               </div>  
                                           </div>    
                                       </div> 
                                         
                                   </div>    
                          </a>"; 
                  return $val;        
            } 

            // write offer most created and most searched
            function writeContentMost( $offer, $text ){
                // data prepare for search link
                $origin            = explode(",", $offer['origin']);
                $origin            = trim( $origin[0] );
                $destination       = "-1";
                $lat               = $offer['lat']; 
                $lng               = $offer['lng']; 
                $dLat              = "-1";  
                $dLng              = "-1"; 
                $originStatus      = "1";
                $destinationStatus = "-1";       
                $path = new_url()."offers/redirect/?origin={$offer['origin']}&lat=$lat&lng=$lng&destination=$destination&dLat=$dLat&dLng=$dLng&originStatus=$originStatus&destinationStatus=$destinationStatus&range=0-2";       
                $val = "<a href='$path' style='display:block' ><strong title='{$offer['origin']} '  >  $origin </strong> <strong style='color: rgba(0, 0, 0, 0.71);' > {$offer['num']}   $text </strong> </a>";
                return $val; 
            }
     ?>
    <!-- container
    ================================== --> 
    <div class="container">
      
      <div class="row">
          <?php 
                  if( isset($val) )
                     echo $val; 
                   $alt = "sd";
          ?> 
      </div>
      <!-- page-header
      ================================== -->
     
      <div >
        <div class="row">
          <div class="col-lg-12">
            <h3 style="text-align: center; font-weight: bold" > <?= lang('m.adres') ?> <?= lang('g.service') ?> </h3>
            <hr>
            <p class="lead"> <i class=" glyphicon glyphicon-search one" > </i>  <?= lang('m.help') ?>   </p>     
          </div>
      </div>
  
      <!-- Navbar
      ================================================== -->
      <div class="bs-docs-section clearfix">
            <div class="row">
                    <div class="col-lg-12">
                            <div class="bs-example">
                                  <div class="navbar navbar-default" style="padding-bottom:10px" >
                                        <div class="col-lg-4">
                                          <!--
                                          <label for="inputStart" class="navbar-brand height-40" style="margin-top:17px; padding: 0 8px;" >  <?= lang('m.start') ?> : </label>
                                          -->
                                          <input id="pac-input" name="inputStart" type="text" class=" form-control" style="margin-top:8px;" placeholder=" <?= lang('m.startlocation') ?> ">
                                        </div>
                                        <div class="col-lg-4">
                                          <!--
                                           <label for="inputStart" class="navbar-brand height-40" style="margin-top:17px; padding: 0 8px;"> <?= lang('m.arrivial') ?> : </label>
                                          -->
                                           <input id="pac-input2" name="inputEnd" type="text" class="form-control " style="margin-top:8px;" placeholder=" <?= lang('m.destinationlocation') ?> ">
                                        </div>
                                        <div class="col-lg-1">
                                          <button id="change-direct"  type="button" class="btn btn-default form-control  margin-6" style="margin-top:8px;" > &#60;   &#62; </button>
                                        </div>
                                        <div class="col-lg-3" >
                                          <button id="search" type="button" class="btn btn-warning margin-6 form-control "  style="margin-top:8px;"> <?= lang('m.search') ?> </button>
                                        </div>
                                   </div><!-- /.navbar -->

                            </div><!-- /example -->
                    </div>
            </div>   

             <?php 
                $countCreated  =  count($mostCreated) ;
                $countSearched =  count($mostSearched);
                if( $countSearched > 0 || $countCreated > 0 ){         ?>
                <div class="row hint" >
                       <div class="col-lg-12 ">
                            <i class="text-primary glyphicon glyphicon-stats three "></i>  
                             <strong> <?= lang("m.statistics") ?>   </strong>
                             <?  if(  $countCreated  > 0 ) {                         ?>
                                    <a href="#" class="tik mostCreated"   > 
                                         <i class="text-success glyphicon glyphicon-map-marker two" ></i>   
                                          <?= lang("m.mostCreated") ?> 
                                    </a>  
                             <? } if(  $countSearched > 0 ){                         ?>
                                    <a href="#" class="tik mostSearched"  > 
                                         <i class="text-danger glyphicon glyphicon-search two" ></i>   
                                          <?= lang("m.mostSearched") ?> 
                                    </a>      
                             <? }                                                          ?> 
                      </div>
                      
                      <?  if(  $countCreated  > 0 ) {                         ?>
                          <div class="row well createdResult" style="display:none; padding: 30px 20px 30px 20px; margin:5px 15px 0px 15px; background-color: #FFFFFF; margin-top:20px" >
                              <div class="col-lg-12" >
                                   <div class="bs-example">
                                     <legend> <?= lang("m.statisticsCreate") ?> <a href="#" class="right mostCreated" title="<?= lang('close')?>" > <i class="glyphicon glyphicon-remove" ></i> </a>    </legend>
                                     <ul class="list-group">
                                          <?  foreach ($mostCreated as  $value) { ?>
                                                <li class='list-group-item  col-lg-4  ' >
                                                    <?= writeContentMost($value, lang('m.created')  )  ?>
                                                </li>
                                          <? }                                    ?>
                                     </ul>
                                   </div>     
                              </div>  
                          </div>    
                      <?  }                                                   ?>
                      <?  if(  $countSearched > 0 ){                          ?>
                            <div class="row well searchedResult" style="display:none; padding: 30px 20px 30px 20px; margin:5px 15px 0px 15px; background-color: #FFFFFF; margin-top:20px" > 
                                <div class="col-lg-12" >
                                      <div class="bs-example">
                                        <legend> <?= lang("m.statisticsSearch") ?>  <a href="#" class="right mostSearched" title="<?= lang('close')?>" > <i class="glyphicon glyphicon-remove" ></i> </a>   </legend> 
                                        <ul class="list-group">
                                             <?  foreach ($mostSearched as  $value) {    ?>
                                                   <li class='list-group-item col-lg-4 ' >
                                                    <?= writeContentMost($value , lang('m.searched') )         ?>
                                                   </li>
                                             <? }                                        ?>
                                        </ul>
                                      </div>     
                                </div>  
                            </div>     
                      <?  }                                                   ?>

                </div>
            <? }     ?> 

            <div class="row" style="display:none "  >
                   <div class="col-lg-12">
                      <!--MAP
                      ============================================-->
                      <div id="map" class="collapse in"  >
                         <div id="map-canvas"></div>
                      </div>   
                   </div>  
           </div>     
      </div>
     
      <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
          <div class="row slide" > 
            
                <?php if(  count($offers['last']) == 4 ){     
                           $offerLast = $offers['last']; 
                ?> 
                  <div class="col-lg-4" >
                     <legend> <?= lang("m.last_activity") ?> </legend> 
                     <div   class="well cycle " style="position: relative; overflow: hidden; ">
                        <div class="content"  style="position: absolute; top: -230px; left: 0px; display: none; z-index: 3; opacity: 1;  ">
                              <?= writeContent( $offerLast[0], lang('lang') ) ?> 
                              <hr>
                              <?= writeContent( $offerLast[1], lang('lang') ) ?> 
                        </div>
                        <div class="content" style="position: absolute; top: -230px; left: 0px; display: none; z-index: 3; opacity: 1;  ">
                              <?= writeContent( $offerLast[2], lang('lang') ) ?>  
                              <hr> 
                              <?= writeContent( $offerLast[3], lang('lang') ) ?> 
                        </div>  
                     </div>
                  </div>  
                <?php  } if(  count($offers['today']) == 4 ){   
                              $offerToday = $offers['today'];     
                ?>        
                  <div class="col-lg-4" >
                      <legend>  <?= lang("m.soon") ?>  </legend> 
                      <div   class="well cycle " style="position: relative; overflow: hidden; ">
                              <div class="content"  style="position: absolute; top: -230px; left: 0px; display: none; z-index: 3; opacity: 1;  ">
                                     <?= writeContent( $offerToday[0], lang('lang') ) ?> 
                                     <hr>
                                     <?= writeContent( $offerToday[1], lang('lang') ) ?> 
                              </div> 
                              <div class="content" style="position: absolute; top: -230px; left: 0px; display: none; z-index: 3; opacity: 1;  ">
                                     <?= writeContent( $offerToday[2], lang('lang') ) ?> 
                                     <hr>
                                     <?= writeContent( $offerToday[3], lang('lang') ) ?> 
                              </div> 
                     </div>
                  </div>  
                <?php  } if(  count($offers['best'])  == 4 ){    
                              $offerBest = $offers['best'];    
                ?>       
                  <div class="col-lg-4" >
                      <legend> <?= lang("m.best") ?>   </legend>  
                      <div   class="well cycle " style="position: relative; overflow: hidden; ">
                            <div class="content"  style="position: absolute; top: -230px; left: 0px; display: none; z-index: 3; opacity: 1;  ">
                                  <?= writeContent( $offerBest[0], lang('lang') ) ?> 
                                  <hr>
                                  <?= writeContent( $offerBest[1], lang('lang') ) ?> 
                            </div>
                            <div class="content" style="position: absolute; top: -230px; left: 0px; display: none; z-index: 3; opacity: 1;  ">
                                  <?= writeContent( $offerBest[2], lang('lang') ) ?> 
                                  <hr>
                                  <?= writeContent( $offerBest[3], lang('lang') ) ?> 
                            </div> 
                      </div>
                  </div>
                <?php  }                                       ?>       
          
          </div>
          
          <div class="row" > 
               
               <p class="col-lg-12"> <?= lang('m.description') ?> </p>
               
          </div>

      </div>     
        
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false&#38;libraries=places"></script>
    <script src="<?php echo   base_url() . 'scripts/partial/map-main.js' ?>"></script> 
 
