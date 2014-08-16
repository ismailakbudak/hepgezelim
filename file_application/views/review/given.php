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
         <legend> <h3> <?=   sprintf( lang("rg.given"), count($given) ) ?> </h3></legend>
          <?php 
                 foreach ($given as $rating) {
                 	     
                 	     $username = $rating['name'];
                       $date = date('Y');
                       $age =  $date - $rating['birthyear'] . lang("age");
                       $alt = $username ." ". $rating['surname'] ." ( ". $age  ." ) " ;
                       $path = $rating['foto'];

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
                                           
                                      </div> 
                                   </div>
                                   <div class='row user'> <strong>". lang("rg.giver") ." ". $rating['name'] ." : </strong> `" . $rating['comment'] . "´</div>
                                   <div class='row'></div>
                 	             </div>";


                 	     echo $val;         
                 }
          ?> 

       
      </div>

      <div class="col-lg-2" ></div>
 </div>     