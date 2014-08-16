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
<!DOCTYPE html>
<html lang="<?= $this->lang->lang() ?>">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="<?=lang('g.description')?>">
    <meta name="keywords" content="<?=lang('g.keywords')?>">
    <title> <?=lang('g.title')?>  </title>
    <meta name="copyright" content="@ Copyright 20013-2014">
    <meta name="author" content="ismailakbudak">
    <meta name="language" content="<?= lang('g.language') ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo  base_url() . 'styles/images/ico.png'  ?>">

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
    <style>
         .one{ font-size: 100%; margin-right: 10px;}
         .two {  font-size: 100%; margin-right: 10px;  }
         .three {  font-size: 170%; margin-right: 10px; } 
         .dropdown-menu .glyphicon{margin-top: 7px; margin-bottom: 7px;}
         .mybadge{  margin-left: 5px;}
         .mybadge3{position: absolute; left: 73px; top: 9px;}
         .mybadge4{position: absolute; left: 95px; top: 9px;}
         .mybadge5{position: absolute; left: 110px; top: 9px;}
         a{ text-decoration: none !important; }
        
    </style>  
    <script type="text/javascript">
         var lang      = '<?= lang("lang") ?>', 
             dayNames  = [  "Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
             dayNamesMin = [ "Pz", "Pt", "Sa", "Çş", "Pş", "Cm", "Ct" ],
             monthNames = [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
             nextText = "Sonraki",
             goTop    = "Başa Dön",
             prevText = "Önceki";
         if( strcmp(lang, "en") == 0 ){
            dayNames  = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
            dayNamesMin = [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"  ];
            monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
            nextText = "Next";
            goTop    = "Back to Top",
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
                            <a href="<?= new_url('admin_hepgezelim') ?>" class="navbar-brand"><i class=" glyphicon glyphicon-home one"></i>
                             <?=lang('g.mainpage')?> </a>
                         </div>
                         <div class="navbar-collapse collapse navbar-responsive-collapse" id="navbar-main">
                           <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#" id="themes"> 
                                       <?=lang('a.approval')?> 
                                       <i class="  glyphicon glyphicon-tasks two"> </i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="themes">
                                         <li ><a href="<?php echo new_url('admin_hepgezelim/car_photo_view') ?>">
                                              <i class="dan glyphicon glyphicon-camera two"> </i>
                                              <?=lang('a.car-photo')?> 
                                              <span class="badge btn-warning mybadge"  ><?php echo $car_photo_count ?></span></a>
                                         </li>
                                         <li ><a href="<?php echo new_url('admin_hepgezelim/user_photo_view') ?>"   >
                                              <i class="dan glyphicon glyphicon-camera two"> </i>
                                              <?=lang('a.user-photo')?> 
                                              <span class="badge btn-warning  mybadge"  ><?php echo $user_photo_count ?></span></a>
                                         </li>
                                    </ul>  
                                </li>
                                <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#" id="themes"> 
                                       <?=lang('a.complain')?>  
                                       <i class="  glyphicon glyphicon-tasks two"> </i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="themes">
                                           <li ><a href="<?php echo new_url('admin_hepgezelim/alert_user_view')  ?>"   >
                                                 <i class="dan glyphicon glyphicon-bell two"> </i>
                                                 <?=lang('a.message-complain')?>
                                                 <span class="badge btn-warning mybadge"  ><?php echo $alert_user_count ?></span></a>
                                           </li>
                                            <li ><a href="<?php echo new_url('admin_hepgezelim/complain_user_view')  ?>"    >
                                                 <i class="dan glyphicon glyphicon-flag two"> </i>
                                                 <?=lang('a.user-complain')?> 
                                                 <span class="badge btn-warning mybadge"  ><?php echo $complain_count ?></span></a>
                                           </li>
                                            <li ><a href="<?php echo new_url('admin_hepgezelim/banned_user_view')  ?>"    >
                                                   <i class="dan glyphicon glyphicon-ban-circle two"> </i>
                                                   <?=lang('a.user-banned')?>  
                                                </a>
                                           </li>
                                    </ul>
                                </li>      
                                
                                <li ><a href="<?php echo new_url('admin_hepgezelim/contact_view')  ?>"   >
                                       <?=lang('a.contacts')?> 
                                       <i class="  glyphicon glyphicon-envelope two"> </i>
                                       <span class="badge btn-warning mybadge4"  ><?php echo $contact_count ?></span></a>
                                </li>
                                
                                <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#" id="themes"> 
                                       <?=lang('a.reports')?>
                                       <i class="  glyphicon glyphicon-tasks two"> </i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="themes">
                                          <li ><a href="<?php echo new_url('admin_hepgezelim/delete_acount_view')  ?>"   >
                                                 <i class="dan glyphicon glyphicon-warning-sign two"> </i>
                                                <?=lang('a.delete-reason')?> 
                                                <span class="badge btn-warning mybadge"  ><?php echo $delete_acount_count ?></span></a>
                                          </li> 
                                          <li ><a href="<?php echo new_url('admin_hepgezelim/problem_view')  ?>"   >
                                                <i class="dan glyphicon glyphicon-list-alt two"> </i>
                                                 <?=lang('a.problems')?>
                                                <span class="badge btn-warning mybadge"  ><?php echo $problem_count ?></span></a>
                                          </li>  
                                    </ul>
                                </li>  
            
                           </ul>
                           <ul class="nav navbar-nav navbar-right ">
                               <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#" id="themes"> 
                                      <img class="pic-img" src="<?= $fotoname ?> " width="20px" height="23px" > <?= $username ?> 
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="themes">
                                         <li><a tabindex="6" href="<?php echo new_url('admin_hepgezelim/logoutProcess') ?>">
                                          <i class="text-danger   glyphicon glyphicon-log-out two"></i> <?=lang('g.logout')?> </a>
                                        </li> 
                                    </ul>
                               </li>
                               <li class="dropdown">
                                    <!-- data-toggle="dropdown" href="#" -->
                                    <a class="dropdown-toggle" style="padding-top:0px; padding-bottom:0px;"   data-toggle="dropdown" href="#" id="themes">
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
  

    <script type="text/javascript">
        var base_url = '<?php echo new_url("admin_hepgezelim/"); ?>';
        var enviroment = '<?php echo ENVIRONMENT ?>'; 
        var er={  <?= createErrorObject() ?> };
       // alert(JSON.stringify(er, null, 4));
              
    </script>
    <script src="<?php  base_url() . 'scripts/partial/headerUser.js'  ?>"></script> 
    <script type="text/javascript">
      
      $( function(){
          
          $( ".dropdown-toggle" ).on('mouseover',function(){
              // $( this ).addClass("open");
              // $( this ).parent().toggleClass("open");
          });

      });
    
    </script>