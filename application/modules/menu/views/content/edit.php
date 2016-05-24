<script>
    window.urlPath = "<?php echo site_url(SITE_AREA . "/content/menu/delete"); ?>";
    window.linkTypeUrl = "<?php echo site_url(SITE_AREA . "/content/menu/get_links"); ?>";
</script>

<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>

<?php
// Change the css classes to suit your needs
//dump($this->input->post());
if (isset($menu)) {
    $menu = (array) $menu;
//    var_dump($menu);
//    var_dump($links);
//    var_dump($menu["access_role_id"]);
}
$id = isset($menu['id']) ? $menu['id'] : '';
?>
<div class="admin-box portlet box green ">
<div class="portlet-title">
    <div class="caption">
        <i class="fa fa-pencil"></i> Edit Manu
    </div>
</div>
<div class="portlet-body form">
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <input type="hidden" name="image_to_delete" value="<?php echo set_value('image_to_delete', isset($menu['image_name']) ? $menu['image_name'] : ''); ?>"/>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#general_info" data-toggle="tab">General</a></li>
        <li><a href="#seo_settings" data-toggle="tab">Seo Settings</a></li>
    </ul>

    <div id="myTabContent" class="tab-content">

        <div class="tab-pane fade active in" id="general_info">

            <div class="control-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                <?php echo form_label('Title' . lang('bf_form_label_required'), 'title', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="title" type="text" class="form-control input-medium" name="title" maxlength="255" value="<?php echo set_value('title', isset($menu['title']) ? $menu['title'] : ''); ?>"  />
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>


            </div> 
            <div class="control-group <?php echo form_error('alias') ? 'has-error' : ''; ?>">
                <?php echo form_label('Alias' . lang('bf_form_label_required'), 'alias', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="alias" type="text"  class="form-control input-medium" name="alias" maxlength="255" value="<?php echo set_value('alias', isset($menu['alias']) ? $menu['alias'] : ''); ?>"  />
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

            <?php echo form_dropdown('link_type', $options1, set_value('link_type', isset($menu['link_type']) ? $menu['link_type'] : ''), 'Link Type', "class='link-assets  form-control input-medium'") ?>

            
            <?php
                if($this->input->post()){
                    $link_type = $this->input->post("link_type");
                } else {
                    $link_type = $menu['link_type'];
                }
            ?>
            
            <div id="link-content-div" class="control-group" >
                <?php echo form_label('Link To' . lang('bf_form_label_required'), 'link', array('class' => "control-label col-md-3")); ?>
                <div class='controls' id="link-content">
                    <?php if ($link_type == 'other') : ?>
                        <input type="text"  class="form-control input-medium" name="link" value="<?php echo set_value('link', isset($menu['link']) ? $menu['link'] : ''); ?>" />
                    <?php else : ?>
                        <?php echo (isset($links) && !empty($links)) ? $links : ""; ?>
                    <?php endif; ?>
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

            <?php echo form_dropdown('parent_id', $options2, set_value('parent_id', isset($menu['parent_id']) ? $menu['parent_id'] : ''), 'Parent', "class='form-control input-medium'") ?>

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

            <?php echo form_dropdown('navigation_id', $options3, set_value('navigation_id', isset($menu['navigation_id']) ? $menu['navigation_id'] : ''), 'Navigation',"class='form-control input-medium'") ?>

            <?php // Change the values in this array to populate your dropdown as required  ?>

            <?php
            $options4 = array(
                "" => "Select Target",
                0 => "Current",
                1 => "Blank",
            );
            ?>

            <?php echo form_dropdown('window', $options4, set_value('window', isset($menu['window']) ? $menu['window'] : ''), 'Target', "class='form-control input-medium'") ?>

            <div class="control-group <?php echo form_error('image_name') ? 'error' : ''; ?>">
                <?php echo form_label('Image', 'image_name', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <?php
                        $menuimage= FCPATH."assets/uploads/menu_images/" . $menu['image_name'];
                        if(file_exists($menuimage))
                        {
                            $menuImage=base_url()."assets/uploads/menu_images/" . $menu['image_name'];
                        }
                        else{
                            $menuImage= "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
                        }
                        ?>
                        <div class="fileinput-new thumbnail" style="width: auto; height: auto;">
                            <img src="<?php echo $menuImage; ?>" alt=""/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                            <img src="<?php echo $menuImage; ?>">
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
                        <span class="help-inline"><?php echo form_error('image_name'); ?></span>
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
                    <select name="access_role_id[]"  class="form-control input-medium" id="access_role_id" multiple="true">
                        <?php
                        $selected = array();
                        if ($this->input->post("access_role_id")) {
                            $selected = $this->input->post("access_role_id");
                        } else {
                            $selected = @unserialize($menu["access_role_id"]);
                        }

                        if (is_array($roles) && count($roles)) :
                            ?>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php e($role->role_id); ?>" <?php echo set_select('access_role_id', $role->role_id, (in_array($role->role_id, $selected)) ? TRUE : FALSE) ?>><?php e(ucfirst($role->role_name)) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('access_role_id'); ?></span>
                </div>
            </div>

            <?php //echo form_dropdown('access_role_id[]', $options5, set_value('access_role_id', isset($menu['access_role_id']) ? $menu['access_role_id'] : ''), 'Access', "multiple=multiple")  ?>       
            <!--<span class="help-inline"><?php echo form_error('access_role_id'); ?></span>-->

            <?php
            $options = array(
                1 => 'Active',
                0 => 'Inactive'
            );
            ?>
            <?php echo form_dropdown('status', $options, set_value('status', isset($menu['status']) ? $menu['status'] : ''), 'Status' . lang('bf_form_label_required'),"class='form-control input-medium'") ?>
            <span class="help-inline"><?php echo form_error('status'); ?></span>
        </div>

        <div class="tab-pane fade" id="seo_settings">
            <div class="control-group <?php echo form_error('meta_title') ? 'error' : ''; ?>">

                <?php echo form_label('Meta title', 'meta_title', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="meta_title"  class="form-control input-medium" type="text" name="meta_title" maxlength="255" value="<?php echo set_value('meta_title', isset($menu['meta_title']) ? $menu['meta_title'] : ''); ?>"  />
                    <span class="help-inline"><?php echo form_error('meta_title'); ?></span>
                </div>


            </div> 
            <div class="control-group <?php echo form_error('meta_keyword') ? 'error' : ''; ?>">
                <?php echo form_label('Meta Keyword', 'meta_keyword', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="meta_keyword"  class="form-control input-medium" type="text" name="meta_keyword" maxlength="255" value="<?php echo set_value('meta_keyword', isset($menu['meta_keyword']) ? $menu['meta_keyword'] : ''); ?>"  />
                    <span class="help-inline"><?php echo form_error('meta_keyword'); ?></span>
                </div>


            </div> 
            <div class="control-group <?php echo form_error('meta_description') ? 'error' : ''; ?>">
                <?php echo form_label('Meta Description', 'meta_description', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'meta_description', 'id' => 'meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('meta_description', isset($menu['meta_description']) ? $menu['meta_description'] : ''))) ?>
                    <span class="help-inline"><?php echo form_error('meta_description'); ?></span>
                </div>

            </div> 
        </div>

    </div>

    <div class="form-actions">
        <br/>
        <input type="submit" name="save" class="btn green" value="Edit Menu" />
        or <?php echo anchor(SITE_AREA . '/content/menu', lang('menu_cancel'), 'class="btn default"'); ?>

        <?php if ($this->auth->has_permission('Menu.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('menu_delete_confirm'); ?>')">
                <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('menu_delete_record'); ?>
            </button>

        <?php endif; ?>

    </div>

    <?php echo form_close(); ?>
</div>
</div>


