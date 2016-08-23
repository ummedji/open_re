<?php if (!$this->input->is_ajax_request()) { ?>
<?php
$attributes = array('class' => '', 'id' => 'material_request','name'=>'material_request');
echo form_open('ecp/material_request',$attributes); ?>

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                <div class="form-group">
                    <label for="material_request_date">Date</label>
                    <?php
                    if(!empty($current_user->local_date)){
                        $date = strtotime(date('Y-m-d'));
                        $cur_date = date($current_user->local_date,$date);
                    }
                    else{
                        $cur_date =  date('Y-m-d');
                    }
                    ?>
                    <input type="text" class="form-control" value="<?php echo $cur_date ?>" name="material_request_date" id="material_request_date" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Material<span style="color: red">*</span></label>
                    <div class="inln_fld_top text-left">
                        <select class="selectpicker" id="promotional_country_id" name="promotional_country_id" data-live-search="true">
                            <option value="">Select Materials</option>
                            <?php
                            if(isset($materials) && !empty($materials))
                            {
                                foreach($materials as $key=>$val_material)
                                {
                                    ?>
                                    <option value="<?php echo $val_material['promotional_country_id']; ?>"><?php echo $val_material['promotional_material_country_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="clearfix"></div>
               <label id="promotional_country_id-error" class="error" for="promotional_country_id"></label>
                    </div>

                </div>
                <div class="form-group">
                    <label for="invoice_no">Quantity<span style="color: red">*</span></label>
                    <div class="inln_fld_top text-left">
                        <input type="text" class="form-control allownumericwithdecimal" name="quantity" id="quantity" placeholder="">
                        <div class="clearfix"></div>
                       <label id="quantity-error" class="error" for="quantity"></label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <div class="inln_fld_top text-left">
                        <textarea rows="2" cols="50" class="form-control" name="remark" id="remark"></textarea>
                        <div class="clearfix"></div>
                        <label id="remark-error" class="error" for="remark"></label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px; margin-bottom: 20px;">
                <div class="save_button">
                        <div class="row">
                            <div class="save_btn">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" id ='cancel_data' class="btn btn-primary" style="background-color: red">Cancel</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php echo form_close(); ?>

<?php } ?>

<?php $attributes = array('class' => '', 'id' => 'update_material_request','name'=>'update_material_request');
echo form_open('',$attributes); ?>

<div id="middle_container" class="material_request_container">
    <?php
    echo theme_view('common/middle');
    ?>
</div>

<?php echo form_close(); ?>

