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
**    UPDATE    : 28-04-2014 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////
-->
<?php
   $datas['base_url'] =  MY_APP_URL;
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="language" content="Turkish"> 
    <meta name="description" content="Hepgezelim.com boş koltuklarınızı ve masraflarınızı paylaştıran ücretsiz bir servistir. Sitenin amacı  her gün aynı güzergah üzerinde işe giden, sık sık veya ara sıra seyahat eden kişilerin  kendisine yol arkadaşları bulmasını sağlamaktır.   Bu sayede insanlar ucuza seyahet edebilecek, trafikteki araç sayısı azalacak ve araç sahipleri de yol masraflarının belli bir kısmını karşılayabilceklerdir.">
    <meta name="keywords" content="hepgezelim,  hep gezelim , hep gez, hepgez, hep-gezelim, hep-gez, gel gezelim, seyahat paylaş, seyahat paylaşımı,araç paylaş, sürüş paylaş, araç paylaşımı, araba paylaş, arabanı paylaş, seyahatini paylaş, yolculuk et, yolculuk, yol arkadaşı, seyahat arkadaşı, araç arkadaşı, araba arkadaşı, seyahat edelim, seyahat et  ">
    <title> Seyahat Paylaşım Sitesi  </title>
    <link rel="icon" type="image/x-icon" href="<?= MY_APP_URL?>styles/images/ico.ico">

    <!--   CSS files  
    =====================================-->
    <link type="text/css" rel="stylesheet" href="<?= $datas['base_url'] . 'styles/bootstrap.min.css'  ?>">
    <link type="text/css" rel="stylesheet" href="<?= $datas['base_url'] . 'styles/demand/jquery-ui-custom.min.css' ?>">
    <link type="text/css" rel="stylesheet" href="<?= $datas['base_url'] . 'styles/message.css' ?>">
    <link type="text/css" rel="stylesheet" href="<?= $datas['base_url'] . 'styles/bootstrap-modal.css' ?>">
    <link type="text/css" rel="stylesheet" href="<?= $datas['base_url'] . 'styles/application.css' ?>">
     <!--   JavaScript files  
    =====================================-->
    <script src="<?=  $datas['base_url'] . 'scripts/general/jquery.min.js'  ?>"></script>
    <script src="<?=  $datas['base_url'] . 'scripts/general/bootstrap.min.js'  ?>"></script>
    <script src="<?=  $datas['base_url'] . 'scripts/general/jquery-ui-custom.min.js'  ?>"></script>
    <!---Sonradan dahil edilen kodlar -->
    <script src="<?=  $datas['base_url'] . 'scripts/general/message.js' ?>"></script>
    <script src="<?=  $datas['base_url'] . 'scripts/partial/application.js' ?>"></script>
    <script src="<?=  $datas['base_url'] . 'scripts/general/bootstrap-modalmanager.js'  ?>"></script> 
    <script type="text/javascript">
         var lang      = 'tr', 
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

        </style>  
     <div class="container " >
     	      <hr>
            <div class="row" > 
                 <div class="col-lg-6" >
                         <h1 >  404 Sayfa Bulunamadı :(  </h1>
         		         <p > İstediğiniz sayfa bulunamadı. </p>
                         <p> <a href="<?=  $datas['base_url'] ."tr" ?>" class="navbar-brand">
                                   <i class=" glyphicon glyphicon-home one"></i>  Anasayfaya Dön
                              </a> 
                         </p>
                 </div>
                 <div class="col-lg-6" >
                         <h1 > 404 Page Not Found :( </h1>
                         <p> The page you requested was not found. </p>
                         <p> <a href="<?=  $datas['base_url'] . "en" ?>" class="navbar-brand">
                                   <i class=" glyphicon glyphicon-home one"></i>  Go Back Homepage
                              </a> 
                         </p>
                 </div>
           </div>
           <hr>
           <footer class="row" style=" margin-top:20px; margin-bottom: 20px;">
                <div class="col-lg-12 ">
                  <ul class="list-unstyled">
                     <li><a href="#"></a></li>
                  </ul>
                  <p class="footer" style=" text-align: center;" > Geliştirici :<a target="blank" href="http://ismailakbudak.com"> İsmail AKBUDAK </a> 
                    - <a target="blank" href="http://www.pau.edu.tr/"> PAÜ </a>
                  </p>
                </div>
            </footer>

    </div>
    <!-- Containers Ending
    ================================================== -->  
    <div id = "mesaj"></div>
    <div style="height:20px;"></div>    
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
**    
**    UPDATE    : 28-04-2014 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////
-->