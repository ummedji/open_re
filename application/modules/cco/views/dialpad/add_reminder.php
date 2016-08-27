<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content rh-popup">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body">
            <ul class="filter-menu nav-tabs">
                <?php if ($pg == 'dialpad') { ?>
                <li class="active"><a data-toggle="tab" href="#call_reminder">Call Reminder</a></li>
                <?php } ?>
                <li class="<?php if ($pg == 'mainscreen'){ e('active'); } ?>"><a data-toggle="tab" href="#general_reminder">General Reminder</a></li>
                <li><a data-toggle="tab" href="#view_reminder">View Reminder</a></li>
            </ul>
            <div class="tab-content filter-content">
                <?php if ($pg == 'dialpad') { ?>
                <div id="call_reminder" class="tab-pane fade in active">
                    <?php
                    $attributes = array('class' => '', 'id' => 'form_call_reminder', 'name' => 'form_call_reminder');
                    echo form_open('', $attributes);
                    ?>
                    <div class="col-md-12 form-inline">
                        <div class="row">
                            <input type="hidden" id="reminder_type" name="reminder_type" value="call"/>
                            <input type="hidden" id="pg" name="pg" value="<?php e($pg);?>"/>
                            <div class="col-md-5">
                                <label>Date</label>
                                <input type="text" class="form-control h-control" name="reminder_date" id="reminder_call_date" placeholder="" required>
                                <label id="reminder_call_date-error" style="display: none;" class="error" for="reminder_call_date"></label>
                            </div>
                            <div class="col-md-6">
                                <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                    <label>Time</label>
                                    <input type="text" class="form-control h-control input-group-time form-control input-append" id="reminder_call_time" name="reminder_time" placeholder="" required>
                                    <label>AM/PM</label>
                                </div>
                                <label id="reminder_call_time-error" class="error" for="reminder_call_time"></label>
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control text-filter" rows="10"  name="reminder_remarks" id="reminder_remarks" placeholder="Remarks" required></textarea>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn-filter" id="save_call_reminder">Save</button>
                    <button type="reset" class="btn-filter">Clear</button>
                    <?php echo form_close(); ?>
                </div>
                <?php } ?>
                <div id="general_reminder" class="tab-pane fade <?php if ($pg == 'mainscreen'){ e('in active'); } ?>">
                    <?php
                    $attributes = array('class' => '', 'id' => 'form_gen_reminder', 'name' => 'form_gen_reminder');
                    echo form_open('', $attributes);
                    ?>
                    <div class="col-md-12 form-inline">
                        <div class="row">
                            <input type="hidden" id="reminder_type" name="reminder_type" value="general"/>
                            <input type="hidden" id="pg" name="pg" value="<?php e($pg);?>"/>
                            <div class="col-md-5">
                                <label>Date</label>
                                <input type="text" class="form-control h-control" name="reminder_date" id="reminder_gen_date" placeholder="" required>
                                <label id="reminder_gen_date-error" class="error" for="reminder_gen_date"></label>
                            </div>
                            <div class="col-md-6">
                                <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                    <label>Time</label>
                                    <input type="text" class="form-control h-control input-group-time form-control input-append" id="reminder_gen_time" name="reminder_time" placeholder="" required>
                                    <label>AM/PM</label>
                                </div>
                                <label id="reminder_gen_time-error" class="error" for="reminder_gen_time"></label>
                            </div>
                            <div class="col-md-12">
                                <label>Title</label>
                                <input type="text" class="form-control h-control" name="reminder_title" id="reminder_title" placeholder="" required>
                                <div class="clearfix"></div>
                                <label id="reminder_title-error" style="display: none;" class="error" for="reminder_title"></label>
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control text-filter" rows="10"  name="reminder_remarks" id="reminder_remarks" placeholder="Reminder For" required></textarea>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn-filter" id="save_gen_reminder">Save</button>
                    <button type="reset" class="btn-filter">Clear</button>
                    <?php echo form_close(); ?>
                </div>
                <div id="view_reminder" class="tab-pane fade">
                    <?php
                    $attributes = array('class' => '', 'id' => 'form_view_reminder', 'name' => 'form_view_reminder');
                    echo form_open('', $attributes);
                    ?>
                    <input type="hidden" id="reminder_type" name="reminder_type" value="delete"/>
                    <input type="hidden" id="pg" name="pg" value="<?php e($pg);?>"/>

                    <div id="no-more-tables">
                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                            <tr>
                                <th class="first_th"><input type="checkbox" id="check_all" name="check_all"
                                                            value="0"/><span class="rts_bordet"></span></th>
                                <th class="first_th">Reminder Type<span class="rts_bordet"></span></th>
                                <th class="numeric">Customer Name<span class="rts_bordet"></span></th>
                                <th class="numeric">Number<span class="rts_bordet"></span></th>
                                <th class="numeric">Date<span class="rts_bordet"></span></th>
                                <th class="numeric">Time<span class="rts_bordet"></span></th>
                                <th class="numeric">Title<span class="rts_bordet"></span></th>
                                <th class="numeric">Reminder For<span class="rts_bordet"></span></th>
                                <th class="numeric">Remarks<span class="rts_bordet"></span></th>
                                <th class="numeric">Time Left<span class="rts_bordet"></span></th>
                                <th class="numeric">Reset<span class="rts_bordet"></span></th>
                            </tr>
                            </thead>
                            <tbody id="reminder_data">
                            <?php
                            if (isset($reminder_data) && count($reminder_data) > 0) {
                                foreach ($reminder_data as $reminder) {
                                    $rem_date_ts = strtotime($reminder['reminder_datetime']);
                                    $remarks = ($reminder['reminder_type'] == 'call' ? $reminder['reminder_remarks'] : '-');
                                    $rem_for = ($reminder['reminder_type'] == 'call' ? '-' : $reminder['reminder_remarks']);
                                    $cus_name = (is_null($reminder['display_name']) || trim($reminder['display_name'])=='' ? '-' : $reminder['display_name']);
                                    $cus_num = (is_null($reminder['primary_mobile_no']) || trim($reminder['primary_mobile_no'])=='' ? '-' : $reminder['primary_mobile_no']);

                                    $datediff = $rem_date_ts - mktime();
                                    $hours = floor($datediff / 3600);
                                    $mins = floor(($datediff - ($hours * 3600)) / 60);
                                    $min = ($mins == 00 ? "" : $mins . 'M');
                                    $timeleft = $hours . 'H ' . $min;

                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="reminder_id[]" class="rem_check_checked"
                                                   value="<?php e($reminder['reminder_id']); ?>" required/></td>
                                        <td class="first_th"><?php e(ucfirst($reminder['reminder_type'])); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($cus_name); ?> <span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($cus_num); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e(date($current_user->local_date, $rem_date_ts)); ?>
                                            <span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e(date("H:i A", $rem_date_ts)); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($reminder['reminder_title']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($rem_for); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($remarks); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($timeleft); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e("-"); ?><span class="rts_bordet"></span></td>
                                    </tr>
                                <? }
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="col-md-12 table_bottom pln_table_bottom">
                            <div class="row">
                                <div class="save_btn">
                                    <button type="submit" class="btn btn-primary" id="delete_reminder">Delete</button>
                                    <button type="button" class="btn btn-default close_default_bb" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                                <div align="right">
                                    <?php echo $reminder_data_pagination; ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#reminder_call_date').datepicker({
        format: date_format,
        autoclose: true,
        startDate: new Date()
    }).on('changeDate', function (e) {
    });
    $('#reminder_call_time').timepicker({});

    $('#reminder_gen_date').datepicker({
        format: date_format,
        autoclose: true,
        startDate: new Date()
    }).on('changeDate', function (e) {
    });
    $('#reminder_gen_time').timepicker({});

    $(document).ready(function () {
        $("#form_call_reminder").validate({
            submitHandler: function (form) {
                save_call_reminder();
            }
        });

        $("#form_gen_reminder").validate({
            submitHandler: function (form) {
                save_gen_reminder();
            }
        });

        $("#form_view_reminder").validate({
            submitHandler: function (form) {
                delete_reminder();
            }
        });
    });
</script>