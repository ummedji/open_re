<?php
$attributes = array('class' => '', 'id' => 'add_user_credit_limit','name'=>'add_user_credit_limit');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center tp_form">
                <div class="form-group">
                    <label>Distributor Name</label>
                    <select class="selectpicker" name="dist_limit" id="dist_limit">
                        <option value="0">Select Distributor Name</option>
                        <?php
                        if(isset($distributor) && !empty($distributor))
                        {
                            foreach($distributor as $key=>$val_distributor)
                            {
                                ?>
                                <option value="<?php echo $val_distributor['id']; ?>"><?php echo $val_distributor['display_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
                <div class="row">
                    <div class="col-md-2_ tp_form">
                        <div class="form-group">
                            <label for="credit_limit">Credit Limit</label>
                            <input type="text" class="form-control" name="credit_limit" id="credit_limit" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3_ tp_form">
                        <div class="form-group">
                            <label for="invoice_date">Current Outstanding</label>
                            <input type="text" class="form-control" name="curr_outstanding" id="curr_outstanding" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-2_ tp_form">
                        <div class="form-group">
                            <label for="curr_date">Date</label>
                            <input type="text" class="form-control" name="curr_date" id="curr_date" placeholder="">
                        </div>
                    </div>
                    <div class="svn_btn"><button type="submit" class="btn btn-primary gren_btn">Save</button></div>
                </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php
echo theme_view('common/middle');
?>
<?php echo form_close(); ?>