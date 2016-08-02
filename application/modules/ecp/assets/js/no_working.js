$(document).on("focusin", "#cur_date", function(event) {
    $(this).prop('readonly', true);
});

$(document).on("focusout", "#cur_date", function(event) {
    $(this).prop('readonly', false);
});

$(document).on('click','.leave_date', function(){
   var date= $(this).attr('rel');
    $('#cur_date').val(date);

    var param = $("#no_working").serializeArray();


    $.ajax({
        type: 'POST',
        url: site_url + "ecp/check_no_working_type",
        data: param,
        success: function (resp) {
            if(resp != 0){
                var obj = jQuery.parseJSON(resp);
                var no_working_id = 'no_working_'+obj.reason_country_id;

                $('div.check_no_worh input').each(function( index,element  ){
                    var no_working_detail_id= $(this).attr('attr-id');
                    if(no_working_detail_id == no_working_id)
                    {
                        $(this).attr('checked','checked');

                        var radio_type = $('input[name=radio]:checked').attr('id');

                        if(radio_type == 'other')
                        {
                            $("div#othr_reason").css("display","block");
                        }
                        else{
                            $("div#othr_reason").css("display","none");
                        }
                    }
                   // alert(no_working_detail_id +"====="+no_working_id);
                });
                $('#no_working_id').val(obj.no_working_id);
                $('#oth_reason').val(obj.other_reason);
                $('.delete_button').css("display","block");
            }
            else{
                $('input[name=radio]').prop('checked', false);
                $('#no_working_id').val('');
                $('#oth_reason').val('');
                $("div#othr_reason").css("display","none");
                $('.delete_button').css("display","none");
            }
        }
    });
    return false;
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

    $("#no_working #submit").on("click",function(){

        var param = $("#no_working").serializeArray();

        var $valid = $("#no_working").valid();
        if(!$valid) {
            no_working_validators.focusInvalid();
            return false;
        }
        else
        {

            $('.save_btn button').attr('disabled','disabled');
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

$(document).on('click', 'div.delete_button', function () {

    if (confirm("Are you sure?")) {
        var delete_param = $("#no_working").serializeArray();
        $.ajax({
            type: 'POST',
            url: site_url+'ecp/delete_no_working_details',
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
        url: site_url + "ecp/getNoWorkingDetailByMonth",
        data: {cur_month:iMonth},
        success: function (resp) {
            $('#calendar').html(resp);
        }
    });
}


