<div class="main_installation">
    <div class="col-md-8 col-md-offset-2">
        <?php //echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <form action="" method="post" class="inst_form" style="background-color: #fff;">
            <!--<div style="text-align: center">Create Client Management</div>-->
            <div class="col-md-12 text-center">
                <h4 style="margin-top: 10px;"><?php echo lang('edit_country'); ?></h4>
            </div>
            <div class="col-md-6 col-sm-6 text-center" style="border-right: solid 2px #eee;">
                <div class="installation_form">
                    <!--<h4>STEP 1</h4>-->
                    <fieldset>

                        <div class="control-group<?php echo form_error('iso') ? ' has-error' : ''; ?>">
                            <?php //echo form_label('Iso', 'iso', array('class' => 'control-label col-md-6')); ?>
                            <div class='controls'>
                                <input id='iso' class='form-control input-medium' type='text' name='iso'
                                       placeholder="<?php echo lang('country_master_field_iso') ?>" title="<?php echo lang('country_master_field_iso') ?>"
                                       maxlength='2' value="<?php echo set_value('iso', isset($country_master->iso) ? $country_master->iso : ''); ?>" />
                                <label id='iso-error' class='error' for='iso'></label>
                                <span class='help-inline'><?php echo form_error('iso'); ?></span>
                            </div>
                        </div>

                        <div class="control-group<?php echo form_error('name') ? ' has-error' : ''; ?>">
                            <?php //echo form_label('Country Name'. lang('bf_form_label_required'), 'name', array('class' => 'control-label col-md-6')); ?>
                            <div class='controls'>
                                <input id='name' class='form-control input-medium' type='text' required='required' name='name'
                                       placeholder="<?php echo lang('country_master_field_name') ?>" title="<?php echo lang('country_master_field_name') ?>"
                                       maxlength='80' value="<?php echo set_value('name', isset($country_master->name) ? $country_master->name : ''); ?>" />
                                <label id='name-error' class='error' for='name'></label>
                                <span class='help-inline'><?php echo form_error('name'); ?></span>
                            </div>
                        </div>

                        <div class="control-group<?php echo form_error('printable_name') ? ' has-error' : ''; ?>">
                            <?php //echo form_label('Printable Name'. lang('bf_form_label_required'), 'printable_name', array('class' => 'control-label col-md-6')); ?>
                            <div class='controls'>
                                <input id='printable_name' class='form-control input-medium' type='text' required='required' name='printable_name'
                                       placeholder="<?php echo lang('country_master_field_printable_name') ?>" title="<?php echo lang('country_master_field_printable_name') ?>"
                                       maxlength='80' value="<?php echo set_value('printable_name', isset($country_master->printable_name) ? $country_master->printable_name : ''); ?>" />
                                <label id='printable_name-error' class='error' for='printable_name'></label>
                                <span class='help-inline'><?php echo form_error('printable_name'); ?></span>
                            </div>
                        </div>

                        <div class="control-group<?php echo form_error('iso3') ? ' has-error' : ''; ?>">
                            <?php //echo form_label('Iso3', 'iso3', array('class' => 'control-label col-md-6')); ?>
                            <div class='controls'>
                                <input id='iso3' class='form-control input-medium' type='text' name='iso3'
                                       placeholder="<?php echo lang('country_master_field_iso3') ?>" title="<?php echo lang('country_master_field_iso3') ?>"
                                       maxlength='3' value="<?php echo set_value('iso3', isset($country_master->iso3) ? $country_master->iso3 : ''); ?>" />
                                <label id='iso3-error' class='error' for='iso3'></label>
                                <span class='help-inline'><?php echo form_error('iso3'); ?></span>
                            </div>
                        </div>

                    </fieldset>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 text-center">
                <div class="installation_form">

                    <div class="control-group<?php echo form_error('numcode') ? ' has-error' : ''; ?>">
                        <?php //echo form_label('Numcode'. lang('bf_form_label_required'), 'numcode', array('class' => 'control-label col-md-6')); ?>
                        <div class='controls'>
                            <input id='numcode' class='form-control input-medium' type='text' required='required' name='numcode'
                                   placeholder="<?php echo lang('country_master_field_numcode') ?>" title="<?php echo lang('country_master_field_numcode') ?>"
                                   maxlength='6' value="<?php echo set_value('numcode', isset($country_master->numcode) ? $country_master->numcode : ''); ?>" />
                            <label id='numcode-error' class='error' for='numcode'></label>
                            <span class='help-inline'><?php echo form_error('numcode'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                        $options[1] = lang('active');
                        $options[0] = lang('inactive');
                        /*$options = array(
                            1 => 'Active',
                            0 => 'Inactive'
                        );*/ ?>
                        <?php echo form_dropdown(array('name'=>'status','title'=>lang('status')), $options, set_value('status', isset($country_master->status) ? $country_master->status : ''),
                            '',
                            'class="service-small-master form-control input-medium", style = "-webkit-appearance: none;"')?>
                        <span class="help-inline"><?php echo form_error('status'); ?></span>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 text-center ins_sv_but">
                <fieldset class='form-actions'>
                    <input type='submit' name='save' class='btn green' value="<?php echo lang('bf_action_save'); ?>" />
                    <?php echo lang('bf_or'); ?>
                    <?php echo anchor(site_url(). 'administration/country', lang('country_master_cancel'), 'class="btn default"'); ?>

                    <?php if ($this->auth->has_permission('Country_master.Country_master.Delete')) : ?>
                        <?php echo lang('bf_or'); ?>
                        <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('country_master_delete_confirm'))); ?>');">
                            <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('bf_action_delete'); ?>
                        </button>
                    <?php endif; ?>
                </fieldset>
            </div>
            <div class="clearfix"></div>
            <?php //echo form_close(); ?>
        </form>
    </div>
</div>