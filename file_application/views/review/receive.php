
<style type="text/css">
 .reviews{
          border: 1px solid #DDD;
          border-radius: 3px;
          padding:20px;
          min-width: 600px;
          margin-top: 10px; }

 .review{
          border: 1px solid #DDD;
          border-radius: 3px;}

 .date{   text-align: right;
          font-size: 13px; 
 	        padding-top: 10px;
 	        font-style: italic; }
.user{    padding-left: 10px;
          padding-top: 20px;    }
.rate{    font-size: 18px; 
          font-weight: bold;}    
.commnet{ margin-top: 10px;  }


/* for talk */
.msg-comment-sender {
               float:left;   
               max-width: 590px;
               width: 590px;
               min-width: 265px;
               border: 1.4px solid #ccc;
               -webkit-border-radius: 3px;
               -moz-border-radius: 3px;
               -ms-border-radius: 3px;
               -o-border-radius: 3px;
               border-radius: 3px;
               padding-top: 10px;
               padding-left: 20px;
               padding-bottom: 10px;
               padding-right: 30px;
               overflow: hidden;
               zoom: 1;
               margin-top: 15px;
               margin-left: 10px; }
.msg-photo-container-right{padding-right: 25px;}

.msg-photo-container-left { display: block; position: relative; }
.msg-photo-container-left:before {
                      border-top: 0px solid rgba(0,0,0,0);
                      border-bottom: 17px solid rgba(0,0,0,0);
                      border-right: 13px solid #ccc;
                      top: 22px;
                      right: -11px;
                      z-index: 1; }
.msg-photo-container-left:before, 
.msg-photo-container-left:after {
                     content: '';
                     position: absolute;
                     height: 0;
                     width: 0; }
.msg-photo-container-left:after {
                     border-top: 0px solid rgba(0,0,0,0);
                     border-bottom: 14px solid rgba(0,0,0,0);
                     border-right: 11px solid #FFFFFF;
                     top: 23px;
                     z-index: 2;
                     right: -12px; }
   
.progress-bar {     background: #FDF139;
	                -webkit-border-radius: 3.5px;
                    -moz-border-radius: 3.5px;
                    -ms-border-radius: 3.5px;
                    -o-border-radius: 3.5px;
                    border-radius: 3.5px;
                    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #fedc21), color-stop(100%, #fde72e));
                    background-image: -webkit-linear-gradient(#fedc21,#fde72e);
                    background-image: -moz-linear-gradient(#fedc21,#fde72e);
                    background-image: -o-linear-gradient(#fedc21,#fde72e);
                    background-image: linear-gradient(#fedc21,#fde72e);
                    -webkit-box-shadow: #cc9e06 1px 1px 1px inset,#f3c201 -1px -1px 1px inset;
                    -moz-box-shadow: #cc9e06 1px 1px 1px inset,#f3c201 -1px -1px 1px inset;
                    box-shadow: #cc9e06 1px 1px 1px inset,#f3c201 -1px -1px 1px inset;      
                    width: 60%;
                    height: 15px;
                    margin-top: 0px;}
.progress{    background-color: #DCF5E2;
              height: 16px;
              margin: 0px;
              padding: 0px;
              margin-top: 3px;
              padding-top: 0px;  }                    
.no{ padding-left: 2px; padding-right: 2px; font-size: 16px }                    
</style>
<?php
     $total = count($receive);
     if( $total == 0 )
         $avg = 0;

?>
<div class="reviews col-lg-12">
     <div class="row" >   
          <div class="col-lg-1"></div>
          <div class="col-lg-8 well review" style="padding-bottom:15px">
              <form class="bs-example form-horizontal">
                  <fieldset>
    	              <div class="col-lg-5 rate"> 
    	              	     <div style="float:left"> <?= sprintf( lang("rr.receive") , $total ) ?> — <?= number_format($avg, 1, '.', '.')  ?> / 5 </div> 
        	                 <span class='star-large star-<?= number_format($avg, 1, '-', '') ?>' title='<?= number_format($avg, 1, '.', '.') ?> / 5' style="float:left" ></span>
    	              </div>

    	              <div class="col-lg-7">    
                      <?php  
                            $per1   = 0;
                            $count1 = 0;
                            $per2   = 0;
                            $count2 = 0;
                            $per3   = 0;
                            $count3 = 0;
                            $per4   = 0;
                            $count4 = 0;
                            $per5   = 0;
                            $count5 = 0;
                            if( $total != 0 ){
                                  foreach ($groupedRatings as $value) {
                                      $percent = ($value['number'] / $total) * 100;
                                      if( $value['rate'] == 1 ){ 
                                          $per1   = $percent;
                                          $count1 = $value['number'];  
                                      }
                                      else if( $value['rate'] == 2 ){ 
                                          $per2   = $percent;
                                          $count2 = $value['number'];  
                                      }
                                      else if( $value['rate'] == 3 ){ 
                                          $per3   = $percent;
                                          $count3 = $value['number'];  
                                      }
                                      else if( $value['rate'] == 4 ){ 
                                          $per4   = $percent;
                                          $count4 = $value['number'];  
                                      }
                                      else if( $value['rate'] == 5 ){ 
                                          $per5   = $percent;
                                          $count5 = $value['number'];  
                                      }
                                  }     
                          }         
                      ?>        
                        <div class='bs-example'>
                        	   <div class='col-lg-4 no' style='text-align:right' ><strong>1 <?= lang('r.star') ?></strong> </div>
                            <div class='col-lg-7 no' >
                                <div class='progress'>
                                  <div class='progress-bar' style='width: <?= $per1?>%;'></div>
                                </div>
                            </div>    
                            <div class='col-lg-1 no' style='text-align:left' ><strong> <?= $count1 ?> </strong> </div>
                        </div>

                         <div class='bs-example'>
                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 2 <?= lang('r.star') ?></strong> </div>
                            <div class='col-lg-7 no' >
                                <div class='progress'>
                                  <div class='progress-bar' style='width: <?= $per2 ?>%;'></div>
                                </div>
                            </div>    
                            <div class='col-lg-1 no' style='text-align:left' ><strong> <?= $count2 ?> </strong> </div>
                        </div>

                         <div class='bs-example'>
                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 3 <?= lang('r.star') ?></strong> </div>
                            <div class='col-lg-7 no' >
                                <div class='progress'>
                                  <div class='progress-bar' style='width: <?= $per3 ?>%;'></div>
                                </div>
                            </div>    
                            <div class='col-lg-1 no' style='text-align:left' ><strong> <?= $count3 ?> </strong> </div>
                        </div>

                         <div class='bs-example'>
                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 4 <?= lang('r.star') ?></strong> </div>
                            <div class='col-lg-7 no' >
                                <div class='progress'>
                                  <div class='progress-bar' style='width: <?= $per4 ?>%;'></div>
                                </div>
                            </div>    
                            <div class='col-lg-1 no' style='text-align:left' ><strong> <?= $count4 ?> </strong> </div>
                        </div>

                         <div class='bs-example'>
                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 5 <?= lang('r.star') ?></strong> </div>
                            <div class='col-lg-7 no' >
                                <div class='progress'>
                                  <div class='progress-bar' style='width: <?= $per5 ?>%;'  ></div>
                                </div>
                            </div>    
                            <div class='col-lg-1 no' style='text-align:left' ><strong> <?= $count5 ?> </strong> </div>
                        </div>
                                    
    	              </div>
                                     
    	          </fieldset>
    	      </form>        
    	    </div>
          <div class="col-lg-2"></div>
          
    </div>
    <br>
    <?php 
           foreach ($receive as $rating) {
           	     
           	     $username = $rating['name'];
                 $date = date('Y');
                 $age =  $date - $rating['birthyear'] . lang("age");
                 $alt = $username ." ". $rating['surname'] ." ( ". $age  ." ) " ;
                 $path = $rating['foto'];
                 $is_give = FALSE;
                 foreach ($givenRateUseridList as $user) {
                      if( $user['id'] == $rating['given_userid'] ){
                          $is_give = TRUE;
                          break; 
                      }

                 }
           	     $val = "<div class='row commnet'> 
           	                 <div class='col-xs-2 msg-photo-container-left'>
                                    <a href='". new_url("user/show/" .urlencode( base64_encode( $rating['given_userid'] ) ) ) ."'> 
                                      <img class='tip pic-img' title='$alt' alt='$alt' src='$path' width='60' height='70' style='float:right;  width: 60px; height: 70px' >
                                    </a>
                             </div>
                                
           	                  <div  class='col-xs-6 msg-comment-sender review'>
                                   <div class='row'>
                                      <div class='col-lg-7 rate'>
                                            <strong class='row'> ". lang("rg.vote") . $rating['rate']." / 5 
                                               <span class='star-large star-". $rating['rate'] ."'  title='".  $rating['rate']  ." / 5'  ></span>
                                            </strong>
                                      </div>
                                      <div class='col-lg-5 date'>". dateConvert3($rating['created_at'], $this->lang->lang() ) . "
                                           <a href='". new_url("contact/complain/" . urlencode(base64_encode($rating['given_userid'])) ) ."'> 
                                               <i title='". lang("alert") ."' class='text-danger glyphicon glyphicon-flag two' ></i> 
                                           </a>
                                      </div> 
                                    </div>
                                  <div class='row user'> <strong>". lang("rg.giver") ." ". $rating['name'] ." : </strong> `" . $rating['comment'] . "´</div>";
                  if( ! $is_give ){ 
                    $val .= "<div class='row' style='padding:10px'>
                                  <a href='". new_url('review/giveRating/' .  urlencode(base64_encode( $rating['given_userid'] )) ) ."' >
                                     <button class='btn-lg form-controller  btn-2action width-250'> ". lang("rr.give-rate") ."</button>
                                  </a>    
                             </div>";
                  }      
           	      $val.= "  </div>
           	             </div>";
           	     echo $val;         
           }
    ?> 
    </div>
