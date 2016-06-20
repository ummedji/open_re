<div class='report-box'>

    <div id='ajax_loader'>
    </div>
<?php
$action_data = $this->uri->segment(2);
$action_data1 = $this->uri->segment(3);

$user= $this->auth->user();
$login_customer_type = $user->role_id;

 $_POST['radio1'] =  (isset($_POST['radio1']) ? $_POST['radio1'] : '');
 
 //echo "<pre>";print_r($order_approval_table);die;

if(isset($order_approval_table) && count($order_approval_table)>0) {
    
        if($action_data == "order_approval"){
            $formname = "update_order_approval_data";
            $url = "ishop/update_order_approval_data";
        }
        else{
             $formname = "update_order_status_detail_data";
             $url = 'ishop/update_order_approval_detail_data';
        }
        
        $attributes = array('class' => '', 'id' => $formname,'name'=>$formname);
        echo form_open($url,$attributes); 
                
    ?>
        <div class="col-md-12" style="margin-top: 25px;">
            <div class="row">
                <div class="zoom_space">
                    <ul>
                        <li><a href="#"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                        <li><a href="#"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" alt=""></a></li>
                    </ul>
                </div>
                <div id="no-more-tables">
                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <?php foreach($order_approval_table['head'] as $hkey => $head) {
                                
                                if($action_data != "order_approval"){
                                    
                                    if($head != ""){
                                      ?>
                                         <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="#">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                               <?php         
                                    }
                                }
                                else{
                             //if($head != ""){ ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="#">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php 
                             
                                } 
                                
                            } ?>
                        </tr>
                        </thead>
                        <?php if(isset($order_approval_table['row']) && count($order_approval_table['row']) ) {?>
                        <tbody class="tbl_body_row">
                        <?php foreach($order_approval_table['row'] as $rkey => $rowary) {
                            ?>
                            <tr>
                                <?php
                                
                               
                                
                                foreach($rowary as $rwkey => $row) {
                                         if($action_data == "order_approval"){
                                    ?>
                                    <?php if($rwkey==0) {
                                        ?>
                                        <td data-title="<?php echo $order_approval_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                            
                                        </td>
                                    <?php }
                                    elseif($rwkey==1)
                                    {
                                    ?>    
                                         <td data-title="<?php echo $order_approval_table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="#" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                           
                                        </td>
                                   <?php     
                                    }
                                    else
                                    {
                                     ?>
                                        <td data-title="<?php echo $order_approval_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td> 
                                    <?php     
                                     
                                   }
                                    
                                    ?>
                                <?php }else{
                                    
                                    
                                      if($rwkey==0) {
                                        ?>
                                        <td data-title="<?php echo $order_approval_table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="#" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }
                                    else
                                    {
                                       if($rwkey!=1) {
                                     ?>
                                        <td data-title="<?php echo $order_approval_table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td> 
                                    <?php  
                                       }
                                     
                                    }
                                    
                                  }
                                
                                }
                                ?>
                            </tr>
                        <?php } ?>
                        </tbody>
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
                    </table>
                    <div class="clearfix"></div>
                </div>
                <?php 
                
                    if($action_data == "get_order_status_data_details"){        
                        
                ?>
                        <div class="col-md-2 save_btn">
                            <button type="submit"  id="update_order_details"  class="btn btn-primary gren_btn" style="margin-top: 3px; margin-bottom: 20px; ">Save</button>
                            <br/>
                        </div>
                    <?php
                    }
                echo form_close();
                    
                
                
             ?>
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
<!--    --><?php /*echo form_close(); */?>
