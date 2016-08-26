<div class="actv-details-form">

    <?php
    $customer_id = (isset($customer_id) && !empty($customer_id))? $customer_id : "";
    ?>

    <?php

    $caller_data = $this->session->userdata("caller_data");

    $label_data = "";
    $select_label_data = "";
    $option_data = "";
    $selected_data_label = "";

    if(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 11)
    {
        $label_data = "Retailers Details";
        $select_label_data = "Mapped Retailers";
        $option_data = "Select Retailer";
        $selected_data_label = "Retailers";
    }
    elseif(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 10)
    {
        $label_data = "Distributor Details";
        $select_label_data = "Mapped Distributors";
        $option_data = "Select Distributors";
        $selected_data_label = "Distributors";
    }
    elseif(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 9)
    {
        $label_data = "Retailers Details";
        $select_label_data = "Mapped Retailers";
        $option_data = "Select Retailer";
        $selected_data_label = "Retailers";
    }

    ?>

    <h5 style="margin: 0px 0 20px 0;"><?php echo $label_data; ?></h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_retailer_info','name'=>'dialpad_retailer_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_retailer_info',$attributes);
        ?>

        <div class="row">

            <div class="col-md-11" id="retailer_detail_data">

                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                    <div class="rotate_data">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 cco-form-fl">
                                <div class="row tp_form">
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="<?php echo $select_label_data; ?>"><?php echo $select_label_data; ?></label></div>
                                        <div class="col-md-6">

                                            <select class="form-control" placeholder="" name="retailer_data[]" multiple >
                                                <option value=""><?php echo $option_data; ?></option>

                                                <?php
                                                if(!empty($customer_retailer_data))
                                                {
                                                    foreach($customer_retailer_data as $key => $retailer_data)
                                                    {
                                                ?>
                                                        <option value="<?php echo $retailer_data["id"]; ?>"><?php echo $retailer_data["display_name"]; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 text-right">
            <div class="row save_btn">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>
    <h6 class="defau-tl"><?php echo $selected_data_label; ?></h6>
    <div class="row">

        <div class="col-md-11" id="retailer_customer_relation_detail_data">
            <div class="col-md-10 col-md-offset-1 cco-form-fl">
                <div class="row tp_form">
                    <div class="form-group">


                            <?php
                                if(!empty($customer_relation_retailer_data))
                                {

                                    foreach($customer_relation_retailer_data as $data_key => $relation_retailer_data)
                                    {
                            ?>
                                        <!--<div class="col-md-6">
                                            <label style="margin: 0;"><?php /*echo $relation_retailer_data["display_name"]; */?></label>
                                            <div class="delete_i" style="margin-left: 5px; display: inline-block;" prdid ="<?php /*echo $relation_retailer_data["CtoC_mapping_id"];*/?>">
                                                <a href="javascript: void(0);" style="color: #ff0000;">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>-->
                                        <ul class="corp-list">
                                            <li><label style="margin: 0;"><strong><?php echo $relation_retailer_data["display_name"]; ?></strong></label></li>
                                            <!--<li><label style="margin: 0;"><?php /*echo $cust_crop_data["yeild_HA"]; */?></label></li>-->
                                            <li style="text-align: center; min-width: auto;">
                                                <div class="delete_i" style="display: inline-block;" prdid ="<?php echo $relation_retailer_data["CtoC_mapping_id"]; ?>">
                                                    <a href="javascript: void(0);" style="color: #ff0000;">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                            <?php
                                    }

                                }
                            ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="clearfix"></div>

<script type="text/javascript">

    $("div#retailer_customer_relation_detail_data .delete_i").on('click', function () {

        var id = $(this).attr('prdid');
        var customer_id = $("input#customer_id").val();

        $('<div></div>').appendTo('body')
            .html('<div>Are You Sure?</div>')
            .dialog({
                appendTo: "#success_file_popup",
                modal: true,
                title: 'Are You Sure?',
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: true,
                buttons: {
                    OK: function () {
                        $(this).dialog("close");

                        $.ajax({
                            type: 'POST',
                            url: site_url+'cco/delete_customer_retailer_relation_data',
                            data: {relation_id:id},
                            success: function(resp){
                                //location.reload();
                                get_retailer_view_data(customer_id);
                            }
                        });

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


</script>