
    <?    $this->lang->load('offer'); ?>
    <!-- container
    ================================== --> 
     <!--  Map css  -->
      <?= link_tag( base_url('styles/map-main.css')     ); ?>
      <?= link_tag( base_url('styles/offer-detail.css') ); ?>
      
     <script type="text/javascript">    <?= offerRideError() ?> </script>
    <div class="container">

    <!--AÇıklama
    ============================================-->   
     <div class="row  ">
          <?php
                  if( $own_offer )                                    // write offer manage content   
                     echo manageOffer( $offer ); 
                  
                  $origin = explode(',',$offer['origin']);            // get origin name before comma
                  $origin = $origin[0];                              
                  $destination = explode(',',$offer['destination']);  // get destination name before comma
                  $destination = $destination[0];   
          ?>
          <br>
          <div class='col-lg-12'>
                <div class="bs-example ">
                        <div class="navbar navbar-default" >
                            <div class="container-nav" > 
                                  <? "Offer id : " .  base64_decode(  urldecode( $offer['id'] ) )  ?>
                                  <h4 class="trip"> <?= $origin   ."→". $destination . lang("od.nav") . $user["name"] ." ". $user['surname'] . lang("od.nav2")  . $offer["price_per_passenger"] ?>₺  </h4> 
                            </div>
                             <div class="ok">
                            </div>       
                    </div><!-- /.navbar -->
                </div>      
          </div> 

          <div class="col-lg-8 ">
                <div class="well">
                    <form class="bs-example form-horizontal">
                        <fieldset>
                                  <legend>  
                                            <?php   
                                                 $oneway = "<i class='text-primary glyphicon glyphicon-arrow-right icon4' title='".lang('io.titleonetime')."'></i>";
                                                 $twoway =" <i class='text-primary glyphicon glyphicon-arrow-left icon1'  title='". lang('io.titletwoway') ."'></i>
                                                            <i class='text-primary glyphicon glyphicon-arrow-right icon2' title='". lang('io.titletwoway') ."'></i> ";
                                                 $rutin  = " <i class='text-primary glyphicon glyphicon-retweet icon4 ' title='".lang('io.titlerutin')."'></i>";      
                                                 $val    =   ($offer['trip_type'] == "1") ?  $rutin : ""; 
                                                 $val   .=   ($offer['round_trip'] == "1") ?  $twoway : $oneway;   
                                                 echo $val;                                                     
                                            ?>
                                            <strong style="font-size:15px;" > 
                                            <?php 
                                                 if( !$is_reverse )  
                                                     echo wayPoints($offer); 
                                                 else
                                                     echo wayPointsReverse($offer);   
 
                                            ?>
                                           </strong>
                                           <a href='#' > <i title="<?= lang("od.map") ?>"  class='glyphicon glyphicon-eye-open icon3 one right show-map'></i> </a>
                                           <?php 
                                              if( $offer['round_trip'] == 1 ){
                                                 /*	  
                                                 $offer_id = $offer['no_encryp_id'];
                                                 $lang = lang('lang');
                                                 $originU = $destination;
                                                 $destinationU = $origin;
                                                 $path = new_url(urlCreate( $lang, $originU, $destinationU, $offer_id )) ;
                                                 echo "<a href='$path' > <i title='".lang("od.reverse")."'   class='glyphicon glyphicon-share-alt icon3 one right'></i> </a>";
                                                 */
											  } 
                                           ?>
                                           
                                  </legend>        
                                
                                 <!-- 3. panel 
                                 ====================================-->
                                 <div class="panel panel-default trip-container">
                                       <div class="panel-body" style="padding:30px;">
                                          <!--Trip route content
                                          ================================= -->
                                          <div class="row row-side hover-pointer">
                                                       <div class="row row-side show-map alt-cizgi" >
                                                          <label class="col-lg-4 text-right ">  
                                                            <?= lang("od.departure")  ?> </label>
                                                          <div  class="col-lg-8 text-left point-departure">  
                                                            <?=  $offer['origin'] ?> </div>
                                                       </div>   
                                                       <div class="row row-side show-map alt-cizgi"    >
                                                            <label class="col-lg-4 text-right ">
                                                               <?= lang("od.arrivial") ?> </label>
                                                            <div  class="col-lg-8 text-left point-arrivial"> 
                                                               <?= $offer['destination'] ?> </div>
                                                       </div>
                                          </div>

                                          <!--Trip date content
                                          ================================= -->
                                          <div class="row row-side">
                                            <?= tripDateContent( $offer, $this->lang->lang() )  ?>
                                          </div> <!-- date content finish -->
                                        
                                          <div class="row row-side one more-detail" >
                                               <div class="row row-side" >
                                                     <div class="col-lg-12">
                                                           <?= detailMissing($offer, $own_offer, $user)  ?>
                                                     </div> 
                                               </div>       
                                               <div class="row row-side no-padding5" >
                                                       <div class="col-lg-9 ">
                                                                 <?php
                                                                    $time = ( strcmp($this->lang->lang(), "en") == 0 ) ? "timeen" : "time";
                                                                    $size = ( strcmp($this->lang->lang(), "en") == 0 ) ? "sizeen" : "size";
                                                                 ?>
                                                                 <div class="row row-side">
                                                                      <label class="col-lg-7 control-label"> <?= lang('o2.movetime')      ?> : </label>
                                                                      <label class="col-lg-5 no-padding text-left" style="padding-top: 9px;"> <?= $offer['leave_time'][$time]; ?> </label>
                                                                 </div>
                                                                 <div class="row row-side">
                                                                      <label class="col-lg-7 control-label"> <?= lang('o2.luggagesize')   ?> : </label>
                                                                      <label class="col-lg-5 no-padding text-left" style="padding-top: 9px;"> <?= $offer['luggage'][$size]; ?>  </label>
                                                                 </div>
                                                                 <div class="row row-side">
                                                                      <label class='col-lg-7 control-label'> <?= lang('od.car') ?> : </label>
                                                                      <label class="col-lg-5 no-padding text-left " style="padding-top: 9px;"> 
                                                                           <span title='<?= lang("od.comfort" .  $offer['car']['comfort'] ) ?>' class='tip rating-car star_<?=  $offer['car']['comfort'] ?>'></span> 
                                                                           <?= $offer['car']['make'] ." ". $offer['car']['model']; ?>  
                                                                      </label>
                                                                 </div> 
                                                        </div>
                                                        <div class="col-lg-3">
                                                               <?php
                                                                     if(  strcmp($offer['car']['foto_name'], "car.png") != 0  ){
                                                                         $comfort = lang("od.comfort" .  $offer['car']['comfort'] );
                                                                         echo "<img title='$comfort'  src='". base_url('cars/' . $offer['car']['foto_name']) ."' width='100px' height='100px' >";
                                                                     }
                                                                     else if( $own_offer )
                                                                            echo "<div class='blank-car' ><a href='". new_url('car/upload/'.  urlencode(base64_encode( $offer['car']['id'] )))  ."'>". lang("od.addcar") ."</a></div>";      
                                                                ?> 
                                                        </div>
                                                </div>
                                          </div>

                                          <div class="row row-side right one" >
                                              <label>
                                                    <?= lang("od.create") . date("d-m-Y", strtotime($offer['created_at']))  ." - ". lang("od.seen") . $offer["look_count"]['look']  . lang("od.seen2") ?>
                                                     <?php
                                                            // kullanıcınn kendi teklifi  
                                                            if( $own_offer ){  
                                                                  echo "<a href='". new_url('offer/showList/'.$offer['id'] )  ."'> (". lang("od.visitor") .")</a>"; 
                                                            }
                                                     ?>       
                                              </label>
                                          </div>
                                       </div><!-- Panel body end-->
                                </div> <!-- 1. panel sonunu--> 
                                


                                  <!--Map content
                                  ================================= -->
                                  <div class="panel panel-default " id="iteneraryPanel" >
                                      <div class="panel-body"  >
                                              <div class="col-lg-12 " >   
                                                  <legend> 
                                                           <?= lang('o.travelroute') ?>
                                                            <a href='#' > <i title="<?= lang("od.maphide") ?>"  class='glyphicon glyphicon-remove icon3 one right hide-map'></i> </a> 
                                                  </legend>
                                                  <div id="map" class="collapse in" style="height:250px">
                                                     <div id="map-canvas" style="height:250px"></div>
                                                  </div>
                                                  <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                          <div class="row row-side"> 
                                                              <div class="col-lg-8">
                                                                 <h3 class="panel-title"> <?=lang('o.tripinfo')?> </h3>
                                                              </div>
                                                          </div>
                                                        </div>
                                                        <div class="panel-body" >
                                                               <div id="total" class="form-group form-padding"> </div>
                                                               <div id="realDistance" class="form-group form-padding" ></div>
                                                        </div>
                                                  </div>

                                              </div> 
                                      </div>
                                  </div>
 
                          <fieldset>
                    </form>
               </div>
          </div>

          <!--User information
          ============================================-->        
          <div class="col-lg-4 "  >
            
                 <div class="row row-side travel-info">
                       <div class="well trip-content">
                            <div class="price-container">
                                 <span class="big-price <?= $offer['price_class']?>"  rel="popover" data-placement="top" data-content="&lt;span class='row row-side popover-desc '&gt;  &lt;strong class='green'  &gt;<?=  lang("od.green")  ?>&lt;/strong&gt;<?=  lang("od.low")    ?>&lt;/span&gt; 
                                                                                                                                       &lt;span class='row row-side popover-desc '&gt;  &lt;strong class='orange' &gt;<?=  lang("od.orange") ?>&lt;/strong&gt;<?=  lang("od.normal") ?>&lt;/span&gt;
                                                                                                                                       &lt;span class='row row-side popover-desc '&gt;  &lt;strong class='red'    &gt;<?=  lang("od.red")    ?>&lt;/strong&gt;<?=  lang("od.high")   ?>&lt;/span&gt;
                                                                                                                                       " data-original-title=""  data-trigger="hover" data-html="true" > <?= $offer['price_per_passenger'] ?>₺</span> <?= lang("od.price") ?>
                            </div>
                            <div class="seat-container clearfix">
                                    <div class="clearfix seat-available "> <span>  <?= $offer['number_of_seats'] ?> </span> <?= lang("od.seat") ?> </div>
                                    <ul class="unstyled list-seats" >
                                            <?php
                                                   $username = $user['name'];
                                                   $date = date('Y');
                                                   $age =  $date - $user['birthyear'] . lang("od.age");
                                                   $alt = $username ." ". $user['surname'] ."(". $age  .")" ;
                                                   $path = $user['foto'];
                                            ?>
                                            <li class="<?=  ($user['sex'] == 1 ) ? "man-driver" : "woman-driver" ?>" rel="popover" data-placement="top" data-content="&lt;img class='tip' title='<?= $alt ?>' alt='<?= $alt ?>' src='<?= $path ?>' width='60' height='70' style='width: 60px; height: 70px' /&gt;&lt;span class='popover-desc '&gt;&lt;strong&gt;<?= $username ?>&lt;/strong&gt; <?= $age ?> &lt;/span&gt;" data-original-title=""  data-trigger="hover" data-html="true"></li>
                                            <?php 
                                                    for ($i=0; $i < $offer['number_of_seats']; $i++) 
                                                            echo  "<li class='empty-seat'></li> ";
                                            ?> 
                                    </ul>  
                            </div>
                            <div class="booking-container">
                                     <div>  
                                           <label> <?= lang("od.book") ?></label>
                                     </div> 
                                    <button class=" btn-lg btn-2action width-250" id="sendMessage" href="#<?= ( $this->session->userdata("logged_in") == 1 ) ? "contact-driver-modal" : "login" ?>" data-toggle="modal" > <?= lang("od.contact") ?></button>  
                            </div> 
                       </div>
                 </div>     
                 <?php 
                       $this->lang->load('user_sidebar'); 
                       echo getSideBar( $user, lang("od.driver") ,$this->lang->lang() ); 
                 ?>                         
          </div>                  

      </div>

      <!--- Contact driver modal
      ===============================================================-->
      <div id="contact-driver-modal" class="modal fade" tabindex="-1" data-id="-1";  data-width="600" data-height="340" data-backdrop="static" data-keyboard="false" style="display: none;">
             <div class="modal-my-header">
               <button type="button" class="close" data-dismiss="modal" title="<?= lang("close")?>"  aria-hidden="true">&times;</button>
               <h4 class="modal-title"> <?= lang("od.contactto")  ."  " . $username . " " . $user['surname'] ?>  </h4>
             </div>
             <div class="modal-body">
                   <h4 class="row row-side" ><?= lang("od.private-message") ?></h4>
                   <div class="row row-side">
                         <div  class="msg-comment">
                               <?php 
                                      if( ! $own_offer ){
                                           echo   " <textarea  id='inputMessage' class='form-control' rows='3' style='max-width: 390px; max-height:100px; margin-bottom:10px' id='textArea'></textarea> " .
                                                  " <button id='send-message' type='button' class='btn btn-primary  btn-sm width-100' data-id='". $this->encrypt->encode($user['user_id']) ."' data-offer_id='". $offer['id'] ."'   >". lang('od.send') ."</button> ";
                                      }
                                      else{
                                           echo  "  <div class='alert alert-dismissable alert-danger'>
                                                       <strong>". lang("od.sory") ."!</strong> ". lang("od.send-error") ."
                                                     </div>
                                                   ";
                                      } 
                                ?>
                         </div>
                         <div class="col-xs-3 msg-photo-container">
                               <a href='<?= new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ?>'> 
                                    <img class='tip' title='<?= $alt ?>' alt='<?= $alt ?>' src='<?= $path ?>' width='90' height='100' style='float: right;  width: 90px; height: 100px' >
                               </a>  
                        </div>
                   </div>
                   <div class="row row-side" style="margin:10px">
                            <div class='alert alert-dismissable alert-info'>
                                <strong><?= lang("od.tebrik") ?></strong> <?= lang("od.goodstep") ?>
                            </div>
                   </div>      
             </div>
      </div> 


      <!-- Delete offer modal
      ===============================================================--> 
      <div id="delete-modal" class="modal fade" tabindex="-1" data-id="-1"; data-backdrop="static" data-keyboard="false" style="display: none;">
             <div class="modal-body">
                   <p><?= lang("io.commit") ?></p>
             </div>
             <div class="modal-footer">
                   <button type="button" data-dismiss="modal" class="btn width-100"><?= lang("g.cancel") ?></button>
                   <button type="button" data-dismiss="modal" class="btn btn-primary width-100"><?= lang("g.yes") ?></button>
             </div>
      </div>  
      <!-- Modal Sending
      =====================================================-->
      <div id="sending" class="modal fade" style=" border-radius: 16px;" tabindex="-1" data-width="400" data-height="150" data-backdrop="static"  style="display: none;">
          <div class="well" style=" border-radius: 16px; margin-bottom: 0px !important; margin-right: 0px; margin-left: 0px; ">
                               <fieldset style="font-size:20px; padding-bottom:10px; padding-left: 40px; ">
                                    <div class="row row-side">
                                          <?=lang("oi.sending")?>
                                         <img src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >
                                       </div>
                                       <div class="row row-side">
                                        <strong class="text-primary"> <?=lang("g.wait")?></strong>
                                       </div>
                               </fieldset>
          </div>  
      </div><!-- END of the Modal Sending -->

     <!-- </div> Containers ending after the footer    -->
     <!-- End of the container
     ================================== --> 
    <?php       // for javascript map   
                $waypoints =  $offer['way_points'];                    
                $str_way = "";
                if(  count($waypoints) > 0  ){                                  // check count of way_points 
                    if( !$is_reverse ){ 
                           if( count($waypoints ) == 2 ){                            // there is only one waypoint  
                                 $str_way .= $waypoints[0]['arrivial_place'];
                           }
                           else{                                                     // there are a lot of  waypoints more than at lease 2  
                                $count = count($waypoints); 
                                $str_way .= $waypoints[0]['arrivial_place'] . '?';   // question mark is using for split on view page   
                                for ($i=1; $i < $count - 1 ; $i++) { 
                                      $str_way .= $waypoints[$i]['arrivial_place'] . '?';  // question mark is using for split on view page
                                 } 
                           }
                    }
                    else{
                           if( count($waypoints ) == 2 ){                            // there is only one waypoint  
                                 $str_way .= $waypoints[0]['arrivial_place'];
                           }
                           else{                                                     // there are a lot of  waypoints more than at lease 2  
                                $count = count($waypoints); 
                                $str_way .= $waypoints[$count - 1]['departure_place'] . '?';   // question mark is using for split on view page   
                                for ($i= $count - 2; $i > 0 ; $i--) { 
                                      $str_way .= $waypoints[$i]['departure_place'] . '?';  // question mark is using for split on view page
                                 } 
                           } 
                    }
                }   
    ?> 
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false&#38;libraries=places"></script>
    <script type="text/javascript">  
         var pointsSession = '<?=  $str_way?>', startSession = '<?=  $offer["origin"]?>',endSession = '<?=  $offer["destination"]?>',login = '<?=  ($this->session->userdata("logged_in") == 1) ? 1 : 0 ?>'; er.blank_date = '<?=  lang("o.blank_date")?>'; er.same_date = '<?=  lang("o.same_date")?>';   
    </script>
    <script src="<?php echo   base_url() . 'scripts/partial/offer-detail.js'  ?>"></script>  
