  
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
		                            <legend class="text-primary" > <?= lang("a.contact-page") ?> </legend> 
		                            <?  foreach ($contacts as $value) {  ?>
		                            <?    $issue =   $value['url']   ?> 
		                            <?    $path =  new_url("admin_hepgezelim/content_contact_view/" . $issue )  ?>
		                                 <div class="row" >  
		                                    <div  class="col-lg-12" style="font-weight:bold; font-size:16px; padding:6px;" > 
		                                          <a class="process-readed"  href='<?= $path ?>'  style='margin-right:10px;' >
		                                            <span class='text-danger glyphicon glyphicon-tasks'></span>
		                                            <strong style="color: rgba(7, 7, 7, 0.74); font-size: 19px;" > <?= "\"" . $value['issue']  ."\" "  ?> </strong>  <?=  lang("a.about") ?> 
		                                            <span class="badge btn-warning  mybadge"> <?= $value['num'] ?> </span>
		                                          </a> 
		                                    </div>
                                         </div>                               
		                            <?  }                                  ?>
		                        </div>     
		                    </div>
		            </div>
		    </div><!--- End of the row -->                
            
            

            <script type="text/javascript">
                
                $( function(){ 
                        
                });

            </script>
