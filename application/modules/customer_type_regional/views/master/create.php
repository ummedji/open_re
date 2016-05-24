<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('customer_type_regional_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($customer_type_regional->customer_type_id) ? $customer_type_regional->customer_type_id : '';
?>
<div class='admin-box portlet box green'>
 <div class='portlet-title'>
        <div class='caption'>
            <i class='fa fa-pencil'></i> Create Customer Type Regional
        </div>
    </div>
    <div class='portlet-body form'>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('customer_level') ? ' has-error' : ''; ?>">
				<?php echo form_label('Customer Level'. lang('bf_form_label_required'), 'customer_level', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='customer_level' class='form-control input-medium' type='text' required='required' name='customer_level' maxlength='255' value="<?php echo set_value('customer_level', isset($customer_type_regional->customer_level) ? $customer_type_regional->customer_level : ''); ?>" />
					<label id='customer_level-error' class='error' for='customer_level'></label>
					<span class='help-inline'><?php echo form_error('customer_level'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('customer_type_name') ? ' has-error' : ''; ?>">
				<?php echo form_label('Customer Type Name'. lang('bf_form_label_required'), 'customer_type_name', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='customer_type_name' class='form-control input-medium' type='text' required='required' name='customer_type_name' maxlength='255' value="<?php echo set_value('customer_type_name', isset($customer_type_regional->customer_type_name) ? $customer_type_regional->customer_type_name : ''); ?>" />
					<label id='customer_type_name-error' class='error' for='customer_type_name'></label>
					<span class='help-inline'><?php echo form_error('customer_type_name'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('customer_type_code') ? ' has-error' : ''; ?>">
				<?php echo form_label('Customer Type Code'. lang('bf_form_label_required'), 'customer_type_code', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='customer_type_code' class='form-control input-medium' type='text' required='required' name='customer_type_code' maxlength='100' value="<?php echo set_value('customer_type_code', isset($customer_type_regional->customer_type_code) ? $customer_type_regional->customer_type_code : ''); ?>" />
					<label id='customer_type_code-error' class='error' for='customer_type_code'></label>
					<span class='help-inline'><?php echo form_error('customer_type_code'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('customer_type_description') ? ' has-error' : ''; ?>">
				<?php echo form_label('Customer Type Description', 'customer_type_description', array('class' => 'control-label col-md-3')); ?>
				<div class='controls'>
					<?php echo form_textarea(array('name' => 'customer_type_description', 'id' => 'customer_type_description', 'class' => 'form-control input-medium', 'rows' => '5', 'cols' => '80', 'value' => set_value('customer_type_description', isset($customer_type_regional->customer_type_description) ? $customer_type_regional->customer_type_description : ''))); ?>
					<label id='customer_type_description-error' class='error' for='customer_type_description'></label>
					<span class='help-inline'><?php echo form_error('customer_type_description'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('created_by_user') ? ' has-error' : ''; ?>">
				<?php echo form_label('Created By', 'created_by_user', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='created_by_user' class='form-control input-medium' type='text' name='created_by_user' maxlength='11' value="<?php echo set_value('created_by_user', isset($customer_type_regional->created_by_user) ? $customer_type_regional->created_by_user : ''); ?>" />
					<label id='created_by_user-error' class='error' for='created_by_user'></label>
					<span class='help-inline'><?php echo form_error('created_by_user'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('modified_by_user') ? ' has-error' : ''; ?>">
				<?php echo form_label('Modified By', 'modified_by_user', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='modified_by_user' class='form-control input-medium' type='text' name='modified_by_user' maxlength='11' value="<?php echo set_value('modified_by_user', isset($customer_type_regional->modified_by_user) ? $customer_type_regional->modified_by_user : ''); ?>" />
					<label id='modified_by_user-error' class='error' for='modified_by_user'></label>
					<span class='help-inline'><?php echo form_error('modified_by_user'); ?></span>
				</div>
			</div>
        <?php
        $options = array(
                1 => 'Active',
                0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($customer_type_regional->status) ? $customer_type_regional->status : ''), 'Status'. lang('bf_form_label_required'),'class="form-control input-medium"')?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>
        
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn green' value="<?php echo lang('customer_type_regional_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/master/customer_type_regional', lang('customer_type_regional_cancel'), 'class="btn default"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>