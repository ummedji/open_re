<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <?php
        $attributes = array('class' => '', 'id' => 'prespective_order','name'=>'prespective_order');
        echo form_open('ishop/get_prespective_order',$attributes); ?>

        <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>From Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="form_date" id="form_date" placeholder="" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label>To Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="to_date" id="to_date" placeholder="" autocomplete="off" >
                    </div>
                    <div class="inl_button save_btn">
                        <button id="get_prespective_order" type="submit" class="btn btn-primary gren_btn">Execute</button>
                    </div>
                </div>
               

        </div>
        
       <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>" /> 
      <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $login_customer_id; ?>" /> 
      <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $login_customer_countryid; ?>" /> 
            
      <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />
        
        <?php echo form_close(); ?>
    </div>
    
    <div class="clearfix"></div>
</div>
<?php }?>
<?php
echo theme_view('common/middle');
?>

<div id="middle_container" class="order_cont">

</div>
<div id="middle_container_product">

</div>

