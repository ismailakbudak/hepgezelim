    <style type="text/css" >
               .tabs-left{ border-bottom: none; padding-top: 2px; min-width: 110px; }
               .tabs-left { border-right: 1px solid #ddd; }
               .tabs-left>li  { float: none; margin-bottom: 2px;}
               .tabs-left>li {  margin-right: -1px;  }
               .tabs-left>li.active>a, .tabs-left>li.active>a:hover, .tabs-left>li.active>a:focus { border-bottom-color: #ddd; border-right-color: transparent;}
               .tabs-left>li>a { border-radius: 4px 0 0 4px; margin-right: 0; display:block; }
               .active>a {background-color: #A4EDF0; } /* Add !important */
               .nav>li>a:hover, .nav>li>a:focus { background-color: #A4EDF0 ; }
               /* for button set */
               .set       { color: #2fa4e7; border-width: 1px;}
               .set.active{ background-color:  #D3F5FF; }
               /*.set       {color: #000; background: #ffeb00 none; cursor: pointer;}*/
               .set:hover { background-color:  #D3F5FF; !important; border-width: 1px; }
              
               .btn-group-justified { padding-bottom: 20px;  }

               .btn { text-shadow: 0 0 0  }
               .shadow{   padding: 20px 6px  20px 6px  ;
                          border-color: #221C1C; border-width: 5px; border-radius: 7px;
                          -moz-box-shadow: 0px 0px 14px #3195F3;
                          -webkit-box-shadow: 0px 0px 14px #3195F3;
                          box-shadow: 0px 0px 14px #2B302C;
                          -webkit-transition: 0.5s ease-in-out all;
                          -moz-transition: 0.5s ease-in-out all;
                          -ms-transition: 0.5s ease-in-out all;
                          -o-transition: 0.5s ease-in-out all;
                          transition: 0.5s ease-in-out all;
                }
               .shadow:hover {
                          border-color: #7DD7EE;
                          -moz-box-shadow: 0px 0px 14px #3195F3;
                          -webkit-box-shadow: 0px 0px 14px #3195F3;
                          box-shadow: 0px 0px 14px #878B12;;
               }
    
   </style>  


    <div  class="container" >
    <!-- container Begin        PROFILE PROFILES file
    =================================================================== -->  
          <div  class="row ">
                <div class="col-lg-12 ">
                <hr />
                <div class="bs-example">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                         <li id="dashroad" ><a href="<?php echo new_url().'profil'  ?>" ><i class="text-success glyphicon glyphicon-dashboard two"></i>  <?=lang('g.dashboard')?> </a></li>
                         <li id="allerts"  ><a href="<?php echo new_url().'alert'  ?>" ><i class="text-danger  glyphicon glyphicon-bell two"></i>  <?=lang('g.alerts')?>    </a></li>
                         <li id="profile"  ><a href="<?php echo new_url().'profil/profile/info '  ?>" ><i class="text-primary glyphicon glyphicon-user two"></i><?=lang('g.profil')?>          </a></li>
                         <li id="messages" ><a href="<?php echo new_url().'message'  ?>" ><i class="text-warning glyphicon glyphicon-comment two"></i><?=lang('g.messages')?>    </a></li>
                         <li id="reviews"  ><a href="<?php echo new_url().'review'  ?>" ><i class="text-danger  glyphicon glyphicon-star two"></i><?=lang('g.reviews')?>         </a></li>
                         <li id="offers"   ><a href="<?php echo new_url().'offer'  ?>" ><i class="text-info    glyphicon glyphicon-briefcase two"></i><?=lang('g.offers')?>    </a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content ">
                      

