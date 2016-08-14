<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Retailers Details</h5>
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
                                        <div class="col-md-6 text-right-cco"><label for="Mapped Retailers">Mapped Retailers</label></div>
                                        <div class="col-md-6">

                                            <select class="form-control" placeholder="" name="retailer_data" >
                                                <option value="">Select Retailer</option>

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
    Retailers
    <div class="row">

        <div class="col-md-11" id="detail_data">
            <div class="col-md-8 col-md-offset-2 cco-form-fl">
                <div class="row tp_form">
                    <div class="form-group">
                        <div class="col-md-6 text-right-cco">

                        </div>
                        <div class="col-md-6">



                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="clearfix"></div>