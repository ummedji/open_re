/**
 * Created by webclues on 5/20/2016.
 */

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
    $('#sec_prod_sku').selectpicker('val', '0');
    $('#sec_sel_unit').selectpicker('val', '0');
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

    var param = $("#add_secondary_sales").serializeArray();

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




