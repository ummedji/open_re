<?php if($activity_type == 'planned_activity') { ?>
    <div id="no-more-tables">
        <table class="col-md-12 table-bordered table-striped table-condensed cf">
            <thead class="cf">
            <tr>
                <th><a href="javascript: void(0);">Employee Code</a>
                    <span class="rts_bordet"></span>
                </th>
                <th><a href="javascript: void(0);">Employee Name</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Designation</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Primary No.</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Geo Level 3</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Geo Level 2</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Geo Level 1</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Planned Date</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Customers</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Activity Type</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Called Status</a>
                    <span class="rts_bordet"></span>
                </th>
            </tr>
            </thead>
            <tbody class="dialpad_main_screen">

            <?php
            if(!empty($activity_customer_data))
            {
                foreach($activity_customer_data as $key=>$activity_data)
                {

                    ?>
                    <tr>
                        <td data-title="Employee Code"><?php echo $activity_data["user_code"]; ?></td>
                        <td data-title="Employee Name"><?php echo $activity_data["display_name"]; ?></td>
                        <td data-title="Designation"><?php echo $activity_data["desigination_country_name"]; ?></td>
                        <td data-title="Primary No.">
                            <div>
                                <a href="javascript: void(0);" rel-activity_id="<?php echo $activity_data['activity_planning_id']?>" rel-activity_type="planned_activity" rel="<?php echo $activity_data["primary_mobile_no"]; ?>" class="primary_no" ><?php echo $activity_data["primary_mobile_no"]; ?></a>
                            </div>
                        </td>
                        <td data-title="Geo Level 3"><?php echo $activity_data["level_2"]; ?></td>
                        <td data-title="Geo Level 2"><?php echo $activity_data["level_3"]; ?></td>
                        <td data-title="Geo Level 1"><?php echo $activity_data["level_4"]; ?></td>
                        <td data-title="Planned Date"><?php echo date($current_user->local_date.' g:i A',strtotime($activity_data["activity_planning_time"])); ?></td>
                        <td data-title="Customers"><?php echo $activity_data["proposed_attandence_count"]; ?></td>
                        <td data-title="Activity Type"><?php echo $activity_data["activity_type_country_name"]; ?></td>
                        <?php if($activity_data["called_status"] == '0')
                        {
                            $status = 'Pending';
                        }
                        else{
                            $status = 'Done';
                        }?>
                        <td data-title="Called Status"><?php echo $status; ?></td>
                    </tr>
                    <?php
                }
            }
            else{
                ?>
                <h1 align="center" class="on_data">No Data Available</h1>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
<?php }elseif($activity_type == 'executed_activity'){ ?>
    <div id="no-more-tables">
        <table class="col-md-12 table-bordered table-striped table-condensed cf">
            <thead class="cf">
            <tr>
                <th><a href="javascript: void(0);">Employee Code</a>
                    <span class="rts_bordet"></span>
                </th>
                <th><a href="javascript: void(0);">Employee Name</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Designation</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Geo Level 3</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Geo Level 2</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Geo Level 1</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Executed Date</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Key Retailer / Key Farmer</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Activity Type</a>
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric"><a href="javascript: void(0);">Called Status</a>
                    <span class="rts_bordet"></span>
                </th>
            </tr>
            </thead>
            <tbody class="dialpad_main_screen">

            <?php
            if(!empty($activity_customer_data))
            {
                foreach($activity_customer_data as $key=>$activity_data)
                {
                    ?>
                    <tr id="<?php echo $activity_data['activity_details']["activity_planning_id"];?>" class="activity_details">
                        <td data-title="Employee Code"><?php echo $activity_data['activity_details']["user_code"]; ?></td>
                        <td data-title="Employee Name"><?php echo  $activity_data['activity_details']["display_name"]; ?></td>
                        <td data-title="Designation"><?php echo  $activity_data['activity_details']["desigination_country_name"]; ?></td>
                        <td data-title="Geo Level 3"><?php echo  $activity_data['activity_details']["level_2"]; ?></td>
                        <td data-title="Geo Level 2"><?php echo  $activity_data['activity_details']["level_3"]; ?></td>
                        <td data-title="Geo Level 1"><?php echo  $activity_data['activity_details']["level_4"]; ?></td>
                        <td data-title="Planned Date"><?php echo date($current_user->local_date.' g:i A',strtotime( $activity_data['activity_details']["execution_time"])); ?></td>
                        <td data-title="Key Retailer / Key Farmer"><?php echo $activity_data["customer_count"]; ?></td>
                        <td data-title="Activity Type"><?php echo $activity_data['activity_details']["activity_type_country_name"]; ?></td>
                        <?php
                            if($activity_data['activity_details']["called_status"] == '0')
                            {
                                $status = 'Pending';
                            }
                            else{
                                $status = 'Done';
                            }?>
                        <td data-title="Called Status"><?php echo $status; ?></td>
                    </tr>
                        <?php

                }
            }
            else{
                ?>
                <h1 align="center" class="on_data">No Data Available</h1>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>

<?php } else{ ?>
    <h1 align="center" class="on_data">No Data Available</h1>
<?php } ?>

<div id='executed_customer'>

</div>
