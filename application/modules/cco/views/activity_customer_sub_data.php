<div id="no-more-tables">
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
        <tr>
            <th><a href="javascript: void(0);">Call Name</a>
                <span class="rts_bordet"></span>
            </th>
            <th><a href="javascript: void(0);">First Name</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Last Name</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Primary No.</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Other No.</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">LandLine No.</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Pincode</a>
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
            <th class="numeric"><a href="javascript: void(0);">Existing or New</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Activity Type</a>
                <span class="rts_bordet"></span>
            </th>
           <!-- <th class="numeric"><a href="javascript: void(0);">Called Status</a>
                <span class="rts_bordet"></span>
            </th>-->
        </tr>
        </thead>
        <tbody class="dialpad_main_screen">

        <?php
        if(!empty($activity_customer_data))
        {

            if(!empty($activity_customer_data['key_customer'])){
                foreach($activity_customer_data['key_customer'] as $key_cust => $key_customer_data) {
                    ?>
                    <tr>
                        <td data-title="Call Name"><?php echo $key_customer_data["call_name"]; ?></td>
                        <td data-title="First Name"><?php echo  $key_customer_data["first_name"]; ?></td>
                        <td data-title="Last Name"><?php echo $key_customer_data["last_name"]; ?></td>
                        <td data-title="Primary No.">
                            <div>
                                <a href="javascript: void(0);" rel="<?php echo $key_customer_data["primary_mobile_no"]; ?>" class="primary_no" ><?php echo $key_customer_data["primary_mobile_no"]; ?></a>
                            </div>
                        </td>
                        <td data-title="Other No."><?php echo  $key_customer_data["secondary_mobile_no"]; ?></td>
                        <td data-title="LandLine No."><?php echo  $key_customer_data["landline_no"]; ?></td>
                        <td data-title="Pincode"><?php echo  $key_customer_data["pincode"]; ?></td>
                        <td data-title="Geo Level 3"><?php echo  $key_customer_data["level_2"]; ?></td>
                        <td data-title="Geo Level 2"><?php echo  $key_customer_data["level_3"]; ?></td>
                        <td data-title="Geo Level 1"><?php echo  $key_customer_data["level_4"]; ?></td>
                        <td data-title="Executed Date"><?php echo date($current_user->local_date.' g:i A',strtotime( $activity_customer_data["execution_time"])); ?></td>
                        <td data-title="Existing or New"><?php echo 'Existing'; ?></td>
                        <td data-title="Activity Type"><?php echo $activity_customer_data["activity_type_country_name"]; ?></td>
                    </tr>
                    <?php
                }
            }

            if(!empty($activity_customer_data['ad'])){
                foreach($activity_customer_data['ad'] as $key_attend => $key_attende_data) {
                    ?>
                    <tr>
                        <td data-title="Call Name"><?php echo '-'; ?></td>
                        <td data-title="First Name"><?php echo  $key_attende_data["customer_name"]; ?></td>
                        <td data-title="Last Name"><?php echo '-'; ?></td>
                        <td data-title="Primary No.">
                            <div>
                                <a href="javascript: void(0);" rel="<?php echo $key_attende_data["mobile_no"]; ?>" class="primary_no" ><?php echo $key_attende_data["mobile_no"]; ?></a>
                            </div>
                        </td>
                        <td data-title="Other No."><?php echo '-'; ?></td>
                        <td data-title="LandLine No."><?php echo '-'; ?></td>
                        <td data-title="Pincode"><?php echo '-'; ?></td>
                        <td data-title="Geo Level 3"><?php echo '-'; ?></td>
                        <td data-title="Geo Level 2"><?php echo  '-'; ?></td>
                        <td data-title="Geo Level 1"><?php echo  '-'; ?></td>
                        <td data-title="Executed Date"><?php echo date($current_user->local_date.' g:i A',strtotime($activity_customer_data["execution_time"])); ?></td>
                        <td data-title="Existing or New"><?php echo 'New'; ?></td>
                        <td data-title="Activity Type"><?php echo $activity_customer_data["activity_type_country_name"]; ?></td>
                    </tr>

                    <?php
                }
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