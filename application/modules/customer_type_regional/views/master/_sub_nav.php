<?php

$checkSegment = $this->uri->segment(4);
$areaUrl = SITE_AREA . '/master/customer_type_regional';

?>
<ul class='nav nav-pills'>
	<li<?php echo $checkSegment == '' ? ' class="active"' : ''; ?>>
		<a href="<?php echo site_url($areaUrl); ?>" id='list'>
            <?php echo lang('customer_type_regional_list'); ?>
        </a>
	</li>
	<?php if ($this->auth->has_permission('Customer_Type_Regional.Master.Create')) : ?>
	<li<?php echo $checkSegment == 'create' ? ' class="active"' : ''; ?>>
		<a href="<?php echo site_url($areaUrl . '/create'); ?>" id='create_new'>
            <?php echo lang('customer_type_regional_new'); ?>
        </a>
	</li>
	<?php endif; ?>
</ul>