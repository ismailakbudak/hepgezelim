     
    <style type="text/css">
        .my legend{ padding: 0px 10px 0px 40px; }
        .btn-default.user-type.active { color: #FFF;  background-color: #2fa4e7; } 
        .btn-default.user-type{ font-weight: 500;  font-size: 17px; }            
        .list-group-item {  border: 1px solid #ddd;  }   
        .levels{ font-weight: bold; font-size: 17px; text-align: center; padding-top: 10px; }
        .list-group .col-lg-2{ padding-right: 0px;  padding-left: 0px;text-align: center; }  
        .list-group-item { display: block; padding: 10px 0px 20px 0px }
        .list-group-item .title, .welcome{ font-weight: bold; padding-top: 20px; font-size: 15px; text-align: right; }  
        .list-group-item .badge{ background-color: #128DFF; }  
        .list-group-item .glyphicon{ font-size: 23px;  }
        .list-group-item .glyphicon-briefcase{  color:  rgba(32, 160, 0, 0.85);  }            
        .list-group-item .glyphicon-calendar{ color:  rgba(155, 0, 0, 0.83); }
        .list-group-item .glyphicon-user{ color: #A0A0A0 }
        .list-group .value i{ margin-bottom: 10px; }
        .list-group .value {font-size: 16px; font-weight: bold;}
    </style>
    <!-- container
    ================================== --> 
    <div class="container"> 

          <div class="row row-side" >
              <div class="col-lg-12 well"  style=" padding: 30px 0px 30px 0px; margin:5px 0px 0px 0px; background-color: #FFFFFF; " > 
                     
                     <div class="row my row-side"   >
                            <div class="col-lg-1" ></div> <!-- NULL -->
                            <div class="col-lg-10" >
                                  <legend> <h2> <?= lang("l.what") ?> </h2> </legend>
                                      <div class="alert alert-dismissable alert-info">
                                          <strong> </strong> <?= lang("l.how") ?> 
                                      </div>  
                            </div> <!-- FULL -->
                            <div class="col-lg-1" ></div> <!-- NULL -->
                     </div>                 
                     
                     <div class="row my row-side"   >
                        <div class="col-lg-1" ></div> <!-- NULL --> 
                        <div class="col-lg-10" > 
                                        <ul class="list-group">
                                                <li class='list-group-item' >
                                                         <div  class="row"  >
                                                                   <fieldset class="levels" >
                                                                      <div class="col-lg-2 title" > 
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <?= lang("l.beginner") ?>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <?= lang("l.intermediate") ?>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <?= lang("l.experienced") ?>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <?= lang("l.expert") ?>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <?= lang("l.ambassador") ?>
                                                                      </div> 
                                                                   </fieldset>
                                                         </div>
                                                </li>
                                                
                                                <li class='list-group-item value' >
                                                        <div  class="row"  > 
                                                               <fieldset title="<?= lang("l.profileComplete") ?>" >
                                                                      <div class="col-lg-2 title" > 
                                                                           <?= lang("l.infoComplete") ?>  <span class="badge"> % 35 </span>
                                                                      </div>
                                                                      <div class="col-lg-2 welcome" > 
                                                                            <?= lang("l.welcome") ?>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="glyphicon glyphicon-user"> </i> 
                                                                            <div>  <span class="badge"> % 45 >   </span>  </div> 
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="glyphicon glyphicon-user"> </i> 
                                                                            <div> <span class="badge">  % 65 > </span>  </div> 
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="glyphicon glyphicon-user"> </i> 
                                                                            <div> <span class="badge"> %70 > </span>  </div> 
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="glyphicon glyphicon-user"> </i> 
                                                                            <div> <span class="badge"> % 80 > </span>  </div> 
                                                                      </div> 
                                                              </fieldset>
                                                        </div>   
                                                </li> 
                                                <li class='list-group-item value' >
                                                         <div  class="row"   >
                                                                   <fieldset title="<?= lang("l.ratingComplete") ?>" >
                                                                      <div class="col-lg-2 title" > 
                                                                           <?= lang("l.ratingCount") ?> <span class="badge"> % 25 </span>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="star-one"></i> 
                                                                            <div> <span class="badge"> 1 </span> <?= lang("l.rating") ?>  </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="star-one"></i>  
                                                                            <div> <span class="badge"> 3 </span>  <?= lang("l.rating") ?>  </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                               <i class="star-one"></i> 
                                                                               <div> <span class="badge"> 6 </span> <?= lang("l.rating") ?>   </div> 
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                            <i class="star-one"></i> 
                                                                            <div> <span class="badge"> 12 </span>  <?= lang("l.rating") ?>  </div>
                                                                      </div>  
                                                                   </fieldset>
                                                         </div>
                                                </li>
                                                <li class='list-group-item value' >
                                                         <div  class="row"   >
                                                                   <fieldset title="<?= lang("l.offerComplete") ?>" >
                                                                      <div class="col-lg-2 title" > 
                                                                           <?= lang("l.offerCount") ?> <span class="badge"> % 20 </span>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                          
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                              <i class="glyphicon glyphicon-briefcase"> </i>  
                                                                              <div> <span class="badge"> 1 </span> <?= lang("l.offer") ?> </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                              <i class="glyphicon glyphicon-briefcase"> </i> 
                                                                               <div> <span class="badge"> 3 </span> <?= lang("l.offer") ?> </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                              <i class="glyphicon glyphicon-briefcase"> </i> 
                                                                               <div> <span class="badge"> 6 </span> <?= lang("l.offer") ?> </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                              <i class="glyphicon glyphicon-briefcase"> </i> 
                                                                               <div> <span class="badge"> 12 </span> <?= lang("l.offer") ?>  </div>
                                                                      </div> 
                                                                   </fieldset>
                                                         </div>
                                                </li>
                                                <li class='list-group-item value' >
                                                         <div  class="row"  >
                                                                    <fieldset title="<?= lang("l.memberComplete") ?>" >
                                                                      <div class="col-lg-2 title" > 
                                                                           <?= lang("l.memberSince") ?> <span class="badge"> % 20 </span>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                             
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                             <i class="glyphicon glyphicon-calendar"> </i> 
                                                                             <div> <span class="badge"> 1 </span>  <?= lang("l.month") ?> </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                             <i class="glyphicon glyphicon-calendar"> </i> 
                                                                             <div> <span class="badge"> 3 </span>  <?= lang("l.month") ?> </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                             <i class="glyphicon glyphicon-calendar"> </i>  
                                                                             <div> <span class="badge"> 6 </span> <?= lang("l.month") ?>  </div>
                                                                      </div>
                                                                      <div class="col-lg-2" > 
                                                                              <i class="glyphicon glyphicon-calendar"> </i> 
                                                                              <div> <span class="badge"> 12 </span> <?= lang("l.month") ?> </div>
                                                                      </div> 
                                                                   </fieldset>
                                                         </div>
                                                </li>
                                          
                                           </ul>    
                                 
                        </div>   <!-- FULL -->        
                        <div class="col-lg-1" ></div>  <!-- NULL -->
                     </div>
              </div>
        

 
