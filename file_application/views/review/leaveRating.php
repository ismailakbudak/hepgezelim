
     <style type="text/css">
               .reviews{ border: 1px solid #DDD;
                         border-radius: 3px;
                         padding:20px;
                         margin-top: 10px; }
                .form-control{ margin: 5px; }
                .one-thread { display: block;
                              color: #666 !important;
                              padding: 0px 0px;
                              cursor: pointer;
                              margin: 4px;
                              background-color:  #fff; }
                .msg{   padding: 10px; text-align: center;}
                .message{        border-color: #eee; 
                	               border-width: 5px; 
                	               border-radius: 10px;
                                -webkit-transition: 0.5s ease-in-out all;
                                -moz-transition: 0.5s ease-in-out all;
                                -ms-transition: 0.5s ease-in-out all;
                                -o-transition: 0.5s ease-in-out all;
                                 transition: 0.5s ease-in-out all;
                                 font-weight: bold;
                                 font-size: 14px;
                                 margin-top: 5px;  }
                .message:hover{  border-color: #FFFFFF;
                                 -moz-box-shadow: 0px 0px 14px #3195F3;
                                 -webkit-box-shadow: 0px 0px 0px #9AA7B4;
                                 box-shadow: 0px 0px 11px #3FD2FF;    }
                .list-group-item {   position: relative;
                                     display: block;
                                     float: left;
                                     width: 200px; 
                                     height: 100px; 
                                     margin: 5px 5px;
                                     margin-bottom: -1px;
                                     background-color:  #fff; 
                                     border-width: 5px; 
                                     border-radius: 7px;
                                     border: 1px solid #ddd;  }
                .age{ font-size: 10px; color: rgb(245, 130, 130); }                     

     </style>

<div class="row ">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="well" style="padding-bottom:30px" >
                    <legend> <?= lang("rl.rating") ?> </legend>
                    <h4> <?= lang("rl.name-e") ?>  </h4>
                    <div class="bs-example form-horizontal">
                       <fieldset>
                           <div class="form-group">
                                 <label for="inputName" class="col-lg-2 control-label"> <?= lang("rl.name") ?> </label>
                                 <div class="col-lg-5">
                                   <input type="text" class="form-control" id="inputName" placeholder="<?= lang("rl.namep") ?>">
                                 </div>
                                 <div class="col-lg-5">
                                     <button  id="buttonWithName" type="button" class="form-control btn btn-primary width-200" > <?= lang("rl.find") ?></button>
                                 </div>                     
                            </div>
                       </fieldset>
                    </div> 
                    <h4> <?= lang("rl.phone") ?>  </h4>
                    <div class="bs-example form-horizontal">
                       <fieldset>
                           <div class="form-group">
                                 <label for="inputTel" class="col-lg-2 control-label"> <?= lang("rl.tel") ?> </label>
                                 <div class="col-lg-5">
                                   <input type="text" class="form-control" id="inputTel" placeholder="<?= lang("rl.telp") ?>">
                                 </div>
                                 <div class="col-lg-5">
                                     <button  id="buttonWithTel" type="button" class="form-control btn btn-primary width-200" > <?= lang("rl.find") ?></button>
                                 </div>                     
                            </div>
                       </fieldset>
                    </div> 
            
                   <div class="row">
                         <div class="col-lg-12">
                           <div class="bs-example">
                               <div  id="result" class="list-group"> 

                               </div>
                           </div>
                         </div>
                    </div>  
                    <div  id="loader" class="row" style="text-align:center; padding:10px" > 

                    </div>

                    <div class="row review-msg " >
                    	<p style="padding-left:30px; color: #000; " > <?= lang("rl.info") ?> <a href="<?= new_url("message")?>"> <?= lang("rl.click") ?>  </a> </p>
                    </div>   

            </div><!-- End of the well class div -->
     </div> <!-- End of the col-lg-8 class div -->     
     <div class="col-lg-2"></div>
        
  </div><!-- End of the row class div -->
  <script type="text/javascript">  var invalid_tel = '<?= lang("rl.invalid-tel") ?>', loader = " <img src='<?= base_url() ?>/styles/images/loading2.gif' width='35' height='35' > <?= lang('loading')  ?> ";  </script>
  <script src="<?php  echo  base_url() . 'scripts/partial/review/leaveRating.js'  ?>"></script> 