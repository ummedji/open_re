/**
 * Created by webclues on 6/2/2016.
 */

$(function () {
    $('#year').datepicker({
        format: "yyyy"
    });
});

$("select#geo_level_scheme").on("change",function(){
    var selected_geo_id = $(this).val();
    get_lower_geo_by_parent_geo_scheme(selected_geo_id);
});

function get_lower_geo_by_parent_geo_scheme(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = 10;
    var customer_selected = $("input#login_customer_id").val();
    /* var url_seg = $("input.page_function" ).val();
     var checked_type = 'retailer';*/

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lower_business_geo_data",
        data: {user_id:customer_selected,country_id : login_user_countryid,role :login_customer_type,parent_geo_id:selected_geo_id },
        dataType : 'json',
        success: function(resp){
            console.log(resp);
            //   return false;

            $("select#geo_level_1").empty();
            $("select#geo_level_1").selectpicker('refresh');

            if (resp.length > 0) {

                $("select#geo_level_1").append('<option value="0">Select Geo Location</option>');

                $.each(resp, function (key, value) {

                    $('select#geo_level_1').append('<option value="' + value.business_geo_id + '" >' + value.business_georaphy_name + '</option>');
                });

                $("select#geo_level_1").selectpicker('refresh');
            }
        }
    });
}


$("#view_schemes").on("submit",function(){
    //alert('in');
    var param = $("#view_schemes").serializeArray();
    console.log(param);
    //return false;
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/view_schemes_details",
        data: param,
        dataType : 'html',
        success: function(resp){
            $("#scheme_view_middle_container").html(resp);
        }
    });
    return false;
});


$(document).on("click","#scheme_check",function() {

    if($(this).is(':checked')){
        $('.check_checked').prop('checked', true);
    }
    else
    {
        $('.check_checked').prop('checked', false);
    }

});


$(document).on('click','#delete_schemes',function(e){
    e.preventDefault();
    var checked_schemes = [];
    var param = $("#view_schemes").serializeArray();

    if (confirm("Are you sure?")) {
        $. each($("input[name='del_scheme']:checked"), function(){
            checked_schemes. push($(this).attr('attr-check'));
        });
            console.log(checked_schemes);
            console.log(param);
           // return false;
            $.ajax({
                type: 'POST',
                url: site_url+"ishop/delete_schemes",
                data: {checked_schemes:checked_schemes,param:param},
                dataType : 'html',
                success: function(resp){
                    $("#scheme_view_middle_container").html(resp);
                }
            });
    }
    return false;

});

$("#year").on("change",function(){

    var selected_cur_year = $(this).val();
    get_region_by_selected_cur_year(selected_cur_year);
});

function get_region_by_selected_cur_year(selected_cur_year){

    // var login_user_countryid = $("input#login_customer_countryid").val();
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_region_by_selected_cur_year",
        data: {selected_cur_year:selected_cur_year},
        dataType : 'json',
        success: function(resp){

            if(resp != 0){

                $("select#geo_level_scheme").empty();

                $("select#geo_level_scheme").append('<option value="0">Select Geo Location </option>');

                $.each(resp, function (key, value) {
                    $('select#geo_level_scheme').append('<option value="' + value.business_geo_id + '" >' + value.business_georaphy_name + '</option>');
                });

                $("select#geo_level_scheme").selectpicker('refresh');
            }
            else{
                $("select#geo_level_scheme").empty();
                $("select#geo_level_scheme").append('<option value="0">Select Geo Location </option>');
                $("select#geo_level_scheme").selectpicker('refresh');
            }
        }
    });
}

$("select#geo_level_1").on("change",function(){

    var selected_geo_data = $(this).val();
    get_retailer_by_geo_data(selected_geo_data);

});

function get_retailer_by_geo_data(selected_geo_data){


    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_business_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid},
        dataType : 'json',
        success: function(resp){

            if(resp != 0){

                $("select#retailer_scheme").empty();

                $("select#retailer_scheme").append('<option value="0">Select Retailer Name</option>');

                $.each(resp, function (key, value) {
                    $('select#retailer_scheme').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                });

                $("select#retailer_scheme").selectpicker('refresh');
            }
        }
    });

}



