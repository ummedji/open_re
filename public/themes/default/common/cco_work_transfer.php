<?php //testdata($cco_work_transfer); ?>
<?php if(isset($cco_work_transfer) && !empty($cco_work_transfer)) { ?>
<div class="col-md-12">
    <div class="row">
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table">
                <thead class="cf">
                <tr>
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th><span class="rts_bordet"></span></th>
                    <th>CCO Name<span class="rts_bordet"></span></th>
                    <th>Allocated Campaign<span class="rts_bordet"></span></th>
                    <th class="numeric">Customer To Call<span class="rts_bordet"></span></th>
                    <th class="numeric">Total Call<span class="rts_bordet"></span></th>
                    <th class="numeric">Customer Pending <span class="rts_bordet"></span></th>
                    <th class="numeric">Activity<span class="rts_bordet"></span></th>
                    <th class="numeric">Employee To Call<span class="rts_bordet"></span></th>
                    <th class="numeric">Employee Pending To Call<span class="rts_bordet"></span></th>
                    <th class="numeric">Total Call Pending</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach($cco_work_transfer as $cwt) {?>
                    <tr>
                        <td data-title="Sr. No." class="numeric"><?php echo $i;?></td>
                        <td data-title="" class="numeric">
                            <input type="radio" name="cco_id" id="cco_id" class="cco_id" value="<?php echo $cwt['cco_id'];?>" />
                        </td>
                        <td data-title="CCO Name"><?php echo $cwt['cco_name'];?></td>
                        <td data-title="Allocated Campaign"><?php echo $cwt['tot_campaign'];?></td>
                        <td data-title="Customer To Call"><?php echo $cwt['tot_c_customer'];?></td>
                        <td data-title="Total Call"><?php echo $cwt['tot_c_call'];?></td>
                        <td data-title="Customer Pending"><?php echo $cwt['tot_c_pending_call'];?></td>
                        <td data-title="Activity"><?php echo $cwt['tot_activity'];?></td>
                        <td data-title="Employee To Call"><?php echo $cwt['tot_a_call'];?></td>
                        <td data-title="Employee Pending To Call"><?php echo $cwt['tot_a_pending_call'];?></td>
                        <td data-title="Total Call Pending"><?php echo $cwt['tot_pending_call'];?></td>
                    </tr>
                    <?php
                    $i++;
                    } ?>
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php } ?>