<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('category_regional_master_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($category_regional_master->category_id) ? $category_regional_master->category_id : '';
?>
<div class='admin-box portlet box green'>
 <div class='portlet-title'>
        <div class='caption'>
            <i class='fa fa-pencil'></i> Edit Category Regional Master
        </div>
    </div>
    <div class='portlet-body form'>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('category_name') ? ' has-error' : ''; ?>">
				<?php echo form_label('Category Name'. lang('bf_form_label_required'), 'category_name', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='category_name' class='form-control input-medium' type='text' required='required' name='category_name' maxlength='255' value="<?php echo set_value('category_name', isset($category_regional_master->category_name) ? $category_regional_master->category_name : ''); ?>" />
					<label id='category_name-error' class='error' for='category_name'></label>
					<span class='help-inline'><?php echo form_error('category_name'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('category_code') ? ' has-error' : ''; ?>">
				<?php echo form_label('Category Code'. lang('bf_form_label_required'), 'category_code', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='category_code' class='form-control input-medium' type='text' required='required' name='category_code' maxlength='30' value="<?php echo set_value('category_code', isset($category_regional_master->category_code) ? $category_regional_master->category_code : ''); ?>" />
					<label id='category_code-error' class='error' for='category_code'></label>
					<span class='help-inline'><?php echo form_error('category_code'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					11 => 11,
				);
				echo form_dropdown(array('name' => 'category_applicable_id' ,'class'=>'form-control input-medium', 'required' => 'required'), $options, set_value('category_applicable_id', isset($category_regional_master->category_applicable_id) ? $category_regional_master->category_applicable_id : ''), 'Applicable Category'. lang('bf_form_label_required'));
			?>

			<div class="control-group<?php echo form_error('created_by_user') ? ' has-error' : ''; ?>">
				<?php echo form_label('Created By', 'created_by_user', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='created_by_user' class='form-control input-medium' type='text' name='created_by_user' maxlength='11' value="<?php echo set_value('created_by_user', isset($category_regional_master->created_by_user) ? $category_regional_master->created_by_user : ''); ?>" />
					<label id='created_by_user-error' class='error' for='created_by_user'></label>
					<span class='help-inline'><?php echo form_error('created_by_user'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('modified_by_user') ? ' has-error' : ''; ?>">
				<?php echo form_label('Modified By', 'modified_by_user', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='modified_by_user' class='form-control input-medium' type='text' name='modified_by_user' maxlength='11' value="<?php echo set_value('modified_by_user', isset($category_regional_master->modified_by_user) ? $category_regional_master->modified_by_user : ''); ?>" />
					<label id='modified_by_user-error' class='error' for='modified_by_user'></label>
					<span class='help-inline'><?php echo form_error('modified_by_user'); ?></span>
				</div>
			</div>
        <?php
        $options = array(
                1 => 'Active',
                0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($category_regional_master->status) ? $category_regional_master->status : ''), 'Status'. lang('bf_form_label_required'),'class="form-control input-medium"')?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>
        
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn green' value="<?php echo lang('category_regional_master_action_edit'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/master/category_regional_master', lang('category_regional_master_cancel'), 'class="btn default"'); ?>
			
			<?php if ($this->auth->has_permission('Category_Regional_Master.Master.Delete')) : ?>
				<?php echo lang('bf_or'); ?>
				<button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('category_regional_master_delete_confirm'))); ?>');">
					<span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('category_regional_master_delete_record'); ?>
				</button>
			<?php endif; ?>
		</fieldset>
    <?php echo form_close(); ?>
</div>