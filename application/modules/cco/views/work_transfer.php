<?php
$attributes = array('class' => '', 'id' => 'work_trf','name'=>'work_trf', 'autocomplete'=>'off');
echo form_open('',$attributes);
?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/allocation') ?>">Farmers</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='channel_partner_allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/channel_partner_allocation') ?>">Channel Partners</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='allocation_activity') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/allocation_activity') ?>">Activity</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='work_transfer_allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/work_transfer_allocation') ?>">Work Transfer</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-12 text-center tp_form">
                <div class="form-group">
                    <label>CCO Name</label>
                    <select id="cco_data" class="cco_data selectpicker" name="cco_data">
                        <option value="">Select CCO</option>
                        <?php if(!empty($cco_data)) {
                            foreach ($cco_data as $c_key => $ccodata) { ?>
                            <option value="<?php echo $ccodata["id"]; ?>"><?php echo $ccodata["display_name"]; ?></option>
                            <?php  }
                        } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>

<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>

<?php if (!$this->input->is_ajax_request()) { ?>
<div id="cco_work_details">

</div>



<div id="cco_work_transfer_details">

</div>

<div class="col-md-12 text-center tp_form inline-parent transfer_btn" style="margin-top: 0px; margin-bottom: 10px; display: none">
    <div class="save_button">
        <div class="row">
            <div class="save_btn" style="display: inline-block;">
                <button type="submit" class="btn btn-primary gren_btn">Transfer</button>
              <!--  <button type="button" id="submit" class="btn btn-primary">Transfer</button>-->
            </div>
            <div class="delete_button" style="display: inline-block;">
                <div class="save_btn">
                    <button type="button" id ='cancel_data' class="btn btn-primary" style="background-color: red">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php echo form_close(); ?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div id="cco_allocation_details" style="margin-top: 50px">

    <?php
    echo theme_view('common/middle');
    ?>
</div>
<?php } ?>
<div class="clearfix"></div>

