     
    <style type="text/css">
        .my legend{ padding: 0px 10px 0px 40px; }
        .btn-default.user-type.active { color: #FFF;  background-color: #2fa4e7; } 
        .btn-default.user-type{ font-weight: 500;  font-size: 17px; }                               
    </style>
    <!-- container
    ================================== --> 
    <div class="container"> 

          <div class="row row-side" >
              <div class="col-lg-12 well"  style=" padding: 30px 0px 30px 0px; margin:5px 0px 0px 0px; background-color: #FFFFFF; " > 
                     <div class="row my row-side"   >
                        <div class="col-lg-2" ></div> <!-- NULL -->
                        <div class="col-lg-8" >
                               <div class="">
                                  <div class="bs-example form-horizontal" id="form" >
                                    <fieldset>
                                                <legend> <h2 style='color: rgba(4, 4, 5, 0.61);' > <?= lang('c.page') ?> </h2> </legend>
                                                <div class="bs-example" style="margin-bottom: 15px;">
                                                   <div class="btn-group btn-group-justified users">
                                                       <a href="#" class="btn btn-default user-type" data-type="driver"> <?= lang('c.driver') ?> </a>
                                                       <a href="#" class="btn btn-default user-type" data-type="passenger"> <?= lang('c.passenger') ?></a>
                                                       <a href="#" class="btn btn-default user-type" data-type="other"> <?= lang('c.other') ?> </a>
                                                   </div>
                                                </div>
                                                 
                                                <div class="form-group">
                                                  <label for="select" class="col-lg-2 control-label"> <?= lang('c.issue') ?> </label>
                                                  <div class="col-lg-10">
                                                    <select disabled class="form-control" id="selectIssue">
                                                      <option value="0" >  <?= lang('c.chooseIssue') ?> </option>
                                                      <option value="Site hakkında sorularım var" > <?= lang('c.question') ?>  </option>
                                                      <option value="Teknik problemler" > <?= lang('c.problem') ?>  </option>
                                                      <option value="Şikayet" >  <?= lang('c.complain') ?> </option>
                                                      <option value="Diğer" > <?= lang('c.other') ?>  </option>
                                                    </select> 
                                                  </div>
                                                </div> 
                                                

                                                <div class="form-group">
                                                  <label for="inputSubject" class="col-lg-2 control-label"> <?= lang("c.subject") ?> </label>
                                                  <div class="col-lg-10">
                                                    <input disabled type="text" class="form-control" id="inputSubject"  placeholder="<?= lang("c.subjectP") ?>">
                                                  </div>
                                                </div>

                                                <div class="form-group"> 
                                                  <label for="inputSubject" class="col-lg-2 control-label"> <?= lang("c.message") ?> </label> 
                                                  <div class="col-lg-10">
                                                    <textarea  class="form-control" rows="3" placeholder="<?= lang("c.messageP") ?>"   disabled id="textAreaMesage"  style="max-width:602px; max-height:200px" ></textarea>
                                                    <span class="help-block"> </span>
                                                  </div>
                                                </div>
                                              
                                                <div class="form-group">
                                                  <label for="inputEmail2" class="col-lg-2 control-label"> <?= lang("c.email") ?> </label>
                                                  <div class="col-lg-10">
                                                    <input type="text"   class="form-control" id="inputEmail" value="<?= $email ?>"  placeholder="<?= lang("c.emailP") ?>">
                                                  </div>
                                                </div>
                                                <hr>  
                                                <div class="form-group">
                                                  <div class="col-lg-10 col-lg-offset-2"> 
                                                    <button id="buttonSendContact" type="button" disabled class="btn btn-primary width-200">  <?= lang("c.send") ?>  </button> 
                                                  </div>
                                                </div>
                                                <br> 
                                    </fieldset>  
                                 </div>   
                              </div>   
                        </div>   <!-- FULL -->        
                        <div class="col-lg-2" ></div>  <!-- NULL -->
                     </div>
              </div> 
              <script type="text/javascript" > 
                  var error_issue = "<?= lang('c.choose_issue') ?>";
              </script>
              <script src="<?php  echo  base_url() . 'scripts/partial/contact.js'  ?>"></script>  
