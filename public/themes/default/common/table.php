<?php
$action_data = $this->uri->segment(2);

if(isset($table) && count($table)>0) { ?>
        <?php if(isset($table['no_margin']) && !empty($table['no_margin']) )
        { ?>
                <div class="col-md-12">
            <?php
        }else{
        ?>
        <div class="col-md-12" style="margin-top: 24px">
        <?php
    }?>

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
                            <?php foreach($table['head'] as $hkey => $head) { ?>
                                <th<?php if($hkey>2){?> class="numeric"<?php } ?>>
                                    <a href="#">
                                        <?php echo $head;?>
                                    </a>
                                    <span class="rts_bordet"></span>
                                </th>
                            <?php } ?>
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
                                    <?php if($rwkey==0   && ($action_data !="get_prespective_order_details")) {
                                        ?>
                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>">
                                            <div>
                                                <a href="#" attr-prdid="<?php echo $row;?>"><?php echo $row;?></a>
                                            </div>
                                        </td>
                                    <?php }

                                    //else if(($rwkey==1  && $action_data !="get_prespective_order_details")) {
                                    else if(($rwkey==1  && isset($table['action']) && !empty($table['action']))) {

                                       // if($action_data != 'credit_limit'){
                                        ?>

                                        <td data-title="<?php echo $table['head'][$rwkey]; ?>" class="numeric">
                                            <?php
                                            if(isset($table['eye']) && !empty($table['eye']))
                                            {
                                                ?>
                                                <div class="eye_i" prdid ="<?php echo $row;?>"><a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
                                                <?php
                                            }
                                           if($action_data !="get_prespective_order" ){
                                            ?>
                                            <div class="edit_i" prdid ="<?php echo $row;?>"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                            <div class="delete_i" prdid ="<?php echo $row;?>"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                           <?php } ?>
                                        </td>
                                    <?php } //}
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
<!--    --><?php /*echo form_close(); */?>
