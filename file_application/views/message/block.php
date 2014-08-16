     <style type="text/css">
                .one-thread { display: block;
                              color: #666 !important;
                              padding: 0px 0px;
                              cursor: pointer;
                              margin: 4px;
                              background-color:  #eee; }
                .msg{   padding: 10px; text-align: center;}
                .block{        border-color: #eee; 
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
                .block:hover{  border-color: #FFFFFF;
                                 -moz-box-shadow: 0px 0px 14px #3195F3;
                                 -webkit-box-shadow: 0px 0px 0px #9AA7B4;
                                 box-shadow: 0px 0px 11px #3FD2FF;    }
                .list-group-item {   position: relative;
                                     display: block;
                                     padding: 0px 0px;
                                     margin-bottom: -1px;
                                     background-color:  #eee; 
                                     border-width: 5px; 
                                     border-radius: 7px;
                                     border: 1px solid #ddd;  }
                .badge{ background-color: #E65300; }
                .msg .glyphicon{font-size: 25px; margin: 5px;}
     </style>

        <div class="row">
          <div class="col-lg-12">
            <div class="bs-example">
                <ul class="list-group">
                    <?php
                         $block_number = 0;
                         foreach ($blocks as $block) {
                             $block_number++;
                             $val="<li class='list-group-item block' >
                                     	<div class='row one-thread' data-block_id='". $this->encrypt->encode($block['block_id']) ."'  >
                                             <div class='col-lg-3 msg-who'>
                                                                <div class='col-lg-3' style='text-align: center;'>
                                                                     <img class='tip pic-img' src='".$block['foto']."' style='width: 50px; height: 60px' height='60' width='50'>
                                                                </div>
                                                                <div class='col-lg-9 name' style='text-align: center; padding-top:20px'>
                                                                    ".$block['name'] . " " .$block['surname'] ."
                                                                </div>    
                                             </div>
                                             <div class='col-lg-6 msg'>
                                                      ". lang('m.block-ex')  . $block['explain'] ."
                                             </div>
                                             <div class='col-lg-3 msg'>
                                                  <div class='col-lg-10'>
                                                      ".  tr(date_format(date_create(  $block['created_at']  ), ' l jS F Y H:i'), $this->lang->lang() ) ."
                                                   </div>
                                                   <div class='col-lg-1' data-block_id='". $this->encrypt->encode($block['block_id']) ."' > 
                                                          <a href='#' class='delete-block'  >
                                                               <i title='". lang("remove") ."' class='text-danger glyphicon glyphicon-remove' ></i> 
                                                           </a>
                                                   </div>
                                             </div>
                                        </div>                    
                                    </li>";
                         	  echo  $val;
                         }
                         if( count($blocks) == 0 ){
                              echo " <div class='bs-example'>
                                         <div class='alert alert-dismissable alert-info'>
                                              <button type='button' class='close' data-dismiss='alert' title='". lang('close') ."' >&times;</button>
                                              <h4> ". lang("m.empty-block") ." <a href='". new_url('message/block') ."' style='margin:10px' title='". lang('refresh') ."' ><i class='glyphicon glyphicon-refresh'></i> </a> </h4>
                                         </div>
                                     </div>";
                         }                           
                    ?>            
                </ul>
            </div>
          </div>
        </div> 
       <script src="<?php echo   base_url() . 'scripts/partial/messages/block.js' ?>"></script> 
 