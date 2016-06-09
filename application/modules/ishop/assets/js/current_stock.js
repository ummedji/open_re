/**
 * Created by webclues on 5/31/2016.
 */

$(function () {
    $('#current_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('#batch_expiry_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('#batch_mfg_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('.expiry_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('.mfg_date').datepicker({
        format: "yyyy-mm-dd"
    });
});



$("#add_company_current_stock").on("submit",function(){
    //alert('in');
    var param = $("#add_company_current_stock").serializeArray();
  // console.log(param);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/add_company_current_stock_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
            if(resp==1){
                // site_url+"ishop/physical_stock";
            }
        }
    });

});


$(document).on('click', 'div.current_stock_container .edit_i', function () {
    var id = $(this).attr('prdid');

    //product_sku_id
    var product_sku_id = $("div.product_sku_id_"+id+" span.product_sku_id").text();
    $("div.product_sku_id_"+id).empty();
    $("div.product_sku_id_"+id).append('<input type="hidden" name="product_sku_id[]" value="'+product_sku_id+'" />');

    //cur_date

    var cur_date = $("div.date_"+id+" span.date").text();

    $("div.date_"+id).empty();
    $("div.date_"+id).append('<input type="hidden" name="cur_date[]" value="'+cur_date+'" />');


   // alert(product_sku_id);
   // alert(cur_date);
    //intrum_quantity

    var int_qty_value = $("div.int_qty_"+id+" span.int_qty").text();
    $("div.int_qty_"+id).empty();
    $("div.int_qty_"+id).append('<input type="hidden" name="stock_id[]" value="'+id+'" /><input id="int_qty_'+id+'" type="text" class="int_qty" name="int_qty[]" value="'+int_qty_value+'"/>');

    //unrestricted_quantity

    var unrtd_qty = $("div.unrtd_qty_"+id+" span.unrtd_qty").text();
    $("div.unrtd_qty_"+id).empty();
    $("div.unrtd_qty_"+id).append('<input id="unrtd_qty_'+id+'" type="text" name="unrtd_qty[]" value="'+unrtd_qty+'"/>');

    //batch

    var batch = $("div.batch_"+id+" span.batch").text();
    $("div.batch_"+id).empty();
    $("div.batch_"+id).append('<input id="batch_'+id+'" type="text" name="batch[]" value="'+batch+'"/>');

    //batch_exp_date

    var batch_exp_date = $("div.batch_exp_date_"+id+" span.batch_exp_date").text();
    $("div.batch_exp_date_"+id).empty();
    $("div.batch_exp_date_"+id).append('<input id="batch_exp_date_'+id+'" class="expiry_date" type="text" name="batch_exp_date[]" value="'+batch_exp_date+'"/>');

    //batch_mfg_date

    var batch_mfg_date = $("div.batch_mfg_date_"+id+" span.batch_mfg_date").text();
    $("div.batch_mfg_date_"+id).empty();
    $("div.batch_mfg_date_"+id).append('<input id="batch_mfg_date_'+id+'"  class="mfg_date" type="text" name="batch_mfg_date[]" value="'+batch_mfg_date+'"/>');

    return false;
});

$(document).on('click', 'div.current_stock_container .edit_i', function () {
    $("div.check_save_btn").css("display","block");
});



$(document).on('click', 'div.check_save_btn #check_save', function () {
    var current_stock_data = $("#update_current_stock").serializeArray();
    //console.log(current_stock_data);
    //return false;
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_current_stock_details',
        data: current_stock_data,
        success: function(resp){
        }
    });

});

$(document).on('click', 'div.current_stock_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_current_stock_details',
            data: {stock_id:id},
            success: function(resp){}
        });
    }
    else{
        return false;
    }

});

//FOR UPLOADING DATA


$(document).on('submit', '#upload_current_stock_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "company_current_stock";
      
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
