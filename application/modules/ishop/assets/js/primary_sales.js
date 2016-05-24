/**
 * Created by webclues on 5/15/2016.
 */
$(function () {
    $('#invoice_date').datepicker({
        format: "yyyy-mm-dd"
        });

});

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
                "<input type='text' value='"+sr_no+"' readonly/>" +
            "</td>"+
            "<td  data-title='Action' class='numeric'>" +
              /*  "<div class='edit_i'><a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>" +*/
                "<div class='delete_i primary_sls' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
            "</td>"+
            "<td data-title='Product SKU Code' class='numeric'>" +
                "<input type='text' value='"+sku_code+"' readonly/>" +
            "</td>"+
            "<td data-title='Product SKU Name'>" +
                "<input type='text' value='"+sku_name+"' readonly/>" +
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

    var param = $("#primary_sales").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/primary_sales_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
           if(resp==1){
               site_url+"ishop";
           }
        }
    });
    /*return false;*/
});
