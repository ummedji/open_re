$(function () {
    $('#form_month').datepicker({
        format: "yyyy-mm"
    });

});

$(function () {
    $('#to_month').datepicker({
        format: "yyyy-mm"
    });
});

$(function () {
    $('#from_month_dist').datepicker({
        format: "yyyy-mm"
    });

});

$(function () {
    $('#to_month_dist').datepicker({
        format: "yyyy-mm"
    });
});



var login_customer_type = $("input#login_customer_role").val();

if(login_customer_type == 8){
    var customer_selected = $("input#login_customer_id").val();
}


$("input.select_customer_type").on("click",function(){

    var customer_type_selected = $(this).val();
    // alert(customer_type_selected);
    if(customer_type_selected == "retailer"){
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");

        $("div.distributor_checked_sales").css("display","none");
        $("div.retailer_checked_sales").css("display","block");

        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }

    }
    else if(customer_type_selected == "distributor"){
        $("div.retailer_data").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_checked_sales").css("display","block");
        $("div.retailer_checked_sales").css("display","none");


        if(login_customer_type == 8){

            var customer_selected = $("input#login_customer_id").val();
            get_geo_fo_userdata(customer_selected,customer_type_selected);

        }
    }
});

$("select#distributor_geo_level").on("change",function(){

    var selected_geo_data = $(this).val();

    get_user_by_geo_data(selected_geo_data);

});



function get_user_by_geo_data(selected_geo_data){

    var checked_type = $('input[name=radio1]:checked').val();

    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(resp != 0){

                if(checked_type == "distributor"){
                    $("select#distributor_sales").empty();
                    $("select#distributor_sales").append('<option value="0">Select Distributor Name</option>');
                    $.each(resp, function (key, value) {
                        $('select#distributor_sales').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });
                    $("select#distributor_sales").selectpicker('refresh');
                }
                else {

                    $("select#retailer_sales").empty();

                    $("select#retailer_sales").append('<option value="0">Select Retailer Name</option>');

                    $.each(resp, function (key, value) {

                        $('select#retailer_sales').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#retailer_sales").selectpicker('refresh');

                }
            }

        }
    });

}



function get_geo_fo_userdata(customer_selected,customer_type_selected){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_role" ).val();

    var url_seg = $("input.page_function" ).val();

    // alert(customer_selected+"==="+login_user_countryid+"==="+login_customer_type+"==="+customer_type_selected);

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_geo_fo_userdata",
        data: {user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,customer_type_selected:customer_type_selected,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(customer_type_selected == "distributor"){

                $("div#distributor_checked_sales select.distributor_geo_level").empty();
                $("div#distributor_checked_sales select.distributor_geo_level").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#distributor_checked_sales select.distributor_geo_level").append('<option value="0">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#distributor_checked_sales select.distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#distributor_checked_sales select.distributor_geo_level").selectpicker('refresh');

                }

            }

            if(customer_type_selected == "retailer"){

                $("div#retailer_checked_sales select.geo_level_0").empty();
                $("div#retailer_checked_sales select.geo_level_0").selectpicker('refresh');


                if(resp.length > 0){

                    $("div#retailer_checked_sales select.geo_level_0").append('<option value="0">Select Geo Location</option>');

                    $.each(resp, function(key, value) {
                        $('div#retailer_checked_sales select.geo_level_0').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("div#retailer_checked_sales select.geo_level_0").selectpicker('refresh');
                }
            }
        }
    });
}


$("select#geo_level_0").on("change",function(){

    var selected_geo_id = $(this).val();
    get_lower_geo_by_parent_geo_physical_stock(selected_geo_id);
});

function get_lower_geo_by_parent_geo_physical_stock(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_role" ).val();
    var customer_selected = $("input#login_customer_id").val();
    var url_seg = $("input.page_function" ).val();
    var checked_type = $('input[name=radio1]:checked').val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lowergeo_from_uppergeo_data",
        data: {checkedtype:checked_type, user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,parent_geo_id:selected_geo_id,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

            if(login_customer_type == 8) {

                if (checked_type == "retailer") {

                    $("div#retailer_checked_sales select#geo_level_1").empty();
                    $("div#retailer_checked_sales select#geo_level_1").selectpicker('refresh');

                    if (resp.length > 0) {

                        $("div#retailer_checked_sales select#geo_level_1").append('<option value="0">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#retailer_checked_sales select#geo_level_1').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#retailer_checked_sales select#geo_level_1").selectpicker('refresh');

                    }

                }
                else if (checked_type == "distributor") {

                    $("div#distributor_checked_sales select#distributor_geo_level").empty();
                    $("div#distributor_checked_sales select#distributor_geo_level").selectpicker('refresh');


                    if (resp.length > 0) {

                        $("div#distributor_checked_sales select#distributor_geo_level").append('<option value="0">Select Geo Location</option>');

                        $.each(resp, function (key, value) {

                            $('div#distributor_checked_sales select#distributor_geo_level').append('<option value="' + value.political_geo_id + '" >' + value.political_geography_name + '</option>');
                        });

                        $("div#distributor_checked_sales select#distributor_geo_level").selectpicker('refresh');

                    }

                }

            }
        }
    });

}

$("select#geo_level_1").on("change",function(){

    var selected_geo_data = $(this).val();
    get_user_by_geo_data(selected_geo_data);

});
$("select#distributor_sales").on("change",function(){

    var selected_id = $(this).val();
    get_retailer_by_distributor(selected_id);

});

function get_retailer_by_distributor(selected_id)
{
    var login_customer_type = $("input#login_customer_type" ).val();
    var login_user_countryid = $("input#login_customer_countryid").val();
    if(login_customer_type == 8){
        var distributor_id = selected_id;
    }
    else{
        var distributor_id = $("select#distributor_sales option:selected" ).val();
    }
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_retailers_by_distributor",
        data: {distributor_id:distributor_id, country:login_user_countryid},
        //dataType : 'json',
        success: function(resp){
            //console.log(resp);
            if(resp != 0){

                $("select#retailer_id").empty();

                $("select#retailer_id").append('<option value="0">Select Distributor Name</option>');

                $.each(JSON.parse(resp), function(key, value) {
                    $('select#retailer_id').append('<option value="' + value.id + '">' + value.display_name + '</option>');
                });

                $("select#retailer_id").selectpicker('refresh');

            }
            else{
                $("select#retailer_id").empty();
                $("select#retailer_id").selectpicker('refresh');
            }
        }
    });
}


$("#view_ishop_sales").on("submit",function(){

    var param = $("#view_ishop_sales").serializeArray();
   // console.log(param);
   // return false;
    $.ajax({
        type: 'POST',
            url: site_url+"ishop/view_ishop_sales_details",
        data: param,
        dataType : 'html',
        success: function(resp){
            $("#middle_container_sales").html(resp);
        }
    });
     return false;
});

/*Get Sales Product Data*/
$(document).on('click', 'div.sales_cont .eye_i', function () {
    var id = $(this).attr('prdid');
    var checked_type = $('input[name=radio1]:checked').val();
    $.ajax({
        type: 'POST',
        url: site_url+'ishop/sales_product_details_view',
        data: {id: id,checkedtype:checked_type},
        success: function(resp){
            $("#product_table_container_sales").html(resp);
        }
    });
    return false;
});
/*Get Sales Data*/




