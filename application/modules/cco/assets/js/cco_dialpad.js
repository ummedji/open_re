$(document).ready(function(){

    $("select#campagain").on("change",function(){

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