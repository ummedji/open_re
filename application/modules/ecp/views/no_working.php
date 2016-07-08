<?php $segment2 = $this->uri->segment(2);
$attributes = array('class' => '', 'id' => 'no_working','name'=>'no_working');
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
                    <div class="col-md-12 no_wrkn">

                        <div class="col-md-6 text-center radio_space tp_form">
                            <div class="form-group">
                                <label for="cur_date">Date</label>
                                <input type="text" class="form-control" name="cur_date" id="cur_date" placeholder="" readonly style="display: inline-block;width: auto;">
                            </div>
                            <div class="col-md-6 col-md-offset-3 check_no_worh">
                            <?php
                            foreach($reason as $k=>$val_res){
                                ?>

                                    <div class="radio">
                                        <input  attr-id="no_working_<?php echo $val_res['reason_country_id'];?>"  type="radio" class="reason_type" name="radio" id="<?php echo strtolower($val_res['reason_country_name']);?>" value="<?php echo $val_res['reason_country_id'];?>">
                                        <label for="<?php echo strtolower($val_res['reason_country_name']);?>"><?php echo $val_res['reason_country_name'];?></label>
                                    </div>

                            <?php
                            }
                            ?>
                                <label id="radio-error" class="error" for="radio"></label>
                            </div>


                            <div class="col-md-12 tp_form">
                                <div class="form-group" id = "othr_reason" style="display:none;">
                                    <label for="oth_reason">Other Reason<span style="color: red">*</span></label>
                                    <textarea rows="2" cols="50" name="oth_reason" id="oth_reason"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6 text-center calendar_space">
                            <div id="calendar">
                                <? echo $cal_data; ?>
                            </div>
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
                                    <div class="col-md-3 save_btn">
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

    <input class="no_working_id" type="hidden" name="no_working_id" id="no_working_id" />
<?php echo form_close(); ?>