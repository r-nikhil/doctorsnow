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
		
  url=base_url+'api/v1/login_doctor';




if(password.length>0)
{
post_ajax_data(url,encode, function(data)
{
console.log(data);
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

function handleResponse(data){

var arr = $.map(data, function(el) { return el; });
console.log(data);
console.log(arr);

}

function renderList(data) {
	
	
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
console.log("success");
handleResponse(data);
},
error:function(data){
console.log("error");
console.log(data);
}
});
}