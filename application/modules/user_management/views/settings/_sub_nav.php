<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA ."/settings/{$module_config['module_name']}") ?>" id="list"><?php echo lang('user_management_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Settings.Create")) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA ."/settings/{$module_config['module_name']}/create") ?>" id="create_new"><?php echo lang('user_management_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>