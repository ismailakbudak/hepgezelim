    

    /// SOURCE application_file/views/messages/
 
  
    /**********************  messageFoot.php  *********************************/
        (function($){
                $(active_message).addClass("active");
                 
                 CapitiliazeFirst(  [ "#inputMessageBlock", "#inputMessage", "#inputMessageBlockSent" ]  );

                
                if( strcmp('0', message_number) != 0 )
                       $( "#inbox" ).append("<span class='badge unread'>"+ message_number +"</span>");
                else
                       $( "#inbox" ).append("<span class='badge'>0</span>");
                  
                 
                if( strcmp('0', message_number2) != 0 )
                       $( "#send" ).append("<span class='badge unread'>"+ message_number2 +"</span>");
                else
                       $( "#send" ).append("<span class='badge'>0</span>");
               

         })(jQuery);  
    /******************** End of  the messageFoot.php *************************/  

