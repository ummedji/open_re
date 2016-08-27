<div class="actv-details-form">

    <h5 class="title" style="margin: 0px 0 20px 0;">Order Status</h5>
    <div class="back_details">

        <div class="row">

            <div class="col-md-11" id="product_detail_data">

                <?php
                $customer_id = (isset($customer_id) && !empty($customer_id))?$customer_id:"";
                ?>

                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                    <div class="rotate_data">
                        <?php
                        if ($this->input->is_ajax_request()) {

                        ?>
                        <div class="row">
                            <div class="col-md-12 cco-form-fl">
                                <div class="row tp_form">
                                    <div class="form-group">
                                        <div class="col-md-5 text-right-cco">
                                            <input type="text" class="form-control" name="search_by_otn" id="search_by_otn" placeholder="Search By Order No." value="" />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } ?>

            </div>
        </div>

        <div class="clearfix"></div>

        <div id="searched_data">
            <?php
            if ($this->input->is_ajax_request()) {
                echo theme_view('common/middle');
            }
            ?>
        </div>


        <?php
        if (isset($_POST["mode"]) && $_POST["mode"] == "list_data") {
            $attributes = array('class' => '', 'id' => 'dialpad_update_order_status', 'name' => 'dialpad_update_order_status', 'autocomplete' => 'off');
            echo form_open('', $attributes);

        }
        ?>

        <div id="detail_data">
            <div class="clearfix"></div>
            <div class="col-md-12 text-right">
                <div class="row save_btn">
                    <button style="display: none;" type="submit" class="btn btn-primary" id="update_order_data">Save</button>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST["mode"]) && $_POST["mode"] == "list_data")
        {
            echo form_close();
        }
        ?>
    </div>

    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">

    $("div#detail_data .rotate_data").remove();
    $("div#detail_data .title").remove();

    $("input#search_by_otn").on("keyup",function(){

        var search_data = $(this).val();

        var customer_id = $("input#customer_id").val();

        get_order_status_data(customer_id,search_data);

    });

</script>