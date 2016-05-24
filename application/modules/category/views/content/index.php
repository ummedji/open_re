<?php if (!isset($ajax)) : ?>
    <div class="admin-box">
    <?php
    $attributes = array(
        'name' => 'admin_listing_form',
        'id' => 'admin_listing_form',
        'class'=>'form-inline'
    );
    ?>
    <?php echo form_open($this->uri->uri_string() . "/index", $attributes); ?>
    <div class='grid-filters'>
        <input type="hidden" value="" name="sortby" id="sortby" class="reset-input">
        <input type="hidden" value="" name="order" id="order" class="reset-input">
        <input type="hidden" value="" name="action" id="action" class="reset-input">
        <table>
            <tr>
                <td>
                    <select name='category' class='category-dropdown reset-dropdown form-control input-small '>
                        <option
                            value='all' <?php echo ($this->input->post("category") == "all") ? "selected='selected'" : ""; ?> >
                            All
                        </option>
                        <option
                            value='active' <?php echo ($this->input->post("category") == "active") ? "selected='selected'" : ""; ?> >
                            Active
                        </option>
                        <option
                            value='inactive' <?php echo ($this->input->post("category") == "inactive") ? "selected='selected'" : ""; ?> >
                            Inactive
                        </option>
                    </select>&nbsp;</td>

                <td>
                    <?php
                    //                                var_dump($this->input->post());
                    $search = "";
                    $scope = "";
                    $vall = "";
                    $s = $this->input->post("search");
                    if ($s) {
                        if (!empty($s) && is_array($s)) {
                            foreach ($s as $k => $v) {
                                $search = "search[" . $k . "]";
                                $scope = $k;
                                $vall = $v;
                            }
                        }
                    }

                    //                                echo $search."<br/>";
                    //                                echo $scope."<br/>";
                    //                                echo $vall."<br/>";
                    ?>
                    <input type='text' class='search-field reset-input form-control'  rel_id='serach_filed1'
                           name='<?php echo ($s) ? $search : "search[category_title]"; ?>'
                           value="<?php echo $vall; ?>"/>&nbsp;</td>

                <td>
                    <select class='search-field-dropdown reset-dropdown form-control input-small' rel='serach_filed1'>
                        <option
                            value='category_title' <?php echo ($scope == "category_title") ? "selected='selected'" : ""; ?> >
                            Title
                        </option>
                        <option
                            value='category_slug' <?php echo ($scope == "category_slug") ? "selected='selected'" : ""; ?> >
                            Slug
                        </option>
                    </select>&nbsp;</td>

                <td>
                    <button type='button' class='btn submit-filters' title='Find' data-original-title=''>Find</button>&nbsp;</td>

                <td>
                    <button type='button' class='btn reset-filters' title='Reset' data-original-title=''>Reset</button>&nbsp;</td>

                <td>
                    <?php if ($this->auth->has_permission('Category.Content.Delete')) : ?>
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
            <?php if ($this->auth->has_permission('Category.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th class="column-check"><input class="check-all" type="checkbox"/></th>
            <?php endif; ?>

            <th width="20%">
                Title
                <i class="icon-arrow-up sort" rel="asc" for="category_title" title="Asc" effect="tooltip"></i>
                <i class="icon-arrow-down sort" rel="desc" for="category_title" title="Desc" effect="tooltip"></i>
            </th>
            <th>
                Slug
                <i class="icon-arrow-up sort" rel="asc" for="category_slug" title="Asc" effect="tooltip"></i>
                <i class="icon-arrow-down sort" rel="desc" for="category_slug" title="Desc" effect="tooltip"></i>
            </th>
            <th width="10%">Image</th>
            <th width="10%">Status</th>
            <?php if ($this->auth->has_permission('Category.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th width="10%">Actions</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($records) && is_array($records) && count($records)) : ?>
            <?php foreach ($records as $record) : ?>
                <tr>
                    <?php if ($this->auth->has_permission('Category.Content.Delete')) : ?>
                        <td><input type="checkbox" name="checked[]" value="<?php echo $record->ID ?>"/></td>
                    <?php endif; ?>

                    <td><?php echo $record->category_title ?></td>
                    <td><?php echo $record->category_slug ?></td>
                    <td>
                        <?php
                        if (!empty($record->category_image) && file_exists($module_config['category_image_path'] . DIRECTORY_SEPARATOR . $record->category_image)) { ?>
                            <img class="image" width=50 height=50
                                 src="<?php echo base_url() . "assets/uploads/category_images/" . $record->category_image ?>"/>

                        <?php } ?>
                    </td>
                    <?php
                    if ($record->category_status == 1) {
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
                              rel_id="<?php echo $record->ID; ?>"><?php echo $status ?></span></td>
                    <td>
                        <?php if ($this->auth->has_permission('Category.Content.Edit')) : ?>
                            <?php echo anchor(SITE_AREA . '/content/category/edit/' . $record->ID, '<i class="glyphicon glyphicon-edit">&nbsp;</i>', "class='edit_hellddd' effect='tooltip' title='Edit' ") ?>&nbsp;&nbsp;
                        <?php endif; ?>
                        <?php if ($this->auth->has_permission('Category.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                            <span style="cursor: pointer;" class="delete" effect="tooltip" title="Delete"
                                  rel="<?php echo $record->ID; ?>"><i class="glyphicon glyphicon-trash">&nbsp;</i></span>&nbsp;&nbsp;
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