<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Order Place</h5>
    <div class="back_details">

        <?php
        $customer_id = (isset($customer_id) && !empty($customer_id))? $customer_id : "";
        ?>

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_order_place','name'=>'dialpad_order_place', 'autocomplete'=>'off');
        echo form_open('cco/add_order_place',$attributes);
        ?>

        <div class="row">
            <div class="col-md-12 text-center" id="order_place_data">
                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />
                    <div class="rotate_data" style="display: inline-block;">
                        <div class="row">
                            <div class="col-md-2_ tp_form" style="float: none;">
                                <div class="form-group">

                                    <?php

                                        $action_data = $this->session->userdata("action_data");
                                        $selected_type_data = $this->session->userdata("activity_type");

                                    $label = "";
                                        if($action_data == "farmer_dialpad")
                                        {
                                            $label = "Select Retailer";
                                        }
                                        elseif($action_data == "channel_partner_dialpad")
                                        {
                                            if($selected_type_data == 10)
                                            {
                                                $label = "Select Distributor";
                                            }
                                            elseif($selected_type_data == 9)
                                            {
                                                $label = "";
                                            }
                                        }
                                    ?>
                                    <label><?php echo $label; ?></label>
                                    <div class="inln_fld">
                                    <?php
                                        if($action_data == "farmer_dialpad")
                                        {
                                            $label = "Select Retailer";
                                    ?>
                                    <select class="lva form-control" id="retailer_data" data-live-search="true" name="retailer_data" required>
                                            <option value=""><?php echo $label; ?></option>

                                        <?php
                                        if(isset($customer_retailer_data) && !empty($customer_retailer_data))
                                        {
                                            foreach($customer_retailer_data as $k=> $retailer_data)
                                            {
                                                ?>
                                                <option value="<?php echo $retailer_data['id']; ?>" attr-name="<?php echo $retailer_data['display_name']; ?>" ><?php echo $retailer_data['display_name']; ?></option>
                                            <?php
                                            }
                                        }

                                        ?>

                                        </select>

                                       <?php
                                        }
                                        elseif($action_data == "channel_partner_dialpad")
                                        {
                                            if($selected_type_data == 10)
                                            {
                                                $label = "Select Distributor";
                                        ?>
                                                <select class="lva form-control" id="retailer_data" data-live-search="true" name="retailer_data" required>
                                                    <option value=""><?php echo $label; ?></option>

                                                    <?php
                                                    if(isset($customer_retailer_data) && !empty($customer_retailer_data))
                                                    {
                                                        foreach($customer_retailer_data as $k=> $retailer_data)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $retailer_data['id']; ?>" attr-name="<?php echo $retailer_data['display_name']; ?>" ><?php echo $retailer_data['display_name']; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                        <?php
                                            }
                                            elseif($selected_type_data == 9)
                                            {
                                                $label = "";
                                         ?>
                                        <?php
                                            }
                                        }
                                    ?>

                                        <div class="clearfix"></div>
                                        <label class="error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2_ tp_form">
                                <div class="form-group">
                                    <label>Product Sku Name</label>
                                    <div class="inln_fld">
                                        <select class="lva form-control" id="prod_sku" data-live-search="true" name="prod_sku" required>
                                            <option value="">Product Name</option>
                                            <?php
                                            if(isset($product_sku) && !empty($product_sku))
                                            {
                                                foreach($product_sku as $k=> $prd_sku)
                                                {
                                                    ?>
                                                    <option value="<?php echo $prd_sku['product_sku_country_id']; ?>" attr-name="<?php echo $prd_sku['product_sku_name']; ?>" attr-code="<?php echo $prd_sku['product_sku_code']; ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                        <div class="clearfix"></div>
                                        <label id="prod_sku-error" class="error" for="prod_sku"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2_ tp_form">
                                <div class="form-group">
                                    <label for="invoice_date">Units</label>
                                    <div class="inln_fld">
                                        <select class="lva form-control" id="units" data-live-search="true" name="units" required>
                                            <option value="">Select Unit</option>
                                            <option value="box">Box</option>
                                            <option value="packages">Packages</option>
                                            <option value="kg/ltr">Kg/Ltr</option>
                                        </select>
                                        <div class="clearfix"></div>
                                        <label id="units-error" class="error" for="units"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3_ tp_form">
                                <div class="form-group">
                                    <label for="invoice_date">Quantity</label>
                                    <div class="inln_fld">
                                        <input type="text" class="form-control allownumericwithdecimal lva" name="quantity" id="quantity" placeholder="" required>
                                        <div class="clearfix"></div>
                                        <label id="quantity-error" class="error" for="quantity"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="plus_btn plus_btn_ordplc"><a title="Add Product" href="javascript:void(0);" id="order_place_add_row"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                         </div>
                    </div>
                        <div class="clearfix"></div>
            </div>
                <div id="order_data">
                    <div class="col-md-12 ad_mr_top">
                        <div class="row">
                            <div id="no-more-tables">
                                <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                    <thead class="cf">
                                    <tr>
                                        <th class="first_th">Sr. No. <span class="rts_bordet"></span></th>
                                        <th>Product SKU Code <span class="rts_bordet"></span></th>
                                        <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                                        <th class="numeric">Units <span class="rts_bordet"></span></th>
                                        <th class="numeric">Quantity <span class="rts_bordet"></span></th>
                                        <th class="numeric">Qty <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_order_place_data">
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div class="col-md-12 text-right">
                    <div class="save_btn">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <?php form_close(); ?>
        </div>

<div class="clearfix"></div>

<script type="text/javascript">

    var order_form = $("#dialpad_order_place");
    order_form.validate();

    $("#order_place_add_row").click(function()
    {
        var form_state = false;
        try{
            $(".lva").each(function(i,j){
                $(this).attr('required',true);
            });
            form_state = order_form.valid();
        } catch (e){
            alert(e);
        }

        if(form_state==true){

            var sku_units = $('#order_place_data input[name^=sku_units]').map(function(idx, elem) {
                return $(elem).val();
            }).get();
            console.log(sku_units);
            var cur_sku_id = $('#prod_sku option:selected').val();
            var cur_unit_id = $('#units option:selected').val();
            var sku_unit = cur_sku_id+"_"+cur_unit_id;
            if(sku_units.length !== 0)
            {
                if(jQuery.inArray(sku_unit, sku_units) !== -1)
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
                    order_place_add_row();
                }
            }
            else
            {
                order_place_add_row();
            }

        }

    });



    function order_place_add_row()
    {
        var sku_code = $('#prod_sku option:selected').attr('attr-code');
        var sku_name = $('#prod_sku option:selected').attr('attr-name');
        var sku_id = $('#prod_sku option:selected').val();
        var units = $("#units option:selected").val();
        var quantity = $('#quantity').val();
        var qty = "";
        var sr_no =$("#tbody_order_place_data > tr").length + 1;

        var box_selected = "";
        var package_selected = "";
        var kg_ltr_selected = "";

        var unit_data = get_data_conversion(sku_id,quantity,units);


        if(units == 'box'){
            box_selected = "selected = 'selected'"
        }
        if(units == 'packages'){
            package_selected = "selected = 'selected'"
        }
        if(units == 'kg/ltr'){
            kg_ltr_selected = "selected = 'selected'"
        }



        $("#tbody_order_place_data").append(
            "<tr id='"+sr_no+"'>"+
            "<input type='hidden' name='sku_units[]' value='"+sku_id+"_"+units+"'>"+
            "<td data-title='Sr. No.' class='numeric'>" +
            "<input class='input_remove_border' type='text' value='"+sr_no+"' readonly/>" +
            "</td>"+

           // "<td data-title='remove'>" +
         //   "<div class='delete_i' attr-dele=''><a title='Delete Row' href='javascript:void(0);'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>" +
          //  "</td>"+

            "<td data-title='Product SKU Code' class='numeric'>" +
            "<input class='sku_"+sr_no+"' type='hidden' value='"+sku_id+"' readonly/>"+
            "<input class='input_remove_border' type='text' value='"+sku_code+"' readonly/>" +
            "</td>"+
            "<td data-title='Product SKU Name'>" +
            "<input class='input_remove_border' type='text' value='"+sku_name+"' readonly/>" +
            "<input type='hidden' name='product_sku_id[]' value='"+sku_id+"'/>" +
            "</td>"+
            "<td data-title='Units'>" +
            "<input class='input_remove_border' type='text' value='"+units+"' readonly/>" +
            "<input type='hidden' name='units[]' value='"+units+"'/>" /*+
             "<select name='units[]' class='hidden select_unitdata' id='units' >"+
             " <option  "+box_selected+" value='box'>Box</option>"+
             "  <option  "+package_selected+" value='packages'>Packages</option>"+
             "   <option  "+kg_ltr_selected+" value='kg/ltr'>Kg/Ltr</option>"+
             "  </select>"
             */
            +
            "</td>"+
            "<td data-title='Quantity'>" +
            "<input class='quantity_data allownumericwithdecimal' type='text' name='quantity[]' value='"+quantity+"' class='numeric' />" +
            "</td>"
            +
            "<td data-title='Qty'>" +
            "<input class='qty_"+sr_no+" input_remove_border' type='text' name='Qty[]' value='"+unit_data+"' class='numeric' readonly/>" +
            "</td>"+
            "</tr>"
        );
        $('#prod_sku').selectpicker('val', '');
        $('#units').selectpicker('val', '');
        $('#quantity').val('');

    }

    function get_data_conversion(sku_id,quantity,units){

        var unit_data = "";

        $.ajax({
            type: 'POST',
            url: site_url+"cco/get_quantity_conversion_data",
            data: {skuid:sku_id, quantity_data:quantity, unit : units},
            //dataType : 'json',
            success: function(resp){
                unit_data = resp;
            },
            async:false
        });

        return unit_data;

    }


    $("body").on("keyup","input.quantity_data",function(){


        var pathname = window.location.pathname;

        var action_segment = pathname.split("/");

        action_segment = action_segment[action_segment.length-1];

            var selected_row_id = $(this).parent().parent().attr("id");

            var sku_id = $("input.sku_"+$.trim(selected_row_id)).val();

            if($("select.select_unitdata").length > 0) {
                var units = $(this).parent().parent().find("select.select_unitdata").val();
            }
            else
            {
                var units = $(this).parent().parent().find("[data-title=Units]").find("input.input_remove_border").val();
            }

            var quantity = $(this).val();

            var unit_data = get_data_conversion(sku_id,quantity,units);

            $("input.qty_"+$.trim(selected_row_id)).val(unit_data);
    });



    $("#dialpad_order_place").on("submit",function(){

        $(".lva").each(function(i,j){
            $(this).removeAttr('required');
            $(this).next("label.error").remove();
        });

        var form_sub_state = false;
        form_sub_state = order_form.valid();
        if(form_sub_state == false){
            return false;
        }
        else{
            if($("#tbody_order_place_data").children().length <= 0)
            {
                var message = "";
                message += 'No data added.';
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
                            return false;
                        }
                    });
                return false;
            }
            else
            {
                $('.save_btn button').attr('disabled','disabled');
                var param = $("#dialpad_order_place").serializeArray();
                $.ajax({
                    type: 'POST',
                    url: site_url+"cco/cco_order_place_details",
                    data: param,
                    success: function(resp){
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
                                    //location.reload()
                                    var customer_id = '<?php echo $customer_id; ?>';
                                    get_order_place_data(customer_id);
                                }
                            });
                    }
                });
                return false;
            }
        }
    });


</script>