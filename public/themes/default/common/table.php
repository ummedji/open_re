<div class='report-box'>
    <div id='ajax_loader'>

    </div>
    <?php

$action_data = $this->uri->segment(2);
if(isset($table) && count($table)>0 && $table != false) {
    ?>
        <?php if(isset($table['no_margin']) && !empty($table['no_margin']) )
        { ?>
                <div class="col-md-12 ad_mr_top">
            <?php
        }else{
        ?>
        <div class="col-md-12 ad_mr_top">
        <?php
    }?>
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
                            <?php foreach($table['head'] as $hkey => $head) { ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="javascript: void(0);">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <?php if(isset($table['row']) && count($table['row']) ) {

                            $radio_checked_value = "";
                            if(isset($table['radio_checked']) && !empty($table['radio_checked'])) {
                                foreach ($table['radio_checked'] as $k => $radio) {
                                    if($radio != ""){

                                        $radio_checked_value = $radio;
                                    }

                                }
                            }

                            ?>
                        <tbody class="tbl_body_row">
                        <?php foreach($table['row'] as $rkey => $rowary) {
                            ?>
                            <tr>
                                <?php
                                foreach($rowary as $rwkey => $row) {
                                    ?>
                                    <?php if($rwkey==0   && ($action_data !="get_prespective_order_details")) {
                                        ?>
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="javascript: void(0);" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }
                                    else if(($rwkey==1  && isset($table['action']) && !empty($table['action']))) {
                                        ?>
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>" class="numeric">
                                            <?php
                                            if(isset($table['radio']) && !empty($table['radio']))
                                            {
                                                if(isset($table['radio_checked']) && !empty($table['radio_checked'])){
                                                    if($radio_checked_value == $row){
                                                        $r_check = "checked";
                                                    }
                                                    else{
                                                        $r_check = "";
                                                    }
                                                    ?>
                                                    <input type="radio" <?php echo $r_check; ?> name="radio_scheme_slab" id="radio_scheme" value="<?php echo $row;?>">
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="radio" name="radio_scheme_slab" id="radio_scheme" value="<?php echo $row;?>">
                                                    <?php
                                                }

                                            }
                                            if(isset($table['eye']) && !empty($table['eye']))
                                            {
                                                ?>
                                                <div class="eye_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                                <?php
                                            }
                                            if(isset($table['edit_disabled']) && !empty($table['edit_disabled'])){

                                             //   echo "bbbb".$table['edit_disabled'][$rkey]."aaaa".$rkey;

                                                if($table['edit_disabled'][$rkey] == 1){
                                                    $style = "style='pointer-events: none;opacity: 0.4;'";
                                                }
                                                else{
                                                    $style = "";
                                                }
                                                ?>
                                                <div class="edit_i" prdid ="<?php echo $row;?>" <?php echo $style; ?>><a href="javascript: void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                                <?php

                                            }
                                           if(isset($table['edit']) && !empty($table['edit'])) {
                                               ?>
                                               <div class="edit_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                               <?php
                                           }
                                            if(isset($table['delete_dis']) && !empty($table['delete_dis'])){

                                               // echo "bbbb".$table['delete_disabled'][$rkey]."aaaa".$rkey;

                                                if($table['delete_disabled'][$rkey] == 1){
                                                    $style = "style='pointer-events: none;opacity: 0.4;'";
                                                }
                                                else{
                                                    $style = "";
                                                }
                                                ?>
                                                <div class="delete_i" prdid ="<?php echo $row;?>" <?php echo $style; ?>><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                            <?php

                                            }
                                            if(isset($table['delete']) && !empty($table['delete'])){

                                            ?>
                                               <div class="delete_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                           <?php } ?>
                                        </td>
                                    <?php }
                                    else
                                    { ?>
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td>
                                    <?php
                                    } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                            <?php if(isset($td) && isset($pagination)) { ?>
                            <tfoot>
                            <tr>
                                <td colspan='<?php echo $td; ?>'>
                                    <?php
                                    if (isset($pagination)) {
                                        echo $pagination;
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tfoot>
                        <?php  }
                        } ?>
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php
            if(isset($table["selected_status"])){
               if($table["selected_status"] == 0)
               {
                   ?>
                   <div class="check_save_btn" id="check_save_btn">
                       <div class="col-md-2 save_btn">
                           <label>&nbsp;</label>
                           <button type="submit" name="save" id="check_save" class="btn btn-primary gren_btn" style="margin-bottom: 50px">Save</button>
                       </div>
                   </div>
                <?php
               }
            }
            ?>
        </div>

    <?php
    }
    else
    {
        ?>
        <h1 align="center" class="on_data">No Data Available</h1>
        <?php
    }
    ?></div>
    </div>


<!--<script type="text/javascript">
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
</script>-->

