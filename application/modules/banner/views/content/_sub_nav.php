<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/banner') ?>" id="list"><?php echo lang('banner_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Banner.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/banner/create') ?>" id="create_new"><?php echo lang('banner_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>