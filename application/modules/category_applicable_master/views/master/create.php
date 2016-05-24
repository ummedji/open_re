<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('category_applicable_master_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($category_applicable_master->category_applicable_id) ? $category_applicable_master->category_applicable_id : '';
?>
<div class='admin-box portlet box green'>
 <div class='portlet-title'>
        <div class='caption'>
            <i class='fa fa-pencil'></i> Create Category Applicable Master
        </div>
    </div>
    <div class='portlet-body form'>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('applicable_name') ? ' has-error' : ''; ?>">
				<?php echo form_label('Applicable Name'. lang('bf_form_label_required'), 'applicable_name', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='applicable_name' class='form-control input-medium' type='text' required='required' name='applicable_name' maxlength='255' value="<?php echo set_value('applicable_name', isset($category_applicable_master->applicable_name) ? $category_applicable_master->applicable_name : ''); ?>" />
					<label id='applicable_name-error' class='error' for='applicable_name'></label>
					<span class='help-inline'><?php echo form_error('applicable_name'); ?></span>
				</div>
			</div>
        <?php
        $options = array(
                1 => 'Active',
                0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($category_applicable_master->status) ? $category_applicable_master->status : ''), 'Status'. lang('bf_form_label_required'),'class="form-control input-medium"')?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>
        
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn green' value="<?php echo lang('category_applicable_master_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/master/category_applicable_master', lang('category_applicable_master_cancel'), 'class="btn default"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>