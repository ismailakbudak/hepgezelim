window.fbAsyncInit=function(){FB.init({appId:"528537380594210",status:true,cookie:true,xfbml:true});FB.Event.subscribe("auth.authResponseChange",function(response){if(response.status==="connected");else if(response.status==="not_authorized")FB.login({scope:"email,user_birthday"});else FB.login({scope:"email,user_birthday"})})}; (function(d){var js,id="facebook-jssdk",ref=d.getElementsByTagName("script")[0];if(d.getElementById(id))return;js=d.createElement("script");js.id=id;js.async=true;js.src="//connect.facebook.net/"+facebook_lang+"/all.js";ref.parentNode.insertBefore(js,ref)})(document);function testAPI(){FB.api("/me",function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends=result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture"}})})} (function($){var face_proto_type={"id":"1000020585152011","birthday":"03/30/1991","email":"iso@aaa.com","first_name":"Test Tess ","gender":"male","last_name":"Akbudak Test","friends":"332","picture":"http://graph.facebook.com/100002058515201/picture?width=160&height=200"};$("#useFaceFoto").on("click",function(){FB.login(function(response){if(response.authResponse){$("body").modalmanager("loading");FB.api("/me",function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends= result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture?width=160&height=200";var face=response;var url="facebook/foto",data=face,result=JSON.parse(AjaxSendJson(url,data));$("body").modalmanager("loading");if(strcmp(result.status,"success")==0)window.location.reload(true);else if(strcmp(result.status,"fail")==0)HataMesaj(result.text);else if(strcmp(result.status,"error")==0)HataMesaj(result.text);else HataMesaj(er.error_send)}else{$("body").modalmanager("loading");HataMesaj(er.error_occurred)}})})}}, {scope:"email,user_birthday"});return false});$("#verfyFriends").on("click",function(){FB.login(function(response){if(response.authResponse){$("body").modalmanager("loading");FB.api("/me",function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends=result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture?width=160&height=200";var face=response;var url="facebook/verification";var result=JSON.parse(AjaxSendJson(url,face));$("body").modalmanager("loading"); if(strcmp(result.status,"success")==0)window.location.reload(true);else if(strcmp(result.status,"fail")==0)HataMesaj(result.text);else if(strcmp(result.status,"error")==0)HataMesaj(result.text);else HataMesaj(er.error_send)}else{HataMesaj(er.error_occurred);$("body").modalmanager("loading")}})})}},{scope:"email,user_birthday"});return false});$("#faceLogin").on("click",function(){var thisID=$(this);FB.login(function(response){if(response.authResponse){$("body").modalmanager("loading");FB.api("/me", function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends=result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture?width=160&height=200";var face=response;var url="facebook/login",data=face;var result=JSON.parse(AjaxSendJson(url,data));$("body").modalmanager("loading");if(strcmp(result.status,"login")==0)window.location=base_url;else if(strcmp(result.status,"not-active")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status, "ban")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"error")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"error2")==0)HataMesajModal(thisID,result.message);else HataMesajModal(thisID,er.error_send)}else{HataMesaj(er.error_occurred);$("body").modalmanager("loading")}})})}},{scope:"email,user_birthday"});return false});$("#faceLoginHeaderNonUser").on("click",function(){var thisID=$(this);FB.login(function(response){if(response.authResponse){$("body").modalmanager("loading"); FB.api("/me",function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends=result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture?width=160&height=200";var face=response;var url="facebook/login",data=face,result=JSON.parse(AjaxSendJson(url,data));$("body").modalmanager("loading");if(strcmp(result.status,"login")==0)window.location.reload(true);else if(strcmp(result.status,"not-active")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status, "ban")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"error")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"error2")==0)HataMesajModal(thisID,result.message);else HataMesajModal(thisID,er.error_send)}else{HataMesaj(er.error_occurred);$("body").modalmanager("loading")}})})}},{scope:"email,user_birthday"});return false});$("#faceSignupNewuser").on("click",function(){var thisID=$(this);FB.login(function(response){if(response.authResponse){$("#loading").modal(); FB.api("/me",function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends=result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture?width=160&height=200";var face=response;var url="facebook/signup",data=face;$.ajax({type:"POST",url:base_url+url,dataType:"text",cache:false,data:data,success:function(answer){if(strcmp(enviroment,"development")==0)alert(answer);var result=JSON.parse(answer);if(strcmp(result.status,"success")==0)window.location= base_url;else if(strcmp(result.status,"face_member")==0)BasariMesaj(result.text);else if(strcmp(result.status,"fail")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"emailusing")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"error")==0)HataMesajModal(thisID,result.message);else HataMesajModal(thisID,er.error_send)},error:function(){HataMesajModal(thisID,er.error_send)},complete:function(){$("#loading").modal("toggle")}})}else{HataMesaj(er.error_occurred); $("#loading").modal("toggle")}})})}},{scope:"email,user_birthday"});return false});$("#faceSignupHeaderNonuser").on("click",function(){var thisID=$(this);FB.login(function(response){if(response.authResponse){$("#loading").modal();FB.api("/me",function(response){FB.api("/"+response.id+"/friends",function(result){if(result.data){response.friends=result.data.length;response.picture="http://graph.facebook.com/"+response.id+"/picture?width=160&height=200";var face=response;var url="facebook/signup",data= face;$.ajax({type:"POST",url:base_url+url,dataType:"text",cache:false,data:data,success:function(answer){if(strcmp(enviroment,"development")==0)alert(answer);var result=JSON.parse(answer);if(strcmp(result.status,"success")==0)window.location.reload(true);else if(strcmp(result.status,"face_member")==0){$("#joinus").modal("toggle");setTimeout(function(){BasariMesaj(result.text)},1E3)}else if(strcmp(result.status,"fail")==0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"emailusing")== 0)HataMesajModal(thisID,result.text);else if(strcmp(result.status,"error")==0)HataMesajModal(thisID,result.message);else HataMesajModal(thisID,er.error_send)},error:function(){HataMesajModal(thisID,er.error_send)},complete:function(){$("#loading").modal("toggle")}})}else{HataMesaj(er.error_occurred);$("#loading").modal("toggle")}})})}},{scope:"email,user_birthday"});return false})})(jQuery);