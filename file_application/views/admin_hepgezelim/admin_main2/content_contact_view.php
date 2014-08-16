  
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
		                        	<? 
		                        	        if( count($contents) > 0 )
		                        	        	 $title = $contents[0]['issue'];
		                        	        else 
		                        	             $title =  "";  	
		                        	?>
		                            <legend class="text-primary" style="padding-bottom: 10px;" > <strong style="color: rgba(7, 7, 7, 0.74); font-size: 19px;" > <?=  $title ?> </strong> 
		                            	 <?= lang("a.content-contact-page") ?> <span class="badge btn-warning mybadge" > <?= count($contents) ?> </span> 
		                            </legend> 
		                                    <ul class="list-group">
		                                        <?  foreach ($contents as $value) {      ?>
		                                        <?  $crypted_id   =  my_encode($value['id']);                                  ?>
		                                                <li class='list-group-item' data-id='<?= $value['id'] ?>' >
		                                                     <section class='user-container clearfix'>
		                                                            <div class='profile-user'>
		                                                                <div class='profile-user-container'>
		                                                                           
		                                                                          	<a href="#" class="message-show"  >
		                                                                                <div class=" row row-side" style="color: rgba(7, 7, 7, 0.74);" > 
		                                                                                	    <strong> 
		                                                                           	                <?=  lang("a.user_type") ?> 
		                                                                           	            </strong>
		                                                                                            <?=  lang("a.".$value['user_type']) ?> 
		                                                                                        <strong> 
		                                                                           	                <?=  lang("a.email") ?> </strong>
		                                                                                        </strong>
		                                                                                            <?=  $value['email'] ?> 
		                                                                                        <strong> 
		                                                                           	                <?=  lang("a.subject") ?> </strong>
		                                                                                        </strong>
		                                                                                            <?=  $value['subject'] ?> 
		                                                                                            
		                                                                                </div>
		                                                                            </a>    

		                                                                            <div class="row row-side message" style="display:none" > 
		                                                                            	    <strong> <?=  lang("a.message") ?> </strong>
		                                                                                    <?=  $value['message'] ?>   
		                                                                            </div>
 		                                                                </div>
 		                                                            </div>   
		                                                            <div class='data-process'  > 
		                                                                <a class="process-readed"  href='#' title='<?= lang("readed") ?>'  data-id='<?= $crypted_id ?>'  style='margin-right:10px;' >
		                                                                  <span class='glyphicon glyphicon-eye-open'></span>
		                                                                </a>  
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
            
            

            <script type="text/javascript">
                
                $( function(){
                     
                     $(".process-readed").on('click',function(){
                             var id = $( this ).data("id");
                             var data = {id:id }; 
                             var url = "contact_readed_process"; 

                             var result = JSON.parse( AjaxSendJson(url,data) ); 
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   );  
                                                                                 $( this ).closest("li").slideUp(); } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                             return false;
                     });

                     $( ".message-show" ).on('click', function(){
                          $( this ).parent().find(".message").slideToggle();
                     });
                        
                });

            </script>
