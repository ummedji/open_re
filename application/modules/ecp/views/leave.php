<?php $segment2 = $this->uri->segment(2);
$attributes = array('class' => '', 'id' => 'leave_set','name'=>'leave_set');
echo form_open('',$attributes); ?>
<div class="col-md-12 full-height">
    <div class="row">
        <div class="col-md-12">
            <div class="top_form">
                <div class="row">
                    <div class="col-md-12 text-center sub_nave">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="<?php echo ($segment2=='no_working') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/no_working');?>">No Working</a></li>
                                <li class="<?php echo ($segment2=='set_leave') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/set_leave');?>">Leave</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 no_wrkn" >
                        <div class="col-md-6 text-center radio_space tp_form inline-parent">

                            <div class="form-group">
                                <label for="cur_date">Date</label>
                                <input type="text" class="form-control" name="cur_date" id="cur_date" placeholder="" readonly>
                            </div>

                            <div class="col-md-6 col-md-offset-3 check_leave">
                            <?php
                            foreach($leave_type as $k=>$val_leave_type){
                                ?>
                                <div class="radio">
                                    <input attr-id="leave_<?php echo $val_leave_type['leave_type_country_id'];?>" type="radio" name="radio" class="leave_id" id="<?php echo $val_leave_type['short_code'];?>" value="<?php echo $val_leave_type['leave_type_country_id'];?>">
                                    <label for="<?php echo $val_leave_type['short_code'];?>"><?php echo $val_leave_type['short_code'];?></label>
                                </div>
                                <?php
                            }
                            ?>
                            <label id="radio-error" class="error" for="radio"></label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6 text-center calendar_space">

                            <?php if (!$this->input->is_ajax_request()) { ?>
                            <div id="calendar">
                                <?php  echo $cal_data; ?>
                            </div>
                            <?php  } ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                        <div class="save_button">
                            <div class="row">
                                <div class="col-md-3 save_btn">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <div class="delete_button" style="display: none">
                                    <div class="col-md-3 save_btn" style="">
                                        <button type="button" id ='cancel_data' class="btn btn-primary" style="background-color: red">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
    <input class="leave_id" type="hidden" name="leave_id" id="leave_id" />

<?php echo form_close(); ?>