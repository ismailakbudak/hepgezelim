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
**    EXPLAIN   : You can use this code block free 
**                BUT LEARN, DEVELOP AND SHARE  
**                THIS IS MY PRINCIPLE
**    
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////


// Jquery begin
(function($){
        
        

        $('#search').on("click",function(){
              var origin         = jQuery.trim(  $( "#pac-input" ).val() ).replace(" ", "+"),
                  destination    = jQuery.trim(  $( "#pac-input2" ).val() ).replace(" ", "+"),
                  originLat      = place1.x; //.toFixed(9),
                  originLng      = place1.y; //.toFixed(9),
                  destinationLat = place2.x; //.toFixed(9),
                  destinationLng = place2.y; //.toFixed(9),
                  window.location =  base_url + "offers/redirect/?origin=" + origin +"&lat="+originLat+"&lng="+originLng+"&destination="+destination +"&dLat="+destinationLat+"&dLng="+destinationLng +"&originStatus="+place1.status + "&destinationStatus="+place2.status +"&range=0-2";       
       });

       function setPlace1(value){
             place1.x = value.lat();
             place1.y = value.lng();
             place1.status = 1;
       }
       
       function setPlace2(value){
             place2.x = value.lat();
             place2.y = value.lng();
             place2.status = 1;
       }


      function initialize() {
              var mapOptions = {
                center: new google.maps.LatLng(39.0,35.0),
                scrollwheel: false,
                zoom: 5
              };
              var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
              var infowindow = new google.maps.InfoWindow();
              var marker = new google.maps.Marker({
                map: map
              });
              var input = document.getElementById("pac-input"), 
                  input2 = document.getElementById("pac-input2");

              var types = "";
              map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
            
              var autocomplete = new google.maps.places.Autocomplete(input);
              autocomplete.bindTo('bounds', map);
  
              // ikinci için
              var autocomplete2 = new google.maps.places.Autocomplete(input2);
              autocomplete2.bindTo('bounds', map);

              google.maps.event.addListener(autocomplete, 'place_changed', function() {
                         infowindow.close();
                         marker.setVisible(false);
                         var place = autocomplete.getPlace();
                         if (!place.geometry) {
                            return;
                         }
                         map.setCenter(place.geometry.location);
                          
                         // Get location 
                         setPlace1(place.geometry.location);

                         map.setZoom(8);
                         marker.setIcon(({
                              url: place.icon,
                              size: new google.maps.Size(71, 71),
                              origin: new google.maps.Point(0, 0),
                              anchor: new google.maps.Point(17, 34),
                              scaledSize: new google.maps.Size(35, 35)
                             }));
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                        var address = '';
                        if (place.address_components) {
                          address = [
                            (place.address_components[0] && place.address_components[0].short_name || ''),
                            (place.address_components[1] && place.address_components[1].short_name || ''),
                            (place.address_components[2] && place.address_components[2].short_name || '')
                          ].join(' ');
                        }
                        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                        infowindow.open(map, marker);
                        if(input2.value == ""){
                             setTimeout(function(){
                                 $('#pac-input2').focus();
                             },10);
                         }
                         else{
                           setTimeout(makeDirection(),100);
                           $('#pac-input2').focus();
                         }
             });
             // ikinci çin
            google.maps.event.addListener(autocomplete2, 'place_changed', function() {
                       infowindow.close();
                       marker.setVisible(false);
                       var place = autocomplete2.getPlace();
                       if (!place.geometry) {
                         return;
                       }
                   
                       map.setCenter(place.geometry.location);
                       
                       // Get location2
                       setPlace2(place.geometry.location);
                       
                       map.setZoom(8);
                       marker.setIcon(({
                              url: place.icon,
                              size: new google.maps.Size(71, 71),
                              origin: new google.maps.Point(0, 0),
                              anchor: new google.maps.Point(17, 34),
                              scaledSize: new google.maps.Size(35, 35)
                       }));
                       marker.setPosition(place.geometry.location);
                       marker.setVisible(true);
                       var address = '';
                       if (place.address_components) {
                         address = [
                           (place.address_components[0] && place.address_components[0].short_name || ''),
                           (place.address_components[1] && place.address_components[1].short_name || ''),
                           (place.address_components[2] && place.address_components[2].short_name || '')
                         ].join(' ');
                       }
                       infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                       infowindow.open(map, marker);
                       setTimeout(makeDirection(),100);
                       
            });
            function makeDirection(){
                     var directionsDisplay;
                     var directionsService = new google.maps.DirectionsService();
                     var start = document.getElementById('pac-input').value,
                         end = document.getElementById('pac-input2').value;
         
                     directionsDisplay = new google.maps.DirectionsRenderer();
                     map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                     directionsDisplay.setMap(map);
                     var request = {
                         origin:start,
                         destination:end,
                         travelMode: google.maps.TravelMode.DRIVING
                     };
                     directionsService.route(request, function(response, status) {
                          if (status == google.maps.DirectionsStatus.OK) {
                              directionsDisplay.setDirections(response);
                              $("#search").prop('disabled', false);
                          }
                     });
            }
            function typeGet() {
               var types = ['geocode'];
               autocomplete.setTypes(types);
            }
            typeGet();

      }
      google.maps.event.addDomListener(window, 'load', initialize());
  
    

    
    //$('#pac-input').focus();
    $('#search-result').hide('fast');
    $('#pac-input, #pac-input2').on("click",function(){
         //$('#search-result').hide();
         //$('#map-canvas').slideDown();
    });
    
     
     $("#search").prop('disabled', false); 
         
    // button disabled and enabled begin
    $('#pac-input, #pac-input2').on("keyup",function(){

          if( $('#pac-input').val() == '' || $('#pac-input2').val() == '' ){
              $("#change-direct").prop('disabled', true);
              if( strcmp( $('#pac-input').val() , "" ) != 0 )
                    $("#search").prop('disabled', false); 
              else
                  $("#search").prop('disabled', true); 
               
          }   
          else {
               $("#change-direct").prop('disabled', false);
               $("#search").prop('disabled', false);
          }
    });// button disabled and enabled end
    

   // change-direct begin
   $('#change-direct').on('click',function(){
        
        $('#search-result').hide();
        $('#map-canvas').slideDown( {
            duration: 300,
            complete: function(){
                  var  start = $('#pac-input').val(),
                       end = $('#pac-input2').val(),
                       temp = place1;
                  
                  place1 = place2;
                  place2 = temp;       
                  $('#pac-input').val(end);
                  $('#pac-input2').val(start);
                  
                  var mapOptions = { center: new google.maps.LatLng(39.0,33.845688), scrollwheel:false, zoom: 6 },
                      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions),
                      infowindow = new google.maps.InfoWindow(),
                      marker = new google.maps.Marker({  map: map }),
                      directionsDisplay,
                      directionsService = new google.maps.DirectionsService(),
                      start = document.getElementById('pac-input').value,
                      end = document.getElementById('pac-input2').value,
                      request = {
                          origin:start,
                          destination:end,
                          travelMode: google.maps.TravelMode.DRIVING
                      };

                  directionsDisplay = new google.maps.DirectionsRenderer();
                  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                  directionsDisplay.setMap(map);
                  directionsService.route(request, function(response, status) {
                       if (status == google.maps.DirectionsStatus.OK) {
                           directionsDisplay.setDirections(response);
                       }
                  });

             } // end of complete
        });// end of map-canvas slideDown() method
        

    }); // change-direct end

})(jQuery);// Jquery end