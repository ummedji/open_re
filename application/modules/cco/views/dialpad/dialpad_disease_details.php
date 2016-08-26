<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Disease Details</h5>
    <div class="back_details">

        <?php
       // $attributes = array('class' => '', 'id' => 'dialpad_social_info','name'=>'dialpad_social_info', 'autocomplete'=>'off');
       // echo form_open('cco/add_update_social_info',$attributes);
        ?>

        <div class="row">

            <div class="col-md-11" id="disease_detail_data">
                <?php
                $customer_id = (isset($customer_id) && !empty($customer_id))? $customer_id : "";
                ?>

                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                    <div class="rotate_data">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 cco-form-fl">
                                <div class="row tp_form">
                                    <div class="form-group">
                                        <div class="col-md-6 text-right-cco">
                                            <input type="text" class="form-control" name="search_disease" id="search_disease" placeholder="Search Disease Name" value="" />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

            </div>

        </div>

        <div class="clearfix"></div>

        <div id="searched_data">

        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">

    $("input#search_disease").on("keyup",function(){

        var search_data = $(this).val();
       // if(search_data.length > 3)
      //  {

            var customer_id = $("input#customer_id").val();
            $.ajax({
                type: 'POST',
                url: site_url + "cco/get_diseases_detail_data",
                data: {searchdata: search_data,customerid : customer_id},
                success: function (resp) {
                    $("div#searched_data").html(resp);
                    //  get_geo_data(campagain_id,1,num_count);
                }
            });

      //  }

    });

</script>