    // source application_file/views/profil/
   
    if (typeof chat == 'undefined')
          chat = '0';
    if (typeof music == 'undefined')
          music = '0';
    if (typeof smoke == 'undefined')
          smoke = '0';
    if (typeof pet == 'undefined')
          pet = '0'; 
    if (typeof explain == 'undefined')
          explain = ''; 
    if (typeof email_check == 'undefined')
          email_check = '0';
    if (typeof tel_check == 'undefined')
          tel_check = '0'; 
    if (typeof face_check == 'undefined')
          face_check = ''; 
 
    /********************************  delete.php *********************************************/
        $(function(){
                CapitiliazeFirst(  [ "#inputDescription" ]  );  
                $( '#inputDelete' ).on('click',function(){
                          var desc = $( '#inputDescription');
                          var boolValid = true;                   
                              boolValid = boolValid && FillKontrolParent(desc,er.blank_desc);
                            if ( boolValid ) {
                                 var data = { description: desc.val() },
                                     url = 'update/delete',
                                     result = JSON.parse( AjaxSendJson(url,data) ); 
                                     if( strcmp(result.status ,'success') == 0 ) { window.location = base_url + 'login/logOut' }
                                     else if( strcmp(result.status ,'fail') == 0 )  { HataMesaj( er.error_occurred  ) }
                                     else if( strcmp(result.status ,'error') == 0 ) { HataMesaj( result.message );    } 
                                     else{ HataMesaj( er.error_send ) }  
                          }
                          else
                              HataMesaj(er.edit_info);
                  }); 
        });
    /***************************** End of the delete.php **************************************/

    /********************************  foto.php *********************************************/
    /***************************** End of the foto.php **************************************/

    /********************************  notification.php *********************************************/
            $(function(){
               $( "#inputSave" ).on('click',function(){
                    var new_message = $( "#inputNew_message" ),
                        after_ride  = $( "#inputAfter_ride" ),
                        receive_rate = $( "#inputReceive_rate" ),
                        updates = $( "#inputUpdates" ),
                        data = {   
                        	       new_message: new_message.is(':checked'),
                                   after_ride: after_ride.is(':checked'),
                                   receive_rate: receive_rate.is(':checked'),
                                   updates: updates.is(':checked')
                               },
                         url = 'update/notification',
                         result = JSON.parse( AjaxSendJson(url,data) );   
                         if(      strcmp(result.status ,'success') == 0 ){ BasariMesaj(  er.success_update ) }
                         else if( strcmp(result.status ,'fail') == 0 )   { HataMesaj( er.error_occurred )    }
                         else if( strcmp(result.status ,'error') == 0 )  { HataMes( $('#message') , result.message );    } 
                         else {                                            HataMesaj( er.error_send )        }  
                   
                });
            });
    /***************************** End of the notification.php **************************************/

    /********************************  password.php *********************************************/
            $(function(){
                $( '#inputUpdate' ).on('click',function(){
                      var oldPassword = $( '#inputOldPassword'),
                          newPassword = $( '#inputPassword'), 
                          againPassword = $( '#inputPasswordAgain'); 
                          var boolValid = true;                   
                              boolValid = boolValid && FillKontrolParent(oldPassword,   er.blank_pass);
                              boolValid = boolValid && FillKontrolParent(newPassword,   er.blank_pass);
                              boolValid = boolValid && LengthKontrolParent(newPassword, 6 ,er.pass_length);
                              boolValid = boolValid && MatchKontrolParent(newPassword,againPassword, er.pass_match ); 
                          if ( boolValid ) {
                                 var data = {  old_password: oldPassword.val(),
                                               new_password: newPassword.val()  } ,
                                     url = 'update/password',
                                     result = JSON.parse( AjaxSendJson(url,data) ); 
                                     if( strcmp(result.status ,'success') == 0 ) {     BasariMesaj(er.success_update ) }
                                     else if( strcmp(result.status ,'mistake') == 0 ){ HataMesaj(  er.wrong_old_pass ) }
                                     else if( strcmp(result.status ,'fail') == 0 )   { HataMesaj(  er.error_occurred ) }
                                     else if( strcmp(result.status ,'error') == 0 ) { HataMes( $('#message') , result.message );    }  
                                     else{                                     HataMesaj(  er.error_send     ) } 
                          }
                          else
                              HataMesaj( er.edit_info );
                  });  
            });
    /***************************** End of the password.php **************************************/

    /********************************  preference.php *********************************************/
        $(function(){
          
	           var chats  = $( ".chat-list" ).find("input"),
	               musics = $( ".music-list" ).find("input"),
	               smokes = $( ".smoke-list" ).find("input"),
	               pets   = $( ".pet-list" ).find("input");

	           CapitiliazeFirst(  [ "#inputExplain" ]  );          
	           setPrference(chats,chat);
	           setPrference(musics,music);
	           setPrference(smokes,smoke);
	           setPrference(pets,pet);
	           function setPrference(array, no){
	                    $( array[no] ).parent().find("span").addClass("active");
	                    $( array[no] ).parent().find("input").attr('checked', true);  
	           }

	         $(".preferences .tip").click(function () {
	             $(this).parent().parent().find(".tip").removeClass("active");
	             $(this).parent().find("input").trigger('click');
	             $(this).parent().find("span").addClass("active");
	           
	         });
	    });
    /***************************** End of the preference.php **************************************/

    /********************************  verification.php *********************************************/
        $(function(){
             
             CapitiliazeFirst( [ '#inputEmailKod' ] );
             $( "#inputEmailVerify" ).on('click',function(){
                    var email_kod = $( "#inputEmailKod" );
                     
                    var boolValid = true;
                        boolValid = boolValid && FillKontrolParent(email_kod, er.blank_kod ); 
                        if(boolValid){
                            var data = {   email_kod: email_kod.val() },
                                url = 'update/email_kod',
                                result = JSON.parse( AjaxSendJson(url,data) );   
                                if( strcmp(result.status ,'success') == 0 ) { location.reload(true) }
                                else if( strcmp(result.status ,'mistake') == 0 ) { Hata(email_kod.parent().parent(), result.text )  }
                                else if( strcmp(result.status ,'error') == 0 ) { HataMes( $('#message') , result.message );    }    
                                else if( strcmp(result.status ,'fail') == 0 )  { Hata(email_kod.parent().parent(), er.error_occurred  ) }
                                else{ HataMesaj( er.error_send ) }  
 
                        } 
                        else{
                            HataMesaj( er.edit_info  );
                        }        
             });
             $( "#inputEmailResend" ).on('click',function(){
                      var data = {},
                          url  = 'signup/resendEmail';
                          $( '#sending' ).modal();
                          $.ajax({         
                                    type: "POST", 
                                    url:  base_url + url, 
                                    dataType: "text",  
                                    cache:false,
                                    data: data,
                                    success: function(result) { 
                                          if( strcmp(enviroment, 'development') == 0  )
                                              alert( result );
                                          var answer = JSON.parse( result );     
                                          if( strcmp(answer.status , 'success') == 0 ) { BasariMesaj( er.send_email ) }
                                          else if( strcmp(answer.status , 'fail') == 0 )  { HataMesaj( er.error_occurred ) }
                                          else{ HataMesaj( er.error_send ) } 
                                    },
                                    error : function() {
                                       HataMesaj( er.error_send )
                                    },
                                    complete: function(){
                                         $( '#sending' ).modal('toggle');
                                    } 
                           });
             }); 
             setVerification(".emailVerification" , email_check );
             setVerification(".telVerification" ,   tel_check );
             setVerification(".faceVerification",   face_check );
             function setVerification(name,val){
                  if( strcmp(val,"1") == 0 ){
                                      $( name ).find(".text").addClass('text-success')
                                               .find("i").addClass('validated')
                                      if( strcmp(name, ".faceVerification" ) != 0 ){         
                                         $( name ).find(".btn").prop('disabled', true);
                                         $( name ).find(".form-control ").prop('disabled', true); 
                                      }
                  }
                  else{ 
                            $( name ).find(".text").addClass('text-warning')
                                     .find("i").addClass('not-validated')        
                  }
             }

        });
    /***************************** End of the verification.php **************************************/
 