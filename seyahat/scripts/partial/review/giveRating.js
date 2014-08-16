
       /// SOURCE application_file/views/review/

    /**********************  giveRating.php  *****************************/ 
        (function($){
	           $('[rel=popover]').popover();
	           $( ".people" ).on('click',function(){
	                  $('#rate').slideDown("fast");
	                  var val = $( this ).val();
	                  if( strcmp( val , "1" ) == 0 )
	                     $( "#driver" ).slideUp();
	                  else if( strcmp( val , "2" ) == 0 )
	                      $( "#driver" ).slideDown();
	                  else if( strcmp( val , "3" ) == 0 )
	                       $( "#driver" ).slideUp();
	           });


	           CapitiliazeFirst(  [ "#inputReview" ]  );  
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

	           $( "#inputGiveRate" ).on('click',function(){

	                 var option      = $( "input[type='radio'][name='people']:checked" ),
	                     star        = $( "input[type='hidden'][name='inputRating']" ),
	                     review      = $( "#inputReview" ),
	                     driveSkill  = $( "input[type='radio'][name='driving']:checked" ),
	                     who_give    = $( this ).data("who_give"), 
	                     who_receive = $( this ).data("who_receive"), 
	                     data        = { who_give:     who_give, 
	                                     who_receive:  who_receive, 
	                                     star:         star.val(), 
	                                     review:       review.val() };
	                 if(  strcmp(option.val(), "1") == 0 || strcmp(option.val(), "3") == 0 ){
	                      data.is_driver = "0";
	                      data.skill     = "no-skill";
	                      sendData(data);
	                 }
	                 else if(strcmp(option.val(), "2") == 0) {
	                      data.is_driver = "1";
	                      option2      = $( "input[type='radio'][name='driving']:checked" );
	                      if( option2.length > 0 ){
	                           data.skill     = driveSkill.val();
	                           sendData(data);
	                      }
	                      else{
	                             HataMesaj( choose_vote );
	                      }
	                 }
	                 return false;
	          });

	          function sendData( data ){
	             // $( '#giving' ).modal();
	              $.ajax({      type: "POST", 
	                           url:  base_url + "review/giveRateAction", 
	                           dataType: "text",  
	                           cache:false,
	                           data: data,
	                           success: function(answer) { 
	                                if( strcmp(enviroment, 'development') == 0  )
	                                       alert( answer ); 
	                                var result = JSON.parse( answer );  
	                                if     ( strcmp(result.status ,'success' ) == 0 ){ window.location = base_url + "review/given" } 
	                                else if( strcmp(result.status ,'mistake' ) == 0 ){ HataMesaj( result.text     )} // show bottom alert
	                                else if( strcmp(result.status ,'fail'    ) == 0 ){ HataMesaj( result.text     )} // show bottom alert
	                                else if( strcmp(result.status ,'error'   ) == 0 ){ HataMesaj( result.message  )} // show top
	                                else                                             { HataMesaj( er.error_send   )} // show bottom alert  
	                           },
	                           error : function() {
	                               HataMesaj( er.error_send );
	                           },
	                           complete: function(){
	                              //  $( '#giving' ).modal("toggle");
	                           } 
	             });
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

	     })(jQuery);  
    /******************** End of the giveRating.php **********************/

