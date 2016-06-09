/**
 * Created by webclues on 5/31/2016.
 */

$(function () {
    $('#current_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('#batch_expiry_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('#batch_mfg_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('.expiry_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('.mfg_date').datepicker({
        format: "yyyy-mm-dd"
    });
});



$("#add_company_current_stock").on("submit",function(){
    //alert('in');
    var param = $("#add_company_current_stock").serializeArray();
  // console.log(param);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/add_company_current_stock_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
            if(resp==1){
                // site_url+"ishop/physical_stock";
            }
        }
    });

});


$(document).on('click', 'div.current_stock_container .edit_i', function () {
    var id = $(this).attr('prdid');

    //product_sku_id
    var product_sku_id = $("div.product_sku_id_"+id+" span.product_sku_id").text();
    $("div.product_sku_id_"+id).empty();
    $("div.product_sku_id_"+id).append('<input type="hidden" name="product_sku_id[]" value="'+product_sku_id+'" />');

    //cur_date

    var cur_date = $("div.date_"+id+" span.date").text();

    $("div.date_"+id).empty();
    $("div.date_"+id).append('<input type="hidden" name="cur_date[]" value="'+cur_date+'" />');


   // alert(product_sku_id);
   // alert(cur_date);
    //intrum_quantity

    var int_qty_value = $("div.int_qty_"+id+" span.int_qty").text();
    $("div.int_qty_"+id).empty();
    $("div.int_qty_"+id).append('<input type="hidden" name="stock_id[]" value="'+id+'" /><input id="int_qty_'+id+'" type="text" class="int_qty" name="int_qty[]" value="'+int_qty_value+'"/>');

    //unrestricted_quantity

    var unrtd_qty = $("div.unrtd_qty_"+id+" span.unrtd_qty").text();
    $("div.unrtd_qty_"+id).empty();
    $("div.unrtd_qty_"+id).append('<input id="unrtd_qty_'+id+'" type="text" name="unrtd_qty[]" value="'+unrtd_qty+'"/>');

    //batch

    var batch = $("div.batch_"+id+" span.batch").text();
    $("div.batch_"+id).empty();
    $("div.batch_"+id).append('<input id="batch_'+id+'" type="text" name="batch[]" value="'+batch+'"/>');

    //batch_exp_date

    var batch_exp_date = $("div.batch_exp_date_"+id+" span.batch_exp_date").text();
    $("div.batch_exp_date_"+id).empty();
    $("div.batch_exp_date_"+id).append('<input id="batch_exp_date_'+id+'" class="expiry_date" type="text" name="batch_exp_date[]" value="'+batch_exp_date+'"/>');

    //batch_mfg_date

    var batch_mfg_date = $("div.batch_mfg_date_"+id+" span.batch_mfg_date").text();
    $("div.batch_mfg_date_"+id).empty();
    $("div.batch_mfg_date_"+id).append('<input id="batch_mfg_date_'+id+'"  class="mfg_date" type="text" name="batch_mfg_date[]" value="'+batch_mfg_date+'"/>');

    return false;
});

$(document).on('click', 'div.current_stock_container .edit_i', function () {
    $("div.check_save_btn").css("display","block");
});



$(document).on('click', 'div.check_save_btn #check_save', function () {
    var current_stock_data = $("#update_current_stock").serializeArray();
    //console.log(current_stock_data);
    //return false;
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_current_stock_details',
        data: current_stock_data,
        success: function(resp){
        }
    });

});

$(document).on('click', 'div.current_stock_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_current_stock_details',
            data: {stock_id:id},
            success: function(resp){}
        });
    }
    else{
        return false;
    }

});