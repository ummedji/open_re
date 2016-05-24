<?php if (!isset($ajax)) : ?>
    <div class="admin-box">
    <?php
    $attributes = array(
        'name' => 'admin_listing_form',
        'id' => 'admin_listing_form'
    );
    ?>
    <?php echo form_open($this->uri->uri_string() . '/index', $attributes); ?>
    <div class='grid-filters'>
        <input type="hidden" value="" name="sortby" id="sortby" class="reset-input">
        <input type="hidden" value="" name="order" id="order" class="reset-input">
        <input type="hidden" value="" name="action" id="action" class="reset-input">
        <table>
            <tr>
                <td><select name='category' class='category-dropdown reset-dropdown form-control input-small'>
                        <option value='all'>All</option>
                        <option value='active'>Active</option>
                        <option value='inactive'>Inactive</option>
                    </select></td>&nbsp;
                <!--<td><input type='text' class='search-field reset-input' rel_id='serach_filed1' name='search["menu.title"]' />&nbsp;&nbsp;<select class='search-field-dropdown reset-dropdown' rel='serach_filed1' ><option value='title'>Title</option><option value='alias'>Alias</option><option value='navigation_id'>Navigation</option></select>&nbsp;&nbsp;</td>-->
              <td>&nbsp;</td>
                <td>
                    <button type='button' class='btn submit-filters' title='Find' data-original-title=''>Find</button>&nbsp;
                </td>
                <td>
                    <button type='button' class='btn reset-filters' title='Reset' data-original-title=''>Reset</button>&nbsp;
                </td>
                <td>
                    <?php if ($this->auth->has_permission('Menu.Content.Delete')) : ?>
                        <button type='button' class='btn delete-selected btn-danger' title='Delete Selected'
                                data-original-title=''>Delete Selected
                        </button>
                    <?php endif; ?>
                    &nbsp;
                </td>
            </tr>
        </table>
    </div>


    <div id="table_content">
<?php endif; ?>
    <table class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
        <tr>
            <?php if ($this->auth->has_permission('Menu.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th class="column-check"><input class="check-all" type="checkbox"/></th>
            <?php endif; ?>

            <th>Title <i class="icon-arrow-up sort" rel="asc" for="<?php echo $this->db->dbprefix("menu") ?>.title"></i>
                <i class="icon-arrow-down sort" rel="desc" for="<?php echo $this->db->dbprefix("menu") ?>.title"></i>
            </th>
            <th>Alias <i class="icon-arrow-up sort" rel="asc" for="<?php echo $this->db->dbprefix("menu") ?>.alias"></i>
                <i class="icon-arrow-down sort" rel="desc" for="<?php echo $this->db->dbprefix("menu") ?>.alias"></i>
            </th>
            <th>Link</th>
            <!--<th>Parent</th>-->
            <th>Navigation
                <i class="icon-arrow-up sort" rel="asc" for="<?php echo $this->db->dbprefix("navigation") ?>.title"></i>
                <i class="icon-arrow-down sort" rel="desc"
                   for="<?php echo $this->db->dbprefix("navigation") ?>.title"></i>
            </th>
            <!--<th>Position</th>-->
            <th width="10%">Status</th>
            <?php if ($this->auth->has_permission('Menu.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th width="10%">Actions</th>
            <?php endif; ?>
        </tr>
        </thead>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <!--tfoot>
                <?php if ($this->auth->has_permission('Menu.Content.Delete')) : ?>
                            <tr>
                                    <td colspan="19">
                    <?php echo lang('bf_with_selected') ?>
                                            <input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('menu_delete_confirm'); ?>')">
                                    </td>
                            </tr>
                <?php endif; ?>
                </tfoot-->
        <?php endif; ?>
        <tbody>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <?php foreach ($records as $record) : ?>
                <tr>
                    <?php if ($this->auth->has_permission('Menu.Content.Delete')) : ?>
                        <td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>"/></td>
                    <?php endif; ?>

                    <td><?php echo $record->title ?></td>
                    <td><?php echo $record->alias ?></td>
                    <td><?php echo $record->link ?></td>
                    <!--<td><?php echo $record->parent_title ?></td>-->
                    <td><?php echo $record->nav_title ?></td>

                    <!--                            <td class="position">

                                <?php /*if (isset($max_position) && !empty($max_position)) { ?>
                                    <?php if ($record->position < $max_position) { ?>
                                        &nbsp;<i rel_id="<?php echo $record->id ?>" position="<?php echo $record->position ?>" state="up" class="icon-chevron-down"></i>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (isset($min_position) && !empty($min_position)) { ?>
                                    <?php if ($record->position > $min_position) { ?>
                                        &nbsp;<i rel_id="<?php echo $record->id ?>" position="<?php echo $record->position ?>" state="down" class="icon-chevron-up"></i>
                                    <?php } ?>
                                <?php }*/ ?>

                            </td>               -->
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
                        <?php if ($this->auth->has_permission('Menu.Content.Edit')) : ?>
                            <?php echo anchor(SITE_AREA . '/content/menu/edit/' . $record->id, '<i class="glyphicon glyphicon-edit">&nbsp;</i>') ?>&nbsp;&nbsp;
                        <?php endif; ?>
                        <?php if ($this->auth->has_permission('Menu.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                            <span style="cursor: pointer;" class="delete" data-original-title="" title=""
                                  rel="<?php echo $record->id; ?>"><i class="glyphicon glyphicon-trash">&nbsp;</i></span>&nbsp;&nbsp;
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="19">No records found that match your selection.</td>
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