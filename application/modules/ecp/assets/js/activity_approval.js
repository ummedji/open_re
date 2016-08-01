$(document).ready(function(){
    $('#month').datepicker({
        format: "yyyy-mm",
        autoclose: true
    })
});

/*
$('#month').on('change',function(){
    alert('in');
    var months = $(this).val();

    $.ajax({
        type: 'POST',
        url: site_url+'ecp/activity_planning_edit_view',
        data: {id:id},
        success: function(resp){
            $('#middle_container_product').html(resp);
            $('.selectpicker').selectpicker('refresh');
        }
    });
    return false;
});
*/


$(document).on('change', 'select#approval_status', function () {
   var status_id = $('option:selected', this).val();
   var planning_id = $('option:selected', this).attr('attr-id');

    $.ajax({
        type: 'POST',
        url: site_url+"ecp/change_status_activity",
        data: {status_id:status_id,planning_id:planning_id},
        dataType : 'json',
        success: function(resp){

            var message = "";
            if(resp != 0){
                message += 'Data Update successfully.';
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
                        location.reload();
                    }
                });
        }
    });

});

$(document).on('click', '.edit_i', function () {
    var id = $(this).attr('prdid');
   // alert(id) ;
    $.ajax({
        type: 'POST',
        url: site_url+'ecp/activity_planning_edit_view',
        data: {id:id},
        success: function(resp){
            $('#middle_container_product').html(resp);
            $('.selectpicker').selectpicker('refresh');
        }
    });
    return false;
});


$(document).ready(function(){
    var activity_approval_validators = $("#activity_planning").validate({
        ignore: ".ignore",
        rules: {
            planning_date:{
                required: true
            },
            planning_time:{
                required: true
            },
            crop_id:{
                required: true
            },
            product_sku_id:{
                required: true
            },
            diseases_id:{
                required: true
            }
            /*,
            farmer_id:
            {
                required: true
            },
            farmer_no:
            {
                required: true
            },
            retailer_id:
            {
                required: true
            },
            retailer_no:
            {
                required: true
            }*/
        }
    });

    $(document).on('click',"#add_farmer",function() {

        $('#farmer_id').removeClass('ignore');
        $('#farmer_no').removeClass('ignore');

        var $valid = $("#update_approval").valid();
        if(!$valid) {
            activity_approval_validators.focusInvalid();
            return false;
        }
        else
        {
            alert('in');
            add_farmer();
        }
    });

    $(document).on('click',"#add_retailer",function() {

        $('#retailer_id').removeClass('ignore');
        $('#retailer_no').removeClass('ignore');

        var $valid = $("#update_approval").valid();
        if(!$valid) {
            activity_approval_validators.focusInvalid();
            return false;
        }
        else
        {
            add_retailer();
        }
    });
});

$(document).on("click","#add_retailer",function() {

    $('#retailer_id').removeClass('ignore');
    $('#retailer_no').removeClass('ignore');

    var $valid = $("#activity_planning").valid();
    if(!$valid) {
        activity_planning_validators.focusInvalid();
        return false;
    }
    else
    {
        add_retailer();
    }
});

$(document).on('click', '#approval_save', function () {

    var param = $("#update_approval").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "ecp/add_activity_planning_details",
        data: param,
        success: function (resp) {
            var message = "";
            if(resp != 0){
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
                        location.reload();
                    }
                });
        }
    });
    return false;
});
$(document).on("click","#add_product",function() {
    add_product();
});

$(document).on("click","#add_product_material",function() {
    add_product_material();
});

$(document).on("click","#add_material",function() {
    add_material();
});

$(document).on("change","select#farmer_id",function() {

    var  farmer_id = $('select#farmer_id option:selected').val();

    get_mobile_number_by_farmer_id(farmer_id);

});
$(document).on("change","select#retailer_id",function() {

    var  retailer_id = $('select#retailer_id option:selected').val();

    get_mobile_number_by_farmer_id(retailer_id);

});
function add_farmer()
{
    var farmer_id = $('#farmer_id option:selected').val();
    var farmer_name = $('#farmer_id option:selected').attr('attr-name');
    var farmer_no = $('#farmer_no').val();

    var d =  "<tr>"+
        "<td data-title='Key Farmer'>" +
        "<input class='input_remove_border' type='text' value='"+farmer_name+"' readonly/>" +
        "<input type='hidden' name='farmers[]' value='"+farmer_id+"'/>" +
        "</td>"+
        "<td data-title='Mobile No.'>" +
        "<input type='text' class='input_remove_border' name='farmer_num[]' value='"+farmer_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i farmer_detail' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "</tr>";

    $("#farmer_detail").append(d);
    $('#farmer_id').selectpicker('val', '');
    $('#farmer_no').val('');
}
function add_retailer()
{
    var retailer_id = $('#retailer_id option:selected').val();
    var retailer_name = $('#retailer_id option:selected').attr('attr-name');
    var retailer_no = $('#retailer_no').val();

    var d =  "<tr>"+
        "<td data-title='Key Retailer'>" +
        "<input class='input_remove_border' type='text' value='"+retailer_name+"' readonly/>" +
        "<input type='hidden' name='farmers[]' value='"+retailer_id+"'/>" +
        "</td>"+
        "<td data-title='Mobile No.'>" +
        "<input type='text' class='input_remove_border' name='farmer_num[]' value='"+retailer_no+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i farmer_detail' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "</tr>";

    $("#retailer_detail").append(d);
    $('#retailer_id').selectpicker('val', '');
    $('#retailer_no').val('');
}

$(document).on('click', 'div.farmer_detail', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    else{
        return false;
    }
    return false;
});
$(document).on('click', 'div.retailer_detail', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    else{
        return false;
    }
    return false;
});

function add_product()
{
    var sku_name = $('#product_sample_id option:selected').attr('attr-name');
    var sku_id = $('#product_sample_id option:selected').val();
    var qty = $('#qty').val();

    $("#product_detail").append(
        "<tr>"+
        "<td data-title='Products'>" +
        "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_samples[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Qty.'>" +
        "<input type='text' class='input_remove_border allownumericwithdecimal' name='product_samples_qty[]' value='"+qty+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i product_detail' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "</tr>"
    );
    $('#product_sample_id').selectpicker('val', '');
    $('#qty').val('');

}

$(document).on('click', 'div.product_detail', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    else{
        return false;
    }
    return false;
});

function add_product_material()
{
    var sku_name = $('#product_material_id option:selected').attr('attr-name');
    var sku_id = $('#product_material_id option:selected').val();
    var qty = $('#qty_material').val();

    $("#product_material_detail").append(
        "<tr>"+
        "<td data-title='Products'>" +
        "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
        "<input type='hidden' name='product_materials[]' value='"+sku_id+"'/>" +
        "</td>"+
        "<td data-title='Qty.'>" +
        "<input type='text' class='input_remove_border allownumericwithdecimal' name='product_materials_qty[]' value='"+qty+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i product_material_detail' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "</tr>"
    );
    $('#product_material_id').selectpicker('val', '');
    $('#qty_material').val('');
}

$(document).on('click', 'div.product_material_detail', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    else{
        return false;
    }
    return false;
});

function add_material()
{
    var material_name = $('#material_id option:selected').attr('attr-name');
    var material_id = $('#material_id option:selected').val();
    var qty = $('#m_qty').val();

    $("#material_detail").append(
        "<tr>"+
        "<td data-title='Materials'>" +
        "<input class='input_remove_border' type='text' value='"+material_name+"' readonly/>" +
        "<input type='hidden' name='materials[]' value='"+material_id+"'/>" +
        "</td>"+
        "<td data-title='Qty.'>" +
        "<input type='text' class='input_remove_border' name='materials_qty[]' value='"+qty+"' readonly/>" +
        "</td>"+
        "<td  data-title='Action' class='numeric'>" +
        "<div class='delete_i material_detail' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
        "</td>"+
        "</tr>"
    );
    $('#material_id').selectpicker('val', '');
    $('#m_qty').val('');
}

$(document).on('click', 'div.material_detail', function () {
    if (confirm("Are you sure?")) {
        $(this).closest('tr').remove();
    }
    else{
        return false;
    }
    return false;
});
function get_mobile_number_by_farmer_id(farmer_id)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/get_mobile_number_by_farmer",
        data: {farmer_id:farmer_id},
        dataType : 'json',
        success: function(resp){
            alert('in');
            $("input#farmer_no").val(resp.primary_mobile_no);
        }
    });
}


