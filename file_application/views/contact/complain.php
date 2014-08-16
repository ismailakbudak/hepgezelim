     
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
                                                <legend > <h2 style='color: rgba(4, 4, 5, 0.61);' > <?= lang('c.pageComplain') ?> </h2> </legend>
                                                <?php
                                                      $username = $user['name'];
                                                      $date     = date('Y');
                                                      $age      =  $date - $user['birthyear'] . lang("age");
                                                      $alt      = $username ." ". $user['surname'] ." ( ". $age  ." )" ;
                                                      $path     = $user['foto'];
                                                      $tel      =  ( $user['tel_visible'] == 1 && strcmp("", $user['tel_no']) != 0  )  ? ( lang("m.telefon") ." ". $user['tel_no'] ) : "<i class='glyphicon glyphicon-phone three' ></i> <i class='glyphicon glyphicon-lock three' ></i>" ;
                                                 ?>
                                               
                                                 <div class="form-group" style='margin-top:10px;'  >
                                                    <label for="inputSubject" class="col-lg-2 control-label">  </label>
                                                    <div class="col-lg-2">
                                                        <a href='<?= new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ?>'> 
                                                            <img class='tip pic-img' title='<?= $alt ?>' alt='<?= $alt ?>' src='<?= $path ?>' width='60' height='70' style='float: right;  width: 60px; height: 70px' >
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-8">
                                                             <div class="alert alert-dismissable alert-danger">
                                                               <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                               <strong>  <?= $username ?> </strong> <?= lang("c.complaininfo") ?> 
                                                             </div> 
                                                    </div>
                                                </div>
 

                                                <div class="form-group"> 
                                                  <label for="textAreacomplain" class="col-lg-2 control-label"> <?= lang("c.complain") ?> </label> 
                                                  <div class="col-lg-10">
                                                    <textarea    class="form-control" rows="3" id="textAreacomplain"  style="max-width:602px; max-height:200px" placeholder="<?= lang("c.messageP") ?>"></textarea>
                                                    <span class="help-block"> </span>
                                                  </div>
                                                </div>
                                              
                                                <div class="form-group">
                                                  <label for="inputEmail" class="col-lg-2 control-label"> <?= lang("c.email") ?> </label>
                                                  <div class="col-lg-10">
                                                    <input type="text"   class="form-control" id="inputEmail2" value="<?= $email ?>"  placeholder="<?= lang("c.emailP") ?>">
                                                  </div>
                                                </div>
                                               
                                                <hr>  
                                               
                                                <div class="form-group">
                                                  <div class="col-lg-10 col-lg-offset-2"> 
                                                    <button id="buttonSendComplain" type="button"  data-id='<?= urlencode(base64_encode($user['id']))?>'  class="btn btn-primary width-200">  <?= lang("c.send") ?>  </button> 
                                                  </div>
                                                </div>
                                                <br> 
                                         </div>  
                                    </fieldset>  
                                 </div>   
                              </div>   
                        </div>   <!-- FULL -->        
                        <div class="col-lg-2" ></div>  <!-- NULL -->
                     </div>
              </div>
             <script src="<?php  echo  base_url() . 'scripts/partial/contact.js'  ?>"></script>      

   
 
