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
		
  url=base_url+'api/v1/register_doctor';




if(password.length>0)
{
post_ajax_data(url,encode, function(data)
{
console.log(data);
});
}  
		
  
  
  

});

});


function handleResponse(data){

var arr = $.map(data, function(el) { return el; });
console.log(data);
console.log(arr);

}




function post_ajax_data(url, encodedata, success)
{
$.ajax({
type:"POST",
url:url,
data :encodedata,
restful:true,
contentType: 'application/json',
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
handleResponse(data);
},
error:function(data){
console.log("ajax_error");
console.log(data);
}
});
}