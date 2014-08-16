 
<?php
      $this->lang->load('user_sidebar');
      $username = $user['name'];
      $name = $user['name'] . " " . $user['surname'];
      $surname = $user['surname'];
      $date = date('Y');
      $age =  $date - $user['birthyear'] . lang("age");
      $alt = $username ." ". $user['surname'] ." ( ". $age  ." ) " ;
      $path = $user['foto'];
      $lang = $this->lang->lang();
      echo link_tag( base_url('styles/side_bar.css') );  
      echo link_tag( base_url('styles/dashboard.css') );            
?>

    <div class="row row-side" style="padding-left: 0px;" >
        <div class="well">
              <div class="bs-example form-horizontal">
                <fieldset class="experiance-area">
                      <div class="col-lg-3">
                            <div class="col-lg-5" style="padding-top: 20px;" >
                               <?php 
                                  if( $user['foto'] == "-1" )
                                     echo "<div class='blank-user' ><a href='". new_url("profil/profile/foto") ."'>". lang("d.add-photo") ."</a></div>";      
                                  else{
                                       $val ="<a href='". new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ."'> 
                                                <img class='pic-img' alt='$alt' title='$alt' src='$path'  width='80' height='100' style='width:80px; height:100px;' >
                                              </a>";
                                       echo $val;       
                                    }  
                               ?>
                            </div>
                            <div class="col-lg-7"  style="padding-top: 35px;" >
                                  <div class="name" ><?= lang("d.hello") . " " . $user['name'] ?></div>
                                  <div><a class='click' href="<?= new_url("profil/profile") ?>" > → <?= lang("d.edit-profile") ?>  </a></div>
                            </div>   
                      </div>
                      <div class="col-lg-9">
                          <div class="row" >
                                 <h3 id="progress-basic"> <?= lang("d.level") ?>  <?=  ( strcmp(lang("lang"), "tr") == 0 ) ? $user['tr_level'] : $user['en_level'];  ?> </h3>
                                 <ol class="progtrckr" data-progtrckr-steps="5" data-level="<?= $user['level'] ?>">
                                     <li class="progtrckr-todo "><?= lang("d.beginner") ?></li><!--
                                     --><li class="progtrckr-todo"><?= lang("d.intermediate") ?></li><!--
                                     --><li class="progtrckr-todo"><?= lang("d.experienced") ?>  </li><!--
                                     --><li class="progtrckr-todo"><?= lang("d.expert") ?></li><!--
                                     --><li class="progtrckr-todo"><?= lang("d.ambassador") ?></li>
                                 </ol>
                                 <div class="bs-example" style="padding-top:14px; padding-right: 40px;" data-progtrckr-steps="5">
                                   <div class="progress" >
                                     <div class="progress-bar" style="margin-right: 10px;  width: <?= $user['level_percent']?>%;"></div><span class="arrow-level" ></span> <?= (  $user['level_percent'] < 66 ) ? lang("d.level-complete") : ""; ?>  % <?= $user['level_percent']?>
                                   </div>
                                 </div>
                          </div>
                          <div class="row" style="text-align:right;" >
                               <a class="click" href="<?= new_url("application/level") ?>"> <?= lang("d.how-level") ?> </a>
                          </div>       
                      </div>
                </fieldset>
              </div>
        </div>
    </div>               

    <div class="row row-side" style="margin-top:15px" >
       <div class="col-lg-4">
          
          <div class="row" >
            <div class='row row-side '>
                <div class='well trip-content'>
                      <fieldset class='content-side'>
                            <div class='row row-side '  >
                                <div class='row row-side  driver-header'>
                                     <h4 class='driver-h' ><?= lang("d.links") ?></h4>
                                </div>
                                <div class='row row-side verification '>
                                      <div class='text-verified '> 
                                         <a class='click'  href='<?= new_url("review/leaveRating") ?>'>  →  <?= lang("d.leave-rating") ?> </a> 
                                      </div>
                                </div>  
                                <div class='row row-side verification '>
                                      <div class=' text-verified '> 
                                         <a class='click'  href='<?= new_url("user/show/". urlencode( base64_encode($user['id']))  ) ?>'>  →  <?= lang("d.view-profile") ?> </a> 
                                      </div>
                                </div>
                            </div>      
                      </fieldset>
                </div>
            </div>      
          </div>
          
          <div class="row" >
             <?php
                $val ="<div class='row row-side '>
                             <div class='well trip-content'>
                                    <fieldset class='content-side'>";
                                          $prference = "<div class='row row-side '  >
                                                             <div class='row row-side'>
                                                                  <h4 class='driver-h' > ". lang("d.preference") ." </h4>
                                                             </div> 
                                                             <div class='row row-side' style='font-weight:bold; font-size:18px;'>
                                                                   <div class='row row-side prf-container '> ";                          
                                                                        $test = "rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc '&gt;  &lt;strong class='green'  &gt; TEST &lt;/strong&gt;  TEST &lt;/span&gt;\" data-trigger='hover' data-html='true'"; 
                                                                        $chat  = ($user['like_chat']  != "1") ? ( ($user['like_chat']  == "0" ) ? "no" : "yes") : "" ; 
                                                                        $smoke = ($user['like_pet']   != "1") ? ( ($user['like_pet']   == "0" ) ? "no" : "yes") : "" ;
                                                                        $pet   = ($user['like_smoke'] != "1") ? ( ($user['like_smoke'] == "0" ) ? "no" : "yes") : "" ;
                                                                        $music = ($user['like_music'] != "1") ? ( ($user['like_music'] == "0" ) ? "no" : "yes") : "" ; 
                                                                        if( strcmp("", $chat)  != 0 )
                                                                           $prference .=  "<span  class='tip chat_$chat   ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$chat   ."'&gt;  ".lang("sd.chat-" .$chat )  ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                        if( strcmp("", $music) != 0 )
                                                                           $prference .=  "<span  class='tip music_$music ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$music  ."'&gt;  ".lang("sd.music-" .$music ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                        if( strcmp("", $smoke) != 0 )
                                                                           $prference .=  "<span  class='tip smoke_$smoke ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$smoke  ."'&gt;  ".lang("sd.smoke-" .$smoke ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                        if( strcmp("", $pet  ) != 0 )
                                                                           $prference .=  "<span  class=' tip pet_$pet    ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$pet    ."'&gt;  ".lang("sd.pet-" .$pet )   ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";  
                                                                
                                              $prference .=  "</div>";
                                              $prference .=  "<div class='row row-side verification'>
                                                                  <div class=' text-verified '> 
                                                                     <a class='click'  href='".new_url("profil/profile/preference")."'>  →  ".lang("d.edit-preference")."</a> 
                                                                  </div>
                                                              </div>             
                                                        </div>";
                                           $val .= $prference;   


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
                                                  else{
                                                           $email = "<div class='row row-side verification '>
                                                                       <a class='click'  href='". new_url("profil/profile/verification") ."'>
																	    <i class='col-xs-1 text-primary glyphicon text-warning' style='width: 1em;  font-weight:bold;' >@</i> 
                                                                        <div class='col-xs-8 text-verified text-warning'> 
                                                                              ".  lang("d.email-not")  ."
                                                                        </div>
                                                                        <i class='col-xs-2 not-validated'></i> 
                                                                       </a>  
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
                                                  else{
                                                          $phone = "<div class='row row-side verification'>
                                                                      <a class='click'  href='". new_url("profil/profile/verification") ."'>
																	      <i class='col-xs-2 text-warning  glyphicon glyphicon-phone '></i> 
                                                                          <div class='col-xs-8 text-verified text-warning'> 
                                                                               ".  lang("d.phone-not")  ."
                                                                          </div>
                                                                          <i class='col-xs-2 not-validated'></i> 
                                                                      </a>    
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
                                                   else{
                                                        $face = "<div class='row row-side verification'>
                                                                        <a class='click'  href='". new_url("profil/profile/verification") ."'>
																	      <i class='col-xs-2 text-warning  glyphicon icon-facebook ' style='height: 23px; width:1em; margin-top:5px'></i> 
                                                                          <div class='col-xs-8 text-verified text-warning'> 
                                                                             ".  lang("d.friends-not")   ." 
                                                                          </div>
                                                                          <i class='col-xs-2 not-validated'></i>   
                                                                        </a>  
                                                                  </div>";
                                                        $verifications[] = $face;          
                                                   }                
                                     if( count($verifications) > 0 ){
                                          $result = "<div class='row row-side verified-title'  >
                                                       <div class='row row-side'>
                                                            <h4 class='driver-h' > ". lang("d.verification") ." </h4>
                                                       </div>"; 
                                                       foreach ($verifications as $value)
                                                            $result .= $value;
                                                        
                                                        $result .= "<div class='row row-side verification'>
                                                                         <div class=' text-verified '> 
                                                                            <a class='click'  href='". new_url("profil/profile/verification") ."'>  →  ".lang("d.edit-verify")."</a> 
                                                                        </div>
                                                                   </div>";             
                                           $result .="</div>";
                                           $val .= $result;  
                                     }
                                                

                                     $val .="<div class='row row-side verified-title' >
                                                    <div class='row row-side'>
                                                         <h4 class='driver-h' >". lang('d.activity') ."</h4>  
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

                                             </div>";

                                         if( $user['cars'] ){    
                                            foreach ($user['cars'] as $car) {
                                                $val .="  <div class='row row-side verified-title' >
                                                                <div class='row row-side'>
                                                                    <h4 class='driver-h' >". lang('d.car') ."</h4>  
                                                                </div>
                                                                <div class='row row-side'>
                                                                    <div class='col-lg-5 no'>
                                                                        <img src='". base_url("cars/" .$car['foto_name']) ."' width='100' height='100' class='user-car pic-img'> 
                                                                    </div>
                                                                            <div class='col-lg-7 no'>
                                                                          <div class='row row-side'>
                                                                                ". lang("d.make") . $car['make']  ." </div>
                                                                                  <div class='row row-side'>
                                                                              ". lang("d.model")  . $car['model'] ." </div>
                                                                                  <div class='row row-side'>
                                                                               <span title='" . lang("d.comfort") ."' class='tip rating-car star_".$car['comfort']." '></span> </div>
                                                                    </div>
                                                                </div>
                                                                <div class='row row-side verification'>
                                                                    <div class=' text-verified '> 
                                                                       <a class='click'  href='".new_url("profil/profile/cars")."'>  →  ".lang("d.edit-car")."</a> 
                                                                    </div>
                                                                </div>     
                                                            </div>";
                                                 break;             
                                            }               
                                         }                    
                             $val.="</fieldset>
                             </div>  
                         </div>";
                  echo $val;
              ?>
           </div>  
       </div>   
       <div class="col-lg-8 no-padding" style="padding-left:10px" >
            <div class='row row-side '>
                <div class='well trip-content'>
                      <fieldset class='content-side'>
                          
                          <legend><i class="text-info glyphicon glyphicon-bell" ></i> <?= lang("d.notify")   . " (" . ( (count($alert) > 0) ? "1" : "0") .")" ?>  </legend> 
                          <div class="row font-content" >
                              <?php  
                                     // Alert message with full width
                                     function alertDas($content, $id, $type = "warning" ){
                                          $val= " <div class='col-lg-12'>
                                                            <div class='alert alert-dismissable alert-$type'>
                                                               <button type='button' class='close' title='".lang("close")."'  data-dismiss='alert'>&times;</button>
                                                               <strong>". lang("d.please") ." </strong>". $content ." <br> " . lang("d.action") ."
                                                               <a id='".$id."' class='click' href='#'>". lang("d.click") ."</a>
                                                            </div>
                                                  </div> ";
                                          return $val;                
                                    }

                                    if( count($alert) == 0 ){
                                          echo alertWide("info", "",lang("d.no-notify") ); 
                                    }else if(  $alert['arac'] == 0 &&  $alert['arac_again'] == 1 ){
                                          $val= " <div class='col-lg-12'>
                                                            <div class='alert alert-dismissable alert-warning'>
                                                               <button id='no_car' type='button' class='close' title='". lang("d.no-car") ."' >&times;</button>
                                                               <strong>". lang("d.please") ."</strong> ". lang("d.arac") ."  " . lang("d.action") ."
                                                               <a id='car_notify' class='click' href='#'>". lang("d.click") ."</a> 
                                                            </div>
                                                          </div> ";
                                          echo $val;          
                                    }else if(  $alert['tercih'] == 0 ){
                                      echo alertDas( lang("d.tercih"), "tercih" );
                                    }else if(  $alert['bio']== 0 ){
                                      echo  alertDas( lang("d.bio"), "bio" );
                                    }else if(  $alert['photo'] == 0  ){
                                       echo  alertDas( lang("d.photo"), "photo" ); 
                                    }else if(  $alert['phone'] == 0 ){
                                       echo  alertDas( lang("d.phone"), "phone" ); 
                                    }else if(  $alert['email'] == 0 ){
                                       echo  alertDas( lang("d.email"), "email" );
                                    }else if(  $alert['face'] == 0 ){
                                       echo  alertDas( lang("d.face"), "face" );
                                    }
                                    else if(  $alert['extra_read'] == 0 ){
                                          $val= " <div class='col-lg-12'>
                                                            <div class='alert alert-dismissable alert-info'>
                                                               <button id='extra' title='". lang("d.okudum") ."' type='button' class='close'>&times;</button>
                                                               <strong>".  ( (strcmp( lang("lang"), "tr" ) == 0 ) ? $alert['extra_tr'] : $alert['extra_en'] )  ." <br>
                                                            </div>
                                                          </div> ";
                                          echo $val;             
                                    }
                              ?>
                          </div>
                           

                          <? if( count( $warnings ) > 0 ){  ?>
                         
                          <?   foreach ($warnings as   $warn) {
                               
                                   if( strcmp($warn['type'], "warning") == 0 ){
                                       $type       = "warning-sign";
                                       $colour     = "warning";
                                       $alert_type = "warning"; 
                                   }else if( strcmp($warn['type'], "info") == 0 ){
                                        $type        = "info-sign";
                                        $colour      = "primary";
                                        $alert_type  = "info";
                                   }else { 
                                          $type        = "envelope";
                                          $colour      = "primary";
                                          $alert_type  = "info";
                                   }
                                   $crypted_id = my_encode( $warn['id'] );
                                   $warn_text = (strcmp(lang('lang'), "tr") == 0 ) ? $warn['warning'] : $warn['warning_en'];   ?>
                                 
                                  <div  class="row row-side warn-close">
                                        <legend><i class="text-<?= $colour ?> glyphicon glyphicon-<?= $type ?>" ></i> <?= lang("d." . $warn['type'] )  ?>  </legend> 
                                        <div class="row font-content" >
                                               <div class='col-lg-12'>
                                                        <div class='alert alert-dismissable alert-<?= $alert_type?>' data-id="<?= $crypted_id ?>" >
                                                            <strong> <?= lang("d.hello") . $username   ?> !</strong> 
                                                            <a class='right readed-warning' title='<?= lang("d.okundu") ?>' href='#'  > <i class="three glyphicon glyphicon-remove" ></i> </a> 
                                                            <hr>
                                                            <?= $warn_text ?>
                                                             <p style="margin-top:15px; text-align:right; font-size:13px; font-style:italic" > <?= dateConvert2($warn['created_at'], lang('lang') ) ?> </p>
                                                        </div> 
                                              </div>
                                        </div>
                                  </div>
                              <?}   // end of the foreach   ?>
                          <?}    // end of the if      ?>
 
                          <legend><i class="text-danger glyphicon glyphicon-envelope" ></i> <?= lang("d.message")   . " (" . ($messagesSent['number'] + $messagesInbox['number']) .")" ?>  </legend> 
                          <div class="row font-content" >
                             <?php    
                                    if(  $messagesInbox['number'] > 0 ){
                                       echo "<div > ".  sprintf( lang("d.message-have") , $messagesInbox['number']) ." 
                                                 <a class='click' href='". new_url("message")  ."'>  → ". lang("d.inbox") ."</a> </div>";
                                       echo "<br>"; 
									}
                                    
                                    if(  $messagesSent['number'] > 0 ){
                                        echo "<div> ".  sprintf( lang("d.message-have-answer") , $messagesSent['number']) ."
                                                  <a class='click' href='".  new_url("message/send") ."'>  →". lang("d.sent") ."</a> </div>";
                                        echo "<br>";   
                                     }  

                                    if( $messagesInbox['number'] == 0  && $messagesSent['number'] == 0 ){
                                        echo alertWide("info", "", lang("d.no-message") ); 
                                        echo "<br>";
									}
                             ?>
                          </div>
                          <legend><i class="text-warning glyphicon glyphicon-briefcase" ></i> <?=  sprintf(lang("d.last-offers"), count($last_offers)) ?>  </legend> 
                          <div class="row font-content" >
                             <?php    
                                     // Show offer
                                     function showOffer($origin, $destination, $date, $link ){
                                     	   $org = explode(',', $origin);
										   $dst = explode(',', $destination);
										   // lang("d.show") ." ". lang("d.click") ."
                                           $val= " <div class='col-lg-12'>
                                                             <div class='alert alert-dismissable alert-success'>
                                                                <button type='button' class='close' title='".lang("close")."' data-dismiss='alert'>&times;</button>
                                                                <a class='click' href='". $link ."' title='" .$origin ." → ". $destination ."' >
                                                                     <strong> ". $org[0] ."  </strong>  →
                                                                     <strong> ". $dst[0] ."  </strong>
                                                                 </a>
                                                                 <strong style='float:right' > ". $date  ."  </strong> 
                                                             </div>
                                                           </div> ";
                                           return $val;                
                                     }
                                     if( count($last_offers)  > 0 ){
                                           foreach ($last_offers as $value) {
                                              $origin      = $value['origin']; 
                                              $destination = $value['destination'];
                                              $date = dateConvert3($value['created_at'], lang("lang"));
                                              $lang = lang("lang");
                                              //$offer_id = $value['ride_offer_id'];
                                              
                                              $link  = new_url(  $value['path'] );
                                              echo showOffer( $origin, $destination, $date , $link );
                                           }
                                     }else{
                                          echo alertWide("info", "", lang("d.no-offer") );
                                     }     
                                 
                              ?> 
                          </div> 
                      </fieldset>
                </div>
            </div>             
       </div>
   </div>               
    <script src="<?php echo   base_url() . 'scripts/partial/profil/dashboard.js'  ?>"></script> 
   