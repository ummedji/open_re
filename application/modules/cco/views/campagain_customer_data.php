    <div id="no-more-tables">
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
        <tr>
            <th><a href="javascript: void(0);">Farmer Call Name</a>
                <span class="rts_bordet"></span>
            </th>
            <th><a href="javascript: void(0);">First Name</a>
                <span class="rts_bordet"></span>
            </th>
            <th><a href="javascript: void(0);">Last Name</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Primary No.</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Other No.</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Fixed Landline No.</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Pincode</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Level 3</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Level 2</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Level 1</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Remarks</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Comments</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Hectares Of Land</a>
                <span class="rts_bordet"></span>
            </th>

            <!---NEED TO DYNAMIC AS PER NO. OF PHASES IN CAMPAGAIN--->

            <th class="numeric"><a href="javascript: void(0);">Phase 1</a>
                <span class="rts_bordet"></span>
            </th>
            <th class="numeric"><a href="javascript: void(0);">Phase 1 Open/Close</a>
                <span class="rts_bordet"></span>
            </th>

        </tr>
        </thead>
        <tbody class="dialpad_main_screen">

        <?php
        if(!empty($campagain_customer_data))
        {
            foreach($campagain_customer_data as $key=>$cust_data)
            {
                ?>
                <tr>
                    <td data-title="Farmer Call Name"><?php echo $cust_data["call_name"]; ?></td>

                    <td data-title="First Name"><?php echo $cust_data["first_name"]; ?></td>
                    <td data-title="Last Name"><?php echo $cust_data["last_name"]; ?></td>
                    <td data-title="Primary No.">
                        <div>
                            <a href="javascript: void(0);" rel="<?php echo $cust_data["primary_mobile_no"]; ?>" class="primary_no" ><?php echo $cust_data["primary_mobile_no"]; ?></a>
                        </div>
                    </td>
                    <td data-title="Other No."><?php echo $cust_data["secondary_mobile_no"]; ?></td>
                    <td data-title="Fixed Landline No."><?php echo $cust_data["landline_no"]; ?></td>
                    <td data-title="Pincode"><?php echo $cust_data["pincode"]; ?></td>
                    <td data-title="Level 3"><?php echo $cust_data["level3"]; ?></td>
                    <td data-title="Level 2"><?php echo $cust_data["level2"]; ?></td>
                    <td data-title="Level 1"><?php echo $cust_data["level1"]; ?></td>
                    <td data-title="Remarks"><?php echo $cust_data["remarks"]; ?></td>
                    <td data-title="Comments"><?php echo $cust_data["comments"]; ?></td>
                    <td data-title="Hectares Of Land"><?php echo $cust_data["land_size"]; ?></td>

                    <td data-title="Phase 1"></td>
                    <td data-title="Phase 1 Open/Close"></td>

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