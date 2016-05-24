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

    var unit_data = "";

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_quantity_conversion_data",
        data: {skuid:sku_id, quantity_data:qty, unit : sec_sel_unit},
        //dataType : 'json',
        success: function(resp){
            unit_data = resp;
        },
        async:false
    });


    $("#secondary_sls").append(
        "<tr>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
            /*  "<div class='edit_i'><a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>" +*/
        "<div class='delete_i secondary_sal' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Retailer Name' class='numeric'>" +
        "<input type='text' value='"+reta_name+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Code' class='numeric'>" +
        "<input type='text' value='"+sku_code+"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Name'>" +
        "<input type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Qty'>" +
        "<input type='text' name='quantity[]' value='"+qty+"'/>" +
        "</td>"+
        "<td data-title='Unit'>" +
        "<input type='text' value='"+sec_sel_unit+"'/>" +
        "</td>"+
        "<td data-title='Amount'>" +
        "<input type='text' name='amount[]' value='"+amt+"'/>" +
        "</td>"+
        "<td data-title='Qty Kg/Ltr'>" +
        "<input type='text' value='"+unit_data+"'/>" +
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

