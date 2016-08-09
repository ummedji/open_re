$(document).ready(function(){

    $("select#campagain_data").on("change",function(){

        var campagain_id = $(this).val();

        $("tbody#geo_location_data").empty();

        get_geo_data(campagain_id,3);
    });

});

function get_geo_data(campagain_id,level_data)
{
    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_level_data",
        data: {campagainid:campagain_id,leveldata:level_data},
        success: function(resp){
            var obj = $.parseJSON(resp);
            var html = "";
            $.each( obj, function( key, value ) {
                 html += "<tr>";
                    $.each( value, function( key1, value1 )
                    {
                      //  alert(key1 + ": " + value1);
                        var farmer_count = 0;
                        var pending_data_count = 0;

                        $.ajax({
                            type: 'POST',
                            url: site_url + "cco/get_level_farmer_count",
                            data: {geo_id: value1.political_geo_id,leveldata:level_data},
                            success: function (resp) {
                                farmer_count = resp;
                            },
                            async:false
                        });

                         html += "<td><div class='row_data'><input rel='"+value1.political_geo_id+"' type='checkbox' name='level_3' class='level_3' value='"+value1.political_geography_name+"' />"+value1.political_geography_name+"&nbsp;&nbsp;&nbsp;"+pending_data_count+"/"+farmer_count+"</div></td><td></td><td></td>";


                    });
                 html += "</tr>";
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
        get_row_geo_data(parent_html,parent_geo_id,level_data);
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
        get_row_geo_data(parent_html,parent_geo_id,level_data);
    }
    else
    {
        parent_html.parent().parent().parent().find("td:nth-child(3) div.parent_id_"+parent_geo_id).remove();
        //$("div.parent_id_"+parent_geo_id).remove();
    }
});


function get_row_geo_data(parent_html,parent_geo_id,level_data)
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
                    data: {geo_id: value.political_geo_id,leveldata:level_data},
                    success: function (resp) {
                        farmer_count = resp;
                    },
                    async:false
                });

                html += "<div class='row_data parent_id_"+parent_geo_id+"'><input rel='"+value.political_geo_id+"' type='checkbox' name='level_"+level_data+"' class='level_"+level_data+"' value='"+value.political_geography_name+"' />"+value.political_geography_name+"&nbsp;&nbsp;&nbsp;"+pending_data_count+"/"+farmer_count+"</div>";

            });
            parent_html.parent().parent().parent().find("td:nth-child("+level_data+")").append(html);

        }
    });

}