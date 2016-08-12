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

    get_general_detail_data();

});

$(document).on("click","a.primary_no",function(){

    var customer_id = $(this).attr("rel");
    var campagain_id = $("select#Campaign").val();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/set_customer_data",
        data: {customerid: customer_id,campagainid:campagain_id},
        success: function (resp) {

        }
    });

    var url = site_url + "cco/dialpad";

    setTimeout(function(){
        window.open(url, "popupWindow", "width=1200,height=1000,scrollbars=yes");
    }, 300);


});

function get_general_detail_data()
{
    var customer_id = 4;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/get_customer_general_detail_data",
        data: {customerid: customer_id},
        success: function (resp) {

        }
    });

}