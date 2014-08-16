
    <!-- container
    ================================== --> 
    <div class="container">
    <!-- Modal newuser
    =====================================================-->
       <div class="row well" style="padding: 10px 0px 30px 0px; margin:5px 0px 0px 0px; background-color: #FFFFFF; ">
          <div class="col-lg-4" ></div>
          <div class="col-lg-5 well" >
                <div  id="message" >
                         <?php 
                             if( isset($val) )
                                echo $val; 
                         ?>
                </div>
                <ul class="nav navbar-nav navbar-right " > 
                 <li class="dropdown">
                       <!-- data-toggle="dropdown" href="#" -->
                      <a  style="padding-top:0px; padding-bottom:0px;" class="dropdown-toggle"  href="#" id="themes">
                         <i class="<?= $this->lang->lang() ?>-32"></i> 
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="themes">
                        <li ><a tabindex="-1" href="<?= base_url() . $this->lang->switch_uri('tr') ?>">
                          <i class="tr"></i> 
                            <?=lang('g.tr')?></a>
                        </li>
                        <li><a tabindex="-1" href="<?= base_url() . $this->lang->switch_uri('en')  ?>">
                          <i class="en"></i>   <?=lang('g.en')?>  </a>
                        </li>
                      </ul>
                 </li>
               </ul>  
                 
               <legend style="margin-top: 20px" ><i class="text-primary glyphicon glyphicon-user one" ></i> <?=lang('g.signupface')?> <strong class="text-primary"> <?=lang('g.tensec')?>  <i class="glyphicon glyphicon-time "></i></strong></legend>
               <div  class="row mrn-lr-20">
               	     <!--
                       <fb:login-button show-faces="true" id="faceLoginHeaderNonUser" class="btn form-control " scope="email,user_birthday" width="300" max-rows="1"> <?=lang('g.facelogin')?>  </fb:login-button>
                     -->  
                     <button id="faceSignupNewuser" class="btn btn-primary form-control" ><img src="<?= base_url() ?>styles/images/facebook-back.png"  width="26" height="26"  style="padding-top: 0px; margin-top: -4px; margin-left: -16px; width: 26px; height: 26px;" />  <?=lang('g.signupwithface')?> </button>  
               </div>
               <h4><?=lang('g.or')?></h4>  
               <legend><i class="text-primary glyphicon glyphicon-user one" ></i> <?=lang('g.signupnew')?> <strong class="text-primary"> <?=lang('g.sixtysec')?>  <i class="glyphicon glyphicon-time "></i></strong></legend>
               <form class="bs-example form-horizontal" style="padding-right:20px; padding-left:20px;">
                  <fieldset>
                              
                               <div class="form-group-30">
                                      <div class="form-group margin-4">
                                           <div class="input-group">
                                                  <select  class="form-control" id="inputSex" >
                                                      <option value="0" class="default"> <?=lang('g.sex')?> </option>
                                                      <option value="1">  <?=lang('g.m')?> </option>
                                                      <option value="2">  <?=lang('g.f')?> </option>
                                                  </select>
                                                  <span class="input-group-addon " ><i class="glyphicon glyphicon-list " ></i></span>
                                            </div>
                                     </div>
                                     <div class="form-group margin-4">
                                           <div class="input-group">
                                               <input type="text" class="form-control" id="inputName" placeholder="<?=lang('g.name')?>">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                           </div>
                                      </div>
                                      <div class="form-group margin-4">
                                           <div class="input-group">
                                              <input type="text" class="form-control" id="inputSurname" placeholder="<?=lang('g.surname')?>">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                           </div>
                                      </div>
                              </div>
                              <div class="form-group-30">
                                        <div class="form-group">
                                          <div class=" input-group">
                                             <input type="text" class="form-control input-group"  id="inputEmail" placeholder="<?=lang('g.mail')?>">
                                             <span class="input-group-addon">@</span>
                                           </div>
                                       </div>

                                      <div class="form-group margin-4">
                                          <div class="input-group">
                                               <input  type="password" class="form-control" id="inputPassword" placeholder="<?=lang('g.pass')?>">
                                               <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                          </div>
                                      </div>
   
                                      <div class="form-group margin-4">
                                          <div class="input-group">
                                               <input type="password" class="form-control" id="inputPasswordAgain" placeholder="<?=lang('g.passagain')?>">
                                               <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                          </div>   
                                      </div>
                                
                                      <div class="form-group margin-4">
                                           <div class="input-group">
                                                 <select   class="form-control" id="inputBirthYear">
                                                     <option value="0" class="default" > <?=lang('g.byear')?> </option>
                                                     <?php
                                                           $year = getdate();
                                                           $year = $year['year'];
                                                           for ($i=$year - 18; $i >= 1930; $i--) 
                                                              echo "<option value='{$i}'> $i </option>"
                                                       ?>
                                                 </select>
                                                 <span class="input-group-addon " ><i class="glyphicon glyphicon-list " ></i></span>
                                            </div>
                                     </div>  
                                     <div class="form-group margin-4">
                                            <div class="input-group " style="100%"> 
                                                <div id="captchaDiv" class="col-lg-3" style="float:left; padding-top:5px; padding-right:0px; padding-left:0px;">  
                                                     <?= $captcha ?>
                                                </div>
                                                <div class="col-lg-2" style="float:left; padding-right: 0px; padding-top:8px; padding-left:25px;">  
                                                    <a id="captchaNew" href="#"><i class="glyphicon glyphicon-refresh three"></i></a>
                                                </div>
                                                <div class="input-group col-lg-7 "  style="float:left; padding-right: 0px; padding-left: 0px;">
                                                     <input type="text" class="form-control" id="inputCap" placeholder="<?=lang('g.passcap')?>">
                                                     <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                                </div>
                                            </div>      
                                    </div>
                                     <div class="mrn-lr-20 "  style="font-size:19px; margin:40px 0px 20px 0px" >
                                         <button id="inputSignup" class="btn btn-primary form-control" type="button" > <?=lang('g.signup')?> </button>
                                     </div> 
                                </div>
                        </fieldset>
                    </form> 
                    <p style="font-size:19px; margin:20px 0px 40px 0px"> <a href="<?php echo new_url() ?>" ><i class=" glyphicon glyphicon-home one"></i> <?=lang('g.mainpage')?> </a> </p>
     
          </div>
          <div class="col-lg-3" ></div>
       </div>

    <!-- Modal loading
    =====================================================-->
    <div id="loading" class="modal fade" style=" border-radius: 16px;" tabindex="-1" data-width="350" data-height="150" data-backdrop="static"  style="display: none;">
        <div class="well" style=" border-radius: 16px; margin-bottom: 0px !important; margin-right: 0px; margin-left: 0px; ">
                             <fieldset style="font-size:20px; padding-bottom:10px; padding-left: 40px; ">
                                  <div class="row">
                                         <?=lang('g.usercreating')?> 
                                       <img src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >
                                     </div>
                                     <div class="row">
                                      <strong class="text-primary"> <?=lang('g.wait')?></strong>
                                     </div>
                             </fieldset>
        </div>  
    </div><!-- END of the Modal loading -->
    <script src="<?php echo   base_url() . 'scripts/partial/newuser.js' ?>"></script> 
    <script src="<?php echo  base_url() . 'scripts/partial/face-process.js'  ?>"></script>
