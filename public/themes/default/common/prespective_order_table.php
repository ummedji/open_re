<div class='report-box'>

    <div id='ajax_loader'>
    </div>
<?php
$action_data = $this->uri->segment(2);
if(isset($prespective_order_data) && count($prespective_order_data)>0 && $prespective_order_data !=false ) { ?>
        <?php if(isset($prespective_order_data['no_margin']) && !empty($prespective_order_data['no_margin']) )
        { ?>
                <div class="col-md-12">
            <?php
        }else{
        ?>
        <div class="col-md-12 ad_mr_top">
        <?php
    }?>

            <div class="row">
                <div class="zoom_space">
                    <ul>
                        <li><a href="#"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                        <li><a href="#" class="zoom_in_btn"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" class="show_tb_arrow" alt=""></a></li>
                        <li class="zoom_out_btn"><a href="#" ><img src="<?php echo Template::theme_url('images/zooming_icon_.png'); ?>" class="hide_tb_arrow_" alt=""></a></li>
                    </ul>
                </div>
                <div id="no-more-tables">
                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <?php foreach($prespective_order_data['head'] as $hkey => $head) {  ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="#">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <?php if(isset($prespective_order_data['row']) && count($prespective_order_data['row']) ) {?>
                        <tbody class="tbl_body_row">
                        <?php foreach($prespective_order_data['row'] as $rkey => $rowary) {
                            ?>
                            <tr>
                                <?php
                                foreach($rowary as $rwkey => $row) {

                                    ?>
                                    <?php if($rwkey==0   && ($action_data !="get_prespective_order_details")) {
                                        ?>
                                        <td data-title="<?php echo $prespective_order_data['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="#" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }
                                    else
                                    { ?>
                                        <td data-title="<?php echo $prespective_order_data['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td>
                                    <?php
                                    } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                            <?php if(isset($td) && isset($pagination)){ ?>
                                <tfoot>
                                <tr>
                                    <td colspan='<?php echo $td?>'>
                                        <?php
                                        if (isset($pagination)) {
                                            echo $pagination;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                </tfoot>
                            <?php } ?>
                        <?php } ?>
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <?php }
    else{
        ?>
        <h1 align="center" class="on_data">NO Data Available</h1>
        <?php
    }
    ?>
 </div>
    <script type="text/javascript">
        (function($){
            $(".zoom_in_btn").click(function(e){
                e.preventDefault();
                $(".zoom_out_btn").toggleClass("zoom_out_btn_show");
                $(".ad_mr_top").toggleClass("ad_mr_top_30");
                $(".top_form").hide();
                $(".zoom_in_btn").hide();
                $(".middle_form").hide();
            });
            $(".zoom_out_btn").click(function(j){
                j.preventDefault();
                $(".zoom_out_btn").removeClass("zoom_out_btn_show");
                $(".top_form").show();
                $(".zoom_in_btn").show();
                $(".middle_form").show();
                /*$(".zoom_out_btn").hide();*/
                $(".ad_mr_top").removeClass("ad_mr_top_30");
            });
        })(jQuery);
    </script>