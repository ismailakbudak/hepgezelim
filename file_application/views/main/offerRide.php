
    <?    $this->lang->load('offer'); ?>
    <!-- container
    ================================== --> 
     <!--  Map css  -->
     <?php echo link_tag( base_url() . 'styles/map-main.css'); ?>
    <script type="text/javascript">    <?= offerRideError() ?> </script>
    <div class="container">
     <style>
        .margin-top-30{margin-top: 30px;}
        .date{        background-color: #fff;
                      padding: 0 27px 0 25px;
                      width: 140px;
                      text-align: center;
                      border-width: 2px;
                      border-radius: 50px;   
                      font-size: 15px;
                      font-weight: 300;
                      text-overflow: ellipsis;
                    }       
       .form-padding{ padding: 10px; }
        #buttonAdd {   border-width: 2px; border-radius: 50px; }
        #map-canvas { height: 30em; width:auto; margin: 5px;   }
        .minus{  border-width: 0px; border-radius: 50px;}
        
        #weekDaysStart{ margin-top: 7px; }
        .day{ margin: 0em; width: 25px; height: 25px; margin: 0px; }
        .day-label{font-size: 11px; padding: 0px;}
        #twoWayCheck:hover { cursor: pointer; }
        .hover-pointer:hover{cursor: pointer;}
        .padding-10{ padding-left: 20px; padding-right: 20px;}
        .left{ text-align: right; float: center;}
        .pad-0{ padding-right: 0px !important; padding-left: 0px !important; margin-right: 0px !important; }
        .pad-10{ margin-left: 5px; margin-top: 10px; }
        .test{ padding-left: 55px; padding-top:10px; padding-bottom:10px;}
     </style>

    <!--AÇıklama
    ============================================-->   
     <div class="row margin-top-30">
          <div class="col-lg-6">
                <div class="well">
                    <form class="bs-example form-horizontal">
                        <fieldset>
                               <legend> <?= lang('o.newoffer') ?> </legend>
        
                                 <h4 id="progress-basic"> <?= lang('o.progcomplete') ?> %30</h4>
                                 <div class="bs-example">
                                   <div class="progress"  title=" <?= lang('o.progTitle') ?>">
                                     <div class="progress-bar" style="width: 30%;"></div>
                                   </div>
                                 </div>
                                 
                                    <!-- Birinci panel 
                                  ====================================-->
                                 <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h3 class="panel-title"> <?= lang('o.triptype') ?> </h3>
                                      </div>
                                      <div class="panel-body">
                                           <div class="form-group">
                                            <div class="col-lg-5">
                                              <div class="radio">
                                                  <label>
                                                    <input type="radio" name="radiosTime" id="radiosOnetime" value="onetime" checked="">
                                                     <?= lang('o.onetime') ?> 
                                                  </label>
                                              </div>
                                            </div>
                                            <div class="col-lg-5">
                                              <div class="radio">
                                                 <label>
                                                    <input type="radio" name="radiosTime" id="radiosManytime" value="manytime">
                                                     <?= lang('o.manytime') ?>   
                                                  </label>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                 </div> <!-- Birinci panel sonunu--> 
                                   
                                 <!-- ikinci panel 
                                 ====================================-->
                                 <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h3 class="panel-title"> <?= lang('o.route') ?> </h3>
                                      </div>
                                      <div class="panel-body" id="iteneraryPanel">

                                           <div class="form-group form-padding" >
                                             <input id="pac-input" name="inputStart" type="text" class="collapse in form-control " 
                                              placeholder=" <?= lang('o.location') ?> ">
                                           </div>  
                                           <div class="form-group form-padding" >
                                               <input id="pac-input2" name="inputEnd" type="text" class="collapse in form-control  "
                                                placeholder=" <?= lang('o.destination') ?> ">
                                           </div>

                                           <div class="form-group form-padding" >
                                               <label class="control-label"> <?= lang('o.addroute') ?> </label>
                                               <button id="buttonAdd" type="button" class="btn btn-sm btn-warning"> <?= lang('o.add') ?> </button>
                                                <span class="help-block"> <?= lang('o.routeexample') ?> </span>
                                           </div>

                                      </div>
                                 </div> <!-- İkinci panel sonunu--> 

                                 <!-- 3. panel 
                                 ====================================-->
                                 <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <div class="row"> 
                                            <div class="col-lg-8" style="padding-bottom:15px">
                                               <h3 class="panel-title"> <?= lang('o.time') ?> </h3>
                                            </div>
                                            <div class="col-lg-4" >
                                                <label for="twoWayCheck" class="hover-pointer">
                                                      <input id="twoWayCheck" type="checkbox" name="twoWayCheck"> <?= lang('o.twoway') ?>
                                                </label>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="panel-body" id="iteneraryPanel">
                                         
                                          <!-- One time trip contetn begin 
                                          ================================= -->
                                          <div id="onetimeContent"  >
                                            <div class="form-group ">
                                                 <label for="datepickerStart" class="col-lg-3 control-label " >
                                                     <i class="text-success glyphicon glyphicon-calendar two" style="margin-right:0px;"></i> <?= lang('o.departure')?> 
                                                  </label>
                                                 <div class="col-lg-4" style="padding-bottom: 10px">
                                                     <input title="<?= lang('o.traveldateTitle') ?>" type="text" class="form-control date input-sm" id="datepickerStart" 
                                                     placeholder="<?= lang('o.date') ?>">
                                                 </div>
                                                 <div class="col-lg-5" title="<?= lang('o.traveltimeTitle') ?>">
                                                      <i class="text-success glyphicon glyphicon-time two" style="float:left; padding-top:5px; margin-right:5px;"></i> 
                                                      <div style="width:60px; float:left">
                                                         <select class="form-control input-sm" id="datepickerStartTimeHour">
                                                          <?php 
                                                                 for ($i=0; $i < 24; $i++){
                                                                     if($i < 10) 
                                                                         echo "<option value='0{$i}'> 0$i </option>";
                                                                      else{
                                                                           if($i == 12)
                                                                               echo "<option selected value='{$i}'> $i </option>"; 
                                                                            else
                                                                               echo "<option value='{$i}'> $i </option>"; 
                                                                       }     
                                                                  }              
                                                           ?>
                                                        </select>
                                                      </div>
                                                      <label style="float:left; padding:5px; padding-top:5px; ">:</label>
                                                      <div class="" style="width:60px; float:left">
                                                         <select class="form-control input-sm" id="datepickerStartTimeSecond">
                                                          <option value="00">00</option>
                                                          <option value="10">10</option>
                                                          <option value="20">20</option>
                                                          <option value="30" selected >30</option>
                                                          <option value="40">40</option>
                                                          <option value="50">50</option>
                                                        </select>
                                                      </div>
                                                 </div>     
                                            </div>
                                            <div class="form-group " id="returnDate" >
                                                 <label for="datepickerEnd" class="col-lg-3 control-label">
                                                      <i class="text-danger glyphicon glyphicon-calendar two"></i><?= lang('o.return') ?> 
                                                 </label>
                                                 <div class="col-lg-4" style="padding-bottom: 10px">
                                                   <input type="text" title="<?= lang('o.returnTitledate') ?>" class="form-control date input-sm" id="datepickerEnd" 
                                                   placeholder="<?= lang('o.date') ?>">
                                                 </div>
                                                 <div class="col-lg-5" title="<?= lang('o.returnTitletime') ?>">
                                                      <i class="text-danger glyphicon glyphicon-time two" style="float:left; padding-top:5px; margin-right:5px;"></i> 
                                                     <div style="width:60px; float:left">
                                                       <select class="form-control input-sm" id="datepickerEndTimeHour">
                                                         <?php 
                                                                for ($i=0; $i < 24; $i++){
                                                                    if($i < 10) 
                                                                        echo "<option value='{$i}'> 0$i </option>";
                                                                     else{
                                                                          if($i == 12)
                                                                              echo "<option selected value='{$i}'> $i </option>"; 
                                                                           else
                                                                              echo "<option value='{$i}'> $i </option>"; 
                                                                      }     
                                                                 }              
                                                          ?>
                                                       </select>
                                                     </div>
                                                     <label style="float:left; padding:5px; padding-top:5px; ">:</label>
                                                     <div class="" style="width:60px; float:left">
                                                        <select class="form-control input-sm" id="datepickerEndTimeSecond">
                                                         <option value="00">00</option>
                                                         <option value="10">10</option>
                                                         <option value="20">20</option>
                                                         <option value="30" selected >30</option>
                                                         <option value="40">40</option>
                                                         <option value="50">50</option>
                                                       </select>
                                                     </div>
                                               </div>
                                            </div>
                                          </div> <!-- onetimeContent finish -->

                                           <!-- One time trip contetn begin 
                                           ================================= -->
                                           <div id="manytimeContent" style="display:none" >
                                              
                                              <div id="departureDays" class='row pad-10' >
                                                      <div class="row pad-10">
                                                            <div id="weekDaysStart" class="col-lg-7 pad-0" title="<?= lang('o.tripdaysTitle') ?>">
                                                                   <input type="checkbox" class="day" id="check1">
                                                                   <label data-name='Pazartesi' class="day-label" for="check1"><?= lang('o.mon') ?></label>
                                                                   <input type="checkbox" class="day" id="check2">
                                                                   <label data-name='Salı' class="day-label" for="check2"><?= lang('o.tue') ?></label>
                                                                   <input type="checkbox"  class="day" id="check3">
                                                                   <label data-name='Çarşamba' class="day-label" for="check3"><?= lang('o.wed') ?></label>
                                                                   <input type="checkbox" class="day" id="check4">
                                                                   <label data-name='Perşembe' class="day-label" for="check4"><?= lang('o.thu') ?></label>
                                                                   <input type="checkbox" class="day" id="check5">
                                                                   <label data-name='Cuma'  class="day-label" for="check5"><?= lang('o.fri') ?></label>
                                                                   <input type="checkbox" class="day" id="check6">
                                                                   <label data-name='Cumartesi'  class="day-label" for="check6"><?= lang('o.sat') ?></label>
                                                                   <input type="checkbox" class="day" id="check7">
                                                                   <label data-name='Pazar' class="day-label" for="check7"><?= lang('o.sun') ?></label>
                                                            </div>
                                                            <div class="col-lg-5" title="<?= lang('o.traveldeparturetime') ?> ">
                                                                   <i class="text-success glyphicon glyphicon-time two"  style="float:left; padding-top:5px; margin-right:5px;"></i> 
                                                                  <div style="width:60px; float:left">
                                                                    <select class="form-control input-sm" id="weekDaysStartHour">
                                                                      <?php 
                                                                             for ($i=0; $i < 24; $i++){
                                                                                 if($i < 10) 
                                                                                     echo "<option value='0{$i}'> 0$i </option>";
                                                                                  else{
                                                                                       if($i == 12)
                                                                                           echo "<option selected value='{$i}'> $i </option>"; 
                                                                                        else
                                                                                           echo "<option value='{$i}'> $i </option>"; 
                                                                                   }     
                                                                              }              
                                                                       ?>
                                                                    </select>
                                                                  </div>
                                                                  <label style="float:left; padding:5px; padding-top:5px; ">:</label>
                                                                  <div class="" style="width:60px; float:left">
                                                                     <select class="form-control input-sm" id="weekDaysStartMinute">
                                                                      <option value="00">00</option>
                                                                      <option value="10">10</option>
                                                                      <option value="20">20</option>
                                                                      <option value="30" selected >30</option>
                                                                      <option value="40">40</option>
                                                                      <option value="50">50</option>
                                                                    </select>
                                                                  </div>
                                                            </div>
                                                        </div>    
                                              </div>
                                             
                                              <div id="returnDays" class='row pad-10' >
                                                     <div class="row pad-10">
                                                            <div id="weekDaysReturn" class="col-lg-7 pad-0" title="<?= lang('o.returndaysTitle') ?>">
                                                                   <input type="checkbox" class="day" id="check11">
                                                                   <label data-name='Pazartesi' class="day-label" for="check11"><?= lang('o.mon') ?></label>
                                                                   <input type="checkbox" class="day" id="check22">
                                                                   <label data-name='Salı' class="day-label" for="check22"><?= lang('o.tue') ?></label>
                                                                   <input type="checkbox"  class="day" id="check33">
                                                                   <label data-name='Çarşamba' class="day-label" for="check33"><?= lang('o.wed') ?></label>
                                                                   <input type="checkbox" class="day" id="check44">
                                                                   <label data-name='Perşembe' class="day-label" for="check44"><?= lang('o.thu') ?></label>
                                                                   <input type="checkbox" class="day" id="check55">
                                                                   <label data-name='Cuma' class="day-label" for="check55"><?= lang('o.fri') ?></label>
                                                                   <input type="checkbox" class="day" id="check66">
                                                                   <label data-name='Cumartesi' class="day-label" for="check66"><?= lang('o.sat') ?></label>
                                                                   <input type="checkbox" class="day" id="check77">
                                                                   <label data-name='Pazar' class="day-label" for="check77"><?= lang('o.sun') ?></label>
                                                            </div>
                                                            <div class="col-lg-5" title="<?= lang('o.travelreturntime') ?>">
                                                                   <i class="text-danger glyphicon glyphicon-time two"  style="float:left; padding-top:5px; margin-right:5px;"></i> 
                                                                  <div style="width:60px; float:left">
                                                                    <select class="form-control input-sm" id="weekDaysReturnHour">
                                                                      <?php 
                                                                             for ($i=0; $i < 24; $i++){
                                                                                 if($i < 10) 
                                                                                     echo "<option value='0{$i}'> 0$i </option>";
                                                                                  else{
                                                                                       if($i == 12)
                                                                                           echo "<option selected value='{$i}'> $i </option>"; 
                                                                                        else
                                                                                           echo "<option value='{$i}'> $i </option>"; 
                                                                                   }     
                                                                              }              
                                                                       ?>
                                                                    </select>
                                                                  </div>
                                                                  <label style="float:left; padding:5px; padding-top:5px; ">:</label>
                                                                  <div class="" style="width:60px; float:left">
                                                                     <select class="form-control input-sm" id="weekDaysReturnMinute">
                                                                      <option value="00">00</option>
                                                                      <option value="10">10</option>
                                                                      <option value="20">20</option>
                                                                      <option value="30" selected >30</option>
                                                                      <option value="40">40</option>
                                                                      <option value="50">50</option>
                                                                    </select>
                                                                  </div>
                                                            </div> 
                                                      </div>      
                                              </div>
                                              
                                              <div class='row'>
                                                   <div class='row'> 
                                                      <div class='col-lg-6 test' style="padding-left: 70px;">
                                                                  <div class="row">
                                                                        <div class="row">
                                                                              <label for="datepickerStartDay" title=" <?= lang('o.travelstartdateTitle') ?>" class="control-label">
                                                                                    <i class="text-success glyphicon glyphicon-calendar two"></i> <?= lang('o.start') ?> :
                                                                              </label>
                                                                        </div>      
                                                                        <div class="row">
                                                                              <input type="text" title="<?= lang('o.travelstartdateTitle') ?>" class="form-control input-sm date" id="datepickerStartDay" 
                                                                              placeholder="<?= lang('o.date') ?>">
                                                                        </div>
                                                                 </div> 
                                                           </div>
                                                           <div class='col-lg-6 test'  style="padding-left: 70px;">
                                                                 <div class="row">
                                                                        <div class="row"> 
                                                                             <label for="datepickerEndDay" title="<?= lang('o.travelfinishdateTitle') ?> " class="control-label">
                                                                                <i class="text-danger glyphicon glyphicon-calendar two"></i> <?= lang('o.finish') ?> :
                                                                             </label>
                                                                        </div>
                                                                        <div class="row">
                                                                              <input type="text" title="<?= lang('o.travelfinishdateTitle') ?>" class="form-control input-sm date" id="datepickerEndDay" 
                                                                              placeholder="<?= lang('o.date') ?>">
                                                                        </div>
                                                                 </div> 
                                                           </div>
                                                    </div>
                                                    <div id="dateKontrol"></div>
                                              </div>
                                          </div><!-- manytimeContent finish -->

                                      </div><!-- Panel body end-->
                                 </div> <!-- 3. panel sonunu--> 

                                 <div class="form-group form-padding">
                                   <div class="col-lg-10 col-lg-offset-9">
                                     <button id="inputContinue" type="button" class="btn btn-primary"><?= lang('o.continue') ?></button> 
                                   </div>
                                 </div>

                          <fieldset>
                    </form>
               </div>
          </div>
          <!--MAP
          ============================================-->        
          <div class="col-lg-6" >
                <div class="well">
                     <legend><?= lang('o.travelroute') ?> </legend>
                      <div id="map" class="collapse in">
                         <div id="map-canvas"></div>
                      </div>
                       <div class="panel panel-default">
                            <div class="panel-heading">
                              <div class="row"> 
                                  <div class="col-lg-8">
                                     <h3 class="panel-title"> <?= lang('o.tripinfo') ?></h3>
                                  </div>
                              </div>
                            </div>
                            <div class="panel-body" id="iteneraryPanel">
                                   <div id="total" class="form-group form-padding"> </div>
                            </div>
                      </div>
                </div>
          </div>
      </div> 
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false&#38;libraries=places"></script>
    <script src="<?php echo  base_url() . 'scripts/partial/offerRide.js'  ?>"></script>
