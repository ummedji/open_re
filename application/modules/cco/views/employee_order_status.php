
<?php
if ($this->input->is_ajax_request() && isset($_POST["mode"]) && $_POST["mode"] != "list") {
    ?>
    <!--------------------------------------Filter1-------------------------------------------------->
<div class="actv-details-form">
    <h5 class="title" style="margin: 0px 0 20px 0;">Order Status</h5>
    <div class="col-md-12">
        <div class="top_form">
            <div class="row">
                <?php
                $attributes = array('class' => '', 'id' => 'emp_order_status', 'name' => 'emp_order_status', 'autocomplete' => 'off');
                echo form_open('', $attributes);

                //$local_date
                $f_date = date("Y-m-01");
                $from_date = date($local_date, strtotime($f_date));
                $t_date = date("Y-m-t", strtotime($f_date));
                // testdata($t_date);
                $to_date = date($local_date, strtotime($t_date));
                ?>
                <?php if ($login_customer_type == 8) { ?>
                    <div class="col-md-12 text-center radio_space">
                        <div class="radio">
                            <input class="select_customer_type" type="radio" name="radio1" id="farmer" value="farmer"
                                   checked="checked"/>
                            <label for="farmer">Farmer</label>
                        </div>
                        <div class="radio">
                            <input class="select_customer_type" type="radio" name="radio1" id="retailer"
                                   value="retailer"/>
                            <label for="retailer">Retailer</label>
                        </div>
                        <div class="radio">
                            <input class="select_customer_type" type="radio" name="radio1" id="distributor"
                                   value="distributor"/>
                            <label for="distributor">Distributor</label>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                   <div class="farmer_checked" id="farmer_checked">

                        <div class="col-md-12 text-center tp_form inline-parent">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Order Tracking No.</label>
                                    <input type="text" name="order_tracking_no" class="order_tracking_no form-control"
                                           id="order_tracking_no"/>
                                </div>
                            </div>
                            <div class="inl_button save_btn">
                                <button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute
                                </button>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        </br>
                        <div class="col-md-12 text-center tp_form inline-parent">
                            <div class="form-group">
                                <label>Geo L2<span style="color: red">*</span></label>
                                <select class=" geo_level_1_data" id="geo_level_1_data" name="geo_level_2_data"
                                        data-live-search="true" required>
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Geo L1<span style="color: red">*</span></label>
                                <select class=" geo_level_2_data" class="" id="geo_level_2_data" name="geo_level_1_data" data-live-search="true" required>
                                    <option value="">Select Geo L1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Farmer Name<span style="color: red">*</span></label>
                                <select class="" id="farmer_data" name="farmer_data" data-live-search="true" required>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="retailer_checked" id="retailer_checked" style="display:none;">

                        <div class="col-md-12 text-center tp_form inline-parent">
                            <div class="form-group">
                                <label>Geo L3<span style="color: red">*</span></label>
                                <select class=" retailer_geo_level_1_data" id="retailer_geo_level_1_data"
                                        name="geo_level_3_data" data-live-search="true" required>

                                </select>

                            </div>
                            <div class="form-group">
                                <label>Geo L2<span style="color: red">*</span></label>
                                <select class=" retailer_geo_level_2_data" id="retailer_geo_level_2_data"
                                        name="geo_level_2_data" data-live-search="true" required>

                                </select>

                            </div>

                            <div class="form-group">
                                <label>Retailer Name<span style="color: red">*</span></label>
                                <select class='' id="retailer_data" name="retailer_data" data-live-search="true"
                                        required>
                                    <option value="">Select Retailers</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="distributor_checked" id="distributor_checked" style="display:none;">


                        <div class="col-md-12 text-center tp_form inline-parent">

                            <div class="form-group">
                                <label>Geo L2<span style="color: red">*</span></label>
                                <select class=" distributor_geo_level_1_data" id="distributor_geo_level_1_data"
                                        name="geo_level_2_data" data-live-search="true" required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Geo L1<span style="color: red">*</span></label>
                                <select class=" distributor_geo_level_2_data" id="distributor_geo_level_2_data"
                                        name="geo_level_1_data" data-live-search="true" required>
                                    <option value="">Select Geo L1</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Distributor Name<span style="color: red">*</span></label>
                                <select class="" id="fo_distributor_data" name="distributor_data"
                                        data-live-search="true" required>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
                        <div class="form-group">
                            <label>From Date<span style="color: red">*</span></label>

                            <div class="inln_fld_top text-left">
                                <input type="text" class="form-control" name="form_date" id="form_date" placeholder=""
                                       autocomplete="off" required>

                                <div class="clearfix"></div>
                                <label id="form_date-error" class="error" for="form_date"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>To Date<span style="color: red">*</span></label>

                            <div class="inln_fld_top text-left">
                                <input type="text" class="form-control" name="to_date" id="to_date" placeholder=""
                                       autocomplete="off" required>

                                <div class="clearfix"></div>
                                <label id="to_date-error" class="error" for="to_date"></label>
                            </div>
                        </div>
                        <div class="inl_button save_btn">
                            <button id="order_status" type="submit" class="btn btn-primary gren_btn">Execute</button>
                        </div>
                    </div>

                <?php } ?>

                <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>"/>
                <input class="mode" type="hidden" name="mode" id="mode" value="list"/>
                <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id"
                       value="<?php echo $login_customer_id; ?>"/>
                <input class="login_customer_countryid" type="hidden" name="login_customer_countryid"
                       id="login_customer_countryid" value="<?php echo $login_customer_countryid; ?>"/>

                <input class="page_function" type="hidden" name="page_function" id=""
                       value="order_status"/>

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


if ($this->input->is_ajax_request()) { ?>

    <div id="middle_container" class="order_status order_status-none-zoom">

    </div>

    <div id="middle_container_product" class="order_status">

    </div>

    <div class="clearfix"></div>
    <?php
}  ?>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<?php
if ($this->input->is_ajax_request() && isset($_POST["mode"])  && $_POST["mode"] == "list_data") {
?>
<script type="application/javascript">

    var order_status = $("#emp_order_status");
    order_status.validate();

    $(document).on("submit","#emp_order_status",function(e){
        alert('in');
        e.preventDefault();
        var param = $("form#emp_order_status").serializeArray();

       /* console.log(param);
        return false;*/
        var form_order_status = false;

        form_order_status = order_status.valid();

        if(form_order_status == false){
            return false;
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: site_url+"cco/get_employee_all_order_data",
                data: param,
                dataType : 'html',
                success: function(resp){
                    console.log(resp);
                    $("div#middle_container").html(resp);
                    $("#middle_container_product").empty();

                }
            });
            return false;
        }

    });

    $(document).on('click', 'div.order_status .eye_i', function (e) {

        e.preventDefault();
        //alert("INNN");

        var id = $(this).attr('prdid');

        $('div.order_status').find('tr.bg_focus').removeClass();
        $(this).parents("tr").addClass("bg_focus");

        var radio_checked = $('input[name=radio1]:checked').val();
        var login_customer_type = $("input#login_customer_type" ).val();
        var login_customer_id = $("input#login_customer_id" ).val();
        var currentpage = 'order_status';

        $.ajax({
            type: 'POST',
            url: site_url+'cco/get_order_status_data_details',
            data: {id: id,radiochecked:radio_checked,logincustomertype:login_customer_type,segment_data:currentpage,login_customer_id:login_customer_id},
            success: function(resp){
                $("div#middle_container_product").empty();
                $("#middle_container_product").html(resp);

            }
        });


        $('#main').animate({
            scrollTop: $(document).height()
        }, 1000);
        /*
         $("body, html").animate({
         scrollTop: $( $(this).attr('href') ).offset().top
         }, "slow");

         */

        $(window).scrollTop($("div#middle_container_product").offset().top);


        return false;
    });

</script>
<?php } ?>
