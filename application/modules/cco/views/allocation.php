<?php if(!$this->input->is_ajax_request()){ ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='order_place') ? 'active' :'' ;?>"><a href="<?php echo base_url('/cco/allocation') ?>">Farmers</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='order_place') ? 'active' :'' ;?>"><a href="<?php echo base_url('/cco/channel_partner_allocation') ?>">Channel Partners</a></li>
                        <li><a href="#">Activity</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="copy_btn">
                    <a href="javascript:void(0);" id="work_allocated_summary"  data-toggle="modal" data-target="#WorkAllocatedSummary">Work Allocated Summary</a>
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
<?php } ?>
<div id="middle_container" class="allocation_container">
    <?php
    if($this->input->is_ajax_request())
    {
        echo theme_view('common/middle');
    }
    ?>

</div>


<!-- Modal -->
<div id="WorkAllocatedSummary" class="modal fade tr_modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="popup_title">Work Allocated Summary</h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12 distributore_form">
                    <div class="row">

                        <div id="no-more-tables">
                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                    <tr>
                                        <th class="first_th">CCO Name<span class="rts_bordet"></span></th>
                                        <th class="numeric">Allocated Campagain <span class="rts_bordet"></span></th>
                                        <th>Customer To Call<span class="rts_bordet"></span></th>
                                        <th class="numeric">Pending Customer To Call<span class="rts_bordet"></span></th>
                                        <th class="numeric">No. Of Activity<span class="rts_bordet"></span></th>
                                        <th class="numeric">No. Of Employee To Call<span class="rts_bordet"></span></th>
                                        <th class="numeric">No. Of Employee To Pending<span class="rts_bordet"></span></th>
                                        <th class="numeric">Total Call Pending<span class="rts_bordet"></span></th>
                                    </tr>
                                </thead>
                                <tbody id="order_place_data">
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-default close_default_bb" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

