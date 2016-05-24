<div class="content">
    <div class="wrap">
        <?php //echo widget('menu', array("navigation" => "header")) ?>
        <div class="sign_up">
            <div class="teitel_s"></div>
            <div class="signup">
                <div class="teitel_sign"> Email Information</div>
                <div class="containts_form">
                    <?php if (form_error('email') != "") { ?>
                        <div class="alert alert-block alert-error fade in notification">
                            <a class="close" href="#" data-dismiss="alert">×</a>

                            <div><?php echo form_error('email'); ?></div>
                        </div>
                    <?php } ?>

                    <form action="<?php echo base_url('/newsletter/'); ?>" method="post" name="newsletterfrom"
                          id="newsletterfrom">
                        <div class="name">First Name:</div>
                        <div class="input_box"><input class="input" name="firstname" id="firstname" type="text"/></div>
                        <div class="name">Last Name:</div>
                        <div class="input_box"><input class="input" name="lastname" id="lastname" type="text"/></div>
                        <div class="name">*Email Address:</div>
                        <div class="input_box"><input class="input" name="email" id="email" type="text"
                                                      value="<?php if (isset($email)) echo $email; ?>"/>
                        </div>
                        <div class="name"></div>
                        <div class="input_box "><input class="submit" type="submit" name="newsletter" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>