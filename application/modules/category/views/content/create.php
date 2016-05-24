<?php if (validation_errors() || $this->upload->display_errors()) : ?>
    <div class="alert alert-danger display-block">
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
<style type>
    .error{
        color:red;
    }
</style>

<?php
$config = array(
    "class" => "form-horizontal",
    'id' => "category",
    'name' => "category"
);
?>
<div class="admin-box portlet box green  ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Create Category
        </div>
    </div>
    <div class="portlet-body form">
    <?php echo form_open_multipart($this->uri->uri_string(), $config); ?>
    <div class="form-body">
        <div class="control-group <?php echo form_error('category_title') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Title' . lang('bf_form_label_required'), 'category_title', array('class' => "control-label col-md-3")); ?>
            <div class='controls '>
                <div class="input-icon right">
                    <?php echo form_error('category_title') ? '<i class="fa fa-warning" data-original-title="This field is required."></i>' : ''; ?>
                    <input id="category_title" class="form-control input-medium" type="text" name="category_title" maxlength="255" value="<?php echo set_value('category_title', isset($category['category_title']) ? $category['category_title'] : ''); ?>"  />
                </div>
                <span class="help-inline"><?php echo form_error('category_title'); ?></span>
                </div>


        </div>
        <div class="control-group <?php echo form_error('category_slug') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Slug' . lang('bf_form_label_required'), 'category_slug', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <div class="input-icon right">

                    <?php echo form_error('category_title') ? '<i class="fa fa-warning" data-original-title="This field is required."></i>' : ''; ?>
                </div>
                <input id="category_slug" class="form-control input-medium" type="text" name="category_slug" maxlength="255" value="<?php echo set_value('category_slug', isset($category['category_slug']) ? $category['category_slug'] : ''); ?>"  />
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
                $options[$cate->ID] = $cate->category_title;
            }
        }
        ?>
<!--        <div class="control-group ">-->
<!--            --><?php //echo form_label('Parent Category', 'category_parent_id', array('class' => "control-label col-md-3")); ?>
<!--<div>-->
        <?php echo form_dropdown(array('class' => "form-control input-medium",'name'=>"category_parent_id"), $options, set_value('category_parent_id', isset($category['category_parent_id']) ? $category['category_parent_id'] : ''),'Parent Category') ?>
<!--    </div>-->
<!--        </div>-->
        <div class="control-group <?php echo form_error('category_description') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Description', 'category_description', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <?php echo form_textarea(array('name' => 'category_description', 'class' => "form-control input-medium",'id' => 'category_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('category_description', isset($category['category_description']) ? $category['category_description'] : ''))) ?>
                <span class="help-inline"><?php echo form_error('category_description'); ?></span>
            </div>

        </div>

        <div class="control-group <?php echo form_error('category_image') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Image', 'category_image', array('class' => "control-label col-md-3")); ?>
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
                                 <input type="file" name="category_image">
                             </span>
                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                    </div>
                    <div class="help-inline">jpg,png,gif,jpeg file type allowed. Max Size:5MB.</div>
                    <span class="help-inline"><?php echo form_error('category_image'); ?></span>
                </div>
<!--                <input id="category_image"  type="file" name="category_image" maxlength="255" value="--><?php //echo set_value('category_image', isset($category['category_image']) ? $category['category_image'] : ''); ?><!--"  />-->
<!---->
<!--                <span class="help-inline">--><?php //echo form_error('category_image'); ?><!--</span>-->
            </div>
        </div>

        <div class="control-group <?php echo form_error('category_banner') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Banner', 'category_banner', array('class' => "control-label col-md-3")); ?>
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
                                 <input type="file" name="category_banner">
                             </span>
                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                    </div>
                    <div class="help-inline">jpg,png,gif,jpeg file type allowed. Max Size:5MB.</div>
                    <span class="help-inline"><?php echo form_error('category_banner'); ?></span>
                </div>
<!--                <input id="category_image" type="file" name="category_banner" maxlength="255" value="--><?php //echo set_value('category_banner', isset($category['category_image']) ? $category['category_banner'] : ''); ?><!--"  />-->
<!--                <span class="help-inline">--><?php //echo form_error('category_banner'); ?><!--</span>-->
            </div>
        </div>

        <div class="control-group <?php echo form_error('category_video') ? 'has-error' : ''; ?>">
            <?php echo form_label('Category Video', 'category_video', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <input id="category_video" type="file" name="category_video" maxlength="255" value="<?php echo set_value('category_video', isset($category['category_video']) ? $category['category_video'] : ''); ?>"  />
                <span class="help-inline"><?php echo form_error('category_video'); ?></span>
            </div>


        </div>
        
        <!--Start:Here Add Metafield:chiragprajapati-->

        <!--Start:Here Add Metafield:chiragprajapati-->

        <?php // Change the values in this array to populate your dropdown as required  ?>

        <?php
        $options = array(
            1 => 'Active', 0 => 'Inactive',
        );
        ?>

        <?php echo form_dropdown(array('name'=>'category_status','id' =>'category_status','class'=>'form-control input-medium'), $options, set_value('category_status', isset($category['category_status']) ? $category['category_status'] : ''), 'Status') ?>
</div>
        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn green" value="Create Category" />
            or <?php echo anchor(SITE_AREA . '/content/category', lang('category_cancel'), 'class="btn default"'); ?>
        </div>
        </div>
    <?php echo form_close(); ?>

</div>
