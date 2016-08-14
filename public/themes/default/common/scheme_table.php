<div class='report-box'>

    <div id='ajax_loader'>
    </div>
<?php

if(isset($scheme_table) && count($scheme_table)>0 && $scheme_table !=false) { ?>
    <div class="col-md-12 ad_mr_top">
        <div class="row">
            <div class="zoom_space">
                <ul>
                    <li><a href="javascript: void(0);"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                    <li><a href="javascript: void(0);" class="zoom_in_btn"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" class="show_tb_arrow" alt=""></a></li>
                    <li class="zoom_out_btn"><a href="javascript: void(0);" ><img src="<?php echo Template::theme_url('images/zooming_icon_.png'); ?>" class="hide_tb_arrow_" alt=""></a></li>
                </ul>
            </div>
            <div id="no-more-tables">
                <table class="col-md-12 table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                    <tr>
                        <th>Sr. No. <span class="rts_bordet"></span></th>
                        <th><input type="checkbox" name="" id="scheme_check" class="check_checked"/>Select All <span class="rts_bordet"></span></th>
                        <th>Action <span class="rts_bordet"></span></th>
                        <th>Region <span class="rts_bordet"></span></th>
                        <th>Territory Code <span class="rts_bordet"></span></th>
                        <th>Territory Name <span class="rts_bordet"></span></th>
                        <th>Retailer Code <span class="rts_bordet"></span></th>
                        <th>Retailer Name <span class="rts_bordet"></span></th>
                        <th>Scheme Code <span class="rts_bordet"></span></th>
                        <th>Scheme Name <span class="rts_bordet"></span></th>
                        <th>Product SKU Name <span class="rts_bordet"></span></th>
                        <th>Slab No. <span class="rts_bordet"></span></th>
                        <th>1 point:?kg/ltr <span class="rts_bordet"></span></th>
                        <th>Value Per Kg/Ltr </th>
                    </tr>
                    </thead>
                    <?php if(isset($scheme_table['row']) && count($scheme_table['row']) ) {?>
                        <tbody class="tbl_body_row">
                        <?php foreach($scheme_table['row'] as $rkey => $rowary) {
                            ?>
                            <tr>
                                <td data-title="Sr. No." class="numeric"><?php echo $rowary[0];?></td>
                                <td data-title="Select All " class="numeric"><input type="checkbox" attr-check="<?php echo $rowary[1];?>" name="del_scheme" id="scheme_check_id" class="check_checked"/></td>
                                <td data-title="Action" class="numeric">
                                    <div class="delete_i" prdid ="<?php echo $rowary[1];?>"><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                </td>
                                <td data-title="Region"><?php echo $rowary[2];?></td>
                                <td data-title="Territory Code"><?php echo $rowary[3];?></td>
                                <td data-title="Territory Name"><?php echo $rowary[4];?></td>
                                <td data-title="Retailer Code"><?php echo $rowary[5];?></td>
                                <td data-title="Retailer Name"><?php echo $rowary[6];?></td>
                                <td data-title="Scheme Code"><?php echo $rowary[7];?></td>
                                <td data-title="Scheme Name"><?php echo $rowary[8];?></td>
                                <td data-title="Product SKU Name"><?php echo $rowary[9];?></td>
                                <td data-title="Slab No."><?php echo $rowary[10];?></td>
                                <td data-title="1 point:?kg/ltr"><?php echo $rowary[11];?></td>
                                <td data-title="Value Per Kg/Ltr"><?php echo $rowary[12];?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <?php
                        if(isset($td) && isset($pagination)){ ?>
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
            <div class="col-md-4 col-sm-6 tp_form">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 save_btn">
                            <button id="delete_schemes" type="submit" style="background-color: red; display: none" class="btn btn-primary" >Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
    else{
        ?>
        <h1 align="center" class="on_data">No Data Available</h1>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
    /*(function($){
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
            /!*$(".zoom_out_btn").hide();*!/
            $(".ad_mr_top").removeClass("ad_mr_top_30");
        });
    })(jQuery);*/
</script>