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
                <td>
                    <select name='category' class='category-dropdown reset-dropdown form-control input-exsmall'>
                        <option value='all'>All</option>
                        <option value='active'>Active</option>
                        <option value='inactive'>Inactive</option>
                        <option value='banned'>Banned</option>
                        <option value='deleted'>Deleted</option>
                        <option value='newest'>Newest</option>
                        <option value='oldest'>Oldest</option>
                    </select>

                </td>
                <td>&nbsp;</td>
                <td><input type='text' class='search-field reset-input form-control input-medium' rel_id='serach_filed1' name='search[email]'/></td>
                <td>&nbsp;</td>
                <td>
                    <select class='search-field-dropdown reset-dropdown form-control input-exsmall' rel='serach_filed1'>
                        <option value='email'>Email</option>
                        <!--<option value='username'>Username</option>-->
                        <option value='display_name'>Display Name</option>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td>
                    <button type='button' class='btn submit-filters' title='Find' data-original-title=''>Find</button>&nbsp;</td>
                <td>
                    <button type='button' class='btn reset-filters' title='Reset' data-original-title=''>Reset</button>&nbsp;</td>
                <td>
                    <div class="btnseparator">&nbsp;</div>
                    <button type='button' class='btn activate-user' title='Delete Selected' data-original-title=''>
                        Activate
                    </button>&nbsp;</td>
                <td>
                    <button type='button' class='btn deactivate-user' title='Delete Selected' data-original-title=''>
                        Deactivate
                    </button>&nbsp;</td>
                <td>
                    <button type='button' class='btn ban-user' title='Delete Selected' data-original-title=''>Ban
                    </button>&nbsp;</td>

                <td>
                    <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Delete")) : ?>
                        <button type='button' class='btn delete-selected btn-danger' title='Delete Selected'
                                data-original-title=''>Delete
                        </button>
                        &nbsp;<?php endif; ?></td>
                <td><input type="submit" id="btn_export" name="btn_export" class='btn btn-info' title='Export Users Records' value="Export Users Records">&nbsp;</td>
            </tr>
        </table>
    </div>


    <div id="table_content">
<?php endif; ?>
    <table class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
        <tr>
            <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Delete") && isset($records) && is_array($records) && count($records)) : ?>
                <th class="column-check"><input class="check-all" type="checkbox"/></th>
            <?php endif; ?>

            <th>ID</th>
            <th>Display Name
                <i class="icon-arrow-up sort" rel="asc" for="display_name"></i>
                <i class="icon-arrow-down sort" rel="desc" for="display_name"></i>
            </th>
            <th>Email
                <i class="icon-arrow-up sort" rel="asc" for="email"></i>
                <i class="icon-arrow-down sort" rel="desc" for="email"></i>
            </th>
            <th>Role</th>
            <th>Last Login</th>
            <th width="10%">Status</th>
            <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Delete") && isset($records) && is_array($records) && count($records)) : ?>
                <th width="10%">Actions</th>
            <?php endif; ?>
        </tr>
        </thead>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <!--tfoot>
                <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Delete")) : ?>
                    <?php echo lang('bf_with_selected') ?>
                <?php endif; ?>
                </tfoot-->
        <?php endif; ?>
        <tbody>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <?php foreach ($records as $record) : ?>
                <tr>
                    <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Delete")) : ?>
                        <td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>"/></td>
                    <?php endif; ?>
                    <td><?php echo $record->id ?></td>
                    <td><?php echo $record->display_name ?></td>
                    <td><a href="mailto:<?php echo $record->email ?>"><?php echo $record->email ?></a></td>
                    <td><?php echo $record->role_name ?></td>
                    <td><?php
                        if ($record->last_login != '0000-00-00 00:00:00') {
                            echo date('M j, y g:i A', strtotime($record->last_login));
                        } else {
                            echo '---';
                        }
                        ?>
                    </td>

                    <!--td><?php
                    $class = '';
                    switch ($record->active) {
                        case 1:
                            $class = " badge-success";
                            break;
                        case 0:
                        default:
                            $class = " badge-warning";
                            break;
                    }
                    ?>
                                <span class="badge<?php echo($class); ?>">
                            <?php
                    if ($record->active == 1) {
                        echo(lang('us_active'));
                    } else {
                        echo(lang('us_inactive'));
                    }
                    ?>
                                </span>
                            </td-->
                    <!-- -->
                    <!--td><?php echo $record->role_id ?></td>
                    <td><?php echo $record->email ?></td>
                    <td><?php echo $record->username ?></td>
                    <td><?php echo $record->password_hash ?></td>
                    <td><?php echo $record->reset_hash ?></td>
                    <td><?php echo $record->salt ?></td>
                    <td><?php echo $record->last_login ?></td>
                    <td><?php echo $record->last_ip ?></td>
                    <td><?php echo $record->deleted ?></td>
                    <td><?php echo $record->banned ?></td>
                    <td><?php echo $record->ban_message ?></td>
                    <td><?php echo $record->reset_by ?></td>
                    <td><?php echo $record->display_name ?></td>
                    <td><?php echo $record->display_name_changed ?></td>
                    <td><?php echo $record->timezone ?></td>
                    <td><?php echo $record->language ?></td>
                    <td><?php echo $record->activate_hash ?></td>
                    <td><?php echo $record->created_on ?></td-->
                    <?php
                    if ($record->active == 1) {
                        $status = "Active.";
                        $btn_status = "Inactive";
                        $class = "success";
                    } else {
                        $status = "Inactive.";
                        $btn_status = "Active";
                        $class = "warning";
                    }
                    ?>
                    <td><span style="cursor: pointer;" class="badge badge-<?php echo $class; ?> toggle_status"
                              rel_id="<?php echo $record->id; ?>"><?php echo $status ?></span>
                    </td>

                    <td>
                        <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Edit")) : ?>
                            <?php echo anchor(SITE_AREA . "/siteusers/{$module_config['module_name']}/edit/" . $record->id, '<i class="glyphicon glyphicon-edit">&nbsp;</i>') ?>&nbsp;&nbsp;
                        <?php endif; ?>

                        <?php if ($record->deleted == 1) : ?>
                            <span style="cursor: pointer;" class="restore" data-original-title="" title="Restore"
                                  rel="<?php echo $record->id; ?>"><i class="icon-retweet">&nbsp;</i></span>&nbsp;&nbsp;
                            <span style="cursor: pointer;" class="purge" data-original-title="" title="Delete"
                                  rel="<?php echo $record->id; ?>"><i class="icon-trash">&nbsp;</i></span>&nbsp;&nbsp;
                        <?php else : ?>
                            <?php if ($this->auth->has_permission("{$module_config['module_permission_name']}.Siteusers.Delete") && isset($records) && is_array($records) && count($records)) : ?>
                                <span style="cursor: pointer;" class="delete" data-original-title="" title=""
                                      rel="<?php echo $record->id; ?>"><i class="glyphicon glyphicon-trash">
                                        &nbsp;</i></span>&nbsp;&nbsp;
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="21">No records found that match your selection.</td>
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