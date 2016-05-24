<!--<a href="<?php /*echo site_url('/master/product/create'); */?>">Create</a>-->
<div class="cl-md-12 text-center main_add_sp crt_btn">
    <a class="add_btn" href="<?php echo site_url('/administration/country/create'); ?>">
        <span><i class="fa fa-plus-circle"></i></span><?php echo lang('add');?>
    </a>
</div>
<?php

$num_columns	= 7;
$can_delete	= $this->auth->has_permission('Country_Master.Country_Master.Delete');
$can_edit		= $this->auth->has_permission('Country_Master.Country_Master.Edit');
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
	<div class='grid-filters' style="padding-top: 10px;">
        <input type="hidden" value="" name="sortby" id="sortby" class="reset-input">
        <input type="hidden" value="" name="order" id="order" class="reset-input">
        <input type="hidden" value="" name="action" id="action" class="reset-input">
        <div class="iner_pagenation">
            <div class="inn_grid_cl">
                <div class="all_sl_btn">
                    <select name='category' class='service-small-filter-drp category-dropdown reset-dropdown form-control input-small' >
                        <option value='all'><?php echo lang('all'); ?></option>
                        <option value='active'><?php echo lang('active'); ?></option>
                        <option value='inactive'><?php echo lang('inactive'); ?></option>
                    </select>
                </div>
                <div class="grid_search">
                    <input type='text' class='service-small-filter search-field reset-input form-control' rel_id='serach_filed1' name='search[name]' />&nbsp;
                </div>
                <div class="client_sl_btn">
                    <select class='service-small-filter-drp search-field-dropdown reset-dropdown form-control input-small ' rel='serach_filed1' style="width: 145px;" >
                        <option value='name'><?php echo lang('country_master_field_name'); ?></option>
                        <option value='printable_name'><?php echo lang('country_master_field_printable_name'); ?></option>
                    </select>&nbsp;
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-5 pad_none">
                <button type='button' class='btn submit-filters' title='Find' data-original-title=''><?php echo lang('find') ?></button>
                <button type='button' class='btn reset-filters' title='Reset' data-original-title=''><?php echo lang('reset') ?></button>
                <?php if ($can_delete) : ?>
                    <button type='button' class='btn delete-selected btn-danger' title='Delete Selected' data-original-title=''><?php echo lang('del_sel'); ?></button>&nbsp;
                <?php endif; ?>
            </div>
        </div>

        <!--<table>
        <tr>
        <td>
            <select name='category' class='service-small-filter-drp category-dropdown reset-dropdown form-control input-small tablesaw' data-tablesaw-mode="swipe" >
                <option value='all'><?php /*echo lang('all'); */?></option>
                <option value='active'><?php /*echo lang('active'); */?></option>
                <option value='inactive'><?php /*echo lang('inactive'); */?></option>
            </select>&nbsp;
        </td>
        <td>
            <td>
                <input type='text' class='service-small-filter search-field reset-input form-control' rel_id='serach_filed1' name='search[name]' />&nbsp;
            </td>
            <td>
                <select class='service-small-filter-drp search-field-dropdown reset-dropdown form-control input-small ' rel='serach_filed1' style="width: 145px;" >
                    <option value='name'><?php /*echo lang('country_master_field_name'); */?></option>
                    <option value='printable_name'><?php /*echo lang('country_master_field_printable_name'); */?></option>
                </select>&nbsp;
            </td>
        </td>
        <td></td>
        <td><button type='button' class='btn submit-filters' title='Find' data-original-title=''><?php /*echo lang('find') */?></button>&nbsp;</td>
        <td><button type='button' class='btn reset-filters' title='Reset' data-original-title=''><?php /*echo lang('reset') */?></button>&nbsp;</td>
        <td>
            <?php /*if ($can_delete) : */?>
                <button type='button' class='btn delete-selected btn-danger' title='Delete Selected' data-original-title=''><?php /*echo lang('del_sel'); */?></button>&nbsp;
            <?php /*endif; */?>
        </td>
        </tr>
        </table>-->
        <div class="clearfix"></div>
    </div>

        <div id='table_content'>
        <?php endif; ?>
            <div id="no-more-tables">
                <table class="col-md-12 table-bordered table-striped table-condensed cf text-center">
                    <thead class="cf cf_shadow">
                        <tr>
                            <?php if ($can_delete && $has_records) : ?>
                                <th class='column-check'>
                                    <div class="checkbox">
                                        <label>
                                            <input type='checkbox' class="check-all" />
                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                    </div>
                                </th>
                            <?php endif;?>

                            <th class="numeric"><?php echo lang('country_master_field_iso'); ?><span class="rts_bordet"></th>
                            <th class="numeric"><?php echo lang('country_master_field_name'); ?>
                                <i class="icon-arrow-up sort" rel="asc" for="name" title="Asc" effect="tooltip"></i>
                                <i class="icon-arrow-down sort" rel="desc" for="name" title="Desc" effect="tooltip"></i>
                                <span class="rts_bordet"></th>
                            <th class="numeric"><?php echo lang('country_master_field_printable_name'); ?><span class="rts_bordet"></th>
                            <th class="numeric"><?php echo lang('country_master_field_iso3'); ?><span class="rts_bordet"></th>
                            <th class="numeric"><?php echo lang('country_master_field_numcode'); ?>
                                <i class="icon-arrow-up sort" rel="asc" for="numcode" title="Asc" effect="tooltip"></i>
                                <i class="icon-arrow-down sort" rel="desc" for="numcode" title="Desc" effect="tooltip"></i>
                                <span class="rts_bordet"></th>
                            <th class="numeric"><?php echo lang('country_master_field_status'); ?><span class="rts_bordet"></th>
                            <th class="numeric">Action</th>
                        </tr>
                    </thead>
                    <?php if ($has_records) : ?>
                    <tfoot>
                        <?php if ($can_delete) : ?>
                        <tr>
                            <td colspan='<?php echo $num_columns; ?>'>

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
                                <td class='column-check'>
                                    <div class="checkbox">
                                        <label>
                                            <input type='checkbox' name='checked[]' value='<?php echo $record->counrty_id; ?>' />
                                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                    </div>
                                </td>
                            <?php endif;?>

                            <td data-title="<?php echo lang('country_master_field_iso'); ?>" class="numeric"><?php e($record->iso); ?></td>
                            <td data-title="<?php echo lang('country_master_field_name'); ?>" class="numeric"><?php e($record->name); ?></td>
                            <td data-title="<?php echo lang('country_master_field_printable_name'); ?>" class="numeric"><?php e($record->printable_name); ?></td>
                            <td data-title="<?php echo lang('country_master_field_iso3'); ?>" class="numeric"><?php e($record->iso3); ?></td>
                            <td data-title="<?php echo lang('country_master_field_numcode'); ?>" class="numeric"><?php e($record->numcode); ?></td>
                            <?php
                                if ($record->status == 1) {
                                    $status = "Active";
                                    $btn_status = "Inactive";
                                    $class = "success";
                                } else {
                                    $status = "Inactive";
                                    $btn_status = "Active";
                                    $class = "warning inactive_sp";
                                }
                            ?>
                            <td data-title="Status" class="numeric">
                                <span style="cursor: pointer;" class="badge badge-<?php echo $class; ?> toggle_status" rel_id="<?php echo $record->counrty_id; ?>" ><?php echo $status ?></span>
                            </td>
                            <td data-title="Action" class="numeric">
                                <?php if ($can_edit) : ?>
                                    <?php echo anchor(site_url(). 'administration/country/edit/'.$record->counrty_id, '<i class="glyphicon glyphicon-edit" title="Edit" effect="tooltip" >&nbsp;</i>') ?>&nbsp;&nbsp;
                                <?php endif;?>
                                <?php if (($can_delete) && isset($records) && is_array($records) && count($records)) : ?>
                                    <span style="cursor: pointer;" class="delete" data-original-title="" title="" rel="<?php echo $record->counrty_id;  ?>"><i class="glyphicon glyphicon-trash" title="Delete" effect="tooltip" >&nbsp;</i></span>&nbsp;&nbsp;
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php
                            endforeach;
                        else:
                        ?>
                        <tr>
                            <td colspan='<?php echo $num_columns; ?>'><?php echo lang('country_master_records_empty'); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <div class="col-md-12 text-center pagenation_pad">
                    <?php
                    if (isset($pagination)) {
                        echo $pagination;
                    }
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
		<?php if (!isset($ajax)) : ?>
		<?php echo form_close(); ?>
    </div>
</div>
<?php endif; ?>