/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $('body [effect=tooltip]').tooltip();

});
/* $('.paging').click(function (e) {
 /!*  var page = $(this).attr("value");
 alert(page);*!/
 var param = $("#form_ddreport").serializeArray();
 param.push({name: "page_no", value: $(this).attr("value")});
 // console.log(param);
 $.ajax({
 type: 'POST',
 url: "<?php //echo base_url().'reports/device_data_detail_report';?>"  ,
 data: param,
 success: function(resp){
 $("#middle_container").html(resp);
 }
 });

 }
 );*/

$(document).delegate(".report-box .pagination_link", "click", function (e) {
    var page = $(this).attr("value");
    //alert(page);
    paginationCall(page);
});

$(document).delegate(".report-box #page", "focusout", function (e) {
    var page = $(this).attr("value");
    paginationCall(page);
});

$(document).delegate(".report-box .per_page", "change", function (e) {
    $("#page").attr("value", 1);
    submitForm();
});

$(document).delegate('.report-box body [effect=tooltip]', 'mouseenter mouseleave', function (event) {
    if (event.type == 'mouseenter') {
        $(this).tooltip('show');
    } else {
        $(this).tooltip('hide');
    }
});


// });

function ajax_report(url, data, callback) {
   // alert(url);
   // alert(data);
   // alert(callback);
    hideTooltip();
    ajaxLoaderOverlay($(".report-box"));
    $.ajax({
        url: url + "/" + $.now(),
        type: "POST",
        data: data,
        success: callback
    }).fail(function () {
        console.log('failed to retrieve data from server.');
    });
}

function settblResponse(response) {
    removeOverlay();
    $("#action").val('');
    $("#middle_container").hide().html(response).fadeIn("slow");
    $('.search-field-dropdown').trigger('change');
    attachTooltip();
}

function paginationCall(page) {
    if (page > 0) {
        $("#page").attr("value", page);
        submitForm();
    }
}

function submitForm() {

    var uri = $(location).attr('href');
    //alert(uri);
    var lm = uri.split('/').reverse()[0];
    switch(lm)
    {
        case'secondary_sales_details_view':  val = $("#secondary_sales_view");break;
        case'primary_sales_view_details': val = $("#primary_sales_view");break;
       /* case'device_data_report': val = $("#form_ddreport");break;
        default  : val = $("#form_ntfdetails");break;*/
    }

    var parama = val.serializeArray();
   // console.log(parama);
    var pages = $("#front_listing_form").serializeArray();
    console.log(pages);
    var data= $.merge( $.merge( [], pages ), parama );
    //console.log(data);
    var url = $("#front_listing_form").attr("action");
   // alert(url);
    ajax_report(url, data, settblResponse);
}

function attachTooltip() {
    $('body [effect=tooltip]').tooltip();
}

function hideTooltip() {
    $('body [effect=tooltip]').tooltip('hide');
}

function ajaxLoaderOverlay(el) {
    var height = el.height();
    var width = el.width();
    var position = el.position();
    position.left;
    position.top;
    var overlay = $('#ajax_loader').css({
        'background': 'url(' + loaderImage + ') no-repeat scroll center center #CCCCCC',
        'display': "block",
        'height': height,
        'width': width,
        'opacity': 0.7,
        'top': position.top,
        'left': position.left,
        'position': 'absolute',
        'z-index': 5
    });
}

function removeOverlay() {
    $("#ajax_loader").removeAttr('style');
}

