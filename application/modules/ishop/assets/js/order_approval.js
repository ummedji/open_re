/**
 * Created by webclues on 6/1/2016.
 */
$(document).ready(function(){
    $('#form_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    }).on('changeDate', function(selected){
        $('#to_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_date').datepicker('setStartDate', startDate);
    });

    $('#to_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });


    var order_approval_view_validators = $("#order_approval").validate({
        ignore: ".ignore",
        rules: {
            form_date:{
                required: true
            },
            to_date:{
                required: true
            }
        },
        messages: {
            form_date: {
                required: "Please Enter From Date."
            },
            to_date: {
                required: "Please Enter To Date."
            }
        }
    });


    $("#order_approval").on("submit",function(e){

        e.preventDefault();

        var param = $("#order_approval").serializeArray();

        var $valid = $("#order_approval").valid();
        if(!$valid) {
            order_approval_view_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/order_approval",
                data: param,
                success: function(resp){
                    $("#middle_container").html(resp);
                    $("#middle_container_product").empty();
                }
            });
       }
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

    $('div#middle_container').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

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
    
    $("body, html").animate({ 
        scrollTop: $( $(this).attr('href') ).offset().top 
    }, "slow");
    
    return false;
});

$(document).on('click', 'a.update_order_status', function () {
    
    var selected_action = $(this).attr("rel");
    
    $("form#update_order_approval_data input.selected_action").val(selected_action);
    
    
    var param = $("form#update_order_approval_data").serializeArray();
    
    var check_values = [];
    var i = 0;
    $("tbody.tbl_body_row tr td:first-child").each(function( index,element ) {
        
        if ($(this).find("input.order_status").prop('checked')==true){ 
            check_values[i] = 1;
        }else{
            check_values[i] = 0;
        }
       i++;
    });
    
    if($.inArray(1,check_values) != -1){
    
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/update_order_approval_status',
            data: param,
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

    }
    else
    {
        message = 'Please first check some data.';
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
                   
                }
            });
        
    }
    return false;
    
});