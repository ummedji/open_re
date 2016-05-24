
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($navigation) ) {
    $navigation = (array)$navigation;
}
$id = isset($navigation['id']) ? $navigation['id'] : '';
?>
<div class="admin-box">
    <h3>Navigation</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('title') ? 'error' : ''; ?>">
            <?php echo form_label('Title'. lang('bf_form_label_required'), 'title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="title" type="text" name="title" maxlength="255" value="<?php echo set_value('title', isset($navigation['title']) ? $navigation['title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('title'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('position') ? 'error' : ''; ?>">
            <?php echo form_label('Position'. lang('bf_form_label_required'), 'position', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="position" type="text" name="position" maxlength="255" value="<?php echo set_value('position', isset($navigation['position']) ? $navigation['position'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('position'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('description') ? 'error' : ''; ?>">
            <?php echo form_label('Description', 'description', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'description', 'id' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description', isset($navigation['description']) ? $navigation['description'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('description'); ?></span>
        </div>

        </div> 

        <?php 
        $options = array(
                1 => 'Active',
                0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($navigation['status']) ? $navigation['status'] : ''), 'Status'. lang('bf_form_label_required'))?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>
        


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Navigation" />
            or <?php echo anchor(SITE_AREA .'/settings/navigation', lang('navigation_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
