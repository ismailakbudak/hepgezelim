     
      <?    $this->lang->load('main'); ?>
     <!--  Map css  -->
     <?php echo link_tag( base_url() . 'styles/map-main.css'); ?>
     <style >
       .width-400{width: 300px; margin-top: 5px; }
       .height-40{font-size: 18px; height: 20; }
       .margin-6{margin-top: 6px;}
       #map-canvas { height: 40em; width:98%; margin-left: 10px; margin-right: 10px; }
       #search {   border-width: 2px; border-radius: 50px; }
       #change-direct {   border-width: 2px; border-radius: 50px; }      
     </style>

    <!-- container
    ================================== --> 
    <div class="container">
      
      <div class="rov">
          <?php 
                  if( isset($val) )
                     echo $val; 
          ?> 
      </div>
      <!-- page-header
      ================================== 
      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-5">
            <h3> <?= lang('m.adres') ?> </h3>
            <p class="lead"> <?= lang('m.help') ?> </p>     
          </div>
      </div>
      -->
      <!-- Navbar
      ================================================== -->
      <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
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
     
      <div class="row">
           <div class="col-lg-12">
              <!--MAP
              ============================================-->
              <div id="map" class="collapse in">
                 <div id="map-canvas"></div>
              </div>   
           </div>  
        </div>      
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false&#38;libraries=places"></script>
    <script src="<?php echo   base_url() . 'scripts/partial/map-main.js' ?>"></script> 
    <script type="text/javascript">
       (function($){  $( "#pac-input" ).focus();     })(jQuery);            
    </script>
 
