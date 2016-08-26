<?php
//testdata($cco_work_details);
if(isset($cco_work_details) && !empty($cco_work_details)) {?>
<div class="col-md-12">
    <div class="row">
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table">
                <thead class="cf">
                <tr>
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th><span class="rts_bordet"></span></th>
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
                <tbody class="tbl_body_row">
                    <?php
                    $i = 1;
                    $j = 0;
                    foreach($cco_work_details as $k=>$cwd){
                        ?>
                        <tr>
                            <td data-title="Sr. No." class="numeric"><?php echo $i;?></td>
                            <?php if(!empty($cwd['allocation_id'])){
                                $allocation_id = $cwd['allocation_id'];
                            }
                            else{
                                $allocation_id = $cwd['activity_allocation_id'];
                            }
                            ?>
                            <td data-title="" class="numeric"><input type="checkbox" attr-check="<?php echo $allocation_id ;?>" name="allocation_id[<?php echo $j; ?>]" value="<?php echo $allocation_id ;?>" id="allocation_id" class="check_checked"/><input type="hidden" name="allocation_type[<?php echo $j; ?>]" id="allocation_type" value="<?php echo $cwd['allocation_type']?>"></td>
                            <td data-title="Allocated Campaign"><?php echo $cwd['campaign_name']?></td>
                            <td data-title="Customer To Call"><?php echo $cwd['customer_count'];?></td>
                            <td data-title="Total Call"><?php echo $cwd['tot_c_call'];?></td>
                            <td data-title="Customer Pending"><?php echo $cwd['tot_c_pending_call'];?></td>
                            <td data-title="Activity"><?php echo $cwd['activity_name'];?></td>
                            <td data-title="Employee To Call"><?php echo $cwd['tot_a_call'];?></td>
                            <td data-title="Employee Pending To Call"><?php echo $cwd['tot_a_pending_call'];?></td>
                            <td data-title="Total Call Pending"><?php echo $cwd['tot_pending_call'];?></td>
                        </tr>
                    <?php
                        $i++;
                        $j++;
                    } ?>
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php } ?>

<div class="col-md-12 text-center double-arrow" style="display: none">
    <a href="#" id='alot_transfer'><img src="<?php echo Template::theme_url('images/double_arrow.svg'); ?>" alt=""></a>
</div>
