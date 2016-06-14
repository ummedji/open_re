<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='dispatched') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/dispatched') ?>">Dispatched</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='pending') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/pending') ?>">Pending</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='reject') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/reject') ?>">Reject</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='all') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/all') ?>">All</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            
             <?php
                $attributes = array('class' => '', 'id' => 'order_approval','name'=>'order_approval');
                //echo form_open($this->uri->uri_string(),$attributes);
                echo form_open('',$attributes);
             ?>
            
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>From Date</label>
                        <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>TO Date</label>
                        <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="invoice_date">Search By PO No.</label>
                                <input type="text" class="form-control" name="by_po_no" id="by_po_no" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="invoice_date">Search By Order Tracking No.</label>
                                <input type="text" class="form-control" name="by_otn" id="by_otn" placeholder="">
                            </div>
                        </div>

                        <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>" />
                        <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $login_customer_id; ?>" />
                        <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $login_customer_countryid; ?>" />

                        <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />



                        <div class="col-md-2 save_btn">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary gren_btn">Execute</button>
                        </div>
                    </div>
                </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php }?>
<div id="order_approval_middle_container" class="order_approval">
<?php echo theme_view('common/middle'); ?>
</div>
<div id="order_approval_table_container" class="primary_product">

</div>

<div class="clearfix"></div>