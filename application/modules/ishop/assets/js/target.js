/**
 * Created by webclues on 5/17/2016.
 */

$(document).ready(function(){
    
    $( "#month_data" ).datepicker({
      format: "yyyy-mm",
      showOn: "button",
      buttonImage: site_url+"/public/themes/default/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      autoclose: true
    });
    
    $( "#from_month_data" ).datepicker({
      format: "yyyy-mm",
      showOn: "button",
      buttonImage: site_url+"/public/themes/default/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      autoclose: true
    });
    
    $( "#to_month_data" ).datepicker({
      format: "yyyy-mm",
      showOn: "button",
      buttonImage: site_url+"/public/themes/default/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
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
   
   
   $("input.select_customer_type").on("click",function(){
       
       var customer_type_selected = $(this).val();
       
       $("thead.target_head_show_data").empty();
       $("tbody#target_data").empty();
       
      // alert(customer_type_selected);
       
       if(customer_type_selected == "retailer"){
           $("div.distributor_data").css("display","none");
           $("div.retailer_data").css("display","block");
           
           $("div.distributor_checked").css("display","none");
           $("div.farmer_checked").css("display","none");
           $("div.retailer_checked").css("display","block");
           
           if(login_customer_type == 8){
       
                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

           }
           
           if(login_customer_type == 7){
       
                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

           }
           
       }
       else if(customer_type_selected == "distributor"){
           $("div.retailer_data").css("display","none");
           $("div.distributor_data").css("display","block");
           
           $("div.distributor_checked").css("display","block");
           $("div.farmer_checked").css("display","none");
           $("div.retailer_checked").css("display","none");
           
           
           if(login_customer_type == 8){
       
                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

           }
           
           
       }
       
       else if(customer_type_selected == "farmer"){
           $("div.retailer_data").css("display","none");
           $("div.distributor_data").css("display","none");
           
           $("div.distributor_checked").css("display","none");
           $("div.farmer_checked").css("display","block");
           $("div.retailer_checked").css("display","none");
           
           if(login_customer_type == 8){
       
                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

           }
       }
       
       
    if($("thead.target_head_show_data tr").length == 0){
        
        var head_html = "";
        
        head_html += '<tr>'+
                    '<th>Sr. No. <span class="rts_bordet"></span></th>'+
                    '<th class="numeric">Remove <span class="rts_bordet"></span></th>';
                    
         head_html += '<th>Geo L3<span class="rts_bordet"></span></th>';
          if(customer_type_selected == "retailer"){  
                head_html += '<th>Geo L2<span class="rts_bordet th_retailer_checked"></span></th>';
                
                head_html +=  '<th>Retailer Code <span class="rts_bordet th_distributor_checked"></span></th>'+
                    '<th>Retailer Name <span class="rts_bordet th_distributor_checked"></span></th>';
                
          }
         if(customer_type_selected == "distributor"){
                head_html +=  '<th>Distributor Code <span class="rts_bordet th_distributor_checked"></span></th>'+
                    '<th>Distributor Name <span class="rts_bordet th_distributor_checked"></span></th>';
         }        
         head_html += '<th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>'+
                    '<th class="numeric">Quantity <span class="rts_bordet"></span></th>'+
                '</tr>';
        
        $("thead.target_head_show_data").html(head_html);
        
        
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
       
       //if(login_customer_type == 7){
           
           get_user_by_geo_data(selected_geo_data);
           
       //}
       //else{
         //   get_lower_geo_by_parent_geo(selected_geo_data);
        //}
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
   
   
    $("select#geo_level_1_data").on("change",function(){
       
       var selected_geo_id = $(this).val();
       
       get_lower_geo_by_parent_geo(selected_geo_id);
       
      // console.log(selected_user_id +"===="+selected_user_geo_location);
       
   });
   
   $("select#geo_level_2_data").on("change",function(){
       
       var selected_geo_id = $(this).val();
       
       get_user_by_geo_data(selected_geo_id);
       
      // console.log(selected_user_id +"===="+selected_user_geo_location);
       
   });
   
   $("select#retailer_geo_level_2_data").on("change",function(){
       
       var selected_geo_id = $(this).val();
       
       get_user_by_geo_data(selected_geo_id);
       
      // console.log(selected_user_id +"===="+selected_user_geo_location);
       
   });
   
   $("select#retailer_data").on("change",function(){
       
       var login_customer_type = $("input#login_customer_type" ).val();
       
       if(login_customer_type == 8){
           
            var selected_customer_id = $(this).val();
            get_retailer_by_user(selected_customer_id);
            
        }
      // console.log(selected_user_id +"===="+selected_user_geo_location);
       
   });
   
   //ON ENTERING MOBILE NO GETTING GEO LOCATION DATA AND ASSOCIATED FARMER DATA AND THERE RETAILERS
   
   
   $("input.mobile_num").on("focusout",function(){
       
       var login_user_id = $("input#login_customer_id").val();
       var login_user_type = $("input#login_customer_type" ).val();
       
       var mobile_no = $(this).val();
       
       var login_user_countryid = $("input#login_customer_countryid").val();
       var url_seg = $("input.page_function" ).val();
       
       var checked_type = $('input[name=radio1]:checked').val();
       
       //GET FARMER DETAILES FOR FARMER ASSOCIATED WITH THAT MOBILE NUMBER FOR LOGINED USER
       
       var parent_geo_data = "";
       
        $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_data_from_mobile_num",
                data: {mobileno:mobile_no,loginuserid:login_user_id,loginusertype:login_user_type,user_country:login_user_countryid,urlsegment:url_seg},
                dataType : 'json',
                success: function(resp){
                    console.log(resp);
                    
                     
                        $("div#farmer_checked select#geo_level_1_data").empty();
                        $("div#farmer_checked select#geo_level_1_data").selectpicker('refresh');
                
                
                        if(resp.length > 0){

                            $("div#farmer_checked select#geo_level_1_data").append('<option value="0">Select Geo Location</option>');

                            $.each(resp, function(key, value) {

                                $('div#farmer_checked select#geo_level_1_data').append('<option selected="selected" value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                                
                                parent_geo_data = value.political_geo_id;
                                
                            });

                            $("div#farmer_checked select#geo_level_1_data").selectpicker('refresh');

                        }
                    
                },
                async:false
            });
            
       var child_geo_data = "";
            
       $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lower_geo_by_parent_geo_formobile_data",
        data: {checkedtype:checked_type, user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,parent_geo_id:parent_geo_data,urlsegment:url_seg,moblie_num:mobile_no },
        dataType : 'json',
        success: function(resp){
            console.log(resp);
           
               if(login_customer_type == 8){
                    
                     if(checked_type == "farmer"){
                        
                        $("div#farmer_checked select#geo_level_2_data").empty();
                        $("div#farmer_checked select#geo_level_2_data").selectpicker('refresh');
                
                
                        if(resp.length > 0){

                            $("div#farmer_checked select#geo_level_2_data").append('<option value="0">Select Geo Location</option>');

                            $.each(resp, function(key, value) {

                                $('div#farmer_checked select#geo_level_2_data').append('<option selected="selected" value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                                
                                 child_geo_data = value.political_geo_id;
                                
                            });

                            $("div#farmer_checked select#geo_level_2_data").selectpicker('refresh');

                        }
                        
                        
                    }
                    
                }  
                
        },
        async:false
    });
    
    var selected_customer_data = "";
    
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:child_geo_data, country_id : login_user_countryid, checked_data:checked_type,moblie_num:mobile_no},
        dataType : 'json',
        success: function(resp){
            
            console.log(resp);
            
            
            $("div#farmer_checked select#farmer_data").empty();
            $("div#farmer_checked select#farmer_data").selectpicker('refresh');


            if(resp.length > 0){

                $("div#farmer_checked select#farmer_data").append('<option value="0">Select Geo Location</option>');

                $.each(resp, function(key, value) {

                    $('div#farmer_checked select#farmer_data').append('<option selected="selected" value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    
                     selected_customer_data = value.id;

                });

                $("div#farmer_checked select#farmer_data").selectpicker('refresh');

            }
            
            
        },
        async:false
        
       });
    
        if(selected_customer_data == "" || selected_customer_data == null){
            
            $("div#farmer_checked select#retailer_data").empty();
            $("div#farmer_checked select#retailer_data").selectpicker('refresh');
            
        }
        else{
            get_retailer_by_user(selected_customer_data);
        }
            
       
   });
   
   var data_array = [];


$("a#target_add_row").on("click",function(){

    var login_user_role = $("input#login_customer_type").val();
    var checked_type = "";
    
    var sku_code = $('#prod_sku option:selected').attr('attr-code');
    var sku_name = $('#prod_sku option:selected').attr('attr-name');
    var sku_id = $('#prod_sku option:selected').val();
    
    if(login_user_role == 8){
        
        var geo_level_val = $('#distributor_geo_level_1_data option:selected').val();
        var geo_level_name = $('#distributor_geo_level_1_data option:selected').html();

        var customer_val = $('#fo_distributor_data option:selected').val();
        var customer_name = $('#fo_distributor_data option:selected').html();
        
    }
    else
    {
        checked_type = $('input[name=radio1]:checked').val();
        //$("thead.target_head_show_data").empty();


        if(checked_type == "retailer"){

            var geo_level_val = $('#retailer_geo_level_1_data option:selected').val();
            var geo_level_name = $('#retailer_geo_level_1_data option:selected').html();

            var geo_level_val2 = $('#retailer_geo_level_2_data option:selected').val();
            var geo_level_name2 = $('#retailer_geo_level_2_data option:selected').html();

            var customer_val = $('#retailer_id option:selected').val();
            var customer_name = $('#retailer_id option:selected').html();

        }
        else{
            var geo_level_val = $('#distributor_geo_level_1_data option:selected').val();
            var geo_level_name = $('#distributor_geo_level_1_data option:selected').html();

            var customer_val = $('#distributor_distributor_id option:selected').val();
            var customer_name = $('#distributor_distributor_id option:selected').html();
        }

    }
    
    var monthdata = $('input#month_data').val();
    
    var quantity_data = $('input#quantity').val();
            
    
            
    //CHECK PRODUCT HAVING ALREADY ENTRY FOR SELECTED MONTH AND FOR SELECTED DISTRIBUTOR (DB CHECK)
    
    var data_status = 0;
    
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/check_target_data_status",
        data: {product_sku_id:sku_id,month_data:monthdata,customer_id:customer_val},
        success: function(resp){
            data_status = resp;
        },
        async:false
    });
    
    //alert(data_status);
    
    if(data_status == 1){
        
         alert("You have already entered value for selected product, selected distributor for selected month");
        
         //$('input#month_data').val(" ");
         $('select#distributor_geo_level_1_data').val(" ");
         $('select#prod_sku').val(" ");
         $('select#distributor_distributor_id').empty();
         
         $("select#distributor_geo_level_1_data").selectpicker('refresh');
         $("select#prod_sku").selectpicker('refresh');
         $("select#distributor_distributor_id").selectpicker('refresh');
         
         $('input#quantity').val(" ");
         
         $("#fo_distributor_data").empty();
         $("select#fo_distributor_data").selectpicker('refresh');
         
         return false;
        
    }
    
    
    
    //CHECK PRODUCT HAVING ALREADY ENTRY FOR SELECTED MONTH AND FOR SELECTED DISTRIBUTOR (CURRENT ADDED ROW CHECK)
    
    monthdata = monthdata.split("/");
    
   // alert($.inArray( sku_id+"-"+customer_val+"-"+monthdata[2]+"-"+monthdata[0]+"-01", data_array ));
    
    if($.inArray( sku_id+"-"+customer_val+"-"+monthdata[2]+"-"+monthdata[0]+"-01", data_array ) == -1){
        data_array.push(sku_id+"-"+customer_val+"-"+monthdata[2]+"-"+monthdata[0]+"-01");
        
     //   console.log(data_array);
    }
    else{
        
      //  console.log(data_array);
        
        alert("You have already entered value for selected product, selected distributor for selected month");
        
         //$('input#month_data').val(" ");
         $('select#distributor_geo_level_1_data').val(" ");
         $('select#prod_sku').val(" ");
         $('select#distributor_distributor_id').empty();
         
         $("select#distributor_geo_level_1_data").selectpicker('refresh');
         $("select#prod_sku").selectpicker('refresh');
         $("select#distributor_distributor_id").selectpicker('refresh');
         
         $('input#quantity').val(" ");
         
         $("#fo_distributor_data").empty();
         $("select#fo_distributor_data").selectpicker('refresh');
         
         return false;
        
    }
    
    
    var customer_code = "";

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_customer_code",
        data: {id:customer_val},
        success: function(resp){
            customer_code = resp;
        },
        async:false
    });
    
    var quantity = $('#quantity').val();
    var qty = "";
    var sr_no =$("#target_data > tr").length + 1;

    var box_selected = "";
    var package_selected = "";
    var kg_ltr_selected = "";
    
    var html = "";
    
     if(checked_type == "retailer"){
         html += "<td data-title='Geo L2'>" +
                    "<input type='hidden' name='geo_level_data[]' value='"+geo_level_val2+"' readonly/>" +
                   "<input class='input_remove_border' type='text' value='"+geo_level_name2+"' readonly/>" +
                "</td>"+
                
                "<td data-title='Retailer Code'>" +
               "<input class='input_remove_border' type='text' value='"+customer_code+"' readonly/>" +
            "</td>"+
            
             "<td data-title='Retailer Name'>" +
                "<input type='hidden' name='customer_data[]' value='"+customer_val+"' readonly/>" +
               "<input class='input_remove_border' type='text' value='"+customer_name+"' readonly/>" +
            "</td>";
     }else{
         html +=  "<td data-title='Distributor Code'>" +
               "<input class='input_remove_border' type='text' value='"+customer_code+"' readonly/>" +
            "</td>"+
            
             "<td data-title='Distributor Name'>" +
                "<input type='hidden' name='customer_data[]' value='"+customer_val+"' readonly/>" +
               "<input class='input_remove_border' type='text' value='"+customer_name+"' readonly/>" +
            "</td>";
     }
    

    $("#target_data").append(
        "<tr id='"+sr_no+"'>"+
            "<td data-title='Sr. No.' class='numeric'>" +
                "<input class='input_remove_border' type='text' value='"+sr_no+"' readonly/>" +
            "</td>"+
            
            "<td data-title='remove'>" +
                "<div class='edit_i' prdid ='"+sr_no+"'><a href='javascript:void(0);'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>&nbsp;<div class='delete_i' attr-dele=''><a href='javascript:void(0);'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
            "</td>"+
            
            "<td data-title='Geo L3'>" +
                "<input type='hidden' name='geo_level_data[]' value='"+geo_level_val+"' readonly/>" +
               "<input class='input_remove_border' type='text' value='"+geo_level_name+"' readonly/>" +
            "</td>"+
            
            html+
            
            "<td data-title='Product SKU Name'>" +
                "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
                "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
            "</td>"+
            "<td data-title='Quantity'>" +
                "<input readonly class='quantity_data' type='text' name='quantity[]' value='"+quantity+"' class='numeric' />" +
            "</td>"
            +
        "</tr>"
    );
    
   // $('input#month_data').val(" ");
   
    $("#fo_distributor_data").empty();
   
    $('select#distributor_geo_level_1_data').val(" ");
    $('select#prod_sku').val(" ");
    $('select#distributor_distributor_id').empty();

    $("select#fo_distributor_data").selectpicker('refresh');

    $("select#distributor_geo_level_1_data").selectpicker('refresh');
    $("select#prod_sku").selectpicker('refresh');
    $("select#distributor_distributor_id").selectpicker('refresh');

    $('input#quantity').val(" ");
    
}); 



});


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

                        $("div.retailer_data select#retailer_geo_level_2_data").append('<option value="0">Select Geo Location</option>');

                        $.each(resp, function(key, value) {

                            $('div.retailer_data select#retailer_geo_level_2_data').append('<option  value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                        });

                        $("div.retailer_data select#retailer_geo_level_2_data").selectpicker('refresh');

                    }
                    
                }
                else
                {
                    
                    if(checked_type == "farmer"){
                        
                        $("div#farmer_checked select#geo_level_2_data").empty();
                        $("div#farmer_checked select#geo_level_2_data").selectpicker('refresh');
                
                
                        if(resp.length > 0){

                            $("div#farmer_checked select#geo_level_2_data").append('<option value="0">Select Geo Location</option>');

                            $.each(resp, function(key, value) {

                                $('div#farmer_checked select#geo_level_2_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                            });

                            $("div#farmer_checked select#geo_level_2_data").selectpicker('refresh');

                        }
                        
                        
                    }
                    else if(checked_type == "retailer"){
                        
                        $("div#retailer_checked select#retailer_geo_level_2_data").empty();
                        $("div#retailer_checked select#retailer_geo_level_2_data").selectpicker('refresh');
                
                        if(resp.length > 0){

                            $("div#retailer_checked select#retailer_geo_level_2_data").append('<option value="0">Select Geo Location</option>');

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

                            $("div#distributor_checked select#distributor_geo_level_2_data").append('<option value="0">Select Geo Location</option>');

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
                   
                $("div#farmer_checked select#geo_level_1_data").append('<option value="0">Select Geo Location</option>');

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
                   
                $("div#distributor_checked select#distributor_geo_level_1_data").append('<option value="0">Select Geo Location</option>');

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

                        $("div.retailer_data select#retailer_geo_level_1_data").append('<option value="0">Select Geo Location</option>');

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

                        $("div#retailer_checked select#retailer_geo_level_1_data").append('<option value="0">Select Geo Location</option>');

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
    
    if($('input[name=radio1]:checked').length == 0){
        
        var checked_type = "distributor";
        
    }
    else{
   var checked_type = $('input[name=radio1]:checked').val();
    }
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

                    $("select#retailer_data").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#retailer_data").selectpicker('refresh');
                    
                }
                else if(checked_type == "distributor" && login_customer_type == 8 ){
                    
                     $("select#fo_distributor_data").empty();

                    $("select#fo_distributor_data").append('<option value="0">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#fo_distributor_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#fo_distributor_data").selectpicker('refresh');
                    
                }
                else if(checked_type == "distributor" && login_customer_type == 7 ){
                    
                     $("select#distributor_distributor_id").empty();

                    $("select#distributor_distributor_id").append('<option value="0">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#distributor_distributor_id').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#distributor_distributor_id").selectpicker('refresh');
                    
                }
                if(checked_type == "retailer" && login_customer_type == 7){
                    
                     $("select#retailer_id").empty();

                    $("select#retailer_id").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_id').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#retailer_id").selectpicker('refresh');
                    
                }
                else
                {
                    $("select#farmer_data").empty();

                    $("select#farmer_data").append('<option value="0">Select Farmer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#farmer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
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

                        $("select#distributor_data").append('<option value="0">Select Distributor Name</option>');

                        $.each(resp, function(key, value) {
                            $('select#distributor_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                        });

                        $("select#distributor_data").selectpicker('refresh');
                            
                  }else{
                        
                    $("select#retailer_data").empty();

                    $("select#retailer_data").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#retailer_data").selectpicker('refresh');

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
                        
                        $("select#retailer_distributor_id").append('<option value="0">Select Distributor Name</option>');
                        
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

//function target_add_row(data_array)
//{

//}

$("#order_place").on("submit",function(){

    var param = $("#order_place").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/order_place_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
            
           // window.location.href = site_url+"ishop/order_place";
           // return false;
           
        }
    });
   // return false; 
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
/*
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
            
            alert(sku_id+"==="+units+"==="+quantity+"==="+unit_data);
            
            $("input#qty_kg_ltr_"+$.trim(product_row_id)).val(unit_data);
            $("div.quantity_kg_ltr_"+$.trim(product_row_id) +" span.quantity_kg_ltr").text(unit_data);
            
        }
       
}); */

$(document).on('click', '#target_data .edit_i', function () {
    
    var id = $(this).attr('prdid');
   
    $("tr#"+id).find("input.quantity_data").removeAttr("readonly");
    
});
   
   
   
