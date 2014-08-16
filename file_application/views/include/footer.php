      
    
	         <script type="text/javascript" >
	    		    (function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/"+ facebook_lang +"/all.js#xfbml=1&appId=528537380594210";
						  fjs.parentNode.insertBefore(js, fjs);
						   
					}(document, 'script', 'facebook-jssdk'));
			        $(function(){
			              var twe = "iframe"; 
						  setTimeout( function(){  $( twe  ).removeAttr('title'); },700);
						  setTimeout( function(){  $( twe  ).removeAttr('title'); },1000);
						  setTimeout( function(){  $( twe  ).removeAttr('title'); },2000);
						  setTimeout( function(){  $( twe  ).removeAttr('title'); },3000);
						  setTimeout( function(){  $( twe  ).removeAttr('title'); },4000);
						  setTimeout( function(){  $( twe  ).removeAttr('title'); },5000);
			        });
	        </script>
 
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
                          <li class="text-primary" > <a class="click" href="mailto:info@hepgezelim.com"> info@hepgezelim.com </a> </li>
                          <li class="text-primary" > <a class="click" target="blank"  href="http://www.iconsdb.com/"> iconsdb.com </a> </li>
                                                            
                       </ul>
                    </div>
                    <div class="col-lg-4" style="text-align:center; " >
                         <!---
                         <div class="row" style="padding-bottom: 10px; " >
                              <div class="fb-like" data-href="https://www.facebook.com/hepgezelim"  data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                         </div>
                         <div class="row twitter-my" >
                                <? if( strcmp(lang('lang'), "tr") == 0 ){   // Turkish  ?>                                  
                                        <a href="https://twitter.com/hepgezelim"  title="" class="twitter-follow-button" data-show-count="false" data-lang="tr"  data-dnt="true">Takip et: @hepgezelim</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                        <a href="https://twitter.com/share"  title="" class="twitter-share-button" data-url="http://hepgezelim.com" data-text="Seyahat paylaşım sitesi" data-via="hepgezelim" data-lang="tr"   data-hashtags="hepgezelim" data-dnt="true">Tweet</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                <?}else {    // English     ?>
                                        <a href="https://twitter.com/hepgezelim" title="" class="twitter-follow-button" data-show-count="false"  data-dnt="true">Follow @hepgezelim</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                        <a href="https://twitter.com/share"  title="" class="twitter-share-button" data-url="http://hepgezelim.com" data-text="Travel sharing site" data-via="hepgezelim"  data-hashtags="hepgezelim" data-dnt="true">Tweet</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                <?}       ?>
                         </div>
                         ---->
                    </div>
                    <div class="col-lg-4" style="text-align:right;" >
                       <p class="footer" style=" text-align: left;" > <?= lang('g.developer')?> :<a class="click" target="blank" href="http://ismailakbudak.com"> İsmail AKBUDAK </a> 
                       - <a class="click" target="blank" title="<?= lang("g.university") ?>" href="http://www.pau.edu.tr/"> PAÜ </a>
                       - <a class="click"  data-toggle='modal' href="#dipnot"  > <?= lang('g.postscript') ?> </a>
                       </p>
                       <p class="footer" style=" text-align: left;" > <?= lang('g.time')?> :<strong>{elapsed_time}</strong> <?= lang('g.time2')?>...</p>
                    </div>     
              </div>
              <div class="row  copy" >
                  <div style="float:left;" > Copyright © 2013-14 www.hepgezelim.com   |  <?= $member_count ?> - <?= lang("g.member") ?> | <?= $offer_count ?> - <?= lang("g.offer_count") ?>  | <?= $offer_count_updated ?> -  <?= lang("g.offer_count2") ?> </div>
                  <div style="text-align:right;" >
                        <a title="<?= lang("see_facebook") ?>" href="http://www.facebook.com/hepgezelim" target="_blank">
                           <img class="social" src="<?=  base_url("styles/images/facebook.png")  ?>" alt="" width='40' height='40' style="width:40px; height:40px;" border="0" ></a>
                         <a title="<?= lang("see_twitter") ?>" class="social" href="http://twitter.com/hepgezelim" target="_blank">
                            <img class="social" src="<?=  base_url("styles/images/twitter.png")  ?>" alt="" width='40' height='40' style="width:40px; height:40px;" border="0"></a>
                          <a  class="social" href="<?= new_url() ?>" >
                             <img title='Hepgezelim.com' alt='Hepgezelim.com' src='http://www.hepgezelim.com/seyahat/styles/email/car-32.png' width='32' height='32' style='width:32px; height: 32px' >
                          </a>
                  </div>
                  
                     
              </div>
            </footer>

          <div id = "mesaj"></div>
          <div style="height:20px;"></div>    
    </div> <!-- Containers Ending-->   
       <!-- Modal report-problem
    =====================================================-->
    <div id="report-problem" class="modal fade" tabindex="-1" data-width="460" data-height="420" style="display: none;">
        <div class="modal-header">
             <button type="button" class="close clean-report" data-dismiss="modal" title="<?= lang('close') ?>" aria-hidden="true">&times;</button>
             <h3 class="modal-title"> <i class="glyphicon glyphicon-flag one"></i> <?=lang('g.problem')?>  </h3>
        </div>
        <div class="modal-body"> 
               <div class="row" style=""> 
                             <fieldset>
                                          <div class="form-group" style="margin:0px 20px 0px 20px; text-align:center" >   
                                               <textarea class="form-control" rows="3" placeholder="<?= lang("g.reportHelp") ?>" id="textAreaReport" 
                                                  style="max-width:405px; height:250px; max-height:250px; " ></textarea> 
                                          </div>     
                                          <div class="form-group" style="margin:10px 20px 0px 20px; text-align:center">
                                                    <input type="text"  class="form-control" id="inputReportEmail"  placeholder="<?= lang("g.optional") ?>">
                                          </div>

                                          <div class="form-group margin-20 " style="text-align:center" >
                                             <button id="buttonSendReport" class="btn btn-primary form-control width-300" > <?=lang('g.send')?> </button>  
                                          </div> 
                             </fieldset>
                      </div>
               </div>
       </div>  
    </div><!-- END of the Modal report-problem --> 
    
    <!-- Modal dipnot
    =====================================================-->
    <div id="dipnot" class="modal fade" tabindex="-1" data-width="460" data-height="160" style="display: none;">
        <div class="modal-header">
             <button type="button" class="close clean-report" data-dismiss="modal" title="<?= lang('close') ?>" aria-hidden="true">&times;</button>
             <h3 class="modal-title"> <i class="glyphicon glyphicon-flag one"></i> <?=lang('g.postscript')?>  </h3>
        </div>
        <div class="modal-body"> 
               <div class="row" style=""> 
                  <div class="col-lg-12" >
                       <fieldset> 
                       	    Bu proje yurtdışında bir seyahat paylaşım sitesinden esinlenerek yapılmıştır. 
                       	    Elektrik Elektronik Mühendisliği öğrencisi 
                       	    <strong> İsmail KALAY </strong> arkadaşımızın tavsiyesi ve
                       	    <strong> Mehmet Ahsen ÖZBEY </strong> isimli sınıf arkadaşımın teşvikleriyle 
                       	    hayata geçirilmiştir. Yazılımın kodlaması frameworkler dışında tamamıyla bana aittir.
                       	    Teşekkürler....  
                       </fieldset>
                  </div>     
               </div>
       </div>  
    </div><!-- END of the Modal dipnot --> 
    
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
 
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////
-->