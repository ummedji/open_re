<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <!-- <h4 class="modal-title">Header title</h4> -->
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">PO No:</label>
                    <input type="hidden" name="order_id" value=""  id="order_data" class="form-control po_number_data" />
                    <input type="text" name="po_no" value=""  id="po_number_data" class="form-control po_number_data" />
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <button id="save_po_data" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php
 if (!$this->input->is_ajax_request()) {
 ?>
<!--------------------------------------Filter1-------------------------------------------------->

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
          
           <?php 
           $attributes = array('class' => '', 'id' => 'order_status','name'=>'order_status');
            echo form_open('ishop/get_order_status_data',$attributes);
            ?>
            
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_place') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_place') ?>">Order Place</a></li>
                        <li  class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_status') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_status') ?>">Order Status</a></li>
                        <?php 
                        if($login_customer_type == 9 || $login_customer_type == 10){
                        ?>
                            <li  class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='po_acknowledgement') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/po_acknowledgement') ?>">PO Acknowledgment</a></li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            
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
            
                <div class="col-md-6 col-md-offset-3 distributore_form distributor_data">
                    <div class="row">
                        
                        <div class="col-md-6 col-sm-6 tp_form">
                    
                            <div class="form-group">
                            <label>Geo L1</label>
                            <select class="selectpicker" class="distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="dis_distributor_geo_level_1_data" data-live-search="true">
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
                    </div>
                        
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <div class="form-group">
                                <label>Distributor Name</label>
                                <select class="selectpicker" id="distributor_distributor_id" name="distributor_id" data-live-search="true">
                                   <!-- <option value="0">Select Distributor Name</option> -->
                                    <?php
                                  /*  if(isset($distributor) && !empty($distributor))
                                    {
                                        foreach($distributor as $key=>$val_distributor)
                                        {
                                            ?>
                                            <option value="<?php echo $val_distributor['id']; ?>"><?php echo $val_distributor['display_name']; ?></option>
                                            <?php
                                        }
                                    }*/
                                    ?> 
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1 distributore_form retailer_data" style="display:none;">
                <div class="row">
                    
                     <div class="col-md-4 col-sm-4 tp_form">

                             <div class="form-group">
                                <label>Geo L2</label>
                                <select class="selectpicker retailer_geo_level_1_data"  id="retailer_geo_level_1_data" name="retailer_geo_level_1_data" data-live-search="true">

                                </select>

                            </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 tp_form">
                    
                        <div class="form-group">
                            <label>Geo L1</label>
                            <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="retailer_geo_level_2_data" data-live-search="true">

                            </select>
                    
                        </div>
                    </div>
                
                    
                    <div class="col-md-4 col-sm-4 tp_form">
                        <div class="form-group">
                                <label>Retailer Name</label>
                                <select class="selectpicker" id="retailer_id" name="retailer_id" data-live-search="true">
                                 <!--   <option value="0">Select Retailer Name</option> -->
                                    <?php
                                   /* if(isset($retailer) && !empty($retailer))
                                    {
                                        foreach($retailer as $key=>$val_retailer)
                                        {
                                            ?>
                                            <option value="<?php echo $val_retailer['id']; ?>"><?php echo $val_retailer['display_name']; ?></option>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </select>
                            </div>
                    </div>
                    
                  <!--  <div class="col-md-4 col-sm-4 tp_form">
                        <div class="form-group">
                                <label>Distributor Name</label>
                                <select class="selectpicker" id="retailer_distributor_id" name="distributor_id" data-live-search="true">
                                    
                                </select>
                            </div>
                    </div> -->
                </div>
            </div>

                    <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>TO Date</label>
                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                        </div>
                        <div class="inl_button save_btn"><button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute</button></div>
                    </div>

        <?php }
        else if($login_customer_type == 9){
        ?>
            
            <div class="col-md-6 text-center radio_space">
                <div class="clearfix"></div>
            </div>

            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                <div class="form-group">
                    <label>From Date</label>
                    <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                </div>
                <div class="form-group">
                    <label>TO Date</label>
                    <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                </div>
                <div class="inl_button save_btn"><button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute</button></div>
            </div>

            
        <?php }else if($login_customer_type == 10){ ?>
            
            
            <div class="col-md-6 col-md-offset-3 distributore_form distributor_data">
                    
                </div>


            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                <div class="form-group">
                    <label>From Date</label>
                    <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                </div>
                <div class="form-group">
                    <label>TO Date</label>
                    <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                </div>
                <div class="inl_button save_btn"><button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute</button></div>
            </div>
            
            <?php } ?>
            
            
            <?php 
                if($login_customer_type == 8){
            ?>
                <div class="col-md-12 text-center radio_space">
                    
                     <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="farmer" checked="checked"/>
                        <label for="radio1">Farmer</label>
                    </div>
                    
                     <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="retailer" />
                        <label for="radio1">Retailer</label>
                    </div>
                    
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio2" value="distributor" />
                        <label for="radio2">Distributor</label>
                    </div>
                   
                    <div class="clearfix"></div>
                </div>
            
            <div class="farmer_checked" id="farmer_checked">
            
                 <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <div class="form-group">
                        <label>Order Tracking No.</label>
                        <input type="text" name="order_tracking_no" class="order_tracking_no form-control" id="order_tracking_no" />
                    </div>
                    </div>
                     <div class="inl_button save_btn">
                            <button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute</button>
                     </div>
                </div>
                
            <div class="clearfix"></div></br>
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Geo L2</label>
                        <select class="selectpicker geo_level_1_data" id="geo_level_1_data" name="geo_level_1_data" data-live-search="true">
                            <!--  <option value="0">Select Geo Level</option> -->
                            <?php
                            /*  if(isset($geo_level_data) && !empty($geo_level_data))
                              {
                                  foreach($geo_level_data as $key=>$val_geo_level_data)
                                  {
                                      ?>
                                      <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                      <?php
                                  }
                              } */
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Geo L1</label>
                        <select class="selectpicker geo_level_2_data" class="" id="geo_level_2_data" name="geo_level_1_data" data-live-search="true">
                            <!--  <option value="0">Select Geo Level</option> -->
                            <?php
                            /*   if(isset($geo_level_data) && !empty($geo_level_data))
                                 {
                                     foreach($geo_level_data as $key=>$val_geo_level_data)
                                     {
                                         ?>
                                         <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                         <?php
                                     }
                                 } */
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Farmer Name</label>
                        <select class="selectpicker" id="farmer_data" name="farmer_data" data-live-search="true">

                        </select>
                    </div>
                </div>

            
                 
                
                
            
            </div>
            
            <div class="retailer_checked" id="retailer_checked" style="display:none;">
                
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Geo L3</label>
                        <select class="selectpicker retailer_geo_level_1_data" id="retailer_geo_level_1_data" name="geo_level_1_data" data-live-search="true">

                        </select>

                    </div>
                    <div class="form-group">
                        <label>Geo L2</label>
                        <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="geo_level_1_data" data-live-search="true">

                        </select>

                    </div>

                    <div class="form-group">
                        <label>Retailer Name</label>
                        <select class="selectpicker" id="retailer_data" name="retailer_data" data-live-search="true" >

                        </select>

                    </div>

                </div>

                
                

                
                
            </div>
            
            <div class="distributor_checked" id="distributor_checked" style="display:none;">
                
                
                <div class="col-md-12 text-center tp_form inline-parent">
                    
                        <div class="form-group">
                        <label>Geo L2</label>
                        <select class="selectpicker distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="geo_level_1_data" data-live-search="true">
                          <!--  <option value="0">Select Geo Level</option> -->
                            <?php
                         /*   if(isset($geo_level_data) && !empty($geo_level_data))
                            {
                                foreach($geo_level_data as $key=>$val_geo_level_data)
                                {
                                    ?>
                                    <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                    <?php
                                }
                            } */
                            ?>
                        </select>
                    
                    </div>

                    
                        <div class="form-group">
                        <label>Geo L1</label>
                        <select class="selectpicker distributor_geo_level_2_data"  id="distributor_geo_level_2_data" name="geo_level_1_data" data-live-search="true">
                            
                        </select>
                    
                    </div>

                   
                       <div class="form-group">
                       <label>Distributor Name</label>
                       <select class="selectpicker" id="fo_distributor_data" name="distributor_data" data-live-search="true">

                       </select>
                   </div>
                   
               </div>
                
                
            </div>

                    <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>TO Date</label>
                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                        </div>
                        <div class="inl_button save_btn"><button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute</button></div>
                    </div>


            
            <?php } ?>
            
            
            
            <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>" /> 
            <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $login_customer_id; ?>" /> 
            <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $login_customer_countryid; ?>" /> 
            
            <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" /> 
            
            
            <!--<div class="col-md-8 col-md-offset-2 tp_form">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>From Date 1</label>
                                <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>TO Date</label>
                                <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2 save_btn">
                            <label>&nbsp;</label>
                            <button id="order_status" type="submit" class="btn btn-primary gren_btn" style="padding: 0 !important;">Execute</button>
                        </div>
                    </div>
                </div>-->

            
            

            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<?php } ?>
<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<?php
if (!$this->input->is_ajax_request()) { ?>
<div id="middle_container" class="order_status">

</div>
<div id="middle_container_product">

</div>
<div class="clearfix"></div>
<?php
}
?>
