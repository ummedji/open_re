<div class='report-box'>

    <div id='ajax_loader'>
    </div>
<?php
$action_data = $this->uri->segment(2);
if(isset($prespective_order_data) && count($prespective_order_data)>0) { ?>
        <?php if(isset($prespective_order_data['no_margin']) && !empty($prespective_order_data['no_margin']) )
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
                            <tr>
                                <td colspan='<?php echo $td?>'>
                                    <?php
                                    if (isset($pagination)) {
                                        echo $pagination;
                                    }
                                    ?>
                                </td>
                            </tr>
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