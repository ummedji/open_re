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
                var html += "<tr>";
                    $.each( value, function( key1, value1 ) {
                        alert(key1 + ": " + value1);



                    });
                var html += "</tr>";
            });


        }

    });

}