/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $('body [effect=tooltip]').tooltip();

});

$(document).delegate(".report-box .pagination_link", "click", function (e) {
    var page = $(this).attr("value");
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

    //console.log(response);

    removeOverlay();
    $("#action").val('');
    try{
        //response = "test";
        $("#middle_container").hide().html(response).fadeIn("slow");
    } catch(err){
        alert(err);
    }

    $("#middle_container_product").empty();
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
  //  alert(uri);
    var lm = uri.split('/').reverse()[0];
    var val='';
    switch(lm)
    {
        case'primary_sales_view_details': val = $("#primary_sales_view");break;
        case'secondary_sales_details_view':  val = $("#secondary_sales_view");break;
        case'set_rol': val = $("#rol_limit");break;
        case'company_current_stock': val = $("#add_company_current_stock");break;
        case'credit_limit': val = $("#add_user_credit_limit");break;
        case'physical_stock': val = $("#add_physical_stock");break;
        case'invoice_received_confirmation': val = $("#invoice_confirmation");break;
        case'sales_view': val = $("#view_ishop_sales");break;
        case'schemes_view': val = $("#view_schemes");break;
        case'all': val = $("#order_approval");break;
        case'dispatched': val = $("#order_approval");break;
        case'pending': val = $("#order_approval");break;
        case'reject': val = $("#order_approval");break;
        case'order_status': val = $("#order_status");break;
        case'po_acknowledgement': val = $("#po_acknowledgement");break;
        case'prespective_order': val = $("#prespective_order");break;
        case'target': val = $("#target");break;
        case'budget': val = $("#budget");break;
        case'all_material_request': val = $("#all_material_request");break;
        case'material_request': val = $("#material_request");break;
        case'retailer_compititor_view': val = $("#retailer_compititor_view");break;
        case'distributor_compititor_view': val = $("#distributor_compititor_view");break;
        case'activity_approval': val = $("#activity_approval");break;
       /* default  : val = $("#form_ntfdetails");break;*/
    }


    var pages = $("input#page").val();
    if(pages>$(".last-page-number").text()){
        pages = $(".last-page-number").text();
    }

    var data = val.serializeArray();

    //console.log(val);
   // return false;
    data.push({name: "page", value:pages});

    var url = val.attr("action");
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

