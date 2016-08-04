/**
 * Created by webclues on 5/20/2016.
 */
$(function () {
    $('#invoice_date').datepicker({
        format: date_format,
        autoclose: true
    });


    var secondary_sales_validators = $("#add_secondary_sales").validate({
        ignore: ".ignore",
        rules: {
            customer_id:{
                required: true
            },
            invoice_date:{
                required: true
            },
            sec_prod_sku:{
                required: true
            },
            sec_sel_unit:{
                required: true
            },
            sec_qty:{
                required: true
            },
            sec_amt:{
                required: true
            }
        },
        messages: {
            customer_id: {
               // required: "Please Select Customer Name."
            },
            invoice_no: {
              //  required: "Please Enter Invoice Number."
            },
            invoice_date:{
               // required:  "Please Enter Invoice Date."
            },
            sec_prod_sku:{
               // required:  "Please Select SKU."
            },
            sec_qty:{
               // required:  "Please Enter Qty."
            },
            sec_sel_unit:{
               // required:  "Please Select Unit."
            },
            amt:{
              //  required:  "Please Enter Amt."
            }
        }
    });


    var already_assign_error = 0;

    $( "#invoice_no" ).focusout(function() {

        var customer_id=$('#reta_id').val();
        var invoice_no=$('#invoice_no').val();
        var login_customer_id = $("input#login_customer_id").val();
        if(customer_id != '' && $.trim(invoice_no)!=''){

            $.ajax({
                type: 'POST',
                    url: site_url + "ishop/check_duplicate_data_secondary_sales",
                data: {customer_id:customer_id,invoice_no:invoice_no,login_id:login_customer_id},
                //dataType : 'json',
                success: function (resp) {
                    if(resp == 1){
                        already_assign_error = 1;
                        $('.error').css('display','block');
                        $('#invoice_no_error').html('Invoice Number already Assign!');
                    }
                    else if(resp == 2){
                        get_scondary_sales_data(invoice_no,login_customer_id,customer_id);
                    }
                    else{
                        already_assign_error = 0;
                        $('.error').css('display','none');
                        $('#invoice_no_error').empty();
                    }
                }
            });
        }
        else if($.trim(invoice_no) !=''){
            get_scondary_sales_data(invoice_no,login_customer_id,customer_id);
        }
    });

    function get_scondary_sales_data(invoice_no,login_customer_id,customer_id){
        $.ajax({
            type: 'POST',
            url: site_url + "ishop/get_data_secondary_sales_by_invoice",
            data: {invoice_no:invoice_no,login_id:login_customer_id,customer_id:customer_id},
            //dataType : 'json',
            success: function (resp) {
                if(resp){
                    var obj = jQuery.parseJSON(resp);
                    $.ajax({
                        type: 'POST',
                        url: site_url + "ishop/get_data_secondary_sales_product_by_invoice",
                        data: {secondary_sales_id:obj.secondary_sales_id},
                        dataType : 'html',
                        success: function (resp) {
                            $("#secondary_sls").append(resp);
                            $('.save_button').css("display","block");

                        }
                    });

                    $('#reta_id').selectpicker('val', obj.customer_id_to);
                    $('#invoice_date').val(obj.invoice_date);
                    $('#order_traking_no').val(obj.order_tracking_no);
                    $('#po_no').val(obj.PO_no);
                }
            }
        });
    }

    $('#reta_id').on('change',function(){
        $('#invoice_no').val('');
        $("#secondary_sls").empty();
    });

    $("#sec_add_row").click(function() {

        $('#sec_prod_sku').removeClass('ignore');
        $('#sec_sel_unit').removeClass('ignore');
        $('#sec_qty').removeClass('ignore');
        $('#sec_amt').removeClass('ignore');

        var $valid = $("#add_secondary_sales").valid();
        if(!$valid || already_assign_error == 1) {

            secondary_sales_validators.focusInvalid();
            if(already_assign_error == 1) {
                $('.errors').css('display', 'block');
                $('#invoice_no_error').html('Invoice Number already Assign!');
            }
            else{
                already_assign_error = 0;
                $('.errors').css('display','none');
                $('#invoice_no_error').empty();
            }
            return false;
        }
        else
        {
            var sku_units = $('#secondary_sls input[name^=sku_units]').map(function(idx, elem) {
                return $(elem).val();
            }).get();

            /*var sku_ids = $('#secondary_sls input[name^=product_sku_id]').map(function(idx, elem) {
                return $(elem).val();
            }).get();
            var units_ids = $('#secondary_sls select[name^=units] option:selected').map(function(idx, elem) {
                return $(elem).val();
            }).get();
            console.log(sku_ids);
            console.log(units_ids);*/


            console.log(sku_units);
            var cur_sku_id = $('#sec_prod_sku option:selected').val();
            var cur_unit_id = $('#sec_sel_unit option:selected').val();
            var sku_unit = cur_sku_id+"_"+cur_unit_id;
            if(sku_units.length !== 0)
            {
                if(jQuery.inArray(sku_unit, sku_units) !== -1 /*jQuery.inArray(cur_sku_id, sku_ids) !== -1 && jQuery.inArray(cur_unit_id, units_ids) !== -1*/)
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
                    add_sec_sales_row();
                }
            }
            else
            {
                add_sec_sales_row();
            }
        }
    });
// END ::: Added By Vishal Malaviya For Validation



    $("#add_secondary_sales").on("submit",function(){

        $('#sec_prod_sku').addClass('ignore');
        $('#sec_sel_unit').addClass('ignore');
        $('#sec_qty').addClass('ignore');
        $('#sec_amt').addClass('ignore');

        var param = $("#add_secondary_sales").serializeArray();

        var $valid = $("#add_secondary_sales").valid();
        if(!$valid) {
            secondary_sales_validators.focusInvalid();
            return false;
        }
        else
        {
            if($("#add_secondary_sales").children().length <= 0)
            {
                alert('No Product Selected');
                return false;
            }
            else {
                $('.save_btn button').attr('disabled','disabled');
                $.ajax({
                    type: 'POST',
                    url: site_url+"ishop/add_secondary_sales_details",
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
                return false;
            }
        }
    });
});

$(document).on(":input",'change',function() {
    $(this).valid();
});

function add_sec_sales_row()
{
    var reta_name =  $('#reta_id option:selected').attr('attr-retname');
    var reta_id =  $('#reta_id option:selected').val();
    var sku_code = $('#sec_prod_sku option:selected').attr('attr-code');
    var sku_name = $('#sec_prod_sku option:selected').attr('attr-name');
    var sku_id = $('#sec_prod_sku option:selected').val();
    var sec_sel_unit =  $('#sec_sel_unit option:selected').val();
    var qty = $('#sec_qty').val();
    var amt = $('#sec_amt').val();
    var sr_no =$("#secondary_sls > tr").length + 1;



    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";

    var unit_data = get_data_conversion(sku_id,qty,sec_sel_unit);


    if(sec_sel_unit == 'box'){
        box_selected = "selected = 'selected'"
    }
    if(sec_sel_unit == 'packages'){
        package_selected = "selected = 'selected'"
    }
    if(sec_sel_unit == 'kg/ltr'){
        kg_ltr_selected = "selected = 'selected'"
    }

    $("#secondary_sls").append(
        "<tr id='"+sr_no+"'>"+
        "<input type='hidden' name='sku_units[]' value='"+sku_id+"_"+sec_sel_unit+"'>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input class='input_remove_border'  type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i secondary_sal' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Retailer Name' class='numeric'>" +
        "<input class='input_remove_border'  type='text' value='"+reta_name+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Code' class='numeric'>" +
        "<input class='sku_"+sr_no+"' type='hidden' value='"+sku_id+"' readonly/>"+
        "<input class='input_remove_border' type='text' value='"+sku_code+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Name'>" +
        "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Qty'>" +
        "<input type='text' class='quantity_data numeric allownumericwithdecimal' name='quantity[]' value='"+qty+"'/>" +
        "</td>"+
        "<td data-title='Units'>" +
        "<input class='input_remove_border' type='text' value='"+sec_sel_unit+"' readonly/>" +
        "<input type='hidden' name='units[]' value='"+sec_sel_unit+"'/>" +
        /*"<select name='units[]' class='select_unitdata' id='unit_id' >"+
        " <option  "+box_selected+" value='box'>Box</option>"+
        "  <option  "+package_selected+" value='packages'>Packages</option>"+
        "   <option  "+kg_ltr_selected+" value='kg/ltr'>Kg/Ltr</option>"+
        "  </select>" +*/
        "</td>"+
        "<td data-title='Amount'>" +
        "<input type='text' name='amount[]' class='amount_rt_a allownumericwithdecimal' value='"+amt+"'/>" +
        "</td>"+
        "<td data-title='Qty Kg/Ltr'>" +
        "<input class='input_remove_border qty_"+sr_no+"'name='qty_kgl[]' type='text' value='"+unit_data+"'readonly/>" +
        "</td>"+
        "</tr>"
    );

    $('.save_button').css("display","block");
    $('#sec_prod_sku').selectpicker('val', '');
    $('#sec_sel_unit').selectpicker('val', '');
    $('#sec_qty').val('');
    $('#sec_amt').val('');
}

$(document).on('click', 'div.secondary_sal', function () { // <-- changes
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    var i = 1;
    $("tbody#secondary_sls tr").each(function(  k, v  ) {

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


var secondary_sales_upload_validators = $("#upload_secondary_sales_data").validate({
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
        var select_customer_type = $('input[name=radio1]:checked', '#add_secondary_sales').val();
    }
    else{
        var select_customer_type = "";
    }
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

    var $valid = $("#upload_secondary_sales_data").valid();
    if(!$valid) {
        secondary_sales_upload_validators.focusInvalid();
        return false;
    }
    else {
        $('.chech_data button').attr('disabled','disabled');
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
                                        $('.chech_data button').removeAttr('disabled','disabled');
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                    $('.chech_data button').removeAttr('disabled','disabled');
                                }

                            });

                        return false;
                    }


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

                                    if (key3 == 3) {
                                        if (desc_data != "") {
                                            var year_data = desc_data.split("-");

                                            var d = new Date(desc_data);
                                            var desc_data = year_data[2] + "-" + month[d.getMonth()] + "-" + year_data[0];
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
                                        $('.chech_data button').removeAttr('disabled','disabled');
                                    },
                                    Decline: function () {
                                        $(this).dialog("close");
                                        $('.chech_data button').removeAttr('disabled','disabled');
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                    $('.chech_data button').removeAttr('disabled','disabled');
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

                                            }
                                        }).done(function( data ) {
                                            location.reload();
                                        });
                                        $(this).dialog("close");
                                        $('.chech_data button').removeAttr('disabled','disabled');
                                    },
                                    Decline: function () {
                                        $(this).dialog("close");
                                        $('.chech_data button').removeAttr('disabled','disabled');
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                    $('.chech_data button').removeAttr('disabled','disabled');
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
