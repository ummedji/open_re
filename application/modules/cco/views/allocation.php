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

        <div class="zoom_space">
            <ul>
                <li><a href="javascript: void(0);"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                <li><a href="javascript: void(0);" class="zoom_in_btn"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" class="show_tb_arrow" alt=""></a></li>
                <li class="zoom_out_btn"><a href="javascript: void(0);" ><img src="<?php echo Template::theme_url('images/zooming_icon_.png'); ?>" class="hide_tb_arrow_" alt=""></a></li>
            </ul>
        </div>

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

                <?php
                if(!empty($highest_geo_level_data))
                {
                    foreach ($highest_geo_level_data as $key => $level_data)
                    {
                ?>
                      <tr><td><input rel="<?php echo $level_data["political_geo_id"]; ?>" type="checkbox" name="level_3" class="level_3" value="<?php echo $level_data["political_geography_name"]; ?>"/><?php echo $level_data["political_geography_name"]; ?><input type="hidden" name="geo_name" value="<?php echo $level_data["political_geo_id"]; ?>" /></td><td></td><td></td></tr>
                <?php
                    }
                }

                ?>

                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>