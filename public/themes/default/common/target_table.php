<?php
$action_data = $this->uri->segment(2);

if(isset($target_data) && count($target_data)>0) { ?>
        
<table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf target_head_show_data">
           <tr> 


                <th>Sr. No. <span class="rts_bordet"></span></th>

                <th class="numeric">SKU Code <span class="rts_bordet"></span></th>
                <th class="numeric">SKU Name <span class="rts_bordet"></span></th>
               
                <?php if(isset($month_data) && !empty($month_data)){ ?>
                    <?php foreach ($month_data as $key => $value) { ?>
                        <th class="numeric"><?php echo date("Y-M",strtotime($value)); ?><span class="rts_bordet">(Kg/Ltr)</span></th>
                    <?php } ?>
                <?php } ?>
            

           </tr>
        </thead>
        <tbody id="target_data">
            <?php 
                $i = 1;
                
                foreach($target_data as $key=>$data){
                    $product_data = explode("-",$key);
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product_data[1]; ?></td>
                        <td><?php echo $product_data[2]; ?></td>
                       <?php foreach($data as $k=>$q_data){ ?>
                            <td><?php echo $q_data; ?></td>
                       <?php } ?>
                        
                        
                    </tr>
                 <?php   
                    $i++;
                }

            ?>
        </tbody>
    </table>


<?php }
    else{
        ?>
        <h1 align="center" class="on_data">NO Data Available</h1>
        <?php
    }
    ?>
<!--    --><?php /*echo form_close(); */?>
