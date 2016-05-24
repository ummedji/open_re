
<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php
// Change the css classes to suit your needs
if (isset($navigation)) {
    $navigation = (array) $navigation;
}
$id = isset($navigation['id']) ? $navigation['id'] : '';
?>
<div class="admin-box portlet box green ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Edit Navigation
        </div>
    </div>
    <div class="portlet-body form">
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
            <?php echo form_label('Title' . lang('bf_form_label_required'), 'title', array('class' => "control-label  col-md-3")); ?>
            <div class='controls'>
                <input id="title" type="text" class="form-control input-medium" name="title" maxlength="255" value="<?php echo set_value('title', isset($navigation['title']) ? $navigation['title'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('title'); ?></span>
            </div>


        </div> 
        <div class="control-group <?php echo form_error('position') ? 'has-error' : ''; ?>">
            <?php echo form_label('Position' . lang('bf_form_label_required'), 'position', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <input id="position" class="form-control input-medium"  readonly="true" type="text" name="position" maxlength="255" value="<?php echo set_value('position', isset($navigation['position']) ? $navigation['position'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('position'); ?></span>
            </div>


        </div> 
        <div class="control-group <?php echo form_error('description') ? 'has-error' : ''; ?>">
            <?php echo form_label('Description', 'description', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <?php echo form_textarea(array('name' => 'description','class'=>'form-control input-medium', 'id' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description', isset($navigation['description']) ? $navigation['description'] : ''))) ?>
                <span class="help-inline"><?php echo form_error('description'); ?></span>
            </div>

        </div> 

        <?php
        $options = array(
            1 => 'Active',
            0 => 'Inactive'
        );
        ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($navigation['status']) ? $navigation['status'] : ''), 'Status' . lang('bf_form_label_required'),"class='form-control input-medium'") ?>


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn green" value="Edit Navigation" />
            or <?php echo anchor(SITE_AREA . '/content/navigation', lang('navigation_cancel'), 'class="btn default"'); ?>


            <?php if ($this->auth->has_permission('Navigation.Content.Delete')) : ?>

                or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('navigation_delete_confirm'); ?>')">
                    <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('navigation_delete_record'); ?>
                </button>

            <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>

</div>
