<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if (isset($user_management)) {
    $user_management = (array)$user_management;
}
$id = isset($user_management['id']) ? $user_management['id'] : '';
?>
<div class="admin-box">
    <h3>User Management</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('role_id') ? 'error' : ''; ?>">
            <?php echo form_label('role_id' . lang('bf_form_label_required'), 'role_id', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="role_id" type="text" name="role_id" maxlength="255"
                       value="<?php echo set_value('role_id', isset($user_management['role_id']) ? $user_management['role_id'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('role_id'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('email') ? 'error' : ''; ?>">
            <?php echo form_label('Email' . lang('bf_form_label_required'), 'email', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="email" type="text" name="email" maxlength="120"
                       value="<?php echo set_value('email', isset($user_management['email']) ? $user_management['email'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('email'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('username') ? 'error' : ''; ?>">
            <?php echo form_label('Username' . lang('bf_form_label_required'), 'username', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="username" type="text" name="username" maxlength="30"
                       value="<?php echo set_value('username', isset($user_management['username']) ? $user_management['username'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('username'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('password_hash') ? 'error' : ''; ?>">
            <?php echo form_label('password_hash', 'password_hash', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="password_hash" type="text" name="password_hash" maxlength="40"
                       value="<?php echo set_value('password_hash', isset($user_management['password_hash']) ? $user_management['password_hash'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('password_hash'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('reset_hash') ? 'error' : ''; ?>">
            <?php echo form_label('reset_hash', 'reset_hash', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="reset_hash" type="text" name="reset_hash" maxlength="40"
                       value="<?php echo set_value('reset_hash', isset($user_management['reset_hash']) ? $user_management['reset_hash'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('reset_hash'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('salt') ? 'error' : ''; ?>">
            <?php echo form_label('salt', 'salt', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="salt" type="text" name="salt" maxlength="7"
                       value="<?php echo set_value('salt', isset($user_management['salt']) ? $user_management['salt'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('salt'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('last_login') ? 'error' : ''; ?>">
            <?php echo form_label('last_login', 'last_login', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="last_login" type="text" name="last_login"
                       value="<?php echo set_value('last_login', isset($user_management['last_login']) ? $user_management['last_login'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('last_login'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('last_ip') ? 'error' : ''; ?>">
            <?php echo form_label('last_ip', 'last_ip', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="last_ip" type="text" name="last_ip" maxlength="40"
                       value="<?php echo set_value('last_ip', isset($user_management['last_ip']) ? $user_management['last_ip'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('last_ip'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('deleted') ? 'error' : ''; ?>">
            <?php echo form_label('deleted' . lang('bf_form_label_required'), 'deleted', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="deleted" type="text" name="deleted" maxlength="1"
                       value="<?php echo set_value('deleted', isset($user_management['deleted']) ? $user_management['deleted'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('deleted'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('banned') ? 'error' : ''; ?>">
            <?php echo form_label('banned' . lang('bf_form_label_required'), 'banned', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="banned" type="text" name="banned" maxlength="1"
                       value="<?php echo set_value('banned', isset($user_management['banned']) ? $user_management['banned'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('banned'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('ban_message') ? 'error' : ''; ?>">
            <?php echo form_label('ban_message', 'ban_message', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="ban_message" type="text" name="ban_message" maxlength="255"
                       value="<?php echo set_value('ban_message', isset($user_management['ban_message']) ? $user_management['ban_message'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('ban_message'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('reset_by') ? 'error' : ''; ?>">
            <?php echo form_label('reset_by', 'reset_by', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="reset_by" type="text" name="reset_by" maxlength="10"
                       value="<?php echo set_value('reset_by', isset($user_management['reset_by']) ? $user_management['reset_by'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('reset_by'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('display_name') ? 'error' : ''; ?>">
            <?php echo form_label('display_name', 'display_name', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="display_name" type="text" name="display_name" maxlength="255"
                       value="<?php echo set_value('display_name', isset($user_management['display_name']) ? $user_management['display_name'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('display_name'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('display_name_changed') ? 'error' : ''; ?>">
            <?php echo form_label('display_name_changed', 'display_name_changed', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="display_name_changed" type="text" name="display_name_changed"
                       value="<?php echo set_value('display_name_changed', isset($user_management['display_name_changed']) ? $user_management['display_name_changed'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('display_name_changed'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('timezone') ? 'error' : ''; ?>">
            <?php echo form_label('timezone' . lang('bf_form_label_required'), 'timezone', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="timezone" type="text" name="timezone" maxlength="4"
                       value="<?php echo set_value('timezone', isset($user_management['timezone']) ? $user_management['timezone'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('timezone'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('language') ? 'error' : ''; ?>">
            <?php echo form_label('language', 'language', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="language" type="text" name="language" maxlength="20"
                       value="<?php echo set_value('language', isset($user_management['language']) ? $user_management['language'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('language'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('activate_hash') ? 'error' : ''; ?>">
            <?php echo form_label('activate_hash', 'activate_hash', array('class' => "control-label")); ?>
            <div class='controls'>
                <input id="activate_hash" type="text" name="activate_hash" maxlength="40"
                       value="<?php echo set_value('activate_hash', isset($user_management['activate_hash']) ? $user_management['activate_hash'] : ''); ?>"/>
                <span class="help-inline"><?php echo form_error('activate_hash'); ?></span>
            </div>


        </div>

        <?php
        $options = array(
            1 => 'Active',
            0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('active', $options, set_value('active', isset($user_management['active']) ? $user_management['active'] : ''), 'Status' . lang('bf_form_label_required')) ?>
        <span class="help-inline"><?php echo form_error('active'); ?></span>


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit User Management"/>
            or <?php echo anchor(SITE_AREA . '/siteusers/user_master', lang('user_management_cancel'), 'class="btn btn-warning"'); ?>


            <?php if ($this->auth->has_permission('User_Master.Siteusers.Delete')) : ?>

                or
                <button type="submit" name="delete" class="btn btn-danger" id="delete-me"
                        onclick="return confirm('<?php echo lang('user_management_delete_confirm'); ?>')">
                    <i class="icon-trash icon-white">
                        &nbsp;</i>&nbsp;<?php echo lang('user_management_delete_record'); ?>
                </button>

            <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
