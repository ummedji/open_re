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
                    $.each( value, function( key1, value1 ) {
                      //  alert(key1 + ": " + value1);

                         html += "<td><input rel='"+value1.political_geo_id+"' type='checkbox' name='level_3' class='level_3' value='"+value1.political_geography_name+"' />"+value1.political_geography_name+"</td><td></td><td></td>";


                    });
                 html += "</tr>";
            });
            $("tbody#geo_location_data").html(html);
        }

    });

}