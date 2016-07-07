$(function () {
    $('#month_data').datepicker({
        format: "yyyy-mm",
        autoclose: true
    });

    $("select#geo_id").on("change",function(){

        var selected_geo_data = $(this).val();
        get_user_by_geo_data(selected_geo_data);

    });


    var distributor_comp_validators = $("#distributor_compititor").validate({
        ignore: ".ignore",
        rules: {
            month_data:{
                required: true
            },
            geo_id:{
                required: true
            },
            distributor_id:{
                required: true
            },
            compititor_id:{
                required: true
            },
            amt:{
                required: true
            }
        }
    });


    $("#add_row").click(function() {

        $('#compititor_id').removeClass('ignore');
        $('#amt').removeClass('ignore');

        var $valid = $("#distributor_compititor").valid();
        if(!$valid) {
            distributor_comp_validators.focusInvalid();
            return false;
        }
        else
        {
            add_row();
        }
    });

    $("#distributor_compititor").on("submit",function(){

        $('#compititor_id').addClass('ignore');
        $('#amt').addClass('ignore');

        var param = $("#distributor_compititor").serializeArray();

        var $valid = $("#distributor_compititor").valid();
        if(!$valid) {
            distributor_comp_validators.focusInvalid();
            return false;
        }
        else
        {
            if($("#distributor_comp").children().length <= 0)
            {
                alert('No Data Selected');
                return false;
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: site_url + "ecp/distributor_compititor_details",
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
    var comp_name = $('#compititor_id option:selected').attr('attr-name');
    var comp_id = $('#compititor_id option:selected').val();
    var amt = $('#amt').val();
    var entry_date = $.datepicker.formatDate('yy-mm-dd', new Date());
    var sr_no =$("#distributor_comp > tr").length + 1;

    $("#distributor_comp").append(
        "<tr>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input class='input_remove_border'  type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i distributor_comp' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Entry Date'>" +
        "<input type='text' class='input_remove_border'  value='"+entry_date+"'/>" +
        "</td>"+
        "<td data-title='Compititors Name'>" +
        "<input class='input_remove_border' type='text' value='"+comp_name+"' readonly/>" +
        "<input type='hidden' name='comp_id[]' value='"+comp_id+"'/>" +
        "</td>"+
        "<td data-title='Amount'>" +
        "<input type='text' class ='allownumericwithdecimal' name='amount[]' value='"+amt+"'/>" +
        "</td>"+
        "</tr>"
    );
    $('.save_button').css("display","block");
    $('#compititor_id').selectpicker('val', '0');
    $('#amt').val('');

}

$(document).on('click', 'div.distributor_comp', function () {

    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    var i = 1;
    $("tbody#distributor_comp tr").each(function(  k, v  ) {

        $(this).attr("id",i);
        $(this).find("td").first().find("input").val(i);

        i++;
    });
    return false;
});


function get_user_by_geo_data(selected_geo_data){

    $("select#distributor_id").empty();
    $("select#distributor_id").selectpicker('refresh');

    var checked_type = 'distributor';
    var login_customer_type = $("input#login_customer_type" ).val();
    var login_user_countryid = $("input#login_customer_countryid").val();

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_user_by_geo_data",
        data: {selected_geo_id:selected_geo_data, country_id : login_user_countryid, checked_data:checked_type},
        dataType : 'json',
        success: function(resp){

            $("select#distributor_id").empty();
            $("select#distributor_id").append('<option value="">Select Distributor Name</option>');
            $.each(resp, function(key, value) {
                $('select#distributor_id').append('<option value="' + value.id + '" >' +value.display_name+ '</option>');
            });

            $("select#distributor_id").selectpicker('refresh');
        }
    });

}
