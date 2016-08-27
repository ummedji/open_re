<?php
$smg2 = $this->uri->segment(2);
echo theme_view('header');
?>
    <?php if ($this->session->userdata('user_id') !='') {
    ?>
    <div id="wrapper">
        <?php
    if($smg2 != 'dialpad' && $smg2 != 'farmer_dialpad' && $smg2 != 'channel_partner_dialpad' && $smg2 != 'activity_dialpad' && $smg2 != 'employee_dialpad') {
        echo theme_view('_sitenav');
    }
        ?>
        <?php
        if($smg2 == 'dialpad' || $smg2 == 'farmer_dialpad' || $smg2 == 'channel_partner_dialpad' || $smg2 == 'activity_dialpad' || $smg2 == 'employee_dialpad') { ?>
        <div class="inner_contain inner_contain-dialpad">
        <?php } else{ ?>
            <div class="inner_contain">
        <?php } ?>
        <!--inner contain-->


            <?php
          //  if($this->uri->segment(1) != 'cco') {
    if($smg2 != 'dialpad' && $smg2 != 'farmer_dialpad' && $smg2 != 'channel_partner_dialpad' && $smg2 != 'activity_dialpad' && $smg2 != 'employee_dialpad') {
        echo theme_view('sidebar');
    }
          //  }
            ?>
            <div class="right_contain">
                <div class="inn_right_contain pr_right_contain">
                    <div id="main">
                            <?php  if($smg2 != 'dialpad' && $smg2 != 'farmer_dialpad' && $smg2 != 'channel_partner_dialpad' && $smg2 != 'activity_dialpad' && $smg2 != 'employee_dialpad') { ?>
                        <div class="col-md-12 full-height">
                            <?}else{  ?>
                            <div class="col-md-12 full-height dialpad-height">
                           <?php } ?>


                            <div class="row">
                                <?php
                                echo Template::message();
                                echo isset($content) ? $content : Template::content();
                                ?>
                            </div>
                        </div>
                        <?php
                            if($smg2 != 'dialpad' && $smg2 != 'farmer_dialpad' && $smg2 != 'channel_partner_dialpad' && $smg2 != 'activity_dialpad' && $smg2 != 'employee_dialpad') { ?>
                        <div class="col-md-12">
                            <div class="row">
                                <?php  echo theme_view('bottombar'); ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!--inner contain-->
        </div>
    </div>
    <?php
    }
else{

    echo Template::message();
    echo isset($content) ? $content : Template::content();
}
?>


    <?php
    echo theme_view('footer');
    ?>