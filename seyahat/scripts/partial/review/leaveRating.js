       
   /// SOURCE application_file/views/review/

    /**********************  leaveRating.php  *****************************/ 
        $(function(){
            
            $(window).scroll(function(){                                                           // window on scroll run the function using jquery and ajax 
                        var WindowHeight = $(window).height();                                     // get the window height 
                        if($(window).scrollTop() +1 >= $(document).height() - WindowHeight){       // check is that user scrolls down to the bottom of the page 
                            var LastDiv = $("#result").find(".message:last"),                      // get the last div of the dynamic content using ":last" 
                                start   = LastDiv.data("start"), 
                                name = $( "#inputName" ),
                                dataName    = LastDiv.data("where");                                   // get the data-count of the last div 
                            if( LastDiv.length > 0 &&  strcmp( "name", dataName ) == 0 ){
                               if( strcmp( start.toString()  , "0" ) != 0 ){
                                      $("#loader").html( loader ); 
                                      $.ajax({ 
                                               type: "POST",
                                               url: base_url + "user/getUsers/"+start,
                                               data: { name:name.val() },
                                               cache: false,
                                               success: function(answer){
                                                    //alert(answer);  
                                                    setTimeout( function(){ $("#loader").html("") }, 1000 );
                                                    result = JSON.parse(  answer  );  
                                                    if     ( strcmp(result.status ,'success') == 0 ){ setTimeout( function(){WriteAllUserAppend ( result.user_list )},1000 )} // show bottom alert 
                                                    else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj     (  er.error_occurred )} // show bottom alert
                                                    else                                            { HataMesaj     (  er.error_send     )} // show bottom alert   
                                               },
                                               error: function(){ HataMesaj   (  er.error_send   ); } 
                                      });
                                }
                               // else
                               //      HataMesaj("son"); 
                            }   
                        }
                        return false;
            });

            $( "#buttonWithName" ).on('click',function(){
                   var  name = $( "#inputName" ),
                        boolValid = true;
         
                        boolValid = boolValid && FillKontrolParent(name, er.blank_name);
                        if( boolValid ){
                        	var url = "user/getUserWithName",
                        	    data = { name:name.val() };  
                        	$('body').modalmanager('loading');    
                            $.ajax({         
                                    type: "POST", 
                                    url:  base_url + url, 
                                    dataType: "text",  
                                    cache:false,
                                    data: data,
                                    success: function(answer) { 
                                        //if( strcmp(enviroment, 'development') == 0  )
                                        //     alert(answer );
                                        var result = JSON.parse( answer );
                                        if     ( strcmp(result.status ,'success') == 0 ){ WriteAllUser( result.user_list );  
                                                                                          $( "#buttonWithName" ).prop('disabled', true); 
                                                                                        } // show bottom alert 
                                        else if( strcmp(result.status ,'mistake') == 0 ){ $( "#result"  ).html(  result.text     )} // show bottom alert
                                        else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   (  result.text     )} // show bottom alert
                                        else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   (  result.message  )} // show top
                                        else                                            { HataMesaj   (  er.error_send   )} // show bottom alert  
                                    },
                                    error : function() {  HataMesaj( er.error_occurred )      },
                                    complete: function(){  $('body').modalmanager('loading'); } 
                            });
                        }
                    return false;       
            });

            $( "#buttonWithTel" ).on('click',function(){
                   var  tel = $( "#inputTel" ),
                        boolValid = true;
         
                        boolValid = boolValid && PhoneKontrol(tel, invalid_tel);
                        if( boolValid ){
                        	var url = "user/getUserWithTel",
                        	    data = { tel:tel.val() };  
                        	$('body').modalmanager('loading');    
                            $.ajax({         
                                    type: "POST", 
                                    url:  base_url + url, 
                                    dataType: "text",  
                                    cache:false,
                                    data: data,
                                    success: function(answer) { 
                                        if( strcmp(enviroment, 'development') == 0  )
                                             alert(answer );
                                        var result = JSON.parse( answer );
                                        if     ( strcmp(result.status ,'success') == 0 ){ WriteAllUser( result.user_list );
                                                                                          $( "#buttonWithTel" ).prop('disabled', true);  
                                                                                         } // show bottom alert 
                                        else if( strcmp(result.status ,'mistake') == 0 ){ $( "#result"  ).html(  result.text     )} // show bottom alert
                                        else if( strcmp(result.status ,'fail'   ) == 0 ){ HataMesaj   (  result.text     )} // show bottom alert
                                        else if( strcmp(result.status ,'error'  ) == 0 ){ HataMesaj   (  result.message  )} // show top
                                        else                                            { HataMesaj   (  er.error_send   )} // show bottom alert  
                                    },
                                    error : function() {  HataMesaj( er.error_occurred )      },
                                    complete: function(){  $('body').modalmanager('loading'); } 
                            });
                        }
                    return false;    
            });

            $( '#inputName').on('change',function(){
            	      $( "#buttonWithName" ).prop('disabled', false); 
            });
            
            $( '#inputTel').on('change',function(){
            	      $( "#buttonWithTel" ).prop('disabled', false); 
                      var val1 = $(this).val();
                      var array = val1.split(' ');
                      var val =''; 
                      for (var i = 0; i < array.length; i++) {
                          val += array[i];
                       }; 
                      var p0 =  '0',
                          p1 =  val.substring(1,4).trim(),
                          p2 =  val.substring(4,7).trim(),
                          p3 =  val.substring(7,9).trim(),
                          p4 =  val.substring(9,11).trim();
                      if( IntegerKontrol(p1) && IntegerKontrol(p2) && IntegerKontrol(p3) && IntegerKontrol(p4) ){ 
                          if( p1.length == 3 && p2.length == 3 && p3.length == 2 && p4.length == 2 )
                              $(this).val(p0+p1+" "+p2+" "+p3+" "+p4 );    
                          else{
                              HataMesaj( invalid_tel );
                              $(this).val("");
                           }   
                      }
                      else{
                          HataMesaj( invalid_tel );
                          $(this).val("");
                      } 
            });
            
            function WriteAllUser( users ){
                   if( users.length == 1 ){
                       window.location = base_url + "review/giveRating/"+ users[0].id;
                   }
                   else{
                   	    $( "#result"  ).html(""); 
                       for (var i = 0; i < users.length; i++) {
                       	     $( "#result"  ).append(   UserHTML(users[i]) );
                       };
                   }
            }

            function WriteAllUserAppend( users ){
                   var LastDiv = $("#result").find(".message:last"),
                       list    = $("#result").find(".message"); 
                   if( users.length == 0 ){
                         LastDiv.after(   "<div class='list-group-item  message' style='display:none' data-where='tel' data-start='0' ></div>" );
                   }
                   else{
                       for (var i = 0; i < users.length; i++) {
                             var user = users[i],
                                 flag = false; 
                             for (var j = list.length - 1; j >= 0; j--) {
                                    if( strcmp( $(list[j]).data("id"), user.id ) == 0 )
                                          flag = true; 
                             };
                               
                             if( flag == false ){
                                 LastDiv.after(   UserHTML(users[i]) );
                            }
                       };
                   }
            }
            

            function  UserHTML(user){
            	  var view =" <div class='list-group-item  message ' data-where='"+ user.where +"' data-start='"+ user.start +"' data-id='"+ user.id +"' >" + 
                               	"<a href='"+ base_url + "review/giveRating/"+ user.id +"' class='row one-thread' >"+
                                       "<div class='row'>"+
                                                          "<div class='col-lg-4' style='text-align: center;'>"+
                                                               "<img alt='"+ user.alt+"' title='"+ user.alt+"'  class='tip pic-img' src='"+ user.foto +"' style='width: 50px; height: 60px' height='60' width='50'>"+
                                                          "</div>"+
                                                          "<div class='col-lg-8 name' style='text-align: center; padding-top:10px'>"+
                                                             "<div class='row' >"+ user.name  + "</div>"+
                                                             "<div class='row' >"+ user.surname + "</div>"+
                                                             "<div class='row age' > "+ user.age +" </div>"+
                                                          "</div>"+    
                                       "</div>"+
                                  "</a>"+          
                              "</div>";
                 return view; 	
            }

        });

    /******************** End of the leaveRating.php **********************/