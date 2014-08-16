
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
                               <legend><i class="text-primary glyphicon glyphicon-log-in one" ></i><?=lang('g.passwordNew')?> </legend> 
                               <h4 style="padding-top: 16px;" > <?=lang('g.passwordSend')?> </h4>
                               <div class="form-group margin-20" id="loginError" >
                                      <div class="form-group" style=" margin-left:20px" >
                                        <div class="input-group">
                                           <input type="text" class="form-control" id="inputEmail"  placeholder="<?=lang('g.mail')?>">
                                           <span class="input-group-addon ">@</span>
                                         </div>  
                                      </div>
                              </div>   
                              <div class="form-group margin-20" >
                                         <button id="buttonSend" class="btn btn-primary form-control mrn-lr-20" > <?=lang('g.send')?>  </button>  
                              </div>
                       </fieldset>
                    </div>
                  <br/>
                  <br/>
                  <p style="font-size:19px; margin:20px 0px 20px 0px" > <a href="<?php echo new_url() ?>" ><i class=" glyphicon glyphicon-home one"></i> <?=lang('g.mainpage')?> </a> </p>
           
              </div>
              <div class="col-lg-3" ></div>
    </div>
    
    <!-- Modal Sending
    =====================================================-->
    <div id="sending" class="modal fade" style=" border-radius: 16px;" tabindex="-1" data-width="260" data-height="150" data-backdrop="static"  style="display: none;">
        <div class="well" style=" border-radius: 16px; margin-bottom: 0px !important; margin-right: 0px; margin-left: 0px; ">
                             <fieldset style="font-size:20px; padding-bottom:10px; padding-left: 40px; ">
                                  <div class="row">
                                        <?=lang("g.sending")?>
                                       <img src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >
                                     </div>
                                     <div class="row">
                                      <strong class="text-primary"> <?=lang("g.wait")?></strong>
                                     </div>
                             </fieldset>
        </div>  
    </div><!-- END of the Modal Sending -->
    <script type="text/javascript"> var loader = '<fieldset id="sending" style="font-size:20px; padding-bottom:10px; padding-left: 0px; ">'+
                                                       '<div class="col-lg-12">'+
                                                             '<?=lang("g.sending")?>'+
                                                           '<strong class="text-primary"> <?=lang("g.wait")?></strong>'+
                                                            '<img src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >'+
                                                          '</div>'+
                                                  '</fieldset>'; 
    </script>
    <script src="<?php echo   base_url() . 'scripts/partial/newuser.js' ?>"></script> 
 