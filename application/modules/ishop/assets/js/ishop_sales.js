
$(function () {
    $('#stock_month').datepicker({
        format: "yyyy-mm"
    });
    $('#invoice_date').datepicker({
        format: "yyyy-mm-dd"
    });


});

var login_customer_type = $("input#login_customer_role").val();

if(login_customer_type == 8){
    var customer_selected = $("input#login_customer_id").val();
}


$("input.select_customer_type").on("click",function(){

    var customer_type_selected = $(this).val();
    // alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");

        $("div.distributor_checked_sales").css("display","none");
        $("div.retailer_checked_sales").css("display","block");

        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }

    }
    else if(customer_type_selected == "distributor"){
        $("div.retailer_data").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_checked_sales").css("display","block");
        $("div.retailer_checked_sales").css("display","none");


        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }
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
                    $("select#distributor_sales").append('<option value="0">Select Distributor Name</option>');
                    $.each(resp, function (key, value) {
                        $('select#distributor_sales').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });
                    $("select#distributor_sales").selectpicker('refresh');
                }
                else {

                    $("select#retailer_sales").empty();

                    $("select#retailer_sales").append('<option value="0">Select Retailer Name</option>');

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

                    $("div#distributor_checked_sales select.distributor_geo_level").append('<option value="0">Select Geo Location</option>');

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

                    $("div#retailer_checked_sales select.geo_level_0").append('<option value="0">Select Geo Location</option>');

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

                        $("div#retailer_checked_sales select#geo_level_1").append('<option value="0">Select Geo Location</option>');

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

                        $("div#distributor_checked_sales select#distributor_geo_level").append('<option value="0">Select Geo Location</option>');

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

                $("select#retailer_id").append('<option value="0">Select Distributor Name</option>');

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



function add_sales_stock_row()
{
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
        "<select name='units[]' class='select_unitdata' id='unit_id' >"+
        " <option  "+box_selected+" value='box'>Box</option>"+
        "  <option  "+package_selected+" value='packages'>Packages</option>"+
        "   <option  "+kg_ltr_selected+" value='kg/ltr'>Kg/Ltr</option>"+
        "  </select>" +
        "</td>"+
        "<td data-title='PO Qty'>" +
        "<input class='quantity_data numeric' type='text' name='quantity[]' value='"+po_qty+"'/>" +
        "</td>"+
        "<td data-title='Qty Kg/Ltr'>" +
        "<input class='input_remove_border qty_"+sr_no+"' type='text' name='qty_kgl[]' value='"+unit_data+"' readonly/>" +
        "</td>"+
        "<td data-title='Amount'>" +
        "<input type='text' name='amount[]' value='"+amt+"'/>" +
        "</td>"+
        "</tr>"
    );
    $('#sales_prod_sku').selectpicker('val', '0');
    $('#sec_sel_unit').selectpicker('val', '0');
    $('#sales_qty').val('');
    $('#disp_qty').val('');
    $('#amt').val('');
}


$(document).on('click', 'div.sales_stock', function () { // <-- changes
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});

$("#add_ishop_sales").on("submit",function(){

    var param = $("#add_ishop_sales").serializeArray();

//return false;
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/add_ishop_sales_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
            if(resp==1){
               // site_url+"ishop/physical_stock";
            }
        }
    });
   // return false;
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
