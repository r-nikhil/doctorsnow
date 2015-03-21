var cat_array = ["physician", "cardiologist","Nutriotinist"];


$(document).ready(function(){


var fill_html=generate_categories(cat_array);
console.log($('#middle_content').html);
document.getElementById('middle_content').innerHTML =fill_html;
console.log(fill_html);

});

function generate_categories(arr) {
    var html = "";
    for (i = 0; i < arr.length; i++) {
        html += '<li onclick="get_doctors(' + i + ')"><div class="menu-icon"><span class="btn vd_btn category_round-btn mgr-10 fa fa-user-md fa-fw" "></span></div> <div class="menu-text category-text" style="font-weight: bold"> ' + arr[i] + '</div>   </li>';
    }
    var final_html = categories_html(html);
    return final_html; }

function categories_html(category_html) {
    var html_start = ' <div class="row">    <div class="col-md-12">  <div class="content-grid column-xs-2 column-sm-4">  <ul class="list-wrapper">';
    var html_end = ' </ul> </div> </div>  </div>';
    return html_start + category_html + html_end; }