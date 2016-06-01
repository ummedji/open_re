/**
 * Created by webclues on 5/16/2016.
 */

/*Date Picker*/
$(function () {
    $('#form_date').datepicker({
        format: "yyyy-mm-dd",
         autoclose: true
    });

});

$(function () {
    $('#to_date').datepicker({
        format: "yyyy-mm-dd",
         autoclose: true
    });

});
/*Date Picker*/

/* Get  Primary Sales Data*/
$("#primary_sales_view").on("submit",function(){

    var param = $("#primary_sales_view").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/primary_sales_details_view',
        data: param,
        success: function(resp){
            console.log(resp);
            $("#middle_container").html(resp);
        }
    });

    return false;
});

/*Get  Primary Sales Data*/


/*Get Primary Sales Product Data*/
$(document).on('click', 'div.primary_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/primary_sales_product_details_view',
        data: {id: id},
        success: function(resp){
            $("#product_table_container").html(resp);
        }
    });
    return false;
});
/*Get  Primary Sales Data*/

$(document).on('click', 'div.primary_product .edit_i', function () {
    var id = $(this).attr('prdid');
    alert(id);

    //QUANTITY

    var qty_value = $("div.qty_"+id+" span.qty").text();
    $("div.qty_"+id).empty();
    $("div.qty_"+id).append('<input id="quantity_'+id+'" type="text" class="quantity_data" name="quantity[]" value="'+qty_value+'"/>');

    //AMOUNT

    var amount_value = $("div.amount_"+id+" span.amount").text();
    $("div.amount_"+id).empty();
    $("div.amount_"+id).append('<input id="amount_'+id+'" type="text" name="amount[]" value="'+amount_value+'"/>');

    //APPROVED QUANTITY

    var dispatched_quantity_value = $("div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
    $("div.dispatched_quantity_"+id).empty();
    $("div.dispatched_quantity_"+id).append('<input id="dispatched_quantity_'+id+'" type="text" name="dispatched_quantity[]" value="'+dispatched_quantity_value+'"/>');


    return false;
});