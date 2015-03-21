//making two ajax calls on the server
//one for doc details and one for his empty days


function add_doc_box(div_id)
{ 
$.getJSON( "JSON/appointment.json", function( value ) {

   
  console.log(value);
	
	
});

}


function create_appointment_header(value,div_id){
var div_box='	<span class="btn btn-default" disabled>'+value.date+'</span>';
return div_box;
}
	
function create_appointment_button(value,div_id){


var div_box = '<button class="btn vd_btn vd_bg-green" type="button"><a class="time_button" href="fill_form.html?doc_id=doc_id&date=18-3&&time=7-45 ">7:15 PM</a></button>';
	
	  
	  $(div_id).append(div_box);
	  return div_box;




}
