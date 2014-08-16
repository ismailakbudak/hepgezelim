
    
    // source application_file/views/profil/
   
    /********************************  dashboard.php *********************************************/
      (function($){
             $(window).load(function(){
                 $("ol.progtrckr").each(function(){
                     $(this).attr("data-progtrckr-steps", 
                                 $(this).children("li").length);
                      var array = $(this).children("li"),
                          level = $(this).data("level");
                     for (var i = 0; i < array.length; i++) {
                         if( i + 1 <= level ) 
                             $(array[i]).removeClass("progtrckr-todo").addClass("progtrckr-done");
                     };
                 });
             })
             function update( name, direct_url ){
                 var data = {  element: name },
                        url = 'profil/updateAlerts',
                        result = JSON.parse( AjaxSendJson(url,data) );   
                        if( strcmp(result.status ,'success') == 0 )      {  window.location = base_url + direct_url }
                        else if( strcmp(result.status ,'mistake') == 0 ) { Hatamesaj(  result.text )  }
                        else if( strcmp(result.status ,'error') == 0 )   { Hatamesaj( result.message );    }    
                        else if( strcmp(result.status ,'fail') == 0 )    { Hatamesaj( er.error_occurred  ) }
                        else{ HataMesaj( er.error_send ) }   
             }

             $( "#car_notify" ).on('click',function(){
                   update("arac","profil/profile/cars");
                   return false;
             }); 
             $( "#no_car" ).on('click',function(){
                   update("aracagain","profil"); 
                   return false;
             });
             $( "#tercih" ).on('click',function(){
                   update("tercih","profil/profile/preference"); 
                   return false;
             }); 
             $( "#bio" ).on('click',function(){
                   update("bio","profil/profile/info"); 
                   return false;
             }); 
             $( "#photo" ).on('click',function(){
                   update("photo","profil/profile/foto"); 
                   return false;
             })
             $( "#phone" ).on('click',function(){
                   update("phone","profil/profile/verification"); 
                   return false;
             })
             $( "#email" ).on('click',function(){
                   update("email","profil/profile/verification"); 
                   return false;
             })
             $( "#face" ).on('click',function(){
                   update("face","profil/profile/verification"); 
                   return false;
             })
             $( "#extra" ).on('click',function(){
                   update("extra","profil"); 
                   return false;
             })

             $(".readed-warning").on('click',function(){
                             var id = $( this ).parent().data("id");
                             var data = {id:id }; 
                             var url = "profil/warning_readed_process";  
                             var result = JSON.parse( AjaxSendJson(url,data) ); 
                             if     ( strcmp(result.status ,'success') == 0 ){   BasariMesaj( result.text   );  
                                                                                  $( this ).closest(".warn-close").slideUp(); } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                             return false;
              });

       })(jQuery);   

    /***************************** End of the dashboard.php *********************************************/