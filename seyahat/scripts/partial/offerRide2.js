
    (function($){ 
           
          notDisplay();  
          function notDisplay(){  
            setTimeout( function(){       
                if( $('body').hasClass("modal-open") )
                   $('body').modalmanager('loading');
                
                if( $('body').hasClass("modal-open") )
                         notDisplay();         

              }, 3000);  
           }  

          // console.log( JSON.stringify( locations, null,4) );
          CapitiliazeFirst(  [ "#inputExplainReturn", "#inputExplainGoing" ]  );  
   
          function GetColor(id, max ){
                var colour = 'green';
                var val = parseInt(id.val());
                
                if( max <= 15  ){ 
                  if( val < max - 8 )
                     colour = 'green';
                  else if(val < max - 5 )
                     colour = 'orange';
                  else
                     colour = 'red';
               }
               else if( max < 20 ){ 
                  if( val < max - 10 )
                     colour = 'green';
                  else if(val < max - 4 )
                     colour = 'orange';
                  else
                      colour = 'red';
               }
               else if( max < 30 ){ 
                  if( val < max - 19 )
                     colour = 'green';
                  else if( val < max - 12  )
                     colour = 'orange';
                  else
                      colour = 'red';
               }
               else if( max < 40 ){ 
                  if( val < max - 22 )
                     colour = 'green';
                  else if(val < max - 13 )
                     colour = 'orange';
                  else
                      colour = 'red';
               }
               else if( max >= 40 ){ 
                  if( val < max - 30 )
                     colour = 'green';
                  else if(val < max - 14 )
                     colour = 'orange';
                  else
                      colour = 'red';
               }

                return colour; 
          }
          function getColorForIn( price , max ){
                var colour = 'green';
                var val    = price;
                console.log(max + "  " + val );
                if( max <= 15  ){ 
                  if( val < max - 8 )
                     colour = 'green';
                  else if(val < max - 5 )
                     colour = 'orange';
                  else
                     colour = 'red';
               }
               else if( max < 20 ){ 
                  if( val < max - 10 )
                     colour = 'green';
                  else if(val < max - 4 )
                     colour = 'orange';
                  else
                      colour = 'red';
               }
               else if( max < 30 ){ 
                  if( val < max - 19 )
                     colour = 'green';
                  else if( val < max - 12  )
                     colour = 'orange';
                  else
                      colour = 'red';
               }
               else if( max < 40 ){ 
                  if( val < max - 22 )
                     colour = 'green';
                  else if(val < max - 13 )
                     colour = 'orange';
                  else
                      colour = 'red';
               }
               else if( max >= 40 ){ 
                  if( val < max - 30 )
                     colour = 'green';
                  else if(val < max - 14 )
                     colour = 'orange';
                  else
                      colour = 'red';
               }

                return colour; 
          } 
          function SetColor(id, max ){
               var val = parseInt(id.val());
               if( max <= 15  ){ 
                  if( val < max - 8 ){
                     id.removeClass('red').removeClass('orange');
                     id.addClass('green');
                  }
                  else if(val < max - 5 ){
                    id.removeClass('green').removeClass('red');
                     id.addClass('orange');
                  }
                  else{
                     id.removeClass('orange').removeClass('green');
                     id.addClass('red');
                  }
               }
               else if( max < 20 ){ 
                  if( val < max - 10 ){
                     id.removeClass('red').removeClass('orange');
                     id.addClass('green');
                  }
                  else if(val < max - 4 ){
                    id.removeClass('green').removeClass('red');
                     id.addClass('orange');
                  }
                  else{
                     id.removeClass('orange').removeClass('green');
                     id.addClass('red');
                  }
               }
               else if( max < 30 ){ 
                  if( val < max - 19 ){
                     id.removeClass('red').removeClass('orange');
                     id.addClass('green');
                  }
                  else if( val < max - 12  ){
                     id.removeClass('green').removeClass('red');
                     id.addClass('orange');
                  }
                  else{
                     id.removeClass('orange').removeClass('green');
                     id.addClass('red');
                  }
               }
               else if( max < 40 ){ 
                  if( val < max - 22 ){
                     id.removeClass('red').removeClass('orange');
                     id.addClass('green');
                  }
                  else if(val < max - 13 ){
                    id.removeClass('green').removeClass('red');
                     id.addClass('orange');
                  }
                  else{
                     id.removeClass('orange').removeClass('green');
                     id.addClass('red');
                  }
               }
               else if( max >= 40 ){ 
                  if( val < max - 30 ){
                     id.removeClass('red').removeClass('orange');
                     id.addClass('green');
                  }
                  else if(val < max - 14 ){
                    id.removeClass('green').removeClass('red');
                     id.addClass('orange');
                  }
                  else{
                     id.removeClass('orange').removeClass('green');
                     id.addClass('red');
                  }
               }
          }

          $( "#inputUpdate" ).on('click',function(){
                    /*
                    console.log( JSON.stringify( locations, null,4) ); 
                    console.log("sss"); 
                    console.log( JSON.stringify( expectedPrices, null,4) ); 
                    */
       
                    var sameExplain = $( "#sameExplain" ),
                        thisID = this,
                        cities = $( "#prices" ).find('.city'),
                        prices = $( "#prices" ).find('.inputNumber'),
                        inputSeatCount = $( "#inputSeatCount" ),
                        inputExplainGoing =  $( "#inputExplainGoing" ),
                        inputExplainReturn = $( "#inputExplainReturn" ),
                        inputLuggages = $( "#luggages" ),
                        inputCar_id = $( "#cars" ),
                        inputLeave_times = $( "#leave_times" ),
                        acceptTerms = $( "#acceptTerms" ),          
                        inputPrice ="",
                        inputPriceColor="",
                        inputTotal = $( prices[prices.length - 1] ),
                        inputTotalPrice = $(prices[prices.length - 1]).val(),
                        inputTotalPriceColor = GetColor( $(prices[prices.length -1]),  parseInt($(prices[prices.length -1]).data().pricemax) ),
                       
                        realDistance = $( "#realDistance" ).find("#expectedDistance").text(),
                        realTime = $( "#realDistance" ).find("#expectedtime").text(),
                        totalDistance = $( "#totalDistance").text(),
                        totalTime  = $( "#totalTime").text(),
                        DistancesWay = "",
                        TimesWay = "",    
                        distances = $( "#total" ).find(".row").find(".distance"),
                        times =     $( "#total" ).find(".row").find(".time");
                    
                     if(isTwoway == 'true'){ 
                          if( sameExplain.prop('checked') == true ){
                               inputExplainReturn.val( inputExplainGoing.val() );
                          }
                     }
                     if(distances.length > 1){
                           for (var i = 0; i < distances.length; i++) {
                               DistancesWay += $(distances[i]).text();
                               TimesWay +=  $(times[i]).text();
                                if( i <  distances.length - 1  ){
                                         DistancesWay += '?';
                                         TimesWay += '?';
                                }    
                           }; 
                     }
                       
                     var boolValid = true;
                     for (var i = 0; i < prices.length - 1; i++) {
                         if( IntegerKontrol( $(prices[i]) , er.enter_int) ){
                              inputPrice += $(prices[i]).val();
                              inputPriceColor +=  GetColor( $(prices[i]),  parseInt($(prices[i]).data().pricemax) ) ;
                              if( i <  prices.length - 2  ){
                                   inputPrice += '?';
                                   inputPriceColor += '?';
                              }    
                         }
                         else{
                             boolValid = false; 
                             break;
                        }
                    };

            
                    if(login ==  "1")
                         boolValid = boolValid && SelectKontrol(inputCar_id, er.sel_car );
                    boolValid = boolValid && SelectKontrol(inputLuggages,    er.sel_luggage );
                    boolValid = boolValid && SelectKontrol(inputLeave_times, er.sel_leavetime );
                    boolValid = boolValid && IntegerKontrol(inputTotal,      er.enter_int );
                    boolValid = boolValid && IntegerKontrol(inputSeatCount,  er.enter_int );
                    boolValid = boolValid && CheckBoxKontrol(acceptTerms,    er.condition );
                    if ( boolValid ) {
                      
                                   var dataForm = {   car_id:  inputCar_id.val(),
                                                      luggage_id:  inputLuggages.val(),
                                                      leave_time_id:  inputLeave_times.val(),
                                                      price_per_passenger:  inputTotalPrice,
                                                      price_per_passenger_color: inputTotalPriceColor,
                                                      number_of_seats:  inputSeatCount.val(),
                                                      explain_departure:  inputExplainGoing.val(),
                                                      explain_return:  inputExplainReturn.val(), 
                                                      inputPrices: inputPrice,
                                                      inputPricesColor: inputPriceColor,
                                                      realDistance: realDistance, 
                                                      realTime: realTime,
                                                      totalDistance: totalDistance,
                                                      totalTime: totalTime,
                                                      DistancesWay: DistancesWay,
                                                      TimesWay: TimesWay,
                                                      locations:locations,
                                                      expectedPrices:expectedPrices
                                                   };
  
                                                 $.ajax({         
                                                           type: "POST", 
                                                           url:  base_url + 'offer/updateOfferAjax', 
                                                           dataType: "text",  
                                                           cache:false,
                                                           data: dataForm,
                                                           success: function(answer) {
                                                               if(strcmp(enviroment, 'development') == 0){
                                                                    alert(answer);
                                                               }
                                                               answer = JSON.parse( answer );   
                                                               if( strcmp(answer.status, 'success' ) == 0 ){
                                                                   window.location = base_url + answer.path;
                                                               }
                                                               else if( strcmp(answer.status ,'error') == 0 ) { HataMesaj( 'body', 'error', er.error, answer.message );     }
                                                               else{ HataMesaj( 'body', 'error', er.error, er.fail) ; }
                                                           },
                                                           error : function() {
                                                                  HataMesaj( 'body', 'error', er.error, er.error_send);
                                                           },
                                                           complete: function(){
                                                           }
                                                   });     
                    }
                    else{
                          HataMesaj( 'body', 'warning', er.warning, er.edit_info );
                    }    
                                    
          });

      
          //locations:locations,
          //expectedPrices:expectedPrices 
          $( "#complete" ).on('click',function(){
              // console.log( JSON.stringify( locations, null,4) ); 
              // console.log("sss"); 
              // console.log( JSON.stringify( expectedPrices, null,4) ); 
              // locations expectedPrices
              if(login ==  "1" || login == 'true'){
                   
                    var sameExplain = $( "#sameExplain" ),
                        thisID = this,
                        cities = $( "#prices" ).find('.city'),
                        prices = $( "#prices" ).find('.inputNumber'),
                        inputSeatCount = $( "#inputSeatCount" ),
                        inputExplainGoing =  $( "#inputExplainGoing" ),
                        inputExplainReturn = $( "#inputExplainReturn" ),
                        inputLuggages = $( "#luggages" ),
                        inputCar_id = $( "#cars" ),
                        inputLeave_times = $( "#leave_times" ),
                        acceptTerms = $( "#acceptTerms" ),          
                        inputPrice ="",
                        inputPriceColor="",
                        inputTotal = $( prices[prices.length - 1] ),
                        inputTotalPrice = $(prices[prices.length - 1]).val(),
                        inputTotalPriceColor = GetColor( $(prices[prices.length -1]),  parseInt($(prices[prices.length -1]).data().pricemax) ),
                       
                        realDistance = $( "#realDistance" ).find("#expectedDistance").text(),
                        realTime = $( "#realDistance" ).find("#expectedtime").text(),
                        totalDistance = $( "#totalDistance").text(),
                        totalTime  = $( "#totalTime").text(),
                        DistancesWay = "",
                        TimesWay = "",    
                        distances = $( "#total" ).find(".row").find(".distance"),
                        times =     $( "#total" ).find(".row").find(".time");
                    
                     if(isTwoway == 'true'){ 
                          if( sameExplain.prop('checked') == true ){
                               inputExplainReturn.val( inputExplainGoing.val() );
                          }
                     }
                     if(distances.length > 1){
                           for (var i = 0; i < distances.length; i++) {
                               DistancesWay += $(distances[i]).text();
                               TimesWay +=  $(times[i]).text();
                                if( i <  distances.length - 1  ){
                                         DistancesWay += '?';
                                         TimesWay += '?';
                                }    
                           }; 
                     }
                       
                     var boolValid = true;
                     for (var i = 0; i < prices.length - 1; i++) {
                         if( IntegerKontrol( $(prices[i]) , 'Lütfen sayi giriniz...') ){
                              inputPrice += $(prices[i]).val();
                              inputPriceColor +=  GetColor( $(prices[i]),  parseInt($(prices[i]).data().pricemax) ) ;
                              if( i <  prices.length - 2  ){
                                   inputPrice += '?';
                                   inputPriceColor += '?';
                              }    
                         }
                         else{
                             boolValid = false; 
                             break;
                        }
                    };

            
                    if(login ==  "1")
                         boolValid = boolValid && SelectKontrol(inputCar_id, er.sel_car );
                    boolValid = boolValid && SelectKontrol(inputLuggages,    er.sel_luggage );
                    boolValid = boolValid && SelectKontrol(inputLeave_times, er.sel_leavetime );
                    boolValid = boolValid && IntegerKontrol(inputTotal,      er.enter_int );
                    boolValid = boolValid && IntegerKontrol(inputSeatCount,  er.enter_int );
                    boolValid = boolValid && CheckBoxKontrol(acceptTerms,    er.condition );
                    if ( boolValid ) {
                                  
                                   var dataForm = {   car_id:  inputCar_id.val(),
                                                      luggage_id:  inputLuggages.val(),
                                                      leave_time_id:  inputLeave_times.val(),
                                                      price_per_passenger:  inputTotalPrice,
                                                      price_per_passenger_color: inputTotalPriceColor,
                                                      number_of_seats:  inputSeatCount.val(),
                                                      explain_departure:  inputExplainGoing.val(),
                                                      explain_return:  inputExplainReturn.val(), 
                                                      inputPrices: inputPrice,
                                                      inputPricesColor: inputPriceColor,
                                                      realDistance: realDistance, 
                                                      realTime: realTime,
                                                      totalDistance: totalDistance,
                                                      totalTime: totalTime,
                                                      DistancesWay: DistancesWay,
                                                      TimesWay: TimesWay,
                                                      locations:locations,
                                                      expectedPrices:expectedPrices
                                                   };
                                       
                                       if(login ==  "1" || login == 'true'){
                                                 $.ajax({         
                                                           type: "POST", 
                                                           url:  base_url + 'offersAjax/createOffer', 
                                                           dataType: "text",  
                                                           cache:false,
                                                           data: dataForm,
                                                           success: function(answer) {
                                                               if(strcmp(enviroment, 'development') == 0){
                                                                    alert(answer);
                                                               }
                                                               answer = JSON.parse( answer );   
                                                               if( strcmp(answer.status, 'success' ) == 0 ){
                                                                   window.location = base_url  + answer.path;
                                                               }
                                                               else if( strcmp(answer.status ,'error') == 0 ) { HataMesaj( 'body', 'error', er.error, answer.message );    }
                                                               else{ HataMesaj( 'body', 'error', er.error, er.fail) ; }
                                                           },
                                                           error : function() {
                                                                  HataMesaj( 'body', 'error', er.error, er.error_send);
                                                           },
                                                           complete: function(){
                                                           }
                                                   });     
                                        }
                                        else{
                                           $('#login').modal('toggle');
                                          /*
                                                 $.ajax({         
                                                           type: "POST", 
                                                           url:  base_url + 'offersAjax/createOfferVisitor', 
                                                           dataType: "text",  
                                                           cache:false,
                                                           data: dataForm,
                                                           success: function(answer) {
                                                                 if(strcmp(enviroment, 'development') == 0)
                                                                      alert(answer);
                                                                 answer = JSON.parse( answer );   
                                                                 if( strcmp (answer.status, 'success') == 0 )
                                                                       window.location = base_url + 'signup/?result=1';
                                                                 else if(  strcmp (answer.status, 'fail') == 0 )
                                                                       HataMesaj( 'body' ,'error' , er.error, er.fail );
                                                                 else if( strcmp(answer.status ,'error') == 0 ) { HataMesaj( 'body', 'error', er.error, answer.message );    }
                                                                 else
                                                                       HataMesaj( 'body', 'error', er.error, er.fail );
                                                           },
                                                           error : function() {
                                                                 HataMesaj( 'body' ,'error' , er.error, er.error_send );
                                                           },
                                                           complete: function(){
                                                           }
                                                   });  
                                                   */   
                                        }     
                    }
                    else{
                          HataMesaj( 'body', 'warning', er.warning, er.edit_info );
                    }
              }
              else{
                   if( $('body').hasClass("modal-open") )
                        $('body').modalmanager('loading');
                   
                   if( $('body').hasClass("modal-open") )
                        notDisplay();  
                   
                   $('#login').modal('toggle');
              }          
              return false;                    
          });

          $( "#sameExplain" ).attr('checked', true);
          $( "#TripReturnInformation" ).hide();
          $( "#sameExplain" ).on('click',function(){
                    if( !this.checked )
                        $( "#TripReturnInformation" ).slideDown();
                    else
                         $( "#TripReturnInformation" ).slideUp();
          });

          $( ".inputNumber" ).on('change',function(e){
               
                if( !SayiKontrol($(this)) ){
                     HataMesaj( 'body' ,'error', er.error, er.enter_int );
                     
                     var result = parseInt($(this).data().pricemax) - range 
                     if(result > 0)
                        $(this).val( result);
                     else
                        $(this).val( "3"); 
                }
                else{
                      var price = parseInt( $(this).data().pricemax),
                          result = parseInt($(this).val());
                      if( price > result && result > 0){
                          
                      }
                      else{
                            if(result < 0)
                               HataMesaj( 'body', 'warning', er.warning, er.max_num );
                            else
                               HataMesaj( 'body', 'warning',  er.warning, er.max_num );
                           
                            result = parseInt($(this).data().pricemax) - range 
                            if(result > 0)
                               $(this).val( result);
                            else
                               $(this).val( "3");  
                      }
                }
                SetColor( $( this ) , $(this).data().pricemax  );
                TotalPriceHesapla();
           });

          $( ".plus" ).on('click',function(){
              var val = $(this).parent().parent().find( ".inputNumber" ),
                  result = parseInt(val.val()) + 1 ,
                   price = parseInt(val.data().pricemax);
         
              if( price > result){
                   val.val( result );
                   TotalPriceHesapla(); 
              }    
              else{
                  HataMesaj( 'body' ,'warning',  er.warning, er.max_num  );
                  HataInput( val );
              }
              SetColor(val,  parseInt(val.data().pricemax)) ; 
          });

          $( ".minus" ).on('click',function(){
               var val = $(this).parent().parent().find( ".inputNumber" ),         
                  result = parseInt(val.val()) - 1 ;
              
               if(result > 0){
                   val.val(result );
                   TotalPriceHesapla();
               }
               else{
                   HataMesaj( 'body', 'warning',  er.warning, er.min_num );
                   HataInput( val );
                }
               SetColor(val,  parseInt(val.data().pricemax) ) ; 
          });
          
          $( "#buttonBack" ).on('click',function(){
               window.location = base_url + "main/offerUpdate"; 
          });
          

          function TotalPriceHesapla(){
              var inputs = $( "#prices" ).find(".inputNumber"),
                  totalPrice = 0;
              if(inputs.length > 1){ 
                   for (var i = 0; i < inputs.length - 1; i++) {
                       totalPrice += parseInt( $(inputs[i]).val() );
                   };
                   $(inputs[inputs.length-1]).val(totalPrice); 
              }

              SetColor( $(inputs[inputs.length -1]),  parseInt($(inputs[inputs.length -1]).data().pricemax) );
          }    

          if(isTwoway != 'true' ){
              $( '#sameExplainDiv' ).hide();
          }
         
         // metodu içeri al gerek yok ekstra işleme değiştirilebilir
         function getFormDistance(){
          
            var  distances = $( "#total" ).find(".row").find(".distance"),
                 priceDivider = 10,
                 total = 0,
                 expected = $( "#expectedPrice" ),
                 priceForExpexted = $( "#expectedDistance" ),
                 division = parseInt( priceForExpexted.text() ),
                 inputs = $( "#prices" ).find(".inputNumber");
                 expected.data("price", ( division / priceDivider ).toFixed(0) ) ;
                
                 if(  isNaN( expected.data("price") )  ){
                      console.log("Expected : nana " +  expected.data("price") );
                      expected.data("price", ( parseInt( priceForExpexted.text() ) / priceDivider ).toFixed(0) ) ;
                 }      
                 if( isNaN( division ) || isNaN( expected.data("price") ) ){
                     alert(er.error_occurred + " " + er.refresh);
                     location.reload(true);
                 }
                 
                 expected.text( ( division / priceDivider ).toFixed(0));

                 for (var i =  0; i < distances.length; i++) {
                      result = ( parseInt( $( distances[i] ).text() ) / priceDivider ).toFixed(0);
                      total += parseInt( $( distances[i] ).text() ) / priceDivider ;
                      $( inputs[i] ).val(  result );
                      $( inputs[i] ).data().pricemax = parseInt(result) + range;

                      SetColor( $( inputs[i] ), parseInt(result) + range );
                 };
                 
                 $(inputs[inputs.length -1]).data().pricemax = parseInt(expected.data().price) + range;
                 $(inputs[inputs.length -1]).val(total.toFixed(0));
                 
                 // ana toplamın fiyatı
                 SetColor( $(inputs[inputs.length -1]),  parseInt($(inputs[inputs.length -1]).data().pricemax) );
         }
            
          // get location 
          var locations      = [];
          var expectedPrices = [ { type:"ilk" } ];
          function setExpectedPrices( val ){
            expectedPrices.push(val);
            //console.log("eklendi");
            //console.log(val);
          }
          createLocations();
          function createLocations(){ 
                 var points       = pointsSession,
                     array        = points.split('?'),
                     start        = startSession,
                     end          = endSession,
                     mygc         = new google.maps.Geocoder();
                 mygc.geocode({'address' : start}, function(results, status){
                     if (status == google.maps.GeocoderStatus.OK) {
                              var point = { type:'start', name:start, lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng() }; 
                              locations.push(point);
                     }else{
                             alert(er.error_occurred + " " + er.refresh );
                             location.reload(true); 
                     }      
                 });
                 mygc.geocode({'address' : end}, function(results, status){
                     if (status == google.maps.GeocoderStatus.OK) {
                             var point = { type:'end', name:end, lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng() }; 
                             locations.push(point);
                      }else{
                             alert(er.error_occurred + " " + er.refresh );
                             location.reload(true); 
                     }   
                 });   
                 for (var i = 0, n = array.length; i < array.length; i++) {
                      if(array[i]  != ""){
                           (function(address,callback){
                                mygc.geocode( { 'address': address}, function(results, status) {
                                     if (status == google.maps.GeocoderStatus.OK) {
                                             var point = {type:'way', name:address, lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng() }; 
                                             locations.push(point);
                                     }else{
                                             alert(er.error_occurred + " " + er.refresh );
                                             location.reload(true);
                                     }
                                     if (--n === 0) {            
                                          callback(array);
                                     }                                   
                                });
                            })(array[i],  function(){ //console.log( JSON.stringify( locations, null,4) );  console.log('geocoding finished');
                                                      });
                      }
                 };
          }       



         mapDrawForSession();
         function mapDrawForSession( ){
          
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
                         param  = [],
                         offers = [];
                     
                      offers.push(start);
                      for (var i = 0; i < array.length; i++) {
                           if(array[i]  != ""){
                               param.push(  {  location: array[i] }  );
                               offers.push(  array[i] );
                           }
                      }; 
                      offers.push(end);

                      directionsDisplay = new google.maps.DirectionsRenderer();
                     // map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
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
                              // Toplma mesafeyi yazdırma 
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
                                   text  = " <div class='row'> <div class='col-lg-4' id='expectedtime'> " +  dil+ "</div> " +
                                           " <div class='col-lg-2 distance' id='expectedDistance'>"+  myroute.legs[0].distance.value/1000.0 +"</div> " + 
                                           " <div class='col-lg-1'> km </div> " +
                                           " </div>";             
                               var hour = Math.floor(minute/3600)  ,
                                   min = Math.ceil((minute % 3600) / 60);
                               total = total / 1000.0;
                               var  value = "<div class='col-lg-6'>" +  
                                             er.real_distance + "</div> <div style='padding-left: 14px' >"+ total+' km ' + "</div> " +
                                            "<div class='col-lg-6'>" + 
                                              er.real_time + "</div> <div style='padding-left: 14px' >" + hour + er.saatS + min + er.dakikaS +"</div> </ br>" +
                                            " <div class='col-lg-12' >"+ start + "   >>>>>>>>> </div>" +
                                            " <div class='col-lg-12' >"+  text +  "</div>" +  
                                            " <div class='col-lg-12' >"+ end + "   <<<<<<<<< </div>";     
                               
                               document.getElementById('realDistance').innerHTML = value;     
          
                          }else{
                                            //alert(er.error_occurred + " " + er.refresh );
                                            //location.reload(true);
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
                               // Toplma mesafeyi yazdırma 
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
                                            text += " <div class='row'> <div class='col-lg-4 time'> " +  dil + "</div> " +
                                                    " <div class='col-lg-2 distance'>"+  myroute.legs[i].distance.value/1000.0 +"</div> " + 
                                                    " <div class='col-lg-1'> km </div> " +
                                                    " </div>";             
                                       }
                                       else{
                                            if( strcmp( er.lang, "en") == 0 )
                                                 dil = "  " + myroute.legs[i].duration.text.replace('gün', 'day').replace('saat', 'hour').replace('dakika', 'minute') ;
                                            else
                                                 dil = "  " + myroute.legs[i].duration.text;
                                            text += " <div class='row'> <div class='col-lg-4 time'  > " +  dil + "</div> " +
                                                    " <div class='col-lg-2 distance'>"+  myroute.legs[i].distance.value/1000.0 +"</div> " + 
                                                    " <div class='col-lg-1'> km </div> " +
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
                                
                               var  value = "<div class='col-lg-4'>" +   
                                             er.total_seyahat + " </div><div style='padding-left: 14px' id='totalDistance'> "+total+' km ' + "</div> " +
                                             "<div class='col-lg-4'>" + 
                                             er.total_time +"</div> <div id='totalTime' class='col-lg-12'> " + hour + er.saatS + min + er.dakikaS + "</div> </ br>" +
                                            " <div class='col-lg-12' >"+ start + "   >>>>>>>>> </div>" +
                                            "<div class='col-lg-12'>" +    text + "</div>" +    
                                            " <div class='col-lg-12'>"+ end + "   <<<<<<<<< </div>";                           
                               document.getElementById('total').innerHTML =  value;
                               getFormDistance();
                               if( $('body').hasClass("modal-open") )
                                   $('body').modalmanager('loading');
                               TotalPriceHesapla();
                          }else{
                                            //alert(er.error_occurred + " " + er.refresh );
                                            //location.reload(true);
                          }
                      }); // get direction iki sonu
                      

                      // ways ler için oluştur
                      /// ways request
                       
                      for (var i = 0, n = findExpected.length; i < findExpected.length; i++) {
                           if(findExpected[i]  != ""){
                               
                                (function(way,callback){
                                    request = { origin: way[1],
                                                destination: way[2],
                                                travelMode: google.maps.TravelMode.DRIVING   };
                                    directionsService.route(request, function(response, status) {
                                                    if (status == google.maps.DirectionsStatus.OK) {
                                                        
                                                         var result  = response,
                                                             total   = 0, minute = 0, text = "" ,
                                                             myroute = result.routes[0];
                                                             
                                                             var total = myroute.legs[0].distance.value;
                                                             var minute = parseInt(myroute.legs[0].duration.value);
                                                             var hour = Math.floor(minute/3600)  ,
                                                                 min = Math.ceil((minute % 3600) / 60);
                                                             total = total / 1000.0;
                                                             var   priceDivider = 10,
                                                                   time         = hour + er.saatS + min + er.dakikaS ,
                                                                   price        = ( total / priceDivider ).toFixed(0) ,
                                                                   max          = ( (total / priceDivider) + range ).toFixed(0); 
                                                                      
                                                             setExpectedPrices(  { origin:way[1], destination:way[2], distance:total, time: time,  price:price, max:max }  );
                                                    }else{
                                                                //alert(er.error_occurred + " " + er.refresh );
                                                                //location.reload(true);
                                                    }
                                    }); 
                                 })(findExpected[i],  function(){ //console.log( JSON.stringify( locations, null,4) );  console.log('geocoding finished');
                                                           });
                           }
                      };

                     


             }
             google.maps.event.addDomListener(window, 'load', initialize());   

          }/* Map draw sonu */

        
        /** Kontrollerin başlangıcı
        ====================================****///

          function HataMesaj(id, type, title, text){
               text = jQuery.trim(text);   
               if( $(".msgGrowl-container").find(".msgGrowl").length  < 4 ){
                    $.msgGrowl ({
                        element: $(id).parent(),
                        type: type,   //$(this).attr ('data-type') // info success warning error
                        title: title,
                        text:  text.charAt(0).toUpperCase() + text.slice(1)
                    });
             }
          }
          function Hata(id, text ) {
            text = jQuery.trim(text);   
            var error = '<div id="alert" class="alert alert-dismissable alert-danger"> '
                         + ' <button type="button" class="close" data-dismiss="alert">&times;</button> '     
                                          +'<strong>Opps.. </strong> ' +  text.charAt(0).toUpperCase() + text.slice(1)
                                     +'</div>';
             id.parent().addClass('has-error')
                   .append(error); 
              setTimeout(function() {
                id.parent().removeClass( "has-error", 3000 );
                 id.parent().find('#alert').remove();
               }, 3000 );
        }
        function HataInput(id){
             id.parent().addClass('has-error');
             setTimeout(function() { id.parent().removeClass( "has-error", 3000 )} , 4000);                   
        } 
        function SayiKontrol(id){
          if( isNaN(id.val()) == true  || id.val() == ""){ 
                    id.parent().addClass('has-error');
                    setTimeout(function() { id.parent().removeClass( "has-error", 3000 )} , 4000);
                    return false;
          } else {
              return true;
          }
        }
       function FillKontrol(id,mesaj){
            if ( id.val() == "" || id.val() == "0" ) {
                Hata(id,mesaj);
                return false;
            } else {
                return true;
            }
        }
        function CheckBoxKontrol(id,mesaj){
              if( id.prop('checked') == true){
                  return true;
              }
              else{
                   Hata(id.parent(), mesaj);
                   return false;
              }
        }
        function SelectKontrol(id,mesaj){
            if ( id.val() == "" || id.val() == "0" ) {
                Hata(id.parent().parent(),mesaj);
                return false;
            } 
            else {
                return true;
            }
        }
        /*
        function strcmp ( str1, str2 ) {
              str1 = str1.trim();
              str2 = str2.trim();
              return ( ( str1 == str2 ) ? 0 : ( ( str1 > str2 ) ? 1 : -1 ) );
        } 
       */
       function ConvertableInteger(value){
          if( isNaN(value) == true  || value == ""){ 
                return false;
            } else {
                return true;
            }
        }
     
       function IntegerKontrol(id,mesaj){
          if( isNaN(id.val()) == true  || id.val() == ""){ 
                HataMesaj('body','error','Uyarı',mesaj);
                return false;
            } else {
                return true;
            }
        }
        function LengthKontrol(id,length,mesaj){
          if(  id.val().length >= parseInt(length)) { 
                return true;
            } else {
                 Hata(id,mesaj);
                return false;
            }
        }
        /***** Kontrollerin sonu 
        ==================================****/

  })(jQuery);
     