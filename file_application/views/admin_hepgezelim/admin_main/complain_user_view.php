 
    <style type="text/css">
      .list-group-item{ width: 100%; float: left;  white-space: nowrap; margin: 3.5px; }
      .data-process{ font-size: 20px; padding: 10px 0px 0px 20px; }
      .date{ font-size: 12px; float: right; }
      .small{ font-size: 14px; }
    </style>
    <!-- container
    ================================== --> 
    <div class="container"> 
    	    <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
		            <div class="row slide" > 
		                    <div class="col-lg-12" >
		                        <div class="bs-example">
		                            <legend class="text-danger" > <?= lang("a.complain-user-messages") ?> </legend> 
		                            <ul class="list-group">
		                                        <?  foreach ($complains as $value) {      ?>
		                                        <?  $crypted_complain_user_id     =  my_encode($value['complain_user_id']);                    ?>
		                                        <?  $crypted_sender_id       =  my_encode($value['user_id']);                      ?>
		                                        <?  $crypted_complain_id   =  my_encode($value['id']);                                  ?>
		                                        <?  $alt   =  lang('sender') . $value['s_name'] . " " .$value['s_surname'] ;
												    $foto  = $value['s_foto'];
													$alt2  = lang('receiver') . $value['r_name'] . " " .$value['r_surname'];
												    $foto2 = $value['r_foto'];         ?>
		                                                <li class='list-group-item' data-id='<?= $value['id'] ?>' >
		                                                     <section class='user-container clearfix'>
		                                                            <div class='row profile-user'>
		                                                            	<div class="col-lg-2" >
 		                                                                 	   <img  title='<?= $alt ?>' alt='<?= $alt ?>'  src='<?= $foto ?>' width='80' height='100' class='pic-img' style="margin-right: 10px">
 		                                                                 	   <img  title='<?= $alt2 ?>' alt='<?= $alt2 ?>'  src='<?= $foto2 ?>' width='80' height='100' class='pic-img'>
 		                                                                </div>  
		                                                                <div class='col-lg-10 profile-user-container'>
		                                                                        <div class="row row-side"> <strong  > <?= lang("a.sender-message")?> </strong>  <?=  $value['complain'] ?> </div>
		                                                                        <div class="row row-side"> <strong  > <?= lang("a.sender-email")?> </strong> <?=  $value['email'] ?>   </div>
 		                                                                 </div>
 		                                                            </div>   
		                                                            <div class='row data-process' data-id='<?= $crypted_complain_id ?>' >
		                                                               
		                                                                <a class="process-readed"  href='#' title='<?= lang("readed") ?>'  data-id='<?= $crypted_complain_id ?>'  style='margin-right:10px;' >
		                                                                  <span class='glyphicon glyphicon-eye-open'></span>
		                                                                </a> 
                                                                        <? if( $value['user_id'] > 0 ){   ?>
		                                                                            <strong class="small"> <?= lang("a.sender-process") ?> </strong>
		                                                                            <a class="warn-modal-open"  href='#warn-user-modal' data-toggle='modal' title='<?= lang("sender-warn") ?>' data-id='<?= $crypted_sender_id ?>'  style='margin-right:10px;' >
		                                                                              <span class='text-success glyphicon glyphicon-user'></span>
		                                                                            </a>  
		                                                                            <a class="user-ban"  href='#' title='<?= lang("sender-ban") ?>' data-id='<?= $crypted_sender_id ?>'  style='margin-right:10px;' >
		                                                                              <span class='text-success glyphicon glyphicon-ban-circle'></span>
		                                                                            </a>  
                                                                         <? } if( $value['complain_user_id'] > 0 ){     ?>  
				                                                                     <strong class="small"> <?= lang("a.complained-user-process") ?> </strong>
				                                                                     <a class="warn-modal-open"  href='#warn-user-modal' data-toggle='modal' title='<?= lang("complained-user-warn") ?>' data-id='<?= $crypted_complain_user_id ?>' style='margin-right:10px;' >
				                                                                       <span class='text-danger glyphicon glyphicon-user'></span>
				                                                                     </a>
				                                                                      <a class="user-ban"  href='#' title='<?= lang("complained-user-ban") ?>' data-id='<?= $crypted_complain_user_id ?>'  style='margin-right:10px;' >
				                                                                       <span class='text-danger glyphicon glyphicon-ban-circle'></span>
				                                                                     </a> 
				                                                                     <a class="user-show-review"  href='<?= new_url("admin_hepgezelim/user_review_view/" . $crypted_complain_user_id) ?>' title='<?= lang("show-user-review") ?>'   style='margin-right:10px;' >
				                                                                       <span class='text-danger glyphicon glyphicon-star-empty'></span>
				                                                                     </a>  
		                                                               <?}                    ?>
		                                                                 
		                                                                <span class="date">  <?=  lang("created_at") .  dateConvert($value['created_at'], lang('lang')) ?>   </span>
		                                                            </div>
		                                                      </section> 
		                                                </li>
		                                        <?  }                                  ?>
		                            </ul>
		                        </div>     
		                    </div>
		            </div>
		    </div><!--- End of the row -->                
            
            <!-- Warn user modal  
            ===============================================================--> 
            <div id="warn-user-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-width="440px" data-keyboard="false"    style="display: none;">
                   <div class="modal-body">
                          <p> <?= lang("a.warn-message") ?></p>
                          <textarea  id='inputWarnMessage' class='form-control' rows='3' style='max-width: 390px; max-height:100px; margin-bottom:10px' id='textArea'></textarea>                                                   
                          <p> <?= lang("a.warn-message-en") ?></p>
                          <textarea  id='inputWarnMessageEn' class='form-control' rows='3' style='max-width: 390px; max-height:100px; margin-bottom:10px' id='textArea'></textarea>                                                   
                          <div class="bs-example" style="margin-bottom: 15px;">
                             <div class="btn-group btn-group-justified data-types">
                                 <a href="#" class="btn btn-default data-type active" data-type="warning"> <?= lang('a.warning') ?> </a>
                                 <a href="#" class="btn btn-default data-type"        data-type="info"> <?= lang('a.info') ?></a>
                                 <a href="#" class="btn btn-default data-type"        data-type="other"> <?= lang('a.other') ?> </a>
                             </div>
                          </div> 
                   </div>
                   <div class="modal-footer">
                         <button type="button" id="modal-cancel" data-dismiss="modal" class="btn width-100"><?= lang("g.cancel") ?></button>
                         <button type="button" id="user-warn" data-user-id="-1"  data-dismiss="modal" class="btn btn-primary width-100 "><?= lang("a.send") ?></button>
                   </div>
            </div>

            <script type="text/javascript">
                
                $( function(){
                     
                     $(".process-readed").on('click',function(){
                             var id = $( this ).parent().data("id");
                             var data = {id:id }; 
                             var url = "complain_user_readed_process"; 

                             var result = JSON.parse( AjaxSendJson(url,data) ); 
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   );  
                                                                                 $( this ).closest("li").slideUp(); } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                             return false;
                     });
                     
                     CapitiliazeFirst(  [ "#inputWarnMessage", "#inputWarnMessageEn" ]  );
                     $( "#modal-cancel" ).on('click',function(){    $("#inputWarnMessage").val(""); $("#inputWarnMessageEn").val("");   });
                     $( ".warn-modal-open" ).on('click',function(){
                            var user_id      = $(this).data('id');
                            $("#user-warn").data("user-id",user_id); 
                     }); 
                     $("#user-warn").on('click',function(){
                             var user_id      = $( this ).data("user-id");
                             var message      = $("#inputWarnMessage").val();
                             var message_en   = $("#inputWarnMessageEn").val();
                             var type         = $( ".data-types" ).find(".active").data('type');
                             var data         = {user_id:user_id, message:message, type:type, message_en:message_en };
                             var url          = "user_warn_process";
                             var result       = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){   $("#inputWarnMessage").val("");
                                                                                 $("#inputWarnMessageEn").val("");
                             	                                                 $( "#warn-user-modal").modal('toggle');
                             	                                                 BasariMesaj( result.text   );             } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesajModal( $(this), result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesajModal( $(this), result.message  )} // show top
                             else                                            {   HataMesajModal( $(this), er.error_send   )} // show bottom alert  
                             return false;
                     });
                     $( ".data-type" ).on('click',function(){
                          $( ".data-type" ).removeClass('active');
                          $( this ).addClass('active'); 
                          return false;
                     });



                     $(".user-ban").on('click',function(){
                             var id  = $( this ).data("id");
                             var data = {id:id, process:"add"   };
                             var url = "user_ban_process";
                             var result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   );  } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                      
                             return false;
                     });



                });

            </script>
