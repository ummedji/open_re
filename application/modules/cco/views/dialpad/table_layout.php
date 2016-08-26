<div id="no-more-tables">
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">

        <?php
        if($search_type == "disease"){
        ?>

            <tr>
                <th>
                    Sr. No.
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Name Of Disease
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Symptoms
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Product Details
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Crops
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Activity dates
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Employee Name
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Employee Contact No.
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Activity Name
                    <span class="rts_bordet"></span>
                </th>
            </tr>
        <?php
        }
        else
        {
            ?>
            <tr>
                <th>
                    Sr. No.
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Product Details
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Name Of Disease
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Symptoms
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Crops
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Activity dates
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Employee Name
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Employee Contact No.
                    <span class="rts_bordet"></span>
                </th>
                <th>
                    Activity Name
                    <span class="rts_bordet"></span>
                </th>
            </tr>
        <?php

        }
        ?>

        </thead>

        <tbody class="tbl_body_row">

        <?php
        if(!empty($searched_data)) {

            if($search_type == "disease")
            {
                $i = 1;
                foreach ($searched_data as $key => $searchdata) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo (isset($searchdata['disease_name']) && !empty($searchdata['disease_name']))?$searchdata['disease_name'] : ""; ?></td>
                        <td><?php echo (isset($searchdata['symptoms_country_name']) && !empty($searchdata['symptoms_country_name']))?$searchdata['symptoms_country_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['product_sku_name']) && !empty($searchdata['product_sku_name']))?$searchdata['product_sku_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['crop_name']) && !empty($searchdata['crop_name']))?$searchdata['crop_name'] : ""; ?></td>
                        <td><?php echo (isset($searchdata['activity_planning_time']) && !empty($searchdata['activity_planning_time']))?$searchdata['activity_planning_time'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['display_name']) && !empty($searchdata['display_name']))?$searchdata['display_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['primary_mobile_no']) && !empty($searchdata['primary_mobile_no']))?$searchdata['primary_mobile_no'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['activity_type_country_name']) && !empty($searchdata['activity_type_country_name']))?$searchdata['activity_type_country_name'] : ""; ?></td>
                    </tr>
                <?php
                    $i++;
                }
            }
            elseif($search_type == "product")
            {
                $j = 1;
                foreach ($searched_data as $key => $searchdata) {
                   ?>
                    <tr>
                        <td><?php echo $j; ?></td>

                        <td><?php echo (isset($searchdata['product_sku_name']) && !empty($searchdata['product_sku_name']))?$searchdata['product_sku_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['disease_name']) && !empty($searchdata['disease_name']))?$searchdata['disease_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['symptoms_country_name']) && !empty($searchdata['symptoms_country_name']))?$searchdata['symptoms_country_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['crop_name']) && !empty($searchdata['crop_name']))?$searchdata['crop_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['activity_planning_time']) && !empty($searchdata['activity_planning_time']))?$searchdata['activity_planning_time'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['display_name']) && !empty($searchdata['display_name']))?$searchdata['display_name'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['primary_mobile_no']) && !empty($searchdata['primary_mobile_no']))?$searchdata['primary_mobile_no'] : ""; ?></td>

                        <td><?php echo (isset($searchdata['activity_type_country_name']) && !empty($searchdata['activity_type_country_name']))?$searchdata['activity_type_country_name'] : ""; ?></td>

                    </tr>
                    <?php
                    $j++;
                }
            }
        }
        else{
        ?>
            <tr>
            <td colspan="8">No data found</td>
                </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="clearfix"></div>
</div>