$(document).ready(function() {
    $("#from_month_data").datepicker({
        format: "yyyy-mm",
        autoclose: true
    });

    $("#to_month_data").datepicker({
        format: "yyyy-mm",
        autoclose: true
    });

    var target_view_validators = $("#target_view").validate({
        rules: {
            from_month_data:{
                required: true
            },
            to_month_data:{
                required: true
            }
        }
    });

    $("#target_view").on("submit",function(){
       // alert('in');
        var param = $("#target_view").serializeArray();
        console.log(param);

        var $valid = $("#target_view").valid();
        if(!$valid) {
            target_view_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_target_view",
                data: param,
                //dataType : 'json',
                success: function(resp){
                    $("#middle_container").html(resp);
                }
            });
            return false;
        }
    });
});