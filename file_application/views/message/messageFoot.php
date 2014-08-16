 <!-- Tab panes -->
                


    </div>

    <!-- Modal Sending
    =====================================================-->
    <div id="sending" class="modal fade" style=" border-radius: 16px;" tabindex="-1" data-width="400" data-height="150" data-backdrop="static"  style="display: none;">
        <div class="well" style=" border-radius: 16px; margin-bottom: 0px !important; margin-right: 0px; margin-left: 0px; ">
                             <fieldset style="font-size:20px; padding-bottom:10px; padding-left: 40px; ">
                                  <div class="row">
                                        <?=lang("m.sending")?>
                                       <img src="<?= base_url() ?>/styles/images/loading2.gif" width="35" height="35" >
                                     </div>
                                     <div class="row">
                                      <strong class="text-primary"> <?=lang("g.wait")?></strong>
                                     </div>
                             </fieldset>
        </div>  
    </div><!-- END of the Modal Sending -->
   <script type="text/javascript" > var active_message = '<?= $active_side ?>'; var message_number2 = '<?= $unreadSent ?>';var message_number = '<?= $unreadInbox ?>'; </script>
   <script src="<?php echo   base_url() . 'scripts/partial/messages/messageFoot.js' ?>"></script>
   