      
    
          <footer class="" style=" margin-top:20px; margin-bottom: 20px; " >
               <div class="row" style="">
                     <div class="col-lg-2 ">
                       <ul class="list-unstyled ">
                          <li><a class="click" href="<?= new_url('application/terms') ?>"> <?= lang("terms") ?> </a></li>
                          <li><a class="click" href="<?= new_url('application/privacy') ?>"> <?= lang("privacy") ?> </a></li>
                          <li><a class="click" href="<?= new_url('main/works') ?>"> <?= lang("g.how") ?> </a></li>
                       </ul>
                    </div>
                    <div class="col-lg-2 ">
                       <ul class="list-unstyled ">
                          <li><a class="click" href="<?= new_url('contact') ?>">    <?= lang('g.contact')?> </a></li>
                       </ul>
                    </div>
                    <div class="col-lg-4" style="text-align:center; " >
                         <div class="row" >
                                <!--
                                <? if( strcmp(lang('lang'), "tr") == 0 ){   // Turkish  ?>                                  
                                        <a href="https://twitter.com/hepgezelim"  title="" class="twitter-follow-button" data-show-count="false" data-lang="tr" data-size="large" data-dnt="true">Takip et: @hepgezelim</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                        <a href="https://twitter.com/share"  title="" class="twitter-share-button" data-url="http://hepgezelim.com" data-text="Seyahat paylaşımın adresi" data-via="hepgezelim" data-lang="tr" data-size="large" data-hashtags="hepgezelim" data-dnt="true">Tweet</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                <?}else {    // English     ?>
                                        <a href="https://twitter.com/hepgezelim" title="" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @hepgezelim</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                        <a href="https://twitter.com/share"  title="" class="twitter-share-button" data-url="http://hepgezelim.com" data-text="The address of travel sharing" data-via="hepgezelim" data-size="large" data-hashtags="hepgezelim" data-dnt="true">Tweet</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                <?}       ?>
                                --> 
                         </div>
                    </div>
                    <div class="col-lg-4" style="text-align:right;" >
                       <p class="footer" style=" text-align: left;" > <?= lang('g.developer')?> :<a class="click" target="blank" href="http://ismailakbudak.com"> İsmail AKBUDAK </a> 
                       - <a class="click" target="blank" href="http://www.pau.edu.tr/"> PAÜ </a>
                       </p>
                       <p class="footer" style=" text-align: left;" > <?= lang('g.time')?> :<strong>{elapsed_time}</strong> <?= lang('g.time2')?>...</p>
                    </div>     
                </div>
                <div class="row  copy" >
                    <div style="float:left;" > Copyright © 2013-14 hepgezelim.com     </div>
                    <div style="text-align:right;" >
                          <a title="<?= lang("see_facebook") ?>" href="http://www.facebook.com/hepgezelim" target="_blank">
                             <img class="social" src="<?=  base_url("styles/images/facebook.png")  ?>" alt="" width='40' height='40' style="width:40px; height:40px;" border="0" ></a>
                           <a title="<?= lang("see_twitter") ?>" class="social" href="http://twitter.com/hepgezelim" target="_blank">
                              <img class="social" src="<?=  base_url("styles/images/twitter.png")  ?>" alt="" width='40' height='40' style="width:40px; height:40px;" border="0"></a>
                    </div>
                       
                </div>
          </footer>

          <div id = "mesaj"></div>
          <div style="height:20px;"></div>    
    </div> <!-- Containers Ending-->  
    
    
    <!-- info user modal  
    ===============================================================--> 
    <div id="info-send-user-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-width="440px" data-keyboard="false"    style="display: none;">
                   <div class="modal-body">
                          <p> <?= lang("a.warn-message") ?></p>
                          <textarea  id='inputMessageForInfoModal' class='form-control' rows='3' style='max-width: 390px; max-height:100px; margin-bottom:10px' id='textArea'></textarea>                                                   
                          <p> <?= lang("a.warn-message-en") ?></p>
                          <textarea  id='inputMessageForInfoModalEn' class='form-control' rows='3' style='max-width: 390px; max-height:100px; margin-bottom:10px' id='textArea'></textarea>                                                   
                          <div class="bs-example" style="margin-bottom: 15px;">
                             <div class="btn-group btn-group-justified data-types-info ">
                                 <a href="#" class="btn btn-default data-type-info active" data-type_info="warning"> <?= lang('a.warning') ?> </a>
                                 <a href="#" class="btn btn-default data-type-info"        data-type_info="info"> <?= lang('a.info') ?></a>
                                 <a href="#" class="btn btn-default data-type-info"        data-type_info="other"> <?= lang('a.other') ?> </a>
                             </div>
                          </div> 
                   </div>
                   <div class="modal-footer">
                         <button type="button" id="modal-cancel-info" data-dismiss="modal" class="btn width-100"><?= lang("g.cancel") ?></button>
                         <button type="button" id="user-info-send" data-user-id="-1"  data-dismiss="modal" class="btn btn-primary width-100 "><?= lang("a.send") ?></button>
                   </div>
     </div>
   
     <script type="text/javascript">
        $( function(){
                     
                     CapitiliazeFirst(  [ "#inputMessageForInfoModal", "#inputMessageForInfoModalEn" ]  );
                     $( "#modal-cancel-info" ).on('click',function(){    $("#inputMessageForInfoModal").val(""); $("#inputMessageForInfoModalEn").val("");   });
                     $( ".info-send-modal-open" ).on('click',function(){
                            var user_id      = $(this).data('id');
                            $("#user-info-send").data("user-id",user_id); 
                     });
                     $( ".data-type-info" ).on('click',function(){
                          $( ".data-type-info" ).removeClass('active');
                          $( this ).addClass('active'); 
                          return false;
                     });

                     $("#user-info-send").on('click',function(){
                             var user_id      = $( this ).data("user-id");
                             var message      = $("#inputMessageForInfoModal").val();
                             var message_en   = $("#inputMessageForInfoModalEn").val();
                             var type         = $( ".data-types-info" ).find(".active").data('type_info');
                             var data         = {user_id:user_id, message:message, type:type, message_en:message_en };
                             var url          = "user_warn_process";
                             var result       = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){   $("#inputMessageForInfoModal").val("");
                                                                                 $("#inputMessageForInfoModalEn").val("");
                                                                                 $( "#info-send-user-modal").modal('toggle');
                                                                                 BasariMesaj( result.text   );             } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesajModal( $(this), result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesajModal( $(this), result.message  )} // show top
                             else                                            {   HataMesajModal( $(this), er.error_send   )} // show bottom alert  
                             return false;
                     });
          });
          
    </script>
     
  </body>
</html>
<!--
//////////////////////////////////////////////////
/*************************************************
**************************************************
**    
**    DEVELOPER : ismail AKBUDAK  WEB & MOBIL DEVELOPER
**
**    CONTACT   :  www.ismailakbudak.com 
**    LINKEDIN  : http://www.linkedin.com/pub/ismail-akbudak/56/a57/40b
**    FACEBOOK  : https://www.facebook.com/isoakbudak
**    TWITTER   : https://twitter.com/isoakbudak
**    GOOGLE+   : https://plus.google.com/u/0/100985583645011477288/posts
**    
**    EXPLAIN   : You can use this code block free 
**                BUT LEARN, DEVELOP AND SHARE  
**                THIS IS MY PRINCIPLE
**    
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////
-->