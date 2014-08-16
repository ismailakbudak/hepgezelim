    
    /**********************  block.php  *********************************/
        (function($){
              
              $( ".delete-block" ).on('click',function(event){
                        var block_id      = $(this).parent().data('block_id'),
                            data = { block_id: block_id  },
                            url = 'message/removeBlock',
                            result = JSON.parse( AjaxSendJson(url,data) );  
                        if     ( strcmp(result.status ,'success') == 0 ){ window.location = base_url + "message/block" } // show bottom alert 
                        else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   (  result.text     )} // show bottom alert
                        else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   (  result.message  )} // show top
                        else                                            { HataMesaj   (  er.error_send   )} // show bottom alert  
                        return false; 
              })
                          

        })(jQuery); 
    /******************** End of  the block.php *************************/