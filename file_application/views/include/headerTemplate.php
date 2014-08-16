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
         a{ text-decoration: none !important; }
         .one{ font-size: 100%; margin-right: 10px;}
         .two {  font-size: 130% !important; margin-right: 10px;  }
         .three {  font-size: 170% !important; margin-right: 10px; }
    </style>
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
    <script type="text/javascript"> var base_url = '<?php echo new_url(); ?>', enviroment = '<?php echo ENVIRONMENT ?>', er = {  <?= createErrorObject() ?> }; </script>
   </head>
  <body>
  	<div id="fb-root"></div>

 