
$(document).on("focusin", "#cur_date", function(event) {
    $(this).prop('readonly', true);
});

$(document).on("focusout", "#cur_date", function(event) {
    $(this).prop('readonly', false);
});
$(document).on('click','.leave_date', function(){
    var date= $(this).attr('rel');
    $('#cur_date').val(date);

    var param = $("#leave_set").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "ecp/check_leave_type",
        data: param,
        success: function (resp) {
            if(resp != 0){
                var obj = jQuery.parseJSON(resp);
                var leave_id = 'leave_'+obj.leave_type_country_id;

                $('div.check_leave input').each(function( index,element  ){
                    var leave_detail_id= $(this).attr('attr-id');
                    if(leave_detail_id == leave_id)
                    {
                        $(this).attr('checked','checked');
                    }
                });
                $('#leave_id').val(obj.leave_id);
                $('.delete_button').css("display","block");
            }
            else{
                $('input[name=radio]').removeAttr('checked');
                $('#leave_id').val('');
                $('.delete_button').css("display","none");
            }
        }
    });
    return false;
});


$(document).ready(function() {

  /*  var d = new Date();
    var curr_month = d.getMonth() + 1;

    getCalenderDaqta(curr_month);*/

    var leave_set_validators = $("#leave_set").validate({
        rules: {
            cur_date:{
                required: true
            },
            radio:{
                required: true
            }
        }
    });

    $("#leave_set #submit").on("click",function(){

        var param = $("#leave_set").serializeArray();

        var $valid = $("#leave_set").valid();
        if(!$valid) {
            leave_set_validators.focusInvalid();
            return false;
        }
        else
        {

            $('.save_btn button').attr('disabled','disabled');
            $.ajax({
                type: 'POST',
                url: site_url + "ecp/leave_details",
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

$(document).on('click', 'div.delete_button', function () {

    if (confirm("Are you sure?")) {
        var delete_param = $("#leave_set").serializeArray();
        $.ajax({
            type: 'POST',
            url: site_url+'ecp/delete_leave_details',
            data: delete_param,
            success: function(resp){
                location.reload();
            }
        });
    }
    else{
        return false;
    }
    console.log(delete_param);
    return false;

});

function getCalenderData(iMonth)
{


    $.ajax({
        type: 'POST',
        url: site_url + "ecp/getLeaveDetailByMonth",
        data: {cur_month:iMonth},
        success: function (resp) {
           $('#calendar').html(resp);
        }
    });



}

