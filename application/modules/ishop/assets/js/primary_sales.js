/**
 * Created by webclues on 5/15/2016.
 */
$(function () {
    $('#invoice_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
        });

});

// START ::: Added By Vishal Malaviya For Validation
var primary_sales_validators = $("#primary_sales").validate({
    ignore: ".ignore",
    rules: {
        customer_id:{
            required: true
        },
        invoice_no:{
            required: true
        },
        invoice_date:{
            required: true
        },
        prod_sku:{
            required: true
        },
        dispatched_qty:{
            required: true
        },
        amt:{
            required: true
        }
    }
});
$("#add_row").click(function() {
    $('#prod_sku').removeClass('ignore');
    $('#dispatched_qty').removeClass('ignore');
    $('#amt').removeClass('ignore');

    var $valid = $("#primary_sales").valid();
    if(!$valid) {
        primary_sales_validators.focusInvalid();
        return false;
    }
    else
    {
        add_row();
    }
});
// END ::: Added By Vishal Malaviya For Validation

function add_row()
{
    var sku_code = $('#prod_sku option:selected').attr('attr-code');
    var sku_name = $('#prod_sku option:selected').attr('attr-name');
    var sku_id = $('#prod_sku option:selected').val();
    var po_qty = $('#po_qty').val();
    var dispatched_qty = $('#dispatched_qty').val();
    var amt = $('#amt').val();
    var sr_no =$("#primary_sls > tr").length + 1;

    $("#primary_sls").append(
        "<tr>"+
            "<td data-title='Sr. No.' class='numeric'>" +
                "<input class='input_remove_border'  type='text' value='"+sr_no+"' readonly/>" +
            "</td>"+
            "<td  data-title='Action' class='numeric'>" +
                "<div class='delete_i primary_sls' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
            "</td>"+
            "<td data-title='Product SKU Code' class='numeric'>" +
                "<input class='input_remove_border'  type='text' value='"+sku_code+"' readonly/>" +
            "</td>"+
            "<td data-title='Product SKU Name'>" +
                "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
                "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
            "</td>"+
            "<td data-title='PO Qty'>" +
                "<input type='text' name='quantity[]' value='"+po_qty+"'/>" +
            "</td>"+
            "<td data-title='Dispatched Qty'>" +
                "<input type='text' name='dispatched_quantity[]' value='"+dispatched_qty+"'/>" +
            "</td>"+
            "<td data-title='Amount'>" +
                "<input type='text' name='amount[]' value='"+amt+"'/>" +
            "</td>"+
        "</tr>"
    );
    $('#prod_sku').selectpicker('val', '0');
    $('#po_qty').val('');
    $('#dispatched_qty').val('');
    $('#amt').val('');
}

$(document).on('click', 'div.primary_sls', function () { // <-- changes
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});

$("#primary_sales").on("submit",function(){

    $('#prod_sku').addClass('ignore');
    $('#dispatched_qty').addClass('ignore');
    $('#amt').addClass('ignore');
    var param = $("#primary_sales").serializeArray();

    var $valid = $("#primary_sales").valid();
    if(!$valid) {
        primary_sales_validators.focusInvalid();
        return false;
    }
    else
    {
        if($("#primary_sls").children().length <= 0)
        {
            alert('No Product Selected');
            return false;
        }
        else {
            $.ajax({
                type: 'POST',
                url: site_url + "ishop/primary_sales_details",
                data: param,
                //dataType : 'json',
                success: function (resp) {
                    if (resp == 1) {
                        site_url + "ishop";
                    }
                }
            });
        }
    }
    /*return false;*/
});


$(document).on('submit', '#upload_primarysales_data', function (e) {

    e.preventDefault();

    var file_data = new FormData(this);
    var dir_name = "primary_sales";

    
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

    //file_data.push(dir_name);

    $.ajax({
        url: site_url+"ishop/upload_data", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: file_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {

            console.log(data);
            $.each( data, function( key, value ) {

                //alert(key+"==="+ value);

                if(key == "error"){

                    var value_data = JSON.stringify(value);

                    //alert("ERROR");
                    var error_message = "";

                    var t_data = "<table><thead>";

                    //   console.log(value);

                    $.each( value, function( key5, des_value5 ) {


                        if(key5 == "header"){

                            //  console.log(key5+"==="+des_value5);

                            t_data += "<tr>";
                            $.each( des_value5, function( key2, header_desc_value ){
                                $.each( header_desc_value, function( key6, header_desc_value6 ){
                                    t_data += "<th style='/*border:1px solid;*/text-align:center;'>"+header_desc_value6+"<span class='rts_bordet'></span></th>";

                                    header_array.push(header_desc_value6);

                                });
                            });
                            t_data += "<th style='/*border:1px solid;*/text-align:center;'>Error Description</th></tr>";

                            header_array.push('Error Description');

                            t_data += "</thead><tbody>";
                        }
                    });

                    $.each( value, function( key1, des_value ) {

                        if(key1 != "header"){

                            t_data += "<tr>";
                            var des_data = des_value.split("~");

                            $.each( des_data, function( key3, desc_data ){
                                
                                if(key3 == 3){
                                        if(desc_data != ""){
                                        var year_data = desc_data.split("-");
                                        
                                        var d = new Date(desc_data);
                                        var desc_data = year_data[2]+"-"+month[d.getMonth()]+"-"+year_data[0];
                                        }
                                        else{
                                            desc_data = "";
                                        }
                                    }
                                
                                t_data += "<td style='border:1px solid;text-align:center;' data-title='"+header_array[key3]+"'>"+desc_data+"</td>";
                            });

                            t_data += "</tr>";
                        }
                    });
                    t_data += "</tbody></table>";


                    $('<div id="no-more-tables"></div>').appendTo('body')
                        .html('<div>'+t_data+'</div>')
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

                                    if(value != "No data found"){

                                        var file_name = "";

                                        $.ajax({
                                            url: site_url+"ishop/create_data_xl", // Url to which the request is send
                                            type: "POST",             // Type of request to be send, called as method
                                            data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs
                                            success: function(data)   // A function to be called if request succeeds
                                            {
                                                file_name = data;
                                            },
                                            dataType:'html',
                                            async:false
                                        });

                                        window.open(site_url+"assets/uploads/Uploads/"+dir_name+"/"+file_name,'_blank' );
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
                else
                {

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
                                        url: site_url+"ishop/add_xl_data", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs
                                        success: function(data)   // A function to be called if request succeeds
                                        {
                                            console.log(data)
                                            //file_name = data;
                                        }
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


    return false;

});
