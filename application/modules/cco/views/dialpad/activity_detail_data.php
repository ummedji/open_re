<?php if(!empty($activity_customer_data)) {
    ?>
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
        <tr>
            <th>Activity Name<span class="rts_bordet"></span></th>
            <th>Employee Name<span class="rts_bordet"></span></th>
            <th class="numeric">Mobile No.<span class="rts_bordet"></span></th>
            <th class="numeric">Crops<span class="rts_bordet"></span></th>
            <th class="numeric">Products<span class="rts_bordet"></span></th>
            <th class="numeric">Disease<span class="rts_bordet"></span></th>
            <th class="numeric">Attendee<span class="rts_bordet"></span></th>
            <th class="numeric">Geography<span class="rts_bordet"></span></th>
            <th class="numeric">Address<span class="rts_bordet"></span></th>
        </tr>
        </thead>
        <tbody class="dialpad_main_screen">
        <?php
      //  testdata($activity_customer_data);
        foreach($activity_customer_data as $key=>$activity_data)
        {
            if(!empty($activity_data['crop']))
            {
                $crp_array=array();
                foreach($activity_data['crop'] as $k=>$crp)
                {
                    $crp_array[]=$crp['crop_name'];
                }
                $crops = implode(', ',$crp_array);
            }
            else{
                $crops = '';
            }

            if(!empty($activity_data['products']))
            {
                $prd_array=array();
                foreach($activity_data['products'] as $k=>$prd)
                {
                    $prd_array[]=$prd['product_sku_name'];
                }
                $products = implode(', ',$prd_array);
            }
            else{
                $products = '';
            }

            if(!empty($activity_data['diseases']))
            {
                $des_array=array();
                foreach($activity_data['diseases'] as $k=>$des)
                {
                    $des_array[]=$des['disease_name'];
                }
                $disease = implode(', ',$des_array);
            }
            else{
                $disease = '';
            }

            if(!empty($activity_data['join_visit']))
            {
                $jv_array=array();
                foreach($activity_data['join_visit'] as $k=>$jv)
                {
                    $jv_array[]=$jv['display_name'];
                }
                $joint_visit = implode(', ',$jv_array);
            }
            else{
                $joint_visit = '';
            }

            ?>
            <tr>
                <td data-title="Activity Name"><?php echo $activity_data['activity_data']["activity_type_country_name"]; ?></td>
                <?php if(!empty($activity_data['join_visit'])){ ?>
                    <td data-title="Employee Name"><?php echo $activity_data['activity_data']["display_name"].', '.$joint_visit; ?></td>
                <?php }else{ ?>
                    <td data-title="Employee Name"><?php echo $activity_data['activity_data']["display_name"]; ?></td>
                <?php } ?>


                <td data-title="Mobile No."><?php echo $activity_data['activity_data']["primary_mobile_no"]; ?></td>
                <td data-title="Crops"><?php echo $crops; ?></td>
                <td data-title="Products"><?php echo $products; ?></td>
                <td data-title="Disease"><?php echo $disease; ?></td>
                <td data-title="Attendee"><?php echo $activity_data['activity_data']["proposed_attandence_count"]; ?></td>
                <td data-title="Geography"><?php echo $activity_data['activity_data']["political_geography_name"]; ?></td>
                <td data-title="Address"><?php echo $activity_data['activity_data']["location"]; ?></td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>
<?php }
else { ?>
    <h1 align="center" class="on_data">No Data Available</h1>
<?php }  ?>