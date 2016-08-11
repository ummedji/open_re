$(document).ready(function(){

    $("select#Campaign").on("change",function(){

        var campagain_id = $(this).val();

        $("tbody#dialpad_main_screen").empty();

        $.ajax({
            type: 'POST',
            url: site_url + "cco/get_campagain_allocated_data",
            data: {campagainid: campagain_id},
            success: function (resp) {

            }
        });

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