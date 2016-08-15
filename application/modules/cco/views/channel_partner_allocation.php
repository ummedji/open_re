<?php if(!$this->input->is_ajax_request()){ ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/allocation') ?>">Farmers</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='channel_partner_allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/channel_partner_allocation') ?>">Channel Partners</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='allocation_activity') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/allocation_activity') ?>">Activity</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='work_transfer_allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/work_transfer_allocation') ?>">Work Transfer</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-12 text-center radio_space">
                <div class="radio">
                    <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="retailer" checked="checked" />
                    <label for="radio1">Retailer</label>
                </div>
                <div class="radio">
                    <input class="select_customer_type" type="radio" name="radio1" id="radio2" value="distributor" />
                    <label for="radio2">Distributor</label>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>


<?php
$attributes = array('class' => '', 'id' => 'cco_allocation','name'=>'cco_allocation', 'autocomplete'=>'off');
echo form_open('cco/add_allocation',$attributes);
?>

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

                            <input type="hidden" id="selected_type_data" name="selected_type" value="retailer"/>

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

<div class="col-md-12 cco_name_par text-center tp_form inline-parent">
    <div class="form-group">
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
        <div class="inl_button save_btn" style="vertical-align: top;">
           <button style="display:none;" title="Save" type="submit" class="btn btn-primary save_btn">Save</button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<?php } ?>
<div id="middle_container" class="allocation_container">
    <?php
    if($this->input->is_ajax_request())
    {
        echo theme_view('common/middle');
    }
    ?>

</div>
