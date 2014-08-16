
<style type="text/css">

.profile-box {
       background: #f1f1e9;
       -webkit-border-radius: 3px;
       -moz-border-radius: 3px;
       -ms-border-radius: 3px;
       -o-border-radius: 3px;
       border-radius: 3px;
       padding: 15px;
}
ul{ padding: 0; margin: 0 0 0px 0px; }
ul.unstyled { margin-left: 0; list-style: none; }
ul {
      display: block;
      list-style-type: disc;
      -webkit-margin-before: 0em;
      -webkit-margin-after: 0em;
      -webkit-margin-start: 0px;
      -webkit-margin-end: 0px;
      -webkit-padding-start: 40px;
}
.prf-container .tip {
     background-color: white;
     -webkit-border-radius: 3px;
     -moz-border-radius: 3px;
     -ms-border-radius: 3px;
     -o-border-radius: 3px;
     border-radius: 3px;
     cursor: pointer;
     display: block;
     height: 54px;
     margin: 0 auto 4px auto;
     width: 54px;
}
li {  }
input[type="radio"]{
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      display: none;
      -webkit-appearance: radio;
      box-sizing: border-box;
      margin: 3px 0.5ex;
      padding: initial;
      background-color: initial;
      border: initial;
      margin: 4px 0 0;
      margin-top: 1px \9;
      line-height: normal;
      cursor: pointer;
      width: auto;
}

 .prf-container .chat-list li, 
 .prf-container .music-list li,
 .prf-container .smoke-list li, 
 .prf-container .pet-list li { text-align: center; }

 .prf-container .chat-list li.tip-label,
 .prf-container .music-list li.tip-label,
 .prf-container .smoke-list li.tip-label, 
 .prf-container .pet-list li.tip-label { text-align: right; } 

 .prf-container .chat-list li.tip-label, 
 .prf-container .music-list li.tip-label,
 .prf-container .smoke-list li.tip-label, 
 .prf-container .pet-list li.tip-label {
        display: block;
        margin: 0 0 0 0;
        padding: 19px 0 0 0;
        text-align: right;
        width: 100px;
 }

 .prf-container .tip.chat_no.active, 
 .prf-container .tip.chat_maybe.active, 
 .prf-container .tip.chat_yes.active,
 .prf-container .tip.music_no.active,
 .prf-container .tip.music_maybe.active,
 .prf-container .tip.music_yes.active, 
 .prf-container .tip.smoke_no.active,
 .prf-container .tip.smoke_maybe.active, 
 .prf-container .tip.smoke_yes.active, 
 .prf-container .tip.pet_no.active, 
 .prf-container .tip.pet_maybe.active,
 .prf-container .tip.pet_yes.active {  border: 2px solid #0ca9fa;  }

  .prf-container .tip.chat_no:hover, 
 .prf-container .tip.chat_maybe:hover, 
 .prf-container .tip.chat_yes:hover,
 .prf-container .tip.music_no:hover,
 .prf-container .tip.music_maybe:hover,
 .prf-container .tip.music_yes:hover, 
 .prf-container .tip.smoke_no:hover,
 .prf-container .tip.smoke_maybe:hover, 
 .prf-container .tip.smoke_yes:hover, 
 .prf-container .tip.pet_no:hover, 
 .prf-container .tip.pet_maybe:hover,
 .prf-container .tip.pet_yes:hover {  border: 2px solid #0ca9fa;  }

 .prf-container .chat-list li, 
 .prf-container .music-list li,
 .prf-container .smoke-list li, 
 .prf-container .pet-list li {
      float: left;
      margin: 0 0 10px 10px;
      text-align: center;
      min-width: 65px;
 }       
</style>


<div class="col-lg-8 well">
     <legend>  <?=lang("pr.title")?>   </legend>
     <form action="<?= new_url().'profil/preference' ?>" method="POST">
               <section class="prf-container clearfix preferences">
                   
                    <ul class="unstyled clearfix chat-list">
                        <li class="tip-label"><label for="chat"> <?=lang("pr.chat")?>  :</label></li>
                        <li>
                            <span title="<?= lang("p.chat-no") ?>" class=" tip chat_no "></span>
                            <input type="radio" name="chat"  value="0">
                        </li>
                        <li>
                            <span class=" tip chat_maybe "></span>
                            <input type="radio" name="chat" value="1" >
                        </li>
                        <li>
                            <span title="<?= lang("p.chat-yes") ?>" class=" tip chat_yes "></span>
                            <input type="radio" name="chat"  value="2">
                        </li>
                    </ul>
                    
                    <ul class="unstyled clearfix music-list">
                        <li class="tip-label"><label for="music"> <?=lang("pr.music")?> :</label></li>
                        <li>
                            <span title="<?= lang("p.music-no") ?>"  class=" tip music_no "></span>
                            <input type="radio" name="music"  value="0">
                        </li>
                        <li>
                            <span class=" tip music_maybe "></span>
                            <input type="radio" name="music" value="1" >
                        </li>
                        <li>
                            <span title="<?= lang("p.music-yes") ?>" class=" tip music_yes "></span>
                            <input type="radio" name="music"  value="2">
                        </li>
                    </ul>

                    <ul class="unstyled clearfix smoke-list">
                        <li class="tip-label"><label for="smoke"> <?=lang("pr.cigarate")?> :</label></li>
                        <li>
                            <span  title="<?= lang("p.smoke-no") ?>" class=" tip smoke_no "></span>
                            <input type="radio" name="smoke"  value="0">
                        </li>
                        <li>
                            <span class=" tip smoke_maybe "></span>
                            <input type="radio" name="smoke" value="1" >
                        </li>
                        <li>
                            <span title="<?= lang("p.smoke-yes") ?>" class=" tip smoke_yes "></span>
                            <input type="radio" name="smoke"  value="2">
                        </li>
                    </ul>


                    <ul class="unstyled clearfix pet-list">
                        <li class="tip-label"><label for="pet"> <?=lang("pr.animal")?>:</label></li>
                        <li>
                            <span  title="<?= lang("p.pet-no") ?>" class=" tip pet_no "></span>
                            <input type="radio" name="pet"  value="0">
                        </li>
                        <li>
                            <span class=" tip pet_maybe "></span>
                            <input type="radio" name="pet" value="1" >
                        </li>
                        <li>
                            <span title="<?= lang("p.pet-yes") ?>" class=" tip pet_yes "></span>
                            <input type="radio" name="pet"  value="2">
                        </li>
                    </ul>

                    <div class="form-group " style="margin-bottom:70px;">
                                  <label style="text-align:right; width:140px; float:left" for="explain" class="tip-label control-label"> <?=lang("in.explain")?> :</label>
                                  <div class="col-lg-8" style="padding:0px; margin-left:15px; " >
                                      <textarea  class="form-control" rows="2" id="inputExplain"  style="max-width: 350px; max-height: 80px;" name="explain" 
                                      placeholder=" <?=lang("pr.pexplain")?> "><?= $preference['explain']  ?></textarea>
                                  </div>
                     </div>

                    <div class="row " style="margin-top:100px; margin-bottom:50px;">   
                         <div class="col-lg-3"></div>
                         <input class="btn btn-primary btn-180" type="submit" value="<?=lang("i.save")?>" />
                    </div>     
                </section>
     </form>
</div>
   <script type="text/javascript">
      var chat=  "<?= $preference['like_chat']  ?>",
          music= "<?= $preference['like_music'] ?>",
          smoke= "<?= $preference['like_smoke'] ?>",
          pet=   "<?= $preference['like_pet']   ?>",
          explain= "<?= $preference['explain']  ?>";      
   </script>
   <script src="<?php echo   base_url() . 'scripts/partial/profil/profil.js' ?>"></script>