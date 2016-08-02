/**
 * Created by webclues on 5/31/2016.
 */

$(function () {
    $('#current_date').datepicker({
        format: date_format,
        autoclose: true
    });
    $('#batch_expiry_date').datepicker({
        format: date_format,
        autoclose: true
    });
    $('#batch_mfg_date').datepicker({
        format: date_format,
        autoclose: true
    }).on('changeDate', function(selected){
        $('#batch_expiry_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#batch_expiry_date').datepicker('setStartDate', startDate);
    });
});

$(document).ready(function(){
    var current_stock_validators = $("#add_company_current_stock").validate({
        rules: {
            current_date:{
                required: true
            },
            product_sku:{
                required: true
            },
            intransist_qty:{
                required: true
            },
            unrusticted_qty:{
                required: true
            },
            batch:{
                required: true
            },
            batch_expiry_date:{
                required: true
            },
            batch_mfg_date:{
                required: true
            }
        }
    });

    $("#add_company_current_stock").on("submit",function(e){


        e.preventDefault();

        var param = $("#add_company_current_stock").serializeArray();

        var $valid = $("#add_company_current_stock").valid();
        if(!$valid) {
            current_stock_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url + "ishop/add_company_current_stock_details",
                data: param,
                success: function (resp) {
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

    });
});


$(document).on('focus',".expiry_date", function(){
    $(this).datepicker({
        format: date_format,
        autoclose: true
    });
});

$(document).on('focus',".mfg_date", function(){
    $(this).datepicker({
        format:date_format,
        autoclose: true
    }).on('changeDate', function(selected){
        $('.expiry_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.expiry_date').datepicker({format:date_format,startDate:startDate});
    });
});

$(document).on('click', 'div.current_stock_container .edit_i', function () {
    var id = $(this).attr('prdid');

    //product_sku_id
    var product_sku_id = $("div.product_sku_id_"+id+" span.product_sku_id").text();
    $("div.product_sku_id_"+id).empty();
    $("div.product_sku_id_"+id).append('<input type="hidden" name="product_sku_id[]" value="'+product_sku_id+'" required />');

    //cur_date

    var cur_date = $("div.date_"+id+" span.date").text();

    $("div.date_"+id).empty();
    $("div.date_"+id).append('<input type="hidden" name="cur_date[]" value="'+cur_date+'" required/>');


    var int_qty_value = $("div.int_qty_"+id+" span.int_qty").text();
    $("div.int_qty_"+id).empty();
    $("div.int_qty_"+id).append('<input type="hidden" name="stock_id[]" value="'+id+'" /><input id="int_qty_'+id+'" type="text" class="int_qty allownumericwithdecimal" name="int_qty[]" value="'+int_qty_value+'" required/>');

    //unrestricted_quantity

    var unrtd_qty = $("div.unrtd_qty_"+id+" span.unrtd_qty").text();
    $("div.unrtd_qty_"+id).empty();
    $("div.unrtd_qty_"+id).append('<input id="unrtd_qty_'+id+'" type="text" class="allownumericwithdecimal" name="unrtd_qty[]" value="'+unrtd_qty+'" required/>');

    //batch

    var batch = $("div.batch_"+id+" span.batch").text();
    $("div.batch_"+id).empty();
    $("div.batch_"+id).append('<input id="batch_'+id+'" type="text" name="batch[]" value="'+batch+'" required/>');

    //batch_exp_date

    var batch_exp_date = $("div.batch_exp_date_"+id+" span.batch_exp_date").text();
    $("div.batch_exp_date_"+id).empty();
    $("div.batch_exp_date_"+id).append('<input id="batch_exp_date_'+id+'" class="expiry_date" type="text" name="batch_exp_date[]" value="'+batch_exp_date+'" required/>');

    //batch_mfg_date

    var batch_mfg_date = $("div.batch_mfg_date_"+id+" span.batch_mfg_date").text();
    $("div.batch_mfg_date_"+id).empty();
    $("div.batch_mfg_date_"+id).append('<input id="batch_mfg_date_'+id+'"  class="mfg_date" type="text" name="batch_mfg_date[]" value="'+batch_mfg_date+'" required/>');

    $(this).prop("disabled",true);
    return false;
});

$(document).on('click', 'div.current_stock_container .edit_i', function () {
    $("div.check_save_btn").css("display","block");
});



$(document).on('click', 'div.check_save_btn #check_save', function () {

    var current_stock_data = $("#update_current_stock").serializeArray();

    var check_blank_data = [];

    $("#update_current_stock input").each(function( index ) {

        if($( this ).val() == ""){
            check_blank_data.push(1);
        }

       // alert( index + ": " + $( this ).val() );
    });

    if($.inArray(1,check_blank_data) == -1){

        $.ajax({
            type: 'POST',
            url: site_url+'ishop/update_current_stock_details',
            data: current_stock_data,
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

    }
    else
    {
        var message = "Please add data to to all fields.";

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
                   // location.reload()
                }
            });

    }


    return false;
});

$(document).on('click', 'div.current_stock_container .delete_i', function () {
    var id = $(this).attr('prdid');
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
                        url: site_url+'ishop/delete_current_stock_details',
                        data: {stock_id:id},
                        success: function(resp){
                            location.reload();
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

//FOR UPLOADING DATA

var current_stock_upload_validators = $("#upload_current_stock_data").validate({
    rules: {
        upload_file_data: {
            required: true
        }
    }
});


$(document).on('submit', '#upload_current_stock_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "company_current_stock";
    if($("input.select_customer_type").length > 0) {
        var select_customer_type = $('input[name=radio1]:checked', '#add_company_current_stock').val();
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
    var $valid = $("#upload_current_stock_data").valid();
    if(!$valid) {
        current_stock_upload_validators.focusInvalid();
        return false;
    }
    else {
        $.ajax({
            url: site_url + "ishop/upload_data/companycurrentstock/"+select_customer_type, // Url to which the request is send
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

                                    if (key3 == 5 || key3 == 6 || key3 == 7) {
                                        if (desc_data != "") {
                                            var year_data = desc_data.split("-");

                                            var d = new Date(desc_data);
                                            var desc_data = year_data[2] + "-" + month[d.getMonth()] + "-" + year_data[0];
                                        }
                                        else {
                                            desc_data = "";
                                        }
                                    }
                                    t_data += "<td style='border:1px solid;text-align:center;'data-title='" + header_array[key3] + "'>" + desc_data + "</td>";
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
                                        // window.open(site_url+"assets/uploads/Uploads/target/"+file_name,'_blank' );
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

$('#download_csv').on('click',function(){

    var param = $("#add_company_current_stock").serialize();

    var export_url = site_url + "ishop/current_stock_details_csv_report?" + param+"&page="+$("input#page").val();

    window.location.href = export_url;

    return false;

});
