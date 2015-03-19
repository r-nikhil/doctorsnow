			$(document).ready(function(){
var person;
$("#login-submit").click(function(){
  
  
  var username=$("#email").val();
  var password=$("#password").val();
  
   person = {
            username: username,
            password: password,

        };
		
		
  $.ajax({
   type: "POST",
   url: "../backend/index.php/login_doctor",
data: person,
   success: function(html){    
if(html=='true')    {
//$("#add_err").html("right username or password");
window.location="dashboard.php";
}
else    {
$("#vd_login-error").css('display', 'inline', 'important');
$("#vd_login-error").html("Wrong username or password");
}
   },
   beforeSend:function()
   {
$("#vd_login-error").css('display', 'inline', 'important');
$("#vd_login-error").html("Loading...")
   }
  });
return false;
});
});