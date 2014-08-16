 <div class="col-lg-8">
      <div class="well" id="result">

             <form class="bs-example form-horizontal" style="padding-right:20px; padding-left:20px;">
                  <fieldset>
                              <legend> <?=lang('in.title')?> </legend>
                               <div class="form-group-30">
                                      <div class="form-group margin-4">
                                            <label for="inputSex" class="col-lg-4 control-label"><?=lang('g.sex')?> :</label>
                                            <div class="input-group">
                                              <? 
                                                 if( strcmp($this->lang->lang(), "tr") == 0 )
                                                     $sex = ($user['sex'] ? 'Erkek' : 'Kadın');
                                                 else
                                                     $sex = ($user['sex'] ? 'Male' : 'Female');
                                                 echo "<input  value='{$sex}'  type='text' class='form-control' id='inputSex' disabled >"
                                              ?> 
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                            </div>
                                     </div>
                                     <div class="form-group margin-4 ">
                                            <label for="inputName" class="col-lg-4 control-label"><?=lang('g.name')?> :</label>
                                            <div class="input-group">
                                               <input value="<?= $user['name']  ?>" type="text" class="form-control" id="inputName" placeholder="<?=lang('g.name')?>">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                            </div>
                                      </div>
                                      <div class="form-group margin-4">
                                           <label for="inputSurname" class="col-lg-4 control-label"><?=lang('g.surname')?> :</label>
                                           <div class="input-group">
                                              <input value="<?= $user['surname']  ?>" type="text" class="form-control" id="inputSurname" placeholder="<?=lang('g.surname')?>">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                           </div>
                                      </div>
                              </div>
                              <div class="form-group-30 margin-20">
                                        <div class="form-group">
                                             <label for="inputEmail" class="col-lg-4 control-label"><?=lang('g.mail')?> :</label>
                                             <div class=" input-group">
                                                <input value="<?= $user['email']  ?>" type="text" class="form-control input-group"  id="inputEmail" placeholder="<?=lang('g.mail')?>">
                                                <span class="input-group-addon">@</span>
                                             </div>
                                       </div>
                                       <div class="form-group">
                                             <label for="inputTel_no" class="col-lg-4 control-label"> <?=lang('in.phone')?> :</label>
                                             <div class=" input-group">
                                                  <input value="<?= $user['tel_no']  ?>" type="text" class="form-control input-group"  id="inputTel_no" placeholder="05XX XXX XX XX">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign " ></i></span>
                                             </div>
                                        </div>
                                        <div class="form-group">     
                                              <div class="checkbox right">
                                                  <label>
                                                      <input id="inputTel_visibility" <?= $user['tel_visible'] ? 'checked' : '' ?> type="checkbox"> <?=lang('in.showphone')?> 
                                                  </label>
                                              </div>
                                        </div>     
                                </div>
                                
                                <div class="form-group-30 margin-20">
                                     <div class="form-group margin-4">
                                              <label for="inputBirthYear" class="col-lg-4 control-label">  <?=lang('g.byear')?> :</label>
                                              <div class="input-group">
                                                 <select   class="form-control" id="inputBirthYear">
                                                     <?php
                                                          $year = getdate();
                                                          $year = $year['year'];
                                                           for ($i=$year - 18; $i >= 1930; $i--){ 
                                                                 if( strcmp($i, $user['birthyear'] ) == 0 )
                                                                       echo "<option selected value='{$i}'> $i </option>";
                                                                 else   
                                                                       echo "<option value='{$i}'> $i </option>";
                                                            }  
                                                       ?>
                                                 </select>
                                                 <span class="input-group-addon " ><i class="glyphicon glyphicon-list " ></i></span>
                                            </div>
                                     </div>
                                     <div class="form-group margin-4">
                                             <label for="inputDescription" class="col-lg-4 control-label"> <?=lang('in.explain')?> :</label>
                                             <div class="col-lg-8" style="padding:0px" >
                                                 <textarea  class="form-control" style="max-width: 350px; max-height: 100px;" rows="2" id="inputDescription" placeholder="<?=lang('in.pexplain')?>"><?= $user['description']?></textarea>
                                                 <span class="help-block"> <?=lang('in.explainhelp')?> </span>
                                             </div>
                                     </div>
                                </div>
                                <div class="form-group-30 ">
                                      <div class="col-lg-4"></div>
                                       <div class="margin-4" >
                                           <button id="inputUpdate" class="btn btn-primary width-150" type="button" ><?= lang("a.tedit")?> </button>
                                       </div>
                                </div>
                        </fieldset>
                    </form> 

         </div> <!-- End of the  class well --> 
    </div><!-- End of the column  -->             
    <script type="text/javascript" >
       var email_own =  '<?php echo $user["email"] ?>', email_check = '<?php echo $user["email_check"] ?>', tel_no_own = '<?php echo $user["tel_no"] ?>', tel_check = '<?php echo $user["tel_check"] ?>';         
    </script>
    <script src="<?php echo   base_url() . 'scripts/partial/profil-info.js' ?>"></script> 
   