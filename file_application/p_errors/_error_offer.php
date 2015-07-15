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

<?php    
          // Get instance for load language file      
          $CI =& get_instance(); 
          $CI->lang->load('main'); 
?>

<!DOCTYPE html>
<html lang="<?= lang('lang') ?>">
  <head>
    <meta charset="utf-8">
    <meta name="language" content="<?= lang('g.language') ?>">
    <meta name="description" content="<?=lang('g.description')?> ">
    <meta name="keywords" content="<?=lang('g.keywords')?>">
    <title> <?=lang('g.title')?> </title>
    <link rel="icon" type="image/x-icon" href="<?php echo  base_url() . 'styles/images/ico.ico'  ?>">
    <link rel="image_src" href="<?php echo  base_url() . 'styles/images/ico.ico'  ?>" />

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
         .two {  font-size: 130%; margin-right: 10px;  }
         .three {  font-size: 170%; margin-right: 10px; }
         .mybadge { position: absolute; left: 41px; top: 5px; }
         .mybadge2 { position: absolute; left: 35px; top: 5px; }
         a{ text-decoration: none !important; }
         h1{color: #888888;} 
         .container{
             margin-top: 50px;
             padding: 50px;
             padding-left: 60px;
            /* -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.86), 0 0 40px rgba(0, 0, 0, 1) inset;
             -moz-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.06) inset;
            */ box-shadow: 0 1px 6px rgba(94, 101, 102, 0.71), 0 0 40px rgba(204, 204, 204, 0.28) inset;;
           }

          .width-400{width: 300px; margin-top: 5px; }
          .height-40{font-size: 18px; height: 20; }
          .margin-6{margin-top: 6px;}
          #map-canvas { height: 40em; width:98%; margin-left: 10px; margin-right: 10px; }
          #search {   border-width: 2px; border-radius: 50px; }
          #change-direct {   border-width: 2px; border-radius: 50px; } 
          .cont{padding: 15px 0px 0px 15px; font-size: 18px;}
          .cont-header{padding: 15px 0px 0px 15px;}
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
     <!--  Map css  -->
     <?php echo link_tag( base_url() . 'styles/map-main.css'); ?>
  </head>
  <body>
     <div class="container " >
     	    <div class="row " >
                   <h1 class="cont-header" ><?= lang("heading-offer") ?></h1>
                   <hr>
   		             <p  class="cont" style='font-size:17px;' ><?= lang("message_offer") ?> </p>
                   <hr>
                   <p  class="cont" style='font-size:20px; fonr-weight:bold' ><?= lang("message_offer2") ?> </p>
          </div>     
         
          <!-- Navbar
          ================================================== -->
          <div class="bs-docs-section clearfix">
            <div class="row">
              <div class="col-lg-12 no-padding">
               <div class="bs-example">
                        <div class="navbar navbar-default" style="padding-bottom:10px" >
                              <div class="col-lg-4">
                                <!--
                                <label for="inputStart" class="navbar-brand height-40" style="margin-top:17px; padding: 0 8px;" >  <?= lang('m.start') ?> : </label>
                                -->
                                <input id="pac-input" name="inputStart" type="text" class=" form-control" style="margin-top:8px;" placeholder=" <?= lang('m.startlocation') ?> ">
                              </div>
                              <div class="col-lg-4">
                                <!--
                                 <label for="inputStart" class="navbar-brand height-40" style="margin-top:17px; padding: 0 8px;"> <?= lang('m.arrivial') ?> : </label>
                                -->
                                 <input id="pac-input2" name="inputEnd" type="text" class="form-control " style="margin-top:8px;" placeholder=" <?= lang('m.destinationlocation') ?> ">
                              </div>
                              <div class="col-lg-1">
                                <button id="change-direct"  type="button" class="btn btn-default form-control  margin-6" style="margin-top:8px;" > &#60;   &#62; </button>
                              </div>
                              <div class="col-lg-3" >
                                <button id="search" type="button" class="btn btn-warning margin-6 form-control "  style="margin-top:8px;"> <?= lang('m.search') ?> </button>
                              </div>
                         </div><!-- /.navbar -->
                      </div><!-- /example -->      
              </div>
            </div>
          </div>       
          <!--    None display  MAP -->
          <div class="row">
               <div class="col-lg-12">
                  <div id="map" class="collapse in">
                     <div id="map-canvas"></div>
                  </div>   
               </div>  
          </div>    
          
          <hr>    
          <div class="row" > 
                <p class="cont" > <a href="<?= new_url() ?>" >
                          <i class=" glyphicon glyphicon-home one"></i>  <?=lang('mainpage')?>
                     </a> 
                </p>
          </div>    
           
           <footer class="row" style=" margin-top:20px; margin-bottom: 20px;">
              <div class="row" style="">
                <div class="col-lg-12 ">
                  <ul class="list-unstyled">
                     <li><a href="#"></a></li>
                  </ul>
                  <p class="footer cont-header" style=" text-align: left;" > <?= lang('g.developer')?> :<a target="blank" href="http://ismailakbudak.com"> İsmail AKBUDAK </a> 
                    - <a target="blank" href="http://www.pau.edu.tr/"> PAÜ </a>
                  </p>
                </div>
              </div>
            </footer>
    </div>
    <!-- Containers Ending
    ================================================== -->  
    <div id = "mesaj"></div>
    <div style="height:20px;"></div>    
    <script type="text/javascript"> 
          var base_url = '<?= new_url() ?>';
    </script>  
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false&#38;libraries=places"></script>
    <script src="<?php echo   base_url() . 'scripts/partial/map-main.js' ?>"></script> 
    <script >
        $(function(){
                $('[data-toggle="tooltip"]').tooltip({
                    trigger: 'hover',
                    'placement': 'top'
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