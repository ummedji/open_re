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

            <div class="col-md-12 text-center tp_form">
                <div class="form-group">
                    <label>CCO Name</label>
                    <select id="cco_data" class="cco_data selectpicker" name="cco_data">
                        <option value="">Select CCO</option>
                        <?php if(!empty($cco_data)) {
                            foreach ($cco_data as $c_key => $ccodata) { ?>
                            <option value="<?php echo $ccodata["id"]; ?>"><?php echo $ccodata["display_name"]; ?></option>
                            <?php  }
                        } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cco_work_details">
    <div class="col-md-12">
        <div class="row">
            <div id="no-more-tables">
                <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table">
                    <thead class="cf">
                    <tr>
                        <th>Sr. No. <span class="rts_bordet"></span></th>
                        <th><span class="rts_bordet"></span></th>
                        <th>Allocated Campaign<span class="rts_bordet"></span></th>
                        <th class="numeric">Customer To Call<span class="rts_bordet"></span></th>
                        <th class="numeric">Customer Pending <span class="rts_bordet"></span></th>
                        <th class="numeric">Activity<span class="rts_bordet"></span></th>
                        <th class="numeric">Employee To Call<span class="rts_bordet"></span></th>
                        <th class="numeric">Employee Pending To Call<span class="rts_bordet"></span></th>
                        <th class="numeric">Total Call Pending</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-title="Sr. No." class="numeric">1.</td>
                        <td data-title="" class="numeric"></td>
                        <td data-title="Allocated Campaign">Product SKU 1</td>
                        <td data-title="Customer To Call">1 Kg.</td>
                        <td data-title="Customer Pending">1 Kg.</td>
                        <td data-title="Activity">1 Kg.</td>
                        <td data-title="Employee To Call">1 Kg.</td>
                        <td data-title="Employee Pending To Call">1 Kg.</td>
                        <td data-title="Total Call Pending">1 Kg.</td>

                    </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 text-center double-arrow">
    <a href="#"><img src="<?php echo Template::theme_url('images/double_arrow.svg'); ?>" alt=""></a>
</div>

<div id="cco_work_transfer_details">

    <div class="col-md-12">
        <div class="row">
            <div id="no-more-tables">
                <table class="col-md-12 table-bordered table-striped table-condensed cf" id="table">
                    <thead class="cf">
                    <tr>
                        <th>Sr. No. <span class="rts_bordet"></span></th>
                        <th><span class="rts_bordet"></span></th>
                        <th>CCO Name<span class="rts_bordet"></span></th>
                        <th>Allocated Campaign<span class="rts_bordet"></span></th>
                        <th class="numeric">Customer To Call<span class="rts_bordet"></span></th>
                        <th class="numeric">Customer Pending <span class="rts_bordet"></span></th>
                        <th class="numeric">Activity<span class="rts_bordet"></span></th>
                        <th class="numeric">Employee To Call<span class="rts_bordet"></span></th>
                        <th class="numeric">Employee Pending To Call<span class="rts_bordet"></span></th>
                        <th class="numeric">Total Call Pending</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-title="Sr. No." class="numeric">1.</td>
                        <td data-title="" class="numeric"></td>
                        <td data-title="CCO Name">Product SKU 1</td>
                        <td data-title="Allocated Campaign">Product SKU 1</td>
                        <td data-title="Customer To Call">1 Kg.</td>
                        <td data-title="Customer Pending">1 Kg.</td>
                        <td data-title="Activity">1 Kg.</td>
                        <td data-title="Employee To Call">1 Kg.</td>
                        <td data-title="Employee Pending To Call">1 Kg.</td>
                        <td data-title="Total Call Pending">1 Kg.</td>
                    </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
    <div class="save_button">
        <div class="row">
            <div class="col-md-3 save_btn">
                <button type="button" id="submit" class="btn btn-primary">Transfer</button>
            </div>
            <div class="delete_button">
                <div class="col-md-3 save_btn">
                    <button type="button" id ='cancel_data' class="btn btn-primary" style="background-color: red">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cco_allocation_details">

</div>

<div class="clearfix"></div>

