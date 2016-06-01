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