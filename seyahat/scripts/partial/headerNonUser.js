 

  (function($){
        
          $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
                  '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                   '<div class="progress progress-striped active">' +
                     '<div class="progress-bar" style="width: 100%;"></div>' +
                   '</div>' +
                 '</div>';
          $.fn.modalmanager.defaults.resize = true;
              

         /*buttonFindRide Click
         ======================================== */
          $( '#buttonFindRide' ).on('click',function(){
                   window.location = base_url + "main";
                   window.scrollTo(0, 100);// move to (x,y)
                   $('#pac-input').focus();               
          });
          
         $( '#captchaReady' ).on('click',function(){
                createCaptcha();   
                $( '#inputCap').val("");
                $( '#inputCap').focus();
        });
         $( "#captchaNew" ).on('click',function(){
            createCaptcha();   
            $( '#inputCap').val("");
            return false;
        });

        // Create captcha method
        function createCaptcha () {
            $.ajax({         
                              type: "POST", 
                              url:  base_url + 'signup/createCaptcha', 
                              dataType: "text",  
                              cache:false,
                              data: {xx: 'test'},
                              success: function(answer) { 
                                    document.getElementById("captchaDiv").innerHTML= answer;  
                              },
                              error : function() {
                                     HataMesaj( 'body' ,'error' , er.error ,er.error_send);
                              },
                              complete: function(){
                              }
                    });
         }   


         /* Kullanıcı Giriş işlemi
         ======================================== */
         $( '#buttonLogin' ).on('click',function(){
         
                 var thisID = this,  
                      pass = $( '#inputLoginPassword'), 
                      email = $( '#inputLoginEmail');
                  var boolValid = true;                   
                      //boolValid = boolValid && EmailKontrol(email,  er.invalid_email );
                      //boolValid = boolValid && FillKontrol(pass,    er.blank_pass);
                  if(boolValid){ 
                       var dataLogin = {   password: pass.val(),
                                           email: email.val()
                                        };
                       $.ajax({         
                                type: "POST", 
                                url:  base_url + 'login/checkLogin', 
                                dataType: "text",  
                                cache:false,
                                data: dataLogin,
                                success: function(result) { 
                                    if(strcmp(enviroment, 'development') == 0){   alert(result); }
                                    var  answer = JSON.parse( result ) ;  
                                    if( strcmp( answer.status , 'login') == 0 ){      location.reload(true); }
                                    else if(  strcmp( answer.status ,'not-active' ) == 0 ){ HataMesajModal( thisID, answer.text ); }
                                    else if(  strcmp( answer.status , 'ban' ) == 0 ){ HataMesajModal( thisID, er.ban ); }
                                    else if( strcmp( answer.status ,'error') == 0 ) { HataMesajModal( thisID, er.wrong_data); }
                                    else if( strcmp(answer.status ,'error2') == 0 ) { HataMesajModal( thisID, answer.message );    }
                                    else{ HataMesajModal(thisID, er.error_send) } 
                                },
                                error : function() {   HataMesajModal( thisID ,'error' ,  er.error ,er.error_send); } 
                         });
                  }
                  else{  HataMesajModal( thisID, 'warning' , er.warning, er.edit_info); }
              return false;
          }); /***** End Kullanıcı giriş işlemi  *************/      
         
         $( '#inputSurname' ).on('change',function(){        
               $(this).val( $(this).val().toUpperCase() );
         });
         $( '#inputName' ).on('change',function(){
                 var string = $(this).val().trim();
                 string = string.charAt(0).toUpperCase() + string.slice(1);
                 $(this).val( string ) ;      
         });


         /*Kullanıcı kayıt işlemi
         ======================================== */
         $( '#inputSignup' ).on('click',function(e){
           
              var thisID = this, 
                  sex = $( '#inputSex'),
                  name = $( '#inputName'), 
                  surname = $( '#inputSurname'), 
                  pass = $( '#inputPassword'), 
                  pass2 = $( '#inputPasswordAgain'),
                  email = $( '#inputEmail'), 
                  birth = $( '#inputBirthYear'),
                  cap   = $( '#inputCap');
                  
                  var boolValid = true;                   
                      boolValid = boolValid && SelectKontrol(sex,      er.sel_sex);
                      //boolValid = boolValid && FillKontrol(name,       er.blank_name  );
                      //boolValid = boolValid && FillKontrol(surname,    er.blank_surname  );
                      //boolValid = boolValid && EmailKontrol(email,     er.invalid_email);            
                      //boolValid = boolValid && FillKontrol(pass,       er.blank_pass);
                      //boolValid = boolValid && LengthKontrol(pass,6,   er.pass_length  );
                      boolValid = boolValid && MatchKontrol(pass,pass2,er.pass_match  );
                      //boolValid = boolValid && SelectKontrol(birth,    er.sel_birth  );
                      //boolValid = boolValid && FillKontrolParent(cap,  er.blank_cap  );
                  
                  if ( boolValid ) {
                         var dataForm = {  sex: sex.val(),
                                           name: name.val(),
                                           surname: surname.val(),
                                           password: pass.val(),
                                           email: email.val(),
                                           birthyear: birth.val(),
                                           captcha: cap.val()      };  
                        $( '#loading' ).modal();
                        $.ajax({         
                           type: "POST", 
                           url:  base_url + 'signup/createUser', 
                           dataType: "text",  
                           cache:false,
                           data: dataForm,
                           success: function(result) { 
                               if( strcmp(enviroment, 'development') == 0){  alert(result); } 
                               var  answer = JSON.parse( result ) ;  
                               if( strcmp(answer.status, 'success') == 0 ){          location.reload(true);  } //window.location = base_url + 'login/?result=1';
                               else if( strcmp(answer.status , 'emailusing') == 0 ){ HataMesajModal( thisID ,  er.email_using); }
                               else if(strcmp( answer.status , 'fail') == 0 ){       HataMesajModal( thisID ,  er.sign_failed); }
                               else if( strcmp (answer.status, 'mistake') == 0 ) {   HataMesajModal( thisID ,  er.wrong_cap); createCaptcha();  cap.val("");  cap.focus(); }
                               else if( strcmp(answer.status ,'error') == 0 ) {      HataMesajModal( thisID ,  answer.message );    }
                               else{                                                 HataMesajModal( thisID ,  er.error_send);  }
                             },
                             error : function() {                                    HataMesajModal( thisID , er.error_send);  },
                             complete: function(){  $('#loading').modal('toggle'); }
                        });      
                  }
                  else{ HataMesajModal( thisID,   er.edit_info); }
                         
              return false; // don't refresh form

          });/***** End Kullanıcı kayıt işlemi  *************/ 


        /** Kontrollerin başlangıcı
        ====================================*///
         function HataMesaj(id, type, title, text){
                 text = jQuery.trim(text);    
                 if(  $(".msgGrowl-container").find(".msgGrowl").length  <= 1 ){    
                        $.msgGrowl ({
                            element: $(id).parent(),
                            type: type,   //$(this).attr ('data-type') // info success warning error
                            title: title,
                            text: text.charAt(0).toUpperCase() + text.slice(1)
                      });
                 }
          }
          function Hata(id, text ) {
             text = jQuery.trim(text);   
             var error = '<div id="alert" class="alert alert-dismissable alert-danger"> '
                         + ' <button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                          +'<strong>Opps.. </strong> ' + text.charAt(0).toUpperCase() + text.slice(1)
                                     +'</div>';
             id.parent().addClass('has-error')
                   .append(error); 
              setTimeout(function() {
                id.parent().removeClass( "has-error", 3000 );
                 id.parent().find('#alert').remove();
               }, 3000 );
        }

        function SelectKontrol(id,mesaj){
            if ( id.val() == "" || id.val() == "0" ) {
                Hata(id.parent(),mesaj);
                return false;
            } 
            else {
                return true;
            }
        }
       function FillKontrol(id,mesaj){
            if ( id.val() == "" || id.val() == "0" ) {
                Hata(id.parent(),mesaj);
                return false;
            } else {
                return true;
            }
        }
        function strcmp ( str1, str2 ) {
              str1 = str1.trim();
              str2 = str2.trim();
              return ( ( str1 == str2 ) ? 0 : ( ( str1 > str2 ) ? 1 : -1 ) );
        } 
        function LengthKontrol(id,length,mesaj){
          if(  id.val().length >= parseInt(length)) { 
                return true;
            } else {
                 Hata(id.parent(),mesaj);
                return false;
            }
        }
        function MatchKontrol(id1,id2,mesaj){
           if(id1.val() == id2.val()){
              return true;
           }
           else{
             Hata(id1.parent(),mesaj);
             Hata(id2.parent(),mesaj);
             return false;
           }

        }
        function EmailKontrol(id, mesaj){
               if(!id.val().match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/)){ 
                   Hata(id.parent(),mesaj);
                   return false;
               }
               else{
                return true;
               }
        }/***** Kontrollerin sonu 
        ==================================****/

       })(jQuery);            
   