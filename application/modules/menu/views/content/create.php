<script>
    window.linkTypeUrl = "<?php echo site_url(SITE_AREA . "/content/menu/get_links"); ?>";
</script>

<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-danger fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php
// Change the css classes to suit your needs
if (isset($menu)) {
    $menu = (array)$menu;
//    var_dump($roles);
}
$id = isset($menu['id']) ? $menu['id'] : '';
?>
<div class="admin-box portlet box green ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Create manu
        </div>
    </div>
    <div class="portlet-body form">
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#general_info" data-toggle="tab">General</a></li>
        <li><a href="#seo_settings" data-toggle="tab">Seo Settings</a></li>
    </ul>

    <div id="myTabContent" class="tab-content">

        <div class="tab-pane fade active in" id="general_info">

            <div class="control-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                <?php echo form_label('Title' . lang('bf_form_label_required'), 'title', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <div class="input-icon right">
                        <?php echo form_error('category_title') ? '<i class="fa fa-warning" data-original-title="This field is required."></i>' : ''; ?>
                    <input id="title" type="text" name="title" maxlength="255" class="form-control input-medium"
                           value="<?php echo set_value('title', isset($menu['title']) ? $menu['title'] : ''); ?>"/>
                    </div>
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>


            </div>
            <div class="control-group <?php echo form_error('alias') ? 'has-error' : ''; ?>">
                <?php echo form_label('Alias' . lang('bf_form_label_required'), 'alias', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <div class="input-icon right">
                        <?php echo form_error('category_title') ? '<i class="fa fa-warning" data-original-title="This field is required."></i>' : ''; ?>
                    <input id="alias" type="text" name="alias" maxlength="255" class="form-control input-medium"
                           value="<?php echo set_value('alias', isset($menu['alias']) ? $menu['alias'] : ''); ?>"/>
                   </div>
                    <span class="help-inline"><?php echo form_error('alias'); ?></span>
                </div>


            </div>


            <?php // Change the values in this array to populate your dropdown as required ?>

            <?php
            $options1 = array(
                "" => "Select Link Type",
                "page" => "Pages",
                "cats" => "Category",
                "mod" => "Module",
                "other" => "External Link"
            );
            ?>

            <?php echo form_dropdown("link_type", $options1, set_value('link_type', isset($menu['link_type']) ? $menu['link_type'] : ''), 'Link Type', "class='link-assets form-control input-medium'") ?>

            <div id="link-content-div"
                 class="control-group" <?php echo ($this->input->post("link_type")) ? "" : "style=display: none;"; ?>>
                <?php echo form_label('Link To' . lang('bf_form_label_required'), 'link', array('class' => "control-label col-md-3")); ?>
                <div class='controls' id="link-content">
                    <div id="link-content">
                        <?php if (isset($link_type) && isset($links)) : ?>
                            <?php if ($link_type == 'other') : ?>
                                <input type="text" class="form-control input-medium" name="link"  value="<?php echo set_value('link', $this->input->post("link")); ?>"/>
                            <?php else : ?>
                                <?php echo (isset($links) && !empty($links)) ? $links : ""; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <span class="help-inline"><?php echo form_error('link'); ?></span>
                </div>
            </div>


            <?php
            $options2 = array(
                0 => "No Parent",
            );
            ?>

            <?php
            if (isset($parent_menus) && !empty($parent_menus)) {
                foreach ($parent_menus as $m) {
                    $options2[$m->id] = $m->title;
                }
            }
            ?>

            <?php echo form_dropdown(array('class' => "form-control input-medium",'name'=>"parent_id", 'id'=>'parent_id'), $options2, set_value('parent_id', isset($menu['parent_id']) ? $menu['parent_id'] : ''), 'Parent') ?>

            <?php // Change the values in this array to populate your dropdown as required ?>

            <?php
            $options3 = array(
                "" => "Select Navigation"
            )
            ?>

            <?php
            if (isset($nav_bars) && !empty($nav_bars)) {
                foreach ($nav_bars as $n) {
                    $options3[$n->id] = $n->title;
                }
            }
            ?>

            <?php echo form_dropdown(array('class' => "form-control input-medium",'name'=>"navigation_id", 'id'=>'navigation_id'), $options3, set_value('navigation_id', isset($menu['navigation_id']) ? $menu['navigation_id'] : ''), 'Navigation' . lang('bf_form_label_required')) ?>

            <?php // Change the values in this array to populate your dropdown as required  ?>

            <?php
            $options4 = array(
                "" => "Select Target",
                0 => "Current",
                1 => "Blank",
            );
            ?>

            <?php echo form_dropdown(array('class' => "form-control input-medium",'name'=>"window", 'id'=>'window'), $options4, set_value('window', isset($menu['window']) ? $menu['window'] : ''), 'Target') ?>

            <div class="control-group <?php echo form_error('image_name') ? 'error' : ''; ?>">
                <?php echo form_label('Image', 'image_name', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                        </div>
                        <div>
                             <span class="btn default btn-file">
                                 <span class="fileinput-new">Select image </span>
                                 <span class="fileinput-exists">Change </span>
                                 <input type="file" name="image_name">
                             </span>
                            <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                        </div>
                        <div class="help-inline">jpg,png,gif,jpeg file type allowed. Max Size:5MB.</div>
                        <span class="error"><?php echo isset($message)? $message:''?></span>
                        <span class="help-inline"><?php echo form_error('image_name'); ?></span></br>
                    </div>
                </div>
            </div>


            <?php // Change the values in this array to populate your dropdown as required  ?>

            <?php $options5 = array(); ?>

            <?php
            if (isset($roles) && !empty($roles)) {
                foreach ($roles as $r) {
                    $options5[$r->role_id] = $r->role_name;
                }
            }
            ?>

            <div class="control-group">
                <label class="control-label col-md-3" for="access_role_id">Roles</label>

                <div class="controls">
                    <select name="access_role_id[]" class="form-control input-medium" id="access_role_id" multiple="true">
                        <?php
                        if (is_array($roles) && count($roles)) :
                            $i = 0;
                            ?>
                            <?php foreach ($roles as $role):
                            $selected = FALSE;
                            if ($i == 0) {
                                $selected = TRUE;
                            }
                            ?>
                            <option
                                value="<?php e($role->role_id); ?>" <?php echo set_select('access_role_id', $role->role_id, $selected) ?>><?php e(ucfirst($role->role_name)) ?></option>
                            <?php
                            $i++;
                        endforeach;
                            ?>
                        <?php endif; ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('access_role_id'); ?></span>
                </div>
            </div>

            <?php //echo form_dropdown('access_role_id[]', $options5, set_value('access_role_id', isset($menu['access_role_id']) ? $menu['access_role_id'] : ''), 'Access', "multiple=multiple") ?>
            <!--<span class="help-inline"><?php echo form_error('access_role_id'); ?></span>-->

            <?php
            $options = array(
                1 => 'Active',
                0 => 'Inactive'
            );
            ?>
            <?php echo form_dropdown(array('class' => "form-control input-medium",'name'=>"status", 'id'=>'status'), $options, set_value('status', isset($menu['status']) ? $menu['status'] : ''), 'Status' . lang('bf_form_label_required')) ?>
            <span class="help-inline"><?php echo form_error('status'); ?></span>


        </div>

        <div class="tab-pane fade" id="seo_settings">
            <div class="control-group <?php echo form_error('meta_title') ? 'error' : ''; ?>">

                <?php echo form_label('Meta title', 'meta_title', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="meta_title" type="text" name="meta_title" maxlength="255" class="form-control input-medium"
                           value="<?php echo set_value('meta_title', isset($menu['meta_title']) ? $menu['meta_title'] : ''); ?>"/>
                    <span class="help-inline"><?php echo form_error('meta_title'); ?></span>
                </div>


            </div>
            <div class="control-group <?php echo form_error('meta_keyword') ? 'error' : ''; ?>">
                <?php echo form_label('Meta Keyword', 'meta_keyword', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="meta_keyword" type="text" name="meta_keyword" maxlength="255" class="form-control input-medium"
                           value="<?php echo set_value('meta_keyword', isset($menu['meta_keyword']) ? $menu['meta_keyword'] : ''); ?>"/>
                    <span class="help-inline"><?php echo form_error('meta_keyword'); ?></span>
                </div>


            </div>
            <div class="control-group <?php echo form_error('meta_description') ? 'error' : ''; ?>">
                <?php echo form_label('Meta Description', 'meta_description', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'meta_description', 'class' => 'form-control input-medium', 'id' => 'meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('meta_description', isset($menu['meta_description']) ? $menu['meta_description'] : ''))) ?>
                    <span class="help-inline"><?php echo form_error('meta_description'); ?></span>
                </div>

            </div>
        </div>

    </div>

    <div class="form-actions">
        <br/>
        <input type="submit" name="save" class="btn green" value="Create Menu"/>
        or <?php echo anchor(SITE_AREA . '/content/menu', lang('menu_cancel'), 'class="btn default"'); ?>

    </div>

    <?php echo form_close(); ?>
</div>
</div>


