

$(document).on('click','.leave_date', function(){
   var date= $(this).attr('rel');
    $('#cur_date').val(date);
});

$(document).ready(function() {

    $("input.reason_type").on("click",function(){

        var reason_type = $(this).attr('id');

        if(reason_type == "other"){
            $("div#othr_reason").css("display","block");
        }
        else {
            $("div#othr_reason").css("display","none");
        }
    });

    var no_working_validators = $("#no_working").validate({
        rules: {

            cur_date:{
                required: true
            },
            radio:{
                required: true
            },
            oth_reason:{
                required: true
            }
        }
    });

    $("#no_working").on("submit",function(){

        var param = $("#no_working").serializeArray();

        var $valid = $("#no_working").valid();
        if(!$valid) {
            no_working_validators.focusInvalid();
            return false;
        }
        else
        {

            $.ajax({
                type: 'POST',
                url: site_url + "ecp/no_working_details",
                data: param,
                success: function (resp) {
                    var message = "";
                    if(resp == 1){

                        message += 'Data Inserted successfully.';
                    }
                    else{

                        message += 'Data not Inserted.';
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
        }
        return false;
    });


});


