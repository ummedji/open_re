
$(function () {
    $('#stock_month').datepicker({
        format: "yyyy-mm", // Notice the Extra space at the beginning
        autoclose: true,

        viewMode: "months",
        minViewMode: "months"

    });
    $('#invoice_date').datepicker({
        format: date_format,
        autoclose: true
    });
});

var login_customer_type = $("input#login_customer_role").val();

if(login_customer_type == 8){
    var customer_selected = $("input#login_customer_id").val();
}




$("input.select_customer_type").on("click",function(){


    var validator = $( "#add_ishop_sales" ).validate();
    validator.resetForm();

    var customer_type_selected = $(this).val();
    // alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");

        $("div.distributor_checked_sales").css("display","none");
        $("div.retailer_checked_sales").css("display","block");
        $("div.upload_sales_data").css("display","none");

        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }
        $("#sales_stock").empty();

    }
    else if(customer_type_selected == "distributor"){
        $("div.retailer_data").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_checked_sales").css("display","block");
        $("div.retailer_checked_sales").css("display","none");
        $("div.upload_sales_data").css("display","block");

        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }

        $("#sales_stock").empty();
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
                    $("select#distributor_sales").append('<option value="">Select Distributor Name</option>');
                    $.each(resp, function (key, value) {
                        $('select#distributor_sales').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });
                    $("select#distributor_sales").selectpicker('refresh');
                }
                else {

                    $("select#retailer_sales").empty();

                    $("select#retailer_sales").append('<option value="">Select Retailer Name</option>');

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

                    $("div#distributor_checked_sales select.distributor_geo_level").append('<option value="">Select Geo Location</option>');

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

                    $("div#retailer_checked_sales select.geo_level_0").append('<option value="">Select Geo Location</option>');

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

                        $("div#retailer_checked_sales select#geo_level_1").append('<option value="">Select Geo Location</option>');

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

                        $("div#distributor_checked_sales select#distributor_geo_level").append('<option value="">Select Geo Location</option>');

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

                $("select#retailer_id").append('<option value="">Select Distributor Name</option>');

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

$(document).on(":input",'change',function() {
    $(this).valid();
});

// START ::: Added By Vishal Malaviya For Validation
$(document).ready(function(){

    var ishop_sales = $("#add_ishop_sales");
    ishop_sales.validate();



    $("#add_sales_stock_row").click(function()
    {
        var form_state = false;
        try{
            $(".lva").each(function(i,j){
                $(this).attr('required',true);
            });
            form_state = ishop_sales.valid();
        } catch (e){
            alert(e);
        }

        if(form_state==true){
            var sku_units = $('#sales_stock input[name^=sku_units]').map(function(idx, elem) {
                return $(elem).val();
            }).get();
            console.log(sku_units);
            var cur_sku_id = $('#sales_prod_sku option:selected').val();
            var cur_unit_id = $('#sec_sel_unit option:selected').val();
            var sku_unit = cur_sku_id+"_"+cur_unit_id;
            if(sku_units.length !== 0)
            {
                if(jQuery.inArray(sku_unit, sku_units) !== -1)
                {
                    $('<div></div>').appendTo('body')
                        .html('<div>Product already Inserted.</div>')
                        .dialog({
                            appendTo: "#success_file_popup",
                            modal: true,
                            title: 'Are You Sure?',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
                }
                else
                {
                    add_sales_stock_row();
                }
            }
            else
            {
                add_sales_stock_row();
            }

        }

    });


  /*  var ishop_sales_validators = $("#add_ishop_sales").validate({
        ignore: ".ignore",
        rules: {
            stock_month :{
                required: true
            },
            geo_level_0 :{
                required: true
            },
            geo_level_1 :{
                required: true
            },
            fo_retailer_id :{
                required: true
            },
            sales_prod_sku:{
                required: true
            },
            sec_sel_unit:{
                required: true
            },
            sales_qty:{
                required: true
            },
            amt:{
                required: true
            },
            distributor_geo_level :{
                required: true
            },
            retailer_id:{
                required: true
            },
            distributor_sales :{
                required: true
            },
            invoice_no:{
                required: true
            },
            invoice_date:{
                required: true
            }
        }
    });

    $("#add_sales_stock_row").click(function() {

        $('#sales_prod_sku').removeClass('ignore');
        $('#sec_sel_unit').removeClass('ignore');
        $('#sales_qty').removeClass('ignore');
        $('#amt').removeClass('ignore');

        var $valid = $("#add_ishop_sales").valid();
        var checked_type = $('input[name=radio1]:checked').val();

        if(!$valid) {
            ishop_sales_validators.focusInvalid();
            return false;
        }
        else
        {
            add_sales_stock_row();
        }

    });*/
    $("#add_ishop_sales").on("submit",function(){

        $(".lva").each(function(i,j){
            $(this).removeAttr('required');
            $(this).next("label.error").remove();
        });

        $('.save_btn button').attr('disabled','disabled');
        var form_sub_state = false;
        form_sub_state = ishop_sales.valid();
        if(form_sub_state == false){
            return false;
        }
        else
        {
            if($("#add_ishop_sales").children().length <= 0)
            {
                var message = "";
                message += 'No data added.';
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
                            return false;
                        }
                    });
                return false;

            }
            else {
                var param = $("#add_ishop_sales").serializeArray();
                $.ajax({
                    type: 'POST',
                    url: site_url+"ishop/add_ishop_sales_details",
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
        }
    });
});
// END ::: Added By Vishal Malaviya For Validation


function add_sales_stock_row()
{
   // alert('sachin');
    var sku_code = $('#sales_prod_sku option:selected').attr('attr-code');
    var sku_name = $('#sales_prod_sku option:selected').attr('attr-name');
    var sku_id = $('#sales_prod_sku option:selected').val();
    var po_qty = $('#sales_qty').val();
    var disp_qty = $('#disp_qty').val();
    var stock_month = $('#stock_month').val();
    var unit = $('#sec_sel_unit option:selected').val();
    var sr_no =$("#sales_stock > tr").length + 1;
    var amt = $('#amt').val();

    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";

    var unit_data = get_data_conversion(sku_id,po_qty,unit);


    if(unit == 'box'){
        box_selected = "selected = 'selected'"
    }
    if(unit == 'packages'){
        package_selected = "selected = 'selected'"
    }
    if(unit == 'kg/ltr'){
        kg_ltr_selected = "selected = 'selected'"
    }

    $("#sales_stock").append(
        "<tr id='"+sr_no+"'>"+
        "<input type='hidden' name='sku_units[]' value='"+sku_id+"_"+unit+"'>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input class='input_remove_border' type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i sales_stock' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
       /* "<td data-title='Month Year' class='numeric'>" +
        "<input class='input_remove_border' type='text' value='"+stock_month+"' readonly/>" +
        "</td>"+*/
        "<td data-title='Product SKU Code' class='numeric'>" +
        "<input class='sku_"+sr_no+"' type='hidden' value='"+sku_id+"' readonly/>"+
        "<input class='input_remove_border' type='text' value='"+sku_code+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Name'>" +
        "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Units'>" +
        "<input class='input_remove_border' type='text' value='"+unit+"' readonly/>" +
        "<input type='hidden' name='units[]' value='"+unit+"'/>" +
        /*"<select name='units[]' class='select_unitdata' id='unit_id' >"+
        " <option  "+box_selected+" value='box'>Box</option>"+
        "  <option  "+package_selected+" value='packages'>Packages</option>"+
        "   <option  "+kg_ltr_selected+" value='kg/ltr'>Kg/Ltr</option>"+
        "  </select>" +*/
        "</td>"+
        "<td data-title='PO Qty'>" +
        "<input class='quantity_data numeric allownumericwithdecimal' type='text' name='quantity[]' value='"+po_qty+"'/>" +
        "</td>"+
        "<td data-title='Qty Kg/Ltr'>" +
        "<input class='input_remove_border qty_"+sr_no+"' type='text' name='qty_kgl[]' value='"+unit_data+"' readonly/>" +
        "</td>"+
        "<td data-title='Amount'>" +
        "<input type='text' class = 'allownumericwithdecimal' name='amount[]' value='"+amt+"'/>" +
        "</td>"+
        "</tr>"
    );
    $('#sales_prod_sku').selectpicker('val', '');
    $('#sec_sel_unit').selectpicker('val', '');
    $('#sales_qty').val('');
    $('#disp_qty').val('');
    $('#amt').val('');
}


$(document).on('click', 'div.sales_stock', function () { // <-- changes
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    var i = 1;
    $("tbody#sales_stock tr").each(function(  k, v  ) {

        $(this).attr("id",i);
        $(this).find("td").first().find("input").val(i);

        i++;
    });
    return false;
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

    var selected_row_id = $(this).parent().parent().attr("id");
    var sku_id = $("input.sku_"+$.trim(selected_row_id)).val();
    var units = $(this).val();
    var quantity = $(this).parent().parent().find("input.quantity_data").val();
    var unit_data = get_data_conversion(sku_id,quantity,units);
    $("input.qty_"+$.trim(selected_row_id)).val(unit_data);
});

$("body").on("keyup","input.quantity_data",function(){

    var selected_row_id = $(this).parent().parent().attr("id");
    var sku_id = $("input.sku_"+$.trim(selected_row_id)).val();
    var units = $(this).parent().parent().find("select.select_unitdata").val();
    var quantity = $(this).val();
    var unit_data = get_data_conversion(sku_id,quantity,units);
    $("input.qty_"+$.trim(selected_row_id)).val(unit_data);
});


var sales_upload_validators = $("#upload_secondary_sales_data").validate({
    rules: {
        upload_file_data: {
            required: true
        }
    }
});

$(document).on('submit', '#upload_secondary_sales_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "secondary_sales";
    if($("input.select_customer_type").length > 0) {
        var select_customer_type = $('input[name=radio1]:checked', '#add_ishop_sales').val();
    }
    else{
        var select_customer_type = "";
    }
     //file_data.push(dir_name);
    var $valid = $("#upload_secondary_sales_data").valid();
    if(!$valid) {
        sales_upload_validators.focusInvalid();
        return false;
    }
    else {
        $.ajax({
            url: site_url + "ishop/upload_data/secondarysales/"+select_customer_type, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: file_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,        // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {


                $.each(data, function (key, value) {

                    //alert(key+"==="+ value);

                    if(key =="fileerror"){

                        $('<div></div>').appendTo('body')
                            .html('<div>'+value+'</div>')
                            .dialog({
                                appendTo: "#success_file_popup",
                                modal: true,
                                title: 'Save Data',
                                zIndex: 10000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: true,
                                buttons:{
                                    close: function (event, ui) {
                                        $(this).remove();
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                }

                            });

                        return false;
                    }



                    if (key == "error") {

                        var value_data = JSON.stringify(value);

                        //alert("ERROR");
                        var error_message = "";

                        var t_data = "<table><thead>";

                        //   console.log(value);

                        $.each(value, function (key5, des_value5) {


                            if (key5 == "header") {

                                //  console.log(key5+"==="+des_value5);

                                t_data += "<tr>";
                                $.each(des_value5, function (key2, header_desc_value) {
                                    $.each(header_desc_value, function (key6, header_desc_value6) {
                                        t_data += "<th style='border:1px solid;text-align:center;'>" + header_desc_value6 + "</th>";
                                    });
                                });
                                t_data += "<th style='border:1px solid;text-align:center;'>Error Description</th></tr>";

                                t_data += "</thead><tbody>";
                            }
                        });


                        $.each(value, function (key1, des_value) {

                            if (key1 != "header") {

                                t_data += "<tr>";
                                var des_data = des_value.split("~");

                                $.each(des_data, function (key3, desc_data) {
                                    t_data += "<td style='border:1px solid;text-align:center;'>" + desc_data + "</td>";
                                });

                                t_data += "</tr>";
                            }
                        });
                        t_data += "</tbody></table>";


                        $('<div></div>').appendTo('body')
                            .html('<div><h4><b>The following data is incorrect Kindly upload correct data.</b></h4></br>' + t_data + '</div>')
                            .dialog({
                                appendTo: "#error_file_popup",
                                modal: true,
                                title: 'Incorrect Data',
                                zIndex: 10000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: false,
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
                                        // return false;
                                        //console.log(file_data);
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
                                resizable: false,
                                buttons: {
                                    Save: function () {


                                        $.ajax({
                                            url: site_url + "ishop/add_xl_data", // Url to which the request is send
                                            type: "POST",             // Type of request to be send, called as method
                                            data: {val: value, dirname: dir_name}, // Data sent to server, a set of key/value pairs
                                            success: function (data)   // A function to be called if request succeeds
                                            {
                                            }
                                        }).done(function( data ) {
                                            location.reload();
                                        });

                                        // window.open(site_url+"assets/uploads/Uploads/target/"+file_name,'_blank' );

                                        // return false;
                                        //console.log(file_data);
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
