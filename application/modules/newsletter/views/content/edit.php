
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($newsletter) ) {
    $newsletter = (array)$newsletter;
}
$id = isset($newsletter['ID']) ? $newsletter['ID'] : '';
?>
<div class="admin-box">
    <h3>Newsletter</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('newsletter_firstName') ? 'error' : ''; ?>">
            <?php echo form_label('First Name', 'newsletter_firstName', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="newsletter_firstName" type="text" name="newsletter_firstName" maxlength="25" value="<?php echo set_value('newsletter_firstName', isset($newsletter['newsletter_firstName']) ? $newsletter['newsletter_firstName'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('newsletter_firstName'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('newsletter_lastName') ? 'error' : ''; ?>">
            <?php echo form_label('Last Name', 'newsletter_lastName', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="newsletter_lastName" type="text" name="newsletter_lastName" maxlength="25" value="<?php echo set_value('newsletter_lastName', isset($newsletter['newsletter_lastName']) ? $newsletter['newsletter_lastName'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('newsletter_lastName'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('newsletter_emailID') ? 'error' : ''; ?>">
            <?php echo form_label('Email ID'. lang('bf_form_label_required'), 'newsletter_emailID', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="newsletter_emailID" type="text" name="newsletter_emailID" maxlength="50" value="<?php echo set_value('newsletter_emailID', isset($newsletter['newsletter_emailID']) ? $newsletter['newsletter_emailID'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('newsletter_emailID'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Newsletter" />
            or <?php echo anchor(SITE_AREA .'/content/newsletter', lang('newsletter_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Newsletter.Content.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('newsletter_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('newsletter_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
