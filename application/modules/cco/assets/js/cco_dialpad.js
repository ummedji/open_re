$(document).ready(function(){

    $("select#Campaign").on("change",function(){

        var campagain_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: site_url + "cco/get_campagain_allocated_data",
            data: {campagainid: campagain_id},
            success: function (resp) {
                $("div#customer_data").html(resp);
            }
        });

    });

});

$(document).on("click","a.primary_no",function(){

    var phone_no = $(this).attr("rel");
    var campagain_id = $("select#Campaign").val();

    dialpad(phone_no,campagain_id);

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

$(document).on("submit","form#dialpad_general_info",function(e){

    e.preventDefault();

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
                        location.reload()
                    }
                });

        }
    });
    return false;
});