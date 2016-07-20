/**
 * Created by webclues on 5/19/2016.
 */

var login_customer_type = $("input#login_customer_role").val();

if(login_customer_type == 7){
    var customer_selected = $("input#login_customer_id").val();
}


$("input.select_customer_type").on("click",function(){
    var validator = $( "#rol_limit" ).validate();
    validator.resetForm();

    var customer_type_selected = $(this).val();
   //  alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
        
       // alert("1111");
        
       $("select#retailer_rol").empty();
       $("select#geo_level_1").empty();
       $("select#geo_level_rol").val("");
        
       $("select#prod_sku").val("");
       $("select#unit_id").val("");
         
       $("select#retailer_rol").selectpicker('refresh');
       $("select#geo_level_1").selectpicker('refresh');
       $("select#geo_level_rol").selectpicker('refresh');
        
       $("select#prod_sku").selectpicker('refresh');
       $("select#unit_id").selectpicker('refresh');
        
       $("input#rol_qty").val("");
        
        $("a#retailer_xl").css("display","inline-block");
        $("a#distributor_xl").css("display","none");
        
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");

        $("div.distributor_check_rol").css("display","none");
        $("div.retailer_check_rol").css("display","block");

        


        if(login_customer_type == 7){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }
        $.ajax({
            type: 'POST',
            url: site_url+"ishop/set_rol",
            data: {checked_type:'retailer'},
            //dataType : 'json',
            success: function(resp){
                $(".rol_container").html(resp);
            }
        });
    }
    else if(customer_type_selected == "distributor"){
        
       // alert("2222");
        
        
       $("select#distributor_rol").empty();
       $("select#distributor_geo_level").empty();
       $("select#prod_sku").val("");
       $("select#unit_id").val("");
                

       
       $("select#distributor_rol").selectpicker('refresh');
       $("select#distributor_geo_level").selectpicker('refresh');
       $("select#prod_sku").selectpicker('refresh');
       $("select#unit_id").selectpicker('refresh');
        
       $("input#rol_qty").val("");
        
        $("a#retailer_xl").css("display","none");
        $("a#distributor_xl").css("display","inline-block");
        
        $("div.retailer_data").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_check_rol").css("display","block");
        $("div.retailer_check_rol").css("display","none");

        


        if(login_customer_type == 7){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }
        $.ajax({
            type: 'POST',
            url: site_url+"ishop/set_rol",
            data: {checked_type:'distributor'},
            //dataType : 'json',
            success: function(resp){
                $(".rol_container").html(resp);
            }
        });
    }
});

$("select#distributor_geo_level").on("change",function(){

    var selected_geo_data = $(this).val();
    get_user_by_geo_data(selected_geo_data);

});



function get_user_by_geo_data(selected_geo_data){

    var checked_type = $('input[name=checked_type]:checked').val();

    var login_customer_type = $("input#login_customer_role").val();


    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){
            //console.log(resp);

            if(resp != 0){

                if(checked_type == "distributor"){

                    $("select#distributor_rol").empty();

                    $("select#distributor_rol").append('<option value="">Select Distributor Name</option>');

                    $.each(resp, function (key, value) {
                        $('select#distributor_rol').append('<option value="' + value.id + '" attr-dstcode ="'+value.user_code+'" attr-dstname = "'+value.display_name+'">' + value.display_name + '</option>');
                    });
                    $("select#distributor_rol").selectpicker('refresh');
                }
                else {

                    $("select#retailer_rol").empty();

                    $("select#retailer_rol").append('<option value="">Select Retailer Name</option>');

                    $.each(resp, function (key, value) {
                        $('select#retailer_rol').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#retailer_rol").selectpicker('refresh');
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

                $("div#distributor_check_rol select.distributor_geo_level").empty();
                $("div#distributor_check_rol select.distributor_geo_level").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#distributor_check_rol select.distributor_geo_level").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#distributor_check_rol select.distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#distributor_check_rol select.distributor_geo_level").selectpicker('refresh');

                }

            }

            if(customer_type_selected == "retailer"){

                $("div#retailer_check_rol select.geo_level_rol").empty();
                $("div#retailer_check_rol select.geo_level_rol").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#retailer_check_rol select.geo_level_rol").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#retailer_check_rol select.geo_level_rol').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#retailer_check_rol select.geo_level_rol").selectpicker('refresh');
                }
            }
        }
    });
}


$("select#geo_level_rol").on("change",function(){
    var selected_geo_id = $(this).val();
    get_lower_geo_by_parent_geo_rol(selected_geo_id);
});

function get_lower_geo_by_parent_geo_rol(selected_geo_id){

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

            if(login_customer_type == 7) {

                if (checked_type == "retailer") {

                    $("div#retailer_check_rol select#geo_level_1").empty();
                    $("div#retailer_check_rol select#geo_level_1").selectpicker('refresh');

                    if (resp.length > 0) {

                        $("div#retailer_check_rol select#geo_level_1").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#retailer_check_rol select#geo_level_1').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#retailer_check_rol select#geo_level_1").selectpicker('refresh');

                    }

                }
                else if (checked_type == "distributor") {

                    $("div#distributor_check_rol select#distributor_geo_level").empty();
                    $("div#distributor_check_rol select#distributor_geo_level").selectpicker('refresh');


                    if (resp.length > 0) {

                        $("div#distributor_check_rol select#distributor_geo_level").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#distributor_check_rol select#distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#distributor_check_rol select#distributor_geo_level").selectpicker('refresh');

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

$(document).on('click', 'div.rol_del', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});

$(document).ready(function(){
    var rol_validators = $("#rol_limit").validate({
        rules: {
            geo_level_rol:{
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
            distributor_rol:{
                required: true
            },
            prod_sku:{
                required: true
            },
            unit:{
                required: true
            },
            rol_qty:{
                required: true
            }
        }
    });


    $("#rol_limit").on("submit",function(e){

        e.preventDefault();

        var param = $("#rol_limit").serializeArray();
        
        //console.log();

        var $valid = $("#rol_limit").valid();
        if(!$valid) {
            rol_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/add_rol_details",
                data: param,

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
                                
                                $('input[name=checked_type]:checked', '#rol_limit').trigger( "click" );
                            }
                        });
                }
            });
            return false;
        }
    });
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
    $("div.units_"+id).append('<input type="hidden" name="rol_id[]" value="'+id+'" />' +
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
    var rol_data = $("#update_rol_limit").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_rol_limit_details',
        data: rol_data,
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

$(document).on('click', 'div.rol_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_rol_details',
            data: {rol_id:id},
            success: function(resp){
                location.reload();
            }
        });
    }
    else{
        return false;
    }

});

    var rol_upload_validators = $("#upload_rol_data").validate({
        rules: {
            upload_file_data: {
                required: true
            }
        }
    });

$(document).on('submit', '#upload_rol_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "rol";

    var header_array = [];

     //file_data.push(dir_name);

    var $valid = $("#upload_rol_data").valid();
    if(!$valid) {
        rol_upload_validators.focusInvalid();
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

                    //alert(key+"==="+ value);

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
                                        t_data += "<th style='text-align:center;'>" + header_desc_value6 + "<span class='rts_bordet'></span></th>";
                                        header_array.push(header_desc_value6);
                                    });
                                });
                                t_data += "<th style='text-align:center;'>Error Description</th></tr>";
                                header_array.push('Error Description');
                                t_data += "</thead><tbody>";
                            }
                        });


                        $.each(value, function (key1, des_value) {

                            if (key1 != "header") {

                                t_data += "<tr>";
                                var des_data = des_value.split("~");

                                $.each(des_data, function (key3, desc_data) {
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


$('#download_csv').on('click',function(){

    var param = $("#rol_limit").serialize();

    var export_url = site_url + "ishop/rol_details_csv_report?" + param+"&page="+$("input#page").val();

    window.location.href = export_url;

    return false;

});
