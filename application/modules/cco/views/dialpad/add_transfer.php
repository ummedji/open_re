<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="popup_title">Transfer</h4>
        </div>
        <div class="modal-body">
            <div id="call_transfer" class="col-md-12" >
                <div class="row">

                    <div class="col-md-12">
                        <?php
                        $attributes = array('class' => '', 'id' => 'form_call_transfer', 'name' => 'form_call_transfer');
                        echo form_open('', $attributes);
                        ?>
                        <input type="hidden" name="mob_num" id="mob_num" value="<?php echo $this->session->userdata('phone_no');?>" />
                        <div class="default_box_white">
                            <div class="col-md-12 text-center tp_form inline-parent">
                                <div class="form-group">
                                    <label>CCO Name<span style="color: red">*</span></label>
                                    <select class="cco_name" id="cco_name" name="cco_id" data-live-search="true" required>
                                        <option value="">Select CCO Name</option>
                                        <?php
                                        if(isset($get_cco_data) && !empty($get_cco_data))
                                        {
                                            foreach($get_cco_data as $k=> $gcd) { ?>

                                                <option value="<?php echo $gcd['id'] ?>"><?php echo $gcd['display_name'] ?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="save_btn">
                                        <button type="submit" class="btn btn-primary" id="save_cco_transfer">Transfer</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <?php echo form_close(); ?>

                        <?php
                        $attributes = array('class' => '', 'id' => 'form_emp_call_transfer', 'name' => 'form_emp_call_transfer');
                        echo form_open('', $attributes);
                        ?>
                        <input type="hidden" name="mob_num" id="mob_num" value="<?php echo $this->session->userdata('phone_no');?>" />
                        <div style="padding-top: 20px;">
                            <div class="col-md-12 text-center tp_form inline-parent">
                                <div class="form-group">
                                    <label>Designation <span style="color: red">*</span></label>
                                    <select class="designation" id="designation" name="designation" data-live-search="true" required>
                                        <option value="">Select CCO Name</option>
                                        <?php
                                        if(isset($designation) && !empty($designation))
                                        {
                                            foreach($designation as $k=> $vd) { ?>

                                                <option value="<?php echo $vd['desigination_country_id'] ?>"><?php echo $vd['desigination_country_name'] ?></option>

                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Employee Name<span style="color: red">*</span></label>
                                    <select class="employee_name" id="employee_name" name="employee_name" data-live-search="true" required>
                                        <option value="">Select Employee Name</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="save_btn">
                                        <button type="submit" class="btn btn-primary" id="save_emp_transfer">Transfer</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-default close_default_bb" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#form_call_transfer").validate({
            submitHandler: function(form) {
                save_call_transfer();
            }
        });

        $("#form_emp_call_transfer").validate({
            submitHandler: function(form) {
                save_emp_call_transfer();
            }
        });


    });
</script>