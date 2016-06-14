/**
 * Created by webclues on 6/1/2016.
 */

$(function () {
    $('#curr_date').datepicker({
        format: "yyyy-mm-dd"
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
            $.ajax({
                type: 'POST',
                url: site_url + "ishop/add_user_credit_limit_datails",
                data: param,
                success: function (resp) {
                }
            });
        }
    });

});


//FOR UPLOADING DATA


$(document).on('submit', '#upload_credit_limit_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "credit_limit";
      
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
                                            t_data += "<th style='border:1px solid;text-align:center;'>"+header_desc_value6+"</th>";
                                        });
                                    });
                                t_data += "<th style='border:1px solid;text-align:center;'>Error Description</th></tr>";
                                
                                t_data += "</thead><tbody>";
                            }
                        });
                     
                     
                        $.each( value, function( key1, des_value ) {
                            
                            if(key1 != "header"){
                                
                                t_data += "<tr>";
                                var des_data = des_value.split("~");
                                
                                $.each( des_data, function( key3, desc_data ){
                                    t_data += "<td style='border:1px solid;text-align:center;'>"+desc_data+"</td>";
                                });
                                
                                t_data += "</tr>";
                            }
                        });
                        t_data += "</tbody></table>";
                    
                     
                     $('<div></div>').appendTo('body')
                        .html('<div><h4><b>The following data is incorrect Kindly upload correct data.</b></h4></br>'+t_data+'</div>')
                        .dialog({
                            modal: true,
                            title: 'Incorrect Data',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: false,
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
                            modal: true,
                            title: 'Save Data',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: false,
                            buttons: {
                                Save: function () {
                                    
                                    
                                    $.ajax({
                                        url: site_url+"ishop/add_xl_data", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs 
                                        success: function(data)   // A function to be called if request succeeds
                                        {
                                            //return false;
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
