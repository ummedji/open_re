<?php if (!isset($ajax)) : ?>
    <div class="admin-box">
    <?php
    $attributes = array(
        'name' => 'admin_listing_form',
        'id' => 'admin_listing_form',
        'class'=>'form-inline'
    );
    ?>
    <?php echo form_open($this->uri->uri_string() . '/index', $attributes); ?>
    <div class='grid-filters'>
        <input type="hidden" value="" name="sortby" id="sortby" class="reset-input">
        <input type="hidden" value="" name="order" id="order" class="reset-input">
        <input type="hidden" value="" name="action" id="action" class="reset-input">
        <table>
            <tr>
                <td><select name='category' class='category-dropdown reset-dropdown form-control input-medium'>
                        <option value='all'>All</option>
                        <option value='active'>Active</option>
                        <option value='inactive'>Inactive</option>
                        <option value='newest'>Newest</option>
                        <option value='oldest'>Oldest</option>
                    </select></td>
                <td>&nbsp;</td>
                <td><input type='text' class='search-field reset-input form-control input-medium' rel_id='serach_filed1' name='search[title]'/>&nbsp;<select
                        class='search-field-dropdown reset-dropdown form-control input-medium' rel='serach_filed1'>
                        <option value='title'>Title</option>
                        <option value='label'>Label</option>
                    </select></td>
                <td>&nbsp;</td>
                <td>
                    <button type='button' class='btn submit-filters' title='Find' data-original-title=''>Find</button>&nbsp;
                </td>
                <td>
                    <button type='button' class='btn reset-filters' title='Reset' data-original-title=''>Reset</button>&nbsp;
                </td>
                <td>
                    <?php if ($this->auth->has_permission('Email_Template.Settings.Delete')) : ?>
                        <button type='button' class='btn delete-selected btn-danger' title='Delete Selected'
                                data-original-title=''>Delete Selected
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>


    <div id="table_content">
<?php endif; ?>
    <table class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
        <tr>
            <?php if ($this->auth->has_permission('Email_Template.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th class="column-check"><input class="check-all" type="checkbox"/></th>
            <?php endif; ?>

            <th>Title <i class="icon-arrow-up sort" rel="asc" for="title" title="Asc" effect="tooltip"></i>
                <i class="icon-arrow-down sort" rel="desc" for="title" title="Desc" effect="tooltip"></i></th>
            <th>Label <i class="icon-arrow-up sort" rel="asc" for="label" title="Asc" effect="tooltip"></i>
                <i class="icon-arrow-down sort" rel="desc" for="label" title="Desc" effect="tooltip"></i></th>
            <th width="20%">Created</th>
            <th width="10%">Status</th>
            <?php if ($this->auth->has_permission('Email_Template.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        </thead>

        <tbody>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <?php foreach ($records as $record) : ?>
                <tr>
                    <?php if ($this->auth->has_permission('Email_Template.Settings.Delete')) : ?>
                        <td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>"/></td>
                    <?php endif; ?>

                    <td><?php echo $record->title ?></td>

                    <td><?php echo $record->label ?></td>
                    <td>
                        <?php
                        $created_date = new DateTime($record->created_on);
                        echo $created_date->format("d M Y, H:i A");
                        ?>
                    </td>

                    <?php
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
                    <td><span style="cursor: pointer;" class="badge badge-<?php echo $class; ?> toggle_status"
                              rel_id="<?php echo $record->id; ?>"><?php echo $status ?></span></td>
                    <td>
                        <?php if ($this->auth->has_permission('Email_Template.Settings.Edit')) : ?>
                            <?php echo anchor(SITE_AREA . '/settings/email_template/edit/' . $record->id, '<i class="glyphicon glyphicon-edit" title="Edit" effect="tooltip">&nbsp;</i>') ?>&nbsp;&nbsp;
                        <?php endif; ?>
                        <?php if ($this->auth->has_permission('Email_Template.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                            <span style="cursor: pointer;" class="delete" data-original-title="" title=""
                                  rel="<?php echo $record->id; ?>"><i class="glyphicon glyphicon-trash" title="Delete"
                                                                      effect="tooltip">&nbsp;</i></span>&nbsp;&nbsp;
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No records found that match your selection.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
<?php
if (isset($pagination)) {
    echo $pagination;
}
?>
<?php if (!isset($ajax)) : ?>
    </div>
    <?php echo form_close(); ?>
    </div>
<?php endif; ?>