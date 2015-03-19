			$(document).ready(function(){

$("#login-submit").click(function(){
  username=$("#email").val();
  password=$("#password").val();
  $.ajax({
   type: "POST",
   url: "../backend/index.php/login_doctor",
data: "username="+username+"&password="+password,
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