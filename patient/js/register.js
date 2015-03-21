$.getScript("js/ajax_rest.js", function(){});

var base_url="../";
var url,encodedata;

$(document).ready(function(){

$("#submit-register").click(function(){

  //getting values from the textfields
  firstname=$("#firstname").val();
  lastname=$("#lastname").val();
   mobile=$("#phone").val();
  email=$("#email").val();
  password=$("#password").val();
  
  //encoding JSON
  encode=JSON.stringify({
        "firstname": firstname,
        "lastname": lastname,
        "mobile": mobile,
        "email": email,
        "password": password
       
        });
		
url=base_url+'api/v1/register_patient';

if(password.length>0)
{
post_ajax_data(url,encode, function(data)
{
console.log(data);
var response_object = JSON.parse(data);

$("#show_message").addClass("alert alert-success");
$("#show_message").html(response_object.message);
});
}  
	

});

});

