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
			<?php echo form_open(LOGIN_URL, array('id' => "lg_form",'autocomplete' => 'off')); ?>

				<div class="col-md-12 in_lg_form">
					<h4>Login To Your Account</h4>

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

					<div class="form-group">
						<input class="form-control" type="text" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
						<!--<input type="email"  name="email" placeholder="Username">-->
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />
					</div>
				</div>
				<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
				<div class="col-md-12">
					<div class="checkbox">
						<input id="remember_me" name="remember_me" class="styled" value="1" type="checkbox">
						<label for="remember_me">
							<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
						</label>
						<?php echo anchor('/forgot_password', lang('us_forgot_your_password'),array('class' => 'forgot_pass')); ?>
					</div>
				</div>
				<?php endif; ?>


				<div class="col-md-12 text-center">
					<input type="submit" class="btn btn-primary login_btn" name="log-me-in" id="submit" value="<?php e(lang('us_let_me_in')); ?>" tabindex="5" />
				</div>
				<div class="clearfix"></div>
			<?php echo form_close(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
