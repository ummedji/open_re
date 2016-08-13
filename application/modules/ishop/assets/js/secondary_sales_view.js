/**
 * Created by webclues on 5/20/2016.
 */

/*Date Picker*/
$(function () {
    $('#form_date').datepicker({
        format: date_format,
        autoclose: true
    }).on('changeDate', function(selected){
        $('#to_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_date').datepicker('setStartDate', startDate);
    });

});

$(function () {
    $('#to_date').datepicker({
        format: date_format,
        autoclose: true
    });
});

$(document).on(":input",'change',function() {
    $(this).valid();
});

/*Date Picker*/

// START ::: Added By Vishal Malaviya For Validation
var secondary_sales_view_validators = $("#secondary_sales_view").validate({
    ignore: ".ignore",
    rules: {
        form_date:{
            required: true
        },
        to_date:{
            required: true
        }
    }
});

// END ::: Added By Vishal Malaviya For Validation



/* Get  Secondary Sales Data*/
$("#secondary_sales_view").on("submit",function(e){

    e.preventDefault();
    var param = $("#secondary_sales_view").serializeArray();
  //  console.log(param);

    var $valid = $("#secondary_sales_view").valid();
    if(!$valid) {
        secondary_sales_view_validators.focusInvalid();
        return false;
    }
    else
    {
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/secondary_sales_view_details',
            data: param,
            success: function(resp){
                console.log(resp);
                $("#middle_container_product").empty();
                $("#middle_container").html(resp);
            }
        });
    }
    return false;
});

/*Get  Secondary Sales Data*/

/*Get Download Secondary Sales Data*/
$('#download_csv').on('click',function(){

    var param = $("#secondary_sales_view").serialize();

    var $valid = $("#secondary_sales_view").valid();
    if(!$valid) {
        secondary_sales_view_validators.focusInvalid();
        return false;
    }
    else {
        var export_url = site_url + "ishop/secondary_sales_details_csv_report?" + param+"&page="+$("input#page").val();

        window.location.href = export_url;
    }
    return false;

});

/*Get Download Secondary Sales Data*/




/*Get Secondary Sales Product Data*/
$(document).on('click', 'div.secondary_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $('div.secondary_cont').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/secondary_sales_product_details_view',
        data: {id: id},
        success: function(resp){
            $("#middle_container_product").html(resp);
        }
    });

    $('#main').animate({
        scrollTop: $(document).height()
    }, 1000);

  /*  $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top 
     }, "slow");
    */
    return false;
});
/*Get  Secondary Sales Data*/


/*$(document).on('click', 'div.secondary_cont .edit_i', function () {

    var id = $(this).attr('prdid');

   /!* var invoice_no = $("div.secondary_cont div.invoice_no_"+id+" span.invoice_no").text();
    $("div.secondary_cont div.invoice_no_"+id).empty();
    $("div.secondary_cont div.invoice_no_"+id).append('<input id="invoice_no_'+id+'" type="text" name="invoice_no[]" value="'+invoice_no+'"/>');
*!/

    //Invoice Date

    //var invoice_date = $("div.invoice_date_"+id+" span.invoice_date").text();
    //$("div.invoice_date_"+id).empty();
    //$("div.invoice_date_"+id).append('<input id="invoice_date_'+id+'" type="text" name="invoice_date" value="'+invoice_date+'"/>');


    //PO Number

    var po_value = $("div.secondary_cont div.PO_no_"+id+" span.PO_no").text();
    $("div.secondary_cont div.PO_no_"+id).empty();
    $("div.secondary_cont div.PO_no_"+id).append('<input type="hidden" name="secondary_sales_detail[]" value="'+id+'" /><input id="PO_no_'+id+'" type="text" class="PO_no_" name="PO_no[]" value="'+po_value+'"/>');

    //Order Tracking No

    var order_tracking_no = $("div.secondary_cont div.order_tracking_no_"+id+" span.order_tracking_no").text();
    $("div.secondary_cont div.order_tracking_no_"+id).empty();
    $("div.secondary_cont div.order_tracking_no_"+id).append('<input id="order_tracking_no_'+id+'" type="text" name="order_tracking_no[]" value="'+order_tracking_no+'"/>');

    $(this).prop("disabled",true);
    return false;
});*/


$(document).on('click', 'div.secondary_product .edit_i', function () {
    var id = $(this).attr('prdid');

    var prd_sku = $(" div.prd_"+id+" span.prd_sku").text();
    var units = $(" div.units_"+id+" span.units").text();

    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";

    // alert(prd_sku);
    if(units == 'Box'){
        box_selected = "selected = 'selected'"
    }
    if(units == 'Packages'){
        package_selected = "selected = 'selected'"
    }
    if(units == 'Kg/Ltr'){
        kg_ltr_selected = "selected = 'selected'"
    }

    $("div.units_"+id).empty();
    $("div.units_"+id).append('<input type="hidden" name="secondary_sales_product[]" value="'+id+'" />' +
        '<select name="units[]" class="select_unitdata" id="unit_id" >'+
        '<option '+box_selected+' value="box">Box</option>'+
        '<option  '+package_selected+' value="packages">Packages</option>'+
        '<option  '+kg_ltr_selected+' value="kg/ltr">Kg/Ltr</option>'+
        '</select>');

    //QTY

    var qty = $(" div.quantity_"+id+" span.quantity").text();
    $("div.quantity_"+id).empty();
    $("div.quantity_"+id).append('<input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="'+qty+'"/>');

    var qty_kg_ltr = $(" div.rol_quantity_kg_ltr_"+id+" span.rol_quantity_kg_ltr").text();
    $("div.rol_quantity_kg_ltr_"+id).empty();
    $("div.rol_quantity_kg_ltr_"+id).append('<input id="rol_quantity_kg_ltr_'+id+'" type="text" class="input_remove_border" name="qty_kgl[]" value="'+qty_kg_ltr+'" readonly/>');

    var amount = $(" div.amount_"+id+" span.amount").text();
    $("div.amount_"+id).empty();
    $("div.amount_"+id).append('<input id="amount_'+id+'" type="text" class="amount_rt_a allownumericwithdecimal"  name="amount[]" value="'+amount+'"/>');


    $(this).prop("disabled",true);
    return false;
});


$(document).on('click', '.edit_i', function () {
    $("div.check_save_btn").css("display","block");
});

$(document).on('click', 'div.check_save_btn #check_save', function () {
    var secondary_sales_data = $("#secondary_sales_view_data").serializeArray();
    console.log(secondary_sales_data);
//return false;
    $('.save_btn button').attr('disabled','disabled');
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_secondary_sales_details',
        data: secondary_sales_data,
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
    var quantity = $("input#quantity_"+$.trim(selected_row_id)).val();

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

$(document).on('click', 'div.secondary_cont .delete_i', function () {
    var id = $(this).attr('prdid');
    $('<div></div>').appendTo('body')
        .html('<div>Are You Sure?</div>')
        .dialog({
            appendTo: "#success_file_popup",
            modal: true,
            title: 'Are You Sure?',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: true,
            buttons: {
                OK: function () {
                    $(this).dialog("close");


                    $.ajax({
                        type: 'POST',
                        url: site_url+'ishop/delete_secondary_sales_details',
                        data: {secondary_sales_id:id},
                        success: function(resp){
                            location.reload();
                        }
                    });

                },
                Cancel: function () {
                    $(this).dialog("close");

                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });

    return false;

});

$(document).on('click', 'div.secondary_product .delete_i', function () {
    var id = $(this).attr('prdid');
    $('<div></div>').appendTo('body')
        .html('<div>Are You Sure?</div>')
        .dialog({
            appendTo: "#success_file_popup",
            modal: true,
            title: 'Are You Sure?',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: true,
            buttons: {
                OK: function () {
                    $(this).dialog("close");

                    $.ajax({
                        type: 'POST',
                        url: site_url+'ishop/delete_secondary_sales_product_details',
                        data: {secondary_product_sales_id:id},
                        success: function(resp){
                            location.reload();
                        }
                    });

                },
                Cancel: function () {
                    $(this).dialog("close");

                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });

    return false;
});