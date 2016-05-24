
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($menu) ) {
    $menu = (array)$menu;
}
$id = isset($menu['id']) ? $menu['id'] : '';
?>
<div class="admin-box">
    <h3>Menu</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('title') ? 'error' : ''; ?>">
            <?php echo form_label('Title'. lang('bf_form_label_required'), 'title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="title" type="text" name="title" maxlength="255" value="<?php echo set_value('title', isset($menu['title']) ? $menu['title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('title'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('alias') ? 'error' : ''; ?>">
            <?php echo form_label('Alias'. lang('bf_form_label_required'), 'alias', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="alias" type="text" name="alias" maxlength="255" value="<?php echo set_value('alias', isset($menu['alias']) ? $menu['alias'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('alias'); ?></span>
        </div>


        </div> 


        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                255 => 255,
); ?>

        <?php echo form_dropdown('link', $options, set_value('link', isset($menu['link']) ? $menu['link'] : ''), 'Link'. lang('bf_form_label_required'))?>

        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                11 => 11,
); ?>

        <?php echo form_dropdown('parent_id', $options, set_value('parent_id', isset($menu['parent_id']) ? $menu['parent_id'] : ''), 'Parent')?>

        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                11 => 11,
); ?>

        <?php echo form_dropdown('navigation_id', $options, set_value('navigation_id', isset($menu['navigation_id']) ? $menu['navigation_id'] : ''), 'Navigation')?>

        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                1 => 1,
); ?>

        <?php echo form_dropdown('window', $options, set_value('window', isset($menu['window']) ? $menu['window'] : ''), 'Target Window')?>        <div class="control-group <?php echo form_error('image_name') ? 'error' : ''; ?>">
            <?php echo form_label('Image', 'image_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="image_name" type="text" name="image_name" maxlength="255" value="<?php echo set_value('image_name', isset($menu['image_name']) ? $menu['image_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('image_name'); ?></span>
        </div>


        </div> 


        <?php // Change the values in this array to populate your dropdown as required ?>

<?php $options = array(
                11 => 11,
); ?>

        <?php echo form_dropdown('access_role_id', $options, set_value('access_role_id', isset($menu['access_role_id']) ? $menu['access_role_id'] : ''), 'Access'. lang('bf_form_label_required'))?>        <div class="control-group <?php echo form_error('meta_title') ? 'error' : ''; ?>">
            <?php echo form_label('Meta title', 'meta_title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="meta_title" type="text" name="meta_title" maxlength="255" value="<?php echo set_value('meta_title', isset($menu['meta_title']) ? $menu['meta_title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('meta_title'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('meta_keyword') ? 'error' : ''; ?>">
            <?php echo form_label('Meta Keyword', 'meta_keyword', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="meta_keyword" type="text" name="meta_keyword" maxlength="255" value="<?php echo set_value('meta_keyword', isset($menu['meta_keyword']) ? $menu['meta_keyword'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('meta_keyword'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('meta_description') ? 'error' : ''; ?>">
            <?php echo form_label('Meta Description', 'meta_description', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'meta_description', 'id' => 'meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('meta_description', isset($menu['meta_description']) ? $menu['meta_description'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('meta_description'); ?></span>
        </div>

        </div> 

        <?php 
        $options = array(
                1 => 'Active',
                0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($menu['status']) ? $menu['status'] : ''), 'Status'. lang('bf_form_label_required'))?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>
        


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Menu" />
            or <?php echo anchor(SITE_AREA .'/settings/menu', lang('menu_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Menu.Settings.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('menu_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('menu_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
