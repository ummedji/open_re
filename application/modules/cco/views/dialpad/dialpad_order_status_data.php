<div class="actv-details-form">

    <h5 class="title" style="margin: 0px 0 20px 0;">Order Status</h5>
    <div class="back_details">

        <?php
       // $attributes = array('class' => '', 'id' => 'dialpad_social_info','name'=>'dialpad_social_info', 'autocomplete'=>'off');
       // echo form_open('cco/add_update_social_info',$attributes);
        ?>



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
                            <div class="col-md-8 col-md-offset-2 cco-form-fl">
                                <div class="row tp_form">
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco">
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

    </div>
    <div class="clearfix"></div>

    <div id="detail_data">

    </div>

</div>
<div class="clearfix"></div>

<script type="text/javascript">

    $(document).on('click', 'div#searched_data .eye_i', function (e) {

        e.preventDefault();
        //alert("INNN");

        var customer_id = $("input#customer_id").val();
        var id = $(this).attr('prdid');

        $('div#searched_data').find('tr.bg_focus').removeClass();
        $(this).parents("tr").addClass("bg_focus");

        //var radio_checked = $('input[name=radio1]:checked').val();
       // var login_customer_type = $("input#login_customer_type" ).val();
        // currentpage = $("input.page_function" ).val();

        $.ajax({
            type: 'POST',
            url: site_url+'cco/get_order_data_details',
            data: {orderid: id},
            success: function(resp){
                $("div#detail_data").empty();
                $("#detail_data").html(resp);

                $("input#customer_id").val(customer_id);
            }
        });

        return false;
    });

    $("div#detail_data .rotate_data").remove();
    $("div#detail_data .title").remove();

    $("input#search_by_otn").on("keyup",function(){

        var search_data = $(this).val();

        var customer_id = $("input#customer_id").val();

        get_order_status_data(customer_id,search_data);

     /*   $.ajax({
            type: 'POST',
            url: site_url + "cco/get_product_detail_data",
            data: {searchdata: search_data,customerid : customer_id},
            success: function (resp) {
                $("div#searched_data").html(resp);
                //  get_geo_data(campagain_id,1,num_count);
            }
        });

        */
    });

    //get_order_status_data(customer_id)

</script>