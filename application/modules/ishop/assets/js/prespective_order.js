/**
 * Created by webclues on 5/25/2016.
 */

$(document).ready(function(){

    $('#form_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#to_date').datepicker({
        format: "yyyy-mm-dd",
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

                }
            });
            return false;
        }
    });
    
});

$(document).on('click', 'div.order_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_prespective_order_details',
        data: {id: id},
        success: function(resp){
            $("#middle_container_product").html(resp);
        }
    });
    return false;
});
   
function mark_as_read(order_id){
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/mark_order_as_read',
        data: {orderid: order_id},
        success: function(resp){
          //  alert(resp);
            
            $("a.read_"+order_id).parent().html("<a class='unread_"+order_id+"'  href='javascript:void(0);'  onclick = 'mark_as_unread("+order_id+");'>Mark as Unread</a>");
            
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
   
