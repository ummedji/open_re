<?php

$social_id = (isset($social_data[0]["social_id"]) && !empty($social_data[0]["social_id"]))? $social_data[0]["social_id"] : "";

$facebook_account = (isset($social_data[0]["facebook_account"]) && !empty($social_data[0]["facebook_account"]))? $social_data[0]["facebook_account"] : "";

$mail_account = (isset($social_data[0]["gmail_plus_account"]) && !empty($social_data[0]["gmail_plus_account"]))? $social_data[0]["gmail_plus_account"] : "";

$linkedin_account = (isset($social_data[0]["linkedin_account"]) && !empty($social_data[0]["linkedin_account"]))? $social_data[0]["linkedin_account"] : "";

$twt_account = (isset($social_data[0]["twt_account"]) && !empty($social_data[0]["twt_account"]))? $social_data[0]["twt_account"] : "";

?>
<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Social Connections</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_social_info','name'=>'dialpad_social_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_social_info',$attributes);
        ?>

        <div class="row">

            <div class="col-md-11" id="social_detail_data">


                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                    <div class="rotate_data">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 cco-form-fl">
                                <div class="row tp_form">
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="Facebook Account">Facebook Account</label></div>
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control" name="social_id" id="social_id" placeholder="" value="<?php echo $social_id; ?>" />
                                            <input type="text" class="form-control" name="fb_account" id="fb_account" placeholder="" value="<?php echo $facebook_account; ?>" />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="Mail Account">Mail Account</label></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="mail_account" id="mail_account" placeholder="" value="<?php echo $mail_account; ?>" /></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="LinkedIn Account">LinkedIn Account</label></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="linkedin_account" id="linkedin_account" placeholder="" value="<?php echo $linkedin_account; ?>" /></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco"><label for="Twitter Account">Twitter Account</label></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="twitter_account" id="twitter_account" placeholder="" value="<?php echo $twt_account; ?>" /></div>
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
</div>
<div class="clearfix"></div>