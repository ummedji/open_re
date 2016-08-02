<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="active"><a href="#">Farmers</a></li>
                        <li class=""><a href="#">Channel Partners</a></li>
                        <li><a href="#">Activity</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Campaign Name<span style="color: red">*</span></label>

                        <div class="inln_fld">
                            <select class="selectpicker" id="prod_sku" name="prod_sku" data-live-search="true">
                                <option value="">Campaign Name</option>
                                <?php
                                if (isset($product_sku) && !empty($product_sku)) {
                                    foreach ($product_sku as $k => $prd_sku) {
                                        ?>
                                        <option value="<?php echo $prd_sku['product_sku_country_id']; ?>"
                                                attr-name="<?php echo $prd_sku['product_sku_name']; ?>"
                                                attr-code="<?php echo $prd_sku['product_sku_code']; ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
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
