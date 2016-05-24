<?php

$hiddenFields = array('customer_type_id', 'deleted',);
?>
<h1 class='page-header'>
    <?php echo lang('customer_type_regional_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Customer Level</th>
            <th>Customer Type Name</th>
            <th>Customer Type Code</th>
            <th>Customer Type Description</th>
            <th>Created By</th>
            <th>Modified By</th>
            <th><?php echo lang('customer_type_regional_column_created'); ?></th>
            <th><?php echo lang('customer_type_regional_column_modified'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($records as $record) :
        ?>
        <tr>
            <?php
            foreach($record as $field => $value) :
                if ( ! in_array($field, $hiddenFields)) :
            ?>
            <td>
                <?php
                if ($field == 'deleted') {
                    e(($value > 0) ? lang('customer_type_regional_true') : lang('customer_type_regional_false'));
                } else {
                    e($value);
                }
                ?>
            </td>
            <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

endif; ?>