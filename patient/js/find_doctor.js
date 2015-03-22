$.getScript("js/ajax_rest.js", function(){console.log("loaded");});

var base_url="../";
var url,encodedata;

var cat_array = ["physician", "cardiologist","Nutriotinist"];


$(document).ready(function(){
var fill_html=generate_categories(cat_array);
//console.log($('#middle_content').html);
document.getElementById('middle_content').innerHTML =fill_html;
//console.log(fill_html);
});



function get_doctors(type_id)
{
url=base_url+'api/v1/getdoctors/'+type_id;
console.log(url);
get_ajax_data(url, function(data)
{
var response_object = JSON.parse(data);
console.log(response_object.query_result);

//now filling html from here
var fill_html=generate_thumbnails(response_object.query_result);
localStorage.setItem("doc_profiles", JSON.stringify(response_object.query_result));
console.log("storage"+localStorage.doc_profiles);
document.getElementById('middle_content').innerHTML =fill_html;
});
 
}


function generate_thumbnails(arr)
{
 
	var html = "";
    for (i = 0; i < arr.length; i++) {
        html += '<li onclick="get_doctor_profile(' + (arr[i].id) + ')"><a href=profile.html?id='+(arr[i].id) +'> <div class="menu-icon"><img alt="example image" src="img/avatar/avatar.jpg"></div>' +
' <div class="menu-text"> '+arr[i].doctor_name  +'<div class="menu-info">  <div class="menu-date">'+arr[i].experience +'years of experience</div>   '+
 '<div class="menu-date">'+	arr[i].writeup +'</div>   </div></div> </a></li>';
    }
    var final_html = categories_html(html);
    return final_html;

}


function generate_categories(arr) {
    var html = "";
    for (i = 0; i < arr.length; i++) {
        html += '<li onclick="get_doctors(' + (i+1) + ')"><div class="menu-icon"><span class="btn vd_btn category_round-btn mgr-10 fa fa-user-md fa-fw" "></span></div> <div class="menu-text category-text" style="font-weight: bold"> ' + arr[i] + '</div>   </li>';
    }
    var final_html = categories_html(html);
    return final_html; }

function categories_html(category_html) {
    var html_start = ' <div class="row">    <div class="col-md-12">  <div class="content-grid column-xs-2 column-sm-4">  <ul class="list-wrapper">';
    var html_end = ' </ul> </div> </div>  </div>';
    return html_start + category_html + html_end; }

		  
	
	
	
	
	