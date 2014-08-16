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
**    
**    UPDATE    : 21-04-2014 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////
-->
<!DOCTYPE html>
<html lang="<?= $this->lang->lang() ?> ">
  <head>
    <meta charset="utf-8">
    <meta name="language" content="<?= lang('g.language') ?>">
    <meta name="description" content="<?=lang('g.description')?> ">
    <meta name="keywords" content="<?=lang('g.keywords')?>">
    <title> <?=lang('g.title')?> </title>
    <link rel="canonical" href="http://www.hepgezelim.com/">
    <link rel="alternate" href="http://www.hepgezelim.com/seyahat/tr/" hreflang="tr-TR">
    <link rel="alternate" href="http://www.hepgezelim.com/seyahat/en/" hreflang="en-UK">
    <meta name="application-name" content="Hepgezelim">
    <meta property="fb:app_id" content="528537380594210">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.hepgezelim.com/">
    <meta property="og:locale" content="<?= lang('g.language') ?>">
    <meta property="og:site_name" content="Hepgezelim.com">
    <meta property="og:title" content="<?=lang('g.title')?>">
    <meta property="og:image" content="<?php echo  base_url() . 'styles/images/ico.ico'  ?>">
    <meta name="copyright" content="@ Copyright Hepgezelim 20013-2014">
    <meta name="distribution" content="global" />
    <meta name="author" content="İsmail Akbudak">
    <meta name="robots" content="all">  
    <link rel="icon" type="image/x-icon" href="<?php echo  base_url() . 'styles/images/ico.ico'  ?>">
    <link rel="image_src" href="<?php echo  base_url() .'styles/images/ico.ico' ?>" />
      
    <!--   CSS files  
    =====================================-->
    <?php echo link_tag( base_url() . 'styles/bootstrap.min.css') ?>
    <?php echo link_tag( base_url() . 'styles/demand/jquery-ui-custom.min.css'); ?>
    <?php echo link_tag( base_url() . 'styles/message.css'); ?>
    <?php echo link_tag( base_url() .'styles/bootstrap-modal.css') ?>
    <?php echo link_tag( base_url() .'styles/application.css') ?>
     
     <!--   JavaScript files  
    =====================================-->
    <script src="<?php echo  base_url() . 'scripts/general/jquery.min.js'  ?>"></script>
    <script src="<?php echo  base_url() . 'scripts/general/bootstrap.min.js'  ?>"></script>
    <script src="<?php echo  base_url() . 'scripts/general/jquery-ui-custom.min.js'  ?>"></script>
    <!---Sonradan dahil edilen kodlar -->
    <script src="<?php echo  base_url() . 'scripts/general/message.js' ?>"></script>
    <script src="<?php echo   base_url() . 'scripts/partial/application.js' ?>"></script>
    <script src="<?php echo  base_url() . 'scripts/general/bootstrap-modalmanager.js'  ?>"></script> 
    <style type="text/css">
         .one{ font-size: 100%; margin-right: 10px;}
         .two {  font-size: 130% !important; margin-right: 10px;  }
         .three {  font-size: 170% !important; margin-right: 10px; }
         .mybadge { position: absolute; left: 41px; top: 5px; }
         .mybadge2 { position: absolute; left: 35px; top: 5px; }
         a{ text-decoration: none !important; }
    </style> 
    <script>
		   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-39220331-2', 'hepgezelim.com');
			ga('require', 'displayfeatures');
			ga('send', 'pageview');
    </script>
    <script type="text/javascript">
         var lang      = '<?= lang("lang") ?>', 
             dayNames  = [  "Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
             dayNamesMin = [ "Pz", "Pt", "Sa", "Çş", "Pş", "Cm", "Ct" ],
             monthNames = [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
             nextText = "Sonraki",
             goTop    = "Başa Dön",
             facebook_lang = "tr_TR",
             prevText = "Önceki";
         if( strcmp(lang, "en") == 0 ){
            dayNames  = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
            dayNamesMin = [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"  ];
            monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
            nextText = "Next";
            goTop    = "Back to Top",
            facebook_lang = "en_US",
            prevText = "Prev";
         }  
    </script> 
   </head>
   <body>

     <div class="container">

      <!-- Navbar
      ================================================== -->
      <div class="bs-docs-section clearfix " >
        <div class="row">
          <div class="col-lg-12">
            <div class="bs-example">
                     <div class=" navbar navbar-default " style="font-size: 18px;">  <!-- navbar-sm -->
                       <div class="navbar-header ">  <!--nav-->
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a href="<?php echo new_url() ?>" class="navbar-brand"><i class=" glyphicon glyphicon-home one"></i>
                           <?=lang('g.mainpage')?> </a>
                       </div>
                       <div class="navbar-collapse collapse navbar-responsive-collapse" id="navbar-main">
                         <ul class="nav navbar-nav">
                            <li><a href="<?php echo new_url() . 'main/works'; ?>" >
                               <i class="glyphicon glyphicon-book one"></i> <?=lang('g.how')?> </a>
                            </li>
                            <li><a id="buttonOfferRide" href="<?php echo new_url() . 'main/offerRide'; ?>"  >
                                   <i class="glyphicon glyphicon-briefcase one"></i> <?=lang('g.offer')?> </a>
                            </li> 
                            <li><a id="buttonFindRide" href="<?php echo new_url( ((strcmp(lang('lang'), "tr") == 0) ? "ara-seyahat" : "search-travel" ) ) ?>"   >
                              <i class=" glyphicon glyphicon-search one"></i> <?=lang('g.search')?></a>
                            </li> 
                            <li><a data-toggle="modal" href="#report-problem"   >
                              <i class=" glyphicon glyphicon-flag one"></i> <?=lang('g.problem')?></a>
                            </li>
                        </ul>
                         <ul class="nav navbar-nav navbar-right ">
                           <li><a  data-toggle="modal" href="#joinus">
                                <i class="glyphicon glyphicon-tree-conifer one"></i> <?=lang('g.join')?> </a>
                           </li>
                           <li><a  data-toggle="modal" href="#login">  
                              <i class="glyphicon glyphicon-log-in one"></i> <?=lang('g.login')?> </a>
                           </li><!-- class="btn btn-success"-->
                           
                           <li class="dropdown">
                                  <!-- href="#" -->
                                  <a class="dropdown-toggle"  style="padding-top:0px; padding-bottom:0px;"  data-toggle="dropdown" href="#" id="themes">
                                     <i class="<?= $this->lang->lang() ?>-32"></i> </b>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="themes">
                                    <li style="margin-top:10px" ><a tabindex="-1" href="<?= base_url() . $this->lang->switch_uri('tr') ?>">
                                      <i class="tr"></i> 
                                        <?=lang('g.tr')?></a>
                                    </li>
                                    <li><a tabindex="-1" href="<?= base_url() . $this->lang->switch_uri('en')  ?>">
                                      <i class="en"></i>   <?=lang('g.en')?>  </a>
                                    </li>
                                  </ul>
                             </li> 
                         </ul>
                      </div>
                    </div>
                </div>
              </div> 
            </div>
         </div>
      </div><!-- End of the container -->
     
     <div class="container" style="padding: 0 100px 0px 100px">
         <div  id="message" ></div>
         <div id="fb-root"></div>
     </div

    <!-- Modal login
    =====================================================-->
    <div id="login" class="modal fade" tabindex="-1" data-width="440" data-height="380" style="display: none;">
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" title="<?= lang('close') ?>" aria-hidden="true">&times;</button>
             <h3 class="modal-title"> <i class="glyphicon glyphicon-log-in one"></i> <?=lang('g.userlogin')?>  </h3>
        </div>
        <div class="modal-body">
               <div  class="row mrn-lr-20">
                   <!--
                   <fb:login-button show-faces="true" id="faceLoginHeaderNonUser" class="btn form-control " scope="email,user_birthday" width="300" max-rows="1"> <?=lang('g.facelogin')?>  </fb:login-button>
                   -->  
                     <button id="faceLoginHeaderNonUser" class="btn btn-primary form-control " > <img src="<?= base_url() ?>styles/images/facebook-back.png"  width="26" height="26"  style="padding-top: 0px; margin-top: -4px; margin-left: -16px; width: 26px; height: 26px;" /> <?=lang('g.facelogin')?> </button>  
                   
               </div>
               <h4> <?=lang('g.or')?> </h4>  
               <div class="row" style="">
                     <div class="well">
                        <form class="bs-example form-horizontal">
                             <fieldset>
                                  <div class="form-group" id="loginError" style="margin-right: 10px; margin-left: 10px;" >
                                         <div class="form-group mrn-lr-20" >
                                               <div class=" input-group">
                                                    <input type="text" class="form-control" id="inputLoginEmail"  placeholder="<?=lang('g.mail')?>">
                                                    <span class="input-group-addon">@</span>
                                               </div>
                                          </div>     
                                          <div class="form-group mrn-lr-20">
                                               <div class=" input-group">
                                                    <input  type="password" class="form-control" id="inputLoginPassword" placeholder="<?=lang('g.pass')?>">
                                                    <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                               </div>
                                          </div>
                                          <div class="form-group margin-20 mrn-lr-30" style="margin-top:35px; margin-bottom:20px;  " >
                                            <button id="buttonLogin" class="btn btn-primary form-control" > <?=lang('g.login')?> </button>  
                                          </div>
                                  </div>   
                               
                             </fieldset>
                        </form>
                        <p class="col-xs-6" style="font-size:13px; padding-top:15px" > <a href="<?php echo new_url('signup/forgotPassword') ?>" class="text-warning"  ><i class=" glyphicon glyphicon-warning-sign one"></i> <?=lang('g.forgot')?> </a> </p>
                        <p class="col-xs-6" style="font-size:13px; padding-top:15px" > <a class="text-primary" data-toggle="modal" href="#joinus" data-dismiss="modal" ><i class=" glyphicon glyphicon-tree-conifer one"></i> <?=lang('g.join')?> </a></p>
                      
                      </div>
               </div>
       </div>  
    </div><!-- END of the Modal login -->

    <!-- Modal joinus
    =====================================================-->
    <div id="joinus" class="modal fade" tabindex="-1" data-width="430" data-height="360" style="display: none;">
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" title="<?= lang('close') ?>" aria-hidden="true">&times;</button>
             <h3 class="modal-title"><i class="glyphicon glyphicon-tree-conifer one"></i> <?=lang('g.freesignup')?> </h3>
        </div>
        <div class="modal-body">
               <div  class="row">
                   <div class="well">
                        <form class="bs-example form-horizontal">
                             <fieldset>
                             <legend><?=lang('g.signupface')?>  <strong class="text-primary"><?=lang('g.tensec')?>  <i class="glyphicon glyphicon-time "></i></strong></legend>
                              <div class="form-group-30 ">
                                    <button id="faceSignupHeaderNonuser" class="btn btn-primary form-control"  > <img src="<?= base_url() ?>styles/images/facebook-back.png"  width="26" height="26"  style="padding-top: 0px; margin-top: -4px; margin-left: -16px; width: 26px; height: 26px;" /> <?=lang('g.signup')?></button>  
                               </div>
                             </fieldset>
                        </form>
                   </div>
               </div>
               <h4><?=lang('g.or')?></h4>  
               <div class="row">
                     <div class="well">
                        <form class="bs-example form-horizontal">
                             <fieldset>
                             <legend><?=lang('g.signupnew')?> <strong class="text-primary"> <?=lang('g.sixtysec')?>  <i class="glyphicon glyphicon-time "></i></strong></legend>
                              <div class="form-group-30">
                                    <button  id="captchaReady" class="btn btn-primary form-control" data-toggle="modal" href="#newuser" data-dismiss="modal" > <?=lang('g.signup')?> </button>  
                               </div>
                             </fieldset>
                        </form>
                      </div>
               </div>
       </div>  
    </div><!-- END of the Modal joinus -->
  
     <!-- Modal newuser
    =====================================================-->
    <div id="newuser" class="modal fade" tabindex="-1" data-width="450" data-height="580" style="display: none;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" title="<?= lang('close') ?>" aria-hidden="true">&times;</button>
        <h3 class="modal-title"><?=lang('g.signform')?> </h3>
      </div>
      <div class="modal-body">
         <div class="well">
                          <form class="bs-example form-horizontal" id="formSignup">
                            <fieldset>
                              <legend><i class="text-primary glyphicon glyphicon-user one" ></i> <?=lang('g.signupnew')?> <strong class="text-primary"><?=lang('g.sixtysec')?>  <i class="glyphicon glyphicon-time "></i></strong></legend>
                               
                               <div class="form-group-30">
                                      <div class="form-group margin-4">
                                           <div class=" input-group">
                                                <select  class="form-control" id="inputSex" >
                                                   <option value="0" class="default"> <?=lang('g.sex')?> </option>
                                                   <option value="1"> <?=lang('g.m')?> </option>
                                                   <option value="2"> <?=lang('g.f')?> </option>
                                                </select>
                                                <span class="input-group-addon " ><i class="glyphicon glyphicon-list " ></i></span>
                                            </div>    
                                     </div>
                                     <div class="form-group margin-4">
                                           <div class=" input-group">
                                               <input type="text" class="form-control" id="inputName" placeholder="<?=lang('g.name')?>">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                           </div>
                                      </div>
                                      <div class="form-group margin-4">
                                             <div class=" input-group">
                                                  <input type="text" class="form-control" id="inputSurname" placeholder="<?=lang('g.surname')?>">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                             </div> 
                                      </div>
                              </div>
                              <div class="form-group-30">
   
                                      <div class="form-group margin-4">
                                          <div class=" input-group">
                                             <input type="text" class="form-control input-group" id="inputEmail" placeholder="<?=lang('g.mail')?>">
                                             <span class="input-group-addon">@</span>
                                          </div>
                                      </div>
                               
                                      <div class="form-group margin-4">
                                            <div class=" input-group">
                                                 <input  type="password" class="form-control" id="inputPassword" placeholder="<?=lang('g.pass')?>">
                                                 <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                            </div>
                                      </div>
   
                                      <div class="form-group margin-4">
                                            <div class=" input-group">
                                                 <input type="password" class="form-control" id="inputPasswordAgain" placeholder="<?=lang('g.passagain')?>">
                                                 <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                            </div>
                                      </div>
                                
                                      <div class="form-group margin-4">
                                            <div class=" input-group">
                                                   <select   class="form-control" id="inputBirthYear">
                                                       <option value="0" class="default" > <?=lang('g.byear')?> </option>
                                                       <?php
                                                            $year1 = getdate();
                                                             $year = $year1['year'];
                                                             for ($i=$year - 18; $i >= 1930; $i--) 
                                                                echo "<option value='{$i}'> $i </option>"
                                                         ?>
                                                   </select>
                                                   <span class="input-group-addon " ><i class="glyphicon glyphicon-list " ></i></span>
                                            </div>       
                                     </div>
                                      <div class="form-group margin-4">
                                            <div class="input-group "> 
                                                <div id="captchaDiv" class="col-lg-3" style="padding-top:5px; padding-right:0px; padding-left:0px; float:left">  
                                                     
                                                </div>
                                                <div class="col-lg-2" style="padding-right: 0px; padding-top:8px; padding-left:25px; float:left">  
                                                    <a id="captchaNew" href="#"><i class="glyphicon glyphicon-refresh three"></i></a>
                                                </div>
                                                <div class="input-group col-lg-7"  style="padding-right: 0px; padding-left: 0px; float:left">
                                                     <input type="text" class="form-control" id="inputCap" placeholder="<?=lang('g.passcap')?>">
                                                     <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                                </div>
                                            </div>      
                                    </div>
                                     <div class="margin-4 mrn-lr-20" style="margin-top:35px;  " >
                                        <button id="inputSignup" class="btn btn-primary form-control" type="button" > <?=lang('g.signup')?> </button>
                                     </div>
                                </div>

                            </fieldset>
                          </form>
              </div>
       </div> 
    </div><!-- END of the Modal yeniüyelik -->

     <!-- Modal loading
    =====================================================-->
    <div id="loading" class="modal fade" style=" border-radius: 16px;" tabindex="-1" data-width="350" data-height="150" data-backdrop="static"  style="display: none;">
        <div class="well" style=" border-radius: 16px; margin-bottom: 0px !important; margin-right: 0px; margin-left: 0px; ">
                             <fieldset style="font-size:20px; padding-bottom:10px; padding-left: 40px; ">
                                  <div class="row">
                                        <?=lang('g.usercreating')?> 
                                       <img class="pic-img" src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >
                                     </div>
                                     <div class="row">
                                      <strong class="text-primary"><?=lang('g.wait')?> </strong>
                                     </div>
                             </fieldset>
        </div>  
    </div><!-- END of the Modal loading -->
     <script type="text/javascript"> var base_url = '<?php echo new_url(); ?>',enviroment = '<?php echo ENVIRONMENT ?>', er = {  <?= createErrorObject() ?> };  </script>
     <script src="<?php echo  base_url() . 'scripts/partial/headerNonUser.js'  ?>"></script>
     <script src="<?php echo  base_url() . 'scripts/partial/face-process.js'  ?>"></script>
