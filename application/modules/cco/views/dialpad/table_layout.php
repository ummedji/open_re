<div id="no-more-tables">
    <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
        <tr>
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
        </thead>

        <tbody class="tbl_body_row">

        <?php
        if(!empty($searched_data)) {
            foreach ($searched_data as $key => $searchdata) {
                ?>
                <tr>
                    <td><?php echo $searchdata['disease_name']; ?></td>
                    <td><?php echo $searchdata['symptoms_country_name']; ?></td>
                    <td><?php echo $searchdata['product_sku_name']; ?></td>
                    <td><?php echo $searchdata['crop_name']; ?></td>
                    <td><?php echo $searchdata['activity_planning_time']; ?></td>
                    <td><?php echo $searchdata['display_name']; ?></td>
                    <td><?php echo $searchdata['primary_mobile_no']; ?></td>
                    <td><?php echo $searchdata['activity_type_country_name']; ?></td>
                </tr>
            <?php
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