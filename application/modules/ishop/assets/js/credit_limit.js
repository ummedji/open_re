/**
 * Created by webclues on 6/1/2016.
 */

$(function () {
    $('#curr_date').datepicker({
        format: "yyyy-mm-dd"
    });
});


$("#add_user_credit_limit").on("submit",function(){
    //alert('in');
    var param = $("#add_user_credit_limit").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/add_user_credit_limit_datails",
        data: param,
        //dataType : 'json',
        success: function(resp){
            if(resp==1){
                // site_url+"ishop/physical_stock";
            }
        }
    });
    //return false;
});