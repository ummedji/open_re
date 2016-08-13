$(document).ready(function(){

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


    var allocation_activity_validators = $("#allocation_activity").validate({
        rules: {
            activity_type:{
                required: true
            },
            from_date:{
                required: true
            },
            to_date:{
                required: true
            }
        }
    });


    $("#allocation_activity").on("submit",function(e){

        e.preventDefault();

        var param = $("#allocation_activity").serializeArray();

        var $valid = $("#allocation_activity").valid();
        if(!$valid) {
            allocation_activity_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+'cco/allocation_activity_view',
                data: param,
                success: function(resp){
                     console.log(resp);
                    //$("#middle_container_product").empty();
                    $('#middle_container').html(resp);
                }
            });
            return false;
        }
    });
});


$(document).on("submit","#add_cco_activity",function(e){

    e.preventDefault();
   var param = $("#add_cco_activity").serializeArray();

    param.push({name: 'activity_type', value: $('input[name=radio1]:checked').val()});

    $.ajax({
        type: 'POST',
        url: site_url+'cco/add_cco_activity_details',
        data: param,
        success: function(resp){
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
        return false;

});
