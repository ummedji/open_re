<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Financial Details</h5>
    <div class="back_details">

        <?php
        $customer_id = (isset($customer_id) && !empty($customer_id))? $customer_id : "";
        ?>

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_financial_info','name'=>'dialpad_financial_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_financial_info',$attributes);
        ?>

        <div class="row">

            <div class="col-md-11" id="financial_detail_data">


                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                    <div class="rotate_data">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 cco-form-fl">
                                <div class="row tp_form">
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="Avg. PA Income">Avg. PA Income</label></div>
                                        <div class="col-md-6">
                                            <?php

                                            $customer_income = (isset($customer_pa_income[0]["average_pa_income"]) && !empty($customer_pa_income[0]["average_pa_income"])) ? $customer_pa_income[0]["average_pa_income"] : "";

                                            ?>

                                            <input type="text" class="form-control" name="average_pa_income" id="average_pa_income" placeholder="" value="<?php echo $customer_income; ?>" />
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="Electronic Owned">Electronic Owned</label></div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="electronic_owned[]" id="electronic_owned" multiple>
                                                <option value="">Select Electronic</option>

                                                <?php
                                                if(!empty($all_electronic_data))
                                                {
                                                    foreach($all_electronic_data as $ele_key => $electronic_data)
                                                    {
                                                        $selected = "";
                                                        foreach($financial_electronic_data as $sel_key => $selected_electronic_data)
                                                        {
                                                            if($electronic_data["electonic_id"] == $selected_electronic_data["electronic_owned_id"])
                                                            {
                                                                $selected = "selected = 'selected'";
                                                            }
                                                        }

                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $electronic_data["electonic_id"]; ?>"><?php echo $electronic_data["item_name"]; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="Vehicles Owned">Vehicles Owned</label></div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="vehicles_owned[]" id="vehicles_owned" multiple>
                                                <option value="">Select Vehicles</option>

                                                <?php
                                                if(!empty($all_vechiles_data))
                                                {
                                                    foreach($all_vechiles_data as $veh_key => $vechiles_data)
                                                    {

                                                        $selected = "";
                                                        if(!empty($financial_vechiles_data)) {
                                                            foreach ($financial_vechiles_data as $sel_key1 => $selected_veh_data) {
                                                                if ($vechiles_data["vehicle_id"] == $selected_veh_data["vehicles_owned_id"]) {
                                                                    $selected = "selected = 'selected'";
                                                                }
                                                            }
                                                        }

                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $vechiles_data["vehicle_id"]; ?>"><?php echo $vechiles_data["item_name"]; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"></div>
                                        <div class="col-md-6"></div>
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

    <div class="row">
        <div class="col-md-11" id="financial_detail_data">
            <div class="row">

                <div class="col-md-4 col-sm-6 com_form">
                    <label for="Electronic Owned">Electronic Owned</label>
                    <div class="form-group">
                        <?php
                        if(!empty($financial_electronic_data)) {
                            foreach ($financial_electronic_data as $sel_key2 => $selected_ele_data) {
                                ?>
                                <span><?php echo $selected_ele_data["item_name"]; ?></span>
                                <div class="clearfix"></div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 com_form">
                    <label for="Vehicles Owned">Vehicles Owned</label>
                    <div class="form-group">
                    <?php
                    if(!empty($financial_vechiles_data)) {
                        foreach ($financial_vechiles_data as $sel_key1 => $selected_veh_data) {
                            ?>
                            <span><?php echo $selected_veh_data["item_name"]; ?></span>
                            <div class="clearfix"></div>
                        <?php
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="clearfix"></div>