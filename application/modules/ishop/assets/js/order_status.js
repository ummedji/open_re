/**
 * Created by webclues on 5/26/2016.
 */
$(document).ready(function(){
    
    $("#order_status").on("submit",function(){
        
        var param = $("form#order_status").serializeArray();
        
        $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_order_status_data",
                data: param,
                dataType : 'html',
                success: function(resp){
                    console.log(resp);
                 //   alert(resp);
                    $("div#order_status_middle_container").empty();
                    $("div#order_status_middle_container").html(resp);
                    
                }
            });
        return false;
    });
    
    $(document).on('click', 'div.order_status .eye_i', function () {
    var id = $(this).attr('prdid');
    var radio_checked = $('input[name=radio1]:checked').val();
    var login_customer_type = $("input#login_customer_type" ).val();
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_order_status_data_details',
        data: {id: id,radiochecked:radio_checked,logincustomertype:login_customer_type},
        success: function(resp){
            $("div#order_status_table_container").empty();
            $("#order_status_table_container").html(resp);
        }
    });
    return false;
});


$(document).on('click', 'div.order_status .edit_i', function () {
    var id = $(this).attr('prdid');
   
   
   
   //UNIT
   
   var unit_value = $("div.unit_"+id+" span.unit").text();
   
   alert(id+"===="+unit_value);
   
   var selected_data1 = "";
   var selected_data2 = "";
   var selected_data3 = "";
   
   if(unit_value === "box"){
       alert("1");
       selected_data1 = 'selected = "selected"';
   }
   
   if(unit_value === "packages"){
       alert("2");
       selected_data2 = 'selected = "selected"';
   }
   
   if(unit_value === "kg/ltr"){
       alert("3");
       selected_data3 = 'selected = "selected"';
   }
   
  
   
   $("div.unit_"+id).empty();
   $("div.unit_"+id).append('<select name="units[]" class="select_unitdata" id="units_'+id+'"> <option '+selected_data1+' value="box">Box</option> <option '+selected_data3+' value="packages">Packages</option><option '+selected_data2+' value="kg/ltr">Kg/Ltr</option> </select>');
   
   //QUANTITY
   
   var qty_value = $("div.qty_"+id+" span.qty").text();
   $("div.qty_"+id).empty();
   $("div.qty_"+id).append('<input type="text" class="quantity_data" name="quantity[]" value="'+qty_value+'"/>');
   
   //AMOUNT
   
   var amount_value = $("div.amount_"+id+" span.amount").text();
   $("div.amount_"+id).empty();
   $("div.amount_"+id).append('<input type="text" name="amount[]" value="'+amount_value+'"/>');
   
   //APPROVED QUANTITY
   
   var dispatched_quantity_value = $("div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
   $("div.dispatched_quantity_"+id).empty();
   $("div.dispatched_quantity_"+id).append('<input type="text" name="dispatched_quantity[]" value="'+dispatched_quantity_value+'"/>');
   
    
  /*  $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_order_status_data_details',
        data: {id: id,radiochecked:radio_checked,logincustomertype:login_customer_type},
        success: function(resp){
            $("div#order_status_table_container").empty();
            $("#order_status_table_container").html(resp);
        }
    });*/
    return false;
});


 $("input.select_customer_type").on("click",function(){
       
        $("div#order_status_middle_container").empty();
        $("div#order_status_table_container").empty();
       
       $("#form_date").val(" ");
       $("#to_date").val(" ");
       
 });
    
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