<script type="text/javascript">
    $('document').ready(function(){
    // Setup form validation on the #register-form element
    $("#socialmedia").validate({
    // Specify the validation rules
  
    rules: {
    label:{required:true},
    link: {required: true,
        url:true},
    image:{
        //accept: "jpg,png,gif,jpeg"
    },
  },
 
    // Specify the validation error messages

    messages: {

    label: {
    required: "This field is required"

    },
    link: {
    required: "This field is required",
     url: "Please enter a valid URL.",
    },
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
<style type="text/css">
    .error{
        color: red;
    }
</style>
<?php
    	$config = array(
			"class" => "form-horizontal",
			'id'    => "socialmedia",
			'name'    =>"socialmedia"
		);
                
	?>
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($social_media) ) {
    $social_media = (array)$social_media;
}
$id = isset($social_media['id']) ? $social_media['id'] : '';
?>
<div class="admin-box  portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Edit Social Media
        </div>
    </div>
    <div class="portlet-body form">
<?php echo form_open_multipart($this->uri->uri_string(),$config); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('label') ? 'has-error' : ''; ?>">
            <?php echo form_label('Label'. lang('bf_form_label_required'), 'label', array('class' => "control-label col-md-3") ); ?>
            <div class='controls'>
        <input id="label" type="text" class="form-control input-medium" name="label" maxlength="100" value="<?php echo set_value('label', isset($social_media['label']) ? $social_media['label'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('label'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('link') ? 'error' : ''; ?>">
            <?php echo form_label('Link'. lang('bf_form_label_required'), 'link', array('class' => "control-label col-md-3") ); ?>
            <div class='controls'>
        <input id="link" type="text" name="link" class="form-control input-medium" maxlength="255" value="<?php echo set_value('link', isset($social_media['link']) ? $social_media['link'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('link'); ?></span>
        </div>


        </div> 
        <div class="control-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
            <?php echo form_label('Image'. lang('bf_form_label_required'), 'image', array('class' => "control-label col-md-3") ); ?>
            <div class='controls'>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <?php
                    $imagepath=FCPATH."assets/uploads/socialmedia/".$social_media['image'];
                    if(file_exists($imagepath))
                    {

                        $imagename= base_url()."assets/uploads/socialmedia/".$social_media['image'];
                    }else{
                        $imagename=  "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image";
                    }
                    ?>
                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                        <img src="<?php echo $imagename; ?>" alt=""/>
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                        <img src="<?php echo $imagename; ?>">
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
                    <span class="help-inline"><?php echo form_error('image'); ?></span><br/>
                    <div style="color:red;padding-left:-9px;"><?php if(isset($check) && !empty($check)){echo $check;} ?></div>
                </div>
            </div>
        </div> 

        <?php 
        $options = array(
                1 => 'Active',
                0 => 'Inactive'
        ); ?>
        <?php echo form_dropdown('status', $options, set_value('status', isset($social_media['status']) ? $social_media['status'] : ''), 'Status'. lang('bf_form_label_required'),'class="form-control input-medium"')?>
        <span class="help-inline"><?php echo form_error('status'); ?></span>
        


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn green" value="Edit Social Media" />
            or <?php echo anchor(SITE_AREA .'/content/social_media', lang('social_media_cancel'), 'class="btn default"'); ?>
            

    <?php if ($this->auth->has_permission('Social_Media.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('social_media_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('social_media_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>
        </div>


</div>
