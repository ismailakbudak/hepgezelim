    <style type="text/css">
      .list-group-item{ width: 130px; float: left;  white-space: nowrap; margin: 3.5px; }
      .image-process{ font-size: 20px; padding: 10px 30px 0px 10px; }
    </style>
    <!-- container
    ================================== --> 
    <div class="container">
            <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
               <?= lang("a.approval-user-photo-more") ?>  <a href="<?= new_url('admin_hepgezelim/user_photo_approval_view/' . $OFFSET ) ?>"> <?= lang("click") ?> </a>
            </div>
    	    <? if( $OFFSET > $LIMIT ){ ?>
    	            <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
                       <?= lang("a.first-page") ?>  <a href="<?= new_url('admin_hepgezelim/user_photo_approval_view/0' ) ?>"> <?= lang("click") ?> </a>
                    </div>
    	    <? } ?> 
    	    <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
		            <div class="row slide" > 
		                    <div class="col-lg-12" >
		                        <div class="bs-example">
		                            <legend class="text-success"  > <?= lang("a.user-images2") ?> </legend> 
		                            <ul class="list-group">
		                                        <?  foreach ($images as $value) {      ?>
		                                        <?  $foto       =  $value['foto'];    ?>
		                                        <?  $crypted_id =  my_encode($value['id']);                    ?>
		                                                <li class='list-group-item' data-id='<?= $value['id'] ?>' >
		                                                     <section class='user-container clearfix'>
		                                                            <div class='profile-user'>
		                                                                <div class='profile-user-container'  style='margin-left:10px;' >
		                                                                       <img src='<?= $foto ?>' width='80' height='100' class='pic-img'  >
		                                                                </div>
		                                                            </div>   
		                                                            <div class='image-process' data-id='<?= $crypted_id ?>' >
		                                                                <a class="image-invalid" href='#' title='<?= lang("cancel") ?>'  style='margin-right:30px;'>
		                                                                    <span class='glyphicon glyphicon-trash' ></span>
		                                                                </a>

                                                                        <!--- Warn user -->
                                                                         <? $crypted_user_id = my_encode( $value['id'] );  ?>
                                                                         <a data-id='<?= $crypted_user_id ?>'  class="info-send-modal-open"  href='#info-send-user-modal' data-toggle='modal' title='<?= lang("user-warn") ?>'   style='margin-right:10px;' >
                                                                           <span class='glyphicon glyphicon-user'></span>
                                                                         </a>  
                                                                        <!--- end of the warn user -->

		                                                            </div>
		                                                      </section> 
		                                                </li>
		                                        <?  }                                  ?>
		                            </ul>
		                        </div>     
		                    </div>
		            </div>
		    </div><!--- End of the row -->                
            
            <script type="text/javascript">
                
                $( function(){
                     
                     
                     $(".image-invalid").on('click',function(){
                             var id  = $( this ).parent().data("id");
                             var data = {id:id, process:'invalid' };
                             var url = "user_foto_process";

                             var result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   ); 
                                                                                 $( this ).closest("li").slideUp(); } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                      
                             return false;
                     });

                });

            </script>
 