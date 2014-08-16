<style type="text/css">
.form-group-30{margin-left: 15px; margin-bottom: 5px; margin-top: 5px;}
</style>
 <div class="col-lg-8">
      <div class="well" id="result">
             <form class="bs-example form-horizontal" style="padding-right:20px; padding-left:20px;">
                  <fieldset>
                              <legend> <?=lang('n.title')?> </legend>
                              <p class="font16"> <?=lang('n.desc1')?><strong class="text-warning"> <?=lang('n.desc2')?>  </strong> <?=lang('n.desc3')?></p>
                              <span class="font16">      
                                  <?=lang('n.email')?> <strong class="text-success"><?= $email ?></strong> (<a href="<?= new_url().'profil/profile/info' ?>" > <?=lang('n.edit')?></a>)
                              </span>
                              <div class="form-group-30 text-danger">
                                      <div class="form-group">     
                                              <div class="checkbox ">
                                                  <label>
                                                      <input id="inputNew_message" <?= $notification['new_message'] ? 'checked' : '' ?> type="checkbox"> 
                                                      <?=lang('n.message')?>
                                                  </label>
                                              </div>
                                        </div>     
                              </div>
                              <div class="form-group-30 text-danger">
                                      <div class="form-group">     
                                              <div class="checkbox ">
                                                  <label>
                                                      <input id="inputAfter_ride" <?= $notification['after_ride'] ? 'checked' : '' ?> type="checkbox"> 
                                                      <?=lang('n.aftertr')?>
                                                  </label>
                                              </div>
                                        </div>     
                              </div>
                              <div class="form-group-30 text-danger">
                                      <div class="form-group">     
                                              <div class="checkbox ">
                                                  <label>
                                                      <input id="inputReceive_rate" <?= $notification['receive_rate'] ? 'checked' : '' ?> type="checkbox"> 
                                                      <?=lang('n.review')?>
                                                  </label>
                                              </div>
                                        </div>     
                                </div>
                               
                              <div class="form-group-30 text-danger">
                                      <div class="form-group">     
                                              <div class="checkbox ">
                                                  <label>
                                                      <input id="inputUpdates" <?= $notification['updates'] ? 'checked' : '' ?> type="checkbox"> 
                                                      <?=lang('n.site')?>
                                                  </label>
                                              </div>
                                        </div>     
                                </div>
                                </br>
                                <div class="form-group-30 ">
                                       <div class="margin-4" >
                                           <button id="inputSave" class="btn btn-primary width-150" type="button" > <?=lang('i.save')?> </button>
                                       </div>
                                </div>
                                </br>
                                </br>
                        </fieldset>
                    </form> 

    </div> <!-- End of the  class well --> 
</div><!-- End of the column  -->    
<script src="<?php echo   base_url() . 'scripts/partial/profil/profil.js' ?>"></script>