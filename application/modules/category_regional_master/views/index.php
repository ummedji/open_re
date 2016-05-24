<?php

$hiddenFields = array('category_id', 'deleted',);
?>
<h1 class='page-header'>
    <?php echo lang('category_regional_master_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Category Name</th>
            <th>Category Code</th>
            <th>Applicable Category</th>
            <th>Created By</th>
            <th>Modified By</th>
            <th><?php echo lang('category_regional_master_column_created'); ?></th>
            <th><?php echo lang('category_regional_master_column_modified'); ?></th>
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
                    e(($value > 0) ? lang('category_regional_master_true') : lang('category_regional_master_false'));
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