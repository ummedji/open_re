/**
 * Created by webclues on 5/17/2016.
 */

$(document).ready(function(){
    $( ".month_data" ).datepicker({
        format: "yyyy-mm",
        autoclose: true
    });
    $( "#from_copy_popup_datepicker" ).datepicker({
        format: "yyyy",
        autoclose: true
    });

    $( "#to_copy_popup_datepicker" ).datepicker({
        format: "yyyy",
        autoclose: true
    });

    var login_customer_type = $("input#login_customer_type").val();

    $("input.select_customer_type").on("click",function(){
        var validator = $("#budget").validate();
        validator.resetForm();

        var customer_type_selected = $(this).val();

        //  alert(customer_type_selected);
        if(customer_type_selected == "retailer"){

            $("a#retailer_xl").css("display","inline-block");
            $("a#distributor_xl").css("display","none");

            $("div.distributor_data").css("display","none");
            $("div.retailer_data").css("display","block");

            $("div.distributor_checked").css("display","none");
            $("div.retailer_checked").css("display","block");

            /* if(login_customer_type == 8){

             var customer_selected = $("input#login_customer_id").val();
             get_geo_fo_userdata(customer_selected,customer_type_selected);

             }*/

            if(login_customer_type == 7){

                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

            }
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/budget",
                data: {checked_type:'retailer'},
                //dataType : 'json',
                success: function(resp){
                    $(".budget_container").html(resp);
                }
            });

            //FOR COPY POPUP

            $("h4.modal-title").empty();
            $("h4.modal-title").append("Copy Retailer Data");

            $("select#from_customer_data").empty();
            $("select#to_customer_data").empty();

            $("select#from_customer_data").selectpicker('refresh');
            $("select#to_customer_data").selectpicker('refresh');

            $("input#from_copy_popup_datepicker").val('');
            $("input#to_copy_popup_datepicker").val('');

            $('input[name="radio_from_popup_month_data"]').prop('checked', false);
            $('input[name="checkbox_popup_month_data[]"]').prop('checked', false);
            get_copy_popup_geo_data(customer_type_selected);

            $('#month_data').val('');
            $('#distributor_geo_level_1_data').selectpicker('val', '');
            $('#distributor_distributor_id').selectpicker('val', '');
            $('#prod_sku').selectpicker('val', '');
            $('#quantity').val('');

        }

        else if(customer_type_selected == "distributor"){
            // alert("2222");
            $("a#retailer_xl").css("display","none");
            $("a#distributor_xl").css("display","inline-block");


            $("div.retailer_data").css("display","none");
            $("div.distributor_data").css("display","block");

            $("div.distributor_checked").css("display","block");
            $("div.retailer_checked").css("display","none");


            if(login_customer_type == 7){

                var customer_selected = $("input#login_customer_id").val();
                get_geo_fo_userdata(customer_selected,customer_type_selected);

            }


            $.ajax({
                type: 'POST',
                url: site_url+"ishop/budget",
                data: {checked_type:'distributor'},
                //dataType : 'json',
                success: function(resp){

                    $(".budget_container").html(resp);
                }
            });


            //FOR COPY POPUP

            $("h4.modal-title").empty();
            $("h4.modal-title").append("Copy Distributor Data");

            $("select#from_customer_data").empty();
            $("select#to_customer_data").empty();

            $("select#from_customer_data").selectpicker('refresh');
            $("select#to_customer_data").selectpicker('refresh');

            $("input#from_copy_popup_datepicker").val('');
            $("input#to_copy_popup_datepicker").val('');

            $('input[name="radio_from_popup_month_data"]').prop('checked', false);

            $('input[name="checkbox_popup_month_data[]"]').prop('checked', false);

            get_copy_popup_geo_data(customer_type_selected);

            $('#ret_month_data').val('');
            $('#retailer_geo_level_1_data').selectpicker('val', '');
            $('#retailer_geo_level_2_data').selectpicker('val', '');
            $('#retailer_id').selectpicker('val', '');
            $('#prod_sku').selectpicker('val', '');
            $('#quantity').val('');

        }
    });

    $("select#distributor_geo_level_1_data").on("change",function(){

        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data);
    });

    $("select#distributor_geo_level_2_data").on("change",function(){

        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data);

    });

    $("select#retailer_geo_level_1_data").on("change",function(){

        var selected_geo_id = $(this).val();
        get_lower_geo_by_parent_geo(selected_geo_id);
        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });

    $("select#retailer_geo_level_2_data").on("change",function(){

        var selected_geo_id = $(this).val();

        get_user_by_geo_data(selected_geo_id);

        // console.log(selected_user_id +"===="+selected_user_geo_location);

    });

    //CODE FOR COPY POPUP DATA

    $("select#from_popup_geo_data").on("change",function(){
        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data,'from_data');
    });

    $("select#to_popup_geo_data").on("change",function(){
        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data,'to_data');
    });

    //ON ENTERING MOBILE NO GETTING GEO LOCATION DATA AND ASSOCIATED FARMER DATA AND THERE RETAILERS

    var data_array = [];

    var target_validators = $("#budget").validate({
        //ignore:'.ignore',
        rules: {
            month_data:{
                required: true
            },
            ret_month_data:{
                required: true
            },
            distributor_geo_level_1_data:{
                required: true
            },
            distributor_distributor_id:{
                required: true
            },
            retailer_geo_level_1_data:{
                required: true
            },
            retailer_geo_level_2_data:{
                required: true
            },
            retailer_id:{
                required: true
            },
            prod_sku:{
                required: true
            },
            quantity:{
                required: true
            }
        }
    });

    $("#budget").on("submit",function(){

        var param = $("#budget").serializeArray();

        var $valid = $("#budget").valid();
        if(!$valid) {

            target_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/add_budget_data",
                data: param,
                //dataType : 'json',
                success: function(resp){
                    var message = "";
                    if(resp == 1){

                        message += 'Data Inserted successfully.';
                    }
                    else{

                        message += 'Data not Inserted.';
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
        }
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
                if(checked_type == "retailer"){

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

$(document).on('click', '.edit_i', function () {
    var id = $(this).attr('prdid');

    //QTY

    var qty = $(" div.quantity_"+id+" span.quantity").text();
    $("div.quantity_"+id).empty();
    $("div.quantity_"+id).append('<input type="hidden" name="budget_id[]" value="'+id+'" /><input id="quantity_'+id+'" type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="'+qty+'"/>');

    $(this).prop("disabled",true);
    return false;
});

$(document).on('click', 'div.budget_container .edit_i', function () {
    $("div.check_save_btn").css("display","block");
});

$(document).on('click', 'div.check_save_btn #check_save', function () {
    var budget_data = $("#update_budget").serializeArray();
    // console.log(target_data);return false;
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/update_budget_details',
        data: budget_data,
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

$(document).on('click', 'div.budget_container .delete_i', function () {
    if (confirm("Are you sure?")) {
        var id = $(this).attr('prdid');
        $.ajax({
            type: 'POST',
            url: site_url+'ishop/delete_budget_details',
            data: {budget_id:id},
            success: function(resp){
                location.reload();
            }
        });
        //return false;
    }
    else{
        return false;
    }

});

function get_copy_popup_geo_data(customer_type_selected){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_type" ).val();

    var url_seg = $("input.page_function" ).val();
    var checked_type = $('input[name=radio1]:checked').val();
    //alert(customer_selected+"==="+login_user_countryid+"==="+login_customer_type+"==="+customer_type_selected);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_copy_popup_geo_data",
        data: {user_country : login_user_countryid,login_customer_type :login_customer_type,customer_type_selected:customer_type_selected,urlsegment:url_seg,checkedtype:checked_type },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            $("select#from_popup_geo_data").empty();
            $("select#from_popup_geo_data").selectpicker('refresh');


            if(resp.length > 0){

                $("select#from_popup_geo_data").append('<option value="0">Select Geo Location</option>');

                $.each(resp, function(key, value) {
                    $('select#from_popup_geo_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                });

                $("select#from_popup_geo_data").selectpicker('refresh');

            }


            $("select#to_popup_geo_data").empty();
            $("select#to_popup_geo_data").selectpicker('refresh');


            if(resp.length > 0){

                $("select#to_popup_geo_data").append('<option value="0">Select Geo Location</option>');

                $.each(resp, function(key, value) {
                    $('select#to_popup_geo_data').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                });

                $("select#to_popup_geo_data").selectpicker('refresh');
            }
        }
    });
}

function get_user_by_geo_data(selected_geo_data,copy_check_param){

    $("select#retailer_data").empty();
    $("select#retailer_data").selectpicker('refresh');

    if($('input[name=radio1]:checked').length == 0){
        var checked_type = "distributor";
    }
    else{
        var checked_type = $('input[name=radio1]:checked').val();
    }
    var login_customer_type = $("input#login_customer_type" ).val();

    var login_user_countryid = $("input#login_customer_countryid").val();
    //alert(checked_type+"=="+login_user_countryid+"=="+login_customer_type);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){

            if(resp != 0){

                if( login_customer_type == 8 ){

                    $("select#distributor_distributor_id").empty();

                    $("select#distributor_distributor_id").append('<option value="0">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#distributor_distributor_id').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#distributor_distributor_id").selectpicker('refresh');

                }
                else if(checked_type == "distributor" && login_customer_type == 7 ){

                    $("select#distributor_distributor_id").empty();

                    $("select#distributor_distributor_id").append('<option value="0">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#distributor_distributor_id').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });
                    $("select#distributor_distributor_id").selectpicker('refresh');

                    //FOR FROM DISTRIBUTOR IN COPY POPUP

                    if($("div.modal-backdrop").length > 0){

                        if(copy_check_param == "from_data"){
                            $("select#from_customer_data").empty();

                            $("select#from_customer_data").append('<option value="0">Select Distributor Name</option>');

                            $.each(resp, function(key, value) {
                                $('select#from_customer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                            });
                            $("select#from_customer_data").selectpicker('refresh');
                        }
                        if(copy_check_param == "to_data"){
                            $("select#to_customer_data").empty();

                            $("select#to_customer_data").append('<option value="0">Select Distributor Name</option>');

                            $.each(resp, function(key, value) {
                                $('select#to_customer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                            });
                            $("select#to_customer_data").selectpicker('refresh');
                        }
                    }
                }
                if(checked_type == "retailer" && login_customer_type == 7){

                    $("select#retailer_id").empty();

                    $("select#retailer_id").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_id').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                    });

                    $("select#retailer_id").selectpicker('refresh');



                    if($("div.modal-backdrop").length > 0){

                        if(copy_check_param == "from_data"){
                            $("select#from_customer_data").empty();

                            $("select#from_customer_data").append('<option value="0">Select Retailer Name</option>');

                            $.each(resp, function(key, value) {
                                $('select#from_customer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                            });
                            $("select#from_customer_data").selectpicker('refresh');
                        }
                        if(copy_check_param == "to_data"){
                            $("select#to_customer_data").empty();

                            $("select#to_customer_data").append('<option value="0">Select Retailer Name</option>');

                            $.each(resp, function(key, value) {
                                $('select#to_customer_data').append('<option value="' + value.id + '" >' +value.first_name+' '+value.middle_name+' '+value.last_name+ '</option>');
                            });
                            $("select#to_customer_data").selectpicker('refresh');
                        }
                    }



                }

            }

        }
    });

}

$(document).on('submit', '#upload_budget_data', function (e) {
    
    e.preventDefault();
     
     var file_data = new FormData(this);
     var dir_name = "budget";
     
      var month = new Array();
        month[0] = "Jan";
        month[1] = "Feb";
        month[2] = "Mar";
        month[3] = "Apr";
        month[4] = "May";
        month[5] = "Jun";
        month[6] = "Jul";
        month[7] = "Aug";
        month[8] = "Sep";
        month[9] = "Oct";
        month[10] = "Nov";
        month[11] = "Dec";

    var header_array = [];

     $.ajax({
        url: site_url+"ishop/upload_data", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: file_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            
            console.log(data);
             $.each( data, function( key, value ) {

                 if(key == "error"){
                     
                     var value_data = JSON.stringify(value);

                     var error_message = "";
                     
                     var t_data = "<table><thead>";

                      $.each( value, function( key5, des_value5 ) {
                            
                            
                        if(key5 == "header"){

                                t_data += "<tr>";
                                    $.each( des_value5, function( key2, header_desc_value ){
                                        $.each( header_desc_value, function( key6, header_desc_value6 ){
                                            t_data += "<th style='/*border:1px solid;*/text-align:center;'>"+header_desc_value6+"<span class='rts_bordet'></span></th>";
                                            header_array.push(header_desc_value6);
                                        });
                                    });
                                t_data += "<th style='/*border:1px solid;*/text-align:center;'>Error Description</th></tr>";

                            header_array.push('Error Description');

                                t_data += "</thead><tbody>";
                            }
                        });
                     
                     
                        $.each( value, function( key1, des_value ) {
                            
                            if(key1 != "header"){
                                
                                t_data += "<tr>";
                                var des_data = des_value.split("~");
                                
                                $.each( des_data, function( key3, desc_data ){
                                    
                                    if(key3 == 0){
                                        
                                        var year_data = desc_data.split("-");
                                        
                                        var d = new Date(desc_data);
                                        var desc_data = month[d.getMonth()]+"-"+year_data[0];
                                    }
                                    
                                    t_data += "<td style='border:1px solid;text-align:center;' data-title='"+header_array[key3]+"'>"+desc_data+"</td>";
                                });
                                
                                t_data += "</tr>";
                            }
                        });
                        t_data += "</tbody></table>";
                    
                     
                     $('<div id="no-more-tables"></div>').appendTo('body')
                        .html('<div>'+t_data+'</div>')
                        .dialog({
                             appendTo: "#error_file_popup",
                            modal: true,
                            title: 'The following data is incorrect Kindly upload correct data.',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            buttons: {
                                Download: function () {
                                    
                                    if(value != "No data found"){
                                    
                                        var file_name = "";

                                        $.ajax({
                                            url: site_url+"ishop/create_data_xl", // Url to which the request is send
                                            type: "POST",             // Type of request to be send, called as method
                                            data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs
                                            success: function(data)   // A function to be called if request succeeds
                                            {
                                                file_name = data;
                                            },
                                            dataType:'html',
                                            async:false
                                        });

                                        window.open(site_url+"assets/uploads/Uploads/"+dir_name+"/"+file_name,'_blank' );
                                    }
                                   // return false;
                                    //console.log(file_data);
                                    $(this).dialog("close");
                                },
                                Decline: function () {
                                    $(this).dialog("close");
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
                 }
                 else
                 {
                     $('<div></div>').appendTo('body')
                        .html('<div><h4><b>The file is correct. Please click on save button.</b></h4></div>')
                        .dialog({
                             appendTo: "#success_file_popup",
                            modal: true,
                            title: 'Save Data',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            buttons: {
                                Save: function () {
                                    
                                    
                                    $.ajax({
                                        url: site_url+"ishop/add_xl_data", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs 
                                        success: function(data)   // A function to be called if request succeeds
                                        {}
                                    });

                                    $(this).dialog("close");
                                },
                                Decline: function () {
                                    $(this).dialog("close");
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
                 }
              })
        },
        dataType: 'json'
     });
     
  
   return false;
    
});

var budget_pop_up_validators = $("#copy_popup").validate({
    rules: {
        from_popup_geo_data: {
            required: true
        },
        from_customer_data :{
            required: true
        },
        from_year_data:{
            required: true
        },
        radio_from_popup_month_data:{
            required: true
        },
        to_popup_geo_data:{
            required: true
        },
        to_customer_data:{
            required: true
        },
        to_year_data:{
            required: true
        },
        'checkbox_popup_month_data[]':{
            required: true
        }
    }
});

$(document).on("submit","#copy_popup",function(){
    
    var popup_data = $("form#copy_popup").serializeArray()

    var $valid = $("#copy_popup").valid();
    if(!$valid) {

        budget_pop_up_validators.focusInvalid();
        return false;
    }
    else {

        $.ajax({
            url: site_url + "ishop/copy_data", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: popup_data, // Data sent to server, a set of key/value pairs 
            success: function (data)   // A function to be called if request succeeds
            {
                if (data != 0) {
                    $("div.modal-body").append("<div class='success_message'><span style='color:green;font-size:12px;text-align:center;'>Data Copied Successfully.</span></div>");

                    setTimeout(function () {
                        $("div.success_message").remove();
                    }, 1500);

                } else {
                    $("div.modal-body").append("<div class='error_message'><span style='color:red;font-size:12px;text-align:center;'>No data found for selected Criteria.</span></div>");

                    setTimeout(function () {
                        $("div.error_message").remove();
                    }, 1500);
                }

                setTimeout(function () {
                    $(".modal-header .close").trigger("click");
                }, 2500);
            }
        });
        return false;
    }
    //console.log(popup_data);
    
});