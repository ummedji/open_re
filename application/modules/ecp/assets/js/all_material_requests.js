$(document).ready(function() {

    $('#from_date').datepicker({
        format: date_format,
        autoclose: true
    }).on('changeDate', function(selected){
        $('#to_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_date').datepicker('setStartDate', startDate);
    });

    $('#to_date').datepicker({
        format: date_format,
        autoclose: true
    });


    var all_material_request_validators = $("#all_material_request").validate({
        rules: {
            from_date:{
                required: true
            },
            to_date:{
                required: true
            },
            designation_id:{
                required: true
            },
            employee_id:{
                required: true
            },
            status_id:{
                required: true
            }
        }
    });


    /* Get all_material_request Data*/
    $("#all_material_request").on("submit",function(e){
        e.preventDefault();
        var param = $("#all_material_request").serializeArray();
       // console.log(param);
        var $valid = $("#all_material_request").valid();
        if(!$valid) {
            all_material_request_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+'ecp/all_materials_details_view',
                data: param,
                success: function(resp){
                    $('#middle_container').html(resp);
                   // $('#check_save_btn').css('display','block')
                }
            });
            return false;
        }

    });
    /*Get  all_material_request Data*/
});
$(document).on('click', 'div.check_save_btn #check_save', function () {
    var materials_details = $("#all_materials_view_data").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+'ecp/update_materials_details',
        data: materials_details,
        success: function(resp){
            var message = "";
            if(resp == 1){

                message += 'Data Updated successfully.';
            }
            else{

                message += 'Data not Updated.';
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

$(document).on('click', 'div.materials_cont .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ecp/delete_material_details',
            data: {mr_id:id},
            success: function(resp){
                //return false;
                location.reload();
            }
        });
        return false;

    }
    else{
        return false;
    }

});

$(document).on("change","select#designation_id",function(){
    var designation_id = $(this).val();
    get_employee_by_role_id(designation_id);


});

function get_employee_by_role_id(designation_id)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/get_employees_by_designation_id",
        data: {designation_id:designation_id},
        dataType : 'json',
        success: function(resp){

            $("select#employee_id").empty();
            $("select#employee_id").selectpicker('refresh');

            if(resp.length > 0){

                $("select#employee_id").append('<option value="0">Select Employee</option>');

                $.each(resp, function(key, value) {
                    $('select#employee_id').append('<option  value="' + value.id + '" >' +value.display_name+ '</option>');
                });

                $("select#employee_id").selectpicker('refresh');

            }
        }
    });
}