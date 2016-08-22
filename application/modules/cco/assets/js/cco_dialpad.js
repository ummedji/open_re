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
$('body').on('focus',".year_data", function(){
    $(this).datepicker({
        format: "yyyy",
        autoclose: true,
        viewMode: "years",
        minViewMode: "years"
    });
});

$(document).on("click","a.primary_no",function(){

    var phone_no = $(this).attr("rel");
    var campagain_id = $("select#Campaign").val();

    dialpad(phone_no,campagain_id);

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
function dialpad(phone_no,campagain_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/set_customer_data",
        data: {phoneno: phone_no,campagainid:campagain_id},
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
        data: {customerid: customer_id,searchdata:search_data},
        success: function (resp) {
            $("div#dialpad_middle_contailner").html(resp);
            //  get_geo_data(campagain_id,1,num_count);
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
                        //get_customer_complaint_data();
                        location.reload();

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

            $("select#complaint_status").val(obj.complaint_status);
            $("select#complaint_type_edit").val(obj.complaint_type_id);
            $("input#complaint_subject_edit").val(obj.complaint_subject);


            $("input#complaint_id").val(obj.complaint_number);
            $("input#Complaint_entry_date_edit").val(obj.complaint_entry_date);
            $("input#complaint_date1_edit").val(obj.complaint_due_date);
            $("input#remark_edit").val(obj.remarks);
            $("input#Comments").val(obj.complaint_data);
            $("select#person_name_edit").val(obj.assigned_to_id);

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

            $("input#Complaint_entry_date_edit").val(obj.complaint_due_date);
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
                var obj = $.parseJSON(result);
                console.log(obj);

                $.each(obj, function (i, item) {
                    $('#designstion_edit').append($('<option>', {value: item.desigination_country_id,text: item.desigination_country_name}));
                });
            }
        }
    });

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
                        get_general_detail_data(customer_id);
                       // location.reload()
                    }
                });

        }
    });
    return false;
});

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

