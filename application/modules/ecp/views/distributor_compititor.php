<?php $segment2 = $this->uri->segment(2);
$attributes = array('class' => '', 'id' => 'distributor_compititor','name'=>'distributor_compititor');
echo form_open('',$attributes); ?>
<div class="col-md-12 full-height">
    <div class="row">
        <div class="col-md-12">
            <div class="top_form">
                <div class="row">
                    <div class="col-md-12 text-center sub_nave">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="<?php echo ($segment2=='retailer_compititor_analysis' || $segment2=='retailer_compititor_product' || $segment2=='retailer_compititor_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_analysis')?>">Retailer</a></li>
                                <li class="<?php echo ($segment2=='distributor_compititor_analysis' || $segment2=='distributor_compititor_product' || $segment2=='distributor_compititor_view' ) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/distributor_compititor_analysis')?>">Distributor</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center sub_nave_sub">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="active"><a href="<?php echo base_url('ecp/distributor_compititor_analysis')?>">Total</a></li>
                                <li><a href="<?php echo base_url('ecp/distributor_compititor_product')?>">Product</a></li>
                                <li class="#"><a href="<?php echo base_url('ecp/distributor_compititor_view')?>">View</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2 distributore_form">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label for="month_data">Month<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="month_data" id="month_data" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Geo Level</label>
                                    <select class="selectpicker" id="geo_id" name="geo_id" data-live-search="true">
                                        <option value="">Geo Level Name</option>
                                        <?php
                                        if(isset($geo_level) && !empty($geo_level))
                                        {
                                            foreach($geo_level as $k=> $val_geo_level)
                                            {
                                                ?>
                                                <option value="<?php echo $val_geo_level['political_geo_id']; ?>"><?php echo $val_geo_level['political_geography_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Distributor Name</label>
                                    <select class="selectpicker" id="distributor_id" name="distributor_id" data-live-search="true">
                                        <option value="">Distributor Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $current_user->role_id; ?>" />
<input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
<input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo  $current_user->country_id; ?>" />

<input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Compititors Name</label>
                        <select class="selectpicker" id="compititor_id" name="compititor_id" data-live-search="true">
                            <option value="">Compititors Name</option>
                            <?php
                            if(isset($compititor) && !empty($compititor))
                            {
                                foreach($compititor as $k=> $val_compititor)
                                {
                                    ?>
                                    <option value="<?php echo $val_compititor['compititor_id']; ?>" attr-name="<?php echo $val_compititor['compititor_name']; ?>"><?php echo $val_compititor['compititor_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <label id="prod_sku-error" class="error" for="prod_sku"></label>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Amount<span style="color: red">*</span></label>
                        <input type="text" class="form-control allownumericwithdecimal" id="amt" name="amt" placeholder="">
                    </div>
                    <label id="amt-error" class="error" for="amt"></label>
                </div>
                <div class="plus_btn"><a href="#" id="add_row"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
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
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th class="numeric">Action <span class="rts_bordet"></span></th>
                    <th class="numeric">Entry Date <span class="rts_bordet"></span></th>
                    <th>Compititor Name <span class="rts_bordet"></span></th>
                    <th class="numeric">Amount <span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="distributor_comp">
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="save_button" style="display: none">
    <div class="col-md-12 table_bottom">
        <div class="row">
            <div class="col-md-3 save_btn">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<div class="clearfix"></div>