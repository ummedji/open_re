/**
 * Created by webclues on 5/26/2016.
 */
$(document).ready(function(){
    
    setTimeout(function(){
      $("button#order_status").trigger("click");
    }, 1000);
    
    
    $("#form_date").datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    }).on('changeDate', function(selected){
        $('#to_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_date').datepicker('setStartDate', startDate);
    });
    
    
    $("#to_date").datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });

    $(document).on('click', 'div.order_status .eye_i', function () {
        
        //alert("INNN");
        
        var id = $(this).attr('prdid');
        var radio_checked = $('input[name=radio1]:checked').val();
        var login_customer_type = $("input#login_customer_type" ).val();
        var currentpage = $("input.page_function" ).val();

        $.ajax({
            type: 'POST',
            url: site_url+'ishop/get_order_status_data_details',
            data: {id: id,radiochecked:radio_checked,logincustomertype:login_customer_type,segment_data:currentpage},
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

$(document).on('submit','#order_status_data_details',function(){
        
    var param = $("form#order_status_data_details").serializeArray();

    $.ajax({
            type: 'POST',
            url: site_url+"ishop/update_order_status_detail_data",
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
    return false;
});

$(document).on('click','div#middle_container_product div.delete_i',function(){
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');

        $.ajax({
            type: 'POST',
            url: site_url+"ishop/delete_order_detail_data",
            data: {data_id:id},
            success: function(resp){
                location.reload();
            }
        });
    }
    else{
        return false;
    }

});

$(document).on('click','div#middle_container div.delete_i',function(){

    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');

        $.ajax({
            type: 'POST',
            url: site_url+"ishop/delete_product_order_data",
            data: {data_id:id},
            success: function(resp){
                location.reload();
            }
        });
    }
    else{
        return false;
    }

});




$(document).on('click', 'div.order_status .edit_i', function () {
    var id = $(this).attr('prdid');
   
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
   $("div.amount_"+id).append('<input id="amount_'+id+'" class="allownumericwithdecimal" type="text" name="amount[]" value="'+amount_value+'"/>');
   
   //APPROVED QUANTITY
   
   var dispatched_quantity_value = $("div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
   $("div.dispatched_quantity_"+id).empty();
   $("div.dispatched_quantity_"+id).append('<input id="dispatched_quantity_'+id+'" class="allownumericwithdecimal" type="text" name="dispatched_quantity[]" value="'+dispatched_quantity_value+'"/>');
   
    
  /*  $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_order_status_data_details',
        data: {id: id,radiochecked:radio_checked,logincustomertype:login_customer_type},
        success: function(resp){
            $("div#order_status_table_container").empty();
            $("#order_status_table_container").html(resp);
        }
    });*/
    $(this).prop("disabled",true);
    return false;
});


 $("input.select_customer_type").on("click",function(){
       
        $("div#middle_container").empty();
        $("div#middle_container_product").empty();
       
       $("#form_date").val(" ");
       $("#to_date").val(" ");
       
 });



    $(document).on('click', '#update_order_details', function (e) {
        e.preventDefault();

        var order_data = $("#order_status_view_data").serializeArray();
      /*  console.log(order_data);
        return false;*/
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/update_order_status_detail_data',
            data: order_data,
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




    /* var order_status_validators = $("#order_status").validate({
           // ignore: ".ignore",
            rules: {
                dis_distributor_geo_level_1_data :{
                    required: true
                },
                distributor_id :{
                    required: true
                },
                retailer_geo_level_2_data:{
                    required: true
                },
                retailer_geo_level_1_data:{
                    required: true
                },
                retailer_distributor_id:{
                    required: true
                },
                retailer_id :{
                    required: true
                },
                form_date:{
                    required: true
                },
                to_date:{
                    required: true
                },
                geo_level_2_data:{
                    required: true
                }
            }
        });
     */
    $("#order_status").on("submit",function(e){
        e.preventDefault();
        var param = $("form#order_status").serializeArray();
        
     /*   var validator = order_status_validators;

    var $valid = $("#order_status").valid();
    if(!$valid) {
        //alert('focusInvalid');
        validator.focusInvalid();
        return false;
    }
    else
    {*/
        $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_order_status_data",
                data: param,
                dataType : 'html',
                success: function(resp){
                    console.log(resp);
                    $("div#middle_container").html(resp);
                    $("#middle_container_product").empty();

                }
            });
            return false;
     /*   }*/

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

function show_po_popup(order_id,PO_no){

    $("div#myModal input#order_data").empty();
    $("div#myModal input#po_number_data").empty();
    
    $("div#myModal input#order_data").val(order_id);
    $("div#myModal input#po_number_data").val(PO_no);
    
    $('#myModal').modal('show');
    
}





$(document).on("click","#save_po_data",function(){
    
    var order_id = $("div#myModal input#order_data").val();
    var po_num_data = $("div#myModal input#po_number_data").val();
    
    
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_po_data',
        data: {orderid: order_id,po_numdata:po_num_data},
        success: function(resp){
            
             if(resp > 0){
                 
                 $("div#myModal div.modal-header").append("<div class='success_message'><span style='color:green;font-size:12px;text-align:center;'>Data updated Successfully.</span></div>");
                    
                    setTimeout(function(){
                        $("div.success_message").remove();
                     }, 1500);
                 
             }
             else{
                 
                 $("div#myModal div.modal-header").append("<div class='error_message'><span style='color:red;font-size:12px;text-align:center;'>Data not Updated.Entered PO No already exist.</span></div>");
                    
                    setTimeout(function(){
                        $("div.error_message").remove();
                     }, 1500);
                 
             }
             
             setTimeout(function(){
                    $(".modal-header .close").trigger("click");
             }, 2500);
             
             $("button#order_status").trigger("click");
             
             
             
        }
    });
});


$(document).on("click",".zoom_in_btn",function(e){
    e.preventDefault();
    $(".zoom_out_btn").toggleClass("zoom_out_btn_show");
    $(".ad_mr_top").toggleClass("ad_mr_top_30");
    $(".top_form").hide();
    $(".zoom_in_btn").hide();
    $(".middle_form").hide();
});

$(document).on("click",".zoom_out_btn",function(j){
    j.preventDefault();
    $(".zoom_out_btn").removeClass("zoom_out_btn_show");
    $(".top_form").show();
    $(".zoom_in_btn").show();
    $(".middle_form").show();
    /*$(".zoom_out_btn").hide();*/
    $(".ad_mr_top").removeClass("ad_mr_top_30");
});


