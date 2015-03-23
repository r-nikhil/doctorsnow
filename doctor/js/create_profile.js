$.getScript("js/ajax_rest.js", function(){console.log("loaded");});

var base_url="../";
var url,encodedata;

$(document).ready(function(){


doc_id=localStorage.doc_id; //get from local storage
 
url=base_url+'api/v1/doctors/'+doc_id;
console.log(url);
get_ajax_data(url, function(data)
{
var response_object = JSON.parse(data);
console.log(response_object.query_result);
doc_data= response_object.query_result;
//var fill_html=generate_thumbnails(response_object.query_result);
//console.log("server storage",doc_data);

//getting values from the textfields
  $("#speciality").val(doc_data[0].docspecial); 
  console.log("hello");
  $("#address").val( doc_data[0].docadd) ;
  $("#clinic_name").val( doc_data[0].docclinic) ;
  $("#pincode").val(doc_data[0].docpin) ;
  $("#charges").val(doc_data[0].doccharges) ;
  $("#degrees").val(doc_data[0].docdegrees)  ;
  $("#college").val(doc_data[0].doccollege) ;
  $("#experience").val(doc_data[0].docexp) ;
  $("#memberships").val(doc_data[0].docmember) ;
  $("#writeup").val(doc_data[0].docwriteup);
  
  

$("#submit-profile").click(function(){

 var time="";
   $(function(){
      
    
        var val = [];
     $("input[type=checkbox]:checked").each(function() {
          time += $(this).val()+",";
        });

    });
console.log("time"+time);

});


  //getting values from the textfields
  speciality=$("#speciality").val();
  clinicname=$("#clinic_name").val();
  address=$("#address").val();
   pincode=$("#pincode").val();
  charges=$("#charges").val();
  degrees=$("#degrees").val();
  college=$("#college").val();
  experience=$("#experience").val();
  memberships=$("#memberships").val();
  writeup=$("#writeup").val();
  time=time;
 
  
  //encoding JSON
  encode=JSON.stringify({
        "speciality": speciality,
        "address": address,
        "pincode": pincode,
        "charges": charges,
        "clinicname": clinicname,
        "memberships": memberships,
        "degrees": degrees,
        "college": college,
        "experience": experience,
        "writeup": writeup,
        "doc_id": doc_id,
        "doc_time": time
       
        });
		
url=base_url+'api/v1/doctors/create_profile';


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

