<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="popup_title">Work Allocated Summary</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-12 distributore_form">
                <div class="row">

                    <div id="no-more-tables">
                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                            <tr>
                                <th class="first_th">CCO<span class="rts_bordet"></span></th>
                                <th class="numeric">Allocated Campaign<span class="rts_bordet"></span></th>
                                <!--<th class="numeric">No. Of Customer<span class="rts_bordet"></span></th>-->
                                <th class="numeric">Total Campaign Call<span class="rts_bordet"></span></th>
                                <th class="numeric">Pending Campaign Call<span class="rts_bordet"></span></th>
                                <th class="numeric">Allocated Activity<span class="rts_bordet"></span></th>
                                <th class="numeric">Total Activity Call<span class="rts_bordet"></span></th>
                                <th class="numeric">Pending Activity Call<span class="rts_bordet"></span></th>
                                <th class="numeric">Total Pending Call<span class="rts_bordet"></span></th>
                            </tr>
                            </thead>
                            <tbody id="order_place_data">
                            <?php
                            if (isset($work_allocation) && count($work_allocation) > 0) {
                                foreach ($work_allocation as $work_allc) { ?>
                                    <tr>
                                        <td class="first_th"><?php e($work_allc['cco_name']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($work_allc['tot_campaign']); ?> <span
                                                class="rts_bordet"></span></td>
                                        <!--<td class="numeric"><?php /*e($work_allc['tot_c_customer']); */?><span
                                                class="rts_bordet"></span></td>-->
                                        <td class="numeric"><?php e($work_allc['tot_c_call']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($work_allc['tot_c_pending_call']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($work_allc['tot_activity']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($work_allc['tot_a_call']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($work_allc['tot_a_pending_call']); ?><span
                                                class="rts_bordet"></span></td>
                                        <td class="numeric"><?php e($work_allc['tot_pending_call']); ?><span
                                                class="rts_bordet"></span></td>
                                    </tr>
                                <? }
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-default close_default_bb" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
