  
    <style type="text/css">
      .list-group-item{ width: 49%; float: left;  white-space: nowrap; margin: 3.5px; }
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
		                            <legend class="text-primary" style="padding-bottom: 10px;" >  
		                            	 <?= lang("s.page") ?> 
		                            </legend> 
		                                    <ul class="list-group">
		                                        <?  foreach ($searched as $value) {      ?>
		                                        <?  $crypted_id   =  my_encode($value['id']);                                  ?>
		                                                <li class='list-group-item' data-id='<?= $value['id'] ?>' >
		                                                     <section class='user-container clearfix'>
		                                                            <div class='profile-user'>
		                                                                <div class='profile-user-container'>
		                                                                        <?=  $value['origin'] ?> 
		                                                                        <strong> <?=  $value['lat']  ?> </strong>
		                                                                        -
		                                                                        <strong> <?=   $value['lng']  ?> </strong>
		                                                                                         
		                                                                </div>
 		                                                            </div>   
		                                                            <div class='data-process'  > 
		                                                                <a class="process-approval"  href='#' title='<?= lang("a.approval") ?>'  data-id='<?= $crypted_id ?>'  style='margin-right:10px;' >
		                                                                  <span class='glyphicon glyphicon-eye-open'></span>
		                                                                </a>  
		                                                                <a class="process-not-approval"  href='#' title='<?= lang("cancel") ?>'  data-id='<?= $crypted_id ?>'  style='margin-right:10px;' >
		                                                                  <span class='glyphicon glyphicon-remove'></span>
		                                                                </a>  
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
                     
                     $(".process-approval").on('click',function(){
                             var id = $( this ).data("id");
                             var data = {id:id , process:'valid' }; 
                             var url = "searches/search_process"; 

                             var result = JSON.parse( AjaxSendJson2(url,data) ); 
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   );  
                                                                                  $( this ).closest("li").slideUp(); 
                                                                                  } // show bottom alert
                                                                                //   
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                             return false;
                     });
                     
                     $(".process-not-approval").on('click',function(){
                             var id = $( this ).data("id");
                             var data = {id:id , process:'invalid' }; 
                             var url = "searches/search_process"; 

                             var result = JSON.parse( AjaxSendJson2(url,data) ); 
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   ); 
                             	                                                 $( this ).closest("li").slideUp();    
                                                                                  } // show bottom alert
                                                                                //$( this ).closest("li").slideUp();    
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                             return false;
                     });
  
                        
                });

            </script>
