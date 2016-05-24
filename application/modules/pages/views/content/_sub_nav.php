<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/pages') ?>" id="list"><?php echo lang('bf_action_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Pages.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/pages/create') ?>" id="create_new"><?php echo lang('bf_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>