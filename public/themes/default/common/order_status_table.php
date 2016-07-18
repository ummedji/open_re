<div class='report-box'>

    <div id='ajax_loader'>
    </div>
<?php
$action_data = $this->uri->segment(2);

$user= $this->auth->user();
$login_customer_type = $user->role_id;

 $_POST['radio1'] =  (isset($_POST['radio1']) ? $_POST['radio1'] : '');
 
//echo "<pre>";print_r($order_table);die;

if(isset($order_table) && count($order_table)>0 && $order_table != false) {
    if($login_customer_type != 9 && $login_customer_type != 10){
        if($action_data == "get_order_status_data_details"){

            $attributes = array('class' => '', 'id' => 'order_status_data_details','name'=>'order_status_data_details');
                echo form_open('',$attributes); 

        }
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
                            <?php foreach($order_table['head'] as $hkey => $head) { if($head != ""){ ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="javascript: void(0);">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php } } ?>
                        </tr>
                        </thead>
                        <?php if(isset($order_table['row']) && count($order_table['row']) ) {?>
                        <tbody class="tbl_body_row">
                        <?php foreach($order_table['row'] as $rkey => $rowary) {
                            ?>
                            <tr>
                                <?php
                                foreach($rowary as $rwkey => $row) {

                                    ?>
                                    <?php if($rwkey==0) {
                                        ?>
                                        <td data-title="<?php echo $order_table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="javascript: void(0);" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }

                                    else if($rwkey==1 && $row != "") {
                                       
                                        ?>

                                        <td data-title="<?php echo $order_table['head'][$rwkey]; ?>" class="numeric">
                                            <?php
                                            if(isset($order_table['eye']) && !empty($order_table['eye']))
                                            {
                                                ?>
                                                <div class="eye_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                                <?php
                                            }
                                           if($action_data !="get_order_status_data"){
                                            ?>
                                            <div class="edit_i" prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                           <?php } 
                                           
                                         
                                           if(isset($order_table['delete'][$rkey]) && !empty($order_table['delete'][$rkey]) ){
                                               $style = "style='pointer-events: none;opacity: 0.4;'";
                                               
                                           }
                                            else {  $style = "";}
                                           
                                           ?>
                                            
                                           <div class="delete_i" <?php echo $style; ?> prdid ="<?php echo $row;?>"><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                           
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
                                        <td data-title="<?php echo $order_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td>
                                    <?php
                                       } 
                                     }
                                     else{
                                         
                                       ?>  
                                        <td data-title="<?php echo $order_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td> 
                                    <?php     
                                     }
                                   }
                                    
                                    ?>
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
                <?php 
                if($login_customer_type != 9 && $login_customer_type != 10){
                    if($action_data == "get_order_status_data_details"){                   
                ?>
                <div class="col-md-12 save_btn save_btn_bottom">
                        <button type="submit" id="update_order_details" class="btn btn-primary">Save</button>
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