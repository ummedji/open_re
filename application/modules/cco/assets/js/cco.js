$(document).ready(function(){

    $("select#campagain_data").on("change",function(){

        var campagain_id = $(this).val();

        $("tbody#geo_location_data").empty();
        var num_count = 3;
        get_geo_data(campagain_id,3,num_count);

        get_campagain_grid_data(campagain_id);

    });

    var cco_allocation_validators = $("#cco_allocation").validate({
        //ignore:'.ignore',
        rules: {
            campagain_data:{
                required: true
            },
            cco_data:{
                required: true
            },
            "level_1[]":{
                required: true
            }
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
            var html = "";
            $.each( obj, function( key, value ) {

                    $.each( value, function( key1, value1 )
                    {
                      //  alert(key1 + ": " + value1);
                        var farmer_count = 0;
                        var pending_data_count = 0;
                        html += "<tr>";
                        $.ajax({
                            type: 'POST',
                            url: site_url + "cco/get_level_farmer_count",
                            data: {geo_id: value1.political_geo_id,leveldata:num_count},
                            success: function (resp) {

                                var obj = jQuery.parseJSON(resp);

                                farmer_count = obj.total_count;
                                pending_data_count = obj.pending_count;
                            },
                            async:false
                        });

                         html += "<td><div class='row_data'><input rel='"+value1.political_geo_id+"' type='checkbox' name='level_"+num_count+"[]' class='level_"+num_count+"' value='"+value1.political_geo_id+"' />"+value1.political_geography_name+"&nbsp;&nbsp;&nbsp;"+pending_data_count+"/"+farmer_count+"</div></td><td></td><td></td>";

                        html += "</tr>";
                    });

            });
            $("tbody#geo_location_data").html(html);
        }

    });

}

$('body').on('click', 'input.level_3', function() {

    var parent_geo_id = $(this).attr("rel");
    var parent_html = $(this);

    if($(this).is(":checked"))
    {
        var level_data = 2
        var num_count = 2;
        get_row_geo_data(parent_html,parent_geo_id,level_data,num_count);
    }
    else
    {
       // $("div.parent_id_"+parent_geo_id).remove();
        parent_html.parent().parent().parent().find("td:nth-child(2) div.parent_id_"+parent_geo_id).remove();
        parent_html.parent().parent().parent().find("td:nth-child(3)").empty();
    }
});

$('body').on('click', 'input.level_2', function() {

    var parent_geo_id = $(this).attr("rel");
    var parent_html = $(this);
    if($(this).is(":checked"))
    {
        var level_data = 3;
        var num_count = 1;
        get_row_geo_data(parent_html,parent_geo_id,level_data,num_count);

        $("button.save_btn").css("display","block");

    }
    else
    {
        parent_html.parent().parent().parent().find("td:nth-child(3) div.parent_id_"+parent_geo_id).remove();

        if($("tbody#geo_location_data tr td:nth-child(3) input.level_1").length <= 0) {
            $("button.save_btn").css("display", "none");
        }
        //$("div.parent_id_"+parent_geo_id).remove();
    }
});

/*
$("body").on("click","input.level_2",function(){

    if($("tbody#geo_location_data tr td:nth-child(3) input.level_1").length > 0)
    {
        $("button.save_btn").css("display","block");
    }
});

*/


function get_row_geo_data(parent_html,parent_geo_id,level_data,num_count)
{
    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_next_level_data",
        data: {parentgeoid: parent_geo_id},
        success: function (resp) {
            var obj = $.parseJSON(resp);
            var html = "";

            $.each( obj, function( key, value ) {

                var farmer_count = 0;
                var pending_data_count = 0;

                $.ajax({
                    type: 'POST',
                    url: site_url + "cco/get_level_farmer_count",
                    data: {geo_id: value.political_geo_id,leveldata:num_count},
                    success: function (resp) {
                        var obj = jQuery.parseJSON(resp);

                        farmer_count = obj.total_count;
                        pending_data_count = obj.pending_count;
                    },
                    async:false
                });

                html += "<div class='row_data parent_id_"+parent_geo_id+"'><input rel='"+value.political_geo_id+"' type='checkbox' name='level_"+num_count+"[]' class='level_"+num_count+"' value='"+value.political_geo_id+"' />"+value.political_geography_name+"&nbsp;&nbsp;&nbsp;"+pending_data_count+"/"+farmer_count+"</div>";

            });
            parent_html.parent().parent().parent().find("td:nth-child("+level_data+")").append(html);

        }
    });

}


$(document).on("submit","#cco_allocation",function(e){

    e.preventDefault();

    var param = $("#cco_allocation").serializeArray();

    var $valid = $("#cco_allocation").valid();
    if(!$valid) {
        cco_allocation_validators.focusInvalid();
        return false;
    }
    else
    {

        //if($("tbody.geo_location_data tr td:nth-child(3) div").length <= 0){

        //}
       // else

        $.ajax({
            type: 'POST',
            url: site_url+"cco/add_allocation",
            data: param,
            //dataType : 'json',
            success: function(resp){
                var message = "";
                //alert(resp);
                if(resp != 0){
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
                             location.reload()
                        }
                    });
            }
        });
        return false;
    }
});

function get_campagain_grid_data(campagain_id)
{
    $("div.allocation_container").empty();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_campagain_grid_data",
        data: {campagainid:campagain_id},
        dataType : 'html',
        success: function (resp) {

           // alert(resp);

            $("div.allocation_container").html(resp);
        }
    });
}

$(document).on('click', 'div.allocation_container .delete_i', function () {
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
                        url: site_url+'cco/delete_allocation_data',
                        data: {allocation_id:id},
                        success: function(resp){
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