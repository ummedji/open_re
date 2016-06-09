/**
 * Created by webclues on 5/19/2016.
 */

var login_customer_type = $("input#login_customer_role").val();

if(login_customer_type == 7){
    var customer_selected = $("input#login_customer_id").val();
}


$("input.select_customer_type").on("click",function(){

    var customer_type_selected = $(this).val();
    // alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
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



/*$("select#geo_level_rol").on("change",function(){

    var selected_geo_data = $(this).val();

    $("select#retailer_rol").empty();
    $("select#retailer_rol").selectpicker('refresh');

    get_user_by_geo_data(selected_geo_data);

});*/

$("select#distributor_geo_level").on("change",function(){

    var selected_geo_data = $(this).val();

    get_user_by_geo_data(selected_geo_data);

});



function get_user_by_geo_data(selected_geo_data){

    var checked_type = $('input[name=radio1]:checked').val();

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

                    $("select#distributor_rol").append('<option value="0">Select Distributor Name</option>');

                    $.each(resp, function (key, value) {
                        $('select#distributor_rol').append('<option value="' + value.id + '" attr-dstcode ="'+value.user_code+'" attr-dstname = "'+value.display_name+'">' + value.display_name + '</option>');
                    });
                    $("select#distributor_rol").selectpicker('refresh');
                }
                else {

                    $("select#retailer_rol").empty();

                    $("select#retailer_rol").append('<option value="0">Select Retailer Name</option>');

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

                    $("div#distributor_check_rol select.distributor_geo_level").append('<option value="0">Select Geo Location</option>');

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

                    $("div#retailer_check_rol select.geo_level_rol").append('<option value="0">Select Geo Location</option>');

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
    var checked_type = $('input[name=radio1]:checked').val();

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

                        $("div#retailer_check_rol select#geo_level_1").append('<option value="0">Select Geo Location</option>');

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

                        $("div#distributor_check_rol select#distributor_geo_level").append('<option value="0">Select Geo Location</option>');

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

function add_rol_row()
{
    var distr_name =  $('#distributor_rol option:selected').attr('attr-dstname');
    var distr_code =  $('#distributor_rol option:selected').attr('attr-dstcode');
    var distr_id =  $('#distributor_rol option:selected').val();
    var retailer_name =  $('#retailer_rol option:selected').attr('attr-rtname');
    var retailer_code =  $('#retailer_rol option:selected').attr('attr-rtcode');
    var retailer_id =  $('#retailer_rol option:selected').val();
    var sku_name = $('#prod_sku option:selected').attr('attr-name');
    var sku_id = $('#prod_sku option:selected').val();
    var pbg = $('#prod_sku option:selected').attr('attr-pbg');
    var unit = $('#unit_id option:selected').val();
    var rol_qty = $('#rol_qty').val();
  /*  var rol_kgl = $('#rol_qty').val();*/
    var sr_no =$("#rol_list > tr").length + 1;

    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";

    //var unit_data = get_data_conversion(sku_id,rol_qty,unit);


    if(unit == 'box'){
        box_selected = "selected = 'selected'"
    }
    if(unit == 'packages'){
        package_selected = "selected = 'selected'"
    }
    if(unit == 'kg/ltr'){
        kg_ltr_selected = "selected = 'selected'"
    }


    $("#rol_list").append(
        "<tr id='"+sr_no+"'>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input class='input_remove_border'  type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i rol_del' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Distributor Code'>" +
        "<input class='input_remove_border' type='text' value='"+distr_code+"' readonly/>" +
        "</td>"+
        "<td data-title='Distributor Name'>" +
        "<input class='input_remove_border' type='text' value='"+distr_name+"' readonly/>" +
        "</td>"+
        "<td data-title='PBG'>" +
        "<input class='input_remove_border' type='text' value='"+ pbg +"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Name'>" +
        "<input  class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
        "<input class='sku_"+sr_no+"' type='hidden' value='"+sku_id+"' readonly/>"+
        "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Units'>" +

        "<select name='units[]' class='select_unitdata' id='unit_id' >"+
        " <option  "+box_selected+" value='box'>Box</option>"+
        "  <option  "+package_selected+" value='packages'>Packages</option>"+
        "   <option  "+kg_ltr_selected+" value='kg/ltr'>Kg/Ltr</option>"+
        "  </select>" +
        "</td>"+
        "<td data-title='ROL Quantity'>" +
        "<input class='quantity_data numeric' type='text'class='quantity_data numeric' name='rol_qty[]' value='"+rol_qty+"'/>" +
        "</td>"+
        "<td data-title='ROL Qty Kg/Ltr'>" +
        "<input class='input_remove_border qty_"+sr_no+"' type='text' name='rol_qty_kgl[]' value='"+unit_data+"' readonly/>" +
        "</td>"+
        "</tr>"
    );

    $('#prod_sku').selectpicker('val', '0');
    $('#unit_id').selectpicker('val', '0');
    $('#rol_qty').val('');
}

$(document).on('click', 'div.rol_del', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});

$("#rol_limit").on("submit",function(){

    var param = $("#rol_limit").serializeArray();
    console.log(param);
   // return false;
   $.ajax({
        type: 'POST',
        url: site_url+"ishop/add_rol_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
        }
    });
   //  return false;
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


   // alert($(this).parent().parent().parent().html());
        var selected_row_id = $(this).parent().parent().parent().find("div.edit_i").attr("prdid");

   // alert(selected_row_id);

        var sku_id = $("div.prd_"+$.trim(selected_row_id)+" span.prd_sku").text();
        var units = $(this).val();
        var quantity = $("input#rol_quantity_"+$.trim(selected_row_id)).val();

        var unit_data = get_data_conversion(sku_id,quantity,units);

         $("input#rol_quantity_kg_ltr_"+$.trim(selected_row_id)).val(unit_data);
});

$("body").on("keyup","input.quantity_data",function(){

    var selected_row_id = $(this).parent().parent().parent().find("div.edit_i").attr("prdid");
    var sku_id = $("div.prd_"+$.trim(selected_row_id)+" span.prd_sku").text();
    //var sku_id = $("input.sku_"+$.trim(selected_row_id)).val();

    var units = $(this).parent().parent().parent().find("select.select_unitdata").val();
    var quantity = $(this).val();
    var unit_data = get_data_conversion(sku_id,quantity,units);

    //alert(selected_row_id+"----"+sku_id+'-----'+units+'----'+quantity+'-----'+unit_data);

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
    $("div.rol_quantity_"+id).append('<input id="rol_quantity_'+id+'" type="text" class="quantity_data" name="quantity[]" value="'+qty+'"/>');

    var qty_kg_ltr = $(" div.rol_quantity_kg_ltr_"+id+" span.rol_quantity_kg_ltr").text();
    $("div.rol_quantity_kg_ltr_"+id).empty();
    $("div.rol_quantity_kg_ltr_"+id).append('<input id="rol_quantity_kg_ltr_'+id+'" type="text" class="input_remove_border" name="rol_quantity_kg_ltr[]" value="'+qty_kg_ltr+'" readonly/>');

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
        }
    });
   // return false;
});

$(document).on('click', 'div.rol_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_rol_details',
            data: {rol_id:id},
            success: function(resp){}
        });
    }
    else{
        return false;
    }

});





