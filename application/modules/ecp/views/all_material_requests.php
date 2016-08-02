<?php
if (!$this->input->is_ajax_request()) {
    ?>
    <?php
    $attributes = array('class' => '', 'id' => 'all_material_request','name'=>'all_material_request');
    echo form_open('ecp/all_materials_details_view',$attributes);
    ?>
    <div class="col-md-12">
        <div class="top_form">
            <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Status<span style="color: red">*</span></label>
                        <div class="inln_fld">
                            <select class="selectpicker" id="status_id" name="status_id" data-live-search="true">
                                <option value="">Select Status</option>
                                <option value="0">Pending</option>
                                <option value="1">Approved</option>
                                <option value="2">Rejected</option>
                            </select>
                            <div class="clearfix"></div>
                            <label id="status_id-error" class="error" for="status_id"></label>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="from_date">From Date<span style="color: red">*</span></label>
                        <div class="inln_fld">
                            <input type="text" class="form-control" name="from_date" id="from_date" placeholder="">
                            <div class="clearfix"></div>
                            <label id="from_date-error" class="error" for="from_date"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="to_date">To Date<span style="color: red">*</span></label>
                        <div class="inln_fld">
                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                            <div class="clearfix"></div>
                            <label id="to_date-error" class="error" for="to_date"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Designation<span style="color: red">*</span></label>
                        <select class="selectpicker" id="designation_id" name="designation_id" data-live-search="true">
                            <option value="">Select Designation</option>
                            <?php
                            if(isset($designation) && !empty($designation)) {
                                foreach ($designation as $key => $val_designation) {
                                    ?>
                                    <option value="<?php echo $val_designation['role_id']; ?>" role="<?php echo $val_designation['role_id']; ?>"><?php echo $val_designation['desigination_country_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Employee<span style="color: red">*</span></label>
                        <select class="selectpicker" id="employee_id" name="employee_id" data-live-search="true">
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="save_button">
                            <div class="row">
                                <div class="col-md-3 save_btn">
                                    <button type="submit" id ="execute_request" class="btn btn-primary">Execute</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php echo form_close();
    ?>
    <div class="clearfix"></div>
<?php }?>


<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
    <?php
    $attributes = array('class' => '', 'id' => 'all_materials_view_data','name'=>'all_materials_view_data');
    echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) {
    ?>
    <div id="middle_container" class="materials_cont">

    </div>
<?php  } ?>
    <?php echo form_close();

    ?>


