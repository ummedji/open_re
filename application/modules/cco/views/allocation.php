<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="active"><a href="#">Farmers</a></li>
                        <li class=""><a href="#">Channel Partners</a></li>
                        <li><a href="#">Activity</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$attributes = array('class' => '', 'id' => 'cco_allocation','name'=>'cco_allocation', 'autocomplete'=>'off');
echo form_open('cco/add_allocation',$attributes); ?>

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Campaign Name<span style="color: red">*</span></label>

                        <div class="inln_fld">
                            <select class="selectpicker" id="campagain_data" name="campagain_data" data-live-search="true">
                                <option value="">Campaign Name</option>
                                <?php
                                if (isset($campagaine_data) && !empty($campagaine_data) && $campagaine_data != 0) {
                                    foreach ($campagaine_data as $k => $campagainedata) {
                                        ?>
                                        <option value="<?php echo $campagainedata['campaign_id']; ?>"><?php echo $campagainedata['campaign_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <label id="prod_sku-error" class="error" for="prod_sku"></label>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="col-md-12 ad_mr_top">
    <div class="row">

        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>
                    <th class="first_th">Level 3<span class="rts_bordet"></span></th>
                    <th class="numeric">Level 2<span class="rts_bordet"></span></th>
                    <th>Level 1<span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="geo_location_data">

                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="col-md-12 ad_mr_top">
    <div class="row">
        <label>CCO Name</label>
        <select id="cco_data" class="cco_data selectpicker" name="cco_data">
            <option value="">Select CCO</option>

            <?php
            if(!empty($cco_data)) {
                foreach ($cco_data as $c_key => $ccodata)
                {
            ?>
                    <option value="<?php echo $ccodata["id"]; ?>"><?php echo $ccodata["display_name"]; ?></option><?php
                }
            }
            ?>
        </select>
        <button style="display:none;" title="Save" type="submit" class="btn btn-primary save_btn">Save</button>
    </div>
</div>
<?php echo form_close(); ?>

<div id="middle_container" class="allocation_container">
    <?php
    //if ($this->input->is_ajax_request())
    {
        $attributes = array('class' => '', 'id' => 'update_target','name'=>'update_target');
        echo form_open('',$attributes);
        echo theme_view('common/middle');
        echo form_close();
    }
    ?>
</div>