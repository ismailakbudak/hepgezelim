    <style type="text/css">
      .list-group-item{ width: 130px; float: left;  white-space: nowrap; margin: 3.5px; }
      .data-process{ font-size: 20px; padding: 10px 0px 0px 30px; }
    </style>
    <!-- container
    ================================== --> 
    <div class="container">
            <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
               <?= lang("a.banned-users-more") ?>  <a href="<?= new_url('admin_hepgezelim/banned_user_view/' . $OFFSET ) ?>"> <?= lang("click") ?> </a>
            </div>
    	    <? if( $OFFSET > $LIMIT ){ ?>
    	            <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
                       <?= lang("a.first-page") ?>  <a href="<?= new_url('admin_hepgezelim/banned_user_view/0' ) ?>"> <?= lang("click") ?> </a>
                    </div>
    	    <? } ?> 
    	    <div class="row well" style="padding: 30px 20px 30px 20px; margin:5px 0px 0px 0px; background-color: #FFFFFF; margin-top:20px" >
		            <div class="row slide" > 
		                    <div class="col-lg-12" >
		                        <div class="bs-example">
		                            <legend class="text-danger" > <?= lang("a.users-banned") ?> </legend> 
		                            <ul class="list-group">
		                                        <?  foreach ($bans as $value) {      ?>
		                                        <?  $foto       =  $value['foto'];    ?>
		                                        <?  $crypted_id =  my_encode($value['id']);                    
                                                    $username   = $value['name'];
                                                    $date       = date('Y');
                                                    $age        =  $date - $value['birthyear'] . lang("m.age");
                                                    $alt        = $username ." ". $value['surname'] ."(". $age  .")" ;
                                                ?>
		                                                <li class='list-group-item' data-id='<?= $value['id'] ?>' >
		                                                     <section class='user-container clearfix'>
		                                                            <div class='profile-user'>
		                                                                <div class='profile-user-container'>
		                                                                       <img  title='<?= $alt ?>' alt='<?= $alt ?>'  src='<?= $foto ?>' width='80' height='100' class='pic-img'>
		                                                                </div>
		                                                            </div>   
		                                                            <div class='data-process'  >
		                                                                <a class="user-ban-cancel" data-id='<?= $crypted_id ?>' href='#' title='<?= lang("cancel") ?>' >
		                                                                    <span class='glyphicon glyphicon-trash' ></span>
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
                      
                     $(".user-ban-cancel").on('click',function(){
                             var id  = $( this ).data("id");
                             var data = {id:id, process:"remove"   };
                             var url = "user_ban_process";
                             var result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   );
                                                                                 $( this ).closest("li").slideUp();  } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                      
                             return false;
                     });
                });

            </script>
 