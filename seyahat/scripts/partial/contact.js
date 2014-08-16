       
       /// SOURCE application_file/views/contact/

    /**********************  complain.php  *****************************/
    /*******************************************************************/
    /********************Begin the complain.php *************************/
       (function($){
              
             CapitiliazeFirst(  [  "#textAreacomplain" ]  );
             $( "#buttonSendComplain" ).on('click',function(){

                  var  user_id  = $( this ).data('id'),
                       complain = $( "#textAreacomplain" ).val(),
                       mail     = $( "#inputEmail2" ).val(),   
                       url      = "contact/saveComplain",
                       data     = { user_id: user_id, complain:complain, mail: mail   };
                  var result = JSON.parse( AjaxSendJson(url,data) );  
                      if     ( strcmp(result.status ,'success') == 0 ){   window.location = base_url + "contact/success2"  } // show bottom alert 
                      else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                      else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                      else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                      return false; 
             });

               
       })(jQuery);
    /******************** End of the complain.php **********************/     

    /********************** contact.php  *******************************/
    /*******************************************************************/
    /********************Begin the contact.php *************************/
       (function($){
 
             $( ".user-type" ).on('click',function(){
                  $( ".user-type" ).removeClass('active');
                  $( this ).addClass('active');
                  $( "#selectIssue" ).prop('disabled', false); 
                  return false;
             });

             var inputs = [ "#inputSubject", "#textAreaMesage", "#inputEmail", "#buttonSendContact"  ];
             $( "#selectIssue" ).on('change',function(){
                   if( $( this ).val() != 0 ){
                          $.each( inputs, function(index, value) {
                              $(value).prop('disabled', false); 
                          });  
                   }
                   else{
                          $.each( inputs, function(index, value) {
                              $(value).prop('disabled', true); 
                          });  
                   }
             });

             CapitiliazeFirst(  [ "#inputSubject", "#textAreaMesage" ]  );
             $( "#buttonSendContact" ).on('click',function(){

                  var  user    = $( ".users" ).find(".active").data('type'),
                       issue   = $( "#selectIssue" ).val(),
                       subject = $( "#inputSubject" ).val(),
                       message = $( "#textAreaMesage" ).val(),
                       mail    = $( "#inputEmail" ).val(),   
                       url     = "contact/saveMessage",
                       data    = { user:user, issue: issue, subject: subject, message:message, mail: mail  };
               
                       if( strcmp( issue , "0" ) != 0   ){
                             var result = JSON.parse( AjaxSendJson(url,data) );  
                             if     ( strcmp(result.status ,'success') == 0 ){   window.location = base_url + "contact/success" } // show bottom alert 
                             else if( strcmp(result.status ,'fail'   ) == 0 ){   HataMesaj( result.text     )} // show bottom alert
                             else if( strcmp(result.status ,'error'  ) == 0 ){   HataMesaj( result.message  )} // show top
                             else                                            {   HataMesaj( er.error_send   )} // show bottom alert  
                      }
                      else{  HataMesaj( error_issue ) }
                      return false; 
             });

               
       })(jQuery);    
    /******************** End of the contact.php ***********************/



    /********************** contact.php  *******************************/
    /*******************************************************************/
    /********************Begin the contact.php *************************/

 