$(function () {
    $('#form_month').datepicker({
        format: "yyyy-mm", // Notice the Extra space at the beginning
        autoclose: true,

        viewMode: "months",
        minViewMode: "months"
    }).on('changeDate', function(selected){
        $('#to_month').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_month').datepicker('setStartDate', startDate);
    });

});

$(function () {
    $('#to_month').datepicker({
        format: "yyyy-mm", // Notice the Extra space at the beginning
        autoclose: true,

        viewMode: "months",
        minViewMode: "months"
    });
});

var login_customer_type = $("input#login_customer_role").val();

if(login_customer_type == 8){
    var customer_selected = $("input#login_customer_id").val();
}


$("input.select_customer_type").on("click",function(){

    var validator = $( "#view_ishop_sales" ).validate();
    validator.resetForm();

    var customer_type_selected = $(this).val();
    // alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");

        $("div.distributor_checked_sales").css("display","none");
        $("div.retailer_checked_sales").css("display","block");

        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }

        $("div.sales_cont").empty();
        $("div.sales_product").empty();
        $("div.check_save_btn").css("display","none");

    }
    else if(customer_type_selected == "distributor"){
        $("div.retailer_data").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_checked_sales").css("display","block");
        $("div.retailer_checked_sales").css("display","none");


        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }
        $("div.sales_cont").empty();
        $("div.sales_product").empty();
        $("div.check_save_btn").css("display","none");
    }
});

$("select#distributor_geo_level").on("change",function(){

    var selected_geo_data = $(this).val();

    get_user_by_geo_data(selected_geo_data);

});



function get_user_by_geo_data(selected_geo_data){

    var checked_type = $('input[name=radio1]:checked').val();

    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(resp != 0){

                if(checked_type == "distributor"){
                    $("select#distributor_sales").empty();
                    $("select#distributor_sales").append('<option value="0">Select Distributor Name</option>');
                    $.each(resp, function (key, value) {
                        $('select#distributor_sales').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });
                    $("select#distributor_sales").selectpicker('refresh');
                }
                else {

                    $("select#retailer_sales").empty();

                    $("select#retailer_sales").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function (key, value) {

                        $('select#retailer_sales').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#retailer_sales").selectpicker('refresh');

                }
            }

        }
    });

}



function get_geo_fo_userdata(customer_selected,customer_type_selected){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_role" ).val();

    var url_seg = $("input.page_function" ).val();

    // alert(customer_selected+"==="+login_user_countryid+"==="+login_customer_type+"==="+customer_type_selected);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_geo_fo_userdata",
        data: {user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,customer_type_selected:customer_type_selected,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(customer_type_selected == "distributor"){

                $("div#distributor_checked_sales select.distributor_geo_level").empty();
                $("div#distributor_checked_sales select.distributor_geo_level").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#distributor_checked_sales select.distributor_geo_level").append('<option value="0">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#distributor_checked_sales select.distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#distributor_checked_sales select.distributor_geo_level").selectpicker('refresh');

                }

            }

            if(customer_type_selected == "retailer"){

                $("div#retailer_checked_sales select.geo_level_0").empty();
                $("div#retailer_checked_sales select.geo_level_0").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#retailer_checked_sales select.geo_level_0").append('<option value="0">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#retailer_checked_sales select.geo_level_0').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#retailer_checked_sales select.geo_level_0").selectpicker('refresh');
                }
            }
        }
    });
}


$("select#geo_level_0").on("change",function(){

    var selected_geo_id = $(this).val();
    get_lower_geo_by_parent_geo_physical_stock(selected_geo_id);
});

function get_lower_geo_by_parent_geo_physical_stock(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_role" ).val();
    var customer_selected = $("input#login_customer_id").val();
    var url_seg = $("input.page_function" ).val();
    var checked_type = $('input[name=radio1]:checked').val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lowergeo_from_uppergeo_data",
        data: {checkedtype:checked_type, user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,parent_geo_id:selected_geo_id,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(login_customer_type == 8) {

                if (checked_type == "retailer") {

                    $("div#retailer_checked_sales select#geo_level_1").empty();
                    $("div#retailer_checked_sales select#geo_level_1").selectpicker('refresh');

                    if (resp.length > 0) {

                        $("div#retailer_checked_sales select#geo_level_1").append('<option value="0">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#retailer_checked_sales select#geo_level_1').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#retailer_checked_sales select#geo_level_1").selectpicker('refresh');

                    }

                }
                else if (checked_type == "distributor") {

                    $("div#distributor_checked_sales select#distributor_geo_level").empty();
                    $("div#distributor_checked_sales select#distributor_geo_level").selectpicker('refresh');


                    if (resp.length > 0) {

                        $("div#distributor_checked_sales select#distributor_geo_level").append('<option value="0">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#distributor_checked_sales select#distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#distributor_checked_sales select#distributor_geo_level").selectpicker('refresh');

                    }

                }

            }
        }
    });

}

$("select#geo_level_1").on("change",function(){

    var selected_geo_data = $(this).val();
    get_user_by_geo_data(selected_geo_data);

});
$("select#distributor_sales").on("change",function(){

    var selected_id = $(this).val();
    get_retailer_by_distributor(selected_id);

});

function get_retailer_by_distributor(selected_id)
{
    var login_customer_type = $("input#login_customer_type" ).val();
    var login_user_countryid = $("input#login_customer_countryid").val();
    if(login_customer_type == 8){
        var distributor_id = selected_id;
    }
    else{
        var distributor_id = $("select#distributor_sales option:selected" ).val();
    }
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_retailers_by_distributor",
        data: {distributor_id:distributor_id, country:login_user_countryid},
        //dataType : 'json',
        success: function(resp){
            //console.log(resp);
            if(resp != 0){

                $("select#retailer_id").empty();

                $("select#retailer_id").append('<option value="0">Select Distributor Name</option>');

                $.each(JSON.parse(resp), function(key, value) {
                    $('select#retailer_id').append('<option value="' + value.id + '">' + value.display_name + '</option>');
                });

                $("select#retailer_id").selectpicker('refresh');

            }
            else{
                $("select#retailer_id").empty();
                $("select#retailer_id").selectpicker('refresh');
            }
        }
    });
}



$(document).ready(function(){
    var ishop_sales_view_validators = $("#view_ishop_sales").validate({
        ignore: ".ignore",
        rules: {
            from_month:{
                required: true
            },
            to_month:{
                required: true
            }
        }
    });

    $("#view_ishop_sales").on("submit",function(e){

        e.preventDefault();

        var param = $("#view_ishop_sales").serializeArray();

        var $valid = $("#view_ishop_sales").valid();
        if(!$valid) {
            ishop_sales_view_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/view_ishop_sales_details",
                data: param,
                dataType : 'html',
                success: function(resp){
                    $("#middle_container_product").empty();
                    $("#middle_container").html(resp);
                }
            });
            return false;
        }

    });

    $( ":input" ).on('change',function() {
        console.log(this);
        $(this).valid();
    });

    $('#download_csv').on('click',function(){

        var param = $("#view_ishop_sales").serialize();

        var $valid = $("#view_ishop_sales").valid();
        if(!$valid) {
            ishop_sales_view_validators.focusInvalid();
            return false;
        }
        else {
            var export_url = site_url + "ishop/sales_view_details_csv_report?" + param+"&page="+$("input#page").val();

            window.location.href = export_url;
        }
        return false;

    });
});



/*Get Sales Product Data*/
$(document).on('click', 'div.sales_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $('div.sales_cont').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

    var checked_type = $('input[name=radio1]:checked').val();
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/sales_product_details_view',
        data: {id: id,checkedtype:checked_type},
        success: function(resp){
            $("#middle_container_product").html(resp);
        }
    });

    $('#main').animate({
        scrollTop: $(document).height()
    }, 1000);
    return false;
});
/*Get Sales Data*/





 $(document).on('click', 'div.sales_cont .edit_i', function () {
 var id = $(this).attr('prdid');
     var checked_type = $('input[name=radio1]:checked').val();

 var invoice_no = $("div.invoice_no_"+id+" span.invoice_no").text();
 $("div.invoice_no_"+id).empty();
 $("div.invoice_no_"+id).append('<input type="hidden" name="checked_type" value="'+checked_type+'" /><input type="hidden" name="secondary_sales_detail[]" value="'+id+'" /><span class="invoice_no">'+invoice_no+'</span>');


 //Invoice Date

 //var invoice_date = $("div.invoice_date_"+id+" span.invoice_date").text();
 //$("div.invoice_date_"+id).empty();
 //$("div.invoice_date_"+id).append('<input id="invoice_date_'+id+'" type="text" name="invoice_date" value="'+invoice_date+'"/>');


 //PO Number

 var po_value = $("div.PO_no_"+id+" span.PO_no").text();
 $("div.PO_no_"+id).empty();
 $("div.PO_no_"+id).append('<input id="PO_no_'+id+'" type="text" class="PO_no" name="PO_no[]" value="'+po_value+'"/>');

 //Order Tracking No

 var order_tracking_no = $("div.order_tracking_no_"+id+" span.order_tracking_no").text();
 $("div.order_tracking_no_"+id).empty();
 $("div.order_tracking_no_"+id).append('<input id="order_tracking_no_'+id+'" type="text" name="order_tracking_no[]" value="'+order_tracking_no+'"/>');

     $(this).prop("disabled",true);
 return false;
 });


$(document).on('click', 'div.sales_product .edit_i', function () {
    var id = $(this).attr('prdid');
    var checked_type = $('input[name=radio1]:checked').val();
    //alert('in');
    var prd_sku = $(" div.prd_"+id+" span.prd_sku").text();
    var units = $(" div.units_"+id+" span.units").text();

    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";


    if(units == 'Box'){
        box_selected = "selected = 'selected'"
    }
    if(units == 'Packages'){
        package_selected = "selected = 'selected'"
    }
    if(units == 'Kg/Ltr'){
        kg_ltr_selected = "selected = 'selected'"
    }

    $("div.units_"+id).empty();
    $("div.units_"+id).append('<input type="hidden" name="checked_type" value="'+checked_type+'" /><input type="hidden" name="secondary_sales_product[]" value="'+id+'" />' +
        '<select name="units[]" class="select_unitdata" id="unit_id" >'+
        '<option '+box_selected+' value="box">Box</option>'+
        '<option  '+package_selected+' value="packages">Packages</option>'+
        '<option  '+kg_ltr_selected+' value="kg/ltr">Kg/Ltr</option>'+
        '</select>');

    //QTY

    var qty = $(" div.quantity_"+id+" span.quantity").text();
    $("div.quantity_"+id).empty();
    $("div.quantity_"+id).append('<input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="'+qty+'"/>');

    var qty_kg_ltr = $(" div.rol_quantity_kg_ltr_"+id+" span.rol_quantity_kg_ltr").text();
    $("div.rol_quantity_kg_ltr_"+id).empty();
    $("div.rol_quantity_kg_ltr_"+id).append('<input id="rol_quantity_kg_ltr_'+id+'" type="text" class="input_remove_border" name="qty_kgl[]" value="'+qty_kg_ltr+'" readonly/>');

    var amount = $(" div.amount_"+id+" span.amount").text();
    $("div.amount_"+id).empty();
    $("div.amount_"+id).append('<input id="amount_'+id+'" type="text" calss="amount_rt_a allownumericwithdecimal" name="amount[]" value="'+amount+'"/>');

    $(this).prop("disabled",true);
    return false;
});



$(document).on('click', '.edit_i', function () {

    $("div.check_save_btn").css("display","block");
});

$(document).on('click', 'div.check_save_btn #check_save', function () {
    var sales_data = $("#update_sales").serializeArray();

    $('.save_btn button').attr('disabled','disabled');
    //return false;
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_ishop_sales_details',
        //data: {sales_data:sales_data,checked_type:checked_type},
        data: sales_data,
        success: function(resp){
            var message = "";
            if(resp == 1){

                message += 'Data Updated successfully.';
            }
            else{

                message += 'Data not Updated.';
            }
            $('<div></div>').appendTo('body')
                .html('<div><b>'+message+'</b></div>')
                .dialog({
                    appendTo: "#success_file_popup",
                    modal: true,
                    zIndex: 10000,
                    autoOpen: true,
                    width: 'auto',
                    resizable: true,
                    close: function (event, ui) {
                        $(this).remove();
                        location.reload()
                    }
                });

        }
    });
    //return false;
});




function get_data_conversion(sku_id,quantity,units){

    var unit_data = "";

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_quantity_conversion_data",
        data: {skuid:sku_id, quantity_data:quantity, unit : units},
        //dataType : 'json',
        success: function(resp){
            unit_data = resp;
        },
        async:false
    });

    return unit_data;

}

$("body").on("change","select.select_unitdata",function(){

    var selected_row_id = $(this).parent().parent().parent().find("div.edit_i").attr("prdid");

    var sku_id = $("div.prd_"+$.trim(selected_row_id)+" span.prd_sku").text();
    var units = $(this).val();
    var quantity = $("input#quantity_"+$.trim(selected_row_id)).val();

    var unit_data = get_data_conversion(sku_id,quantity,units);

    $("input#rol_quantity_kg_ltr_"+$.trim(selected_row_id)).val(unit_data);
});

$("body").on("keyup","input.quantity_data",function(){

    var selected_row_id = $(this).parent().parent().parent().find("div.edit_i").attr("prdid");
    var sku_id = $("div.prd_"+$.trim(selected_row_id)+" span.prd_sku").text();

    var units = $(this).parent().parent().parent().find("select.select_unitdata").val();
    var quantity = $(this).val();
    var unit_data = get_data_conversion(sku_id,quantity,units);
    $("input#rol_quantity_kg_ltr_"+$.trim(selected_row_id)).val(unit_data);

});


$(document).on('click', 'div.sales_cont .delete_i', function () {
    var id = $(this).attr('prdid');
    var checked_type = $('input[name=radio1]:checked').val();
    $('<div></div>').appendTo('body')
        .html('<div>Are You Sure?</div>')
        .dialog({
            appendTo: "#success_file_popup",
            modal: true,
            title: 'Are You Sure?',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: true,
            buttons: {
                OK: function () {
                    $(this).dialog("close");


                    $.ajax({
                        type: 'POST',
                        url: site_url+'ishop/delete_ishop_sales_details',
                        data: {secondary_sales_id:id,checked_type:checked_type},
                        success: function(resp){
                            location.reload()
                        }
                    });

                },
                Cancel: function () {
                    $(this).dialog("close");

                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });

    return false;

});

$(document).on('click', 'div.sales_product .delete_i', function () {
    var id = $(this).attr('prdid');
    var checked_type = $('input[name=radio1]:checked').val();
    $('<div></div>').appendTo('body')
        .html('<div>Are You Sure?</div>')
        .dialog({
            appendTo: "#success_file_popup",
            modal: true,
            title: 'Are You Sure?',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: true,
            buttons: {
                OK: function () {
                    $(this).dialog("close");


                    $.ajax({
                        type: 'POST',
                        url: site_url+'ishop/delete_ishop_sales_product_details',
                        data: {secondary_product_sales_id:id,checked_type:checked_type},
                        success: function(resp){
                            location.reload()
                        }
                    });

                },
                Cancel: function () {
                    $(this).dialog("close");

                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });

    return false;
});





