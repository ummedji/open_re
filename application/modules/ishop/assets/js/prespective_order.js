/**
 * Created by webclues on 5/25/2016.
 */

$(document).ready(function(){

    $('#form_date').datepicker({
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

    var prespective_order_validators = $("#prespective_order").validate({
        rules: {
            form_date:{
                required: true
            },
            to_date:{
                required: true

            }
        }
    });

    $(document).on(":input",'change',function() {
        $(this).valid();
    });

    
    $("#prespective_order").on("submit",function(e){
        e.preventDefault();

        var param = $("#prespective_order").serializeArray();

        var $valid = $("#prespective_order").valid();
        if(!$valid) {
            prespective_order_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_prespective_order",
                data: param,
                dataType : 'html',
                success: function(resp){
                    console.log(resp);
                    $("div#middle_container").html(resp);
                    $("#middle_container_product").empty();

                }
            });
            return false;
        }
    });


    $('#download_csv').on('click',function(){

        var param = $("#prespective_order").serialize();

        var $valid = $("#prespective_order").valid();
        if(!$valid) {
            prespective_order_validators.focusInvalid();
            return false;
        }
        else {
            var export_url = site_url + "ishop/prespective_order_details_csv_report?" + param+"&page="+$("input#page").val();

            window.location.href = export_url;
        }
        return false;

    });
    
});

$(document).on('click', 'div.order_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $('div.order_cont').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_prespective_order_details',
        data: {id: id},
        success: function(resp){
            $("#middle_container_product").html(resp);
        }
    });

    $('#main').animate({
        scrollTop: $(document).height()
    }, 1000);
    
    $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top 
     }, "slow");
        
    return false;
});
   
function mark_as_read(order_id){
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/mark_order_as_read',
        data: {orderid: order_id},
        success: function(resp){
          //  alert(resp);
            
            $("a.read_"+order_id).parent().html("Read");
            
             $("a.read_"+order_id).remove();
        }
    });
    return false;
    
} 

 
function mark_as_unread(order_id){
    
     $.ajax({
        type: 'POST',
        url: site_url+'ishop/mark_order_as_unread',
        data: {orderid: order_id},
        success: function(resp){
            
             $("a.unread_"+order_id).parent().html("<a class='read_"+order_id+"'  href='javascript:void(0);'  onclick = 'mark_as_read("+order_id+");'>Mark as Read</a>");
            
             $("a.unread_"+order_id).remove();
        }
    });
    return false;
    
} 
   
