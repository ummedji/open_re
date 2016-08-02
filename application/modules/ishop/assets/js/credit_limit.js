/**
 * Created by webclues on 6/1/2016.
 */

$(function () {
    $('#curr_date').datepicker({
        format: date_format,
        autoclose: true
    });
});


$(document).ready(function(){
    var user_credit_limit_validators = $("#add_user_credit_limit").validate({
        rules: {
            dist_limit:{
                required: true
            },
            credit_limit:{
                required: true
            },
            curr_outstanding:{
                required: true
            },
            curr_date:{
                required: true
            }
        }
    });


    $("#add_user_credit_limit").on("submit",function(e){
        e.preventDefault();

        var param = $("#add_user_credit_limit").serializeArray();

        var $valid = $("#add_user_credit_limit").valid();
        if(!$valid) {
            user_credit_limit_validators.focusInvalid();
            return false;
        }
        else
        {
            $('.svn_btn button').attr('disabled','disabled');
            $.ajax({
                type: 'POST',
                url: site_url + "ishop/add_user_credit_limit_datails",
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


//FOR UPLOADING DATA
var credit_limit_upload_validators = $("#upload_credit_limit_data").validate({
    rules: {
        upload_file_data: {
            required: true
        }
    }
});


$(document).on('submit', '#upload_credit_limit_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "credit_limit";
    if($("input.select_customer_type").length > 0) {
        var select_customer_type = $('input[name=radio1]:checked', '#target').val();
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


    var $valid = $("#upload_credit_limit_data").valid();
    if(!$valid) {
        credit_limit_upload_validators.focusInvalid();
        return false;
    }
    else {
        $.ajax({
            url: site_url + "ishop/upload_data/creditlimit"+select_customer_type, // Url to which the request is send
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

                                    if (key3 == 4) {
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
