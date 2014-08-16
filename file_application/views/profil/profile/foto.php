<div class="col-lg-8">
    <div class="well" id="result">

            <form class="bs-example form-horizontal" action="<?= new_url().'profil/upload'?>" method="POST" enctype="multipart/form-data" style="padding-right:20px; padding-left:20px;">
                    <fieldset>
                               <legend> <?=lang('i.title')?> </legend>
                               <?  
                                    if( isset($result) && $result)
                                          echo  $result;  
                                ?>
                               <div class="form-group-30">
                                      <div class="form-group margin-4">
                                             <p class="text-success " style="padding-left:15px;"> <?=lang('i.desc')?> </p>
                                             <div class="col-lg-4 control-label"> 
                                                 <img class="pic-img"  src="<?= $fotoname ?> "  width="100px" height="120px" > 
                                             </div>
                                             <div class="input-group margin-60">
                                                   <input id="inputImage" type="file" name="userfile" data-classButton="btn btn-primary"  >
                                             </div>
                                       </div>
                                       <p> <?= lang('i.help')?> </p>
                                            
                                       <button id="useFaceFoto" class="btn btn-primary form-control mrn-lr-20" style="margin-bottom:20px; " > <img src="<?= base_url() ?>styles/images/facebook-back.png"  width="26" height="26"  style="padding-top: 0px; margin-top: -4px; margin-left: -16px; width: 26px; height: 26px;" /> 
                                          	<?=lang('i.useface')?> 
                                       </button>  
                                           
                                       <span class="help-block"> <?=lang('i.help1')?> <strong class="text-danger"> <?=lang('i.help11')?>  </strong></span>
                                     
                                </div>
                                <div class="form-group-30 ">
                                      <div class="col-lg-4"></div>
                                       <div class="margin-4" >
                                           <button id="inputKaydet" class="btn btn-primary width-150"  > <?=lang('i.save')?> </button>
                                       </div>
                                </div>
                    </fieldset>
            </form>

    </div> <!-- End of the  class well --> 
 </div><!-- End of the column  -->    
  <script src="<?php echo   base_url() . 'scripts/general/bootstrap-filestyle.js' ?>"></script> 
  <script src="<?php echo   base_url() . 'scripts/general/ajaxfileupload.js' ?>"></script> 
  <script src="<?php echo   base_url() . 'scripts/partial/profil/profil.js' ?>"></script>
  <script src="<?php echo  base_url() . 'scripts/partial/face-process.js'  ?>"></script> 
  <script type="text/javascript"> 
    $( function(){  
            $(":file").filestyle();
    });  
  </script>
  


                    