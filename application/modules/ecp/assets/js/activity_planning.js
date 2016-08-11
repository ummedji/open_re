$(document).ready(function() {
    $('#planning_date').datepicker({
        format: date_format,
        autoclose: true
    }).on('changeDate',function(e){
        dateChangeEvent(e);
    });

    $('#planning_time').timepicker({

    });

    $("select#activity_type_id").on("change",function() {
        activityTypeChange();
    });

    /*Validation Rule*/

    var activity_planning_validators = $("#activity_planning").validate({
        ignore: ".ignore",
        rules: {
            planning_date:{
                required: true
            },
            planning_time:{
                required: true
            },
            activity_type_id:{
                required: true
            },
            geo_level_2:{
                required: true
            },
            geo_level_3:{
                required: true
            },
            geo_level_4:{
                required: true
            },
            activity_address:{
                required: true
            },
            crop:{
                required: true
            },
            product_sku:{
                required: true
            },
            diseases:{
                required: true
            }
        }
    });

    /*Validation Rule*/



    $(document).on("click","#add_farmer",function() {
        add_farmer();
    });

    $(document).on("click","#add_retailer",function() {
        add_retailer();
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


    $(document).on('click', '#check_save', function () {
        var param = $("#activity_planning").serializeArray();
        // console.log(param);
        var $valid = $("#activity_planning").valid();
        if(!$valid) {
            activity_planning_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url + "ecp/add_activity_planning_details",
                data: param,
                success: function (resp) {
                    var message = "";
                    if(resp != 0){
                        console.log(resp);
                        $('#activity_planning_id').val(resp);
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

                            }
                        });
                }
            });
        }
        return false;
    });

    $(document).on('click', '#check_save_as_new', function () {

        var param = $("#activity_planning").serializeArray();
        // console.log(param);
        var $valid = $("#activity_planning").valid();
        if(!$valid) {
            activity_planning_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url + "ecp/add_activity_planning_details",
                data: param,
                success: function (resp) {
                    var message = "";
                    if(resp != 0){
                        console.log(resp);
                        $('#activity_planning_id').val(resp);
                        message += 'Data Save As New successfully.';
                    }
                    else{

                        message += 'Data not Save As New .';
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

                            }
                        });
                }
            });
        }
        return false;
    });
    $(document).on('click','#add_new',function(e)
    {
        location.reload();
    });

    $(document).on('click', '#check_submit', function (e) {

        e.preventDefault(e);
        var activity_planning_id = $("#activity_planning_id").val();

        $.ajax({
            type: 'POST',
            url: site_url + "ecp/submit_activity_planning_details",
            data: {activity_planning_id:activity_planning_id},
            success: function (resp) {
                var message = "";
                if(resp == 1){

                    message += 'Data Submitted successfully.';
                }
                else{

                    message += 'Data not Submitted.';
                }
                $('<div></div>').appendTo('body')
                    .html('<div><b>'+message+'</b></div>')
                    .dialog({
                        appendTo: "#success_file_popup",
                        modal: true,
                        zIndex: 10000,
                        autoOpen: true,
                        width: 'auto',
                        resizable: false,
                        close: function (event, ui) {
                            $(this).remove();
                            location.reload();
                        }
                    });
            }
        });


        return false;
    });

    $(document).on('click', '#check_cancel', function (e) {

        $('<div></div>').appendTo('body')
            .html('<div>Are You Sure Cancel Form ?</div>')
            .dialog({
                appendTo: "#success_file_popup",
                modal: true,
                title: 'Are You Sure Cancel Form ?',
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: false,
                buttons: {
                    OK: function () {
                        $(this).dialog("close");
                        location.reload();
                    },
                    Cancel: function () {
                        $(this).dialog("close");

                    }
                },
                close: function (event, ui) {
                    $(this).remove();
                }
            });
        return false;
    });

    $(document).on('click', '#check_update', function () {
        var param = $("#activity_planning").serializeArray();
        var $valid = true;
        if(!$valid) {
            activity_planning_validators.focusInvalid();
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url + "ecp/add_activity_planning_details",
                data: param,
                success: function (resp) {
                    var message = "";
                    if(resp != 0){
                        console.log(resp);
                        $('#activity_planning_id').val(resp);
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

                            }
                        });
                }
            });
        }
        return false;
    });
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
    alert('in');
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




$(document).on("change","select#geo_level_2",function() {
    geolevel_2_Change();
});

$(document).on("change","select#geo_level_3",function() {
    geolevel_3_Change();
});

function retailerDetails()
{
    get_retailerData();
    var retailer_detail = '';
    retailer_detail +='<div class="default_box_white">'+
        '<div class="col-md-12 plng_title"><h5>Key Retailer Details</h5></div>'+
        '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
        '<div class="row">'+
        '<div class="col-md-6">'+
        '<div class="form-group frm_details text-center" style="margin-bottom: 0px;">'+
        '<label>Key Retailer</label>'+
        '<select class="selectpicker" name="retailer_id" id="retailer_id" data-live-search="true">'+
        '<option value="">Select Retailer</option>'+
        '</select>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-6 corp_text mrg_top_30">'+
        '<div class="form-group frm_details text-center">'+
        '<label>Mobile No.</label>'+
        '<input type="text" class="form-control" name="retailer_no" id="retailer_no" placeholder="">'+
        ' <div class="plus_btn" ><a  href="javascript: void(0);" id="add_retailer"><i class="fa fa-plus" aria-hidden="true"></i></a></div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-8 col-md-offset-2">'+
        '<div id="no-more-tables">'+
        '<table class="col-md-12 table-bordered table-striped table-condensed cf">'+
        '<thead class="cf">'+
        '<tr>'+
        '<th style="padding: 4px 0;">'+
        'Key Retailer'+
        '<span class="rts_bordet"></span>'+
        '</th>'+
        '<th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>'+
        '<th style="padding: 4px 0;">Action</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody id="retailer_detail" class="tbl_body_row">'+
        '</tbody>'+
        '</table>'+
        '<div class="clearfix"></div>'+
        '</div>'+
        '</div>'+
        '<div class="clearfix"></div>'+
        '</div>';
    $(".customer_details").html(retailer_detail);
}

function farmerDetails()
{
    get_farmerData();
    var farmer_detail = '';
    farmer_detail +='<div class="default_box_white">'+
            '<div class="col-md-12 plng_title"><h5>Key Farmer Details</h5></div>'+
            '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
            '<div class="row">'+
            '<div class="col-md-6">'+
            '<div class="form-group frm_details text-center" style="margin-bottom: 0px;">'+
            '<label>Key Farmer</label>'+
            '<select class="selectpicker" name="farmer_id" id="farmer_id" data-live-search="true">'+
            '<option value="">Select Farmer</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 corp_text mrg_top_30">'+
            '<div class="form-group frm_details text-center">'+
            '<label>Mobile No.</label>'+
            '<input type="text" class="form-control" name="farmer_no" id="farmer_no" placeholder="">'+
            ' <div class="plus_btn" ><a  href="javascript: void(0);" id="add_farmer"><i class="fa fa-plus" aria-hidden="true"></i></a></div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-8 col-md-offset-2">'+
            '<div id="no-more-tables">'+
            '<table class="col-md-12 table-bordered table-striped table-condensed cf">'+
            '<thead class="cf">'+
            '<tr>'+
            '<th style="padding: 4px 0;">'+
            'Key Farmer'+
            '<span class="rts_bordet"></span>'+
            '</th>'+
            '<th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>'+
            '<th style="padding: 4px 0;">Action</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody id="farmer_detail" class="tbl_body_row">'+
            '</tbody>'+
            '</table>'+
            '<div class="clearfix"></div>'+
            '</div>'+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>';
    $(".customer_details").html(farmer_detail);
}

function set_activity_type(activity_type_selected){

     if(activity_type_selected == 'FMP001')
    {
        get_geo_fo_userdata(activity_type_selected);

        var geo_1 = '';
        geo_1 +='<div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">'+
            '<select class="selectpicker" id="geo_level_2" name="geo_level_2" data-live-search="true">'+
            '<option value="">Select Geo 2</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_3" name="geo_level_3" data-live-search="true">'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_4" name="geo_level_4" data-live-search="true">'+
            '</select>'+
            '</div>';

        $("#geo").html(geo_1);

        farmerDetails();

        var att_count ='';

        att_count +='<div class="default_box_grey">'+
                    '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
                    '<div class="form-group" style="margin-bottom: 0;">'+
                    '<label>Enter Praposed Attandances Count</label>&nbsp;'+
                    '<input type="text" class="form-control" name="attandence_count" id ="attandence_count" placeholder="" style="width: 80px;">'+
                    '</div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                    '</div>';
        $("#att_count").html(att_count);
        $("#demo_data").empty();
        $("#demo_details").empty();
    }

    else if(activity_type_selected == 'FVP002')
    {
        get_geo_fo_userdata(activity_type_selected);

        farmerDetails();
        var geo_2 = '';
        geo_2 +='<div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">'+
            '<select class="selectpicker" id="geo_level_2" name="geo_level_2" data-live-search="true">'+
            '<option value="">Select Geo 2</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_3" name="geo_level_3" data-live-search="true">'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_4" name="geo_level_4" data-live-search="true">'+
            '</select>'+
            '</div>';

        $("#geo").html(geo_2);
        $("#att_count").empty();
        $("#demo_data").empty();
        $("#demo_details").empty();

    }

    else if(activity_type_selected == 'RMP003')
    {
        get_geo_fo_userdata(activity_type_selected);
        retailerDetails();
        var geo_3 = '';
        geo_3 +='<div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">'+
            '<select class="selectpicker" id="geo_level_2" name="geo_level_2" data-live-search="true">'+
            '<option value="">Select Geo 2</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_3" name="geo_level_3" data-live-search="true">'+
            '</select>'+
            '</div>';

        $("#geo").html(geo_3);
        $("select#geo_level_3").selectpicker('refresh');

        var att_count2 ='';

        att_count2 +='<div class="default_box_grey">'+
            '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
            '<div class="form-group" style="margin-bottom: 0;">'+
            '<label>Enter Praposed Attandances Count</label>&nbsp;'+
            '<input type="text" class="form-control" name="attandence_count" id ="attandence_count" placeholder="" style="width: 80px;">'+
            '</div>'+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>';
        $("#att_count").html(att_count2);
        $("#demo_data").empty();
        $("#demo_details").empty();

    }

    else if(activity_type_selected == 'RVP004')
    {
        get_geo_fo_userdata(activity_type_selected);
        retailerDetails();
        var geo_4 = '';
        geo_4 +='<div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2</label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">'+
            '<select class="selectpicker" id="geo_level_2" name="geo_level_2" data-live-search="true">'+
            '<option value="">Select Geo 2<span style="color: red">*</span></option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_3" name="geo_level_3" data-live-search="true">'+
            '</select>'+
            '</div>';

        $("#geo").html(geo_4);
        $("select#geo_level_3").selectpicker('refresh');

        $("#att_count").empty();
        $("#demo_data").empty();
        $("#demo_details").empty();
    }

    else if(activity_type_selected == 'DP005')
    {
        get_geo_fo_userdata(activity_type_selected);
        farmerDetails();
        var geo_5 = '';
        geo_5 +='<div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">'+
            '<select class="selectpicker" id="geo_level_2" name="geo_level_2" data-live-search="true">'+
            '<option value="">Select Geo 2</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_3" name="geo_level_3" data-live-search="true">'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_4" name="geo_level_4" data-live-search="true">'+
            '</select>'+
            '</div>';

        $("#geo").html(geo_5);

        var att_count3 ='';

        att_count3 +='<div class="default_box_grey">'+
            '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
            '<div class="form-group" style="margin-bottom: 0;">'+
            '<label>Enter Praposed Attandances Count</label>&nbsp;'+
            '<input type="text" class="form-control" name="attandence_count" id ="attandence_count" placeholder="" style="width: 80px;">'+
            '</div>'+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>';
        $("#att_count").html(att_count3);

        $("#demo_data").empty();


        var demo_detail='';

        demo_detail +='<div class="default_box_white">'+
                          '<div class="col-md-12 plng_title"><h5>Demonstration</h5></div>'+
                              '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
                                  '<div class="row">'+
                                      '<div class="col-md-6">'+
                                          '<div class="form-group frm_details text-center" style="margin-bottom: 0px;">'+
                                          '<label>Size Of Plot</label>'+
                                          '<input type="text" class="form-control" name="size_of_plot" id="size_of_plot" placeholder="">'+
                                          '</div>'+
                                      '</div>'+
                                      '<div class="col-md-6 corp_text mrg_top_30">'+
                                          '<div class="form-group frm_details text-center">'+
                                          '<label>Spray Volume</label>'+
                                          '<input type="text" class="form-control" name="spray_volume" id="spray_volume" placeholder="">'+
                                          '</div>'+
                                      '</div>'+
                                  '</div>'+
                              '</div>'+
                          '<div class="clearfix"></div>'+
                      '</div>';

        $("#demo_details").html(demo_detail);

    }

    else if(activity_type_selected == 'FDP006')
    {
        get_geo_fo_userdata(activity_type_selected);
        farmerDetails();
        getDemonstrationById();

        var geo_6 = '';
        geo_6 +='<div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">'+
            '<select class="selectpicker" id="geo_level_2" name="geo_level_2" data-live-search="true">'+
            '<option value="">Select Geo 2</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_3" name="geo_level_3" data-live-search="true">'+
            '</select>'+
            '</div>'+
            '<div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label></div>'+
            '<div class="col-md-2 col-sm-8 cont_size_select">'+
            '<select class="selectpicker" id="geo_level_4" name="geo_level_4" data-live-search="true">'+
            '</select>'+
            '</div>';

        $("#geo").html(geo_6);

        var att_count4 ='';

        att_count4 +='<div class="default_box_grey">'+
            '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
            '<div class="form-group" style="margin-bottom: 0;">'+
            '<label>Enter Praposed Attandances Count</label>&nbsp;'+
            '<input type="text" class="form-control" name="attandence_count" id ="attandence_count" placeholder="" style="width: 80px;">'+
            '</div>'+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>';
        $("#att_count").html(att_count4);

        var demo_data ='';

        demo_data += '<div class="col-md-2 col-sm-3 first_lb"><label>Demonstration</label></div>'+
                     '<div class="col-md-2 col-sm-8 cont_size_select">'+
                     '<select class="selectpicker" name="demo_id" id="demo_id" data-live-search="true">'+
                     '<option value="">Select Demonstration</option>'+
                     '</select>'+
                     '</div>';

        $("#demo_data").html(demo_data);
        $("select#demo_id").selectpicker('refresh');


        var demo_detail1='';

        demo_detail1 +='<div class="default_box_white">'+
            '<div class="col-md-12 plng_title"><h5>Demonstration</h5></div>'+
            '<div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">'+
            '<div class="row">'+
            '<div class="col-md-6">'+
            '<div class="form-group frm_details text-center" style="margin-bottom: 0px;">'+
            '<label>Size Of Plot</label>'+
            '<input type="text" class="form-control" name="size_of_plot" id="size_of_plot" placeholder="">'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 corp_text mrg_top_30">'+
            '<div class="form-group frm_details text-center">'+
            '<label>Spray Volume</label>'+
            '<input type="text" class="form-control" name="spray_volume" id="spray_volume" placeholder="">'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="clearfix"></div>'+
            '</div>';

        $("#demo_details").html(demo_detail1);
    }

}

function get_retailerData()
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/KeyRetailer_by_user_id",
        data: {},
        dataType : 'json',
        success: function(resp){

            $("select#retailer_id").empty();
            $("select#retailer_id").selectpicker('refresh');

            if(resp.length > 0){
                $("select#retailer_id").append('<option value="">Select Retailer</option>');
                $.each(resp, function(key, value) {
                    $('select#retailer_id').append('<option value ="' + value.id + '" attr-name = "'+value.display_name+'">' +value.display_name+ '</option>');
                });
                $("select#retailer_id").selectpicker('refresh');
            }
        }
    });
}

function get_farmerData()
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/KeyFarmer_by_user_id",
        data: {},
        dataType : 'json',
        success: function(resp){

            $("select#farmer_id").empty();
            $("select#farmer_id").selectpicker('refresh');

            if(resp.length > 0){
                $("select#farmer_id").append('<option value="">Select Farmer</option>');
                $.each(resp, function(key, value) {
                    $('select#farmer_id').append('<option value ="' + value.id + '" attr-name = "'+value.display_name+'">' +value.display_name+ '</option>');
                });
                $("select#farmer_id").selectpicker('refresh');
            }
        }
    });
}

function get_geo_fo_userdata(activity_type_selected){
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/get_geo_activity",
        data: {activity_type_selected:activity_type_selected},
        dataType : 'json',
        success: function(resp){
            if(activity_type_selected == "RMP003" || activity_type_selected == "RVP004"){

                $("select#geo_level_2").empty();
                $("select#geo_level_2").selectpicker('refresh');

                if(resp.length > 0){
                    $("select#geo_level_2").append('<option value="">Select Geo 2</option>');
                    $.each(resp, function(key, value) {
                        $('select#geo_level_2').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });
                    $("select#geo_level_2").selectpicker('refresh');
                }

            }
            else{

                $("select#geo_level_2").empty();
                $("select#geo_level_2").selectpicker('refresh');


                if(resp.length > 0){

                    $("select#geo_level_2").append('<option value="">Select Geo 2</option>');

                    $.each(resp, function(key, value) {
                        $('select#geo_level_2').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("select#geo_level_2").selectpicker('refresh');

                    $("select#geo_level_3").append('<option value="">Select Geo 3</option>');
                    $("select#geo_level_3").selectpicker('refresh');
                    $("select#geo_level_4").append('<option value="">Select Geo 4</option>');
                    $("select#geo_level_4").selectpicker('refresh');
                }
            }

        }
    });
}

function get_child_by_perent_id(activity_type_selected,perent_id,second_perent)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/get_geo_activity",
        data: {activity_type_selected:activity_type_selected,perent_id:perent_id,second_perent:second_perent},
        dataType : 'json',
        success: function(resp){
            if(activity_type_selected == "RMP003" || activity_type_selected == "RVP004"){

                $("select#geo_level_3").empty();
                $("select#geo_level_3").selectpicker('refresh');


                if(resp.length > 0){

                    $("select#geo_level_3").append('<option value="">Select Geo 3</option>');

                    $.each(resp, function(key, value) {
                        $('select#geo_level_3').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("select#geo_level_3").selectpicker('refresh');
                }

            }
            else{

                $("select#geo_level_3").empty();
                $("select#geo_level_3").selectpicker('refresh');


                if(resp.length > 0){

                    $("select#geo_level_3").append('<option value="">Select Geo 3</option>');

                    $.each(resp, function(key, value) {
                        $('select#geo_level_3').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                    });

                    $("select#geo_level_3").selectpicker('refresh');

                    $("select#geo_level_4").append('<option value="">Select Geo 4</option>');
                    $("select#geo_level_4").selectpicker('refresh');

                }

            }

        }
    });
}

function get_child_by_parent_parent_id(activity_type_selected,perent_id)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/get_geo_activity",
        data: {activity_type_selected:activity_type_selected,perent_id:perent_id},
        dataType : 'json',
        success: function(resp){

            $("select#geo_level_4").empty();
            $("select#geo_level_4").selectpicker('refresh');


            if(resp.length > 0){

                $("select#geo_level_4").append('<option value="">Select Geo 4</option>');

                $.each(resp, function(key, value) {
                    $('select#geo_level_4').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                });

                $("select#geo_level_4").selectpicker('refresh');

            }
        }
    });
}

/*function get_demonstration_data()
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/get_demonstration_data",
        data: {},
        dataType : 'json',
        success: function(resp){

            $("select#demo_id").empty();
            $("select#demo_id").selectpicker('refresh');

            if(resp.length > 0){

                $("select#demo_id").append('<option value="">Select Demonstration</option>');

                $.each(resp, function(key, value) {
                    $('select#demo_id').append('<option value="' + value.political_geo_id + '" >' +value.political_geography_name+ '</option>');
                });

                $("select#demo_id").selectpicker('refresh');

            }
        }
    });
}*/

$(document).on("change","select#farmer_id",function() {

    var  farmer_id = $('select#farmer_id option:selected').val();

    get_mobile_number_by_farmer_id(farmer_id);

});

$(document).on("change","select#retailer_id",function() {

    var  retailer_id = $('select#retailer_id option:selected').val();

    get_mobile_number_by_farmer_id(retailer_id);

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

function getDigitalLibrary(activity_type_id)
{
    $.ajax({
        type: 'POST',
        url: site_url+"ecp/getDigitalLibraryData",
        data: {activity_type_id:activity_type_id},
        dataType : 'json',
        success: function(resp){

            $("select#digital_id").empty();
            $("select#digital_id").selectpicker('refresh');

            if(resp.length > 0){

              //  $("select#digital_id").append('<option value="">Select Digital Library</option>');

                $.each(resp, function(key, value) {
                    $('select#digital_id').append('<option value="' + value.digital_library_id + '" attr-link="'+ value.link +'">' +value.library_name+ '</option>');
                });

                $("select#digital_id").selectpicker('refresh');

            }
        }
    });
}


/*as js*/
$(document).ready(function() {
    $(".js-example-tags").select2({
        tags: true
    }).on('change', function() {
        var $selected = $(this).find('option:selected');
        var $container = $(this).siblings('.js-example-tags-container');

        var $list = $('<ul>');
        $selected.each(function(k, v) {
            var $li = $('<li class="tag-selected"><a class="destroy-tag-selected">�</a>' + $(v).text() + '</li>');
            $li.children('a.destroy-tag-selected')
                .off('click.select2-copy')
                .on('click.select2-copy', function(e) {
                    var $opt = $(this).data('select2-opt');
                    $opt.attr('selected', false);
                    $opt.parents('select').trigger('change');
                }).data('select2-opt', $(v));
            $list.append($li);
        });
        $container.html('').append($list);
    }).trigger('change');
});

function getActivityCalenderData(iMonth)
{
    $.ajax({
        type: 'POST',
        //url: site_url + "ecp/getActivityDetailByMonth",
        url: site_url + "ecp/getActivitySidebar",
        data: {cur_month:iMonth},
        success: function (resp) {
            $('#activity_sidebar').html(resp);
        }
    });

}

function getActivityPlanData(iMonth)
{
    $.ajax({
        type: 'POST',
        url: site_url + "ecp/getActivityDetailPlanByMonth",
        data: {cur_month:iMonth},
        success: function (resp) {
            $('#').html(resp);
        }
    });

}

function dateChangeEvent(eDate)
{
    var eventDate = new Date(eDate.date);
    //var planning_date = $('#planning_date').val();
    var planning_date = eventDate.getFullYear()+'-'+("0"+(eventDate.getMonth()+1)).slice(-2)+'-'+("0"+eventDate.getDate()).slice(-2);

        $.ajax({
        type: 'POST',
        url: site_url + "ecp/check_planning_date_in_leave",
        data: {planning_date:planning_date},
        //dataType : 'json',
        success: function (resp) {

            if(resp == 1){
                var message='';

                message += 'You are Leave On this Date.';

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
                      $('#planning_date').val('');
                    }
                });
                return false;
            }
        }
    });

}

$(document).on('click','.activity_date',function(e)
{
    var elem = $(e.target).text();
    if($("#data_"+elem).length != 0)
    {
        var slide_to = ($("#data_"+elem).offset().top - $("#main").offset().top)-10;
        $('#main').animate({
            scrollTop: slide_to
        }, 1000);
    }
});

function activityTypeChange()
{
    var selElem = $('select#activity_type_id option:selected');
    var activity_type_selected = selElem.attr('code');
    set_activity_type(activity_type_selected);
    var activity_type_id = selElem.val();
    getDigitalLibrary(activity_type_id);
    $("#activity_address").val('');
   // $("#activity_address").removeAttr("readonly","readonly");
    $("#size_of_plot").val('');
    $("#spray_volume").val('');
}

function geolevel_2_Change()
{
    var  activity_type_selected= $('select#activity_type_id option:selected').val();
    var  perent_id= $('select#geo_level_2 option:selected').val();
    var  second_perent= 'second_perent';

    get_child_by_perent_id(activity_type_selected,perent_id,second_perent);
}

function geolevel_3_Change()
{
    var  activity_type_selected= $('select#activity_type_id option:selected').val();
    var  perent_id= $('select#geo_level_3 option:selected').val();
    get_child_by_parent_parent_id(activity_type_selected,perent_id);
}


$(document).on('click','ul.activity_list li',function(e){
    var elem = $(e.target);
    var d_attr = elem.attr('data-attr');

    if(d_attr=='all'){
        $('.act_date').removeClass('act_dsb');
    } else {
        $('.act_date').addClass('act_dsb');

        $('.act_date').each(function(i,j){
            if($(j).hasClass('act_'+d_attr)==true){
                $(j).removeClass('act_dsb');
            }
        });
    }
});


function getActivityById(activity_planning_id)
{
    $.ajax({
        type: 'POST',
        url: site_url + "ecp/activity_planning_view_edit",
        data: {id:activity_planning_id},
        //dataType : 'json',
        success: function (resp) {
            $("#activity_main").html(resp);
            $("select.selectpicker").selectpicker('refresh');
        },
        complete:function(){
            //activityTypeChange();
            //geolevel_2_Change();
            //geolevel_3_Change();
        }
    });
}

function getDemonstrationById(){

    $.ajax({
        type: 'POST',
        url: site_url+"ecp/getDemonstrationById",
        dataType : 'json',
        success: function(resp){

            $("select#demo_id").empty();
            $("select#demo_id").selectpicker('refresh');

            var html1 = "";

            if(resp.length > 0){

                  html1 +='<option value="">Select Demonstration</option>';

                $.each(resp, function(key, value) {
                    var d = formatAMPM(value.execution_time);
                    html1 += '<option value="' +value.activity_planning_id+ '">' + value.political_geography_name+ '::' + value.execution_date+' '+d+ '</option>';

                });

                $("select#demo_id").html(html1);
                $("select#demo_id").selectpicker('refresh');

            }
        }
    });
}


function formatAMPM(date_data) {

    var date = new Date(date_data);

    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

$(document).on('change','select#demo_id',function(){
    var selected_id = $(this).val();

    $.ajax({
        type: 'POST',
        url: site_url+"ecp/getDetailsByPlanningId",
        data: {id:selected_id},
        dataType : 'json',
        success: function(resp){

            if(resp == 0){
              //  alert('innn');
            //    $("select#geo_level_2").removeAttr("disabled","disabled");
                $('select#geo_level_2').selectpicker('refresh');

                geolevel_2_Change();

                setTimeout(function(){

                    $("select#geo_level_3").val(resp.geo_level_id_3);
                   // $("select#geo_level_3").removeAttr("disabled","disabled");

                    $('select#geo_level_3').selectpicker('refresh');

                }, 500);

                $("select#geo_level_4").empty();
              //  $("select#geo_level_4").removeAttr("disabled","disabled");
                $('select#geo_level_4').selectpicker('refresh');

                $("#activity_address").removeAttr("readonly","readonly");
            }
            else{

                $("select#geo_level_2").val(resp.geo_level_id_2);
              //  $("select#geo_level_2").attr("disabled","disabled");

                $('select#geo_level_2').selectpicker('refresh');

                geolevel_2_Change();

                setTimeout(function(){

                    $("select#geo_level_3").val(resp.geo_level_id_3);
                   // $("select#geo_level_3").attr("disabled","disabled");

                    $('select#geo_level_3').selectpicker('refresh');

                    geolevel_3_Change();

                }, 500);

                setTimeout(function(){

                    $("select#geo_level_4").val(resp.geo_level_id_4);
                 //   $("select#geo_level_4").attr("disabled","disabled");

                    $('select#geo_level_4').selectpicker('refresh');

                }, 1000);

                $("#activity_address").val(resp.location);
                $("#size_of_plot").val(resp.size_of_plot);
                $("#spray_volume").val(resp.spray_volume);
              //  $("#activity_address").attr("readonly","readonly");
            }
        }
    });

});

