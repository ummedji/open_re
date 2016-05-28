/**
 * Created by webclues on 5/25/2016.
 */
$(document).ready(function(){
    
    $("#prespective_order").on("submit",function(){
        
        var param = $("#prespective_order").serializeArray();
        
        $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_prespective_order",
                data: param,
                dataType : 'html',
                success: function(resp){
                    console.log(resp);
                 //   alert(resp);
                 //   $("div#middle_data_contailer").empty();
                    $("div#middle_container").html(resp);
                    
                }
            });
        return false;
    });
    
});

$(document).on('click', 'div.order_cont .eye_i', function () {
    var id = $(this).attr('prdid');

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_prespective_order_details',
        data: {id: id},
        success: function(resp){
            $("#product_table_container").html(resp);
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
            
            //$("#product_table_container").html(resp);
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
   
