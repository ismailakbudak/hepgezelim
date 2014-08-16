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
		               max-width: 570px;
		               width: 570px;
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
		.member-desc { background: #E5F3FF;
                       -webkit-border-radius: 3px;
                       -moz-border-radius: 3px;
                       -ms-border-radius: 3px;
                       -o-border-radius: 3px;
                       border-radius: 3px;
                       font-size: 22px;
                       line-height: 33px;
                       margin: 22px 17px 0 0;
                       padding: 18px;
                       position: relative;  }
          

    </style>
    
    <!-- container
    ================================== --> 
    <div class="container">
        <div class="row row-side"> 
	        <div class="col-lg-4">
	           <?php
	                    $this->lang->load('user_sidebar');
	                    $username = $user['name'];
				        $surname = $user['surname'];
				        $date = date('Y');
				        $age =  $date - $user['birthyear'] . lang("sd.age");
				        $alt = $username ." ". $user['surname'] ." ( ". $age  ." )" ;
				        $path = $user['foto'];
				        $lang = $this->lang->lang();

				        $val = link_tag( base_url('styles/side_bar.css') );
				        $val .="<div class='row row-side '>
				                     <div class='well trip-content'>
				                            <fieldset class='content-side'>";
				                                    
				                                          $verifications = array(); 
				                                           
				                                          if( $user['email_check'] ){
				                                                $email = "<div class='row row-side verification'>
				                                                                <i class='col-xs-1 text-primary glyphicon ' style='width: 1em; font-weight:bold;' >@</i> 
				                                                                <div class='col-xs-8 text-verified text-success'> 
				                                                                      ".  lang("sd.email")  ."
				                                                                </div>
				                                                                <i class='col-xs-2 validated'></i> 
				                                                         </div>";
				                                                 $verifications[] = $email;         
				                                          }
				                                          $phone = ""; 
				                                          if( $user['tel_check'] ){               
				                                                 $phone = "<div class='row row-side verification'>
				                                                                  <i class='col-xs-2 text-primary  glyphicon glyphicon-phone '></i> 
				                                                                  <div class='col-xs-8 text-verified text-success'> 
				                                                                       ".  lang("sd.phone")  ."
				                                                                  </div>
				                                                                  <i class='col-xs-2 validated'></i> 
				                                                          </div>";
				                                                  $verifications[] = $phone;
				                                          }
				                                          $face = ""; 
				                                          if( $user['face_check'] ){          
				                                                $face = "<div class='row row-side verification'>
				                                                                  <i class='col-xs-2 text-primary  glyphicon icon-facebook ' style='height: 23px; width:1em; margin-top:5px'></i> 
				                                                                  <div class='col-xs-8 text-verified text-success'> 
				                                                                     ".   $user['friends'] ." ".  lang("sd.friends")   ." 
				                                                                  </div>
				                                                                  <i class='col-xs-2 validated'></i>   
				                                                          </div>";
				                                                $verifications[] = $face;          
				                                           }                
				                                           if( count($verifications) > 0 ){
				                                                $result = "<div class='row row-side verified-title' style='border-top: 0px solid #ccc;' >
				                                                             <div class='row row-side'>
				                                                                  <h4 class='driver-h' > ". lang("sd.verification") ." </h4>
				                                                             </div>"; 
				                                                            foreach ($verifications as $value)
				                                                                 $result .= $value;         
				                                                 $result .="</div>";
				                                                 $val .= $result;  
				                                           }
				                                        

				                             $val .="<div class='row row-side verified-title' >
				                                            <div class='row row-side'>
				                                                 <h4 class='driver-h' >". lang('sd.activity') ."</h4>  
				                                            </div>
				                                            <div class='row row-side'>
				                                                 <a href='#' class='text-primary' >  </a>
				                                            </div> 
				                                          
				                                            <div class='row row-side' style='margin-top:10px'>
				                                                    <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-map-marker two ' ></i>   </div>
				                                                    <div class='col-xs-10 no-padding'>".  $user['offer_count'] . lang('sd.offer') ."</div>
				                                            </div> 
				                                            <div class='row row-side' style='margin-top:10px'>
				                                                    <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-share-alt two ' ></i>   </div>
				                                                    <div class='col-xs-10 no-padding'>".  $user['response_rate']  ." % " . lang('sd.response')  ."</div>
				                                            </div> 
				                                          
				                                            <div class='row row-side' style='margin-top:10px'>
				                                                    <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-time two ' ></i>   </div>
				                                                    <div class='col-xs-10 no-padding'>".  lang('sd.last-online') ." ".  dateConvert3( $user['seen_last'], $lang) ."</div>
				                                            </div> 
				                                            <div class='row row-side' style='margin-top:10px'>
				                                                    <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-log-in two' ></i>  </div>
				                                                    <div class='col-xs-10 no-padding'>".   sprintf( lang('sd.seen_times' ), $user['seen_times'] ) ."</div>
				                                            </div> 
				                                            <div class='row row-side' style='margin-top:10px'>
				                                                    <div class='col-xs-1 no-padding'> <i class='text-primary glyphicon glyphicon-calendar two' ></i>  </div>
				                                                    <div class='col-xs-10 no-padding'>".   lang('sd.member-since') ." ". dateConvert2( $user['created_at'] , $lang )   ."</div>
				                                            </div> 
                                                              
				                                     </div>";

				                                 if( $user['cars'] ){    
				                                    foreach ($user['cars'] as $car) {
				                                 	      $val .="  <div class='row row-side verified-title' >
				                                                        <div class='row row-side'>
				                                                            <h4 class='driver-h' >". lang('u.car') ."</h4>  
				                                                        </div>
				                                                        <div class='row row-side'>
				                                                            <div class='col-lg-5 no'>
				                                                                <img src='". base_url("cars/" .$car['foto_name']) ."' width='100' height='100' class='user-car pic-img'> 
     				                                                        </div>
                                                                            <div class='col-lg-7 no'>
                 				                                                  <div class='row row-side'>
				                                                                        ". lang("u.make") . $car['make']  ." </div>
                                                                                  <div class='row row-side'>
				                                                                      ". lang("u.model")  . $car['model'] ." </div>
                                                                                  <div class='row row-side'>
				                                                                       <span title='" . lang("u.tcomfort".$car['comfort'] ) ."' class='tip rating-car star_".$car['comfort']." '></span> </div>
				                                                                  <div class='row row-side'>
				                                                                     ". $car['colour'] ."</div>     
				                                                            </div>
     				                                                    </div>
     				                                                </div>";
     				                                     break;             
     				                                }               
     				                             }                    
				                     $val.="</fieldset>
				                     </div>  
				                          
				                 </div>";
				                 
				                
				          echo $val;

	           ?>
	        </div>   

	         <div class="col-lg-8 reviews" >
	         	         <div class="row row-side" >
	         	         <?
	         	           $level =  ( strcmp($this->lang->lang(), "tr") == 0 ) ? $user['tr_level'] :  $user['en_level'];
	         	           $val  ="<div class='row row-side '>
				                     <div class='well trip-content'>
				                            <fieldset class='content-side'>
				                                     <div class='row row-side'>
				                                             <div class='row row-side'>
				                                                  <a href='". new_url("contact/complain/" . urlencode(base64_encode($user['id'])) ) ."'> 
					                                                  <i title='". lang("alert") ."' class='text-danger glyphicon glyphicon-flag two' ></i> 
					                                              </a>
				                                              </div>
				                                             <div class='row row-side'>
				                                                <div class='col-xs-3 no-padding'>
				                                                     <a href='". new_url("user/show/" .urlencode( base64_encode($user['id'] ) ) ) ."'> 
				                                                          <img class='pic-img' alt='$alt' title='$alt' src='$path'  width='150' height='180' style='width:150px; height:180px;' >
				                                                     </a>   
				                                                </div>
				                                                <div class='col-xs-9 no-padding' style='font-weight:bold; font-size:18px;'>
				                                                      <div class='row row-side text-primary' style='font-size:25px;' >  $username  $surname</div>
				                                                      <div class='row row-side' style='font-size:18px'>  $age    </div>
				                                                      <div class='row row-side' style='font-size:18px'> ".lang("u.exp") ."{$level}    </div>
				                                                      <div class='row row-side prf-container '> ";                          
				                                                                $test = "rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc '&gt;  &lt;strong class='green'  &gt; TEST &lt;/strong&gt;  TEST &lt;/span&gt;\" data-trigger='hover' data-html='true'"; 
				                                                                $chat  = ($user['like_chat']  != "1") ? ( ($user['like_chat']  == "0" ) ? "no" : "yes") : "" ; 
				                                                                $smoke = ($user['like_pet']   != "1") ? ( ($user['like_pet']   == "0" ) ? "no" : "yes") : "" ;
				                                                                $pet   = ($user['like_smoke'] != "1") ? ( ($user['like_smoke'] == "0" ) ? "no" : "yes") : "" ;
				                                                                $music = ($user['like_music'] != "1") ? ( ($user['like_music'] == "0" ) ? "no" : "yes") : "" ; 
				                                                                if( strcmp("", $chat)  != 0 )
				                                                                   $val .=  "<span  class='tip chat_$chat   ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$chat   ."'&gt;  ".lang("sd.chat-" .$chat )  ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
				                                                                if( strcmp("", $music) != 0 )
				                                                                   $val .=  "<span  class='tip music_$music ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$music  ."'&gt;  ".lang("sd.music-" .$music ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
				                                                                if( strcmp("", $smoke) != 0 )
				                                                                   $val .=  "<span  class='tip smoke_$smoke ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$smoke  ."'&gt;  ".lang("sd.smoke-" .$smoke ) ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";
				                                                                if( strcmp("", $pet  ) != 0 )
				                                                                   $val .=  "<span  class=' tip pet_$pet    ' rel='popover' data-placement='top' data-content=\"&lt;span class='row row-side  popover-desc colour-".$pet    ."'&gt;  ".lang("sd.pet-" .$pet )   ." &lt;/span&gt;\" data-trigger='hover' data-html='true'> </span>";  
				                                                        
				                                        $val .=   " </div>";
                                                                
                                                            $bio =  ( strcmp("", trim( $user['explain']) ) == 0 ) ? "" : lang("u.also") ." : " . $user['explain'];  
				                                            $val .="<div class='row row-side' style='/*font-weight:normal; font-size:14px; */ ' >". $bio ;
				                                            $val .="</div>";
				                                            
				                                              $val .="<div class='row row-side'  >";
				                                                     if( $user['total'] > 0  ){       
				                                                           $val.= "<div style='float:left; '> ". lang("u.rating") ." </div> 
				                                                                  <span class='star-large star-". number_format($user['avg'], 1, '-', '.') ."' style='float:left' title='". number_format($user['avg'], 1, '.', '.')    ." / 5' ></span> 
				                                                                  <div style='float:left; font-weight:bold; font-size:16px; padding:5px '>  ". number_format($user['avg'], 1, '.', '.')  ." / 5 </div> ";
				                                                     }
				                                               $val .="</div>
				                                               </div>
				                                         </div>";
				                                        
				                                       $val.="<div class='row row-side'>  ";
                                                              $description = ( strcmp("", trim( $user['description']) ) == 0  ) ? lang("u.bio") :  $user['description'];
                                                              $val .='<div class="member-desc handwritten">
                                                                       <span class="arrow"></span>
                                                                       <legend  class="text-primary handwritten" >'. lang("u.why") .'</legend>
                                                                       <p class="handwritten" style="font-size:15px;">'. $description .'</p>
                                                                     </div>';
                                                        $val .=" </div>"; 

				                                        $val .="</div>
				                                            </div>";
                                                        
				                               $val .=" </div>";
                                                 echo $val; 
				                    ?>                  
	         	         </div>  
                         <?  $total = count($ratings);  ?>
					     <div class="row row-side" >   
					        <div class="well review" style="padding-bottom:15px">
					              <form class="bs-example form-horizontal">
					                  <fieldset>
					    	              <div class="col-lg-5 rate"> 
					    	              	     <div style="float:left"> <?= sprintf( lang("rr.receive") , $total ) ?> — <?= number_format($avg, 1, '.', '.')  ?> / 5 </div> 
					        	                 <span class='star-large star-<?= number_format($avg, 1, '-', '.') ?>' style="float:left" title='<?= number_format($avg, 1, '.', '.') ?> / 5'  ></span>
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
					                      ?>        
					                        <div class='bs-example'>
					                        	   <div class='col-lg-4 no' style='text-align:right' ><strong>1 <?= lang('r.star') ?></strong> </div>
					                            <div class='col-lg-6 no' >
					                                <div class='progress'>
					                                  <div class='progress-bar' style='width: <?= $per1?>%;'></div>
					                                </div>
					                            </div>    
					                            <div class='col-lg-2 no' style='text-align:left' ><strong> <?= $count1 ?> </strong> </div>
					                        </div>

					                         <div class='bs-example'>
					                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 2 <?= lang('r.star') ?></strong> </div>
					                            <div class='col-lg-6 no' >
					                                <div class='progress'>
					                                  <div class='progress-bar' style='width: <?= $per2 ?>%;'></div>
					                                </div>
					                            </div>    
					                            <div class='col-lg-2 no' style='text-align:left' ><strong> <?= $count2 ?> </strong> </div>
					                        </div>

					                         <div class='bs-example'>
					                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 3 <?= lang('r.star') ?></strong> </div>
					                            <div class='col-lg-6 no' >
					                                <div class='progress'>
					                                  <div class='progress-bar' style='width: <?= $per3 ?>%;'></div>
					                                </div>
					                            </div>    
					                            <div class='col-lg-2 no' style='text-align:left' ><strong> <?= $count3 ?> </strong> </div>
					                        </div>

					                         <div class='bs-example'>
					                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 4 <?= lang('r.star') ?></strong> </div>
					                            <div class='col-lg-6 no' >
					                                <div class='progress'>
					                                  <div class='progress-bar' style='width: <?= $per4 ?>%;'></div>
					                                </div>
					                            </div>    
					                            <div class='col-lg-2 no' style='text-align:left' ><strong> <?= $count4 ?> </strong> </div>
					                        </div>

					                         <div class='bs-example'>
					                        	   <div class='col-lg-4 no' style='text-align:right' ><strong> 5 <?= lang('r.star') ?></strong> </div>
					                            <div class='col-lg-6 no' >
					                                <div class='progress'>
					                                  <div class='progress-bar' style='width: <?= $per5 ?>%;'></div>
					                                </div>
					                            </div>    
					                            <div class='col-lg-2 no' style='text-align:left' ><strong> <?= $count5 ?> </strong> </div>
					                        </div>
					                                    
					    	              </div>
					                                     
					    	          </fieldset>
					    	      </form>        
					    	</div>
					    </div>
					    <br>
					    <?php 		         
					           foreach ($ratings as $rating) {
					           	     $username = $rating['name'];
					                 $date = date('Y');
					                 $age =  $date - $rating['birthyear'] . lang("age");
					                 $alt = $username ." ". $rating['surname'] ." ( ". $age  ." )" ;
					                 $path = $rating['foto'];

					           	     $val = "<div class='row row-side commnet'> 
					           	                 <div class='col-xs-2 msg-photo-container-left'>
					                                    <a href='". new_url("user/show/" .urlencode( base64_encode( $rating['given_userid'] ) ) ) ."'> 
					                                      <img class='tip pic-img' title='$alt' alt='$alt' src='$path' width='60' height='70' style='float:right;  width: 60px; height: 70px' >
					                                    </a>
					                             </div>
					                                
					           	                  <div  class='col-xs-6 msg-comment-sender review'>
					                                   <div class='row row-side'>
					                                      <div class='col-lg-7 rate'>
					                                            <strong class='row row-side'> ". lang("rg.vote") . $rating['rate']." / 5 
					                                               <span class='star-large star-". $rating['rate'] ."' title='".  $rating['rate']  ." / 5' ></span>
					                                            </strong> 
					                                      </div>
					                                      <div class='col-lg-5 date'>". dateConvert3($rating['created_at'], $this->lang->lang() ) . "
					                                           <a href='".new_url("contact/complain/" . urlencode(base64_encode($rating['given_userid'])) )."'> 
					                                               <i title='". lang("alert") ."' class='text-danger glyphicon glyphicon-flag two' ></i> 
					                                           </a>
					                                      </div> 
					                                    </div>
					                                  <div class='row row-side user'> <strong>". lang("rg.giver") ." ". $rating['name'] ." : </strong> `" . $rating['comment'] . "´</div>
					                             </div>
					           	             </div>";
					           	     echo $val;         
					           }
					    ?> 
	         </div>
        </div> 	