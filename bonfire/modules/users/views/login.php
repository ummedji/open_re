<section class="new_login">
	<div class="left_lg"><a href="#"><img src="<?php echo Template::theme_url('images/login_logo_.png')?>" alt=""></a></div>
	<div class="right_lg">

		<div class="setting_sp"><a href="#"><img src="<?php echo Template::theme_url('images/setting_icon_white.png')?>" alt=""></a></div>
		<div class="login">
			<?php echo form_open(LOGIN_URL, array('id' => "lg_form",'autocomplete' => 'off')); ?>
			<?php echo Template::message(); ?>
			<?php
			if (validation_errors()) :
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="alert alert-error fade in">
							<a data-dismiss="alert" class="close">&times;</a>
							<?php echo validation_errors(); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<label id="login-error" class="error" for=""></label>
			<p>
				<label for="login_value"><img src="<?php echo Template::theme_url('images/email_icon.png')?>" alt="">Email:</label>
				<input  type="text" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
			</p>

			<p>
				<label for="password"><img src="<?php echo Template::theme_url('images/password_icon.png')?>" alt="">Password:</label>
				<input  type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />
			</p>
			<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
			<div class="ckbx_sp">
				<div class="checkbox">
					<input id="remember_me" name="remember_me" class="styled" value="1" type="checkbox">
					<label for="remember_me">
						<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
					</label>
					<?php echo anchor('/forgot_password', lang('us_forgot_your_password'),array('class' => 'forgot_pass')); ?>
				</div>
			</div>
			<?php endif; ?>


			<p class="login-submit">
				<button type="submit" class="login-button" name="log-me-in" id="submit" value="<?php e(lang('us_let_me_in')); ?>" tabindex="5"></button>
			</p>

			<?php echo form_close(); ?>
			<div class="clearfix"></div>
		</div>
	</div>
</section>
