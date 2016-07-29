/**
 * Created by webclues on 5/26/2016.
 */
$(document).ready(function(){

    $("#form_date").datepicker({
      format: date_format,
      autoclose: true
    }).on('changeDate', function(selected){
        $('#to_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_date').datepicker('setStartDate', startDate);
    });
    
    
    $("#to_date").datepicker({
      format: date_format,
      autoclose: true
    });

    var login_customer_type = $("input#login_customer_type").val();

    //alert(login_customer_type);

    if(login_customer_type == 10){

        var customer_selected = $("input#login_customer_id").val();
        get_distributors(customer_selected);

    }
    else if(login_customer_type == 8){

        var customer_selected = $("input#login_customer_id").val();

        get_geo_fo_userdata(customer_selected,'farmer');

    }


    $("input.select_customer_type").on("change",function(){

        if($("#order_place").length > 0){
            var validator = $("#order_place").validate();
        }
        else{
            var validator = $("#order_status").validate();
        }
        validator.resetForm();

        var customer_type_selected = $(this).val();

        // alert(customer_type_selected);

        if(customer_type_selected == "retailer"){
            $("div.distributor_data").css("display","none");
            $("div.retailer_data").css("display","block");
            // $("div.retailer_data_checked").css("display","block");

            $("div.distributor_checked").css("display","none");
            $("div.farmer_checked").css("display","none");
            $("div.retailer_checked").css("display","block");

            if(login_customer_type == 8){

                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);
                $("select#retailer_data").selectpicker('refresh');

            }

            if(login_customer_type == 7){

                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

            }

            $("#order_place_data").empty();


        }
        else if(customer_type_selected == "distributor"){
            $("div.retailer_data").css("display","none");
            //$("div.retailer_data_checked").css("display","none");
            $("div.distributor_data").css("display","block");

            $("div.distributor_checked").css("display","block");
            $("div.farmer_checked").css("display","none");
            $("div.retailer_checked").css("display","none");


            if(login_customer_type == 8){

                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);
                $("select#retailer_data").selectpicker('refresh');
            }

            $("#order_place_data").empty();


        }

        else if(customer_type_selected == "farmer"){
            $("div.retailer_data").css("display","none");
            // $("div.retailer_data_checked").css("display","none");
            $("div.distributor_data").css("display","none");

            $("div.distributor_checked").css("display","none");
            $("div.farmer_checked").css("display","block");
            $("div.retailer_checked").css("display","none");

            if(login_customer_type == 8){

                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

            }

            $("#order_place_data").empty();
            $("select#retailer_data").selectpicker('refresh');
        }

    });


    $("select#geo_level_1_data").on("change",function(){

        var selected_geo_data = $(this).val();

        $("select#retailer_data").empty();
        $("select#farmer_data").empty();

        $("select#farmer_data").selectpicker('refresh');
        $("select#retailer_data").selectpicker('refresh');

        get_user_by_geo_data(selected_geo_data);

    });


    $("select#distributor_geo_level_1_data").on("change",function(){

        var selected_geo_data = $(this).val();

        if(login_customer_type == 7){

            get_user_by_geo_data(selected_geo_data);

        }
        else{
            get_lower_geo_by_parent_geo(selected_geo_data);
        }
    });


    $("select#distributor_geo_level_2_data").on("change",function(){

        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data);

    });

    $("select#farmer_data").on("change",function(){

        var selected_user_id = $(this).val();
        var selected_user_geo_location =  $("select#geo_level_1_data").val();

        get_retailer_by_user(selected_user_id);

        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });

    $("select#retailer_geo_level_1_data").on("change",function(){

        var selected_geo_id = $(this).val();

        get_lower_geo_by_parent_geo(selected_geo_id);

        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });


    $("select.geo_level_1_data").on("change",function(){

        var selected_geo_id = $(this).val();
        // alert(selected_geo_id);
        get_lower_geo_by_parent_geo(selected_geo_id);

        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });

    $("select.geo_level_2_data").on("change",function(){

        var selected_geo_id = $(this).val();

        get_user_by_geo_data(selected_geo_id);

        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });

    $("select#retailer_geo_level_2_data").on("change",function(){

        var selected_geo_id = $(this).val();

        get_user_by_geo_data(selected_geo_id);

        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });

    $("select.retailer_data").on("change",function(){

        var login_customer_type = $("input#login_customer_type" ).val();

        if(login_customer_type == 8){

            var selected_customer_id = $(this).val();
            get_retailer_by_user(selected_customer_id);

        }
        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });




    $(document).on('click', 'div.order_status .eye_i', function (e) {

        e.preventDefault();
        //alert("INNN");
        
        var id = $(this).attr('prdid');

        $('div.order_status').find('tr.bg_focus').removeClass();
        $(this).parents("tr").addClass("bg_focus");

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


/*
        $("body, html").animate({ 
            scrollTop: $( $(this).attr('href') ).offset().top 
        }, "slow");

        */

        $(window).scrollTop($("div#middle_container_product").offset().top);

        
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


   //

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

    var row_data = $(this).parent().parent().attr("class");
    row_data = row_data.split("_");
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
   $("div.unit_"+id).append('<select name="units['+row_data[1]+']" class="select_unitdata" id="units_'+id+'"> <option '+selected_data1+' value="box">Box</option> <option '+selected_data3+' value="packages">Packages</option><option '+selected_data2+' value="kg/ltr">Kg/Ltr</option> </select>');
   
   //QUANTITY
   
   var qty_value = $("div.qty_"+id+" span.qty").text();
   $("div.qty_"+id).empty();
   $("div.qty_"+id).append('<input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity['+row_data[1]+']" value="'+qty_value+'"/>');
   
   //AMOUNT
   
   var amount_value = $("div.amount_"+id+" span.amount").text();
   $("div.amount_"+id).empty();
   $("div.amount_"+id).append('<input id="amount_'+id+'" class="allownumericwithdecimal" type="text" name="amount['+row_data[1]+']" value="'+amount_value+'"/>');
   
   //APPROVED QUANTITY
   
   var dispatched_quantity_value = $("div.dispatched_quantity_"+id+" span.dispatched_quantity").text();
   $("div.dispatched_quantity_"+id).empty();
   $("div.dispatched_quantity_"+id).append('<input id="dispatched_quantity_'+id+'" class="allownumericwithdecimal" type="text" name="dispatched_quantity['+row_data[1]+']" value="'+dispatched_quantity_value+'"/>');
   
    
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



    $("body").on("change","select.select_unitdata",function(){

        var pathname = window.location.pathname;

        var action_segment = pathname.split("/");

        action_segment = action_segment[action_segment.length-1];

        if(action_segment == "order_place"){
            var selected_row_id = $(this).parent().parent().attr("id");

            var sku_id = $("input.sku_"+$.trim(selected_row_id)).val();

            var units = $(this).val();

            var quantity = $(this).parent().parent().find("input.quantity_data").val();

            var unit_data = get_data_conversion(sku_id,quantity,units);

            $("input.qty_"+$.trim(selected_row_id)).val(unit_data);

        }
        else
        {

            var selected_row_id = $(this).attr('id');
            var product_row_id = selected_row_id.split("_");
            product_row_id = product_row_id[1];

            var sku_id = $("input#sku_"+$.trim(product_row_id)).val();
            var units = $(this).val();
            var quantity = $("input#quantity_"+$.trim(product_row_id)).val();

            var unit_data = get_data_conversion(sku_id,quantity,units);

            $("input#qty_kg_ltr_"+$.trim(product_row_id)).val(unit_data);
            $("div.quantity_kg_ltr_"+$.trim(product_row_id) +" span.quantity_kg_ltr").text(unit_data);

        }


    });


    $("body").on("keyup","input.quantity_data",function(){


        var pathname = window.location.pathname;

        var action_segment = pathname.split("/");

        action_segment = action_segment[action_segment.length-1];

        if(action_segment == "order_place"){

            var selected_row_id = $(this).parent().parent().attr("id");

            var sku_id = $("input.sku_"+$.trim(selected_row_id)).val();

            var units = $(this).parent().parent().find("select.select_unitdata").val()

            var quantity = $(this).val();

            var unit_data = get_data_conversion(sku_id,quantity,units);

            $("input.qty_"+$.trim(selected_row_id)).val(unit_data);

        }
        else
        {

            var selected_row_id = $(this).attr('id');
            var product_row_id = selected_row_id.split("_");
            product_row_id = product_row_id[1];

            var sku_id = $("input#sku_"+$.trim(product_row_id)).val();
            var units = $("select#units_"+$.trim(product_row_id)).val();
            var quantity = $(this).val();

            var unit_data = get_data_conversion(sku_id,quantity,units);

            //  alert(sku_id+"==="+units+"==="+quantity+"==="+unit_data);

            $("input#qty_kg_ltr_"+$.trim(product_row_id)).val(unit_data);
            $("div.quantity_kg_ltr_"+$.trim(product_row_id) +" span.quantity_kg_ltr").text(unit_data);

        }

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

    var order_status = $("#order_status");
    order_status.validate();

    $("#order_status").on("submit",function(e){
        e.preventDefault();
        var param = $("form#order_status").serializeArray();

        var form_order_status = false;
        form_order_status = order_status.valid();

    if(form_order_status == false){
        return false;
    }
    else
    {
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
        }

    });

    $('#download_csv').on('click',function(){

        var param = $("#order_status").serialize();

        var form_order_status = false;
        form_order_status = order_status.valid();

        if(form_order_status == false){
            return false;
        }
        else
        {
            var export_url = site_url + "ishop/order_details_csv_report?" + param+"&page="+$("input#page").val();

            window.location.href = export_url;
        }
        return false;

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

    $("div#myModal #save_po_data").removeAttr("disabled");

    $("div#myModal input#order_data").empty();
    $("div#myModal input#po_number_data").empty();
    
    $("div#myModal input#order_data").val(order_id);
    $("div#myModal input#po_number_data").val(PO_no);
    
    $('#myModal').modal('show');
    
}

function get_lower_geo_by_parent_geo(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_type" ).val();
    var customer_selected = $("input#login_customer_id").val();

    var checked_type = $('input[name=radio1]:checked').val();
    var url_seg = $("input.page_function" ).val();


    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lowergeo_from_uppergeo_data",
        data: {checkedtype:checked_type, user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,parent_geo_id:selected_geo_id,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(login_customer_type == 7){

                $("div.retailer_data select#retailer_geo_level_2_data").empty();
                $("div.retailer_data select#retailer_geo_level_2_data").selectpicker('refresh');

                if(resp.length > 0){

                    $("div.retailer_data select#retailer_geo_level_2_data").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function(key, value) {

                        $('div.retailer_data select#retailer_geo_level_2_data').append('<option  value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div.retailer_data select#retailer_geo_level_2_data").selectpicker('refresh');

                }

            }
            else
            {

                if(checked_type == "farmer"){

                    $("div#farmer_checked select.geo_level_2_data").empty();
                    $("div#farmer_checked select.geo_level_2_data").selectpicker('refresh');


                    if(resp.length > 0){

                        $("div#farmer_checked select.geo_level_2_data").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function(key, value) {

                            $('div#farmer_checked select.geo_level_2_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                        });

                        $("div#farmer_checked select.geo_level_2_data").selectpicker('refresh');

                    }


                }
                else if(checked_type == "retailer"){

                    $("div#retailer_checked select#retailer_geo_level_2_data").empty();
                    $("div#retailer_checked select#retailer_geo_level_2_data").selectpicker('refresh');

                    if(resp.length > 0){

                        $("div#retailer_checked select#retailer_geo_level_2_data").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function(key, value) {

                            $('div#retailer_checked select#retailer_geo_level_2_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                        });

                        $("div#retailer_checked select#retailer_geo_level_2_data").selectpicker('refresh');

                    }

                }
                else if(checked_type == "distributor"){

                    $("div#distributor_checked select#distributor_geo_level_2_data").empty();
                    $("div#distributor_checked select#distributor_geo_level_2_data").selectpicker('refresh');


                    if(resp.length > 0){

                        $("div#distributor_checked select#distributor_geo_level_2_data").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function(key, value) {

                            $('div#distributor_checked select#distributor_geo_level_2_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                        });

                        $("div#distributor_checked select#distributor_geo_level_2_data").selectpicker('refresh');

                    }

                }


            }



        }
    });

}

function get_geo_fo_userdata(customer_selected,customer_type_selected){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_type" ).val();

    var url_seg = $("input.page_function" ).val();
    var checked_type = $('input[name=radio1]:checked').val();
    //alert(customer_selected+"==="+login_user_countryid+"==="+login_customer_type+"==="+customer_type_selected);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_geo_fo_userdata",
        data: {user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,customer_type_selected:customer_type_selected,urlsegment:url_seg,checkedtype:checked_type },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(customer_type_selected == "farmer"){

                $("div#farmer_checked select#geo_level_1_data").empty();
                $("div#farmer_checked select#geo_level_1_data").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#farmer_checked select#geo_level_1_data").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#farmer_checked select#geo_level_1_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#farmer_checked select#geo_level_1_data").selectpicker('refresh');
                }

            }

            if(customer_type_selected == "distributor"){

                $("div#distributor_checked select#distributor_geo_level_1_data").empty();
                $("div#distributor_checked select#distributor_geo_level_1_data").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#distributor_checked select#distributor_geo_level_1_data").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#distributor_checked select#distributor_geo_level_1_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#distributor_checked select#distributor_geo_level_1_data").selectpicker('refresh');

                }

            }

            if(customer_type_selected == "retailer"){

                if(login_customer_type == 7){

                    $("div.retailer_data select#retailer_geo_level_1_data").empty();
                    $("div.retailer_data select#retailer_geo_level_1_data").selectpicker('refresh');


                    if(resp.length > 0){

                        $("div.retailer_data select#retailer_geo_level_1_data").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function(key, value) {

                            $('div.retailer_data select#retailer_geo_level_1_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                        });

                        $("div.retailer_data select#retailer_geo_level_1_data").selectpicker('refresh');

                    }

                }
                else{

                    $("div#retailer_checked select#retailer_geo_level_1_data").empty();
                    $("div#retailer_checked select#retailer_geo_level_1_data").selectpicker('refresh');


                    if(resp.length > 0){

                        $("div#retailer_checked select#retailer_geo_level_1_data").append('<option value="">Select Geo Location</option>');

                        $.each(resp, function(key, value) {

                            $('div#retailer_checked select#retailer_geo_level_1_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                        });

                        $("div#retailer_checked select#retailer_geo_level_1_data").selectpicker('refresh');

                    }
                }

            }
        }
    });


}

function get_user_by_geo_data(selected_geo_data){

    $("select#retailer_data").empty();
    $("select#retailer_data").selectpicker('refresh');

    var checked_type = $('input[name=radio1]:checked').val();
    var login_customer_type = $("input#login_customer_type" ).val();

    //alert(checked_type);

    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){
            //console.log(resp);

            if(resp != 0){

                if(checked_type == "retailer" && login_customer_type == 8){

                    $("select#retailer_data").empty();

                    $("select#retailer_data").append('<option value="">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_data').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select#retailer_data").selectpicker('refresh');

                }
                else if(checked_type == "distributor" && login_customer_type == 8 ){

                    $("select#fo_distributor_data").empty();

                    $("select#fo_distributor_data").append('<option value="">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#fo_distributor_data').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#fo_distributor_data").selectpicker('refresh');

                }
                else if(checked_type == "distributor" && login_customer_type == 7 ){

                    $("select#distributor_distributor_id").empty();

                    $("select#distributor_distributor_id").append('<option value="">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#distributor_distributor_id').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select#distributor_distributor_id").selectpicker('refresh');

                }
                if(checked_type == "retailer" && login_customer_type == 7){

                    $("select#retailer_id").empty();

                    $("select#retailer_id").append('<option value="">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_id').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select#retailer_id").selectpicker('refresh');

                }
                else
                {
                    $("select#farmer_data").empty();

                    $("select#farmer_data").append('<option value="">Select Farmer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#farmer_data').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select#farmer_data").selectpicker('refresh');
                }
            }

        }
    });

}

function get_retailer_by_user(selected_user_id){

    var checked_type = $('input[name=radio1]:checked').val();
    var login_customer_type = $("input#login_customer_type" ).val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_retailer_by_customer_data",
        data: {user_id:selected_user_id,checkedtype:checked_type,logincustomerrole:login_customer_type},
        dataType : 'json',
        success: function(resp){
            //console.log(resp);

            if(resp != 0){

                if(checked_type == "retailer" && login_customer_type == 8){

                    $("select#distributor_data").empty();

                    $("select#distributor_data").append('<option value="">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#distributor_data').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select#distributor_data").selectpicker('refresh');

                }else{

                    $("select.retailer_data").empty();

                    $("select.retailer_data").append('<option value="">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select.retailer_data').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select.retailer_data").selectpicker('refresh');

                }
            }

        }
    });

}

function get_distributors(customer_type_selected){


    var login_customer_type = $("input#login_customer_type" ).val();
    if(login_customer_type == 10){
        var retailer_id = customer_type_selected;
    }
    else{
        var retailer_id = $("select#retailer_id option:selected" ).val();
    }
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_distributor_data",
        data: {retailerid:retailer_id},
        //dataType : 'json',
        success: function(resp){
            //console.log(resp);
            if(resp != 0){

                $("select#retailer_distributor_id").empty();

                $("select#retailer_distributor_id").append('<option value="">Select Distributor Name</option>');

                $.each(JSON.parse(resp), function(key, value) {
                    $('select#retailer_distributor_id').append('<option value="' + value.id + '">' + value.display_name + '</option>');
                });

                $("select#retailer_distributor_id").selectpicker('refresh');

            }
            else{
                $("select#retailer_distributor_id").empty();
                $("select#retailer_distributor_id").selectpicker('refresh');
            }
        }
    });

}

function get_data_conversion(sku_id,quantity,units){

    var unit_data = "";

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_quantity_conversion_data",
        data: {skuid:sku_id, quantity_data:quantity, unit : units},
        //dataType : 'json',
        success: function(resp){
            unit_data = resp;
        },
        async:false
    });

    return unit_data;

}





$(document).on("click","#save_po_data",function(){
    
    var order_id = $("div#myModal input#order_data").val();
    var po_num_data = $("div#myModal input#po_number_data").val();
    

    $("div#myModal #save_po_data").attr("disabled","disabled");

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
             }, 1600);
             
             $("button#order_status").trigger("click");

        }
    });

   // $("div#myModal #save_po_data").removeAttr("disabled");

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


