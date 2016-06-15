/**
 * Created by webclues on 5/20/2016.
 */
$(function () {
    $('#invoice_date').datepicker({
        format: "yyyy-mm-dd"
    });

});

// START ::: Added By Vishal Malaviya For Validation
var secondary_sales_validators = $("#add_secondary_sales").validate({
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
    }
});
$("#sec_add_row").click(function() {

    $('#sec_prod_sku').removeClass('ignore');
    $('#sec_sel_unit').removeClass('ignore');
    $('#sec_qty').removeClass('ignore');
    $('#sec_amt').removeClass('ignore');

    var $valid = $("#add_secondary_sales").valid();
    if(!$valid) {
        secondary_sales_validators.focusInvalid();
        return false;
    }
    else
    {
        add_sec_sales_row();
    }
});
// END ::: Added By Vishal Malaviya For Validation



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
        "<input type='text' class='quantity_data numeric' name='quantity[]' value='"+qty+"'/>" +
        "</td>"+
        "<td data-title='Units'>" +
        "<select name='units[]' class='select_unitdata' id='unit_id' >"+
        " <option  "+box_selected+" value='box'>Box</option>"+
        "  <option  "+package_selected+" value='packages'>Packages</option>"+
        "   <option  "+kg_ltr_selected+" value='kg/ltr'>Kg/Ltr</option>"+
        "  </select>" +
        "</td>"+
        "<td data-title='Amount'>" +
        "<input type='text' name='amount[]' value='"+amt+"'/>" +
        "</td>"+
        "<td data-title='Qty Kg/Ltr'>" +
        "<input class='input_remove_border qty_"+sr_no+"'name='qty_kgl[]' type='text' value='"+unit_data+"'/>" +
        "</td>"+
        "</tr>"
    );
    $('#sec_prod_sku').selectpicker('val', '');
    $('#sec_sel_unit').selectpicker('val', '');
    $('#sec_qty').val('');
    $('#sec_amt').val('');
}

$(document).on('click', 'div.secondary_sal', function () { // <-- changes
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});

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
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/add_secondary_sales_details",
                data: param,
                //dataType : 'json',
                success: function(resp){
                    if(resp==1){
                        site_url+"ishop/secondary_sales_details";
                    }
                }
            });
        }
    }
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


$(document).on('submit', '#upload_secondary_sales_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "secondary_sales";
     
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
            
            //return false;
            
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
