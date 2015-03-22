var base_url="../";
var url,encodedata;

var doc_id = getUrlVars()["id"];
console.log(doc_id);
var doc_data="";

 if (typeof(Storage)!=="undefined" && localStorage.getItem("doc_profiles") ) {
 //if localstorage exists and doc_profiles isset
 
 data=JSON.parse(localStorage.doc_profiles);
 console.log(data);
  for (i = 0; i < data.length; i++) {
  if(data[i].id == doc_id){
  console.log(data[i].id+" "+doc_id)
  doc_data = data[i];}
    }
	
	console.log("local storage",doc_data);
  
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
console.log("server storage",doc_data);
});

}


