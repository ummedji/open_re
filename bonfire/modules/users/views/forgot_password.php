<section class="main_login">
	<div class="login_bg"></div>
	<div class="login_bg_color"></div>
	<div class="inner_login">
		<div class="login_header text-center">
			<a href="#"><img src="<?php echo Template::theme_url('images/login_logo.png')?>" alt=""></a>
		</div>
		<div class="setting_icon">
			<div class="col-md-12 text-right"><a href="#"><img src="<?php echo Template::theme_url('images/setting_icon.png')?>" alt=""></a></div>
		</div>
		<div class="lg_form">

			<div class="col-md-12 in_lg_form">
				<h4><?php echo lang('us_reset_password'); ?></h4>
				<?php if (validation_errors()) : ?>
					<div class="alert alert-error fade in">
						<?php echo validation_errors(); ?>
					</div>
				<?php endif; ?>

				<div class="alert alert-info fade in">
					<?php echo lang('us_reset_note'); ?>
				</div>

				<?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'id'=>"forget_pass", 'autocomplete' => 'off')); ?>

				<div class="control-group <?php echo iif( form_error('email') , 'error'); ?>">
					<label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
					<input class="form-control" type="text" name="email" id="email" value="<?php echo set_value('email') ?>" />

				</div>

				<div class="control-group">
					<div class="col-md-12 text-center">
						<input class="btn btn-primary login_btn" type="submit" name="send" value="<?php e(lang('us_send_password')); ?>" />
					</div>
				</div>

				<?php echo form_close(); ?>

			</div>

		</div>
		<div class="clearfix"></div>
	</div>
</section>
