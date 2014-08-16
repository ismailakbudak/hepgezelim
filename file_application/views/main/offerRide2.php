    <?    $this->lang->load('offer'); ?>
    <?    $this->lang->load('offerinfo'); ?>
    <!-- container
    ================================== --> 
     <!--  Map css  -->
     <?php echo link_tag( base_url() . 'styles/map-main.css'); ?>
    <script type="text/javascript">    <?= offerRideError() ?> </script>
    <div class="container">
     <style>
        .margin-top-30{margin-top: 30px;}
        .date{  background-color: #fff;
                      padding: 0 27px 0 25px;
                      width: 160px;
                      text-align: center;
                      border-width: 2px;
                      border-radius: 50px;   
                      font-size: 15px;
                      font-weight: 300;
                      text-overflow: ellipsis;
                    }       
        .form-padding{ padding: 10px; }
        .form-padding2{  padding: 2px; padding-left: 6px; padding-right: 10px; }
        #buttonAdd {   border-width: 2px; border-radius: 50px; }
        #map-canvas { height: 30em; width:auto; margin: 5px;   }
        .inputNumber{  font-size: 18px;
                       -webkit-appearance: textfield;
                       -webkit-rtl-ordering: logical;
                       -webkit-user-select: text;
                       padding: 4px 8px;  }
        .bold{font-weight: bold; } 
        .green{color: #009900; font-weight: bold; }
        .orange{color: #CC9900; font-weight: bold;}
        .red{color: #990000; font-weight: bold;}
        #weekDaysStart{ margin-top: 7px; }
        .day{ margin: 0em; width: 30px; height: 25px; margin: 0px; }
        .day-label{font-size: 11px; padding: 0px;}
        #twoWayCheck:hover { cursor: pointer; }
        .hover-pointer:hover{cursor: pointer;}
        .padding-10{ padding-left: 20px; padding-right: 20px;}
        .left{ text-align: right; float: center;}
        .help{font-weight: normal; padding-left: 38px;}
        textarea{ max-width: 475px;  max-height: 200px; }
        .popover-content{width: 250px; font-weight: normal; }
        .popover-content .row{ margin: 0px;  padding: 0px;   }
        .tip{ margin-bottom: 2px; margin-right: 5px;}
        .help-block.others{margin-top: 0px; margin-bottom: -10px;}
        .help.others{ font-size: 13px; }
     </style>

    <!--AÇıklama
    ============================================-->   
     <div class="row margin-top-30">
          <div class="col-lg-6">
                <div class="well ">
                    <form class="bs-example form-horizontal" onsubmit="return false">
                        <fieldset>
                               <legend> <?=lang('o.newoffer')?> </legend>
                                  <h4 id="progress-basic" > <?=lang('o.progcomplete')?> %80</h4>
                                 <div class="bs-example">
                                   <div class="progress"  title=" <?=lang('o2.progTitle')?> ">
                                     <div class="progress-bar" style="width: 80%;"></div>
                                   </div>
                                   <?php //print_r($test);  ?>
                                 </div>
                                 
                                 <!-- Birinci panel 
                                  ====================================-->
                                 <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h3 class="panel-title"> <?=lang('o2.price')?> </h3>
                                      </div>
                                      <div class="panel-body">
                                         <div class="form-group form-padding">
                                            <div class="col-lg bold" id="prices" >
                                              <?php
                                                // for way points    
                                                function wayPointsWrite($val1 , $val2 ,  $id=''){
                                                   $path = base_url() ."styles/images/search-from.png";
                                                   echo "<div class='row' data-key='{$val1}'> 
                                                               <div class='form-padding2' id='{$id}' >
                                                                  <div class='col-lg-8'> 
                                                                     <img src='{$path}' width='14px' height='25px' >
                                                                     <label class='control-label city'>{$val1}  →  {$val2}</label>
                                                                  </div>
                                                                  <div class='input-group col-lg-4'  
                                                                        rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc '&gt;  &lt;strong class='green'  &gt;". lang('od.green')  ."&lt;/strong&gt;". lang('od.low')     ."&lt;/span&gt; 
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='orange' &gt;". lang('od.orange') ."&lt;/strong&gt;". lang('od.normal')  ."&lt;/span&gt;
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='red'    &gt;". lang('od.red')    ."&lt;/strong&gt;". lang('od.high')    ."&lt;/span&gt;\" data-trigger='hover' data-html='true'
                              
                                                                      >
                                                                      <span class='input-group-addon input-sm'>₺</span>
                                                                      <input  value='0' class='form-control input-sm inputNumber' data-pricemax='10000' type='text' >
                                                                      <span class='input-group-btn'>
                                                                              <button type='button' class='btn btn-danger btn-sm plus'>+</button>
                                                                              <button type='button' class='btn btn-success btn-sm minus'>-</button>
                                                                      </span>
                                                                   </div>
                                                               </div>
                                                           </div>";
                                                }
                                                // waypoints last
                                                function wayPointsWriteLast($val1 , $val2 ,  $id=''){
                                                   $path = base_url() ."styles/images/search-from.png";
                                                   echo "<div class='row' data-key='{$val1}' > 
                                                               <div class='form-padding2' id='{$id}' >
                                                                  <div class='col-lg-8'> 
                                                                     <img src='{$path}' width='14px' height='25px' >
                                                                     <label class='control-label city'>{$val1}  →  {$val2}</label>
                                                                  </div>
                                                                  <div class='input-group col-lg-4'   
                                                                        rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc '&gt;  &lt;strong class='green'  &gt;". lang('od.green')  ."&lt;/strong&gt;". lang('od.low')     ."&lt;/span&gt; 
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='orange' &gt;". lang('od.orange') ."&lt;/strong&gt;". lang('od.normal')  ."&lt;/span&gt;
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='red'    &gt;". lang('od.red')    ."&lt;/strong&gt;". lang('od.high')    ."&lt;/span&gt;\" data-trigger='hover' data-html='true'
                              
                                                                      >
                                                                      <span class='input-group-addon input-sm' title='".lang('o2.tl') ."' >₺</span>
                                                                      <input value='0' disabled class='form-control input-sm inputNumber' data-pricemax='10000' type='text' >
                                                                      <span class='input-group-btn'>
                                                                              <button type='button' disabled class='btn btn-danger btn-sm plus'>+</button>
                                                                               <button type='button' disabled class='btn btn-success btn-sm minus'>-</button>
                                                                      </span>
                                                                  </div>
                                                               </div>
                                                           </div>
                                                           <div class='row help others'   title='".lang('o2.expectedpriceTitle')."' > 
                                                                <span class='help-block others' style='float: left; margin-right: 4px;'> ". lang('o2.expectedprice') . " : </span>
                                                                <span class='help-block others' id='expectedPrice' data-price='1000' >
                                                                </span>
                                                           </div>";
                                                }
                                                // for last one
                                                function wayPointsWriteOne($val1 , $val2 ,  $id='last'){
                                                   $path = base_url() ."styles/images/search-from.png";
                                                   echo "<div class='row'> 
                                                               <div class='form-padding2' id='{$id}' >
                                                                  <div class='col-lg-8'> 
                                                                     <img src='{$path}' width='14px' height='25px' >
                                                                     <label class='control-label city'>{$val1}  →  {$val2}</label>
                                                                  </div>
                                                                  <div class='input-group col-lg-4'  
                                                                       rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc '&gt;  &lt;strong class='green'  &gt;". lang('od.green')  ."&lt;/strong&gt;". lang('od.low')     ."&lt;/span&gt; 
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='orange' &gt;". lang('od.orange') ."&lt;/strong&gt;". lang('od.normal')  ."&lt;/span&gt;
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='red'    &gt;". lang('od.red')    ."&lt;/strong&gt;". lang('od.high')    ."&lt;/span&gt;\" data-trigger='hover' data-html='true'
                                                                       >
                                                                      <span class='input-group-addon input-sm'>₺</span>
                                                                      <input id='lastInput' value='0' class='form-control input-sm inputNumber' data-pricemax='10000' type='text' >
                                                                      <span class='input-group-btn'>
                                                                              <button type='button'  class='btn btn-danger btn-sm plus'>+</button>
                                                                               <button type='button'  class='btn btn-success btn-sm minus'>-</button>
                                                                      </span>
                                                                  </div>
                                                               </div>
                                                           </div>
                                                           <div class='row help'    title='".lang('o2.expectedpriceTitle') ."'  > 
                                                                <span class='help-block' style='float: left; margin-right: 4px;'> ". lang('o2.expectedprice') . " : </span>
                                                                <span class='help-block' id='expectedPrice' data-price='1000' >
                                                                </span>
                                                           </div>";
                                                }
                                                // for others
                                                function wayPointsWriteOthers($val1 , $val2 ,  $id=''){
                                                   $path = base_url() ."styles/images/search-from.png";
                                                   echo "<div class='row others'> 
                                                               <div class='form-padding2' id='{$id}' >
                                                                  <div class='col-lg-8'> 
                                                                     <img src='{$path}' width='14px' height='25px' >
                                                                     <label class='control-label city'>{$val1}  →  {$val2}</label>
                                                                  </div>
                                                                  <div class='input-group col-lg-4'  
                                                                       rel='popover' data-placement='top' data-content=\"&lt;span class='row popover-desc '&gt;  &lt;strong class='green'  &gt;". lang('od.green')  ."&lt;/strong&gt;". lang('od.low')     ."&lt;/span&gt; 
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='orange' &gt;". lang('od.orange') ."&lt;/strong&gt;". lang('od.normal')  ."&lt;/span&gt;
                                                                                                                          &lt;span class='row popover-desc '&gt;  &lt;strong class='red'    &gt;". lang('od.red')    ."&lt;/strong&gt;". lang('od.high')    ."&lt;/span&gt;\" data-trigger='hover' data-html='true'
                                                                       >
                                                                      <span class='input-group-addon input-sm'>₺</span>
                                                                      <input value='0' disabled class='form-control input-sm inputNumber' data-pricemax='10000' type='text' >
                                                                      <span class='input-group-btn'>
                                                                              <button type='button'  disabled class='btn btn-danger btn-sm plus'>+</button>
                                                                               <button type='button' disabled class='btn btn-success btn-sm minus'>-</button>
                                                                      </span>
                                                                  </div>
                                                               </div>
                                                           </div>
                                                           <div class='row help others'    title='".lang('o2.expectedpriceTitle') ."'  > 
                                                                <span class='help-block others' style='float: left; margin-right: 4px;'> ". lang('o2.expectedprice') . " : </span>
                                                                <span class='help-block others expected'  data-price='1000' >
                                                                </span>
                                                           </div>";
                                                   }
                                                   $points       =  $test["way_points"];
                                                   $findExpected = array();
                                                   $flag         = false;
                                                   if($points != ""){
                                                      $array   = explode('?', $points);
                                                      $written = array();
                                                      
                                                      $path   =  $test['origin'] ;
                                                      $path1  =  $array[0] ;
                                                      $str     =  explode(  ",", $path  );
                                                      $str2    =  explode(  ",", $path1 ) ;
													  
													  // edited
                                                      wayPointsWrite( $str[0] , $str2[0]  );
                                                      $written[] =  array($path, $path1 );
                                                     
													  for ($i=0; $i < count($array) - 1; $i++) { 

                                                          $path   =  $array[$i] ;
                                                          $path1  =  $array[$i + 1] ;
                                                          $str  = explode(  ",", $path  );
                                                          $str2 = explode(  ",", $path1 );
                                                          wayPointsWrite($str[0] , $str2[0]  );
                                                          $written[] =  array( $path, $path1 );
                                                      
                                                      }
													  
                                                      $path   =  $array[count($array) -1 ] ;
                                                      $path1  =  $test['destination'] ;
													  
                                                      $str = explode(  ",", $path );
                                                      $str2 = explode(  ",", $path1 );
                                                      wayPointsWrite( $str[0] , $str2[0] );
                                                    
                                                      $written[] =  array( $path, $path1 );
													  
                                                      echo "<hr>";
													  
													  $path   =  $test['origin'] ;
                                                      $path1  =  $test['destination'] ;
													  
                                                      $str = explode(  ",", $path );
                                                      $str2 = explode(  ",", $path1 );
                                                      wayPointsWriteLast($str[0], $str2[0] );
                                                      
                                                      $written[] =  array( $path, $path1 );
													  
                                                      $dizi   = array( );  
                                                      $dizi[] =  $test['origin'];
                                                      foreach ($array as $value) {
                                                         $dizi[] = $value;
                                                      }  
                                                      $dizi[] = $test['destination'] ;
                                                      //print_r($written); 
                                                      $flag = true;
                                                   }
                                                   else{
                                                        $str = explode(  ",", $test['origin'] );
                                                        $str2 = explode(  ",", $test['destination'] );
                                                        wayPointsWriteOne($str[0], $str2[0] );
                                                   }
                                                   //print_r($test) 
                                               ?>
                                            </div>
                                            <div id="pricesOther" class="small-size">
                                                <? 
                                                   if( $flag ){
                                                      $x = 0;
                                                      for ($i=0; $i < count($dizi) - 1; $i++) {
                                                              for ($j = $i + 1; $j < count($dizi) ; $j++){ 
                                                                     $flag = false;
                                                                     foreach ($written as  $value) {
       																	/*	
                                                                        $str1 = explode(",", $dizi[$i] );
                                                                        $str2 = explode(",", $dizi[$j] );
																		if( strcmp($str1[0], $value[0]) == 0 &&  strcmp($str2[0], $value[1]) == 0   ){
                                                                            $flag = true;
                                                                            break;  
                                                                        }
																		*/
																		$str1 =  $dizi[$i] ;
                                                                        $str2 =  $dizi[$j] ; 
                                                                        if( strcmp( trim($str1), trim($value[0]) ) == 0 &&  strcmp( trim($str2) , trim($value[1]) ) == 0   ){
                                                                            $flag = true;
                                                                            break;  
                                                                        }
																		
                                                                     }
                                                                     if( !$flag ){
                                                                         //$str1 = explode(",", $dizi[$i] );
                                                                         //$str2 = explode(",", $dizi[$j] ); 
                                                                         $str1 =  $dizi[$i] ;
                                                                         $str2 =  $dizi[$j] ; 
                                                                         $id = "id".$x;
                                                                         $x++;
                                                                        // wayPointsWriteOthers( $str1[0] , $str2[0], $id );
                                                                         $findExpected[] = array( $id, $dizi[$i], $dizi[$j] );
                                                                     }    
                                                              }
                                                       }
                                                    }   
                                                ?>
                                            </div>
                                        </div>
                                      </div>
                                 </div> <!-- Birinci panel sonunu-->
                                   
                                   <!-- ikinci panel 
                                  ====================================-->
                                 <div class="panel panel-default">
                                      <div class="panel-heading">
                                           <div class='row'> 
                                                  <div class='input-group col-lg-12  form-padding2'>
                                                        <h4 class="header-title col-lg-8"> <?=lang('o2.blankseat')?> :</h4>
                                                         <div class="col-lg-4">
                                                              <span class='input-group-btn' >
                                                                     <input id="inputSeatCount" value='3' class='form-control input-sm inputNumber red'  style="float: left; width:80px; color: rgb(95, 95, 95);" data-pricemax='8' type='text' >
                                                                     <button type='button'  class='btn btn-danger btn-sm plus' style="margin-left: -3px;">+</button>
                                                                     <button type='button'  class='btn btn-success btn-sm minus'>-</button>
                                                              </span>
                                                       
                                                      </div>
                                                 </div>
                                            </div>
                                      </div>
                                 </div> <!-- İkinci panel sonunu--> 

                                 <!-- 3. panel 
                                  ====================================-->
                                 <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <div class="row"> 
                                            <div class="col-lg-8">
                                               <h3 class="panel-title"> <?=lang('o2.moredesc')?> </h3>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="panel-body" id="">
                                            
                                            <div class ="form-group">
                                                  <div class="col-lg-8" id="sameExplainDiv"   title='<?=lang('o2.usesameexplain')?>'>
                                                      <label for="sameExplain" class="hover-pointer">
                                                            <input id="sameExplain"  type="checkbox" class="hover-pointer" name=""> <?=lang('o2.sameexplain')?> 
                                                      </label>
                                                  </div>
                                            </div> 

                                            <div class="form-group"> 
                                               <label for="textArea" class="col-lg-12 control-label" style="text-align:left"> <?=lang('o2.moveexplain')?></label>
                                               <div class="col-lg-12">
                                                 <textarea class="form-control"  title=' <?=lang('o2.movedescTitle')?> ' rows="3" id="inputExplainGoing" placeholder="<?=lang('o2.movedesc')?>" ></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group" id="TripReturnInformation">
                                                    <label for="textArea" class="col-lg-12 control-label"  style="text-align:left"> <?=lang('o2.returnexplain')?></label>
                                                    <div class="col-lg-12">
                                                      <textarea class="form-control" rows="3"   title=' <?=lang('o2.returndescTitle')?>' id="inputExplainReturn" placeholder="<?=lang('o2.returndesc')?>" ></textarea>
                                                    </div>
                                            </div>
                                              
                                              <?php 
                                                   // print_r($test);

                                                      if( isset($test['logged_in']) && $test['logged_in'] == '1' ){
                                                              
                                                              $carsVal = ""; 
                                                              foreach ($cars as $car)
                                                                    $carsVal .= "<option value='{$car['id']}' > {$car['model']} </option>";

                                                              $value =   "  <div style='margin-top:45px;' >
                                                                                <div class='form-group'> 
                                                                                    <label for='select' class='col-lg-6 control-label'>".lang('o2.chooseyourcar') ." : </label>
                                                                                    <div class='col-lg-6'>
                                                                                      <select class='form-control' id='cars'>
                                                                                         <option value='0'>".lang('o2.choosecar')."</option>
                                                                                         $carsVal
                                                                                      </select>
                                                                                    </div>
                                                                                </div> 
                                                                            </div> ";
                                                              echo $value;
                                                        }

                                              ?>

                                             

                                            <div style='margin-top:10px;' >   
                                                    <div class="form-group">
                                                        <label for="select" class="col-lg-6 control-label"> <?=lang('o2.luggagesize')?> : </label>
                                                        <?php
                                                                  //print_r($luggages)
                                                         ?>
                                                        <div class="col-lg-6">
                                                          <select class="form-control" id="luggages">
                                                            <?php
                                                             
                                                                 foreach ($luggages as $luggage){
                                                                      if( strcmp($this->lang->lang(), 'en') == 0  ) 
                                                                          echo "<option value='{$luggage['id']}'>{$luggage['sizeen']}</option>";
                                                                      else
                                                                          echo "<option value='{$luggage['id']}'>{$luggage['size']}</option>";
                                                                  }
        
                                                                    ?>
                                                           </select>
                                                         </div>
                                                    </div>
                                             </div>
                                             <div style='margin-top:10px;' >  
                                                    <div class="form-group">
                                                        <label for="select" class="col-lg-6 control-label"> <?=lang('o2.movetime')?> : </label>
                                                        <div class="col-lg-6">
                                                          <select class="form-control" id="leave_times">
                                                            <?php
                                                             
                                                                 foreach ($leave_times as $leave_time){
                                                                      if( strcmp($this->lang->lang(), 'en') == 0  )  
                                                                          echo "<option value='{$leave_time['id']}'>{$leave_time['timeen']}</option>";
                                                                      else  
                                                                          echo "<option value='{$leave_time['id']}'>{$leave_time['time']}</option>";
                                                                  }    
                                                            ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                              </div>  
                                           

                                      </div>
                                 </div> <!-- 3. panel sonunu--> 
                                
                                 <div class="row" >
                                            <div class="form-group col-lg-12" style="margin-left:5px;" >
                                                  <label for="acceptTerms" class="hover-pointer">
                                                        <input id="acceptTerms" type="checkbox"> <?=lang('o2.drivinglicence')?> 
                                                        <a target="blank" href="<?= new_url('application/terms') ?>" > <?=lang('o2.termscondition')?> </a> 
                                                  </label>
                                            </div>
                                 </div>

                                 <div class="row">      
                                      <div class="form-group form-padding">
                                          <div class="col-lg-4" style="padding-bottom:5px">
                                             <button id="buttonBack" type="button" class="form-control btn btn-default"> <?=lang('o2.back')?> </button> 
                                          </div>
                                          <div class="col-lg-8 ">
                                             <button id="complete" type="button" class="form-control btn btn-primary"> <?=lang('o2.complete')?> </button> 
                                          </div>
                                      </div>
                                 </div>
                                
                          </fieldset>
                    </form>
               </div>
        </div>
          
          <!--MAP
          ============================================-->        
          <div class="col-lg-6" >
                <div class="well">
                      <legend> <?=lang('o.travelroute')?> </legend>
                      <div id="map" class="collapse in">
                         <div id="map-canvas"></div>
                      </div>
                      <div class="panel panel-default">
                            <div class="panel-heading">
                              <div class="row"> 
                                  <div class="col-lg-8">
                                     <h3 class="panel-title"> <?=lang('o.tripinfo')?> </h3>
                                  </div>
                              </div>
                            </div>
                            <div class="panel-body" >
                                   <div id="total" class="form-group form-padding"> </div>
                                   <div id="realDistance" class="form-group form-padding" ></div>
                            </div>
                      </div>
                </div>
          </div>
      </div>
       
         
   
   <!-- Modal 2
    =====================================================-->
   <div id="full-width" class="modal container fade" tabindex="-1" data-width="600" style="display: none;">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title"> <?=lang('o2.termtitle')?>  </h4>
     </div>
     <div class="modal-body">
       <p><?=lang('o2.termcon1')?></p>
       <p><?=lang('o2.termcon1')?></p>
     </div>
     <div class="modal-footer">
       <button type="button" data-dismiss="modal" class="btn btn-default"> <?=lang('o2.close')?></button>
     </div>
   </div> 
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false&#38;libraries=places"></script>
    <script type="text/javascript">           
          var isTwoway = '<?php echo $test["round_trip"] ?>', pointsSession = '<?php echo $test["way_points"] ?>' , startSession = '<?php echo $test["origin"] ?>' , endSession = '<?php echo $test["destination"] ?>'   , login = '<?php echo $test["logged_in"] ?>', findExpected = <?= json_encode($findExpected) ?>, range = 15 ;
    </script>
    <script type="text/javascript">
         $(function(){ $('body').modalmanager('loading');   });
    </script>
    <script src="<?php echo  base_url() . 'scripts/partial/offerRide2.js'  ?>"></script>    
   

 
