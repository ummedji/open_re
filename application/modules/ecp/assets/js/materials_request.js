$(document).ready(function() {

    $('#cancel_data').click(function(){
        $('#material_request')[0].reset();
        $('#promotional_country_id').selectpicker('val', '0');
    });

    var material_request_validators = $("#material_request").validate({
        rules: {
            promotional_country_id:{
                required: true
            },
            quantity:{
                required: true
            }
        }
    });


    $(document).on("submit","#material_request",function(e){
        e.preventDefault();
        var param = $("#material_request").serializeArray();

        var $valid = $("#material_request").valid();
        if(!$valid) {
            material_request_validators.focusInvalid();
            return false;
        }
        else
        {
            $('.save_btn button').attr('disabled','disabled');
            $.ajax({
                type: 'POST',
                url: site_url + "ecp/add_material_request_details",
                data: param,
                //dataType : 'json',
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

    $(document).on('change','#received_status',function(){

        var param = $("#update_material_request").serializeArray();

            $.ajax({
                type: 'POST',
                url: site_url + "ecp/update_material_request_details",
                data: param,
                //dataType : 'json',
                success: function (resp) {
                    var message = "";
                    if(resp == 1){

                        message += 'Data Updated successfully.';
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
        return false;
    });

});

$(document).on('click', 'div.material_request_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ecp/delete_material_details',
            data: {mr_id:id},
            success: function(resp){
                location.reload();
            }
        });
        return false;

    }
    else{
        return false;
    }

});