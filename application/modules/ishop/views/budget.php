<?php
$attributes = array('class' => '', 'id' => 'budget','name'=>'budget');
echo form_open('',$attributes);
?>
<!--------------------------------------Filter1-------------------------------------------------->
<?php if (!$this->input->is_ajax_request()) { ?>
    <div class="col-md-12">
        <div class="top_form">
            <div class="row">

                <div class="col-md-12 text-center sub_nave">
                    <div class="inn_sub_nave">
                        <ul>
                            <?php
                            if($login_customer_type == 7){
                                ?>
                                <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='target') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/target') ?>">Target</a></li>
                                <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='budget') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/budget') ?>">Budget</a></li>
                            <?php } ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <?php
                if($login_customer_type == 7){
                    ?>
                    <div class="copy_btn">
                        <a href="javascript:void(0);" id="target_copy"  data-toggle="modal" data-target="#BudgetCopyModal">Copy</a>
                    </div>

                <?php } ?>

                <?php
                if($login_customer_type == 7){
                    ?>
                    <div class="col-md-12 text-center radio_space">
                        <div class="radio">
                            <input class="select_customer_type" type="radio" name="radio1" id="radio2" value="distributor" checked="checked" />
                            <label for="radio2">Distributor</label>
                        </div>
                        <div class="radio">
                            <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="retailer" />
                            <label for="radio1">Retailer</label>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                <?php } ?>


                <?php
                if($login_customer_type == 7 || $login_customer_type == 8){
                    ?>
                    <div class="col-md-10 col-md-offset-1 distributore_form distributor_data">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 tp_form">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Month<span style="color: red">*</span></label>
                                        <input type="text" name="month_data" id="month_data" class="form-control month_data" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 tp_form">
                                <div class="form-group">
                                    <label>Geo L3<span style="color: red">*</span></label>
                                    <select class="selectpicker" class="distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="distributor_geo_level_1_data" data-live-search="true">
                                        <option value="">Select Geo Level</option>
                                        <?php
                                        if(isset($geo_level_data) && !empty($geo_level_data))
                                        {
                                            foreach($geo_level_data as $key=>$val_geo_level_data)
                                            {
                                                ?>
                                                <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 tp_form">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Distributor Name<span style="color: red">*</span></label>
                                        <select class="selectpicker" id="distributor_distributor_id" name="distributor_distributor_id" data-live-search="true">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1 distributore_form retailer_data" style="display:none;">
                        <div class="row">

                            <div class="col-md-3 col-sm-3 tp_form">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Month<span style="color: red">*</span></label>
                                        <input type="text" name="ret_month_data" id="ret_month_data" class="form-control month_data" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 tp_form">
                                <div class="form-group">
                                    <label>Geo L3<span style="color: red">*</span></label>
                                    <select class="selectpicker retailer_geo_level_1_data"  id="retailer_geo_level_1_data" name="retailer_geo_level_1_data" data-live-search="true">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 tp_form">
                                <div class="form-group">
                                    <label>Geo L2<span style="color: red">*</span></label>
                                    <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="retailer_geo_level_2_data" data-live-search="true">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 tp_form">
                                <div class="form-group">
                                    <label>Retailer Name<span style="color: red">*</span></label>
                                    <select class="selectpicker" id="retailer_id" name="retailer_id" data-live-search="true" onchange="get_distributors('retailer')">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }?>

                <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>" />
                <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
                <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo  $current_user->country_id; ?>" />

                <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />


                <!--EXECUTE BUTTON--->

                <div class="clearfix"></div>

            </div>
        </div>
        <div class="clearfix"></div>

    </div>

    <!--------------------------------------Filter2-------------------------------------------------->

    <div class="col-md-12">
        <div class="row">
            <div class="middle_form">
                <div class="row">
                    <div class="col-md-4_ tp_form">
                        <div class="form-group">
                            <label>Product Sku Name<span style="color: red">*</span></label>
                            <select class="selectpicker" id="prod_sku" name="prod_sku" data-live-search="true">
                                <option value="">Product Name</option>
                                <?php
                                if(isset($product_sku) && !empty($product_sku))
                                {
                                    foreach($product_sku as $k=> $prd_sku)
                                    {
                                        ?>
                                        <option value="<?php echo $prd_sku['product_sku_country_id']; ?>" attr-name="<?php echo $prd_sku['product_sku_name']; ?>" attr-code="<?php echo $prd_sku['product_sku_code']; ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3_ tp_form">
                        <div class="form-group">
                            <label for="invoice_date">Quantity<span style="color: red">*</span></label>
                            <input type="text" class="form-control allownumericwithdecimal" id="quantity" name="quantity" placeholder="">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 save_btn">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
<?php }?>
<?php echo form_close(); ?>
<!--------------------------------------Table-------------------------------------------------->

<div id="middle_container" class="budget_container">
    <?php
    //if ($this->input->is_ajax_request())
    {
        $attributes = array('class' => '', 'id' => 'update_budget','name'=>'update_budget');
        echo form_open('',$attributes);
        echo theme_view('common/middle');
        echo form_close();
    }
    ?>
</div>
<!--------------------------------------Save & Upload Data-------------------------------------------------->

<?php
if (!$this->input->is_ajax_request()) {
    ?>
    <div class="check_save_btn" id="check_save_btn" style="display:none;">
        <div class="col-md-2 save_btn">
            <label>&nbsp;</label>
            <button type="submit" name="save" id="check_save" class="btn btn-primary gren_btn" style="margin-bottom: 50px">Save</button>
        </div>
    </div>
    <?php
}
?>
<div class="clearfix"></div>

<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12 table_bottom">
    
    <div class="row">
        <div class="col-md-3 save_btn"></div>
      <!--  <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div> -->
     <?php 
         $attributes = array('class' => '', 'id' => 'upload_budget_data','name'=>'upload_budget_data');
         echo form_open_multipart('',$attributes);
     ?>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-1 upload_text">Upload: </div>
                <div class="col-md-3 upload_file_space">
                    <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse <input type="file" name="upload_file_data" id="upload_file_data" />
                    </span> 
                </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
                   if($_SERVER['SERVER_NAME'] == "localhost"){
                       $folder = "open_re/trunk";
                   }
                   elseif($_SERVER['SERVER_NAME'] == "webcluesglobal.com"){
                       $folder = "qa/re";
                   }
                ?>
                <div class="col-md-8 chech_data"><button type="submit" class="btn btn-default">Check Data</button> <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $folder; ?>/public/assets/uploads/Uploads/budget/budget_distributor.xlsx","_blank" );' class="btn btn-default">Download Templates</a> <a style="display:none;" id="retailer_xl" href="javascript:void(0);" onclick='window.open("http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $folder; ?>/public/assets/uploads/Uploads/budget/budget_retailer.xlsx","_blank" );' class="btn btn-default">Download Templates</a></div>
                
                <?php echo form_close(); ?>
                
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="clearfix"></div>


<!-- Modal -->
<div id="BudgetCopyModal" class="modal fade tr_modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="popup_title">Copy Distributor Data</h4>
      </div>
    <?php 
        $attributes = array('class' => '', 'id' => 'copy_popup','name'=>'copy_popup');
        echo form_open('ishop/save_copy_popup',$attributes);
    ?>
        
      <div class="modal-body">
          <div class="col-md-12 distributore_form">
              <div class="row">
                  <div class="col-md-6 col-sm-6 tp_form radio_pr">
                      <div class="form-group" id="geo_data">
                          <label>Geo Level</label>
                          <!--<select id="geo_data">
                              <option value="0">Select Geo Level</option>
                          </select>-->
                          <select class="selectpicker" name="from_popup_geo_data" id="from_popup_geo_data">
                              <option value="0">Select Geo Level</option>
                                <?php
                                if(isset($geo_level_data) && !empty($geo_level_data))
                                {
                                    foreach($geo_level_data as $key=>$val_geo_level_data)
                                    {
                                        ?>
                                        <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                          </select>
                      </div>
                      <div class="form-group" id="from_customer_data">
                          <label>Customer Data</label>
                          <!--<select id="customer_data">
                              <option value="0">Select Distributor</option>
                          </select>-->
                          <select class="selectpicker" name="from_customer_data" id="from_customer_data">
                              <!--<option value="0">Select Distributor</option>-->
                          </select>
                      </div>
                      <div class="form-group" id="year_data">
                          <label>Select Year</label>
                          <input type="text" name="from_year_data" class="form-control" id="from_copy_popup_datepicker" />
                      </div>

                      <div class="radio_space" id="month_data">

                              <?php
                              for ($m=1; $m<=12; $m++) {
                                  $month = date('M', mktime(0,0,0,$m, 1, date('Y')));

                                  $j = $m;
                                  if($j <=9){
                                      $j = "0".$j;
                                  }
                                  ?>
                                  <div class="col-md-2 col-sm-2 col-xs-3 text-center">
                                      <div class="radio_bb">
                                          <input type="radio" class="radio_popup_month_data" name="radio_from_popup_month_data" id="<?php echo $j; ?>" value="<?php echo $j; ?>" />
                                          <label for="<?php echo $j; ?>"><span><span></span></span><div class="llb_text"><?php echo $month; ?></div></label>
                                      </div>
                                  </div>
                                  <?php
                              }

                              ?>

                              <div class="clearfix"></div>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 tp_form">
                      <div class="form-group" id="geo_data">
                          <label>Geo Level</label>
                          <!--<select >
                              <option >Select Geo Level</option>
                          </select>-->
                          <select class="selectpicker" name="to_popup_geo_data" id="to_popup_geo_data">
                              <option value="0">Select Geo Level</option>
                                <?php
                                if(isset($geo_level_data) && !empty($geo_level_data))
                                {
                                    foreach($geo_level_data as $key=>$val_geo_level_data)
                                    {
                                        ?>
                                        <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                          </select>
                      </div>
                      <div class="form-group" id="to_customer_data">
                          <label>Customer Data</label>
                          <!--<select id="customer_data">
                              <option value="0">Select Distributor</option>>
                          </select>-->
                          <select class="selectpicker" name="to_customer_data" id="to_customer_data">
                              <option value="0">Select Distributor</option>
                          </select>
                      </div>
                      <div class="form-group" id="year_data">
                          <label>Selecte Year</label>
                          <input type="text" name="to_year_data"  class="form-control" id="to_copy_popup_datepicker" />
                      </div>

                      <div id="month_data">

                          <fieldset>
                              <?php
                              for ($m=1; $m<=12; $m++) {
                                  $month = date('M', mktime(0,0,0,$m, 1, date('Y')));

                                  $j = $m;
                                  if($j <=9){
                                      $j = "0".$j;
                                  }
                                  ?>
                                  <div class="col-md-2 col-sm-2 col-xs-3 text-center">
                                  <div class="radio_bb">
                                  <input type="checkbox" name="checkbox_popup_month_data[]" id="<?php echo $month; ?>" value="<?php echo $j; ?>" />
                                  <label for="<?php echo $month; ?>"><span></span> <?php echo $month; ?> </label>
                                  </div>
                                  </div>
                                  <?php
                              }

                              ?>
                          </fieldset>
                      </div>
                  </div>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12 text-center">
              <input type="hidden" value="budget" name="popup_page" />
              <input type="submit" id="submit_copy_popup" value="Save" class="btn btn-primary save_default_bb" />

              <?php echo form_close(); ?>

              <button type="button" class="btn btn-default close_default_bb" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
  </div>
</div>