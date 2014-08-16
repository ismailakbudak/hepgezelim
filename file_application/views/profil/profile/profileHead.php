    
    <?    $this->lang->load('profil'); ?>
    <style type="text/css">
        .top-length{ margin-top:30px;    }
        .bottomlength{ margin-bottom:150px !important; }      
    </style>
    <script type="text/javascript">
       er.invalid_tel     = '<?= lang("p.invalid_tel")?>';
       er.blank_car_make  = '<?= lang("p.blank_car_make")  ?>';
       er.blank_car_model = '<?= lang("p.blank_car_model") ?>';
       er.sel_comfort     = '<?= lang("p.sel_comfort")     ?>';
       er.blank_seat      = '<?= lang("p.blank_seat")      ?>';
       er.blank_desc      = '<?= lang("p.blank_desc")      ?>';
       er.wrong_old_pass  = '<?= lang("p.wrong_old_pass")  ?>';
       er.blank_kod       = '<?= lang("p.blank_kod")       ?>';
       er.send_email      = '<?= lang("p.send_email")      ?>';
    </script>                
    <div class="container"  style="float:left;">

        <div  class="col-sm-12" style="margin-top:-17px; padding:0px;">
            <div class="col-xs-2"> <!-- required for floating -->
                <!-- Nav tabs -->

                <ul class="nav nav-tabs tabs-left" >
                  <li class="top-length"> <legend class=" text-success" ><i class="text-info glyphicon glyphicon-cog "></i>  <?=lang('p.info')?>  </legend>  </li> 
                  <li id="info">  <a href="<?php echo new_url().'profil/profile/info' ?>" > <i class="text-danger glyphicon glyphicon-user two"></i> <?=lang('p.personinfo')?> </a></li>
                  <li id="foto">  <a href="<?php echo new_url().'profil/profile/foto' ?>" > <i class="text-primary glyphicon glyphicon-camera two"></i> <?=lang('p.foto')?>       </a></li>
                  <li id="preference">  <a href="<?php echo new_url().'profil/profile/preference' ?>" > <i class="text-info glyphicon glyphicon-list two"></i> <?=lang('p.prefer')?> </a></li>
                  <li id="verification">  <a href="<?php echo new_url().'profil/profile/verification' ?>"  > <i class="text-success glyphicon glyphicon-check two"></i> <?=lang('p.verify')?> </a></li>
                  <li id="cars">  <a href="<?php echo new_url().'profil/profile/cars' ?>" > <i class="glyphicon icon-car two"></i> <?=lang('p.mycars')?></a></li>                           
                  <li id="notification">  <a href="<?php echo new_url().'profil/profile/notification' ?>" > <i class="text-danger glyphicon glyphicon-bell two"></i> <?=lang('p.notification')?> </a></li>
                <? if( isset($user) && $user['is_face_acount'] == 0 ){ ?>
                    
                      <li id="password">  <a href="<?php echo new_url().'profil/profile/password' ?>" > <i class="text-danger glyphicon glyphicon-lock two"></i> <?=lang('p.pass')?> </a></li>
                
                <? }                                                    ?> 
                  <li id="delete" class="bottomlength"  >  <a href="<?php echo new_url().'profil/profile/delete' ?>" > <i class="text-danger glyphicon glyphicon-trash two"></i> <?=lang('p.deleteacount')?> </a></li>
                </ul>
            </div>

            <div class="col-xs-10" style="margin-top:10px;">