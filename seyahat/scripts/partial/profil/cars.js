    // source application_file/views/profil/
   
    /********************************  cars.php *********************************************/
        $(function(){
            
             $('.deleteCar').on('click', function(){
                    var carId = $(this).data('id');
                    $("#car").data('id', carId) ;
             });

             $( '.onayDeleteCar' ).on('click', function(){
                     var carId = $(this).data('id');
                     var data = {   id: carId },
                         url = 'car/delete',
                         result = JSON.parse( AjaxSendJson(url,data) );  
                         if( strcmp(result.status ,'success') == 0 ) { location.reload(true) }
                         else if( strcmp(result.status ,'fail') == 0 )  { HataMesaj( result.text  )               }
                         else if( strcmp(result.status ,'error') == 0 ) { HataMes( $('#message') , result.message );    }
                         else{ HataMesaj(  er.error_send  ) }  
                         $( '#deleteCarModal' ).modal('toggle');  
             }); 
        });
    /***************************** End of the cars.php **************************************/


    /********************************  carsAdd.php *********************************************/
        $(function(){
              
            
             CapitiliazeFirst( ['#inputMake' , '#inputModel' ,'#inputColour' ] );
            

             $( '#carAdd' ).on('click', function(){

                       var thisID = this, 
                           make = $( '#inputMake'),
                           model = $( '#inputModel'), 
                           comfort = $( '#inputComfort'), 
                           seat_count = $( '#inputSeatCount'), 
                           colour = $( '#inputColour');
                           var boolValid = true;
                               boolValid = boolValid && SelectKontrol(make,              er.blank_car_make );                   
                               boolValid = boolValid && FillKontrol(model,             er.blank_car_model );
                               boolValid = boolValid && SelectKontrol(comfort,         er.sel_comfort);
                               boolValid = boolValid && FillKontrol(seat_count,        er.blank_seat);
                               boolValid = boolValid && SayiKontrolElement(seat_count, er.enter_int );
                             //  boolValid = boolValid && FillKontrol(colour,'Araç rengi girmediniz..');
                           if(boolValid){
                                 var data = {   make: make.val(),
                                                model: model.val(),
                                                comfort: comfort.val(),
                                                seat_count: seat_count.val(),
                                                colour: colour.val()     
                                            },
                                     url = 'car/addAction',
                                     result = JSON.parse( AjaxSendJson(url,data) );  
                                     if( strcmp(result.status,'success') == 0 ) { window.location = base_url + 'profil/profile/cars' }
                                     else if( strcmp(result.status,'fail') == 0 )  { HataMesajModal(thisID, er.error_occurred) }
                                     else if( strcmp(result.status ,'error') == 0 ) { HataMes( $('#message') , result.message );    }
                                     else{ HataMesajModal(thisID, er.error_send) }  
                           }
                           else{
                                 HataMesajModal(thisID, er.edit_info );
                           }
             });
        });
    /***************************** End of the carsAdd.php **************************************/



    /********************************  carUpdate.php *********************************************/
        $(function(){
              
         
             var array = $( '#inputComfort' ).find('option');
    	       for (var i = 0; i < array.length; i++) {
    	       	 if(comfort == i)
    	            	 $( array[i] ).attr('selected', true);
    	       };
             $( '#inputUpdate' ).on('click', function(){

                       var thisID = this, 
                           make = $( '#inputMake'),
                           model = $( '#inputModel'), 
                           comfort = $( '#inputComfort'), 
                           seat_count = $( '#inputSeatCount'), 
                           colour = $( '#inputColour');
                           var boolValid = true;
                               boolValid = boolValid && SelectKontrol(make,              er.blank_car_make  );                     
                               boolValid = boolValid && FillKontrol(model,             er.blank_car_model );  
                               boolValid = boolValid && SelectKontrol(comfort,         er.sel_comfort     );  
                               boolValid = boolValid && FillKontrol(seat_count,        er.blank_seat      );  
                               boolValid = boolValid && SayiKontrolElement(seat_count, er.enter_int       );  
                           if(boolValid){
                                 var data = {   carid: carid, 
                                 	              make: make.val(),
                                                model: model.val(),
                                                comfort: comfort.val(),
                                                seat_count: seat_count.val(),
                                                colour: colour.val()     
                                            },
                                     url = 'car/updateAction',
                                     result = JSON.parse( AjaxSendJson(url,data) );  
                                     if( strcmp(result.status ,'success') == 0 ) { window.location = base_url + 'profil/profile/cars' }
                                     else if( strcmp(result.status ,'fail') == 0 )  { HataMesajModal(thisID, er.error_occurred ) }
                                     else if( strcmp(result.status ,'error') == 0 ) { HataMes( $('#message') , result.message );    }
                                     else{ HataMesajModal(thisID,  er.error_send) }  
                           }
                           else{
                                 HataMesajModal(thisID, er.edit_info);
                           }
             });
        });
    /***************************** End of the carUpdate.php **************************************/