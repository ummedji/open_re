<?php

$num_columns	= 11;
$can_delete	= $this->auth->has_permission('Customer_Type_Regional.Master.Delete');
$can_edit		= $this->auth->has_permission('Customer_Type_Regional.Master.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>

<?php if (!isset($ajax)) : ?>
<div class='admin-box'>
	<?php
        $attributes = array(
            'name' => 'admin_listing_form',
            'id' => 'admin_listing_form',
            'class'=>'form-inline'
        );
        ?>
	<?php echo form_open($this->uri->uri_string().'/index', $attributes); ?>
	<div id='ajax_loader'>
	</div>
	<div class='grid-filters'>
                        <input type="hidden" value="" name="sortby" id="sortby" class="reset-input">
                <input type="hidden" value="" name="order" id="order" class="reset-input">
                <input type="hidden" value="" name="action" id="action" class="reset-input">
        <table>
        <tr>
        <td><select name='category' class='category-dropdown reset-dropdown form-control input-small' ><option value='all'>All</option><option value='active'>Active</option><option value='inactive'>Inactive</option></select>&nbsp;</td>
        <td><td><input type='text' class='search-field reset-input form-control' rel_id='serach_filed1' name='search[customer_level]' />&nbsp;</td><td><select class='search-field-dropdown reset-dropdown form-control input-small ' rel='serach_filed1' ><option value='customer_level'>Customer Level</option><option value='customer_type_name'>Customer Type Name</option><option value='customer_type_code'>Customer Type Code</option><option value='created_by_user'>Created By</option><option value='modified_by_user'>Modified By</option></select>&nbsp;</td></td>
        <td></td>
        <td><button type='button' class='btn submit-filters' title='Find' data-original-title=''>Find</button>&nbsp;</td>
        <td><button type='button' class='btn reset-filters' title='Reset' data-original-title=''>Reset</button>&nbsp;</td>
        <td>
            <?php if ($can_delete) : ?>
                <button type='button' class='btn delete-selected btn-danger' title='Delete Selected' data-original-title=''>Delete Selected</button>&nbsp;
            <?php endif; ?>
        </td>
        </tr>
        </table>
        </div>

        <div id='table_content'>
        <?php endif; ?>
		<table class='table table-striped table-bordered table-hover dataTable no-footer'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('customer_type_regional_field_customer_level'); ?>                        <i class="icon-arrow-up sort" rel="asc" for="customer_level" title="Asc" effect="tooltip"></i>
                        <i class="icon-arrow-down sort" rel="desc" for="customer_level" title="Desc" effect="tooltip"></i></th>
					<th><?php echo lang('customer_type_regional_field_customer_type_name'); ?>                        <i class="icon-arrow-up sort" rel="asc" for="customer_type_name" title="Asc" effect="tooltip"></i>
                        <i class="icon-arrow-down sort" rel="desc" for="customer_type_name" title="Desc" effect="tooltip"></i></th>
					<th><?php echo lang('customer_type_regional_field_customer_type_code'); ?>                        <i class="icon-arrow-up sort" rel="asc" for="customer_type_code" title="Asc" effect="tooltip"></i>
                        <i class="icon-arrow-down sort" rel="desc" for="customer_type_code" title="Desc" effect="tooltip"></i></th>
					<th><?php echo lang('customer_type_regional_field_customer_type_description'); ?></th>
					<th><?php echo lang('customer_type_regional_field_created_by_user'); ?>                        <i class="icon-arrow-up sort" rel="asc" for="created_by_user" title="Asc" effect="tooltip"></i>
                        <i class="icon-arrow-down sort" rel="desc" for="created_by_user" title="Desc" effect="tooltip"></i></th>
					<th><?php echo lang('customer_type_regional_field_modified_by_user'); ?>                        <i class="icon-arrow-up sort" rel="asc" for="modified_by_user" title="Asc" effect="tooltip"></i>
                        <i class="icon-arrow-down sort" rel="desc" for="modified_by_user" title="Desc" effect="tooltip"></i></th>
					<th><?php echo lang('customer_type_regional_column_deleted'); ?></th>
					<th><?php echo lang('customer_type_regional_column_created'); ?></th>
					<th><?php echo lang('customer_type_regional_column_modified'); ?></th><th>Status</th><th>Action</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php
                        if (isset($pagination)) {
                            echo $pagination;
                        }
                        ?>
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->customer_type_id; ?>' /></td>
					<?php endif;?>
					
					<td><?php e($record->customer_level); ?></td>
					<td><?php e($record->customer_type_name); ?></td>
					<td><?php e($record->customer_type_code); ?></td>
					<td><?php e($record->customer_type_description); ?></td>
					<td><?php e($record->created_by_user); ?></td>
					<td><?php e($record->modified_by_user); ?></td>
					<td><?php echo $record->deleted > 0 ? lang('customer_type_regional_true') : lang('customer_type_regional_false'); ?></td>
					<td><?php echo show_formatted_date($record->created_on); ?></td>
					<td><?php echo show_formatted_date($record->modified_on); ?></td>                <?php
                            if ($record->status == 1) {
                                $status = "Active";
                                $btn_status = "Inactive";
                                $class = "success";
                            } else {
                                $status = "Inactive";
                                $btn_status = "Active";
                                $class = "warning";
                            }
                            ?>
                            <td><span style="cursor: pointer;" class="badge badge-<?php echo $class; ?> toggle_status" rel_id="<?php echo $record->customer_type_id; ?>" ><?php echo $status ?></span></td>            <td>
            <?php if ($can_edit) : ?>
                <?php echo anchor(SITE_AREA .'/master/customer_type_regional/edit/'.$record->customer_type_id, '<i class="glyphicon glyphicon-edit" title="Edit" effect="tooltip" >&nbsp;</i>') ?>&nbsp;&nbsp;
            <?php endif;?>
            <?php if (($can_delete) && isset($records) && is_array($records) && count($records)) : ?>
                <span style="cursor: pointer;" class="delete" data-original-title="" title="" rel="<?php echo $record->customer_type_id;  ?>"><i class="glyphicon glyphicon-trash" title="Delete" effect="tooltip" >&nbsp;</i></span>&nbsp;&nbsp;
            <?php endif;?>
            </td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('customer_type_regional_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
		<?php if (!isset($ajax)) : ?>
		<?php echo form_close(); ?>
    </div>
</div>
<?php endif; ?>