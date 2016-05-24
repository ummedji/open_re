<div class="admin-box">
    <script>        window.ajaxUrl = "<?php echo base_url(SITE_AREA . "/content/newsletter/index"); ?>";
        window.formId = "newsletter_listing";    </script>
    <?php $attributes = array('name' => 'newsletter_listing', 'id' => 'newsletter_listing','class'=>'form-inline');
    echo form_open($this->uri->uri_string(), $attributes); ?>
    <input type="hidden" id="sortby" name="sortby" value=""/> <input type="hidden" id="order" name="order" value=""/> <input
        type="hidden" id="action" name="action" value=""/> <input type="hidden" id="current_page" name="current_page" value="1"/>

    <div id="newsletter_actions">
        <div>
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td><input id="search" type="text" value="" name="search" class="form-control input-medium"
                               onkeyup="getResultByCategory(formId, ajaxUrl, getTableData);">
                        <select id="search_filter" class="form-control input-medium" name="search_filter">
                            <option value="emailID" selected="selected">Email ID</option>
                            <!--  Remove onkeyUp function and add belove field                            <option value="firstName" >First Name</option>                            <option value="lastName" >Last Name</option>-->
                        </select>
                        <button id="search_button" class="btn default" value="search" name="search">Find</button>
                   &nbsp; </td>
                    <?php if ($this->auth->has_permission('Newsletter.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                        <td><a id="delete_selected" class="btn btn-danger" href="" data-original-title="" title="">Delete
                                Selected</a>
                      &nbsp;  </td>
                    <?php endif; ?>
                    <td><a id="refresh" class="btn default" href="" data-original-title="" title="">Refresh</a>&nbsp;</td>
                    <!--Start:Add Export button In schedule appointment-->
                    <td><a class="btn default"
                           href="<?php echo base_url('admin/content/newsletter/export_newsletter_subscriber'); ?>"
                           data-original-title="" title="">Export</a></td>
                    <!--End:Export button in appointment-->                </tr>
            </table>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
        <tr>                <?php if ($this->auth->has_permission('Newsletter.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
                <th class="column-check"><input class="check-all" type="checkbox"/></th>                <?php endif; ?>
            <th>First Name&nbsp;<i for="firstName asc" class="icon-arrow-up"></i>&nbsp;<i
                    for="firstName desc" class="icon-arrow-down"></i></th>
            <th>Last Name&nbsp;<i for="lastName asc" class="icon-arrow-up"></i>&nbsp;<i
                    for="lastName desc" class="icon-arrow-down"></i></th>
            <th>Email ID&nbsp;<i for="emailID asc" class="icon-arrow-up"></i>&nbsp;<i
                    for="emailID desc" class="icon-arrow-down"></i></th>
            <th>Subscribe Date&nbsp;<i for="subscribeDate asc" class="icon-arrow-up"></i>&nbsp;<i
                    for="subscribeDate desc" class="icon-arrow-down"></i></th>
            <th>On MailChimp</th>
            <th>Subscribed On MailChimp</th>
        </tr>
        </thead>
        <tbody
            id="table_body">            <?php if (isset($records) && is_array($records) && count($records)) : ?>                <?php foreach ($records as $record) : ?>
            <tr>                        <?php if ($this->auth->has_permission('Newsletter.Content.Delete')) : ?>
                    <td><input type="checkbox" name="checked[]" value="<?php echo $record->ID ?>"/>
                    </td>                        <?php endif; ?>
                <td><?php echo $record->firstName ?></td>
                <td><?php echo $record->lastName ?></td>
                <td><?php echo $record->emailID ?></td>
                <td><?php echo date("m/d/Y H:i", strtotime($record->subscribeDate)); //echo ConvertDateTime($record->subscribeDate)  ?></td>
                <td>
                    <?php
                   $subscribers = $MCobj->onMailChimp($record->emailID);
                    if(isset($subscribers['success']) && ($subscribers['success']==1)) { echo "Yes"; } else
                    { echo "No";
                        ?>
                        <!--<a href='<?php echo base_url(SITE_AREA . "/content/newsletter/addToMailChimp/$record->emailID"); ?>'>Add</a> -->
                    <?php
                    } ?>
                    </td>
                <td>
                    <?php
                    if(isset($subscribers['data'][0]['status']) && ($subscribers['data'][0]['status']=='subscribed')) { echo "Yes"; } else
                    {
                        echo "No";
                        ?>
                        <!--<a href='<?php echo base_url(SITE_AREA . "/content/newsletter/addToMailChimp/$record->emailID"); ?>'>Add</a> -->


                    <?php
                    } ?>
                </td>
            </tr>                <?php endforeach; ?>            <?php else: ?>
            <tr>
                <td colspan="5">No records found that match your selection.</td>
            </tr>            <?php endif; ?>        </tbody>
    </table>
    <div id="pagination"
         class="pagination pagination-right">        <?php if (isset($pagination) && !empty($pagination)) {
            echo $pagination;
        } ?>    </div>    <?php echo form_close(); ?></div>