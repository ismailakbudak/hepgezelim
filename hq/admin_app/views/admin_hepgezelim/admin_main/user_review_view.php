<style type="text/css">
 .reviews{
          border: 1px solid #DDD;
          border-radius: 3px;
          padding:20px;
          margin-top: 10px; }
 .date{   text-align: right;
          font-size: 13px;
 	        font-style: italic; }
.user{    padding-left: 10px;
          padding-top: 20px;    }
.rate{    font-size: 18px;}      
</style>

<div class="row reviews" >
      <div class="col-lg-2" ></div>
      <div class=" col-lg-8">
        
         
          <?php  
          	           $username = $user['name'];
                       $date = date('Y');
                       $age =  $date - $user['birthyear'] . lang("age");
                       $alt = $username ." ". $user['surname'] ." ( ". $age  ." ) " ;
                       $path = $user['foto'];
                       
                 	     $val = " 
                                   <div class='row'>
                                      <div class='col-lg-2'>
                                          <a href='". new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ."'> 
                                            <img class='tip pic-img' title='$alt' alt='$alt' src='$path' width='60' height='70' style='width: 60px; height: 70px' >
                                          </a>
                                      </div>  
                                      <div class='col-lg-10'>
                                         <legend> <h3> ".   sprintf( lang("a.given"), count($reviews) ) ." </h3></legend>
                                      </div>
                                   </div> "; 
                 	     echo $val;  
						 
                 foreach ($reviews as $rating) {
                 	     
                 	   $username = $rating['name'];
                       $age =  $date - $rating['birthyear'] . lang("age");
                       $alt = $username ." ". $rating['surname'] ." ( ". $age  ." ) " ;
                       $path = $rating['foto'];
                       $encrypted_id = my_encode($rating['rating_id']);
					   
                 	     $val = "<div class='reviews'>
                                   <div class='row'>
                                      <div class='col-lg-2'>
                                          <a href='". new_url("user/show/" .urlencode( base64_encode($rating['received_userid'] ) ) ) ."'> 
                                            <img class='tip pic-img' title='$alt' alt='$alt' src='$path' width='60' height='70' style='width: 60px; height: 70px' >
                                          </a>
                                      </div>
                                      <div class='col-lg-6 rate'>
                                            <strong class='row'> ". lang("rg.vote") . $rating['rate']." / 5 
                                               <span class='star-large star-". $rating['rate'] ."' title='".  $rating['rate']   ." / 5' ></span>
                                            </strong>
                                      </div>
                                      <div class='col-lg-4 date'>". dateConvert3($rating['created_at'], $this->lang->lang() ) . "
                                              <a href='#' class='delete-review' data-id='".$encrypted_id."'  > <i style='margin-left:15px;'  title='". lang("cancel") ."' class='text-danger glyphicon glyphicon-remove  three' ></i>
                                              </a> 
                                           
                                      </div> 
                                   </div>
                                   <div class='row user'> <strong>". lang("a.receiver") ." ". $rating['name'] ." : </strong> `" . $rating['comment'] . "´</div>
                                   <div class='row'></div>
                 	             </div>"; 
                 	     echo $val;         
                 }
          ?>   
      </div> 
      <div class="col-lg-2" ></div>
 </div>     

<script>
	$( function(){
		             $(".delete-review").on('click',function(){
                             var id = $( this ).data("id");
                             var data = {id:id }; 
                             var url = "delete_review"; 

                             var result = JSON.parse( AjaxSendJson(url,data) ); 
                             if     ( strcmp(result.status ,'success') == 0 ){   window.location.reload(true) } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                             return false;
                     });
	});
</script> 


