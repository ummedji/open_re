$(document).ready(function(){


    getActivityDetailByType('planned_activity');

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
            },
            cco_data:{
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

                    $('#middle_container').html(resp);
                    $('.zoom_space').css('display','none');
                }
            });
            return false;
        }
    });

    var add_allocation_activity_validators = $("#add_cco_activity").validate({
        rules: {

            cco_data:{
                required: true
            }
        }
    });
});

$(document).on("change","input.select_customer_type",function(){

    var activity_type_selected = $(this).val();

    if(activity_type_selected == "planned_activity") {
        $('#middle_container').empty();
        getActivityDetailByType(activity_type_selected);

    }
    else if(activity_type_selected == "executed_activity") {
        $('#middle_container').empty();
        getActivityDetailByType(activity_type_selected);

    }

});

$(document).on("submit","#add_cco_activity",function(e){

    e.preventDefault();
   var param = $("#add_cco_activity").serializeArray();

    param.push({name: 'activity_type', value: $('input[name=radio1]:checked').val()});

    var $valid = $("#add_cco_activity").valid();
    if(!$valid) {
        add_allocation_activity_validators.focusInvalid();
        return false;
    }
    else
    {
        $('.svn_btn button').attr('disabled','disabled');
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
    }
    return false;

});

function getActivityDetailByType(activity_type)
{
    $.ajax({
        type: 'POST',
        url: site_url+'cco/get_activity_by_type',
        data: {activity_type:activity_type},
        success: function(resp){
            $('.cco_details').html(resp);
            $('.zoom_space').css('display','none');
        }
    });
    return false;
}

$(document).on("click","#cancel_data",function(e){

    var selected_cco = [];
    $('input.check:checked').each(function() {
        selected_cco.push($(this).val());
    });

    $('<div></div>').appendTo('body')
        .html('<div>Are You Sure?</div>')
        .dialog({
            appendTo: "#success_file_popup",
            modal: true,
            title: 'Are You Sure?',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: true,
            buttons: {
                OK: function () {

                    $(this).dialog("close");

                    $.ajax({
                        type: 'POST',
                        url: site_url+"cco/delete_activity_allocation",
                        data: {selected_cco:selected_cco},
                        dataType : 'html',
                        success: function(resp){
                            var message = "";
                            if(resp == 1){

                                message += 'Data Deleted successfully.';
                            }
                            else{

                                message += 'Data not Deleted.';
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
                },
                Cancel: function () {
                    $(this).dialog("close");

                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });

    return false;

});


$(document).on('click', 'div.cco_details input.check', function() {

    if($(this).is(":checked"))
    {
        $("div.delete_button").css("display","inline-block");
    }
    else
    {
        if($("div.cco_details tbody.tbl_body_row tr td:nth-child(2) input.check:checked").length <= 0) {
            $("div.delete_button").css("display", "none");
        }

    }
});

$(document).on('click', 'div.activity_data input.check', function() {

    if($(this).is(":checked"))
    {
        $("button.save_btn").css("display","inline-block");
    }
    else
    {
        if($("div.activity_data tbody.tbl_body_row tr td:nth-child(2) input.check:checked").length <= 0) {
            $("button.save_btn").css("display", "none");
        }

    }
});


$(document).on('click','#download_allocation',function(){

    var activity_type = $('input[name=radio1]:checked').val();

    var export_url = site_url + "cco/activity_allocation_details_csv_report?" + "activity_type="+activity_type+"&page="+$("input#page").val();

    window.location.href = export_url;

    return false;

});