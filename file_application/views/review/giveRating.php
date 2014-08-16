  <script type="text/javascript" src="<?= base_url('styles/rating/prototype.lite.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('styles/rating/stars.js')   ?>"></script>
  <?=link_tag( base_url('styles/rating/stars.css') ); ?>
  <style type="text/css">
     .border{   border-left: 1px solid #cbcbb6;
                -webkit-box-shadow: #fff 1px 0 0;
                -moz-box-shadow: #fff 1px 0 0;
                box-shadow: #fff 1px 0 0;
                padding-left: 25px;       }
      .block{   border: 1px solid #CCC;
                float: left;
                max-width: 500px;
                margin-left: 20px;
                padding: 9px;  }           
              
  </style> 
  <?php
      $username =  $user['name'];
      $date     =  date('Y');
      $age      =  $date - $user['birthyear'] . lang("r.age");
      $alt      =  $username ." ". $user['surname'] ." ( ". $age  ." ) " ;
      $path     =  $user['foto'];     
  ?>
        <div class="row">
              <div class="well " style="padding:20px 50px 40px 40px;" >
                    <legend>  <?= lang("r.share") ?>  </legend>
                    <form class="bs-example form-horizontal">
                          <div class="form-group">
                              <div class="col-lg-3 ">
                                  <label class="control-label"> <?= lang("r.trip-info") ?> </label>
                                  <div class="radio">
                                    <label>
                                       <input type="radio" name="people" class="people" id="optionsRadiosPassenger" value="1" "">
                                       <?= sprintf( lang("r.passenger"), $user['name'] ) ?>
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                       <input type="radio" name="people" class="people" id="optionsRadiosDriver" value="2">
                                       <?= sprintf( lang("r.driver"), $user['name'] ) ?> 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                       <input type="radio" name="people" class="people" id="optionsRadiosNon-pass-driver" value="3">
                                       <?=   sprintf( lang("r.non-pass-driver"), $user['name'] ) ?> 
                                    </label>
                                  </div>
                              </div>
                          
                              <div class="col-lg-8 border" style="padding-top: 20px; "  >
                               <?php
                                       $this->lang->load('user_sidebar');
                                       $name = $user['name'] . " " . $user['surname'];
                                       $val =  link_tag( base_url('styles/side_bar.css') );   
                                       $val.="<div class='row row-side'>
                                                     <div class='col-xs-2 no-padding'>
                                                           <a href='". new_url("user/show/" .urlencode( base64_encode( $user['id'] ) ) ) ."'> 
                                                              <img class='pic-img' alt='$alt'  src='$path' rel='popover' data-placement='top' data-content='&lt;span&gt; ". $alt ." &lt;/span&gt;' data-trigger='hover' data-html='true'  width='80' height='100' style='width:80px; height:100px;' >
                                                           </a>
                                                     </div>
                                                     <div class='col-xs-8 no-padding'>
                                                           <h3> $name  </h3>
                                                           <h4>  $age    </h4>
                                                           <div class='row prf-container '>";
                                                           
                                                                     $test = "rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc '&gt;  &lt;strong class='green'  &gt; TEST &lt;/strong&gt;  TEST &lt;/span&gt;\" data-trigger='hover' data-html='true'"; 
                                                                     $chat  = ($user['like_chat']  != "1") ? ( ($user['like_chat']  == "0" ) ? "no" : "yes") : "" ; 
                                                                     $smoke = ($user['like_pet']   != "1") ? ( ($user['like_pet']   == "0" ) ? "no" : "yes") : "" ;
                                                                     $pet   = ($user['like_smoke'] != "1") ? ( ($user['like_smoke'] == "0" ) ? "no" : "yes") : "" ;
                                                                     $music = ($user['like_music'] != "1") ? ( ($user['like_music'] == "0" ) ? "no" : "yes") : "" ; 
                                                                     if( strcmp("", $chat)  != 0 )
                                                                        $val .=  "<span  class='tip chat_$chat   ' rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc colour-".$chat   ."'&gt;  ".lang("sd.chat-" .$chat )  ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                     if( strcmp("", $music) != 0 )
                                                                        $val .=  "<span  class='tip music_$music ' rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc colour-".$music  ."'&gt;  ".lang("sd.music-" .$music ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                     if( strcmp("", $smoke) != 0 )
                                                                        $val .=  "<span  class='tip smoke_$smoke ' rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc colour-".$smoke  ."'&gt;  ".lang("sd.smoke-" .$smoke ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
                                                                     if( strcmp("", $pet  ) != 0 )
                                                                        $val .=  "<span  class=' tip pet_$pet    ' rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc colour-".$pet    ."'&gt;  ".lang("sd.pet-" .$pet )   ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";  
                                       $val .=   " </div>
                                               </div>
                                           </div>
                                           <div class='row' >";
                                               if( $total > 0  ){       
                                                     $val .= " <div style='float:left; font-weight:bold; font-size:16px; padding:5px '>  " . $total ." ". lang("rating") ." —</div> 
                                                               <span class='star-large star-". number_format($avg, 1, '-', '.') ."' style='float:left' ></span> 
                                                               <div style='float:left; font-weight:bold; font-size:16px; padding:5px '>  ". number_format($avg, 1, '.', '.')  ." / 5 </div> ";
                                                }              
                                       $val .= "</div>";
                                       echo $val;     
                                ?>
                              </div>
                         </div>
                     </form> 

                    <form id="rate" class="bs-example form-horizontal " style="padding-top:0px; display:none" >
                         <div class="form-group">
                              <div class="col-lg-3" ></div>
                              <div class="col-lg-8 border" >
                                  <legend style="max-width:500px" ><h3>  <?= lang("r.vote") ?>  </h3></legend>
                                  <div  style="float:left" >
                                        <script>
                                              var dil = "<?= lang('r.star')?>";
                                              new Starry('inputRating', {name:'inputRating', maxLength:5, startAt:0, showNull:false, dil:"<?= lang('r.star')?>" } );
                                        </script>
                                  </div>
                                  <div id="rateMy" style="float:left; padding:22px 0px 0px 4px; "> 0 <?= lang('r.star')?></div>      
                              </div>
                         </div>
                         <div class="form-group">
                               <div class="col-lg-3"></div>
                               <div class="col-lg-8 border">
                                    <textarea id="inputReview" class="form-control" rows="3" placeholder="<?= lang("r.pexplain") ?>" style="max-width:500px; width:500px;  min-width:100px; max-height:200px" id="textArea"></textarea>
                                    <span class="help-block"><?= lang("r.help-explain") ?></span>
                               </div>
                         </div>

                          <div id="driver" class="row">
                              <div class="col-lg-3"> </div>
                              <div class="col-lg-7 block " >
                                      <div class="col-lg-5" >    
                                          <label class="control-label"> <?= lang("r.driving") ?> </label>
                                          <div class="radio">
                                            <label>
                                               <input type="radio" name="driving" id="optionsRadiosPassenger" value="good" >
                                               <?= lang("r.dr-good") ?>
                                            </label>
                                          </div>
                                          <div class="radio">
                                            <label>
                                               <input type="radio" name="driving" id="optionsRadiosDriver" value="normal">
                                              <?= lang("r.dr-normal") ?>
                                            </label>
                                          </div>
                                          <div class="radio">
                                            <label>
                                               <input type="radio" name="driving" id="optionsRadiosNon-pass-driver" value="bad">
                                               <?= lang("r.dr-bad") ?>
                                            </label>
                                          </div>
                                     </div>
                                     <div class="col-lg-7" style="padding:10px"><strong> <?= lang("r.driver-skill") ?> </strong></div> 
                               </div>
                                   
                          </div>

                         <div class="form-group " style="margin-top:30px">
                               <label for="textArea" class="col-lg-3 control-label"> </label>
                               <div class="col-lg-7">
                                     <div class="sending">  </div>            
                                     <button id="inputGiveRate" data-who_give="<?= base64_encode($this->user_id )?>" data-who_receive="<?= base64_encode($user["id"]) ?>"  type="button" class="btn btn-primary width-200"> <?= lang("r.give-rate") ?> </button>
                               </div>
                         </div>
                    </form>
               </div>                        
        </div>
        <script type="text/javascript" >
            var choose_vote = '<?= lang("r.choose_vote")?>';   
        </script>
        <script src="<?php  echo  base_url() . 'scripts/partial/review/giveRating.js'  ?>"></script> 