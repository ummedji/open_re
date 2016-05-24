<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('country_master_errors_message'); ?>
	</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

$id = isset($country_master->counrty_id) ? $country_master->counrty_id : '';
?>
<div class='admin-box portlet box green'>
 <div class='portlet-title'>
        <div class='caption'>
            <i class='fa fa-pencil'></i> Create Country Master
        </div>
    </div>
    <div class='portlet-body form'>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
            

			<div class="control-group<?php echo form_error('iso') ? ' has-error' : ''; ?>">
				<?php echo form_label('Iso', 'iso', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='iso' class='form-control input-medium' type='text' name='iso' maxlength='2' value="<?php echo set_value('iso', isset($country_master->iso) ? $country_master->iso : ''); ?>" />
					<label id='iso-error' class='error' for='iso'></label>
					<span class='help-inline'><?php echo form_error('iso'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('name') ? ' has-error' : ''; ?>">
				<?php echo form_label('Country Name'. lang('bf_form_label_required'), 'name', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='name' class='form-control input-medium' type='text' required='required' name='name' maxlength='80' value="<?php echo set_value('name', isset($country_master->name) ? $country_master->name : ''); ?>" />
					<label id='name-error' class='error' for='name'></label>
					<span class='help-inline'><?php echo form_error('name'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('printable_name') ? ' has-error' : ''; ?>">
				<?php echo form_label('Printable Name'. lang('bf_form_label_required'), 'printable_name', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='printable_name' class='form-control input-medium' type='text' required='required' name='printable_name' maxlength='80' value="<?php echo set_value('printable_name', isset($country_master->printable_name) ? $country_master->printable_name : ''); ?>" />
					<label id='printable_name-error' class='error' for='printable_name'></label>
					<span class='help-inline'><?php echo form_error('printable_name'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('iso3') ? ' has-error' : ''; ?>">
				<?php echo form_label('Iso3', 'iso3', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='iso3' class='form-control input-medium' type='text' name='iso3' maxlength='3' value="<?php echo set_value('iso3', isset($country_master->iso3) ? $country_master->iso3 : ''); ?>" />
					<label id='iso3-error' class='error' for='iso3'></label>
					<span class='help-inline'><?php echo form_error('iso3'); ?></span>
				</div>
			</div>

			<div class="control-group<?php echo form_error('numcode') ? ' has-error' : ''; ?>">
				<?php echo form_label('Numcode'. lang('bf_form_label_required'), 'numcode', array('class' => 'control-label col-md-6')); ?>
				<div class='controls'>
					<input id='numcode' class='form-control input-medium' type='text' required='required' name='numcode' maxlength='6' value="<?php echo set_value('numcode', isset($country_master->numcode) ? $country_master->numcode : ''); ?>" />
					<label id='numcode-error' class='error' for='numcode'></label>
					<span class='help-inline'><?php echo form_error('numcode'); ?></span>
				</div>
			</div>

            <?php
            $options = array(
                1 => 'Active',
                0 => 'Inactive'
            );
				echo form_dropdown(array('name' => 'status' ,'class'=>'form-control input-medium'), $options, set_value('status', isset($country_master->status) ? $country_master->status : ''), 'Status');
			?>
        </fieldset>
		<fieldset class='form-actions'>
			<input type='submit' name='save' class='btn green' value="<?php echo lang('country_master_action_create'); ?>" />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA . '/master/country_master', lang('country_master_cancel'), 'class="btn default"'); ?>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>