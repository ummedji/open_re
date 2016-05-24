<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/navigation') ?>" id="list"><?php echo lang('navigation_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Navigation.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/navigation/create') ?>" id="create_new"><?php echo lang('navigation_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>