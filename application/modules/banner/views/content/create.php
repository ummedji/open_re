<script type="text/javascript">
    $('document').ready(function() {
   
        $("#banner").validate({
            rules: {
                description: {required: true},
                image: {
                    required: true,
                    accept: "jpg,png,gif,jpeg",
                },
            },
            messages: {
                image: {
                    accept: "jpg,png,gif,jpeg file type allowed.",
                },
            },
            submitHandler: function(form) {

                form.submit();

            }
        });
    });
</script>

<?php
$config = array('id' => 'banner', 'name' => 'banner', 'class' => 'form-horizontal');
?>
<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php
// Change the css classes to suit your needs
if (isset($banner)) {
    $banner = (array) $banner;
}
$id = isset($banner['id']) ? $banner['id'] : '';
?>
<div class="admin-box  portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Create Banner
        </div>
    </div>
    <div class="portlet-body form">
    <?php echo form_open_multipart($this->uri->uri_string(), $config); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('description') ? 'has-error' : ''; ?>">
            <?php echo form_label('Description' . lang('bf_form_label_required'), 'description', array('class' => "control-label col-md-3")); ?>
            <div class='controls'>
                <?php echo form_textarea(array('name' => 'description','class'=>'form-control input-medium ckeditor' ,'id' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description', isset($banner['description']) ? $banner['description'] : ''))) ?>
                <span class="help-inline"><?php echo form_error('description'); ?></span>
            </div>

        </div> 
        <div class="control-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
            <?php echo form_label('Image' . lang('bf_form_label_required'), 'image', array('class' => "control-label col-md-3")); ?>
                <div class="controls">
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
                                 <input type="file" name="image">
                             </span>
                            <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
                         </div>
                         <div class="help-inline">jpg,png,gif,jpeg file type allowed. Max Size:5MB.</div>
                             <span class="error"><?php echo isset($message)? $message:''?></span>
                             <span class="help-inline"><?php echo form_error('image'); ?></span></br>
                     </div>
                </div>
        </div>
        <?php
        $options = array(
            1 => 'Active',
            0 => 'Inactive'
        );
        ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($banner['status']) ? $banner['status'] : ''), 'Status' . lang('bf_form_label_required'),'class="form-control input-medium"') ?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn green" value="Create Banner" />
            or <?php echo anchor(SITE_AREA . '/content/banner', lang('banner_cancel'), 'class="btn default"'); ?>

        </div>
    </fieldset>
    <?php echo form_close(); ?>
        </div>


</div>
