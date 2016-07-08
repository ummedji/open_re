
$(function () {
    $('#stock_month').datepicker({
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

    var validator = $( "#add_physical_stock" ).validate();
    validator.resetForm();

    var customer_type_selected = $(this).val();
       // alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");

        $("div.distributor_checked").css("display","none");
        $("div.retailer_checked").css("display","block");

        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }


        $.ajax({
            type: 'POST',
            url: site_url+"ishop/physical_stock",
            data: {checked_type:'retailer'},
            //dataType : 'json',
            success: function(resp){
                $(".phy_stock_container").html(resp);
            }
        });

    }
    else if(customer_type_selected == "distributor"){
        $("div.retailer_data").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_checked").css("display","block");
        $("div.retailer_checked").css("display","none");


        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }

        $.ajax({
            type: 'POST',
            url: site_url+"ishop/physical_stock",
            data: {checked_type:'distributor'},
            //dataType : 'json',
            success: function(resp){
                $(".phy_stock_container").html(resp);
            }
        });

    }
});


$("select#distributor_geo_level").on("change",function(){

    var selected_geo_data = $(this).val();
    get_user_by_geo_data(selected_geo_data);

});

$(document).on("change",'#stock_month',function(){
    var stock_month = $('#stock_month').val();
    var role_id = $("input#login_customer_role").val();
    if( role_id == 8)
    {
        var checked_type = $('input.select_customer_type').val();
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/physical_stock',
            data: {stock_month:stock_month,checked_type:checked_type},
            success: function(resp){
                $('#middle_container').html(resp);
            }
        });
        return false;
    }
    if(role_id == 9 || role_id == 10)
    {
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/physical_stock',
            data: {stock_month:stock_month},
            success: function(resp){
                $('#middle_container').html(resp);
            }
        });
        return false;
    }
});



function get_user_by_geo_data(selected_geo_data){


    var checked_type = $('input[name=checked_type]:checked').val();

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
                    $("select#distributor_phystok").empty();
                    $("select#distributor_phystok").append('<option value="0">Select Distributor Name</option>');
                    $.each(resp, function (key, value) {
                        $('select#distributor_phystok').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });
                    $("select#distributor_phystok").selectpicker('refresh');
                }
                else {

                    $("select#retailer_phystok").empty();

                    $("select#retailer_phystok").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function (key, value) {

                        $('select#retailer_phystok').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#retailer_phystok").selectpicker('refresh');

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

                $("div#distributor_checked select.distributor_geo_level").empty();
                $("div#distributor_checked select.distributor_geo_level").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#distributor_checked select.distributor_geo_level").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#distributor_checked select.distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#distributor_checked select.distributor_geo_level").selectpicker('refresh');

                }

            }

            if(customer_type_selected == "retailer"){

                $("div#retailer_checked select.geo_level").empty();
                $("div#retailer_checked select.geo_level").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#retailer_checked select.geo_level").append('<option value="0">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#retailer_checked select.geo_level').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#retailer_checked select.geo_level").selectpicker('refresh');
                }
            }
        }
    });
}


$("select#geo_level").on("change",function(){

    var selected_geo_id = $(this).val();
    get_lower_geo_by_parent_geo_physical_stock(selected_geo_id);
});

function get_lower_geo_by_parent_geo_physical_stock(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_role" ).val();
    var customer_selected = $("input#login_customer_id").val();
    var url_seg = $("input.page_function" ).val();
    var checked_type = $('input[name=checked_type]:checked').val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lowergeo_from_uppergeo_data",
        data: {checkedtype:checked_type, user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,parent_geo_id:selected_geo_id,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(login_customer_type == 8) {

                if (checked_type == "retailer") {

                    $("div#retailer_checked select#geo_level_1").empty();
                    $("div#retailer_checked select#geo_level_1").selectpicker('refresh');

                    if (resp.length > 0) {

                        $("div#retailer_checked select#geo_level_1").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#retailer_checked select#geo_level_1').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#retailer_checked select#geo_level_1").selectpicker('refresh');

                    }

                }
                else if (checked_type == "distributor") {

                    $("div#distributor_checked select#distributor_geo_level").empty();
                    $("div#distributor_checked select#distributor_geo_level").selectpicker('refresh');


                    if (resp.length > 0) {

                        $("div#distributor_checked select#distributor_geo_level").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#distributor_checked select#distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#distributor_checked select#distributor_geo_level").selectpicker('refresh');

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
function add_phy_stock_row()
{
    var sku_code = $('#phy_prod_sku option:selected').attr('attr-code');
    var sku_name = $('#phy_prod_sku option:selected').attr('attr-name');
    var sku_id = $('#phy_prod_sku option:selected').val();
    var po_qty = $('#phy_qty').val();
    var stock_month = $('#stock_month').val();
    var unit = $('#sec_sel_unit option:selected').val();
    var sr_no =$("#physical_stock > tr").length + 1;

    $("#physical_stock").append(
        "<tr>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
            /*  "<div class='edit_i'><a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>" +*/
        "<div class='delete_i physical_stock' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Month Year' class='numeric'>" +
        "<input type='text' value='"+stock_month+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Code' class='numeric'>" +
        "<input type='text' value='"+sku_code+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Name'>" +
        "<input type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='PO Qty'>" +
        "<input type='text' name='quantity[]' value='"+po_qty+"'/>" +
        "</td>"+
        "<td data-title='Units'>" +
        "<input type='text' name='units[]' value='"+unit+"'readonly/>" +
        "</td>"+
        "</tr>"
    );
    $('#phy_prod_sku').selectpicker('val', '0');
    $('#sec_sel_unit').selectpicker('val', '0');
    $('#phy_qty').val('');
}

$(document).on('click', 'div.physical_stock', function () { // <-- changes
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});



// START ::: For Validation
$(document).ready(function(){

var physical_stock_validators = $("#add_physical_stock").validate({
    rules: {
        stock_month:{
            required: true
        },
        geo_level:{
            required: true
        },
        geo_level_1:{
            required: true
        },
        fo_retailer_id:{
            required: true
        },
        distributor_geo_level:{
            required: true
        },
        distributor_phystok:{
            required: true
        },
        phy_prod_sku:{
            required: true
        },
        sec_sel_unit:{
            required: true
        },
        phy_qty:{
            required: true
        }
    }
});

$("#add_physical_stock").on("submit",function(e){

    e.preventDefault();

    var param = $("#add_physical_stock").serializeArray();

    var $valid = $("#add_physical_stock").valid();
    if(!$valid) {
        physical_stock_validators.focusInvalid();
        return false;
    }
    else
    {
        $.ajax({
            type: 'POST',
            url: site_url+"ishop/add_physical_stock_details",
            data: param,
            //dataType : 'json',
            success: function(resp){
                var message = "";
                if(resp == 1){

                    message += 'Data Inserted successfully.';
                }
                else{

                    message += 'Data not Inserted.';
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
    }
    return false;
});

});

/*--------------------------------------------------------------------------------*/
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
    var quantity = $("input#rol_quantity_"+$.trim(selected_row_id)).val();

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

$(document).on('click', '.edit_i', function () {
    var id = $(this).attr('prdid');

    //UNIT
    var prd_sku = $(" div.prd_"+id+" span.prd_sku").text();
    var units = $(" div.units_"+id+" span.units").text();

    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";

    // alert(prd_sku);
    if(units == 'box'){
        box_selected = "selected = 'selected'"
    }
    if(units == 'packages'){
        package_selected = "selected = 'selected'"
    }
    if(units == 'kg/ltr'){
        kg_ltr_selected = "selected = 'selected'"
    }

    $("div.units_"+id).empty();
    $("div.units_"+id).append('<input type="hidden" name="stock_id[]" value="'+id+'" />' +
        '<select name="units[]" class="select_unitdata" id="unit_id" >'+
        '<option '+box_selected+' value="box">Box</option>'+
        '<option  '+package_selected+' value="packages">Packages</option>'+
        '<option  '+kg_ltr_selected+' value="kg/ltr">Kg/Ltr</option>'+
        '</select>');

    //QTY

    var qty = $(" div.rol_quantity_"+id+" span.rol_quantity").text();
    $("div.rol_quantity_"+id).empty();
    $("div.rol_quantity_"+id).append('<input id="rol_quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="'+qty+'"/>');

    var qty_kg_ltr = $(" div.rol_quantity_kg_ltr_"+id+" span.rol_quantity_kg_ltr").text();
    $("div.rol_quantity_kg_ltr_"+id).empty();
    $("div.rol_quantity_kg_ltr_"+id).append('<input id="rol_quantity_kg_ltr_'+id+'" type="text" class="input_remove_border" name="rol_quantity_kg_ltr[]" value="'+qty_kg_ltr+'" readonly/>');

    $(this).prop("disabled",true);
    return false;
});

$(document).on('click', '.edit_i', function () {
    $("div.check_save_btn").css("display","block");
});


$(document).on('click', 'div.check_save_btn #check_save', function () {
    var physical_data = $("#update_physical_stock").serializeArray();
     console.log(physical_data);
    //return false;
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_physical_stock_details',
        data: physical_data,
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
    return false;

});

$(document).on('click', 'div.phy_stock_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_physical_stock_details',
            data: {stock_id:id},
            success: function(){
                location.reload();
            }
        });
    }
    else{
        return false;
    }

});

var physical_upload_validators = $("#upload_physicalstock_data").validate({
    rules: {
        upload_file_data: {
            required: true
        }
    }
});


$(document).on('submit', '#upload_physicalstock_data', function (e) {

    e.preventDefault();

    var file_data = new FormData(this);
    var dir_name = "physical_stock";

     var month = new Array();
        month[0] = "Jan";
        month[1] = "Feb";
        month[2] = "Mar";
        month[3] = "Apr";
        month[4] = "May";
        month[5] = "Jun";
        month[6] = "Jul";
        month[7] = "Aug";
        month[8] = "Sep";
        month[9] = "Oct";
        month[10] = "Nov";
        month[11] = "Dec";

    var header_array = [];

    var $valid = $("#upload_physicalstock_data").valid();
    if(!$valid) {
        physical_upload_validators.focusInvalid();
        return false;
    }
    else {
        $.ajax({
            url: site_url + "ishop/upload_data", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: file_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,        // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {

                console.log(data);
                $.each(data, function (key, value) {

                    if (key == "error") {

                        var value_data = JSON.stringify(value);

                        var error_message = "";

                        var t_data = "<table><thead>";

                        $.each(value, function (key5, des_value5) {

                            if (key5 == "header") {

                                t_data += "<tr>";
                                $.each(des_value5, function (key2, header_desc_value) {
                                    $.each(header_desc_value, function (key6, header_desc_value6) {
                                        t_data += "<th style='/*border:1px solid;*/text-align:center;'>" + header_desc_value6 + "<span class='rts_bordet'></span></th>";
                                        header_array.push(header_desc_value6);
                                    });
                                });
                                t_data += "<th style='/*border:1px solid;*/text-align:center;'>Error Description</th></tr>";
                                header_array.push('Error Description');
                                t_data += "</thead><tbody>";
                            }
                        });


                        $.each(value, function (key1, des_value) {

                            if (key1 != "header") {

                                t_data += "<tr>";
                                var des_data = des_value.split("~");

                                $.each(des_data, function (key3, desc_data) {

                                    if (key3 == 0) {
                                        if (desc_data != "") {
                                            var year_data = desc_data.split("-");

                                            var d = new Date(desc_data);
                                            var desc_data = month[d.getMonth()] + "-" + year_data[0];
                                        }
                                        else {
                                            desc_data = "";
                                        }
                                    }

                                    t_data += "<td style='border:1px solid;text-align:center;' data-title='" + header_array[key3] + "'>" + desc_data + "</td>";
                                });

                                t_data += "</tr>";
                            }
                        });
                        t_data += "</tbody></table>";


                        $('<div id="no-more-tables"></div>').appendTo('body')
                            .html('<div>' + t_data + '</div>')
                            .dialog({
                                appendTo: "#error_file_popup",
                                modal: true,
                                title: 'The following data is incorrect Kindly upload correct data.',
                                zIndex: 10000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: true,
                                buttons: {
                                    Download: function () {

                                        if (value != "No data found") {

                                            var file_name = "";

                                            $.ajax({
                                                url: site_url + "ishop/create_data_xl", // Url to which the request is send
                                                type: "POST",             // Type of request to be send, called as method
                                                data: {val: value, dirname: dir_name}, // Data sent to server, a set of key/value pairs
                                                success: function (data)   // A function to be called if request succeeds
                                                {
                                                    file_name = data;
                                                },
                                                dataType: 'html',
                                                async: false
                                            });

                                            window.open(site_url + "assets/uploads/Uploads/" + dir_name + "/" + file_name, '_blank');
                                        }
                                        $(this).dialog("close");
                                    },
                                    Decline: function () {
                                        $(this).dialog("close");
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                }
                            });
                    }
                    else {
                        $('<div></div>').appendTo('body')
                            .html('<div><h4><b>The file is correct. Please click on save button.</b></h4></div>')
                            .dialog({
                                appendTo: "#success_file_popup",
                                modal: true,
                                title: 'Save Data',
                                zIndex: 10000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: true,
                                buttons: {
                                    Save: function () {
                                        $.ajax({
                                            url: site_url + "ishop/add_xl_data", // Url to which the request is send
                                            type: "POST",             // Type of request to be send, called as method
                                            data: {val: value, dirname: dir_name}, // Data sent to server, a set of key/value pairs
                                            success: function (data)   // A function to be called if request succeeds
                                            {
                                                location.reload();
                                            }
                                        });
                                        $(this).dialog("close");
                                    },
                                    Decline: function () {
                                        $(this).dialog("close");
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                }
                            });
                    }
                })
            },
            dataType: 'json'
        });
    }
    return false;
});



