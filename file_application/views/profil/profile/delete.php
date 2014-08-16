<style type="text/css">
blockquote small{color:#000;}
</style>
  <!-- Modal newuser
    =====================================================-->
       <div class="row">
          <div class="col-lg-10 " >
            <div class="well">
                 <legend> <?=lang("d.title")?> </legend>
                 <form class="bs-example form-horizontal" style="padding-right:20px; padding-left:20px;">
                      <fieldset>
                                <div class="form-group-30">
                                     <blockquote>
                                          <p> <?=lang("d.if")?> </p>
                                          <small> <?=lang("d.if1")?> <a href="<?= new_url() .'profil/profile/info' ?>" class="text-primary">  <?=lang("d.if11")?> </a> <?=lang("d.if111")?> </small>
                                          <small> <?=lang("d.if2")?>  <a href="<?= new_url() .'profil/profile/info' ?>" class="text-primary"> <?=lang("d.if22")?> </a> <?=lang("d.if222")?>  </small>
                                          <small> <?=lang("d.if3")?> <a href="<?= new_url() .'contact' ?>" class="text-primary"> <?=lang("d.if33")?>   </a> <?=lang("d.if333")?> </small>
                                          <small> <?=lang("d.if4")?> <a href="<?= new_url() .'profil/profile/notification' ?>" class="text-primary"> <?=lang("d.if44")?>  </a></small>
                                          <small> <?=lang("d.if5")?>
                                            <a href="<?= new_url('message') ?>"  class="text-primary"> <?=lang("d.if55")?>  </a> <?=lang("d.or")?>
                                            <a href="<?= new_url('contact') ?>" class="text-primary"> <?=lang("d.if555")?> </a>
                                            <strong class="text-danger"> <?=lang("d.if5555")?> </strong></small>
                                     </blockquote>
                                      <div class="col-lg-12">
                                        <div class="alert alert-dismissable alert-danger">
                                          <strong> <?=lang("d.sory")?> </strong> <?=lang("d.undisplay")?> 
                                        </div>
                                      </div>
                                 </div>     
                                 <div class="form-group-30">
                                     <blockquote>
                                          <p> <?=lang("d.sure")?>  </p>
                                    </blockquote>
                                     <div class="form-group margin-4">
                                             <label for="inputDescription" class="col-lg-3 control-label"> <?=lang("d.desc")?> :</label>
                                             <div class="col-lg-8" style="padding:0px" >
                                                 <textarea  class="form-control" rows="2" style="max-width: 500px; max-height: 100px;" id="inputDescription" placeholder="<?=lang("d.pdesc")?>"></textarea>
                                             </div>
                                     </div>
                                 </div>
                                 </br>
                                 <div class="form-group-30 ">
                                         <div class="col-lg-4"></div>
                                         <div class="" style="margin-left:180px;" >
                                             <button id="inputDelete" class="btn btn-warning width-150" type="button" > <?=lang("d.delete")?></button>
                                         </div>
                                </div>
                      </fieldset>
                 </form> 
              </div>
          </div>
       </div>
       <script src="<?php echo   base_url() . 'scripts/partial/profil/profil.js' ?>"></script> 
 