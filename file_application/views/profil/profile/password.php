
  <!-- Modal newuser
    =====================================================-->
       <div class="row">
          <div class="col-lg-8 " >
            <div class="well">
                 <legend> <?=lang("ps.title")?> </legend>
                 <form class="bs-example form-horizontal" style="padding-right:20px; padding-left:20px;">
                      <fieldset>
                                <div class="form-group-30">
                                      <div class="form-group margin-4">
                                           <label for="inputEmail" class="col-lg-4 control-label"> <?=lang("ps.oldp")?> :</label>
                                           <div class="input-group col-lg-6">
                                               <input  type="password" class="form-control" id="inputOldPassword" placeholder=" <?=lang("ps.poldp")?> ">
                                               <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                          </div>
                                      </div>
                                 </div>     
                                <div class="form-group-30">  
                                     <div>
                                          <div class="form-group margin-4">
                                              <label for="inputEmail" class="col-lg-4 control-label"> <?=lang("ps.newp")?> :</label>
                                              <div class="input-group col-lg-6">
                                                   <input  type="password" class="form-control" id="inputPassword" placeholder=" <?=lang("ps.pnewp")?>">
                                                   <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                              </div>
                                          </div>
                                      </div>
                                      <div>
                                          <div class="form-group margin-4">
                                              <label for="inputEmail" class="col-lg-4 control-label"> <?=lang("ps.pagain")?> :</label>
                                              <div class="input-group col-lg-6">
                                                   <input type="password" class="form-control" id="inputPasswordAgain" placeholder=" <?=lang("ps.ppagain")?> ">
                                                   <span class="input-group-addon " ><i class="glyphicon glyphicon-lock " ></i></span>
                                              </div>   
                                          </div>
                                      </div>     
                                </div>
                                </br>
                                <div class="form-group-30 ">
                                         <div class="col-lg-4"></div>
                                         <div class="" style="margin-left:180px;" >
                                             <button id="inputUpdate" class="btn btn-primary width-150" type="button" > <?=lang("a.tedit")?> </button>
                                         </div>
                                </div>
                      </fieldset>
                 </form> 
              </div>
          </div>
       </div>
      <script src="<?php echo   base_url() . 'scripts/partial/profil/profil.js' ?>"></script>