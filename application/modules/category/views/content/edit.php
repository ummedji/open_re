<script>
    window.urlPath = "<?php echo base_url(SITE_AREA . "/content/category/delete"); ?>";
</script>

<?php
$config = array(
    "class" => "form-horizontal",
    'id' => "category",
    'name' => "category"
);
?>
<?php if (validation_errors() || $this->upload->display_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
        <?php echo $this->upload->display_errors() ?>
    </div>
<?php endif; ?>


<?php
// Change the css classes to suit your needs
if (isset($category)) {
    $category = (array) $category;
}
$id = isset($category['ID']) ? $category['ID'] : '';
?>
<div class="admin-box portlet box green  ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Create Category
        </div>
    </div>
    <div class="portlet-body form">
    <?php echo form_open_multipart($this->uri->uri_string(), $config); ?>
    <input type="hidden" name="image_to_delete" value="<?php echo set_value('image_to_delete', isset($category['category_image']) ? $category['category_image'] : ''); ?>"/>
    <input type="hidden" name="banner_to_delete" value="<?php echo set_value('banner_to_delete', isset($category['category_banner']) ? $category['category_banner'] : ''); ?>" />
    <input type="hidden" name="video_to_delete" value="<?php echo set_value('video_to_delete', isset($category['category_video']) ? $category['category_video'] : ''); ?>" />
    <fieldset>
        <div class="control-group <?php echo form_error('category_title') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Title' . lang('bf_form_label_required'), 'category_title', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <input id="category_title" type="text" name="category_title" class="form-control input-medium" maxlength="255" value="<?php echo set_value('category_title', isset($category['category_title']) ? $category['category_title'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('category_title'); ?></span>
            </div>


        </div>
        <div class="control-group <?php echo form_error('category_slug') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Slug' . lang('bf_form_label_required'), 'category_slug', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <input id="category_slug" type="text" class="form-control input-medium" name="category_slug" maxlength="255" value="<?php echo set_value('category_slug', isset($category['category_slug']) ? $category['category_slug'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('category_slug'); ?></span>
            </div>


        </div>

        <?php
        $options = array(
            0 => "No Parent"
        );
        ?>

        <?php
        if (isset($categories) && !empty($categories)) {
            foreach ($categories as $cate) {
                if ($cate->category_slug != $category['category_slug']) {
                    $options[$cate->ID] = $cate->category_title;
                }
            }
        }
        ?>

        <?php echo form_dropdown('category_parent_id', $options, set_value('category_parent_id', isset($category['category_parent_id']) ? $category['category_parent_id'] : ''), 'Category Parent','class="form-control input-medium"') ?>

        <div class="control-group <?php echo form_error('category_description') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Description', 'category_description', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <?php echo form_textarea(array('name' => 'category_description', 'id' => 'category_description','class'=>'form-control input-medium', 'rows' => '5', 'cols' => '80', 'value' => set_value('category_description', isset($category['category_description']) ? $category['category_description'] : ''))) ?>
                <span class="help-inline"><?php echo form_error('category_description'); ?></span>
            </div>

        </div>

        <div class="control-group <?php echo form_error('category_description') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Description', 'category_description', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <?php
                        $categoryimage= FCPATH."assets/uploads/category_images/" . $category['category_image'];
                        if(file_exists($categoryimage))
                        {
                            $categoryImage=base_url()."assets/uploads/category_images/" . $category['category_image'];
                        }
                        else{
                            $categoryImage= "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
                        }
                        ?>
                        <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                            <img src="<?php echo $categoryImage; ?>" alt=""/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                            <img src="<?php echo $categoryImage; ?>">
                        </div>
                        <div>
                                     <span class="btn default btn-file">
                                         <span class="fileinput-new">Select image </span>
                                         <span class="fileinput-exists">Change </span>
                                         <input type="file" name="category_image">
                                     </span>
                            <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                        </div>
                        <div class="help-inline">jpg,png,gif,jpeg file type allowed. Max Size:5MB.</div>
                        <span class="error"><?php echo isset($message)? $message:''?></span>
                        <span class="help-inline"><?php echo form_error('category_image'); ?></span>
                    </div>
                </div>
        </div>

        <!-- Displaying Images... -->

        <div class="control-group <?php echo form_error('category_banner') ? 'error' : ''; ?>">
            <?php echo form_label('Category Banner', 'category_banner', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <?php
                    $categorybanner= FCPATH."assets/uploads/category_banner/" . $category['category_banner'];
                    if(file_exists($categorybanner))
                    {
                        $categoryBanner=base_url()."assets/uploads/category_banner/" . $category['category_banner'];
                    }
                    else{
                        $categoryBanner= "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
                    }
                    ?>
                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                        <img src="<?php echo $categoryBanner; ?>" alt=""/>
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                        <img src="<?php echo $categoryBanner; ?>">
                    </div>
                    <div>
                                     <span class="btn default btn-file">
                                         <span class="fileinput-new">Select image </span>
                                         <span class="fileinput-exists">Change </span>
                                         <input type="file" name="category_banner">
                                     </span>
                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                    </div>
                    <div class="help-inline">jpg,png,gif,jpeg file type allowed. Max Size:5MB.</div>
                    <span class="error"><?php echo isset($message)? $message:''?></span>
                    <span class="help-inline"><?php echo form_error('category_banner'); ?></span>
                </div>
            </div>
        </div>

        <div class="control-group <?php echo form_error('category_video') ? 'error' : ''; ?>">
            <?php echo form_label('Category Video', 'category_video', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <input id="category_video" type="file" name="category_video" maxlength="255" value="<?php echo set_value('category_video', isset($category['category_video']) ? $category['category_video'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('category_video'); ?></span>
                <?php if (!empty($category['category_video'])) { ?>
                    <?php if (file_exists($module_config['category_video_path'] . DIRECTORY_SEPARATOR . $category['category_video'])) { ?>
                        <div class="video" rel="<?php echo (isset($id) && !empty($id)) ? $id : "" ?>">
                            <span><?php echo $category['category_video']; ?></span>
                            <span><a href="<?php echo base_url(SITE_AREA . "/content/category/download_file/{$category['category_video']}/category/video"); ?>" ><i class="icon-download" title="Download"></i></a></span>
                            <span><a href="javascript:void(0);"><i class="icon-remove-sign del" rel="<?php echo (isset($id) && !empty($id)) ? $id : "" ?>" type="video" title="Delete"></i></a></span>
                        </div>
                    <?php } ?>
                <?php } ?> 
            </div>
        </div>


        <?php
        $options = array(
            1 => 'Active', 0 => 'Inactive',
        );
        ?>

        <?php echo form_dropdown('category_status', $options, set_value('category_status', isset($category['category_status']) ? $category['category_status'] : ''), 'Status','class="form-control input-medium"') ?>

        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn green" value="Edit Category" />
            or <?php echo anchor(SITE_AREA . '/content/category', lang('category_cancel'), 'class="btn default"'); ?>


            <?php if ($this->auth->has_permission('Category.Content.Delete')) : ?>

                or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('category_delete_confirm'); ?>')">
                    <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('category_delete_record'); ?>
                </button>

            <?php endif; ?>
        </div>
    </fieldset>
    <?php echo form_close(); ?>
        </div>

</div>
