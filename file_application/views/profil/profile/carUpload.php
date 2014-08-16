<div class="col-lg-8">
    <div class="well" id="result">

            <form class="bs-example form-horizontal" action="<?= new_url().'car/uploadAction/'.$carid ?>" method="POST" enctype="multipart/form-data" style="padding-right:20px; padding-left:20px;">
                    <fieldset>
                               <legend> <?=lang("a.foto")?> </legend>
                               <?  
                                    if( isset($result) && $result)
                                          echo  $result;  
                                ?>
                               <div class="form-group-30">
                                      <div class="form-group margin-4">
                                             <p class="text-success "> <?=lang("a.info")?></p>
                                             <div class="col-lg-4 control-label"> 
                                               <img class='pic-img' src="<?= $carfotoname ?> " width="100px" height="100px" > 
                                             </div>
                                             <div class="input-group margin-60">
                                                  <input id="inputImage" type="file" name="userfile" data-classButton="btn btn-primary"  >
                                             </div>
                                       </div>
                                       <span class="help-block"> <?= lang("a.desc1")?>  <strong class="text-danger"><?=lang("a.desc2")?>  </strong><?=lang("a.desc3")?>  </span>
                                     
                                </div>
                                  <p> <?= lang("a.info2")?>  </p>
                                     
                                <div class="form-group-30 ">
                                      <div class="col-lg-4"></div>
                                       <div class="margin-4" >
                                           <button id="inputKaydet" class="btn btn-primary width-150"  > <?=lang("a.save")?> </button>
                                       </div>
                                </div>
                    </fieldset>
            </form>

    </div> <!-- End of the  class well --> 
 </div><!-- End of the column  -->    
  <script src="<?php echo   base_url() . 'scripts/general/bootstrap-filestyle.js' ?>"></script> 
  <script src="<?php echo   base_url() . 'scripts/general/ajaxfileupload.js' ?>"></script> 
  <script type="text/javascript">  $( function(){  $(":file").filestyle();   });  </script>




                    