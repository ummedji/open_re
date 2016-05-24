<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/menu') ?>" id="list"><?php echo lang('menu_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Menu.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/menu/create') ?>" id="create_new"><?php echo lang('menu_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>