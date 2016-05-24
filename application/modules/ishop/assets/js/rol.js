/**
 * Created by webclues on 5/19/2016.
 */


$(document).ready(function(){
    $(".retailer_radio").hide();
    $("input.sel_customer_type").on("click",function(){

        var cust_type_selected = $(this).val();

        if(cust_type_selected == "retailer"){

            $(".distributor_radio").hide();
            $(".retailer_radio").show();

          /*  $("select#distributor_id").empty();
            $("select#distributor_id").selectpicker('refresh');*/
        }
        else if(cust_type_selected == "distributor"){
           $("div.distributor_data").css("display","none");

            $(".distributor_radio").show();
            $(".retailer_radio").hide();
        }

    });

});




$("#pro_id").change(function()
{
    var pro_id = $("#pro_id").val();
    var data = {pro_id: pro_id};
    $.ajax({
        url: site_url + 'ishop/get_distributor_by_provience',
        data:data,
        type:'POST',
        datatype:'json',
        success:function(str)
        {
            $('#distr_id').empty();
            $('#distr_id').append('<option value="0">Select Distributor Name</option>');
            $.each(JSON.parse(str), function(key, value) {
                $('#distr_id').append('<option value="' + value.id + '" attr-dstcode ="'+value.user_code+'" attr-dstname = "'+value.display_name+'">' + value.display_name + '</option>');
            });
            $("#distr_id").selectpicker('refresh');
        }
    });
});


function add_rol_row()
{
    var distr_name =  $('#distr_id option:selected').attr('attr-dstname');
    var distr_code =  $('#distr_id option:selected').attr('attr-dstcode');
    var distr_id =  $('#distr_id option:selected').val();
    var sku_name = $('#prod_sku option:selected').attr('attr-name');
    var sku_id = $('#prod_sku option:selected').val();
    var pbg = $('#prod_sku option:selected').attr('attr-pbg');
    var unit = $('#unit_id option:selected').val();
    var rol_qty = $('#rol_qty').val();
    var rol_kgl = $('#rol_qty').val();
    var sr_no =$("#rol_list > tr").length + 1;


    var unit_data = "";

    $.ajax({
        type: 'POST',
        url: site_url+"ishop/get_quantity_conversion_data",
        data: {skuid:sku_id, quantity_data:rol_qty, unit : unit},
        //dataType : 'json',
        success: function(resp){
            unit_data = resp;
        },
        async:false
    });

    $("#rol_list").append(
        "<tr>"+
        "<td data-title='Sr. No.' class='numeric'>" +
        "<input type='text' value='"+sr_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
      /*  "<div class='edit_i'><a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>" +*/
        "<div class='delete_i rol_del' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "<td data-title='Distributor Code'>" +
        "<input type='text' value='"+distr_code+"' readonly/>" +
        "</td>"+
        "<td data-title='Distributor Name'>" +
        "<input type='text' value='"+distr_name+"' readonly/>" +
        "</td>"+
        "<td data-title='PBG'>" +
        "<input type='text' value='"+ pbg +"' readonly/>" +
        "</td>"+
        "<td data-title='Product SKU Name'>" +
        "<input type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Units'>" +
        "<input type='text' name='units[]' value='"+unit+"'readonly/>" +
        "</td>"+
        "<td data-title='ROL Quantity'>" +
        "<input type='text' name='rol_qty[]' value='"+rol_qty+"'readonly/>" +
        "</td>"+
        "<td data-title='ROL Qty Kg/Ltr'>" +
        "<input type='text' name='rol_qty_kgl[]' value='"+unit_data+"' readonly/>" +
        "</td>"+
        "</tr>"
    );

    $('#prod_sku').selectpicker('val', '0');
    $('#unit_id').selectpicker('val', '0');
    $('#rol_qty').val('');
}

$(document).on('click', 'div.rol_del', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    return false;
});

$("#rol_limit").on("submit",function(){

    var param = $("#rol_limit").serializeArray();

   $.ajax({
        type: 'POST',
        url: site_url+"ishop/add_rol_details",
        data: param,
        //dataType : 'json',
        success: function(resp){
        }
    });
   // return false;
});