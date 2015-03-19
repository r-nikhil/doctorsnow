$(document).ready(function(){


$("#login-submit").click(function(){
  username=$("#email").val();
  password=$("#password").val();
  
  var person = {
            username: $("#id-name").val(),
            password: $("#id-address").val(),

        }
  console.log("ready");
  
  $.ajax({
   type: "POST",
   url: "../backend/index.php/login_patient",
data: person,
   success: function(html){
 console.log("sent"+html);   
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
