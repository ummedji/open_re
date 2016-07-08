<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='dispatched') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/dispatched') ?>">Dispatched</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='pending') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/pending') ?>">Pending<div class="pending_counts"><?php echo $pending_count ?></div></a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='reject') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/reject') ?>">Reject</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_approval' && $this->uri->segment(3)=='all') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/all') ?>">All</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            
             <?php
                $attributes = array('class' => '', 'id' => 'order_approval','name'=>'order_approval');
                echo form_open('ishop/order_approval',$attributes);
             ?>
            
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>From Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="form_date" id="form_date" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label>To Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="to_date" id="to_date" placeholder="" >
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
                        <input class="renderdata" type="hidden" name="renderdata" id="" value="<?php echo $this->uri->segment(3); ?>" />

                        <div class="col-md-2 save_btn">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary gren_btn" style="margin-top: 3px;">Execute</button>
                        </div>
                    </div>
                </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php }?>
<div id="middle_container" class="order_approval">
<?php echo theme_view('common/middle'); ?>
</div>
<div id="middle_container_product" class="primary_product">

</div>
<?php if(!$this->input->is_ajax_request()){ ?>
<?php
    if($this->uri->segment(2) == "order_approval")
    {
    ?>

        <div class="col-md-12 extra_btn text-center" style="margin-top: 20px; margin-bottom: 10px;">
            <?php
        if($this->uri->segment(3) == 'dispatched')
        {
            ?>
            <a rel="pending" class="update_order_status btn btn-primary">Pending</a>
            <a rel="reject" class="update_order_status btn btn-primary">Reject</a>
            <?php
        }
        elseif($this->uri->segment(3) == 'pending')
        {
            ?>
            <a rel="dispatch" class="update_order_status btn btn-primary">Dispatch</a>
            <a rel="reject" class="update_order_status btn btn-primary">Reject</a>
            <?php
        }
        elseif($this->uri->segment(3) == 'reject')
        {
            ?>
            <a rel="dispatch" class="update_order_status btn btn-primary">Dispatch</a>
            <a rel="pending" class="update_order_status btn btn-primary">Pending</a>
            <?php
        }
        else{
?>          <a rel="dispatch" class="update_order_status btn btn-primary">Dispatch</a>
            <a rel="pending" class="update_order_status btn btn-primary">Pending</a>
            <a rel="reject" class="update_order_status btn btn-primary">Reject</a>
            <?php
        }
    ?>
    </div>

    <div class="clearfix"></div>
<?php }?>
<?php }?>
<div class="clearfix"></div>