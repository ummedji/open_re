/**
 * Created by webclues on 5/24/2016.
 */

$(function () {
    $('#invoice_month').datepicker({
        format: "yyyy-mm", // Notice the Extra space at the beginning
        autoclose: true,

        viewMode: "months",
        minViewMode: "months"
    });
});


$("#invoice_confirmation").on("submit",function(e){

    e.preventDefault();

    var param = $("#invoice_confirmation").serializeArray();

    get_invoice_confirmation_received(param);
    return false;
});

function get_invoice_confirmation_received(param)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/invoice_confirmation_received",
        data: param,
        dataType : 'html',
        success: function(resp){
            $("#middle_container_product").empty();
            $("#middle_container").html(resp);
        }
    });


}

$(document).on("change",".received_status",function(){
    var sales_id =$(this).parent().find("input.sales_id").val();
    var param = $("#invoice_confirmation").serializeArray();

    update_invoice_confirmation_received(sales_id);
   // return false;
    get_invoice_confirmation_received(param);
});

function update_invoice_confirmation_received(sales_id)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ishop/update_invoice_confirmation_received",
        data: {sales:sales_id},
        success: function(resp){
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
                        location.reload()
                    }
                });
        }
    });
    return false;
}

/*Get Product Data*/

$(document).on('click', 'div.middle_container_received .eye_i', function () {
    var id = $(this).attr('prdid');

    $('div.middle_container_received').find('tr.bg_focus').removeClass();
    $(this).parents("tr").addClass("bg_focus");

    $.ajax({
        type: 'POST',
        url: site_url+'ishop/invoice_sales_product_details_view',
        data: {id: id},
        success: function(resp){
            $("#middle_container_product").html(resp);
        }
    });

    $('#main').animate({
        scrollTop: $(document).height()
    }, 1000);
    return false;
});
/*Get Product Data*/


$('#download_csv').on('click',function(){

    var param = $("#invoice_confirmation").serialize();

    var export_url = site_url + "ishop/invoice_confirm_details_csv_report?" + param+"&page="+$("input#page").val();

    window.location.href = export_url;

    return false;

});

