
<style type="text/css">
 ul{ padding: 0; margin: 0 0 0px 0px; }
 ul.unstyled { margin-left: 0; list-style: none; }
 ul { display: block; list-style-type: disc; -webkit-margin-before: 0em; -webkit-margin-after: 0em; -webkit-margin-start: 0px; -webkit-margin-end: 0px; -webkit-padding-start: 40px; }   
.car-container { margin: 0 0 14px 0; }
.car-container .profile-car-container {float: left;margin: 0 10px 0 0;text-align: center;}
.car-container .profile-car-edit {display: block;margin: 9px 0 0 0;}
.car-text {float: left;}
.car-text li { line-height: 27px;}
.car-title {font-weight: bold;font-size: 13px;line-height: 16px; }
</style>
<div class="col-lg-8 well">
     <legend> <?=lang("a.cars")?> </legend>
      <?  
             if( isset($result) && $result)
                   echo  $result;  
      ?>
     <form class="bs-example form-horizontal" >
                 <section class="prf-container clearfix">
                    <?php 
                       
                       foreach ($cars as $value) {
                          createCar($value);
                       }

                      function  createCar($value){
                           $foto =  base_url().'cars/'.$value['foto_name'] ;
                           $star =  'star_' .$value['comfort'];
                           $path =  new_url().'car/update/'. urlencode(base64_encode($value['normalid'])); 
                           $path2 =  new_url().'car/upload/'. urlencode(base64_encode($value['normalid'])); 
                           $val=" <section class='car-container clearfix'>
                                   
                                    <div class='profile-car'>
                                           <div class='profile-car-container'>
                                           <a href='{$path2}' >
                                                  <img src='{$foto}' width='100' height='100' class='user-car pic-img'>
                                                  <span class='profile-car-edit text-default'>" . lang("a.upload") ."</span>
                                           </a>
                                           </div>
                                    </div>   
                                    <div class='car-text'>
                                          <ul class='unstyled'>
                                               <li>
                                                  <h3 class='car-title' >{$value['make']}   {$value['model']}</h3>
                                              </li>
                                              <li>
                                                  {$value['number_of_seats']} " . lang("a.person") ." <span title='" . lang("a.tcomfort".$value['comfort'] ) ."' class='tip rating-car  $star'></span>
                                              </li>
                                              <li>
                                                  <a href='{$path}' style='margin-right:10px;' title='" . lang("a.tedit") ."'>
                                                      <span class='glyphicon glyphicon-pencil'></span>
                                                  </a>
                                                  <a class='deleteCar' href='#deleteCarModal' title='" . lang("a.tdelete") ."' data-toggle='modal' data-id='{$value['id']}' >
                                                      <span class='glyphicon glyphicon-trash' ></span>
                                                  </a>
                                              </li>
                                          </ul>
                                    </div>
                              </section>  ";
                            echo $val;  
                       }

                     ?>
                     <div class="form-group-30 ">
                           <div class="col-lg-4"></div>
                           <div class="margin-4" >
                               <a href="<?= new_url().'car/add'  ?>" class="btn btn-primary width-150" > <?=lang("a.addnew")?> </a>
                           </div>
                    </div>
                </section>
     </form>
</div>

 


<!-- Delete Car Modal
==========================================-->
<div  class="modal fade" id="deleteCarModal">
       <div class="modal-header">
              <button class="close" data-dismiss="modal">×</button>
              <h3  class="modal-title"> <?=lang("a.confirm")?> </h3>
       </div>
       <div class="modal-body">
              <p>  <?=lang("a.sure")?></p>
       </div>
       <div class="modal-footer">
              <a href="#" class="btn  btn-default width-100" data-dismiss="modal"> <?=lang("a.cancel")?> </a>
              <a href="#"  id="car" class="btn btn-primary width-100 onayDeleteCar" data-id='0'> <?=lang("a.delete")?> </a>
       </div>
</div>
<script src="<?php echo   base_url() . 'scripts/general/bootstrap-filestyle.js' ?>"></script> 
<script src="<?php echo   base_url() . 'scripts/general/ajaxfileupload.js' ?>"></script> 
<script src="<?php echo   base_url() . 'scripts/partial/profil/cars.js'  ?>"></script> 
 