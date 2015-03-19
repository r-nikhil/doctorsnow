var base_url="localhost/doctorsnow/";
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
		
  url=base_url+'api/login_patient';




if(password.length>0)
{
post_ajax_data(url,encode, function(data)
{
$.each(data.updates, function(i,data)
{
var html="<div class='stbody' id='stbody"+data.update_id+"'><div class='stimg'><img src='"+data.profile_pic+"' class='stprofileimg'/></div><div class='sttext'><strong>"+data.name+"</strong>"+data.user_update+"<span id='"+data.update_id+"' class='stdelete'>Delete</span></div></div>";
$("#mainContent").prepend(html);
$('#update').val('').focus();
});
});
}  
		
  
  
  

});

});


function formToJSON() {
    return JSON.stringify({
        "username": $("#email").val(),
        "password": $("#password").val()
        });
}



function post_ajax_data(url, encodedata, success)
{
$.ajax({
type:"POST",
url:url,
data :encodedata,
dataType:"json",
restful:true,
contentType: 'application/json',
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
success.call(this, data);
},
error:function(data){
alert("Error In Connecting");
}
});
}