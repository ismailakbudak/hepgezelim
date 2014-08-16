//////////////////////////////////////////////////
/*************************************************
**************************************************
**    
**    DEVELOPER : ismail AKBUDAK  WEB & MOBIL DEVELOPER
**
**    CONTACT   :  www.ismailakbudak.com 
**    LINKEDIN  : http://www.linkedin.com/pub/ismail-akbudak/56/a57/40b
**    FACEBOOK  : https://www.facebook.com/isoakbudak
**    TWITTER   : https://twitter.com/isoakbudak
**    GOOGLE+   : https://plus.google.com/u/0/100985583645011477288/posts
**    
 
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////

          /***** Henüz kullanılmayanlar
          ==================================****/         
          // jQuery Begin
 
            
            $(function(){

                $('[rel=popover]').popover();

                // üzerine geldiğinde numarasını göstermeyi sağlamak için
                $( "#page" ).on("mouseover" ,"a" ,function(){
                     var no = $(this).data('no');
                     if($(this).text(no) == "."){
                         $(this).text(no);
                     }
                }).on("mouseleave","a",function(){
                       if($(this).hasClass("nokta")){
                           $(this).text(".");  
                       }
                });
                 
                $( ".apply-btn-loader" ).on('click',function(){
                       var id = $( this ).find(".img-loader");
                       id.removeClass("hide"); 
                       setTimeout( function(){
                           id.addClass("hide");
                        }, 500);  
                });
                // for footer
                $('[data-toggle="tooltip"]').tooltip({
                    trigger: 'hover',
                    'placement': 'top'
                });
                $( ".clean-report" ).on('click',function(){
                          $( "#textAreaReport" ).val("");
                          $( "#inputReportEmail" ).val("");
                });
                CapitiliazeFirst(  [ "#textAreaReport"  ]  );
                $( "#buttonSendReport" ).on('click',function(){
                        var problem = $( "#textAreaReport" ).val();
                        var email   = $( "#inputReportEmail" ).val();
                        var data = { problem: problem , email:email },
                           url = 'application/problem',
                           result = JSON.parse( AjaxSendJson(url,data) );  
                        if     ( strcmp(result.status ,'success') == 0 ){  $( "#textAreaReport" ).val("");
                                                                           $( "#inputReportEmail" ).val("");
                                                                           $( "#report-problem" ).modal('toggle');   
                                                                           BasariMesaj( result.text );                } // show bottom alert 
                        else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( $(this),  result.text      )                 } // show bottom alert
                        else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( $(this),  result.message   )                 } // show top
                        else                                            { HataMesajModal ( $(this),  er.error_send    )                 } // show bottom alert  
                });
 

                  //<span class="img-loader hide"></span>    apply-btn-loader 
                  //window.scrollTo(0, 100);// move to (x,y)
    
            });// jQuery end

            

            
/*
            // Jquery ile uyarı
            function myClicktop(id, text, title) {
               $(document).ready(function () {
                    $(id).dialog({
                        modal: true,
                        show: 'bounce',  
                        hide: 'highlight',
                        height: 150,
                        width:250,
                        speed: '4000',
                        title:  title,
                        draggable: false
                    }).text(text);
                    $(id).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
                   
                    setTimeout(function () {
                        $(id).dialog("close")
                    }, 2000);
                });
            }
            
            // Jquery ile uyarı
            function myClick(id, text, title) {
               $(document).ready(function () {
                    $(id).dialog({
                        modal: true,
                         // titreşim verir  show: 'bounce',  
                        hide: 'fade',
                        height: 150,
                        width:250,
                        speed: 'slow',
                        title:  title,
                        position: { my: "center top", 
                                    at: "center top",
                                    of: "#main" },
                        draggable: false
                    }).text(text);
                    $(id).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
                   
                    setTimeout(function () {
                        $(id).dialog("close")
                    }, 2000);
                });
            }
            
            // JQuery ile bilgi  
            function my (id, text, title) {
              $(document).ready(
                function() {
                   $(id).dialog({
                        modal: true,
                        show: 'slide',   // titreşim verir  //slide  //highlight  //bounce  // fade
                        hide: 'slide',
                        height: 170,
                        width:370,
                        speed: 'slow',
                        title:  title,
                        draggable: false
                    
                    }).text(text);
                    // üstteki close butonunu kaldırrı
                   $(id).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
                    
                    setTimeout(function () {
                        $(id).dialog("close")
                    }, 3000);
                });
          }
*/


        // capitialize first letter of array
        function CapitiliazeFirst( array  ){
               $.each(array, function(index, value){
                     $( value ).on('keyup',function(){
                             var text = $( this ).val();
                             if(  strcmp(  text.charAt(0), " " ) == 0 )    
                                 text = jQuery.trim( text );
                             $( this ).val( text.charAt(0).toUpperCase() + text.slice(1) );
                     });
               });   
        }

       /********************** Message functions ************************************************
       | 
       |   Prototype for messages
       |   
       |   Basari(id, text )           // id top  success message
       |   HataMes(id, text )          // id top  error   message  
       |   HataMesaj( text)            // body right bottom  alert-error message            
       |   HataMesajModal(id, text)    // modal right bottom  alert-error message
       |   BasariMesaj( text)          // body right bottom  alert-success message 
       |   Hata(id, text )             // form controller add  parent to has-error message
       |   SuccessShow( text )         // $( "#message" ) top  success message
       |   ErrorShow( text )           // $( "#message" ) top  error   message    
       |
       |
       |
       |
       =======================================================================================***/ 

          /**  For Messages
          =============================================*/  
           // For $("#message") success message
          function SuccessShow( text ) {
                   text = jQuery.trim(text);   
                   var id  = $("#message"), 
                       dil = "Tebrikler !";
                   if( strcmp( er.lang, "en" ) == 0 )
                          dil = "Congratulations !";
                   var success = '<div id="alert" class="alert alert-dismissable alert-success"> '
                                      + '<button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                      + '<strong>'+  dil  +' </strong> ' + text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                                 +'</div>';
                   id.addClass('has-success')
                       .append(success);
                   setTimeout(function() {
                       id.removeClass( "has-success", 3000 );
                          id.find('#alert').remove();
                   }, 7000 ); 
                   
                   $('body').animate({
                          scrollTop:  0
                   }, 600);

          }
          // For $("#message") error message
          function ErrorShow( text ) {
                   text = jQuery.trim(text);   
                   var id  = $("#message"), 
                       dil = "Hata !";
                   if( strcmp( er.lang, "en" ) == 0 )
                          dil = "Error !";
                   var danger = '<div id="alert" class="alert alert-dismissable alert-danger"> '
                                          + ' <button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                          + '<strong>'+  dil  +' </strong> ' + text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                               +'</div>';
                   id.addClass('has-danger')
                       .append(danger); 
                   setTimeout(function() {
                      id.removeClass( "has-error", 3000 );
                         id.find('#alert').remove();
                   }, 7000 );
                   $('body').animate({
                          scrollTop:  0
                   }, 600);
          }
          // For $("#message") success message
          function Basari(id, text ) {
                   text = jQuery.trim(text);   
                   var dil = "Tebrikler !";
                   if( strcmp( er.lang, "en" ) == 0 )
                          dil = "Congratulations !";
                   var success = '<div id="alert" class="alert alert-dismissable alert-success"> '
                                      + '<button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                      + '<strong>'+  dil  +' </strong> ' + text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                                 +'</div>';
                   id.addClass('has-success')
                       .append(success);
                   setTimeout(function() {
                       id.removeClass( "has-success", 3000 );
                          id.find('#alert').remove();
                   }, 7000 );
                   
          }
          // For $("#message") error message
          function HataMes(id, text ) {
                   text = jQuery.trim(text);   
                   var dil = "Hata !";
                   if( strcmp( er.lang, "en" ) == 0 )
                          dil = "Error !";
                   var danger = '<div id="alert" class="alert alert-dismissable alert-danger"> '
                                          + ' <button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                          + '<strong>'+  dil  +' </strong> ' + text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                               +'</div>';
                   id.addClass('has-danger')
                       .append(danger); 
                   setTimeout(function() {
                      id.removeClass( "has-error", 3000 );
                         id.find('#alert').remove();
                   }, 7000 );
          }
          // Right bottom alert-error message  
          function HataMesaj( text){
                   text = jQuery.trim(text);    
                   var dil = "Hata !";
                   if( strcmp( er.lang, "en" ) == 0 )
                         dil = "Error !";
                   if(  $(".msgGrowl-container").find(".msgGrowl").length  <= 1 ){    
                        $.msgGrowl ({
                            element: $('body').parent(),
                            type:  'error',   //$(this).attr ('data-type') // info success warning error
                            title: dil,
                            text: text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                        });
                   }
          }

          // Right bottom alert-error message for modal
          function HataMesajModal(id, text){
                   text = jQuery.trim(text);   
                   var dil = "Hata !";
                   if( strcmp( er.lang, "en" ) == 0 )
                        dil = "Error !";
                   if(  $(".msgGrowl-container").find(".msgGrowl").length  <= 1 ){    
                        $.msgGrowl ({
                            element: $(id).parent().parent(),
                            type:  'error',   //$(this).attr ('data-type') // info success warning error
                            title: dil,
                            text: text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                        });
                   }
          }
          // Right bottom alert-success message
          function BasariMesaj( text){
                   text = jQuery.trim(text);   
                   var dil = "Tebrikler !";
                   if( strcmp( er.lang, "en" ) == 0 )
                         dil = "Congratulations !";
                   if(  $(".msgGrowl-container").find(".msgGrowl").length  <= 1 ){  
                         $.msgGrowl ({
                             element: $('body').parent(),
                             type:  'success',   //$(this).attr ('data-type') // info success warning error
                             title: dil,
                             text: text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                         });
                   }
          }
       
           // for form control element error message
          function Hata(id, text ) {
                   text = jQuery.trim(text);               
                   var error = '<div id="alert" class="alert alert-dismissable alert-danger"> '
                                     + ' <button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                     + ' <strong>Opps.. </strong> ' + text.charAt(0).toUpperCase() + text.slice(1) // capitialize first character
                              +'</div>';
                   id.parent().addClass('has-error')
                         .append(error); 
                   setTimeout(function() {
                      id.parent().removeClass( "has-error", 3000 );
                       id.parent().find('#alert').remove();
                   },  3000 );

          }/***** End of the message alert methods 
          ==================================****/

          /**  For tooltip
          =============================================*/ 
          $( document ).tooltip({
                   position: {
                       my: "center bottom-20",
                       at: "center top",
                       using: function( position, feedback ) {
                             $( this ).css( position );
                             $( "<div>" )
                               .addClass( "arrow" )
                               .addClass( feedback.vertical )
                               .addClass( feedback.horizontal )
                               .appendTo( this );
                       }
                   }
          });
          

           /** Ajax  send post data functions
          ====================================*///
           function AjaxSendJson(url, data){
              var jqXHR = $.ajax({         
                                    type: "POST", 
                                    url:  base_url + url, 
                                    dataType: "json",  
                                    async: false,
                                    cache:false,
                                    data: data,
                                    success: function(answer) { 
                                    
                                    },
                                    error : function() {
                                      
                                    } 
                     });
               if( strcmp(enviroment, 'development') == 0  )
                    alert(jqXHR.responseText );
                  
               return jqXHR.responseText;
          } 
          function AjaxSend(url, data){
            
               var jqXHR = $.ajax({         
                                    type: "POST", 
                                    url:  base_url + url, 
                                    dataType: "text",  
                                    async: false,
                                    cache:false,
                                    data: data,
                                    success: function(answer) { 
                                    
                                    },
                                    error : function() {
                                      
                                    } 
                     });
               if( strcmp(enviroment, 'development') == 0  )
                    alert(jqXHR.responseText );
                  
               return jqXHR.responseText;

          }/***** End of the ajax methods 
          ==================================****/

      
          /** Kontrollerin başlangıcı
          ====================================*///
          function LengthKontrolParent(id,length,mesaj){
                if(  id.val().length >= parseInt(length)) { 
                    return true;
                } else {
                     Hata(id.parent().parent(),mesaj);
                    return false;
                }
          }
          function MatchKontrolParent(id1,id2,mesaj){
                if(id1.val() == id2.val()){
                   return true;
                }
                else{
                  Hata(id1.parent().parent(),mesaj);
                  Hata(id2.parent().parent(),mesaj);
                  return false;
                }
          } 
          function strcmp ( str1, str2 ) {
                str1 = jQuery.trim(str1); 
                str2 = jQuery.trim(str2);
                return ( ( str1 == str2 ) ? 0 : ( ( str1 > str2 ) ? 1 : -1 ) );
          }
          function CheckArray( id, array, mesaj){
                if(array.length > 0)
                  return true;
                else{
                     Hata(id.parent(),mesaj);
                     return false;
                }
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
          function FillKontrolParent(id,mesaj){
                if ( id.val() == "" || id.val() == "0" ) {
                    Hata(id.parent().parent(),mesaj);
                    return false;
                } else {
                    return true;
                }
          }
          function FillKontrolSpecial(id,kontrol,mesaj){
                if ( kontrol.val() == "" || kontrol.val() == "0" ) {
                    Hata(id,mesaj);
                    return false;
                } else {
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
          function SayiKontrolElement(id,mesaj){

                if( isNaN(id.val()) == true  || id.val() == ""){ 
                    Hata(id.parent(),mesaj);
                    return false;
                } 
                else {
                    return true;
                }
          }          
          function IntegerKontrol(val){
 
                if( isNaN(val) == true  || val == ""){ 
                    return false;
                } 
                else {
                    return true;
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
          }
          function PhoneKontrol(id,mesaj){
               
                var val1 = id.val();
                if(val1 == "" ){
                    return true;
                }
                else{  
                     var array = val1.split(' ');
                     var val =''; 
                     for (var i = 0; i < array.length; i++) {
                         val += array[i];
                      }; 
                     var p0 =  '0',
                         p1 =  jQuery.trim( val.substring(1,4)  ), 
                         p2 =  jQuery.trim( val.substring(4,7)  ), 
                         p3 =  jQuery.trim( val.substring(7,9)  ), 
                         p4 =  jQuery.trim( val.substring(9,11) ); 
                    if( IntegerKontrol(p1) && IntegerKontrol(p2) && IntegerKontrol(p3) && IntegerKontrol(p4) ){ 
                        if( p1.length == 3 && p2.length == 3 && p3.length == 2 && p4.length == 2 ){
                              id.val(p0+p1+" "+p2+" "+p3+" "+p4 );    
                              return true;
                        }   
                        else{
                            Hata( id.parent(), er.invalid_tel);
                            id.val("");
                            return false;
                         }   
                    }
                    else{
                        Hata( id.parent(),  er.invalid_tel);
                        id.val("");
                        return false;
                    }
                }    
          }/***** Kontrollerin sonu 
          ==================================****/

 
          