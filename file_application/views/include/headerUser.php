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
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////
-->
<!DOCTYPE html>
<html lang="<?= $this->lang->lang() ?>">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?=lang('g.description')?> ">
    <meta name="keywords" content="<?=lang('g.keywords')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
    <meta name="language" content="<?= lang('g.language') ?>">
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
    <style type="text/css" >
         .one{ font-size: 100%; margin-right: 10px;}
         .two {  font-size: 130%; margin-right: 10px;  }
         .three {  font-size: 170%; margin-right: 10px; }
         .mybadge { position: absolute; left: 41px; top: 5px; }
         .mybadge2 { position: absolute; left: 35px; top: 5px; }
         a{ text-decoration: none !important; }
         .dropdown-menu .glyphicon{  margin-top: 5px; margin-bottom: 5px; }
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
     <div class="container " >
 <!-- Navbar
      ================================================== -->
      <div class="bs-docs-section clearfix " >
        <div class="row">
          <div class="col-lg-12">
            <div class="bs-example">

                    <div class="navbar navbar-default"  style="font-size: 18px;">
                         <div class="navbar-header">
                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <a href="<?= new_url() ?>" class="navbar-brand"><i class=" glyphicon glyphicon-home one"></i>
                             <?=lang('g.mainpage')?></a>
                         </div>
                         <div class="navbar-collapse collapse navbar-responsive-collapse" id="navbar-main">
                           <ul class="nav navbar-nav">
                              <li><a href="<?php echo new_url() . 'main/works'; ?>"   >
                                 <i class="glyphicon glyphicon-book one"></i> <?=lang('g.how')?></a>
                              </li>
                              <li><a id="buttonOfferRide"  href="<?php echo new_url() . 'main/offerRide'; ?>"  >
                                     <i class="glyphicon glyphicon-briefcase one"></i> <?=lang('g.offer')?> </a>
                              </li> 
                              <li>
                                <a id="buttonFindRide" href="<?php echo new_url(  ((strcmp(lang('lang'), "tr") == 0) ? "ara-seyahat" : "search-travel" ) ); ?>"    >
                                  <i class=" glyphicon glyphicon-search one"></i> <?=lang('g.search')?></a>
                              </li>
                              <li><a data-toggle="modal" href="#report-problem"   >
                                <i class=" glyphicon glyphicon-flag one"></i> <?=lang('g.problem')?></a>
                              </li> 
                           </ul>
                           <ul class="nav navbar-nav navbar-right ">
                                <li ><a href="<?php echo new_url("profil")?>"   class="dan glyphicon glyphicon-bell three">
                                  <span class="badge btn-warning mybadge2"  ><?php echo $alert_count ?></span></a>
                                </li>
                                <li ><a href="<?php echo new_url() . 'message'  ?>"   class="succ glyphicon glyphicon-comment three">
                                    <span class="badge btn-warning mybadge"  ><?php echo $mesage_count ?></span></a>
                                </li>
                                <li style="padding:3px; padding-top:5px;">  </li>
                                <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#" id="themes"> 
                                      <img class="pic-img" src="<?= $fotoname ?> " width="20px" height="23px" > <?= $username ?> 
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="themes">
                                      <li style="margin-top:10px" ><a tabindex="0" href="<?php echo new_url() . 'profil/'  ?>">
                                        <i class="text-success  glyphicon glyphicon-dashboard two"></i> <?=lang('g.dashboard')?></a>
                                      </li>
                                      <li class="divider"></li>
                                      <li><a tabindex="1" href="<?php echo new_url() . 'profil/profile'   ?>">
                                        <i class="text-info     glyphicon glyphicon-user two"></i> <?=lang('g.profil')?></a>
                                      </li>
                                      <li><a tabindex="2" href="<?php echo new_url() . 'message'  ?>">
                                        <i class="text-warning  glyphicon glyphicon-comment two"></i> <?=lang('g.messages')?>  </a>
                                      </li>
                                      <li><a tabindex="3" href="<?php echo new_url() . 'review'   ?>">
                                        <i class="text-danger   glyphicon glyphicon-star two"></i> <?=lang('g.reviews')?>  </a>
                                      </li>
                                      <li><a tabindex="4" href="<?php echo new_url() . 'offer'    ?>">
                                        <i class="text-info     glyphicon glyphicon-briefcase two"></i> <?=lang('g.offers')?>  </a>
                                      </li>
                                      <li><a tabindex="5" href="<?php echo new_url() . 'alert'   ?>">
                                        <i class="text-danger   glyphicon glyphicon-bell two"></i> <?=lang('g.alerts')?>   </a>
                                      </li>
                                      <li class="divider"></li>
                                      <li><a tabindex="6" href="<?php echo new_url() . 'login/logOut'; ?>">
                                        <i class="text-danger   glyphicon glyphicon-log-out two"></i> <?=lang('g.logout')?> </a>
                                      </li>
                                    </ul>
                               </li>
                               <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle" style="padding-top:0px; padding-bottom:0px;" data-toggle="dropdown" href="#" id="themes">
                                       <i class="<?= $this->lang->lang() ?>-32"></i> 
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="themes">
                                      <li style="margin-top:10px" ><a tabindex="1" href="<?= base_url(). $this->lang->switch_uri('tr') ?>">
                                        <i class="tr"></i> 
                                          <?=lang('g.tr')?></a>
                                      </li>
                                      <li><a tabindex="2" href="<?=  base_url(). $this->lang->switch_uri('en')  ?>">
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
     </div> <!-- End of the container -->    
 
     <div class="container" style="padding: 0 100px 0px 100px">
         <div  id="message" ></div>
         <div id="fb-root"></div>
     </div>

    <script type="text/javascript">  var base_url = '<?php echo new_url(); ?>', enviroment = '<?php echo ENVIRONMENT ?>',  er={  <?= createErrorObject() ?> };   </script>
    <script src="<?php echo  base_url() . 'scripts/partial/headerUser.js'  ?>"></script> 
    