
$(document).ready(function(){

var base_url="../";
var url,encodedata;

var doc_id = getUrlVars()["id"];
console.log(doc_id);
var doc_data="";
console.log("local 11 storage",doc_data);
  
 if ( 0 ) {
 //if localstorage exists and doc_profiles isset
 
 data=JSON.parse(localStorage.doc_profiles);
 console.log(data);
  for (i = 0; i < data.length; i++) {
  if(data[i].id == doc_id){
  console.log(data[i].id+" "+doc_id)
  doc_data = data[i];}
    }
	
	console.log("local 11 storage",doc_data);
populate_fields(doc_data);
}
else
  {  
  //doc_data=load_doc_data(doc_id);
  url=base_url+'api/v1/doctors/'+doc_id;
  console.log(url);
get_ajax_data(url, function(data)
{
var response_object = JSON.parse(data);
//console.log(response_object.query_result);
doc_data= response_object.query_result;
//var fill_html=generate_thumbnails(response_object.query_result);
console.log("server 11 storage",doc_data);

populate_fields(doc_data);
});
}




function populate_fields(doc_data){



//getting values from the textfields

//first the left widget
 
  $("#pic_name").html("Dr. "+doc_data[0].doctor_name);
 $("#clinic").html(doc_data[0].docclinic); 
 $("#writeup").html(doc_data[0].docwriteup); 
  
  
  $("#fname").html(doc_data[0].doc_fname); 
  $("#lname").html(doc_data[0].doc_lname); 
  $("#city").html(doc_data[0].docadd); 
  $("#mobile").html(doc_data[0].doc_mobile); 
  $("#charges").html(doc_data[0].doccharges); 
  $("#experience").html(doc_data[0].docexp); 
   
  console.log("hello");
  $("#address").html( doc_data[0].docadd) ;
  $("#clinic_name").html( doc_data[0].docclinic) ;
  $("#pincode").html(doc_data[0].docpin) ;
  $("#charges").html(doc_data[0].doccharges) ;
  $("#degrees").html(doc_data[0].docdegrees)  ;
  $("#college").html(doc_data[0].doccollege) ;
  //$("#experience").html(doc_data[0].docexp) ;
  $("#memberships").html(doc_data[0].docmember) ;
  $("#writeup").html(doc_data[0].docwriteup);

  
  var experience = get_exp(doc_data[0].docexp);
  //console.log(experience);
   $("#exp_details").html(experience);
   
    var doccollege = get_exp(doc_data[0].doccollege);
   $("#doccollege").html(doccollege);
}





});


function get_exp(exp)
{
var html="";
var res = exp.split(",");
for(i=0;i<res.length;i++)
{
html+='<li class="mgbt-xs-10"> <span class="menu-icon vd_green"><i class="fa  fa-circle-o"></i></span> <span class="menu-text">'+res[i]+'</span> </li>';
}
return html;
}


