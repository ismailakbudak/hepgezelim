    
    /**********************  inbox.php  *********************************/
        (function($){
              
                 $( ".delete-meessages" ).on('click',function(){
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
                                url = 'message/deleteConversationReceiver',
                                result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){ location.reload(true)           } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this),  result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this),  result.message  )} // show top
                             else                                            { HataMesajModal ( $(this),  er.error_send   )} // show bottom alert  
                      }
                      else{  HataMesajModal ( $(this),  er.error_occurred) }
                      return false; 
                });  
                $( ".archieve-messages" ).on('click',function(){
                        var offer_id      = $(this).parent().data('offer_id'),
                            sender_userid = $(this).parent().data('sender_userid');
                            data = { offer_id: offer_id , sender_userid:sender_userid },
                            url = 'message/archieveConversationReceiver',
                            result = JSON.parse( AjaxSendJson(url,data) );  
                        if     ( strcmp(result.status ,'success') == 0 ){ window.location = base_url + "message/archieve" } // show bottom alert 
                        else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   (  result.text     )} // show bottom alert
                        else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   (  result.message  )} // show top
                        else                                            { HataMesaj   (  er.error_send   )} // show bottom alert  
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
                      var explain       = $("#inputMessage"),
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

         })(jQuery); 
    /******************** End of  the inbox.php *************************/  