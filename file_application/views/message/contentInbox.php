      <?=link_tag( base_url('styles/message-content.css') ); ?>

      <div class="row">

          <div class="col-lg-8" style="padding-right: 5px; padding-left: 5px;">
            <div class="bs-example">
                <ul class="list-group">
                  <li class='list-group-item  ' >
                           <div  class="row" style="margin-bottom:30px" >
                               <div class='well' style="padding: 0px">
                                  <div class='bs-example form-horizontal'>
                                      <fieldset>
                                            <?
                                                 $origin      = explode(',',$offer['origin']);
                                                 $origin      = $origin[0];
                                                 $destination = explode(',',$offer['destination']);
                                                 $destination = $destination[0];  
                                                 $url_detail  =  urlCreate( $this->lang->lang(), $origin, $destination,  $message['normal_offer_id'] );
                                            ?>     
                                            <div class='col-lg-8  '>
                                                    <h3> <?= lang("m.offer") ?>
                                                        <a target="blank" href="<?= new_url( $url_detail  ) ?>" >
                                                            <?=  $origin . " → " . $destination ?> 
                                                        </a>
                                                     </h3>   
                                            </div>
                                            <div id="data" class='col-lg-4 msg' data-name='<?= $sender['name'] ." ".$sender['surname']  ?>'  data-offer_id='<?= $this->encrypt->encode($offer['id']) ?>' data-sender_userid='<?= $this->encrypt->encode($sender['id']) ?>' > 
                                                <a href='#delete-modal' data-toggle='modal' class='delete-meessages'  >
                                                    <i title='<?= lang("delete") ?>' class='text-danger glyphicon glyphicon-trash' ></i> 
                                                </a>
                                                <a href='#' class='archieve-messages'  >
                                                   <i title='<?=  lang("m.archieve") ?>' class='text-info glyphicon glyphicon-compressed' ></i> 
                                                </a>
                                                <a href='#block-user-modal-inbox'  data-toggle='modal' class='block-user-inbox'  >
                                                    <i title='<?=  lang("m.block2") ?>' class='text-primary glyphicon glyphicon-pause' ></i> 
                                                </a>
                                            </div> 
                                     </firldset>
                                  </div>   
                                </div>            
                           </div>
                  </li>
                  <?php
                       $username = $sender['name'];
                       $date     = date('Y');
                       $age      =  $date - $sender['birthyear'] . lang("m.age");
                       $alt      = $username ." ". $sender['surname'] ." ( ". $age  ." ) " ;
                       $path     = $sender['foto'];
                       $tel      =  ( $sender['tel_visible'] == 1 && strcmp("", $sender['tel_no']) != 0  )  ? ( lang("m.telefon") ." ". $sender['tel_no'] ) : "<i class='glyphicon glyphicon-phone three' ></i> <i class='glyphicon glyphicon-lock three' ></i>" ;

                       $username_r = $receiver['name'];
                       $date_r     = date('Y');
                       $age_r      =  $date_r - $receiver['birthyear'] . lang("m.age");
                       $alt_r      =  $username_r ." ". $receiver['surname'] ." ( ". $age_r  ." )" ;
                       $path_r     = $receiver['foto'];
                       $tel_r      =  ( $receiver['tel_visible'] == 1 && strcmp("", $receiver['tel_no']) != 0  )  ? ( lang("m.telefon") ." ". $receiver['tel_no'] ) : "<i class='glyphicon glyphicon-phone three' ></i> <i class='glyphicon glyphicon-lock three' ></i>" ;
                  ?>
                  <li class='list-group-item  ' style="padding: 0px 117px 20px 60px;" >
                        <div class="row" >
                            <div class="col-lg-6">  
                                <div class="row bs-example" style="float:left" >
                                     <a href='<?= new_url("user/show/" .urlencode( base64_encode($receiver['id'] ) ) ) ?>'> 
                                         <img class='tip pic-img' title='<?= $alt ?>' alt='<?= $alt ?>' src='<?= $path ?>' width='60' height='70' style='float: right;  width: 60px; height: 70px' >
                                     </a>
                                </div>
                                <div class="row" style="float:left; margin-left: 25px;">
                                    <div class='row tel-left' > <?=  $username ." " . $sender['surname']  ?>  </div> 
                                    <div class='row tel-left' > <?=  $tel ?> </div>
                                </div>
                            </div>
                            <div class="col-lg-6">  
                                <div class="row bs-example" style="float:right" >
                                     <a href='<?= new_url("user/show/" .urlencode( base64_encode($receiver['id'] ) ) ) ?>'> 
                                         <img class='tip pic-img' title='<?= $alt_r ?>' alt='<?= $alt_r ?>' src='<?= $path_r ?>' width='60' height='70' style='float: right;  width: 60px; height: 70px' >
                                     </a>
                                </div>
                                <div class="row " style="float:right; margin-right: 25px;">
                                   <div class='row tel-right' style="float:right" ><?= $username_r ." " . $receiver['surname']  ?>  </div> <br>
                                   <div class='row tel-right' style="float:right" > <?=  $tel_r ?></div>
                                </div>
                            </div>    
                        </div>   
                  </li>
                  
                  <?php       
                         foreach ($conversation as $message) {
                              if( $message['is_answer'] ){    
                                    echo    "<li class='list-group-item  '>
                                                  <div class='row'>
                                                        <div  class='msg-comment-receiver'>
                                                            <div class='row'> {$message['message']}    </div>
                                                            <div class='row text-right dateMSG' style='margin-top:10px'> 
                                                                ". dateConvert($message['created_at'], $this->lang->lang() ) ." 
                                                            </div>
                                                        </div>
                                                        <div class='col-xs-2   msg-photo-container-right'>
                                                               <a href='". new_url("user/show/" .urlencode( base64_encode($receiver['id'] ) ) ) ."'> 
                                                                   <img class='tip pic-img' title=' $alt_r ' alt=' $alt_r ' src=' $path_r ' width='60' height='70' style='float: right;  width: 60px; height: 70px' >
                                                               </a>
                                                       </div>
                                                  </div>
                                             </li>";
                                }               
                                else{
                                    echo    "<li class='list-group-item  '>
                                                <div class='row'>
                                                      <div class='col-xs-2 msg-photo-container-left'>
                                                            <a href='". new_url("user/show/" .urlencode( base64_encode($sender['id'] ) ) ) ."'> 
                                                               <img class='tip pic-img' title=' $alt ' alt=' $alt ' src=' $path ' width='60' height='70' style='float: right;  width: 60px; height: 70px' >
                                                            </a>   
                                                     </div>
                                                      <div  class='msg-comment-sender'>
                                                          <div class='row'> {$message['message']}    </div>
                                                          <div class='row text-right dateMSG' style='margin-top:10px'> 
                                                              ". dateConvert($message['created_at'], $this->lang->lang() ) ." 
                                                              <a href='#'  class='alert-moderator-inbox' data-message_id='". $this->encrypt->encode($message['id'])   . "' > 
                                                                  <i title='". lang("m.alert") ."' class='text-danger glyphicon glyphicon-flag two' ></i> 
                                                              </a>
                                                          </div>
                                                      </div>
                                                </div>
                                           </li>";   
                                }              

                         }
                         if( count($conversation) == 0 ){
                              echo " <div class='bs-example'>
                                         <div class='alert alert-dismissable alert-info'>
                                              <button type='button' class='close' data-dismiss='alert' title='". lang('close') ."' >&times;</button>
                                              <h4> ". lang("m.empty") ." <a href='". new_url('message/inbox/' . $message['offer_id'] ."/". $message['sender_id'] ) ."' style='margin:10px' title='". lang('refresh') ."' >
                                              <i class='glyphicon glyphicon-refresh'></i> </a> </h4>
                                         </div>
                                     </div>";
                         }
                         else{
                             echo  "<li class='list-group-item  '>
                                         <div class='row'>
                                              <div  class='msg-comment-receiver'>
                                                        <textarea  id='inputMessage' class='form-control' placeholder='".lang("m.pmessage")."' rows='3' style='width:375px; max-width: 375px; max-height:100px; margin-bottom:10px' id='textArea'></textarea> 
                                                         <button id='send-message-inbox' type='button' class='btn btn-primary  btn-sm width-100 apply-btn-loader' 
                                                          data-sender_userid='". $this->encrypt->encode($sender['id']) ."' 
                                                          data-offer_id='". $this->encrypt->encode($offer['id']) ."'> <span class='img-loader hide'></span>". lang('m.send') ." </button> 
                                              </div>
                                              <div class='col-xs-2 msg-photo-container-right'>
                                                    <a href='". new_url("user/show/" .urlencode( base64_encode($receiver['id'] ) ) ) ."'> 
                                                         <img class='tip pic-img' title='$alt_r' alt=' $alt_r' src=' $path_r' width='60' height='70' style='float: right;  width:60px; height: 70px' >
                                                    </a>
                                             </div>
                                          </div>
                                     </li>";
                         }                           
                         
                    ?>            
                </ul>
            </div>
          </div>
           
          <div class="col-lg-4"  style="padding-right: 5px; padding-top: 5px;">
                 <div class="row row-side">
                       <div class="well trip-content" >
                             <div style="padding:5px; margin-bottom:15px" >
                                  <h4>
                                      <span class="star-one"></span>
                                      <strong><?= lang("m.feed")?> </strong>
                                      <span class="star-one"></span>
                                  </h4>
                                   <?= lang("m.feedex1") ?>
                                   <strong> <?= $side_user['name'] . " " .$side_user['surname'] ?> </strong>
                                   <?= lang("m.feedex2") ?> 
                            </div> 
                            <div style="text-align: center;">
                                  <a href="<?= new_url('review/giveRating/' .  urlencode(base64_encode($side_user['id'])) )?>">
                                     <button class="btn-lg form-controller  btn-2action width-250"> <?= lang("m.give-rate")?></button>
                                  </a>
                            </div>    
                       </div>   
                 </div>
                  
                  <?php
                        $this->lang->load('user_sidebar');
                        echo getSideBar( $side_user, lang("m.talk") ,$this->lang->lang() );
                  ?>
          </div>

      </div>  

      <!-- Delete message modal inbox
      ===============================================================--> 
      <div id="delete-modal" class="modal fade" tabindex="-1" data-backdrop="static"  data-keyboard="false" data-offer_id="-1"; data-sender_userid="-1";  style="display: none;">
             <div class="modal-body">
                   <p><?= lang("m.commit") ?></p>
             </div>
             <div class="modal-footer">
                   <button type="button" data-dismiss="modal" class="btn width-100"><?= lang("g.cancel") ?></button>
                   <button type="button" data-dismiss="modal" class="btn btn-primary width-100"><?= lang("g.yes") ?></button>
             </div>
      </div>    
      <!-- block user modal inbox
      ===============================================================--> 
      <div id="block-user-modal-inbox" class="modal fade" tabindex="-1" data-backdrop="static" data-width="440px" data-keyboard="false" data-offer_id="-1"; data-sender_userid="-1";  style="display: none;">
             <div class="modal-body">
                   <legend class="name" ></legend> 
                   <p><?= lang("m.desc-block") ?></p>
                   <textarea  id='inputMessageBlock' class='form-control' rows='3' style='max-width: 390px; max-height:100px; margin-bottom:10px' id='textArea'></textarea>                                                   
             </div>
             <div class="modal-footer">
                   <button type="button" data-dismiss="modal" class="btn width-100"><?= lang("g.cancel") ?></button>
                   <button type="button" data-dismiss="modal" class="btn btn-primary width-100"><?= lang("m.doblock") ?></button>
             </div>
      </div>
      <script src="<?php echo   base_url() . 'scripts/partial/messages/contentInbox.js' ?>"></script>