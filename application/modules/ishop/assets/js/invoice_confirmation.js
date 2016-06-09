/**
 * Created by webclues on 5/24/2016.
 */

$(function () {
    $('#invoice_month').datepicker({
        format: "yyyy-mm"
    });
});


$("#invoice_confirmation").on("submit",function(){

    var param = $("#invoice_confirmation").serializeArray();

    get_invoice_confirmation_received(param);
    return false;
});

function get_invoice_confirmation_received(param)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/invoice_confirmation_received",
        data: param,
        dataType : 'html',
        success: function(resp){
            $("#middle_container_received").html(resp);
        }
    });


}

$(document).on("change",".received_status",function(){
    var sales_id =$(this).parent().find("input.sales_id").val();
    var param = $("#invoice_confirmation").serializeArray();

    update_invoice_confirmation_received(sales_id);
   // return false;
    get_invoice_confirmation_received(param);
});

function update_invoice_confirmation_received(sales_id)
{

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/update_invoice_confirmation_received",
        data: {sales:sales_id},
        success: function(resp){}
    });
}

/*Get Product Data*/

$(document).on('click', 'div.middle_container_received .eye_i', function () {
    var id = $(this).attr('prdid');
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/invoice_sales_product_details_view',
        data: {id: id},
        success: function(resp){
            $("#product_table_container_invoice").html(resp);

        }
    });
    return false;
});
/*Get Product Data*/

