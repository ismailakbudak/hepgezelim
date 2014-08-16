    
    /**********************  archieve.php  ******************************/ 
      
      (function($){ 
                // gelen mesajlar için
                $( ".delete-messagesInbox" ).on('click',function(){
                      var offer_id      = $(this).parent().data('offer_id'),
                          sender_userid = $(this).parent().data('sender_userid');
                      $("#delete-modal").data().offer_id      = offer_id;
                      $("#delete-modal").data().sender_userid = sender_userid;
                });
                $( "#delete-modal .btn-primary" ).on('click',function(){
                      var offer_id      = $( "#delete-modal" ).data('offer_id'),
                          sender_userid = $( "#delete-modal" ).data('sender_userid');
                      if( strcmp( offer_id , "-1" ) != 0  && strcmp( sender_userid , "-1" ) != 0  ){
                            var data = { offer_id: offer_id , sender_userid:sender_userid },
                                url = 'message/deleteConversationReceiverArchive',
                                result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){ location.reload(true)           } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this), result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this), result.message  )} // show top
                             else                                            { HataMesajModal ( $(this), er.error_send   )} // show bottom alert  
                      }
                      else{  HataMesajModal ( $(this), er.error_occurred) } 
                      return false; 	
                });  
                
                $( ".block-user-inbox" ).on('click',function(){
                      var offer_id      = $(this).parent().data('offer_id'),
                          sender_userid = $(this).parent().data('sender_userid'),
                          name          = $(this).parent().parent().parent().find('.name').text();
                       $("#block-user-modal-inbox").data().offer_id      = offer_id;
                       $("#block-user-modal-inbox").data().sender_userid = sender_userid;
                       $("#block-user-modal-inbox").find(".name").text(name);
                });
                $( "#block-user-modal-inbox .btn-primary" ).on('click',function(){
                      var explain       = $("#inputMessageInbox"),
                          sender_userid = $("#block-user-modal-inbox").data('sender_userid');
                      if( strcmp( sender_userid , "-1" ) != 0  ){
                            var data = { explain: explain.val() , sender_userid:sender_userid },
                                url = 'message/blockUserReceiver',
                                result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){  explain.val("");
                                                                                $( "#block-user-modal-inbox").modal('toggle'); 
                                                                                BasariMesaj    (result.text);             } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this), result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this), result.message  )} // show top
                             else                                            { HataMesajModal ( $(this), er.error_send   )} // show bottom alert  
                      }
                      else{  HataMesajModal( $(this), er.error_occurred) }
                      return false; 
                });   
 

                // gönderilen mesajlar için 
                $( ".delete-messages-sender" ).on('click',function(){
                      var offer_id      = $(this).parent().data('offer_id'),
                          received_userid = $(this).parent().data('received_userid');
                      $("#delete-modal").data().offer_id      = offer_id;
                      $("#delete-modal").data().received_userid = received_userid;
                });
                $( "#delete-modal-sender .btn-primary" ).on('click',function(){
                      var offer_id      = $( "#delete-modal" ).data('offer_id'),
                          received_userid = $( "#delete-modal" ).data('received_userid');
                      if( strcmp( offer_id , "-1" ) != 0  && strcmp( received_userid , "-1" ) != 0  ){
                            var data = { offer_id: offer_id , received_userid:received_userid },
                                url = 'message/deleteConversationSenderArchive',
                                result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){ location.reload(true)           } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this), result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this), result.message  )} // show top
                             else                                            { HataMesajModal ( $(this), er.error_send   )} // show bottom alert  
                      }
                      else{ HataMesajModal ( $(this), er.error_occurred) } 
                      return false;  	
                });              
                $( ".block-user-send" ).on('click',function(){
                      var offer_id        = $(this).parent().data('offer_id'),
                          received_userid = $(this).parent().data('received_userid'),
                          name            = $(this).parent().parent().parent().find('.name').text();
                       $("#block-user-modal-send").data().offer_id        = offer_id;
                       $("#block-user-modal-send").data().received_userid = received_userid;
                       $("#block-user-modal-send").find(".name").text(name);
                });
                $( "#block-user-modal-send .btn-primary" ).on('click',function(){
                      var explain         = $("#inputMessage"),
                          received_userid = $("#block-user-modal-send").data('received_userid');
                      if( strcmp( received_userid , "-1" ) != 0  ){
                            var data = { explain: explain.val() , received_userid:received_userid },
                                url = 'message/blockUserSender',
                                result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){  explain.val("");
                                                                                $( "#block-user-modal-send").modal('toggle'); 
                                                                                BasariMesaj    (result.text);             } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this), result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this), result.message  )} // show top
                             else                                            { HataMesajModal ( $(this), er.error_send   )} // show bottom alert  
                      }
                      else{  HataMesajModal( $(this), er.error_occurred) }
                      return false; 
                });    
         })(jQuery);   
    /******************** End of  the archieve.php **********************/    