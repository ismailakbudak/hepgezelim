    
    // source application_file/views/offer/
   
    /********************************  offerUpdate.php *********************************************/
        $(function(){
                //   $('body').modalmanager('loading'); 
                //CapitiliazeFirst(  [ "#pac-input", "#pac-input2" ]  ); 
                if( strcmp(trip_typeSes, "0") === 0 )
                    $( "#radiosOnetime" ).attr('checked', true);
                else 
                    $( "#radiosManytime" ).attr('checked', true);    
                if( $( "#radiosOnetime" ).is(":checked") === true )
                     $( "#manytimeContent" ).hide();
                else
                     $( "#onetimeContent" ).hide();
                $( "#weekDaysStart" ).buttonset();
                $( "#weekDaysReturn" ).buttonset();
                var dayGo = departureDaysSes.split('?'),
                    arrayStart  = $( "#weekDaysStart" ).find('.ui-button-text-only');
               for (var j = 0; j < dayGo.length; j++) {
                      for (var i = 0; i < arrayStart.length; i++) {
                          if(  strcmp( dayGo[j], $(arrayStart[i]).data('name')) === 0 ){ 
                             $(arrayStart[i]).addClass("ui-state-active");
                             $(arrayStart[i]).prev().attr('checked', true);
                             $(arrayStart[i]).attr('aria-pressed', 'true');
                           }  
                      };
               };  
               if( $( "#twoWayCheck" ).data().result == 'checked' ){
                       $( "#twoWayCheck" ).attr('checked', true);
                       $( "#returnDate" ).slideDown();
                       $( "#returnDays" ).slideDown();
                       var dayBack = returnDaysSes.split('?'),
                           arrayReturn = $( "#weekDaysReturn" ).find('.ui-button-text-only');
                      for (var j = 0; j < dayBack.length; j++) {
                         for (var i = 0; i < arrayReturn.length; i++) {
                             if(  strcmp( dayBack[j], $(arrayReturn[i]).data('name')) === 0 ){ 
                                $(arrayReturn[i]).addClass("ui-state-active");
                                $(arrayReturn[i]).prev().attr('checked', true);
                                $(arrayReturn[i]).attr('aria-pressed', 'true');
                              }  
                         };
                      };   
                }
                else{
                       $( "#twoWayCheck" ).attr('checked', false);
                       $( "#returnDate" ).slideUp();
                       $( "#returnDays" ).slideUp();
                 } 
        });   
    /********************************  End of the offerUpdate.php **********************************/
