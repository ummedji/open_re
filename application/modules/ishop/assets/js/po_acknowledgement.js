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
                        url: site_url+"ishop/delete_order_detail_data",
                        data: {data_id:id},
                        success: function(resp){
                            console.log(resp);
                            location.reload();
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

    var row_data = $(this).parent().parent().attr("class");

    //alert(row_data);
//return false;
    row_data = row_data.split("_");

   
   $("div.unit_"+id).empty();
   $("div.unit_"+id).append('<input type="hidden" name="order_data['+row_data[1]+']" value="'+id+'" /><select name="units['+row_data[1]+']" class="select_unitdata" id="units_'+id+'"> <option '+selected_data1+' value="box">Box</option> <option '+selected_data3+' value="packages">Packages</option><option '+selected_data2+' value="kg/ltr">Kg/Ltr</option> </select>');
   
   //QUANTITY
   
   var qty_value = $("div.qty_"+id+" span.qty").text();
   $("div.qty_"+id).empty();
   $("div.qty_"+id).append('<input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity['+row_data[1]+']" value="'+qty_value+'"/>');
   
   //AMOUNT
   
   var amount_value = $("div.amount_"+id+" span.amount").text();
   $("div.amount_"+id).empty();
   $("div.amount_"+id).append('<input id="amount_'+id+'" type="text" name="amount['+row_data[1]+']" value="'+amount_value+'"/>');
   
   //APPROVED QUANTITY
   
   var dispatched_quantity_value = $("div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
   $("div.dispatched_quantity_"+id).empty();
   $("div.dispatched_quantity_"+id).append('<input id="dispatched_quantity_'+id+'" type="text" name="dispatched_quantity['+row_data[1]+']" value="'+dispatched_quantity_value+'"/>');
   
    
});


$(document).on('click', '.eye_i', function () {

    var id = $(this).attr('prdid');

    $('div.report-box').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

    var action_data = $('input.page_function').val();
    var login_customer_type = $("input#login_customer_type" ).val();
   // alert("INNN");
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/get_order_status_data_details',
        data: {id: id,logincustomertype:login_customer_type,segment_data:action_data},
        success: function(resp){
            $("#middle_container_product").html(resp);
        }
    });
    
   /*  $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top 
     }, "slow");*/
        
    
    return false;
});

$(document).on("click",'form#po_acknowledgement button#update_po_order_details',function(e){
    e.preventDefault();
    var param = $("form#po_acknowledgement").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/po_acknowledgement",
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
                        $('input:checkbox').removeAttr('checked');
                        location.reload()
                    }
                });
        }
    });
    return false;
});



$(document).on("click",'form#update_order_status_detail_data button#update_po_order_details',function(e){
    e.preventDefault();
    var param = $("form#update_order_status_detail_data").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/update_po_acknowledgement_data",
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



$('#download_csv').on('click',function(){

    var param = $("#po_acknowledgement").serialize();

    var export_url = site_url + "ishop/po_acknowledgement_details_csv_report?" + param+"&page="+$("input#page").val();

    window.location.href = export_url;

    return false;

});