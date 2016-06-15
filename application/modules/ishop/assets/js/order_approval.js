/**
 * Created by webclues on 6/1/2016.
 */
$(document).ready(function(){
    $('#form_date').datepicker({
        format: "yyyy-mm-dd"
    });
    $('#to_date').datepicker({
        format: "yyyy-mm-dd"
    });




    $("#order_approval").on("submit",function(e){

        e.preventDefault();

        var param = $("#order_approval").serializeArray();

       /* var $valid = $("#order_approval").valid();
        if(!$valid) {
            rol_validators.focusInvalid();
            return false;
        }
        else
        {*/
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/order_approval",
                data: param,

                success: function(resp){
                    //location.reload();

                    $("#middle_container").html(resp);

                }
            });
       // }
    });

});

$(document).on('click', 'input.order_status', function () {
    
    var row_data = $(this).attr("id");
    row_data = row_data.split("_");
    row_data = row_data[2];
    
    if($("input#check_data_"+row_data).val() == 0){
        var new_data = 1;
    }
    else{
        var new_data = 0;
    }
    
    $("input#check_data_"+row_data).val(new_data);
    
});



$(document).on('click', 'div#middle_container .eye_i', function () {
    var id = $(this).attr('prdid');
    var action_data = $('input.page_function').val();
    var login_customer_type = $("input#login_customer_type" ).val();
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_order_status_data_details',
        data: {id: id,logincustomertype:login_customer_type,segment_data:action_data},
        success: function(resp){
            $("div#middle_container_product").empty();
            $("#middle_container_product").html(resp);
        }
    });
    return false;
});

$(document).on('click', 'a.update_order_status', function () {
    
    var selected_action = $(this).attr("rel");
    
    $("form#update_order_approval_data input.selected_action").val(selected_action);
    
    
    var param = $("form#update_order_approval_data").serializeArray();
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_order_approval_status',
        data: param,
        success: function(resp){
            console.log(resp);
            //setTimeout(function(){
                location.reload();
           // }, 2000);
            
        }
    });
    return false;
    
});