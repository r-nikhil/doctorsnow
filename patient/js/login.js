$.getScript("js/ajax_rest.js", function(){});

var base_url="../";
var url,encodedata;

$(document).ready(function(){

$("#login-submit").click(function(){

  //getting values from the textfields
  username=$("#email").val();
  password=$("#password").val();
  
  //encoding JSON
  encode=JSON.stringify({
        "username": username,
        "password": password
        });
		
  url=base_url+'api/v1/login_patient';




if(password.length>0)
{
post_ajax_data(url,encode, function(data)
{
var response_object = JSON.parse(data);
if(response_object.status)
{
$("#show_message").addClass("alert alert-success");
$("#show_message").html(response_object.message);
}
else
{
$("#show_message").addClass("alert alert-warning");
$("#show_message").html("Oops, something went wrong. Please try after some time");
}
});
}  

});

});







