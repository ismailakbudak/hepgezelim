    
    <? $this->lang->load('main'); ?>
    <style type="text/css">
      .list-group-item{ text-align: center;   font-size: 35px; font-weight: bold; padding-top: 65px; padding-bottom: 35px; min-height: 200px; }
      .list-group-item.or{ min-height: 40px; padding-top: 10px; padding-bottom: 10px;  border: 1px solid #ddd; }
      .desc{ font-weight: normal; font-size: 18px; }
      .well.works{padding: 3px;}
    </style>
    <!-- container
    ================================== --> 
    <div class="container">
          
    <!--AÇıklama
    ============================================-->   
     <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="container"> <?= lang('w.adres') ?> </h1>
            </div> 
                  <div class="bs-example">
                    <div class="well works"> 
                               <ul class="list-group">
                                   
                                    <li class='list-group-item' >           
                                               <img src="<?= base_url("styles/images/ico.png") ?>" width="100" height="100"  style="width:100px; height:100px; margin-bottom: 50px;"  > 
                                                <?= lang('w.site') ?> hepgezelim.com 
                                                <p class="col-lg-12" style="font-size: 22px;" > <?= lang('g.service') ?> </p> 
                                    </li>

                                    <li class='list-group-item' >           
                                                <i class="text-primary glyphicon glyphicon-user" ></i>
                                                <?= lang('w.signup') ?> 
                                               <div class="desc">     
                                                 <i class="text-warning glyphicon glyphicon-tree-conifer one"></i>   
                                                  <?= lang('w.descSignup') ?> 
                                               </div>
                                    </li>

                                     <li class='list-group-item' >           
                                               <i class="text-primary glyphicon glyphicon-search" ></i>
                                               <?= lang('w.searcho') ?>
                                               <div class="desc">      
                                                  <i class="text-danger glyphicon glyphicon-phone-alt"></i>   
                                                  <?= lang('w.descSearch') ?> 
                                               </div>
                                   
                                    </li>
                                    <li class='list-group-item or' >           
                                               <?= lang('w.or') ?> 
                                    </li>
                                    <li class='list-group-item' >     
                                               <i class="text-primary glyphicon glyphicon-briefcase" ></i>
                                               <?= lang('w.offer') ?>  
                                               <div class="desc">      <i class="text-success glyphicon glyphicon-globe"></i>  
                                                  <?= lang('w.descOffer') ?>
                                               </div>
                                   
                                    </li>

                                     <li class='list-group-item' >     
                                               <i class="text-warning glyphicon glyphicon-road" ></i>
                                                <i class="text-success glyphicon glyphicon-calendar" ></i>
                                               <i class="text-danger glyphicon glyphicon-time" ></i>
                                               <?= lang('w.begin') ?>  
                                               <div class="desc">      <i class="text-danger glyphicon glyphicon-map-marker"></i>  
                                                  <?= lang('w.descBegin') ?>
                                               </div>
                                   
                                    </li>

                                     <li class='list-group-item' >           
                                          <i class="text-primary glyphicon glyphicon-info-sign"></i>
                                          <?= lang("w.purpose") ?>
                                          <p class="text-default" style="font-size:18px" > <?=lang('w.goal')?>  
                                              
                                         </p>
                                         <p class="text-default" style="font-size:18px"  >
                                               <?=lang('w.description1')?> 
                                                <a href="<?= new_url() ."signup" ?>">
                                                   <i class=" glyphicon glyphicon-tree-conifer one"></i><?=lang('w.click')?>
                                                </a> 
                                          </p>
                                          <p class="text-default" style="font-size:18px"  >
                                               <?=lang('w.alreadymember')?>  
                                               <a href="<?= new_url() . "login"?>">
                                                 <i class=" glyphicon glyphicon-log-in one"></i>
                                                 <?=lang('w.click')?>
                                               </a>
                                          </p>    
                                          <p>
                                          	 <img class='tip pic-img'  src='<?= base_url("styles/email/map-1.JPG") ?>' width='350' height='280' style='margin:5px;  width: 345px; height: 280px' >
                                          	 <img class='tip pic-img'  src='<?= base_url("styles/email/map-2.JPG") ?>' width='350' height='280' style='margin:5px;  width: 345px; height: 280px' >
                                          	 <img class='tip pic-img'  src='<?= base_url("styles/email/map-3.JPG") ?>' width='350' height='280' style='margin:5px;  width: 345px; height: 280px' >
                                          </p>  
                                    </li> 
                             </ul>  

                    </div>
                  </div>
          </div>
      </div>
 
   
 
 
