$(document).ready(function() {

    $('#from_month').datepicker({
        format: "yyyy-mm",
        autoclose: true,

        viewMode: "months",
        minViewMode: "months"
    }).on('changeDate', function(selected){
        $('#to_month').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_month').datepicker('setStartDate', startDate);
    });

    $('#to_month').datepicker({
        format: "yyyy-mm",
        autoclose: true,

        viewMode: "months",
        minViewMode: "months"
    });


    var distributor_compititor_view_validators = $("#distributor_compititor_view").validate({
        rules: {
            from_month:{
                required: true
            },
            to_month:{
                required: true
            }
        }
    });


    $("input.analysis_type").on("click",function(){

        var analysis_type = $(this).val();

        if(analysis_type == "total"){

            $('#from_month').val('');
            $('#to_month').val('');
            $('#middle_container').empty();
            $("div.check_save_btn").css("display","none");
        }
        else if(analysis_type == "product"){
            $('#from_month').val('');
            $('#to_month').val('');
            $('#middle_container').empty();
            $("div.check_save_btn").css("display","none");
        }
    });

    $(document).on('click', '.edit_i', function () {
        var id = $(this).attr('prdid');
        var radio_checked = $('input[name=radio]:checked').val();
        //QUANTITY

        var qty_value = $("div.quantity_"+id+" span.quantity").text();
        $("div.quantity_"+id).empty();
        $("div.quantity_"+id).append('<input type="hidden" name="radio_checked" value="'+radio_checked+'" /><input type="hidden" name="id[]" value="'+id+'" /><input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="'+qty_value+'"/>');

        //AMOUNT
        var amount_value = $("div.amount_"+id+" span.amount").text();
        $("div.amount_"+id).empty();
        $("div.amount_"+id).append('<input type="hidden" name="radio_checked" value="'+radio_checked+'" /><input type="hidden" name="id[]" value="'+id+'" /><input id="amount_'+id+'" class="allownumericwithdecimal" type="text" name="amount[]" value="'+amount_value+'"/>');

        $(this).prop("disabled",true);
        return false;
    });

    $(document).on('click', '.edit_i', function () {
        $("div.check_save_btn").css("display","block");
    });


    /* Get all_material_request Data*/
    $("#distributor_compititor_view").on("submit",function(e){
        e.preventDefault();
        var param = $("#distributor_compititor_view").serializeArray();

        var $valid = $("#distributor_compititor_view").valid();
        if(!$valid) {
            distributor_compititor_view_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+'ecp/distributor_compititor_details_view',
                data: param,
                success: function(resp){
                    $('#middle_container').html(resp);
                }
            });
            return false;
        }
    });
    /*Get  all_material_request Data*/
});





$(document).on('click', 'div.check_save_btn #check_save', function () {
    var distributor_compititor = $("#distributor_compititor_view_data").serializeArray();

    $('.save_btn button').attr('disabled','disabled');
    $.ajax({
        type: 'POST',
        url: site_url+'ecp/update_compititor_details',
        data: distributor_compititor,
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

$(document).on('click', 'div.distributor_view_cont .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        var radio_checked = $('input[name=radio]:checked').val();

        $.ajax({
            type: 'POST',
            url: site_url+'ecp/delete_compititor_details',
            data: {id:id,radio_checked:radio_checked},
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
