/**
 * Created by webclues on 5/16/2016.
 */

/*Date Picker*/
$(function () {
    $('#form_date').datepicker({
        format: "yyyy-mm-dd"
    });

});

$(function () {
    $('#to_date').datepicker({
        format: "yyyy-mm-dd"
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