  
  /**********************  contentSent.php  *********************************/
        (function($){
                 
                  $( ".delete-meessages" ).on('click',function(){
                        var offer_id      = $(this).parent().data('offer_id'),
                            received_userid = $(this).parent().data('received_userid');
                        $("#delete-modal").data().offer_id      = offer_id;
                        $("#delete-modal").data().received_userid = received_userid;
                  });
                  $( "#delete-modal .btn-primary" ).on('click',function(){
                        var offer_id      = $( "#delete-modal" ).data('offer_id'),
                            received_userid = $( "#delete-modal" ).data('received_userid');
                        if( strcmp( offer_id , "-1" ) != 0  && strcmp( received_userid , "-1" ) != 0  ){
                              var data = { offer_id: offer_id , received_userid:received_userid },
                                  url = 'message/deleteConversationSender',
                                  result = JSON.parse( AjaxSendJson(url,data) );  
                               if     ( strcmp(result.status ,'success') == 0 ){ window.location = base_url + "message/send"         } // show bottom alert 
                               else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this), result.text     )} // show bottom alert
                               else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this), result.message  )} // show top
                               else                                            { HataMesajModal ( $(this), er.error_send   )} // show bottom alert  
                        }
                        else{  HataMesajModal ( $(this), er.error_occurred) } 
                        return false;   
                  });  
                  $( ".archieve-messages" ).on('click',function(){
                          var offer_id      = $(this).parent().data('offer_id'),
                              received_userid = $(this).parent().data('received_userid');
                              data = { offer_id: offer_id , received_userid:received_userid },
                              url = 'message/archieveConversationSender',
                              result = JSON.parse( AjaxSendJson(url,data) );  
                          if     ( strcmp(result.status ,'success') == 0 ){ window.location = base_url + "message/archieve" } // show bottom alert 
                          else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   (  result.text     )} // show bottom alert
                          else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   (  result.message  )} // show top
                          else                                            { HataMesaj   (  er.error_send   )} // show bottom alert  
                          return false; 
                  });
                  $( ".block-user-send" ).on('click',function(){
                        var offer_id        = $(this).parent().data('offer_id'),
                            received_userid = $(this).parent().data('received_userid'),
                            name            = $(this).parent().data('name');
                         $("#block-user-modal-send").data().offer_id        = offer_id;
                         $("#block-user-modal-send").data().received_userid = received_userid;
                         $("#block-user-modal-send").find(".name").text(name);
                  });
                  $( "#block-user-modal-send .btn-primary" ).on('click',function(){
                        var explain         = $("#inputMessageBlockSent"),
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

   

                  $( "#send-message-send" ).on("click",function(){
                          var message  = $('#inputMessage'),
                              received_userid  = $(this).data('received_userid'),
                              offer_id = $(this).data('offer_id'),
                              data = { received_userid: received_userid, message:message.val(), offer_id: offer_id },
                              url = 'message/sendMessageFromSend';
                             // $( "#sending" ).modal();
                              $.ajax({         
                                    type: "POST", 
                                    url:  base_url + url, 
                                    dataType: "text",  
                                    cache:false,
                                    data: data,
                                    success: function(answer) { 
                                       if( strcmp(enviroment, 'development') == 0  )
                                              alert( answer ); 

                                       var result = JSON.parse( answer );  
                                       if     ( strcmp(result.status ,'success' ) == 0 ){ location.reload(true)       } 
                                       else if( strcmp(result.status ,'mistake' ) == 0 ){  HataMesaj( result.text     )} // show bottom alert
                                       else if( strcmp(result.status ,'fail'    ) == 0 ){  HataMesaj( result.text     )} // show bottom alert
                                       else if( strcmp(result.status ,'error'   ) == 0 ){  HataMesaj( result.message  )} // show top
                                       else                                             {  HataMesaj( er.error_send   )} // show bottom alert  
                                    },
                                    error : function() {
                                        HataMesaj( er.error_send );
                                    },
                                    complete: function(){
                                      //   $( '#sending' ).modal('toggle');
                                    } 
                           });

                          return false;
                  });
                  $( ".alert-moderator-send" ).on('click',function(event){
                        event.preventDefault();
                        var offer_id      = $( "#data" ).data('offer_id'),
                            received_userid = $( "#data" ).data('received_userid'),
                            message_id    = $( this ).data('message_id'),
                            data = { offer_id: offer_id , received_userid:received_userid, message_id:message_id },
                            url = 'message/alertUserSender';
                            result = JSON.parse( AjaxSendJson(url,data) );  
                        if     ( strcmp(result.status ,'success') == 0 ){ BasariMesaj ( result.text)     } // show bottom alert 
                        else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   ( result.text     )} // show bottom alert
                        else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   ( result.message  )} // show top
                        else                                            { HataMesaj   ( er.error_send   )} // show bottom alert  
                        return false;     
                  });
           })(jQuery);     
    /******************** End of  the contentSent.php *************************/  