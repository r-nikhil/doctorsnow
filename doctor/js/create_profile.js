$.getScript("js/ajax_rest.js", function(){});

var base_url="../";
var url,encodedata;

$(document).ready(function(){

$("#submit-profile").click(function(){

  //getting values from the textfields
  speciality=$("#speciality").val();
  address=$("#address").val();
   pincode=$("#pincode").val();
  charges=$("#charges").val();
  degrees=$("#degrees").val();
  college=$("#college").val();
  experience=$("#experience").val();
  memberships=$("#memberships").val();
  writeup=$("#writeup").val();
  doc_id=$("#doc_id").val(); //get from local storage
  
  //encoding JSON
  encode=JSON.stringify({
        "speciality": speciality,
        "address": address,
        "pincode": pincode,
        "charges": charges,
        "degrees": degrees,
        "college": charges,
        "experience": charges,
        "writeup": charges,
        "doc_id": doc_id
       
        });
		
url=base_url+'api/v1/create_profile';


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

