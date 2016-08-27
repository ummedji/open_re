$(document).ready(function(){

    $("select#Campaign").on("change",function(){

        var campagain_id = $(this).val();

        if($("input#selected_action").val() == "farmer_dialpad")
        {
           var selected_partner = "farmer";
        }
        else if($("input#selected_action").val() == "channel_partner_dialpad")
        {
            var selected_partner = $("select#channel_partner").val();
            if(selected_partner == 10)
            {
                selected_partner = "retailer";
            }
            else if(selected_partner == 9)
            {
                selected_partner = "distributor";
            }
        }
        else if($("input#selected_action").val() == "employee_dialpad")
        {
            var selected_partner = "employee";
        }

        $.ajax({
            type: 'POST',
            url: site_url + "cco/get_campagain_allocated_data",
            data: {campagainid: campagain_id,selectedpartner:selected_partner},
            success: function (resp) {
                $("div#customer_data").html(resp);
            }
        });

    });

    $("select#activity_type").on("change",function(){

        var activity_type = $(this).val();

        $.ajax({
            type: 'POST',
            url: site_url + "cco/get_activity_type_allocated_data",
            data: {activity_type : activity_type},
            success: function (resp) {
               $("div#customer_data").html(resp);
            }
        });

    });
});


$('body').on('focus',".dob", function(){
    $(this).datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
});
$('body').on('focus',".due_date", function(){
    $(this).datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
});
$('body').on('focus',".year_data", function(){
    $(this).datepicker({
        format: "yyyy",
        autoclose: true,
        viewMode: "years",
        minViewMode: "years"
    });
});

$(document).on('click','.btn_call',function(){
    $(".cco-popup").css("display","block");
});

$(document).on('click',".btn-cco",function(){
    $(".cco-popup").css("display","none");
});

$(document).on('click',"#allow_call",function(){

    var phone_no = $("input#input_call").val();
    var action_data = $("input#selected_action").val();

    dialpad(phone_no,null,null,null);

    $(".cco-popup").css("display","none");
});

$('body').on('focus',"#form_date", function(){

    $(this).datepicker({
        format: date_format,
        autoclose: true
    }).on('changeDate', function(selected){
        $('#to_date').val('');
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#to_date').datepicker({format:date_format,startDate:startDate});
    });

});

$('body').on('focus',"#to_date", function(){
    $(this).datepicker({
        format: date_format,
        autoclose: true
    });
});

$(document).on("click","a.primary_no",function(){
    var phone_no = $(this).attr("rel");
    var activity_id = $(this).attr("rel-activity_id");
    var activity_type = $(this).attr("rel-activity_type");
    var campagain_id = $("select#Campaign").val();

    var action_data = $("input#selected_action").val();

    if(action_data == 'activity_dialpad'){
        campagain_id = activity_id;
        dialpad(phone_no,campagain_id,activity_type,action_data);
    }
    else if(action_data == 'farmer_dialpad')
    {
        dialpad(phone_no,campagain_id,null,action_data);
    }
    else if(action_data == 'channel_partner_dialpad')
    {
        var channel_partner_data = $("select#channel_partner").val();
        dialpad(phone_no,campagain_id,channel_partner_data,action_data);
    }
    else if(action_data == 'employee_dialpad')
    {
        dialpad(phone_no,null,null,action_data);
    }

});

$(document).on('change','#campaign_data',function(){

    var campaign_id = $(this).val();
    getAllPhaseDetails(campaign_id);
});

function getAllPhaseDetails(campaign_id)
{
    $(".campaign_box").parent().parent().addClass("grey-colour");
    var id = 'campaign_'+campaign_id;
    $.ajax({
        type: 'POST',
        url: site_url + "cco/getAllPhaseDetailsByCampaignId",
        data: {campaign_id:campaign_id},
        success: function (resp) {
            $('.phase_details').html(resp);

            $('div#'+id).removeClass("grey-colour");
        }
    });
}
$(document).on('click','.close',function(){
        $(".campaign_box").parent().parent().addClass("grey-colour");
    $('.phase_details').html('');
});

function dialpad(phone_no,data_id,data_type,action_data)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/set_customer_data",
        data: {phoneno: phone_no,campagainid:data_id,activity_type:data_type,action_data:action_data},
        success: function (resp) {

        }
    });

    var url = site_url + "cco/dialpad";

    setTimeout(function(){
        window.open(url, "popupWindow", "width=1200,height=1000,scrollbars=yes");
    }, 300);

}

function get_general_detail_data(customer_id)
{
    //var customer_id = 4;
    var campagain_id = $("input#camagain_id").val();
   // alert(campagain_id);
    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_general_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_family_detail_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_family_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_education_detail_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_education_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_social_detail_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_social_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_financial_detail_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_financial_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}


function get_complaint_detail_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_complaint_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_complaint_view_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_complaint_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}
function get_customer_business_view_data(customer_id)
{

    var campagain_id = $("input#camagain_id").val();
    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_business_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            get_geo_data(campagain_id,3,num_count);
        }
    });
}


function get_retailer_view_data(customer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_retailer_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_farming_view_data(customer_id)
{

    var campagain_id = $("input#camagain_id").val();
    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_farming_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            get_geo_data(campagain_id,3,num_count);
        }
    });
}

function get_activity_detail_data(customer_id)
{
   // var campagain_id = $("input#camagain_id").val();
  //  var num_count = 1;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_activity_detail_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
            $('.selectpicker').select('refresh');
        }
    });

}

function get_planned_activity_detail_data(customer_id,activity_id)
{
    // var campagain_id = $("input#camagain_id").val();
    //  var num_count = 1;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_planned_activity_detail_data",
        data: {customerid: customer_id,activity_id:activity_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
            $('.selectpicker').select('refresh');
        }
    });

}

function get_call_history_detail_data(customer_id,phone_no)
{
    alert('in');
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_call_history_detail_data",
        data: {customerid: customer_id,phone_no:phone_no},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
            $('.selectpicker').select('refresh');
        }
    });
}


function get_executed_activity_detail_data(customer_id,activity_id)
{
    // var campagain_id = $("input#camagain_id").val();
    //  var num_count = 1;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_executed_activity_detail_data",
        data: {customerid: customer_id,activity_id:activity_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
            $('.selectpicker').select('refresh');
        }
    });

}

function get_diseases_detail_data(customer_id)
{
    var campagain_id = $("input#camagain_id").val();
    var num_count = 1;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_diseases_detail_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
          //  get_geo_data(campagain_id,1,num_count);
        }
    });

}

function get_questions_detail_data(customer_id)
{
    var campagain_id = $("select#campaign_id").val();
    var num_count = 1;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_questions_detail_view_data",
        data: {customerid: customer_id,campagain_id:campagain_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);

            setTimeout(function(){

            $.ajax({
                type: 'POST',
                url: site_url + "cco/get_active_phase_data",
                data: {campagain_id: campagain_id},
                dataType:'json',
                success: function (resp) {

                  //  $("div.tab-pane").removeClass("active");
                    $("ul.phase-list li").removeClass("active");
                   // $("div#phase-"+resp.phase_id).addClass("active");

                    $("ul.phase-list li a#phase_data_"+resp.phase_id).trigger("click");
                }
            });

            }, 1000);
            //  get_geo_data(campagain_id,1,num_count);
        }
    });

}

$(document).on("click",".phase_question_data",function(){

    var phase_id = $(this).attr("rel");

    var campagain_id = $("select#campaign_id").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_phase_script_data",
        dataType:'json',
        data: {phaseid: phase_id,campagain_id:campagain_id},
        success: function (resp) {

            $("div.script-cont").empty();
            $("div.script-cont").html(resp.script_data);
            //  get_geo_data(campagain_id,1,num_count);
        }
    });

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_phase_question_data",
        data: {phaseid: phase_id,campagain_id:campagain_id},
        dataType:'html',
        success: function (resp) {
            $("div.tab-pane").removeClass("active");

            $("ul#ul-phase-"+phase_id).empty();
            $("ul#ul-phase-"+phase_id).html(resp);

            $("div#phase-"+phase_id).addClass("active");
        }
    });



});


function get_geo_data(campagain_id,level_data,num_count)
{
    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_level_data",
        data: {campagainid:campagain_id,leveldata:level_data},
        success: function(resp){
            var obj = $.parseJSON(resp);
            var html = "<option value=''>Select Location</option>";
            $.each( obj, function( key, value ) {
                $.each( value, function( key1, value1 )
                {
                    html += "<option value='"+value1.political_geo_id+"'>"+value1.political_geography_name+"</option>";
                });
            });
            $("div#dialpad_middle_contailner select#geo_level_3").html(html);
          //  $("div#dialpad_middle_contailner select#geo_level_3").selectpicker('refresh');
        }
    });
}

function get_product_detail_data(customer_id)
{
    var campagain_id = $("input#camagain_id").val();
    var num_count = 1;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_product_detail_view_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
        }
    });

}

function get_order_status_data(customer_id,search_data)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_order_status_data",
        data: {customerid: customer_id,searchdata:search_data,mode:'list_data'},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
        }
    });
}

function get_employee_order_status_data(customer_id,role_id)
{

    get_employee_filter_data(customer_id,role_id);

    var login_customer_type = role_id;

    if(login_customer_type == 8){

        var customer_selected = customer_id;

        get_geo_fo_userdata(customer_selected,'farmer');

    }
}

$(document).on("change","input.select_customer_type",function(){

    //alert('in');
    var validator = $("#emp_order_status").validate();

   // validator.resetForm();

    var customer_type_selected = $(this).val();

     //alert(customer_type_selected);

    if(customer_type_selected == "retailer"){
        $("div.distributor_data").css("display","none");
        $("div.retailer_data").css("display","block");
        // $("div.retailer_data_checked").css("display","block");

        $("div.distributor_checked").css("display","none");
        $("div.farmer_checked").css("display","none");
        $("div.retailer_checked").css("display","block");


        var customer_selected = $("input#login_customer_id").val();
        get_geo_fo_userdata(customer_selected,customer_type_selected);
        $("select").selectpicker('refresh');

      //  $("#order_place_data").empty();
        $("select#geo_level_1_data").val('');
        $("select#geo_level_2_data").val('');
        $("select#farmer_data").val('');

        $("select#distributor_geo_level_1_data").val('');
        $("select#distributor_geo_level_2_data").val('');
        $("select#fo_distributor_data").val('');



        $("#form_date").val('');
        $("#to_date").val('');



        $("#middle_container").empty();
        $("#middle_container_product").empty();

    }
    else if(customer_type_selected == "distributor"){

        $("div.retailer_data").css("display","none");
        //$("div.retailer_data_checked").css("display","none");
        $("div.distributor_data").css("display","block");

        $("div.distributor_checked").css("display","block");
        $("div.farmer_checked").css("display","none");
        $("div.retailer_checked").css("display","none");



        var customer_selected = $("input#login_customer_id").val();
        get_geo_fo_userdata(customer_selected,customer_type_selected);
        $("select").selectpicker('refresh');


        $("select#retailer_geo_level_1_data").val('');
        $("select#retailer_geo_level_2_data").val('');
        $("select#retailer_data").val('');

        ("select#geo_level_1_data").val('');
        $("select#geo_level_2_data").val('');
        $("select#farmer_data").val('');

        $("#form_date").val('');
        $("#to_date").val('');


        $("#middle_container").empty();
        $("#middle_container_product").empty();
       // $("#order_place_data").empty();


    }

    else if(customer_type_selected == "farmer"){
        $("div.retailer_data").css("display","none");
        // $("div.retailer_data_checked").css("display","none");
        $("div.distributor_data").css("display","none");

        $("div.distributor_checked").css("display","none");
        $("div.farmer_checked").css("display","block");
        $("div.retailer_checked").css("display","none");

        var customer_selected = $("input#login_customer_id").val();
        get_geo_fo_userdata(customer_selected,customer_type_selected);


        $("select#retailer_geo_level_1_data").val('');
        $("select#retailer_geo_level_2_data").val('');
        $("select#retailer_data").val('');

        $("select#distributor_geo_level_1_data").val('');
        $("select#distributor_geo_level_2_data").val('');
        $("select#fo_distributor_data").val('');


        $("#form_date").val('');
        $("#to_date").val('');

        $("#middle_container").empty();
        $("#middle_container_product").empty();

       // $("#order_place_data").empty();
        $("select").selectpicker('refresh');
    }

});

function get_employee_filter_data(customer_id,role_id){
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_employee_order_status_data",
        data: {customerid: customer_id,role_id:role_id,mode:'list_data'},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
        }
    });
    //$("select.selectpicker").selectpicker('refresh');
}

$(document).on("change","select#retailer_geo_level_1_data",function(){

    var selected_geo_id = $(this).val();

    get_lower_geo_by_parent_geo(selected_geo_id);

    // console.log(selected_user_id +"===="+selected_user_geo_location);

});

$(document).on("change","select#retailer_geo_level_2_data",function(){

    var selected_geo_id = $(this).val();

    get_user_by_geo_data(selected_geo_id);

    // console.log(selected_user_id +"===="+selected_user_geo_location);

});

$(document).on("change","select#distributor_geo_level_1_data",function(){

    var selected_geo_data = $(this).val();

    get_lower_geo_by_parent_geo(selected_geo_data);

});

$(document).on("change","select#distributor_geo_level_2_data",function(){

    var selected_geo_data = $(this).val();
    get_user_by_geo_data(selected_geo_data);

});

$(document).on("change","select.geo_level_1_data",function(){

    var selected_geo_id = $(this).val();
    // alert(selected_geo_id);
    get_lower_geo_by_parent_geo(selected_geo_id);

    // console.log(selected_user_id +"===="+selected_user_geo_location);

});

$(document).on("change","select.geo_level_2_data",function(){

    var selected_geo_id = $(this).val();

    get_user_by_geo_data(selected_geo_id);

    // console.log(selected_user_id +"===="+selected_user_geo_location);

});




//$('body').on('focus',"#emp_order_status", function(){

//});




function get_user_by_geo_data(selected_geo_data){

    $("select#retailer_data").empty();
    $("select#retailer_data").selectpicker('refresh');

    var checked_type = $('input[name=radio1]:checked').val();
    var login_customer_type = $("input#login_customer_type" ).val();

    //alert(checked_type);

    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){

            if(resp != 0){

                if(checked_type == "retailer"){

                    $("select#retailer_data").empty();

                    $("select#retailer_data").append('<option value="">Select Retailer Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#retailer_data').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                    });

                    $("select#retailer_data").selectpicker('refresh');

                }
                else if(checked_type == "distributor"){

                    $("select#fo_distributor_data").empty();

                    $("select#fo_distributor_data").append('<option value="">Select Distributor Name</option>');

                    $.each(resp, function(key, value) {
                        $('select#fo_distributor_data').append('<option value="' + value.id + '" >' + value.display_name + '</option>');
                    });

                    $("select#fo_distributor_data").selectpicker('refresh');

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


function get_lower_geo_by_parent_geo(selected_geo_id){

    var login_user_countryid = $("input#login_customer_countryid").val();
    var login_customer_type = $("input#login_customer_type" ).val();
    var customer_selected = $("input#login_customer_id").val();

    var checked_type = $('input[name=radio1]:checked').val();
    var url_seg = 'order_status';


    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_lowergeo_from_uppergeo_data",
        data: {checkedtype:checked_type, user_id:customer_selected,user_country : login_user_countryid,login_customer_type :login_customer_type,parent_geo_id:selected_geo_id,urlsegment:url_seg },
        dataType : 'json',
        success: function(resp){
            console.log(resp);

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
    });

}

function get_geo_fo_userdata(customer_selected,customer_type_selected){


    var login_customer_type = 8;

    var url_seg = 'order_status';
    alert(url_seg);
    var checked_type = $('input[name=radio1]:checked').val();
   alert
    //alert(customer_selected+"==="+login_user_countryid+"==="+login_customer_type+"==="+customer_type_selected);

    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_geo_fo_userdata",
        data: {user_id:customer_selected,login_customer_type :login_customer_type,customer_type_selected:customer_type_selected,urlsegment:url_seg,checkedtype:checked_type },
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


function get_order_place_data(customer_id)
{

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_order_place_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
        }
    });
}


$(document).on("submit","form#dialpad_update_order_status",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_update_order_status").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/update_order_status_detail_data",
        data:param,
        success: function (resp) {
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
                        get_order_status_data(customer_id,null)
                        //location.reload()
                    }
                });

        }
    });
    return false;
});


$(document).on('click', 'div#searched_data .eye_i', function (e) {

    e.preventDefault();
    //alert("INNN");

    var customer_id = $("input#customer_id").val();
    var id = $(this).attr('prdid');

    $('div#searched_data').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

    //var radio_checked = $('input[name=radio1]:checked').val();
    // var login_customer_type = $("input#login_customer_type" ).val();
    // currentpage = $("input.page_function" ).val();

    $.ajax({
        type: 'POST',
        url: site_url+'cco/get_order_data_details',
        data: {orderid: id,mode:"detail_data"},
        success: function(resp){
            $("div#detail_data").empty();
            $("#detail_data").html(resp);

            $("input#customer_id").val(customer_id);
        }
    });

    return false;
});


$(document).on("change","select#channel_partner",function(){

    var selected_channel_partner = $(this).val();

   // get_campgian_data(selected_channel_partner);

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_campagain_data",
        data: {selected_channel_partner: selected_channel_partner},
        success: function (resp) {
            var html_data = "";
            html_data += '<option value="">Campaign Name</option>';
            if(resp != 0)
            {
                var obj = $.parseJSON(resp);
                $.each( obj, function( key, value ) {
                    html_data += "<option value='"+value.campaign_id+"'>"+value.campaign_name+"</option>";
                });
            }

            $("select#Campaign").html(html_data);

            $("select#Campaign").selectpicker('refresh');

            //get_geo_data(campagain_id,3,num_count);
        }
    });

});


$('body').on("change","select.qualification",function(){

    var qualification = $(this).val();
    var parent_html = $(this);
    var spec_id = "";

    get_qualification_specilization_data(qualification,parent_html,spec_id);

});

function get_qualification_specilization_data(qualification,parent_html,spec_id)
{
        $.ajax({
        type: 'POST',
        url: site_url + "cco/get_qualification_specialization",
        data: {qualification_id: qualification},
        success: function (resp) {
            var obj = $.parseJSON(resp);

            var html = "<option value=''>Select Specialization</option>";

            $.each( obj, function( key, value ) {

                if(spec_id == value.edu_specialization_id){
                    var selected_data = "selected = 'selected'";
                }
                else{
                    var selected_data = "";
                }

                html += "<option "+selected_data+" value='"+value.edu_specialization_id+"'>"+value.edu_specialization_name+"</option>";
            });

            parent_html.parent().parent().parent().parent().find("select.specialization").html(html);
        }
    });
}

$(document).on("change","select#geo_level_3",function(){

    var parent_geo_id = $(this).val();

    if(parent_geo_id != "")
    {
        var parent_html = "";
        var level_data = 2;
        var num_count = 2;
        get_row_geo_data(parent_html, parent_geo_id, level_data, num_count,false);
    }
    else
    {
        var num_count = 2;
        $("div#dialpad_middle_contailner select#geo_level_"+num_count).empty();
        $("div#dialpad_middle_contailner select#geo_level_"+num_count).selectpicker('refresh');

        var num_count = 1;
        $("div#dialpad_middle_contailner select#geo_level_"+num_count).empty();
        $("div#dialpad_middle_contailner select#geo_level_"+num_count).selectpicker('refresh');
    }

});

$(document).on("change","select#geo_level_2",function(){

    var parent_geo_id = $(this).val();

    if(parent_geo_id != "") {
        var parent_html = "";
        var level_data = 1;
        var num_count = 1;
        get_row_geo_data(parent_html, parent_geo_id, level_data, num_count,false);
    }
    else
    {
        var num_count = 1;
        $("div#dialpad_middle_contailner select#geo_level_"+num_count).empty();
        $("div#dialpad_middle_contailner select#geo_level_"+num_count).selectpicker('refresh');
    }

});

function get_row_geo_data(parent_html,parent_geo_id,level_data,num_count,dialpad_call)
{
   // alert("HERE");
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_next_level_data",
        data: {parentgeoid: parent_geo_id},
        success: function (resp) {
            var obj = $.parseJSON(resp);

            var html = "<option value=''>Select Location</option>";

            $.each( obj, function( key, value ) {
                html += "<option value='"+value.political_geo_id+"'>"+value.political_geography_name+"</option>";
            });

            //alert(num_count);

            $("div#dialpad_middle_contailner select#geo_level_"+num_count).html(html);
            if(dialpad_call == false) {
                $("div#dialpad_middle_contailner select#geo_level_" + num_count).selectpicker('refresh');
            }
        }
    });
}
function get_customer_feedback_data(customer_id)
{
    //var customer_id = 4;
    var campagain_id = $("input#camagain_id").val();
    // alert(campagain_id);
    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_feedback_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}
function get_missedcall_data()
{

    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_missedcall_data",
        data: {},
        success: function (resp) {

            $("div#missedcall_Modal div.modal-body").html(resp);
            $("div#missedcall_Modal").modal("show");

            //get_geo_data(campagain_id,3,num_count);
        }
    });
}
function add_bargin_data()
{

    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_cco_data",
        data: {},
        success: function (result) {

            var json = JSON.parse(result);
            console.log(json);
            $("#bargin_cco_list").html("<option value=''>Select Cco</option>");
            $.each(json, function (i, item) {

                $('#bargin_cco_list').append($('<option>', {value: item.id,text: item.display_name}));

            });
        }
    });
}
function block_phone_number(phone_no)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/block_phone_number",
        data: {phone_no: phone_no},
        success: function (resp) {
            var message = "";
            if(resp == 1){
                message += 'Phone Blocked successfully.';
            }
            else{
                message += 'Phone Already Blocked.';
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
                        //get_customer_feedback_data(customer_id);

                    }
                });
        }
    });
}
function get_customer_schemes_data(customer_id)
{
    //var customer_id = 4;
    var campagain_id = $("input#camagain_id").val();
    // alert(campagain_id);
    var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_schemes_data",
        data: {customerid: customer_id},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}
$(document).on("submit","form#dialpad_scheme_view_info",function(e){


    e.preventDefault();

    var param = $("#dialpad_scheme_view_info").serializeArray();


    var $valid = $("#dialpad_scheme_view_info").valid();
    if(!$valid) {
        scheme_view_validators.focusInvalid();
        return false;
    }
    else
    {
        $.ajax({
            type: 'POST',
            url: site_url+"cco/view_schemes_details",
            data: param,
            dataType : 'html',
            success: function(resp){
                $("#middle_container").html(resp);
            }
        });
        return false;
    }
});
function get_complaint_data_from_complaint_type_id(complaint_type_id,customer_id)
{
    //var customer_id = 4;
   // var campagain_id = $("input#camagain_id").val();
    // alert(campagain_id);
    //var num_count = 3;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_complaint_data_from_type_id",
        data: {complaint_type_id: complaint_type_id,customer_id: customer_id},
        success: function (resp) {
            $("div#complaint_data").html(resp);
            //get_geo_data(campagain_id,3,num_count);
        }
    });
}


$(document).on("submit","form#dialpad_feedback_view_info",function(e){

    e.preventDefault();

    var param =  $("form#dialpad_feedback_view_info").serializeArray();
    var customer_id = $("input#customer_id").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_feedback_view_info",
        data:param,
        success: function (resp) {
            var message = "";
            if(resp == 1){
                message += 'Data added successfully.';
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
                        get_customer_feedback_data(customer_id);
                    }
                });

        }
    });
    return false;
});

$(document).on("click","#bargin_start",function(e){

    e.preventDefault();

    //var param =  $("form#dialpad_feedback_view_info").serializeArray();
    var cco_id = $("select#bargin_cco_list").val();
    var phone_no = $("input#input_call").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_bargin_info",
        data: {cco_id: cco_id,phone_no: phone_no},
        success: function (resp) {
            var message = "";
            if(resp == 1){
                message += 'Data added successfully.';
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
                        location.reload();
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#upper_dialpad",function(e){

    e.preventDefault();

    var param =  $("form#upper_dialpad").serializeArray();
    var customer_id = $("input#customer_id").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_upper_dialpad_info",
        data:param,
        success: function (resp) {
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
                        //get_customer_feedback_data(customer_id);
                    }
                });

        }
    });
    return false;
});


$(document).on("submit","form#dialpad_complaint_info",function(e){

    e.preventDefault();

    var param =  $("form#dialpad_complaint_info").serializeArray();
    var customer_id = $("input#customer_id").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_complaint_view_info",
        data:param,
        success: function (resp) {
            var message = "";
            if(resp == 1){
                message += 'Data added successfully.';
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
                        get_customer_complaint_data(customer_id);

                        //location.reload();

                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_complaint_view_info",function(e){

    e.preventDefault();

    var param =  $("form#dialpad_complaint_view_info").serializeArray();
    var customer_id = $("input#customer_id").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_complaint_view_info",
        data:param,
        success: function (resp) {
            var message = "";
            if(resp == 1){
                message += 'Data added successfully.';
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
                        get_customer_complaint_data(customer_id);
                       // location.reload();

                    }
                });

        }
    });
    return false;
});

$(document).on('click', 'div#feedback_data .delete_i', function () {
    var customer_id = $("input#customer_id").val();
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
                        url: site_url+'cco/delete_feedback_data',
                        data: {feedback_id:id},
                        success: function(resp){
                            //location.reload();
                            get_customer_feedback_data(customer_id);
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
$(document).on('click', 'div#complaint_data .delete_i', function () {
    var customer_id = $("input#customer_id").val();
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
                        url: site_url+'cco/delete_complaint_data',
                        data: {complaint_id:id},
                        success: function(resp){
                            //location.reload();
                            get_complaint_view_data(customer_id);
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

$(document).on('click', 'div#feedback_data .edit_i', function () {

    var customer_id = $("input#customer_id").val();
    var id = $(this).attr('prdid');

    $.ajax({
        type: 'POST',
        url: site_url+'cco/get_customer_feedback_data_edit',
        data: {feedback_id:id},
        success: function(resp){

            var obj = $.parseJSON(resp);

            $("input#subject").val(obj.feedback_subject);
            $("textarea#description").val(obj.feedback_description);
            $("input#feedback_edit_id").val(obj.feedback_id);

        }
    });

});

$(document).on('click', 'div#complaint_data .edit_i', function () {

    var customer_id = $("input#customer_id").val();
    var id = $(this).attr('prdid');

    $.ajax({
        type: 'POST',
        url: site_url+'cco/get_customer_complaint_data_edit',
        data: {complaint_id:id},
        success: function(resp){

            var obj = $.parseJSON(resp);

            $("input#complaint_edit_id").val(id);

            get_complaint_subject_from_complaint_type_edit(obj.complaint_type_id);
            get_complaint_date_from_complaint_subject_edit(obj.complaint_subject);
            get_person_data_from_desigination_edit(obj.designation_id);

            $("select#complaint_status").val(obj.complaint_status);
            $("select#complaint_type_edit").val(obj.complaint_type_id);

            $("input#complaint_id").val(obj.complaint_number);
            $("input#Complaint_entry_date_edit").val(obj.complaint_entry_date);
            //$("input#Complaint_due_date_edit").val(obj.complaint_due_date);
            //$("input#complaint_date1_edit").val(obj.escalation_date_1);
            $("input#complaint_date2_edit").val(obj.escalation_date_2);
            $("input#complaint_date3_edit").val(obj.escalation_date_3);
            $("textarea#remark_edit").val(obj.remarks);
            $("textarea#Comments").val(obj.complaint_data);

            $("select#person_name_edit").val(obj.complaint_type_id);

            setTimeout(function(){
                $("select#complaint_subject_edit").val(obj.complaint_subject);
                $("input#Complaint_due_date_edit").val(obj.complaint_due_date);
                $("input#complaint_date1_edit").val(obj.escalation_date_1);
            }, 1000);
            setTimeout(function(){
                $("select#designstion_edit").val(obj.designation_id);
            }, 2000);
            setTimeout(function(){
                $("select#person_name_edit").val(obj.assigned_to_id);

            }, 3000);

        }
    });

});

function get_complaint_subject_from_complaint_type(complaint_type_id)
{

    $.ajax({
        url: site_url+'cco/get_complaint_sub_from_complaint_type',
        method: "POST",
        data: { complaint_type_id: complaint_type_id },
        cache: false,
        success: function (result) {
            var json = JSON.parse(result);
            console.log(json);
            $("#complaint_subject").html("<option value=''>Select Subject</option>");
            $.each(json, function (i, item) {

                    $('#complaint_subject').append($('<option>', {value: item.complaint_id,text: item.complaint_subject}));

            });
        }
    });
}
function get_complaint_subject_from_complaint_type_edit(complaint_type_id)
{

    $.ajax({
        url: site_url+'cco/get_complaint_sub_from_complaint_type',
        method: "POST",
        data: { complaint_type_id: complaint_type_id },
        cache: false,
        success: function (result) {
            var json = JSON.parse(result);
            console.log(json);
            $("#complaint_subject_edit").html("<option value=''>Select Subject</option>");
            $.each(json, function (i, item) {

                $('#complaint_subject_edit').append($('<option>', {value: item.complaint_id,text: item.complaint_subject}));

            });
        }
    });
}
function get_person_data_from_desigination(desigination_country_id)
{



    $.ajax({
        url: site_url+'cco/get_person_data_from_desigination',
        method: "POST",
        data: { desigination_country_id: desigination_country_id },
        cache: false,
        success: function (result) {
            var json = JSON.parse(result);
            console.log(json);
            $("#person_name").html("<option value=''>Select Person</option>");
            $.each(json, function (i, item) {

                $('#person_name').append($('<option>', {value: item.id,text: item.display_name}));

            });
        }
    });
}
function get_person_data_from_desigination_edit(desigination_country_id)
{



    $.ajax({
        url: site_url+'cco/get_person_data_from_desigination',
        method: "POST",
        data: { desigination_country_id: desigination_country_id },
        cache: false,
        success: function (result) {
            var json = JSON.parse(result);
            console.log(json);
            $("#person_name_edit").html("<option value=''>Select Person</option>");
            $.each(json, function (i, item) {

                $('#person_name_edit').append($('<option>', {value: item.id,text: item.display_name}));

            });
        }
    });
}

function get_complaint_date_from_complaint_subject(complaint_subject_id)
{

    $.ajax({
        url: site_url+'cco/get_complaint_date_from_complaint_sub',
        method: "POST",
        data: { complaint_subject_id: complaint_subject_id },
        cache: false,
        async: true,
        success: function (result) {

            var obj = $.parseJSON(result);

            $("input#Complaint_due_date").val(obj.complaint_due_date);
            $("input#complaint_date1").val(obj.complaint_due_date);
            $("input#complaint_date2").val(obj.complaint_due_date2);
            $("input#complaint_date3").val(obj.complaint_due_date3);

            if(obj.reminder1_desigination_id != null)
            {
                $("#designstion").html("<option value=''>Select Designation</option>");
                $('#designstion').append($('<option>', {
                    value: obj.desigination_country_id_for,
                    text: obj.desigination_country_name_for
                }));
                $('#designstion').removeAttr("disabled");
                $('#person_name').removeAttr("disabled");
            }
        }
    });

    $.ajax({
        url: site_url+'cco/get_complaint_responsible_designation',
        method: "POST",
        data: { complaint_subject_id: complaint_subject_id },
        cache: false,
        async: true,
        success: function (result) {

            if(result != "")
            {
                var obj = $.parseJSON(result);
                console.log(obj);
                $("select#designstion").empty();
                $("#designstion").html("<option value=''>Select Designstion</option>");
                $.each(obj, function (i, item) {
                    $('#designstion').append($('<option>', {value: item.desigination_country_id,text: item.desigination_country_name}));
                });
            }
        }
    });

}

function get_complaint_date_from_complaint_subject_edit(complaint_subject_id)
{

    $.ajax({
        url: site_url+'cco/get_complaint_date_from_complaint_sub',
        method: "POST",
        data: { complaint_subject_id: complaint_subject_id },
        cache: false,
        async: true,
        success: function (result) {

            var obj = $.parseJSON(result);

            $("input#Complaint_due_date_edit").val(obj.complaint_due_date);
            $("input#complaint_date1_edit").val(obj.complaint_due_date);
            $("input#complaint_date2_edit").val(obj.complaint_due_date2);
            $("input#complaint_date3_edit").val(obj.complaint_due_date3);

            if(obj.reminder1_desigination_id != null)
            {
                $("#designstion_edit").html("<option value=''>Select Designation</option>");
                $('#designstion_edit').append($('<option>', {
                    value: obj.desigination_country_id_for,
                    text: obj.desigination_country_name_for
                }));
                $('#designstion_edit').removeAttr("disabled");
                $('#person_name_edit').removeAttr("disabled");
            }
        }
    });

    $.ajax({
        url: site_url+'cco/get_complaint_responsible_designation',
        method: "POST",
        data: { complaint_subject_id: complaint_subject_id },
        cache: false,
        async: true,
        success: function (result) {

            if(result != "")
            {
             /*   var obj = $.parseJSON(result);
                console.log(obj);
*/
               // var html_data = "";
                $("select#designstion_edit").empty();
                $("#designstion_edit").html("<option value=''>Select Designstion</option>");
                $.each(JSON.parse(result), function(key, value) {
                    $('select#designstion_edit').append('<option value="' + value.desigination_country_id + '">' + value.desigination_country_name + '</option>');
                });
               /* $.each(obj, function (i, item) {

                    html_data += "";

                    html_data += $('<option>', {value: item.desigination_country_id,text: item.desigination_country_name});
                });*/

              //  $('#designstion_edit').html(html_data);

            }
        }
    });

}


$(document).on('click','div#searched_data div.delete_i',function(){

    var id = $(this).attr('prdid');
    var customer_id = $("input#customer_id").val();

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
                        url: site_url+"cco/delete_product_order_data",
                        data: {data_id:id},
                        success: function(resp){
                            //location.reload();
                            get_order_status_data(customer_id,null);
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


$(document).on('click', 'div#detail_data .edit_i', function () {

    $("button#update_order_data").css("display","inline-block");

    var id = $(this).attr('prdid');

    var row_data = $(this).parent().parent().html();

    //UNIT
    var unit_value = $(row_data).find("div.unit_data input.unitdata").val();

    var selected_data1 = "";
    var selected_data2 = "";
    var selected_data3 = "";

    if (unit_value === "Box") {

        selected_data1 = 'selected = "selected"';
    }

    if (unit_value === "Packages") {

        selected_data2 = 'selected = "selected"';
    }

    if (unit_value === "Kg/Ltr") {

        selected_data3 = 'selected = "selected"';
    }

    $(this).parent().parent().find("div.unit_data").html('<select name="units[]" class="select_unitdata"> <option ' + selected_data1 + ' value="box">Box</option> <option ' + selected_data2 + ' value="packages">Packages</option><option ' + selected_data3 + ' value="kg/ltr">Kg/Ltr</option> </select>');


    var quantity_value = $(row_data).find("div.quantity_data input.quantitydata").val();

    //QUANTITY

    $(this).parent().parent().find("div.quantity_data").html('<input  type="text" class="quantity_data allownumericwithdecimal" name="quantity[]" value="' + quantity_value + '"/>');

    return false;
});




$("body").on("change","select.select_unitdata",function(){

    var row_data = $(this).parent().parent().parent().html();

    var sku_id = $(this).parent().parent().parent().find("input.product_sku_data").val();

    var units = $(this).val();

    var quantity = $(this).parent().parent().parent().find("input.quantity_data").val();

    var unit_data = get_data_conversion(sku_id,quantity,units);

    $(this).parent().parent().parent().find("input.qty_kg_ltrdata").val(unit_data);

});


$("body").on("keyup","input.quantity_data",function(){

    var row_data = $(this).parent().parent().parent().html();

    var sku_id = $(this).parent().parent().parent().find("input.product_sku_data").val();

    var units = $(this).parent().parent().parent().find("select.select_unitdata").val();

    var quantity = $(this).val();

    var unit_data = get_data_conversion(sku_id,quantity,units);

    $(this).parent().parent().parent().find("input.qty_kg_ltrdata").val(unit_data);

});



function get_data_conversion(sku_id,quantity,units){

    var unit_data = "";

    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_quantity_conversion_data",
        data: {skuid:sku_id, quantity_data:quantity, unit : units},
        //dataType : 'json',
        success: function(resp){
            unit_data = resp;
        },
        async:false
    });

    return unit_data;

}



$(document).on("submit","form#dialpad_general_info",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();

    var param =  $("form#dialpad_general_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_general_info",
        data:param,
        success: function (resp) {
            var message = "";
            if(resp == 1)
            {
                message += 'Data Inserted successfully.';
            }
            else if(resp == 2)
            {
                message += 'Data Inserted successfully.';
            }
            else
            {
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

                        if(resp == 2)
                        {
                            var phone_no = $("input#primary_mobile_no").val();
                            dialpad(phone_no,null,null,null);
                        }
                        else
                        {
                            get_general_detail_data(customer_id);
                        }

                       // location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("change","select.level_data",function(){

    var selected_level_data = $(this).val();

    var level_no = $(this).attr("attr-level");

    var level = level_no-1;
    $(this).parent().parent().parent().nextAll("div.location_level_data").remove();

    get_level_location_data(selected_level_data,level);

    get_location_employee_data(selected_level_data);

});

$(document).on("click","a.unknown_customer_role",function(){

    var role_data = $(this).attr("attr-role-data");
    $("input#role_id").val(role_data);

    if(role_data == 11)
    {
        var level_data = 2;
    }
    else if(role_data == 10)
    {
        var level_data = 3;
    }
    else if(role_data == 9)
    {
        var level_data = 4;
    }

    get_level_data_for_unkown_no(level_data);

    $("select#geo_level_2").empty();
    $("select#geo_level_1").empty();

    $("select#geo_level_2").selectpicker("refresh");
    $("select#geo_level_1").selectpicker("refresh");

});

function get_level_data_for_unkown_no(level_data)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_level_data_for_unkown_no",
        data: {leveldata:level_data},
        success: function (resp) {

            if(resp != 0) {
                var obj = $.parseJSON(resp);

                var html = "<option value=''>Select Location</option>";
                $.each(obj, function (key, value) {
                    html += "<option value='" + value.political_geo_id + "'>" + value.political_geography_name + "</option>";
                });

                $("select#geo_level_3").html(html);

               // $("select.level_data").selectpicker("refresh");
            }
        }
    });
}

function get_level_location_data(selected_level_data,level)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_next_level_data",
        data: {parentgeoid:selected_level_data},
        success: function (resp) {

            if(resp != 0) {
                var obj = $.parseJSON(resp);

                var html = "<div class='form-group location_level_data'>";
                html += "<label>Level " + level + "</label>";
                html += "<div class='inln_fld_top'>";
                html += "<select attr-level = '" + level + "'  class='selectpicker level_data' >";
                html += "<option value=''>Select Location</option>";
                $.each(obj, function (key, value) {
                    html += "<option value='" + value.political_geo_id + "'>" + value.political_geography_name + "</option>";
                });

                html += "</select>";
                html += "</div>";
                html += "</div>";

                $("div.main_level_data div.location_level_data").last().after(html);

                $("select.level_data").selectpicker("refresh");

            }
        }
    });
}

function get_location_employee_data(selected_level_data)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_level_employee_data",
        data: {parentgeoid: selected_level_data},
        success: function (resp) {
            $("div#customer_data").html(resp);
        }
    });
}




$(document).on("submit","form#dialpad_family_info",function(e){

    e.preventDefault();
    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_family_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_family_info",
        data:param,
        success: function (resp) {
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
                        get_family_detail_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_education_info",function(e){

    e.preventDefault();
    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_education_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_education_info",
        data:param,
        success: function (resp) {
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
                        get_education_detail_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_social_info",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_social_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_social_info",
        data:param,
        success: function (resp) {
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
                        get_social_detail_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_financial_info",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_financial_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_financial_info",
        data:param,
        success: function (resp) {
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
                        get_financial_detail_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_retailer_info",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_retailer_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_retailer_info",
        data:param,
        success: function (resp) {
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
                        get_retailer_view_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_farming_info",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_farming_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_crop_farming_info",
        data:param,
        success: function (resp) {
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
                        get_farming_view_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_business_info",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_business_info").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_business_info",
        data:param,
        success: function (resp) {
            var message = "";
            if(resp == 1){
                message += 'Data Addes Successfully.';
            }
            else{
                message += 'Data not Added.';
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
                        get_business_view_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on("submit","form#dialpad_question_data",function(e){

    e.preventDefault();

    var customer_id = $("input#customer_id").val();
    var param =  $("form#dialpad_question_data").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_update_question_data",
        data:param,
        success: function (resp) {

            var message = "";
            if(resp == 1){
                message += 'Data Added Successfully.';
            }
            else{
                message += 'Data not Added.';
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
                        get_questions_detail_data(customer_id);
                        //location.reload()
                    }
                });

        }
    });
    return false;
});

$(document).on('click','tr.activity_details',function(){
   var id =  $(this).attr('id');

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_details",
        data:{id:id},
        success: function (resp) {
            $("#executed_customer").html(resp);
        }
    });
    return false;
});

/* CCO :: Open Transfer Popup */
$(document).on('click','#transfer_popup',function(){
    $.ajax({
        type: 'POST',
        url: site_url + "cco/view_transfer",
        data: {},
        dataType : 'html',
        success: function (resp) {
            $("#popup_container").html(resp);
            $('#popup_container').modal({show:true});
        }
    });

});

$(document).on('change','#designation',function() {

    var designation_id =  $(this).val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_employee_by_designation",
        data: {designation_id:designation_id},
        success: function (resp) {

            $("select#employee_name").empty();
            $("select#employee_name").selectpicker('refresh');


            if(resp.length > 0){
                var obj = $.parseJSON(resp);
                $("select#employee_name").append('<option value="">Select Employee Name</option>');

                $.each(obj, function(key, value) {
                    $('select#employee_name').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
                });

                $("select#employee_name").selectpicker('refresh');
            }

        }
    });
});


function save_call_transfer(){

    var param = $('#form_call_transfer').serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_cco_transfer",
        data: param,
        dataType : 'html',
        success: function (resp) {
            $('#popup_container').modal('hide');
            var msg;
            if(resp == 1) {
                msg = 'data_inserted';
            } else{
                msg = 'data_not_inserted';
            }
            show_message_popup(msg);
        }
    });
}




function save_emp_call_transfer(){

    var param = $('#form_emp_call_transfer').serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_emp_transfer",
        data: param,
        dataType : 'html',
        success: function (resp) {
            $('#popup_container').modal('hide');
            var msg;
            if(resp == 1) {
                msg = 'data_inserted';
            } else{
                msg = 'data_not_inserted';
            }
            show_message_popup(msg);
        }
    });

}
/* CCO :: Open Transfer Popup */

/* CCO :: Open Reminder Popup */
$(document).on('click','#reminder_popup',function(){
    open_reminder_popup('dialpad');
});

$(document).on('click','#gen_reminder_popup',function(){
    open_reminder_popup('mainscreen');
});

function open_reminder_popup(page)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_reminder",
        data: {pg:page},
        dataType : 'html',
        success: function (resp) {
            $("#popup_container").html(resp);
            $('#popup_container').modal({show:true});
        }
    });
}

function save_call_reminder()
{
    var param = $('#form_call_reminder').serializeArray();
    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_reminder",
        data: param,
        success: function (resp) {
            $('#popup_container').modal('hide');
            var msg;
            if(resp == 1) {
                msg = 'data_inserted';
            } else{
                msg = 'data_not_inserted';
            }
            show_message_popup(msg);
        }
    });
}



function save_gen_reminder()
{
    var param = $('#form_gen_reminder').serializeArray();
    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_reminder",
        data: param,
        dataType : 'html',
        success: function (resp) {
            $('#popup_container').modal('hide');
            var msg;
            if(resp == 1) {
                msg = 'data_inserted';
            } else{
                msg = 'data_not_inserted';
            }
            show_message_popup(msg);
        }
    });
}

function delete_reminder()
{
    var param = $('#form_view_reminder').serializeArray();
    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_reminder",
        data: param,
        dataType : 'html',
        success: function (resp) {
            $('#popup_container').modal('hide');
            var msg;
            if(resp == 1) {
                msg = 'data_deleted';
            } else{
                msg = 'data_not_deleted';
            }
            show_message_popup(msg);
        }
    });
}

$(document).on("click","#check_all",function() {
    if($(this).is(':checked')){
        $('.rem_check_checked').prop('checked', true);
    } else {
        $('.rem_check_checked').prop('checked', false);
    }
});

/* CCO :: Open Reminder Popup */