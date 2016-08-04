<?php
$seg1 = $this->uri->segment(1);
$seg2 = $this->uri->segment(2);
?>

<li class="<?php echo ($seg1=='ecp' && ($seg2=='activity_planning')) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/activity_planning'); ?>"><a href="<?php echo base_url('ecp/activity_planning') ?>">Planning</a>
</li>
<li class="<?php echo ($seg1=='ecp' && ($seg2=='activity_execution')) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/activity_execution') ?>">Execution</a></li>

<li class="<?php echo ($seg1=='ecp' && ($seg2=='activity_unplanned')) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/activity_unplanned') ?>">Unplanned</a></li>

<li class="<?php echo ($seg1=='ecp' && ($seg2=='activity_view')) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/activity_view') ?>">View</a></li>
