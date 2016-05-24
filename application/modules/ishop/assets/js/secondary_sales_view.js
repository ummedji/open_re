/**
 * Created by webclues on 5/20/2016.
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

/* Get  Secondary Sales Data*/
$("#secondary_sales_view").on("submit",function(){

    var param = $("#secondary_sales_view").serializeArray();
  //  console.log(param);

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/secondary_sales_view_details',
        data: param,
        success: function(resp){
            console.log(resp);
            $("#middle_container_secondary").html(resp);
        }
    });

    return false;
});

/*Get  Secondary Sales Data*/


/*Get Secondary Sales Product Data*/
$(document).on('click', 'div.secondary_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/secondary_sales_product_details_view',
        data: {id: id},
        success: function(resp){
            $("#product_table_container_secondary").html(resp);
        }
    });
    return false;
});
/*Get  Secondary Sales Data*/