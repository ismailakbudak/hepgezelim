
 (function($){

            /*************************  Bitti   **********************************/
            //$( "[rel=popover]" ).popover('show');
            CapitiliazeFirst(  [ "#pac-input", "#pac-input2" ]  );  
            
            $( ".reset" ).on('click',function(){
                  var time1 = optionSaatMin; // $(this).data('min'),
                      time2 = optionSaatMax; // $(this).data('max');
                  
              
                  obj.slider('setValue',[time1,time2]);
                  setTimeValues( time1, time2 );
                  if( time1 == 24 )
                      time1 = 00;
                  if( time2 == 24 )
                      time2 = 00;
                  if( time1 < 10 )
                      time1 = '0'+time1 ;
                  if( time2 < 10 )
                      time2 = '0'+ time2;
                  time1 = time1 + ":00";
                  time2 = time2 + ":00";
                  
                  $(".trip-time #yaz" ).text( time1 + ' - ' +time2 );
                  $( "input[name='checkboxPrice']" ).prop('checked', true);
                  $( "#datepicker" ).val("");
                  $( "input[type='radio'][value='all']" ).prop('checked', true);  
                  
                  applyShowHide();   
                  setTimeout( function(){ setOfferCount() }, 100);
                  
                  return false;
            });


            $(window).scroll(function( event ){  // window on scroll run the function using jquery and ajax 
                event.preventDefault();

                var WindowHeight = $(window).height();                                     
                if($(window).scrollTop() + 200 >= $(document).height() - WindowHeight){        
                    var array    = $("#allOffers").find(".offer"),
                        LastDiv  = $("#allOffers").find(".offer:last"),                       
                        finish   = $("#allOffers").data("finish"),
                        offset   = LastDiv.data("offset"),
                        tempOffset, tempFinish  ;                                       
                    if( LastDiv.length > 0   ){
                          if( strcmp( finish.toString()  , "1" ) != 0 ){
                              if( strcmp( $("#loader").html(), "" ) == 0 ){
                                 //  console.log("loader boş");   
                                   $("#loader").html( loading ); 
                                   $.ajax({ 
                                            type: "POST",
                                            dataType: "text", 
                                            url: base_url + "offers/searchAjax/"+offset+ get,
                                            data: {  },
                                            cache: false,
                                            success: function(answer){
                                               //  console.log(answer);
                                                 setTimeout( function(){ $("#loader").html("") }, 2000 );
                                                 result = JSON.parse(  answer  );
                                                 if     ( strcmp(result.status ,'success') == 0 ){ setTimeout( function(){ WriteAll ( result.results )},1000 )} // show bottom alert 
                                                 else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj     (  er.error_occurred )} // show bottom alert
                                                 else                                            { HataMesaj     (  er.error_send     )} // show bottom alert   
                                            },
                                            error: function(){ HataMesaj   (  er.error_send   ); } 
                                   });
                              }else{
                             //   console.log("loader dolu" );
                              }
                           }
                           //else
                           //     HataMesaj("son"); 
                    }
                }
                return false;
            });       
            
            function WriteAll( results ){
                //console.log( "Gelen tekliflerin uzunluğu :"+ results.offers.length);
                
                 var offers = results.offers;
                 var count =  parseInt( $( "input[name='optionsRadiosLevel'][value='all']" ).next().find('.badge').text() );
                 if( offers.length > 0 ){  
                      for (var i = 0; i < offers.length; i++) {
                             $( "#allOffers").append(   offers[i] );
                      };
                       count =  count + parseInt(offers.length);
                       $( "#offerCount" ).text(count);
                       $( "#offerCountBottom" ).removeClass('none-display');
                       $( "#offerCountBottom" ).find('.count').text(count); 
                         
                      $('[rel=popover]').popover();
                 }else{
                      $("#allOffers").data('finish','1');
                 }
                 
                 //console.log(results.trip_time);
                 if(  results.trip_time.min < optionSaatMin )
                     optionSaatMin =  results.trip_time.min;
                 if( results.trip_time.max > optionSaatMax )
                     optionSaatMax = results.trip_time.max;                  
                  var time1 = optionSaatMin, 
                      time2 = optionSaatMax; 
                  obj.slider('setValue',[time1,time2]);
                  if( time1 == 24 )
                      time1 = 00;
                  if( time2 == 24 )
                      time2 = 00;
                  if( time1 < 10 )
                      time1 = '0'+time1 ;
                  if( time2 < 10 )
                      time2 = '0'+ time2;
                  time1 = time1 + ":00";
                  time2 = time2 + ":00";
                  $(".trip-time #yaz" ).text( time1 + ' - ' +time2 );
                  

                 //console.log(results.countLevel);
                 // hepsi için
                 $( "input[type='radio'][value='all']" ).next().find('.badge').text(count);
                 var level  = results.countLevel, 
                     $level, $badge, temp;
                 for (var i = 1; i <= 5; i++) {
                     if(  typeof( level[i] ) == 'number'  ){
                           $level = $( "input[name='optionsRadiosLevel'][value='"+i+"']" );
                           $badge = $level.next().find('.badge');
                           temp = parseInt( $badge.text() ) +  level[i];
                           $badge.text(temp);
                           $level.parent().parent().removeClass('none-display'); 
                     }  
                 };

                 //console.log(results.countPrice);
                 var prices  = results.countPrice,
                     $low    = $( ".prices" ).find(".low").find('.badge'),
                     $middle = $( ".prices" ).find(".middle").find('.badge'),
                     $high   = $( ".prices" ).find(".high").find('.badge');
                 $low.text( parseInt( $low.text() ) + prices['low'] );
                 $middle.text( parseInt( $middle.text() ) + prices['middle'] );
                 $high.text( parseInt( $high.text() ) + prices['high'] );


                 //console.log(results.countPhoto);
                 var photos    = results.countPhoto,
                     $withP    = $( "input[name='optionsRadiosPhoto'][value='with']" ),
                     $withoutP = $( "input[name='optionsRadiosPhoto'][value='without']" );
                 temp    =  parseInt( $withP.next().find('.badge').text() ) + photos['with'];
                 $withP.next().find('.badge').text( temp );
                 temp     =  parseInt( $withoutP.next().find('.badge').text() ) + photos['without'];
                 $withoutP.next().find('.badge').text( temp );
                 if( photos['with'] != 0 )
                     $withP.parent().parent().removeClass('none-display'); 
                 if( photos['without'] != 0 )
                     $withoutP.parent().parent().removeClass('none-display'); 


                 //console.log(results.countCarComfort);
                 var comforts  = results.countCarComfort,  
                     $car, $badge;
                 comforts[3] = comforts[3] + comforts[4] + comforts[5];
                 comforts[4] = comforts[4] + comforts[5];
                 for (var i = 3; i <= 5; i++) {
                     if(  typeof( comforts[i] ) == 'number' && comforts[i] != 0 ){
                           $car = $( "input[name='optionsRadiosCar'][value='"+i+"']" );
                           $badge = $car.next().find('.badge');
                           temp = parseInt( $badge.text() ) +  comforts[i];
                           $badge.text(temp);
                           $car.parent().parent().removeClass('none-display'); 
                     }  
                 };

                 //console.log(results.countDate);
                 var dates  = Array();
                 dates[0] =  results.countDate['today'];
                 dates[1] =  results.countDate['1days'];
                 dates[2] =  results.countDate['2days'];
                 dates[3] =  results.countDate['3days'];
                 dates[4] =  results.countDate['4days'];
                 dates[5] =  results.countDate['5daysOver'];
                 var $date, $badge;
                 for (var i = 0; i <= 5; i++) {
                     if(  typeof( dates[i] ) == 'number' && dates[i] != 0  ){
                           $date = $( "input[name='optionsRadiosDate'][value='"+i+"']" );
                           $badge = $date.next().find('.badge');
                           temp = parseInt( $badge.text() ) +  dates[i];
                           $badge.text(temp);
                           $date.parent().parent().removeClass('none-display'); 
                     }  
                 };


                 //console.log(results.countTimes);
                 var times  = Array();
                 times[0] =  results.countTimes['00_04'];
                 times[1] =  results.countTimes['04_08'];
                 times[2] =  results.countTimes['08_12'];
                 times[3] =  results.countTimes['12_16'];
                 times[4] =  results.countTimes['16_20'];
                 times[5] =  results.countTimes['20_24'];
                 var $time, $badge;
                 for (var i = 0; i <= 5; i++) {
                     if(  typeof( times[i] ) == 'number' && times[i] != 0  ){
                           $time = $( "input[name='optionsRadiosTime'][value='"+i+"']" );
                           $badge = $time.next().find('.badge');
                           temp = parseInt( $badge.text() ) +  times[i];
                           $badge.text(temp);
                           $time.parent().parent().removeClass('none-display'); 
                     }  
                 };

                // console.log(results.countAverage);
                 var averagesMy  = results.countAverage;
                 var averages    = Array(); 
                 averages[5] = averagesMy['five'];  
                 averages[4] = averagesMy['4_5'] + averages[5];
                 averages[3] = averagesMy['3_4'] + averages[4];
                 averages[2] = averagesMy['2_3'] + averages[3];
                 var $avg, $badge;
                 for (var i = 2; i <= 5; i++) {
                     if(  typeof( averages[i] ) == 'number' && averages[i] != 0  ){
                           $avg = $( "input[name='optionsRadiosAverage'][value='"+i+"']" );
                           $badge = $avg.next().find('.badge');
                           temp = parseInt( $badge.text() ) +  averages[i];
                           $badge.text(temp);
                           $avg.parent().parent().removeClass('none-display'); 
                     }  
                 }; 

            } 
         
            $( "#createAlert" ).on('click',function(){
                   
                      $.ajax({ 
                               type: "POST",
                               dataType: "text", 
                               url: base_url + 'alert/createAlert',
                               data: {  date:$( "#datepickerAlert" ).val() },
                               cache: false,
                               success: function(answer){
                                    if( strcmp(enviroment, 'development') == 0){
                                          alert(answer);
                                    }
                                    result = JSON.parse(  answer  );
                                    if     ( strcmp(result.status ,'success') == 0 ){ BasariMesaj   ( result.text        )} // show bottom alert 
                                    else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj     ( result.text        )} // show bottom alert
                                    else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj     ( result.message     )} // show bottom alert
                                    else                                            { HataMesaj     (  er.error_send     )} // show bottom alert   
                               },
                               error: function(){ HataMesaj   (  er.error_send   ); } 
                      });

            });

            if( place2.status != 1 || strcmp("", destination) == 0 )
                  $("#change-direct").prop('disabled', true);

           // for time interval display
           function setTimeValues( min , max ){
                optionTimemin = min * 60 * 60;
                optionTimemax = max * 60 * 60;
           } 

           var obj =  $('#time-slider').slider()
                             .on('slide', function(ev){
                               var time1 = ev.value[0];
                               var time2 = ev.value[1];
                               if( time1 == 24 )
                                   time1 = 00;
                               if( time2 == 24 )
                                   time2 = 00;
                                     
                               if( time1 < 10 )
                                   time1 = '0'+time1 ;
                               if( time2 < 10 )
                                   time2 = '0'+ time2;
                               time1 = time1 + ":00";
                               time2 = time2 + ":00";
                               $(".trip-time #yaz" ).text( time1 + ' - ' +time2 );
                               
                               setTimeValues(  ev.value[0] ,  ev.value[1] );

                               time1 = ev.value[0] * 60*60;
                               time2 = ev.value[1] * 60*60;
                               
                               var  array = $( "#allOffers" ).find('.list-group-item'),
                                    val, 
                                    $id; 
                               for (var i = 0; i < array.length; i++) {
                                     val = $( array[i] ).find('a').data( 'trip_time' );
                                     $id =  $( array[i] );
                                     $id.removeClass( 'no-trip_time' );
                                     if(  time1 <= val && val <= time2 ){
                                        $id.removeClass( 'no-trip_time' )
                                     }else{
                                        $id.addClass( 'no-trip_time' )
                                     }
                               }; 
                               setOfferCount();
           }); 
          /*
           var  dayNames  = [  "Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
                 dayNamesMin = [ "Pz", "Pt", "Sa", "Çş", "Pş", "Cm", "Ct" ],
                 monthNames = [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
                 nextText = "Sonraki",
                 prevText = "Önceki";
           if( strcmp( er.lang, "en" ) == 0 ){
                 dayNames  = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
                 dayNamesMin = [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"  ];
                 monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
                 nextText = "Next";
                 prevText = "Prev";
           }
           */
           $( "#datepickerAlert" ).datepicker({ minDate: 0, maxDate: "+3M +10D", dateFormat: "yy-mm-dd", dayNames: dayNames, dayNamesMin: dayNamesMin, monthNames: monthNames, prevText: prevText,  nextText: nextText   } );
           $( ".show-date" ).on('click',function(){
                   $( "#dateAlert" ).slideToggle();  
           });
           function setOfferCount(){
                  var array = $( "#allOffers" ).find('.list-group-item'),
                      count = 0;
                  for (var i = 0; i < array.length; i++) {
                        $id =  $( array[i] );
                        if( !$id.hasClass("no-level") &&
                            !$id.hasClass("no-price") &&
                            !$id.hasClass("no-photo") &&
                            !$id.hasClass("no-car") &&
                            !$id.hasClass("no-date") &&
                            !$id.hasClass("no-time") &&
                            !$id.hasClass("no-avg") &&
                            !$id.hasClass("no-trip_date") &&
                            !$id.hasClass("no-trip_time") ) {
                            count++;   
                        }        
                  };  
                  $( "#offerCount" ).text(count);
                  $( "#offerCountBottom" ).find('.count').text(count); 
                  if( count >= 5 ){
                        $( "#offerCountBottom" ).removeClass('none-display');
                  }else{
                        $( "#offerCountBottom" ).addClass('none-display');
                  }    
                  OfferMesaj(count );
           }
           
           // Right bottom alert-success message
           function OfferMesaj( text){
                    text = jQuery.trim(text);   
                    var dil   = "Bilgilendirme !",
                        offer = " teklif listelendi.";
                    if( strcmp( er.lang, "en" ) == 0 ){
                          dil = "Information !",
                          offer = "  offers listed.";
                    }
                    if(  $(".msgGrowl-container").find(".msgGrowl").length  <= 1 ){  
                                $.msgGrowl ({
                                    element: $('body').parent(),
                                    type:  'info',   //$(this).attr ('data-type') // info success warning error
                                    title: dil,
                                    text:  text.charAt(0).toUpperCase() + text.slice(1) + offer // capitialize first character
                                });
                    }
           } 

           $( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+3M +10D", dateFormat: "yy-mm-dd", dayNames: dayNames, dayNamesMin: dayNamesMin, monthNames: monthNames, prevText: prevText,  nextText: nextText   } )
                             .on('change',function(){  dateChange() }); 
           $( ".trip-date .date-delete" ).on('click',function(){  $( "#datepicker" ).val(""); dateChange(); });       
           function dateChange(){
                 var val =  $( "#datepicker" ).val(),
                     array = $( "#allOffers" ).find('.list-group-item'),
                     dataDate, $id;
                      
                 if( strcmp( "", val ) == 0 ){
                    for (var i = 0; i < array.length; i++) {
                              $id =  $( array[i] );
                              $id.removeClass('no-trip_date');
                    };  
                 }else{
                        for (var i = 0; i < array.length; i++) {
                              $id =  $( array[i] );
                              dataDate = $id.find('a').data('trip_date');
                              $id.removeClass('no-trip_date');
                              if(  strcmp( dataDate , val) == 0 )
                                  $id.removeClass('no-trip_date');
                              else
                                  $id.addClass('no-trip_date');  
                        };  
                 }
                 setOfferCount();
           }
           // price check box change
           $( "input[name='checkboxPrice']" ).on('click',function(){
                  var val = $(this).data("price"),
                      array = $( "#allOffers" ).find('.list-group-item'),
                      list   = $( "input[name='checkboxPrice']" ),
                      prices = Array(),
                      val , 
                      $id, 
                      price;
                  
                 // console.log( "Price " + val);
                  for (var i = 0; i < list.length; i++) {
                      if( $(list[i]).prop('checked') ){
                         val = $(list[i]).data('price');
                         prices.push(val);
                       //  console.log( "işaretli " + val );
                      } 
                  };
                  for (var i = 0; i < array.length; i++) {
                        val = $( array[i] ).find('a').data('price_class');
                        $id =  $( array[i] );
                        $id.addClass("no-price");
                        for (var j = 0; j < prices.length; j++) {
                                price = prices[j];
                                if(  strcmp( val, price) == 0 ){
                                   $id.removeClass("no-price")
                                }
                              //  console.log( j+ " İNLİST P:" + price + " : "+ val ); 
                         };        
                  }; 
                  setOfferCount();
           });
           // Average group show hide
           $( "input[name='optionsRadiosAverage']" ).on('click',function(){
                  var option     = $(this).val(),
                      class_name = "no-avg",
                      data_name  = 'avg',
                      array      = $( "#allOffers" ).find('.list-group-item'),
                      val, 
                      $id; 
                 for (var i = 0; i < array.length; i++) {
                       val = $( array[i] ).find('a').data( data_name );
                       $id =  $( array[i] );
                       $id.removeClass( class_name );
                       if( strcmp("all" , option ) == 0 ){
                            $id.removeClass( class_name );
                       }else{
                            if(  option <= val ){
                               $id.removeClass( class_name )
                            }else{
                               $id.addClass( class_name )
                            }
                       }
                        //console.log( " İNLİST Average :" + option + " : "+ val );
                 }; 
                 setOfferCount();
           });
           // Time group show hide
           $( "input[name='optionsRadiosTime']" ).on('click',function(){
                  var option     = $(this).val(),
                      class_name = "no-time",
                      data_name  = 'time_group',
                      array      = $( "#allOffers" ).find('.list-group-item'),
                      val, 
                      $id; 
                 for (var i = 0; i < array.length; i++) {
                       val = $( array[i] ).find('a').data( data_name );
                       $id =  $( array[i] );
                       $id.removeClass( class_name );
                       if( strcmp("all" , option ) == 0 ){
                            $id.removeClass( class_name );
                       }else{
                            if(  option == val ){
                               $id.removeClass( class_name )
                            }else{
                               $id.addClass( class_name )
                            }
                       }
                       // console.log( " İNLİST Time :" + option + " : "+ val );
                 }; 
                 setOfferCount();
           });
           // Date group show hide
           $( "input[name='optionsRadiosDate']" ).on('click',function(){
                  var option     = $(this).val(),
                      class_name = "no-date",
                      data_name  = 'date_group',
                      array      = $( "#allOffers" ).find('.list-group-item'),
                      val, 
                      $id; 
                 for (var i = 0; i < array.length; i++) {
                       val = $( array[i] ).find('a').data( data_name );
                       $id =  $( array[i] );
                       $id.removeClass( class_name );
                       if( strcmp("all" , option ) == 0 ){
                            $id.removeClass( class_name );
                       }else{
                            if(  option == val ){
                               $id.removeClass( class_name )
                            }else{
                               $id.addClass( class_name )
                            }
                       }
                       // console.log( " İNLİST Date :" + option + " : "+ val );
                 }; 
                 setOfferCount();
           });
           // car show hide
           $( "input[name='optionsRadiosCar']" ).on('click',function(){
                  var option     = $(this).val(),
                      class_name = "no-car",
                      data_name  = 'car',
                      array      = $( "#allOffers" ).find('.list-group-item'),
                      val, 
                      $id; 
                 for (var i = 0; i < array.length; i++) {
                       val = $( array[i] ).find('a').data( data_name );
                       $id =  $( array[i] );
                       $id.removeClass( class_name );
                       if( strcmp("all" , option ) == 0 ){
                            $id.removeClass( class_name );
                       }else{
                            if(  option <= val ){
                               $id.removeClass( class_name )
                            }else{
                               $id.addClass( class_name )
                            }
                       }
                       // console.log( " İNLİST Car :" + option + " : "+ val );
                 }; 
                 setOfferCount();
           });
           // photo show hide
           $( "input[name='optionsRadiosPhoto']" ).on('click',function(){
                  var option     = $(this).val(),
                      class_name = "no-photo",
                      data_name  = 'photo',
                      array      = $( "#allOffers" ).find('.list-group-item'),
                      val, 
                      $id; 
                 for (var i = 0; i < array.length; i++) {
                       val = $( array[i] ).find('a').data( data_name );
                       $id =  $( array[i] );
                       $id.removeClass( class_name );
                       if( strcmp("all" , option ) == 0 ){
                            $id.removeClass( class_name );
                       }else{
                            if(  strcmp( val, option) == 0 ){
                               $id.removeClass( class_name )
                            }else{
                               $id.addClass( class_name )
                            }
                       }
                       // console.log( " İNLİST Photo :" + option + " : "+ val );
                 }; 
                 setOfferCount();
           });
           // level show hide
           $( "input[name='optionsRadiosLevel']" ).on('click',function(){
                  var level = $(this).val(),
                      array = $( "#allOffers" ).find('.list-group-item'),
                      val , $id; 
                 for (var i = 0; i < array.length; i++) {
                       val = $( array[i] ).find('a').data('level');
                       $id =  $( array[i] );
                       $id.removeClass("no-level");
                       if( strcmp("all" , level ) == 0 ){
                            $id.removeClass("no-level");
                       }else{
                            if( val == level ){
                               $id.removeClass("no-level")
                            }else{
                               $id.addClass("no-level")
                            }
                       }
                 }; 
                 setOfferCount();
           });
           
           $( "#sortBy .sort" ).on('click',function(){
           	      $( "#sorting").removeClass("none-display");
                  var  array = $( "#allOffers" ).find('.list-group-item'); 
                  if( array.length > 60 ){
                    	 $('body').modalmanager('loading');   
                  }
                  
                  for (var i = 0; i < array.length; i++){ 
                        $( array[i] ).removeClass("no-level")
                                     .removeClass("no-price")
                                     .removeClass("no-photo")
                                     .removeClass("no-car")  
                                     .removeClass("no-date") 
                                     .removeClass("no-time") 
                                     .removeClass("no-avg") 
                                     .removeClass("no-trip_date") 
                                     .removeClass("no-trip_time");
                  };                    
                  try{ 
                      var $id = $(this),
                          type = $id.data('sort');
                      if( $id.hasClass('active') ){
                          if( strcmp( type , "ASC" ) == 0 ){
                              $id.data('sort', 'DESC');
                              $id.find("i").removeClass("glyphicon-arrow-down").addClass("glyphicon-arrow-up");
                          }else{
                              $id.data('sort', 'ASC');
                              $id.find("i").removeClass("glyphicon-arrow-up").addClass("glyphicon-arrow-down");
                          } 
                      }else{
                         $( "#sortBy .sort" ).removeClass("active"); 
                         $id.addClass("active");
                      }
                      setTimeout(function(){sortList($id);},100);
                  }catch(err){
                    HataMesaj(er.error_occurred);
                  }  

                  return false;
           });
           // after the new arrange display data or hide
           function applyShowHide(){
                
                var   array      = $( "#allOffers" ).find('.list-group-item'),
                      list       = $( "input[name='checkboxPrice']" ),
                      trip_date  = $( "#datepicker" ).val(),
                      avg        = $( "input[name='optionsRadiosAverage']:checked" ).val(), 
                      time_group = $( "input[name='optionsRadiosTime']:checked" ).val(), 
                      date_group = $( "input[name='optionsRadiosDate']:checked" ).val(), 
                      car        = $( "input[name='optionsRadiosCar']:checked" ).val(), 
                      photo      = $( "input[name='optionsRadiosPhoto']:checked" ).val(), 
                      level      = $( "input[name='optionsRadiosLevel']:checked" ).val(), 
                      prices     = Array(),
                      tempValue, $id, $data ;
                      for (var i = 0; i < list.length; i++) {
                          if( $(list[i]).prop('checked') ){
                             val = $(list[i]).data('price');
                             prices.push(val);
                            // console.log( "Price işaretli :" + val );
                          } 
                      };
                      // geçiçi değerler
                      var dataPrice, dataLevel, dataPhoto, dataCar, dataDateGroup, dataAvg, dataDate ,dataTrip_time;
                      for (var i = 0; i < array.length; i++) {
                          $data         = $( array[i] ).find('a');
                          $id           = $( array[i] );
                          dataLevel     = $data.data( 'level');
                          dataPrice     = $data.data( 'price_class');
                          dataPhoto     = $data.data( 'photo' );
                          dataCar       = $data.data( 'car' );
                          dataDateGroup = $data.data( 'date_group' );
                          dataTimeGroup = $data.data( 'time_group' );
                          dataAvg       = $data.data( 'avg' );
                          dataDate      = $data.data('trip_date');
                          dataTrip_time = $data.data( 'trip_time' );
                          $id.removeClass( 'no-level' );
                          $id.addClass( 'no-price' );
                          $id.removeClass( 'no-photo' );
                          $id.removeClass( 'no-car'  );
                          $id.removeClass( 'no-date' );
                          $id.removeClass( 'no-time' );
                          $id.removeClass( 'no-avg' );
                          $id.removeClass('no-trip_date');
                          $id.removeClass( 'no-trip_time' );
                         
                          // for trip_time
                          if(  optionTimemin <= dataTrip_time && dataTrip_time <= optionTimemax ){
                             $id.removeClass( 'no-trip_time' );
                          }else{
                             $id.addClass( 'no-trip_time' );
                          }

                          // for trip_date
                          if( strcmp( "", trip_date ) == 0 ){
                               $id.removeClass('no-trip_date');
                          }else{
                               if(  strcmp( dataDate , trip_date) == 0 )
                                   $id.removeClass('no-trip_date');
                               else
                                   $id.addClass('no-trip_date');  
                          }  
                          // level için
                          if( strcmp("all" , level ) == 0 ){
                               $id.removeClass("no-level");
                          }else{
                               if( level == dataLevel ){
                                  $id.removeClass("no-level")
                               }else{
                                  $id.addClass("no-level")
                               }
                          }
                          // price için
                          for (var j = 0; j < prices.length; j++) {
                                tempValue = prices[j];
                                if(  strcmp( dataPrice, tempValue) == 0 ){
                                   $id.removeClass("no-price")
                                }
                               //console.log( j + " Reconstreuctor P:" + tempValue + " : "+ dataPrice ); 
                          };
                          // photo için
                          if( strcmp("all" , photo ) == 0 ){
                               $id.removeClass(  'no-photo' );
                          }else{
                               if(  strcmp( dataPhoto, photo) == 0 ){
                                  $id.removeClass(  'no-photo' )
                               }else{
                                  $id.addClass( 'no-photo' )
                               }
                          }
                          // comfort için
                          if( strcmp("all" , car ) == 0 ){
                               $id.removeClass( 'no-car' );
                          }else{
                               if(  car <= dataCar ){
                                  $id.removeClass(  'no-car'  )
                               }else{
                                  $id.addClass(  'no-car'  )
                               }
                          }
                          // date_group için
                          if( strcmp("all" , date_group ) == 0 ){
                               $id.removeClass( 'no-date' );
                          }else{
                               if(  date_group == dataDateGroup ){
                                  $id.removeClass( 'no-date' )
                               }else{
                                  $id.addClass( 'no-date' )
                               }
                          }
                          // for time_group
                          if( strcmp("all" , time_group ) == 0 ){
                               $id.removeClass( 'no-time' );
                          }else{
                                if(  time_group == dataTimeGroup ){
                                   $id.removeClass( 'no-time' )
                                }else{
                                   $id.addClass( 'no-time' )
                                }
                          }
                          // for average
                          if( strcmp("all" , avg ) == 0 ){
                               $id.removeClass( 'no-avg' );
                          }else{
                                if(  avg <= dataAvg ){
                                   $id.removeClass( 'no-avg' );
                                }else{
                                   $id.addClass( 'no-avg' );
                                }
                          }
               
                      }; 


                //console.log("Set display settings Level    : " + level  );
                //console.log("Set display settings Photo    : " + photo  );
                //console.log("Set display settings Car      : " + car  );
                //console.log("Set display settings Date grp : " + date_group  );
                //console.log("Set display settings Time     : " + time_group  );
                //console.log("Set display settings Avg      : " + avg  );
           }
           function sortList(  $id ) {
              
              try{  
                    var ul   = "allOffers"; 
                    var on   = $id.data('on');
                    var type = $id.data('sort');

                    if(typeof ul == "string")
                      ul = document.getElementById(ul);

                    var lis = ul.getElementsByTagName("LI");
                    var vals = [];
                    
                    for(var i = 0, l = lis.length; i < l; i++)
                       vals.push(lis[i].innerHTML);
                    
                    var boolValid = false;
                    if( strcmp( on , "date" ) == 0  ){
                        vals.sort(SortByDate); boolValid = true; }
                    else if ( strcmp( on , "price" ) == 0  ){
                        vals.sort(SortByPrice); boolValid = true; }
                    else if ( strcmp( on , "seat" ) == 0  ){
                        vals.sort(SortBySeat); boolValid = true; }
                    else if ( strcmp( on , "level" ) == 0  ){
                        vals.sort(SortByLevel); boolValid = true; }
                    else
                        boolValid = false;
                    if( boolValid  ){
                         if( strcmp( "DESC", type ) == 0 )
                             vals.reverse();
                         for(var i = 0, l = lis.length; i < l; i++)
                            lis[i].innerHTML = vals[i];
                         //console.log( "Tip : "+ on +" Sorted : " + type  );
                         $('[rel=popover]').popover();
                         applyShowHide();
                        
                         setTimeout( function(){ $( "#sorting").addClass("none-display");  
                                                   if( vals.length > 60 ){
                                                     $('body').modalmanager('loading');
                                                   }
                                                 }, 400 );
                        
                    }
                 }catch(err){
                    HataMesaj(er.error_occurred);
                 }   
           }
           //This will sort your array
           function SortByDate(a, b){
                 var aName = $(a).data('date');
                 var bName = $(b).data('date'); 
                 return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
           }
           function SortByPrice(a, b){
                 var aName = $(a).data('price');
                 var bName = $(b).data('price'); 
                 return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
           }
           function SortByLevel(a, b){
                 var aName = $(a).data('level');
                 var bName = $(b).data('level'); 
                 return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
           }
           function SortBySeat(a, b){
                 var aName = $(a).data('seat');
                 var bName = $(b).data('seat'); 
                 return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
           }


       })(jQuery);  

/*
function test(){
        function1('function1', function() {
            function2('function2');
        });
   
};

function function2(param) {
  alert(param);
} 

function function1(param, callback) {
   alert(param);
   callback();
} 
*/