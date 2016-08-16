<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Order Status</h5>
    <div class="back_details">

        <?php
       // $attributes = array('class' => '', 'id' => 'dialpad_social_info','name'=>'dialpad_social_info', 'autocomplete'=>'off');
       // echo form_open('cco/add_update_social_info',$attributes);
        ?>

        <div class="row">

            <div class="col-md-11" id="product_detail_data">


                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                    <div class="rotate_data">

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
            </div>
        </div>

        <div class="clearfix"></div>

        <div id="searched_data" style="overflow-y: scroll;max-height: 150px;">

            <div id="no-more-tables">
                <table class="col-md-12 table-bordered table-striped table-condensed cf">
                    <thead class="cf">

                        <tr>
                            <th>
                                Sr. NO.
                                <span class="rts_bordet"></span>
                            </th>
                            <th>
                                Order Date
                                <span class="rts_bordet"></span>
                            </th>
                            <th>
                                Order Tracking No.
                                <span class="rts_bordet"></span>
                            </th>
                            <th>
                                Retailers Name
                                <span class="rts_bordet"></span>
                            </th>
                            <th>
                                EDD
                                <span class="rts_bordet"></span>
                            </th>
                            <th>
                                Entered By
                                <span class="rts_bordet"></span>
                            </th>
                            <th>
                                Read (Y/N)
                                <span class="rts_bordet"></span>
                            </th>
                        </tr>

                    </thead>

                    <tbody class="tbl_body_row scroll_data">

                    <?php
                    if(!empty($default_order_data))
                    {
                        $i = 1;
                        foreach($default_order_data as $key => $order_data)
                        {
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $order_data['order_date']; ?></td>
                                <td><?php echo $order_data['order_tracking_no']; ?></td>
                                <td><?php echo $order_data['display_name']; ?></td>
                                <td><?php echo $order_data['estimated_delivery_date']; ?></td>
                                <td><?php echo $order_data['order_taken_name']; ?></td>
                                <?php
                                if($order_data['read_status'] == 0)
                                {
                                    $read_status = "Unread";
                                }
                                else
                                {
                                    $read_status = "Read";
                                }
                                ?>
                                <td><?php echo $read_status; ?></td>
                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    else
                    {
                    ?>
                        <tr>
                            <td colspan="8">No data found</td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="loading-info"><img src="ajax-loader.gif" /></div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">
    var track_page = 1; //track user scroll as page number, right now page number is 1
    var loading  = false; //prevents multiple loads

    load_contents(track_page); //initial content load

  /*  $("div#searched_data").on("scroll",function() { //detect page scroll
        alert("INN");
        if($("div#searched_data").scrollTop() + $("div#searched_data").height() >= $(document).height()) { //if user scrolled to bottom of the page
            track_page++; //page number increment
            load_contents(track_page); //load content
        }
    });

    */

    $('#searched_data').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            alert('end reached');
        }
    })

    //Ajax load function
    function load_contents(track_page){
        if(loading == false){
            loading = true;  //set loading flag on
            $('.loading-info').show(); //show loading animation


            $.ajax({
                type: 'POST',
                url: site_url + "cco/get_customer_order_status_data",
                data: {customerid: customer_id,page:track_page,scroll_status:"scrolled"},
                success: function (resp) {
                    loading = false;

                    if(data.trim().length == 0){
                        //notify user if nothing to load
                        $('.loading-info').html("No more records!");
                        return;
                    }

                    $('.loading-info').hide(); //hide loading animation once data is received
                    $(".scroll_data").append(resp); //append data into #results element
                }
            });

        }
    }
</script>

<script type="text/javascript">
/*
    $("input#search_product").on("keyup",function(){

        var search_data = $(this).val();
      //  if(search_data.length > 1)
      //  {
            var customer_id = $("input#customer_id").val();
            $.ajax({
                type: 'POST',
                url: site_url + "cco/get_product_detail_data",
                data: {searchdata: search_data,customerid : customer_id},
                success: function (resp) {
                    $("div#searched_data").html(resp);
                    //  get_geo_data(campagain_id,1,num_count);
                }
            });
       // }
      //  else
      //  {

      //  }

    });

    */

</script>