<div class="actv-details-form">
    <h5>Feedback</h5>
    <div class="back_details">


        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_feedback_view_info','name'=>'dialpad_feedback_view_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_feedback_view_info',$attributes);
        ?>
        <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />
        <input type="hidden" class="form-control" name="feedback_edit_id" id="feedback_edit_id" placeholder="" value="" />

        <div class="row">

            <div class="col-md-11" id="feedback_detail_data">



                <div class="rotate_data">

                            <div class="row">

                                <div class="col-md-4 col-sm-6 com_form">
                                    <div class="form-group">
                                        <label for="Customer Name">Customer Name</label>

                                    <?php
                                    $customer_name = (isset($get_user_data['0']['username']) && !empty($get_user_data['0']['username'])) ? $get_user_data['0']['username'] : "";

                                    ?>

                                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="" value="<?php echo $customer_name; ?>"   />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 com_form">
                                    <div class="form-group">
                                        <label for="Subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="" value="" />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-md-12 com_form">
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea class="form-control" rows="3" name="description" id="description" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
             </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1 col-md-1-n">
            <label class="space_llb">&nbsp;</label>
            <button type="submit" class="btn btn-default back_details-button">Save</button>
        </div>
        <div class="col-md-1 col-md-1-n">
            <label class="space_llb">&nbsp;</label>
            <button type="submit" class="btn btn-default back_details-button" onclick="location.reload();">Cancel</button>
        </div>

        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>
    <div id="feedback_data">
    <?php
    if ($this->input->is_ajax_request()) {
        echo theme_view('common/middle');
    }
    ?>
    </div>

    <?php if(!$this->input->is_ajax_request()){ ?>

        <div id="middle_container" class="feedback">

        </div>

    <?php } ?>
</div>
   <div class="clearfix"></div>

