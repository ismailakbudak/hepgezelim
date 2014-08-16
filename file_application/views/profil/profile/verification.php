<div class="col-lg-10">
      <div class="well" id="result">

            <form class="bs-example form-horizontal" style="padding-right:20px; padding-left:20px;">
                    <fieldset>
                                <legend> <?=lang("v.title")?>  </legend>
                                <div class="row emailVerification" >
                                    <div class="text"> 
                                       <i class=""></i>
                                       <span>      
                                          <?=lang("v.email")?> :<strong><?= $user['email'] ?></strong> (<a href="<?= new_url().'profil/profile/info' ?>" > <?=lang("a.tedit")?> </a>)
                                       </span>
                                    </div> 
                                    <div class="form-group margin-4 ">
                                           <label for="inputEmailKod" class="col-lg-3 control-label"> <?=lang("v.emailkod")?> :</label>
                                           <div class="input-group col-lg-3">
                                              <input type="text" class="form-control" id="inputEmailKod" placeholder=" <?=lang("v.kod")?> ">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                           </div>
                                           <div class="margin-4 col-lg-3" >
                                               <button id="inputEmailVerify" class="btn btn-primary width-100" type="button" > <?=lang("v.verify")?>  </button>
                                           </div>
                                           <div class="margin-4 col-lg-3" >
                                               <button id="inputEmailResend" class="btn btn-primary" type="button" > <?=lang("v.resend")?>  </button>
                                           </div>
                                    </div>
                                </div>
                                <div class="row telVerification">
                                   <div class="text"> 
                                       <i class=""></i>
                                       <span>    
                                          <?=lang("v.phone")?> <strong><?= $user['tel_no'] ?></strong> (<a href="<?= new_url().'profil/profile/info' ?>" > <?=lang("a.tedit")?> </a>)
                                       </span>
                                    </div>  
                                    <div class="form-group margin-4 ">
                                           <label for="inputTelKod" class="col-lg-3 control-label"> <?=lang("v.phonekod")?> :</label>
                                           <div class="input-group col-lg-3">
                                              <input type="text" disabled  class="form-control" id="inputTelKod" placeholder="<?=lang("v.kod")?> ">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                           </div>
                                            <div class="margin-4 col-lg-3" >
                                               <button id="inputTelVerify" disabled class="btn btn-primary width-100" type="button" > <?=lang("v.verify")?> </button>
                                           </div>
                                           <div class="margin-4 col-lg-3" >
                                                <button id="inputTelResend" disabled class="btn btn-primary" type="button" > <?=lang("v.resend")?>  </button>
                                           </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <div class="bs-example">
                                          <div class="alert alert-dismissable alert-danger">
                                            <p> <?= lang("v.not_active")?> </p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                </div>  
                                <div class="row faceVerification">
                                     <div class="text"> 
                                         <i class=""></i>
                                         <span>    
                                             <?=lang("v.face1")?>
                                             <button id="verfyFriends" class="btn btn-primary width-200" style="margin-bottom:20px; " > <img src="<?= base_url() ?>styles/images/facebook-back.png"  width="26" height="26"  style="padding-top: 0px; margin-top: -4px; margin-left: -16px; width: 26px; height: 26px;" /> 
                                          	    <?=lang("v.face2")?>
                                             </button>  
                                           
                                         </span>
                                     </div>
                                </div>  
                            </br>
                            </br>
                            </br>
                    </fieldset>
             </form> 

    </div> <!-- End of the  class well --> 
</div><!-- End of the column  -->    

    <!-- Modal Sending
    =====================================================-->
    <div id="sending" class="modal fade" style=" border-radius: 16px;" tabindex="-1" data-width="400" data-height="150" data-backdrop="static"  style="display: none;">
        <div class="well" style=" border-radius: 16px; margin-bottom: 0px !important; margin-right: 0px; margin-left: 0px; ">
                             <fieldset style="font-size:20px; padding-bottom:10px; padding-left: 40px; ">
                                  <div class="row">
                                        <?=lang("v.sending")?>
                                       <img src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >
                                     </div>
                                     <div class="row">
                                      <strong class="text-primary"> <?=lang("g.wait")?></strong>
                                     </div>
                             </fieldset>
        </div>  
    </div><!-- END of the Modal Sending -->
    <script type="text/javascript" >
       var email_check = '<?php echo $user["email_check"] ?>', tel_check = '<?php echo $user["tel_check"] ?>', face_check = '<?php echo $user["face_check"] ?>'; 
        
        $(function(){ 
                 $( "#inputTelVerify" ).on('click',function(){
                         var tel_kod = $( "#inputTelKod" );
                         var boolValid = true;
                             boolValid = boolValid && FillKontrolParent(tel_kod, er.blank_kod);          

                 });
                 $( "#inputTelResend" ).on('click',function(){
                        //alert("face verify");
                 });
          });           
    </script> 
    <script src="<?php echo   base_url() . 'scripts/partial/profil/profil.js' ?>"></script>
    <script src="<?php echo  base_url() . 'scripts/partial/face-process.js'  ?>"></script> 
    