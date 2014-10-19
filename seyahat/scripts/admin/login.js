(function($){
     

     $( '#inputLoginEmail').focus();
      
     /*Kullanıcı Giriş işlemi
     ======================================== */
     $( '#buttonLogin' ).on('click',function(){
              var thisID = this,  
                  pass = $( '#inputLoginPassword'), 
                  username = $( '#inputLoginUsername'); 
              var boolValid = true;                   
                  //boolValid = boolValid && EmailKontrol(email, er.invalid_email ); 
                  //boolValid = boolValid && FillKontrol(pass,   er.blank_pass);  
              if(boolValid){  
                   var dataLogin = {   password: pass.val(),
                                       username: username.val()   }; 
                   $.ajax({         
                            type: "POST", 
                            url:  base_url + 'loginProcess', 
                            dataType: "text",  
                            cache:false,
                            data: dataLogin,
                            success: function(result) { 
                                if(      strcmp(enviroment, 'development') == 0 ){ alert( result )             }   
                                var answer = JSON.parse( result );
                                if(      strcmp( answer.status, 'login') == 0   ){ window.location = base_url  } 
                                else if( strcmp( answer.status ,'error') == 0   ){ HataMesaj( answer.message ) }
                                else if( strcmp(answer.status ,'fail') == 0     ){ HataMesaj( answer.text )    }
                                else                                             { HataMesaj(  er.error_send)  } 
                            },
                            error : function()                                   { HataMesaj(  er.error_send)  } 
                     });
              }
              else{  HataMesaj(  er.edit_info)   } 
          return false;
      }); /***** End Kullanıcı giriş işlemi  *************/      

 })(jQuery);            