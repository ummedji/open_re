<?php

$action_data = $this->uri->segment(2);

$user= $this->auth->user();
$login_customer_type = $user->role_id;

 $_POST['radio1'] =  (isset($_POST['radio1']) ? $_POST['radio1'] : '');
 
//echo "<pre>";print_r($_POST);

if(isset($table) && count($table)>0) {
    if($login_customer_type == 9 || $login_customer_type == 10){
        if($action_data == "po_acknowledgement"){

            $attributes = array('class' => '', 'id' => 'po_acknowledgement','name'=>'po_acknowledgement');
                echo form_open('',$attributes); 

        }
    }
    
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
                            <?php foreach($table['head'] as $hkey => $head) { if($head != ""){ ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="#">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php } } ?>
                        </tr>
                        </thead>
                        <?php if(isset($table['row']) && count($table['row']) ) {?>
                        <tbody class="tbl_body_row">
                        <?php foreach($table['row'] as $rkey => $rowary) {
                            ?>
                            <tr>
                                <?php
                                foreach($rowary as $rwkey => $row) {

                                    ?>
                                    <?php if($rwkey==0) {
                                        ?>
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="#" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }

                                    else if($rwkey==1 && $row != "") {
                                       
                                        ?>

                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>" class="numeric">
                                            
                                            <div class="confirm_data" prdid ="<?php echo $row;?>"><input id="confirm_ack_<?php echo $row;?>" type="checkbox" name="confirm_ack[]" value="" /><a href="javascript:void(0);">Confirm</a></div>
                                           
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
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>">
                                            <?php echo $row;?>
                                        </td>
                                    <?php
                                       } 
                                     }
                                     else{
                                         
                                       ?>  
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>">
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
                        <?php } ?>
                    </table>
                    <div class="clearfix"></div>
                </div>
                <?php 
                if($login_customer_type == 9 || $login_customer_type == 10){
                    if($action_data == "po_acknowledgement"){                   
                ?>
                <button type="submit" id="update_order_details" class="btn btn-primary">Save</button>
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
<!--    --><?php /*echo form_close(); */?>
