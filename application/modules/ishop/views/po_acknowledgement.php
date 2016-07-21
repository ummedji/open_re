<?php
 if (!$this->input->is_ajax_request()) {
 ?>
<!--------------------------------------Filter1-------------------------------------------------->

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
          
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_place') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_place') ?>">Order Place</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_status') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_status') ?>">Order Status</a></li>
                        <?php 
                        if($login_customer_type == 9 || $login_customer_type == 10){
                        ?>
                            <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='po_acknowledgement') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/po_acknowledgement') ?>">PO Acknowledgment</a></li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php 
           $attributes = array('class' => '', 'id' => 'po_acknowledgement','name'=>'po_acknowledgement');
            echo form_open('ishop/po_acknowledgement',$attributes);
            ?>
           <?php
         if($login_customer_type == 9){
        ?>
            
            <div class="col-md-6 text-center radio_space">
                <div class="clearfix"></div>
            </div>
            
        <?php }else if($login_customer_type == 10){ ?>
            
            
            <div class="col-md-6 col-md-offset-3 distributore_form distributor_data">
                    
                </div>
            
            <?php } ?>
            
            
            
            <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>" /> 
            <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $login_customer_id; ?>" /> 
            <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $login_customer_countryid; ?>" /> 
            
            <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" /> 
           
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<?php } ?>

<?php

echo theme_view('common/middle');


if (!$this->input->is_ajax_request()) { ?>
<?php
$attributes = array('class' => '', 'id' => 'update_po_data','name'=>'update_po_data');
echo form_open('',$attributes);
?>

<div id="middle_container" class="po_acknowledgement">

</div>
<div id="middle_container_product">

</div>
<?php echo form_close(); ?>


<div class="clearfix"></div>
 <?php
}
?>