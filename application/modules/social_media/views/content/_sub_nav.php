<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/social_media') ?>" id="list"><?php echo lang('social_media_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Social_Media.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/social_media/create') ?>" id="create_new"><?php echo lang('social_media_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>