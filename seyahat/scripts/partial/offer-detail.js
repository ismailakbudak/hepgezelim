         $(function(){

           
                CapitiliazeFirst(  [ "#inputMessage" ]  );

                $( "#sendMessage" ).on("click",function(){ setTimeout(function(){$('#inputMessage').focus()},600); });
                
                $( "#send-message" ).on("click",function(){
                        var message  = $('#inputMessage'),
                            user_id  = $(this).data('id'),
                            offer_id = $(this).data('offer_id'),
                            data = { user_id: user_id, message:message.val(), offer_id: offer_id },
                            url = 'offer/contactDriver';
                            $( "#sending" ).modal();
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
                                         if     ( strcmp(result.status ,'success') == 0 ){ 
                                            BasariMesaj( result.text ); 
                                            message.val(""); 
                                            setTimeout( function(){ $('#contact-driver-modal').modal('toggle'); }, 500 );
                                           } 
                                         else if( strcmp(result.status ,'mistake') == 0 ){ HataMesajModal (  $('#send-message'), result.text     )} // show bottom alert
                                         else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal (  $('#send-message'), result.text     )} // show bottom alert
                                         else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal (  $('#send-message'), result.message  )} // show top
                                         else                                            { HataMesajModal (  $('#send-message'), er.error_send   )} // show bottom alert  
                                    },
                                    error : function() {
                                        HataMesaj( er.error_send );
                                    },
                                    complete: function(){
                                         $( '#sending' ).modal('toggle');
                                    } 
                          });
                        return false;
                }); 
                

                $( ".datepickerStart" ).datepicker({ minDate: 0, maxDate: "+2M +10D", dateFormat: "yy-mm-dd", dayNames: dayNames, dayNamesMin: dayNamesMin, monthNames: monthNames, prevText: prevText,  nextText: nextText  } );
                $( ".datepickerEnd" ).datepicker({ minDate: 0 , maxDate: "+3M +10D", dateFormat: "yy-mm-dd", dayNames: dayNames, dayNamesMin: dayNamesMin, monthNames: monthNames, prevText: prevText,  nextText: nextText   });
                $( ".datepickerEnd" ).on('mouseover',function(){
                        $(this).datepicker("option", "minDate" ,  $(this).parent().find(".datepickerStart").val()  );
                });


                $( '.repeat-trip').hide();
                $( ".glyphicon-repeat, .exit" ).on('click',function(event){
                       event.preventDefault();
                      $('.repeat-trip').slideToggle();
                });
                
               
                $( ".show-map" ).on('click',function(event){
                      event.preventDefault();
                      var panel = $("#iteneraryPanel").offset();
                      $('html,body').animate({
                          scrollTop:  panel.top - 35 
                      }, '600','swing');
                      $("#iteneraryPanel").find(".panel-body").slideDown();
                });
                $( ".hide-map" ).on('click',function(event){
                      event.preventDefault();
                      $('html,body').animate({
                          scrollTop:  0
                      }, '600','swing');
                      $("#iteneraryPanel").find(".panel-body").slideUp();
                });


                $( ".delete-offer" ).on('click',function(){
                      var offer_id = $(this).data('id');
                      $("#delete-modal").data().id = offer_id;
                });
                
                $( "#delete-modal .btn-primary" ).on('click',function(){
                      var offer_id = $( "#delete-modal" ).data('id'),
                          id = $(this)  ;
                      if( strcmp( offer_id , "-1" ) != 0  ){
                            var data = { offer_id: offer_id  },
                             url = 'offer/deleteOffer',
                             result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){ window.location = base_url + "offer"      } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesajModal ( id, result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesajModal ( id, result.message  )} // show top
                             else                                            { HataMesajModal ( id, er.error_send   )} // show bottom alert  
                      }
                      else{  HataMesajModal ( $(this), er.error_occurred) } 
                      return false;   
                });

                $( ".inputSave" ).on('click',function(){
                       var parent = $( this ).parent(),
                           departure_date = parent.find('.datepickerStart'),
                           departure_hr = parent.find('#datepickerStartTimeHour'),
                           departure_min = parent.find('#datepickerStartTimeSecond'),
                           return_date = parent.find('.datepickerEnd'),
                           return_hr = parent.find('#datepickerReturnTimeHr'),
                           return_min = parent.find('#datepickerReturnTimeMin'),
                           offer_id = $(this).data('id'),
                           boolValid = true;
                           boolValid = boolValid && FillKontrol(departure_date , er.blank_date);
                           if(  $(this).data('type') == "1" )
                                 boolValid = boolValid && FillKontrol(return_date , er.blank_date ); 
                           boolValid = boolValid && SameDate(departure_date.val(),departure_hr.val(), return_date.val(), return_hr.val() );
                           if(boolValid){
                                var data = { offer_id: offer_id, 
                                             departure_date: departure_date.val(), 
                                             departure_time: departure_hr.val() +':'+ departure_min.val(),
                                             return_date: return_date.val(), 
                                             return_time: return_hr.val() +':'+ return_min.val()  },
                                    url = 'offer/copyOffer',
                                    result = JSON.parse( AjaxSendJson(url,data) );  
                                    if     ( strcmp(result.status ,'success') == 0 ){ window.location = base_url + result.path  } 
                                    else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   (  result.text     )} // show bottom alert
                                    else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   (  result.message  )} // show top
                                    else                                            { HataMesaj   (  er.error_send   )} // show bottom alert  
                           }
                           else
                               HataMesaj(er.edit_info);  
                           return false;
                });
               
                function SameDate( departureDate, departureTime, returnDate, returnTime  ){
                         if( strcmp(departureDate, returnDate) == 0 ){
                               var array = departureTime.split(':');     
                               if( parseInt(returnTime) >= (parseInt(array[0]) + 3) )
                                   return true;
                               else{
                                   HataMesaj( er.same_date );
                                   return false;
                               }  
                         }
                         else
                            return true;
                }


              /*  for map 
              =============================================================*/
                  //mapDrawForSession();
                  //function mapDrawForSession( ){
                      function initialize(){     
                               var mapOptions = { center: new google.maps.LatLng(39,35), scrollwheel: false, zoom: 5  }  ,
                                   map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions) ,   
                                   types = "";
                               map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                        
                               var directionsDisplay,
                                   directionsService = new google.maps.DirectionsService(),
                                   points = pointsSession,
                                   array = points.split('?'),
                                   start = startSession,
                                   end = endSession,
                                   param = [] ;

                                for (var i = 0; i < array.length; i++) {
                                     if(array[i]  != ""){
                                         param.push(  {  location: array[i] }  );
                                     }
                                };

                                directionsDisplay = new google.maps.DirectionsRenderer();
                               //map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                                directionsDisplay.setMap(map);
                                 /// ilk request
                                var request = {
                                                   origin: start,
                                                   destination: end,
                                                   travelMode: google.maps.TravelMode.DRIVING
                                               };
                                directionsService.route(request, function(response, status) {
                                    if (status == google.maps.DirectionsStatus.OK) {
                                      // harıta da göstermey isağlar
                                        directionsDisplay.setDirections(response);
                                        ////// Toplma mesafeyi yazdırma 
                                         var result = directionsDisplay.getDirections(),
                                             total = 0, minute = 0, text = "" ,
                                             myroute = result.routes[0];
                                             
                                             total = myroute.legs[0].distance.value;
                                             minute = parseInt(myroute.legs[0].duration.value);
                                             var dil = "";
                                                if( strcmp( er.lang, "en") == 0 )
                                                   dil = "  " + myroute.legs[0].duration.text.replace('gün', 'day').replace('saat', 'hour').replace('dakika', 'minute') ;
                                                else
                                                   dil = "  " + myroute.legs[0].duration.text;
                                             text  = " <div class='row row-side'> <div class='col-lg-4 no-padding' id='expectedtime'> " +  dil+ "</div> " +
                                                     " <div class='col-lg-2 no-padding distance' id='expectedDistance'>"+  myroute.legs[0].distance.value/1000.0 +"</div> " + 
                                                     " <div class='col-lg-1 no-padding'> km </div> " +
                                                     " </div>";             
                                         var hour = Math.floor(minute/3600)  ,
                                             min = Math.ceil((minute % 3600) / 60);
                                         total = total / 1000.0;
                                         var  value = "<div class='col-lg-4 '>" +  
                                                       er.real_distance + "</div> <div style='padding-left: 14px' >"+ total+' km ' + "</div> " +
                                                      "<div class='col-lg-4 '>" + 
                                                        er.real_time + "</div> <div style='padding-left: 14px' >" + hour + er.saatS + min + er.dakikaS +"</div> </ br>" +
                                                      " <div class='col-lg-12' >"+ start + "   >>>>>>>>> </div>" +
                                                      " <div class='col-lg-12' >"+  text +  "</div>" +  
                                                      " <div class='col-lg-12' >"+ end + "   <<<<<<<<< </div>";     
                                         document.getElementById('realDistance').innerHTML = value;     
                                             
                                    }
                                });
                                 // ikinci request
                                request = {
                                                   origin: start,
                                                   destination: end,
                                                   waypoints:param,
                                                   travelMode: google.maps.TravelMode.DRIVING
                                };
                                directionsService.route(request, function(response, status) {
                                    if (status == google.maps.DirectionsStatus.OK) {
                                        directionsDisplay.setDirections(response);
                                        ////// Toplma mesafeyi yazdırma 
                                         var result = directionsDisplay.getDirections() ,
                                             total = 0, minute = 0, text = "" ,
                                             myroute = result.routes[0] ,
                                             j = 0 ;
                                         for (var i = 0; i < myroute.legs.length; i++) {
                                                 total += myroute.legs[i].distance.value;
                                                 minute += parseInt(myroute.legs[i].duration.value);
                                                 var dil = "";
                                                 if(param.length == 0){
                                                      if( strcmp( er.lang, "en") == 0 )
                                                         dil = "  " + myroute.legs[i].duration.text.replace('gün', 'day').replace('saat', 'hour').replace('dakika', 'minute') ;
                                                      else
                                                         dil = "  " + myroute.legs[i].duration.text;
                                                      text += " <div class='row row-side'> <div class='col-lg-4 no-padding'> " +  dil + "</div> " +
                                                              " <div class='col-lg-2 distance no-padding'>"+  myroute.legs[i].distance.value/1000.0 +"</div> " + 
                                                              " <div class='col-lg-1 no-padding'> km </div> " +
                                                              " </div>";             
                                                 }
                                                 else{
                                                      if( strcmp( er.lang, "en") == 0 )
                                                           dil = "  " + myroute.legs[i].duration.text.replace('gün', 'day').replace('saat', 'hour').replace('dakika', 'minute') ;
                                                      else
                                                           dil = "  " + myroute.legs[i].duration.text;
                                                      text += " <div class='row row-side'> <div class='col-lg-4 no-padding'  > " +  dil + "</div> " +
                                                              " <div class='col-lg-2 distance no-padding'>"+  myroute.legs[i].distance.value/1000.0 +"</div> " + 
                                                              " <div class='col-lg-1 no-padding'> km </div> " +
                                                              " </div>";             
                                                       if(j < param.length){
                                                           text +=  " <div  >  >>>>>>>>>  "+ param[j]['location'] + "   >>>>>>>>>   </div>";
                                                           j += 1;
                                                       }
                                                 }
                                         }
                                         var hour = Math.floor(minute/3600)  ,
                                             min = Math.ceil((minute % 3600) / 60);
                                         total = total / 1000.0;
                                          
                                         var  value = "<div class='col-lg-4 '>" +   
                                                       er.total_seyahat + " </div><div style='padding-left: 14px' id='totalDistance'> "+total+' km ' + "</div> " +
                                                       "<div class='col-lg-4 '>" + 
                                                       er.total_time +"</div> <div id='totalTime' class='col-lg-12'> " + hour + er.saatS + min + er.dakikaS + "</div> </ br>" +
                                                      " <div class='col-lg-12' >"+ start + "   >>>>>>>>> </div>" +
                                                      "<div class='col-lg-12'>" +    text + "</div>" +    
                                                      " <div class='col-lg-12'>"+ end + "   <<<<<<<<< </div>";                           
                                         document.getElementById('total').innerHTML =  value;
                                         //getFormDistance();
                                         //setTimeout( function(){ $("#iteneraryPanel").slideToggle("slow") },4000 ) 
                                    }
                                }); // get direction iki sonu
                      }
                      google.maps.event.addDomListener(window, 'load', initialize());   
                  //}/* Map draw sonu */
     
           });    