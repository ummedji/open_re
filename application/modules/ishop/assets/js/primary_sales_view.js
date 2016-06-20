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


// START ::: Added By Vishal Malaviya For Validation
var primary_sales_view_validators = $("#primary_sales_view").validate({
    ignore: ".ignore",
    rules: {
        form_date:{
            required: true
        },
        to_date:{
            required: true
        }
    },
    messages: {
        form_date: {
            required: "Please Enter From Date."
        },
        to_date: {
            required: "Please Enter To Date."
        }
    }
});
// END ::: Added By Vishal Malaviya For Validation


/* Get  Primary Sales Data*/
$("#primary_sales_view").on("submit",function(e){

    e.preventDefault();

    var param = $("#primary_sales_view").serializeArray();
   // console.log(param);return false;
    var $valid = $("#primary_sales_view").valid();
    if(!$valid) {
        primary_sales_view_validators.focusInvalid();
        return false;
    }
    else
    {
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/primary_sales_details_view',
            data: param,
            success: function(resp){
                // console.log(resp);
                $('#middle_container').html(resp);
            }
        });
        return false;
    }
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
            $("#middle_container_product").html(resp);
        }
    });
    return false;
});
/*Get  Primary Sales Data*/


$(document).on('click', 'div.primary_cont .edit_i', function () {
    var id = $(this).attr('prdid');

    var invoice_no = $("div.primary_cont div.invoice_no_"+id+" span.invoice_no").text();
    $("div.primary_cont div.invoice_no_"+id).empty();
    $("div.primary_cont div.invoice_no_"+id).append('<input type="hidden" name="primary_sales_detail[]" value="'+id+'" /><input id="invoice_no_'+id+'" type="text" name="invoice_no[]" value="'+invoice_no+'"/>');


    //Invoice Date

    //var invoice_date = $("div.invoice_date_"+id+" span.invoice_date").text();
    //$("div.invoice_date_"+id).empty();
    //$("div.invoice_date_"+id).append('<input id="invoice_date_'+id+'" type="text" name="invoice_date" value="'+invoice_date+'"/>');


    //PO Number

    var po_value = $("div.primary_cont div.po_no_"+id+" span.po_no").text();
    $("div.primary_cont div.po_no_"+id).empty();
    $("div.primary_cont div.po_no_"+id).append('<input id="po_no_'+id+'" type="text" class="po_no" name="PO_no[]" value="'+po_value+'"/>');

    //Order Tracking No

    var order_tracking_no = $("div.primary_cont div.order_tracking_no_"+id+" span.order_tracking_no").text();
    $("div.primary_cont div.order_tracking_no_"+id).empty();
    $("div.primary_cont div.order_tracking_no_"+id).append('<input id="order_tracking_no_'+id+'" type="text" name="order_tracking_no[]" value="'+order_tracking_no+'"/>');

    $(this).prop("disabled",true);
    return false;
});


$(document).on('click', 'div.primary_products .edit_i', function () {
    var id = $(this).attr('prdid');

    //QUANTITY

    var qty_value = $("div.primary_products div.qty_"+id+" span.qty").text();
    $("div.primary_products div.qty_"+id).empty();
    $("div.primary_products div.qty_"+id).append('<input type="hidden" name="primary_sales_product_detail[]" value="'+id+'" /><input id="quantity_'+id+'" type="text" class="quantity_data" name="quantity[]" value="'+qty_value+'"/>');

    //AMOUNT

    var amount_value = $("div.primary_products div.amount_"+id+" span.amount").text();
    $("div.primary_products div.amount_"+id).empty();
    $("div.primary_products div.amount_"+id).append('<input id="amount_'+id+'" type="text" name="amount[]" value="'+amount_value+'"/>');

    //APPROVED QUANTITY

    var dispatched_quantity_value = $("div.primary_products div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
    $("div.primary_products div.dispatched_quantity_"+id).empty();
    $("div.primary_products div.dispatched_quantity_"+id).append('<input id="dispatched_quantity_'+id+'" type="text" name="dispatched_quantity[]" value="'+dispatched_quantity_value+'"/>');

    $(this).prop("disabled",true);
    return false;
});

$(document).on('click', '.edit_i', function () {
    $("div.check_save_btn").css("display","block");
});

$(document).on('click', 'div.check_save_btn #check_save', function () {
    var primary_sales_data = $("#primary_sales_view_data").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_sales_details',
        data: primary_sales_data,
        success: function(resp){
            location.reload();
        }
    });
    //return false;
});


$(document).on('click', 'div.primary_cont .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_sales_details',
            data: {sales_id:id},
            success: function(resp){
                location.reload();
            }
        });
    }
    else{
        return false;
    }

});

$(document).on('click', 'div.primary_products .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_sales_product_details',
            data: {product_sales_id:id},
            success: function(resp){
                location.reload();
            }
        });
    }
   else{
        return false;
    }
});

