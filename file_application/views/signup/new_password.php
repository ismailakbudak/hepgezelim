
    <!-- container
    ================================== --> 
    <div class="container">
    <!-- Modal newuser
    =====================================================-->
            
          <div  class="row  well" style="padding: 60px 0px 80px 0px; margin:5px 0px 0px 0px; background-color: #FFFFFF; ">
              <div class="col-lg-4" ></div>
              <div class="col-lg-5 well" >
                     <div  id="message" ></div>
                     <ul class="nav navbar-nav navbar-right " style=""> 
                       <li class="dropdown">
                             <!-- data-toggle="dropdown" href="#" -->
                            <a  style="padding-top:0px; padding-bottom:0px;" class="dropdown-toggle"  href="#" id="themes">
                               <i class="<?= $this->lang->lang() ?>-32"></i> 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
                              <li  ><a tabindex="0" href="<?= base_url() . $this->lang->switch_uri('tr') ?>">
                                <i class="tr"></i> 
                                  <?=lang('g.tr')?></a>
                              </li>
                              <li><a tabindex="1" href="<?= base_url() . $this->lang->switch_uri('en')  ?>">
                                <i class="en"></i>   <?=lang('g.en')?>  </a>
                              </li>
                            </ul>
                       </li>
                     </ul>  
                   
                    <div class="bs-example form-horizontal">
                      <fieldset>
                               <legend><i class="text-primary glyphicon glyphicon-log-in one" ></i><?=lang('u.passwordNew')?> </legend> 
                               <div class="form-group margin-20" id="loginError" >
                                      <div class="form-group" style=" margin-left:20px" >
                                        <div class="input-group">
                                           <input type="password" class="form-control" id="inputPassword"  placeholder="<?=lang('g.pass')?>">
                                           <span class="input-group-addon "> <i class="glyphicon glyphicon-lock " ></i> </span>
                                         </div>  
                                      </div>
                              </div> 
                              <div class="form-group margin-20" id="loginError" >
                                      <div class="form-group" style=" margin-left:20px" >
                                        <div class="input-group">
                                           <input type="password" class="form-control" id="inputPasswordAgain"  placeholder="<?=lang('g.passagain')?>">
                                           <span class="input-group-addon "> <i class="glyphicon glyphicon-lock " ></i> </span>
                                         </div>  
                                      </div>
                              </div>   
                              <div class="form-group margin-20" >
                                      <button id="buttonSendPassword" class="btn btn-primary form-control mrn-lr-20"  > <?=lang('u.create')?>  </button>  
                              </div>
                       </fieldset>
                    </div>
                  <br/>
                  <br/>
                  <p style="font-size:19px; margin:20px 0px 20px 0px" > <a href="<?php echo new_url() ?>" ><i class=" glyphicon glyphicon-home one"></i> <?=lang('g.mainpage')?> </a> </p>
           
              </div>
              <div class="col-lg-3" ></div>
    </div>    
    <script type="text/javascript"> var new_data = '<?= $new ?>'; </script>  
    <script src="<?php echo   base_url() . 'scripts/partial/newuser.js' ?>"></script> 

  
 
  
    
 