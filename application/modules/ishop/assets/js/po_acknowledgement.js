/**
 * Created by webclues on 5/26/2016.
 */
$(document).ready(function(){
    
    $("input.confirm_data").on("click",function(){
        
       var checked_id = $(this).val();
       
       var confirm_val = $("input#confirm_data_"+checked_id).val();
       
       if(confirm_val == 0){
           $("input#confirm_data_"+checked_id).val(1);
       }
       else{
           $("input#confirm_data_"+checked_id).val(0);
       }
        
    });
});


$(document).on('click','div#middle_container_product div.delete_i',function(){
        
    var id = $(this).attr('prdid');

    $.ajax({
            type: 'POST',
            url: site_url+"ishop/delete_order_detail_data",
            data: {data_id:id},
            success: function(resp){
                console.log(resp);
                location.reload();
            }
        });
    return false;
});

$(document).on('click', 'div#middle_container_product .edit_i', function () {
    
    var id = $(this).attr('prdid');

    //alert(id);

   //UNIT
   
   var unit_value = $("div.unit_"+id+" span.unit").text();
   
  
   
   var selected_data1 = "";
   var selected_data2 = "";
   var selected_data3 = "";
   
   if(unit_value === "box"){
     
       selected_data1 = 'selected = "selected"';
   }
   
   if(unit_value === "packages"){
      
       selected_data2 = 'selected = "selected"';
   }
   
   if(unit_value === "kg/ltr"){
      
       selected_data3 = 'selected = "selected"';
   }
   
  
   
   $("div.unit_"+id).empty();
   $("div.unit_"+id).append('<select name="units[]" class="select_unitdata" id="units_'+id+'"> <option '+selected_data1+' value="box">Box</option> <option '+selected_data3+' value="packages">Packages</option><option '+selected_data2+' value="kg/ltr">Kg/Ltr</option> </select>');
   
   //QUANTITY
   
   var qty_value = $("div.qty_"+id+" span.qty").text();
   $("div.qty_"+id).empty();
   $("div.qty_"+id).append('<input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="'+qty_value+'"/>');
   
   //AMOUNT
   
   var amount_value = $("div.amount_"+id+" span.amount").text();
   $("div.amount_"+id).empty();
   $("div.amount_"+id).append('<input id="amount_'+id+'" type="text" name="amount[]" value="'+amount_value+'"/>');
   
   //APPROVED QUANTITY
   
   var dispatched_quantity_value = $("div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
   $("div.dispatched_quantity_"+id).empty();
   $("div.dispatched_quantity_"+id).append('<input id="dispatched_quantity_'+id+'" type="text" name="dispatched_quantity[]" value="'+dispatched_quantity_value+'"/>');
   
    
});


$(document).on('click', 'div.po_acknowledgement .eye_i', function () {
    var id = $(this).attr('prdid');
    var action_data = $('input.page_function').val();
    var login_customer_type = $("input#login_customer_type" ).val();
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_order_status_data_details',
        data: {id: id,logincustomertype:login_customer_type,segment_data:action_data},
        success: function(resp){
            //$("div#middle_container_product").empty();
            $("#middle_container_product").html(resp);
        }
    });
    return false;
});

