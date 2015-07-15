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
         a{ text-decoration: none !important; }
         .one{ font-size: 100%; margin-right: 10px;}
         .two {  font-size: 130% !important; margin-right: 10px;  }
         .three {  font-size: 170% !important; margin-right: 10px; }
    </style> 
  </head>
  <body>

  <script type="text/javascript">
       var base_url = '<?php echo new_url("admin_hepgezelim/"); ?>';
       var enviroment = '<?php echo ENVIRONMENT ?>';
        var er={  <?= createErrorObject() ?> };
       //alert(JSON.stringify(er, null, 4));
        $( function(){
                 // $( "#loading" ).modal();
        });
  </script>
 