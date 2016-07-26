<div class='report-box'>

    <div id='ajax_loader'>
    </div>
<?php
$action_data = $this->uri->segment(2);

$user= $this->auth->user();
$login_customer_type = $user->role_id;

 $_POST['radio1'] =  (isset($_POST['radio1']) ? $_POST['radio1'] : '');

//echo $action_data;

if(isset($po_ack_table) && count($po_ack_table)>0 && $po_ack_table != false) {
    if($login_customer_type == 9 || $login_customer_type == 10){
            if($action_data == "po_acknowledgement"){
                $formname = "po_acknowledgement";
                $url = "ishop/po_acknowledgement";
            }
            else{
                $formname = "update_order_status_detail_data";
                $url = 'ishop/update_po_acknowledgement_data';
            }

            $attributes = array('class' => '', 'id' => $formname,'name'=>$formname);
            echo form_open($url,$attributes);
    }
    ?>
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
                            <?php foreach($po_ack_table['head'] as $hkey => $head) { if($head != ""){ ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="javascript: void(0);">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php } } ?>
                        </tr>
                        </thead>
                        <?php if(isset($po_ack_table['row']) && count($po_ack_table['row']) ) {?>
                        <tbody class="tbl_body_row">
                        <?php
                        $j = 0;
                        foreach($po_ack_table['row'] as $rkey => $rowary) {
                            ?>
                            <tr class="row_<?php echo $j; ?>">
                                <?php
                                foreach($rowary as $rwkey => $row) {

                                    ?>
                                    <?php if($rwkey==0) {
                                        ?>
                                        <td data-title="<?php echo $po_ack_table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="javascript: void(0);" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }

                                    else if($rwkey==1 && $row != "") {
                                       
                                        ?>

                                        <td data-title="<?php echo $po_ack_table['head'][$rwkey]; ?>" class="numeric">
                                           <?php 
                                            if($action_data =="get_order_status_data_details"){
                                            ?>
                                            <div class="edit_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                            <div class="delete_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                           <?php }else{
                                           
                                           ?>
                                            
                                            
                                            <div class="confirm_data" prdid ="<?php echo $row;?>"><input type="hidden" id="confirm_data_<?php echo $row;?>" name="confirm_ack[]" value="0" /><input class="confirm_data"  type="checkbox" name="" value="<?php echo $row;?>" />Confirm</div>
                                           <?php } ?>
                                        </td>
                                    <?php 
                                       
                                          
                                    }
                                    elseif($rwkey==1 && $row == ""){
                                    ?>    
                                        
                                   <?php     
                                    }
                                    else
                                    {
                                      if($_POST["radio1"] == "farmer"){
                                        if($row != ""){ ?>
                                        <td data-title="<?php echo $po_ack_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td>
                                    <?php
                                       } 
                                     }
                                     else{
                                         
                                       ?>  
                                        <td data-title="<?php echo $po_ack_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td> 
                                    <?php     
                                     }
                                   }
                                    
                                    ?>
                                <?php } ?>
                            </tr>
                        <?php
                            $j++;
                        } ?>
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
                <?php 
                if($login_customer_type == 9 || $login_customer_type == 10){
                    if($action_data == "po_acknowledgement" || $action_data == "get_order_status_data_details"){                   
                ?>
                        <div class="col-md-12 table_bottom">
                            <div class="row">
                                <div class="col-md-3 save_btn">
                                    <button type="submit" id="update_po_order_details" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                    <?php
                    
                        echo form_close();
                    
                } 
                
             }?>
            </div>
        </div>
        <div class="clearfix"></div>
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