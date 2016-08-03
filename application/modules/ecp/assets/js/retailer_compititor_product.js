$(function () {
    $('#month_data').datepicker({
        format: "yyyy-mm",
        autoclose: true
    });

    $("select#geo_id").on("change",function(){

        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data);

    });



    var retailer_comp_prd_validators = $("#retailer_compititor_product").validate({
        ignore: ".ignore",
        rules: {
            month_data:{
                required: true
            },
            geo_id:{
                required: true
            },
            retailer_id:{
                required: true
            },
            compititor_id:{
                required: true
            },
            prod_sku:{
                required: true
            },
            comp_prd:{
                required: true
            },
            qty:{
                required: true
            }
        }
    });


    $("#add_row").click(function() {
        $('#prod_sku').removeClass('ignore');
        $('#comp_prd').removeClass('ignore');
        $('#qty').removeClass('ignore');

        var $valid = $("#retailer_compititor_product").valid();
        if(!$valid) {
            retailer_comp_prd_validators.focusInvalid();
            return false;
        }
        else
        {
            add_row();
            /*var sku_ids = $('#retailer_comp_prd input[name^=prod_sku_id]').map(function(idx, elem) {
                return $(elem).val();
            }).get();

            var cur_sku_id = $('#prod_sku option:selected').val();
            if(sku_ids.length !== 0)
            {
                if(jQuery.inArray(cur_sku_id, sku_ids) !== -1)
                {
                    $('<div></div>').appendTo('body')
                        .html('<div>Product already Inserted.</div>')
                        .dialog({
                            appendTo: "#success_file_popup",
                            modal: true,
                            title: 'Are You Sure?',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
                }
                else
                {
                    add_row();
                }
            }
            else
            {
                add_row();
            }*/
        }
    });

    $("#retailer_compititor_product").on("submit",function(){

        $('#prod_sku').addClass('ignore');
        $('#comp_prd').addClass('ignore');
        $('#qty').addClass('ignore');
        var param = $("#retailer_compititor_product").serializeArray();

        var $valid = $("#retailer_compititor_product").valid();
        if(!$valid) {

            retailer_comp_prd_validators.focusInvalid();
            return false;
        }
        else
        {
            if($("#retailer_comp_prd").children().length <= 0)
            {
                alert('No Data Selected');
                return false;
            }
            else {
                $('.save_btn button').attr('disabled','disabled');
                $.ajax({
                    type: 'POST',
                    url: site_url + "ecp/retailer_compititor_product_details",
                    data: param,
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
            }
        }
        return false;
    });

});


function add_row()
{
    var prod_sku_name = $('#prod_sku option:selected').attr('attr-name');
    var prod_sku_id = $('#prod_sku option:selected').val();
    var comp_prd_name = $('#comp_prd').val();
    var qty = $('#qty').val();
    var entry_date = $.datepicker.formatDate('yy-mm-dd', new Date());
    var sr_no =$("#retailer_comp_prd > tr").length + 1;

    $("#retailer_comp_prd").append(
        "<tr>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input class='input_remove_border'  type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i retailer_comp_prd' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Entry Date'>" +
        "<input type='text' class='input_remove_border'  value='"+entry_date+"'/>" +
        "</td>"+
        "<td data-title='Compititor Product Name'>" +
        "<input type='text' class='input_remove_border' name='comp_prd_name[]'  value='"+comp_prd_name+"'/>" +
        "</td>"+
        "<td data-title='Quantity'>" +
        "<input type='text' class ='allownumericwithdecimal' name='quantity[]' value='"+qty+"'/>" +
        "</td>"+
        "<td data-title='Our Product'>" +
        "<input class='input_remove_border' type='text' value='"+prod_sku_name+"' readonly/>" +
        "<input type='hidden' name='prod_sku_id[]' value='"+prod_sku_id+"'/>" +
        "</td>"+
        "</tr>"
    );
    $('.save_button').css("display","block");
    $('#prod_sku').selectpicker('val', '');
    $('#comp_prd').val('');
    $('#qty').val('');
}


$(document).on('click', 'div.retailer_comp_prd', function () {

    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    var i = 1;
    $("tbody#retailer_comp tr").each(function(  k, v  ) {

        $(this).attr("id",i);
        $(this).find("td").first().find("input").val(i);

        i++;
    });
    return false;
});









function get_user_by_geo_data(selected_geo_data){

    $("select#retailer_id").empty();
    $("select#retailer_id").selectpicker('refresh');

    var checked_type = 'retailer';
    var login_customer_type = $("input#login_customer_type" ).val();

    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){
            //console.log(resp);

            $("select#retailer_id").empty();
            $("select#retailer_id").append('<option value="">Select Retailer Name</option>');
            $.each(resp, function(key, value) {
                $('select#retailer_id').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
            });
            $("select#retailer_id").selectpicker('refresh');
        }
    });

}
