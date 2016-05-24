
<script type="text/javascript" src="<?php echo base_url('assets/js/ckeditor/ckeditor.js') ?>"></script>
<?php if (validation_errors()) : ?>
    <div class="alert alert-block alert-error fade in ">
        <a class="close" data-dismiss="alert">&times;</a>
        <h4 class="alert-heading">Please fix the following errors :</h4>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<?php
// Change the css classes to suit your needs
if (isset($news_letter)) {
    $news_letter = (array) $news_letter;
}
$id = isset($news_letter['id']) ? $news_letter['id'] : '';
?>
<div class="admin-box  portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i> Create Newsletter
        </div>
    </div>
    <div class="portlet-body form">
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>    
    <input type="hidden" name="action_url" id="action_url" value="<?php echo base_url('admin/content/newsletter'); ?>" />
    <div class="newsletter_right">
        <h3>Send Mail To</h3>
        <div id="selectMailOption" class="selectMailOption" >
            <input type="radio" name="sendMailOption" value="ALL" checked="checked" />All Registered Users<br/>
<!--            <input type="radio" name="sendMailOption" value="Subscribed_user" />Subscribed User<br/>
            <input type="radio" name="sendMailOption" value="ByROLL" />Users By Roll<br/>-->

            <input type="radio" name="sendMailOption" value="Subscribed_user"/>All Subscribed User<br/>
            <input type="radio" name="sendMailOption" value="SELECTED" />Selected Subscribed User<br/>

        </div>

        <div id="sendMailContent">

        </div>

        <br/>
        <input type="submit" name="sendMail" class="btn blue" value="Save & Send Mail" />
    </div>
    <div class="newsletter_left">

        <fieldset>
            <div class="control-group">
                <?php echo form_label('Newsletter Templates', 'Newsletter Templates', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>                
                    <select name="newsTemplate" id="newsTemplate" class="form-control input-medium">
                        <option value="0">Add New Template</option>
                    <?php 
                        foreach($newstemplates as $template): ?>
                        <option value="<?php echo $template->id; ?>" <?php echo (isset($news_letter['id']) && $news_letter['id'] == $template->id) ? 'selected':''; ?>><?php echo $template->title; ?></option>                             
                    <?php endforeach; ?>
                    </select>
                </div>
            </div> 
            
            <div class="control-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                <?php echo form_label('Title' . lang('bf_form_label_required'), 'title', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <input id="title" type="text" name="title" class="form-control input-medium" maxlength="255" value="<?php echo set_value('title', isset($news_letter['title']) ? $news_letter['title'] : ''); ?>"  />
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>
            </div> 
            <div class="control-group <?php echo form_error('content') ? 'has-error' : ''; ?>">
                <?php echo form_label('Content' . lang('bf_form_label_required'), 'content', array('class' => "control-label col-md-3")); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'content', 'id' => 'content', 'rows' => '4', 'cols' => '20', 'class' => 'ckeditor', 'value' => set_value('content', isset($news_letter['content']) ? $news_letter['content'] : ''))) ?>
                    <span class="help-inline"><?php echo form_error('content'); ?></span>
                </div>
                
            </div> 

            <div class="form-actions">
                <br/>
                <input type="submit" name="save" class="btn green" value="Save" />
                <?php echo anchor(SITE_AREA . '/content/newsletter/', lang('bf_action_cancel'), 'class="btn default"'); ?>

            </div>
        </fieldset>
    </div>  
    <?php echo form_close(); ?>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){    
        $("#newsTemplate").change(function(){
          tplId = $(this).val();
          $.ajax({
                 type: "GET",
                 url: "<?php echo base_url(SITE_AREA . '/content/newsletter/getTemplate');?>",
                 data: {templateId: tplId},
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 success: function (msg) {
                        var title = "";
                        var content = "";                        
                        if(msg){
                            title = msg.title;
                            content = msg.content;
                        }
                        $('#title').val(title);
                        CKEDITOR.instances['content'].setData( content, function()
                        {
                            this.checkDirty();  // true
                        });                    
                    return false;
                 }
            });    
        });
    
    });
</script>