<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="popup_title">Reminder</h4>
        </div>
        <div class="modal-body">

            <div class="col-md-12 text-center plng_sub_nave_cco">
                <div class="inn_sub_nave">
                    <ul>
                        <?php if ($pg == 'dialpad') { ?>
                            <li class="active"><a data-toggle="tab" href="#call_reminder">Call Reminder</a></li>
                        <?php } ?>
                        <li class="<?php if ($pg == 'mainscreen'){ e('active'); } ?>"><a data-toggle="tab" href="#general_reminder">General Reminder</a></li>
                        <li class=""><a data-toggle="tab" href="#view_reminder">View</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="tab-content dialpad-plnd-content">
                <?php if ($pg == 'dialpad') { ?>
                    <div id="call_reminder" class="tab-pane fade in active">
                        <div class="row">
                            <?php
                            $attributes = array('class' => '', 'id' => 'form_call_reminder', 'name' => 'form_call_reminder');
                            echo form_open('', $attributes);
                            ?>
                            <input type="hidden" id="reminder_type" name="reminder_type" value="call"/>
                            <input type="hidden" id="pg" name="pg" value="<?php e($pg);?>"/>
                            <div class="col-md-12">
                                <div class="default_box_white">
                                    <div class="col-md-12 text-center tp_form inline-parent">
                                        <div class="form-group">
                                            <label>Select Date<span style="color: red">*</span></label>

                                            <div class="inln_fld">
                                                <input type="text" class="form-control" name="reminder_date"
                                                       id="reminder_call_date" placeholder="" required>

                                                <div class="clearfix"></div>
                                                <label id="reminder_date-error" class="error"
                                                       for="reminder_date"></label>
                                            </div>
                                        </div>
                                        <div class="form-group actvt-parent">
                                            <label>Time<span style="color: red">*</span></label>

                                            <div class="inln_fld">
                                                <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                                    <input id="reminder_call_time" name="reminder_time" type="text"
                                                           class="input-group-time form-control input-append" required>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-sm-3 first_lb"><label>Remarks<span
                                                        style="color: red">*</span></label></div>
                                            <div class="col-md-8 col-sm-8">
                                            <textarea class="form-control" rows="4" name="reminder_remarks"
                                                      id="reminder_remarks" placeholder="Remarks" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 table_bottom pln_table_bottom">
                                        <div class="row">
                                            <div class="save_btn">
                                                <button type="submit" class="btn btn-primary" id="save_call_reminder">
                                                    Save
                                                </button>
                                                <input type="reset" class="btn btn-primary" id="clear_call_reminder"
                                                       value="Clear"/>
                                                <button type="button" class="btn btn-default close_default_bb"
                                                        data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                <?php } ?>
                <div id="general_reminder" class="tab-pane fade <?php if ($pg == 'mainscreen'){ e('in active'); } ?>">
                    <div class="row">
                        <?php
                        $attributes = array('class' => '', 'id' => 'form_gen_reminder', 'name' => 'form_gen_reminder');
                        echo form_open('', $attributes);
                        ?>
                        <input type="hidden" id="reminder_type" name="reminder_type" value="general"/>
                        <input type="hidden" id="pg" name="pg" value="<?php e($pg);?>"/>
                        <div class="col-md-12">
                            <div class="default_box_white">
                                <div class="col-md-12 text-center tp_form inline-parent">
                                    <div class="form-group">
                                        <label>Select Date<span style="color: red">*</span></label>

                                        <div class="inln_fld">
                                            <input type="text" class="form-control" name="reminder_date"
                                                   id="reminder_gen_date" placeholder="" required>

                                            <div class="clearfix"></div>
                                            <label id="reminder_date-error" class="error" for="reminder_date"></label>
                                        </div>
                                    </div>
                                    <div class="form-group actvt-parent">
                                        <label>Time<span style="color: red">*</span></label>

                                        <div class="inln_fld">
                                            <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                                <input id="reminder_gen_time" name="reminder_time" type="text"
                                                       class="input-group-time form-control input-append" required>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center"
                                             style="margin-bottom: 0px;">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="reminder_title"
                                                   id="reminder_title" placeholder="" required>
                                        </div>

                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-3 col-sm-3 first_lb"><label>Remarks<span
                                                    style="color: red">*</span></label></div>
                                        <div class="col-md-8 col-sm-8">
                                                    <textarea class="form-control" rows="4" name="reminder_remarks"
                                                              id="reminder_remarks" placeholder="Reminder For"
                                                              required></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 table_bottom pln_table_bottom">
                                    <div class="row">
                                        <div class="save_btn">
                                            <button type="submit" class="btn btn-primary" id="save_gen_reminder">Save
                                            </button>
                                            <input type="reset" class="btn btn-primary" id="clear_call_reminder"
                                                   value="Clear"/>
                                            <button type="button" class="btn btn-default close_default_bb"
                                                    data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php echo form_close(); ?>
                    </div>
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
                                        <td class="numeric"><?php e("--"); ?> <span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e("--"); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e(date($current_user->local_date, $rem_date_ts)); ?>
                                            <span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e(date("H:i A", $rem_date_ts)); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($reminder['reminder_title']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($remarks); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($rem_for); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($timeleft); ?><span class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e("--"); ?><span class="rts_bordet"></span></td>
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
                                    <?php /*echo $reminder_data_pagination;*/ ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="clearfix"></div>
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