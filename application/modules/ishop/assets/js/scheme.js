/**
 * Created by webclues on 6/1/2016.
 */

$(function () {
    $('#cur_year').datepicker({
        format: "yyyy", // Notice the Extra space at the beginning
        autoclose: true,

        viewMode: "years",
        minViewMode: "years"
    });
});

$("select#geo_level_rol").on("change",function(){
    var selected_geo_id = $(this).val();
    get_lower_geo_by_parent_geo_scheme(selected_geo_id);
});

function get_lower_geo_by_parent_geo_scheme(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_user_type = $("input#login_customer_role").val();
    var default_customer_type = 10;
    var customer_selected = $("input#login_customer_id").val();
   /* var url_seg = $("input.page_function" ).val();
    var checked_type = 'retailer';*/

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_lower_business_geo_data",
        data: {user_id:customer_selected,country_id : login_user_countryid,role :default_customer_type,parent_geo_id:selected_geo_id },
        dataType : 'json',
        success: function(resp){
            console.log(resp);
         //   return false;

                $("select#geo_level_1").empty();
                $("select#geo_level_1").selectpicker('refresh');

                if (resp.length > 0) {

                    $("select#geo_level_1").append('<option value="">Select Geo Location</option>');

                    $.each(resp, function (key, value) {

                        $('select#geo_level_1').append('<option value="' + value.business_geo_id + '" >' + value.business_georaphy_name + '</option>');
                    });

                    $("select#geo_level_1").selectpicker('refresh');

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

                    $("select#retailer_scheme").append('<option value="">Select Retailer Name</option>');

                    $.each(resp, function (key, value) {
                        $('select#retailer_scheme').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#retailer_scheme").selectpicker('refresh');
            }
        }
    });

}

$("select#schemes").on("change",function(){

    var selected_schemes = $(this).val();
    var selected_retailer = $("select#retailer_scheme").val();
    var selected_year = $("#cur_year").val();
    get_slab_by_selected_schemes(selected_schemes,selected_retailer,selected_year);

});

function get_slab_by_selected_schemes(selected_schemes,selected_retailer,selected_year)
{

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_slab_by_selected_schemes",
        data: {selected_schemes:selected_schemes,selected_retailer:selected_retailer,selected_year:selected_year},
        dataType : 'html',
        success: function(resp){
            $("#scheme_middle_container").html(resp);
        }
    });
}

$(document).ready(function(){

    var schemes_validators = $("#add_schemes").validate({
        rules: {
            cur_year:{
                required: true
            },
            region:{
                required: true
            },
            territory:{
                required: true
            },
            fo_retailer_id:{
                required: true
            },
            schemes:{
                required: true
            },
            radio_scheme_slab:{
                required: true
            }
        }
    });




    $("#add_schemes").on("submit",function(){

        //alert('in');
        $('.save_btn button').attr('disabled','disabled');
        var param = $("#add_schemes").serializeArray();

        var $valid = $("#add_schemes").valid();
        if(!$valid) {
           // alert('out');
            schemes_validators.focusInvalid();
            return false;
        }
        else
        {
          //  alert('in');
            $.ajax({
                type: 'POST',
                url: site_url + "ishop/check_schemes_details",
                data: param,
                success: function (resp) {
                    var message = "";
                    if (resp == 1) {
                      //  alert('in1');
                        $.ajax({
                            type: 'POST',
                            url: site_url + "ishop/add_schemes_details",
                            data: param,
                            success: function (resp) {

                                var message = "";
                                if (resp == 1) {

                                    message += 'Data Inserted successfully.';
                                }
                                else {

                                    message += 'Data not Inserted.';
                                }
                                $('<div></div>').appendTo('body')
                                    .html('<div><b>' + message + '</b></div>')
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
                    else {
                     //   alert('in3');
                        var obj = jQuery.parseJSON(resp);
                        var allocation_id = (obj.allocation_id);
                        param.push({name: "allocation_id", value:allocation_id});

                        $.ajax({
                            type: 'POST',
                            url: site_url + "ishop/update_schemes_details",
                            data: param,
                            success: function (resp) {
                                var message = "";
                                if (resp == 1) {
                                    message += 'Data Updated successfully.';
                                }
                                else {
                                    message += 'Data not Updated.';
                                }
                                $('<div></div>').appendTo('body')
                                    .html('<div><b>' + message + '</b></div>')
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
                }
            });
            return false;
        }
    });
});

$(document).on(":input",'change',function() {
    $(this).valid();
});

$("#cur_year").on("change",function(){

    var selected_cur_year = $(this).val();
    get_region_by_selected_cur_year(selected_cur_year);
    get_schemes_by_selected_cur_year(selected_cur_year);

});

function get_schemes_by_selected_cur_year(selected_cur_year){

    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_schemes_by_selected_cur_year",
        data: {selected_cur_year:selected_cur_year, country_id : login_user_countryid},
        dataType : 'json',
        success: function(resp){

            if(resp != 0){

                $("select#schemes").empty();

                $("select#schemes").append('<option value="">Select Schemes </option>');

                $.each(resp, function (key, value) {
                    $('select#schemes').append('<option value="' + value.scheme_id + '" >' + value.scheme_name + '</option>');
                });

                $("select#schemes").selectpicker('refresh');
            }
            else{
                $("select#schemes").empty();
                $("select#schemes").append('<option value="">Select Schemes </option>');
                $("select#schemes").selectpicker('refresh');
            }
        }
    });
}

function get_region_by_selected_cur_year(selected_cur_year){

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_region_by_selected_cur_year",
        data: {selected_cur_year:selected_cur_year},
        dataType : 'json',
        success: function(resp){

            if(resp != 0){

                $("select#geo_level_rol").empty();

                $("select#geo_level_rol").append('<option value="">Select Geo Location </option>');

                $.each(resp, function (key, value) {
                    $('select#geo_level_rol').append('<option value="' + value.business_geo_id + '" >' + value.business_georaphy_name + '</option>');
                });

                $("select#geo_level_rol").selectpicker('refresh');
            }
            else{
                $("select#geo_level_rol").empty();
                $("select#geo_level_rol").append('<option value="">Select Geo Location </option>');
                $("select#geo_level_rol").selectpicker('refresh');
            }
        }
    });
}

