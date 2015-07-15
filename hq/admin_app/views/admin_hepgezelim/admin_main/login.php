
    <!-- container
    ================================== --> 
    <div class="container">
 
    <!-- Modal newuser
    =====================================================-->
    
          <div  class="row well" style="padding: 160px 0px 160px 0px; margin:35px 0px 0px 0px; background-color: #FFFFFF; " >
                        <div class="col-lg-4" ></div>
                        <div class="col-lg-4 well" >
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
                               <li  ><a  tabindex="-1" href="<?= base_url() . $this->lang->switch_uri('tr') ?>">
                                 <i class="tr"></i> 
                                   <?=lang('g.tr')?></a>
                               </li>
                               <li><a tabindex="-1" href="<?= base_url() . $this->lang->switch_uri('en')  ?>">
                                 <i class="en"></i>   <?=lang('g.en')?>  </a>
                               </li>
                             </ul>
                        </li>
                      </ul>  
                               <div class="bs-example form-horizontal">
                                   <fieldset>
                                           <legend><i class="text-primary glyphicon glyphicon-log-in one" ></i><?=lang('a.login')?> </legend> 
                                           <div class="form-group margin-20" id="loginError" >
                                                  <div class="form-group" style=" margin-left:20px" >
                                                     <div class="input-group">
                                                        <input type="text" class="form-control" id="inputLoginUsername"  placeholder="<?=lang('a.usernameP')?>">
                                                        <span class="input-group-addon "> <i class="glyphicon glyphicon-lock " ></i> </span>
                                                      </div>  
                                                   </div>
                                                   <div class="form-group" style="margin-left:20px">
                                                       <div class="input-group">
                                                          <input  type="password" class="form-control" id="inputLoginPassword" placeholder="<?=lang('g.pass')?>">
                                                          <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                                       </div>
                                                   </div>
                                           </div>   
                                            <div class="form-group margin-20" >
                                                      <button id="buttonLogin" class="btn btn-primary form-control mrn-lr-20" > <?=lang('g.login')?>  </button>  
                                             </div>
                                    </fieldset>
                               </div>
                               <br/>
                               <br/>
                               <p style="font-size:19px; margin:10px 0px 10px 0px" > <a href="<?php echo new_url() ?>" ><i class=" glyphicon glyphicon-home one"></i> <?=lang('g.mainpage')?> </a> </p>
                        </div>
                        <div class="col-lg-4" ></div>
          </div>
  
          <div id = "mesaj"></div>
          <div style="height:20px;"></div>    
    </div> <!-- Containers Ending-->  
  
   
    <script src="<?=    base_url() . 'scripts/admin/login.js'  ?>"></script>  
    <script type="text/javascript">
         
  
          
    </script>
     
  </body>
</html>