<?php

$checkSegment = $this->uri->segment(4);
$areaUrl = SITE_AREA . '/master/category_regional_master';

?>
<ul class='nav nav-pills'>
	<li<?php echo $checkSegment == '' ? ' class="active"' : ''; ?>>
		<a href="<?php echo site_url($areaUrl); ?>" id='list'>
            <?php echo lang('category_regional_master_list'); ?>
        </a>
	</li>
	<?php if ($this->auth->has_permission('Category_Regional_Master.Master.Create')) : ?>
	<li<?php echo $checkSegment == 'create' ? ' class="active"' : ''; ?>>
		<a href="<?php echo site_url($areaUrl . '/create'); ?>" id='create_new'>
            <?php echo lang('category_regional_master_new'); ?>
        </a>
	</li>
	<?php endif; ?>
</ul>