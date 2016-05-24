<?php if ($this->session->userdata('user_id') !='') {
  //  testdata($current_user);
    ?>
<!--left sidebar-->
<div class="main_header">
    <div id="sidebar-wrapper" class="col-md-2 col-xs-2 col-md-2_2">
        <div id="sidebar">
            <div class="logo_space text-center">
                <a class="none_responsive" href="#"> <img src="<?php echo Template::theme_url('images/logo.png'); ?>" class="img-responsive" alt=""></a>
                <a class="responsive_logo" href="#"><img src="<?php echo Template::theme_url('images/logo_responsive.png'); ?>" class="img-responsive" alt=""></a>
            </div>

        </div>
    </div>
    <!--end left sidebar-->
    <!--right contain part-->
    <div id="main-wrapper" class="col-md-10 col-xs-10 col-md-10_10">
        <div class="col-md-12 header">
            <div class="row">
                <div class="top_setting">
                    <div class="slide_icon"><a href="#"><img src="<?php echo Template::theme_url('images/back_arrow.png'); ?>" alt=""></a></div>
                    <div class="right_nave">
                        <ul class="top_nv">
                            <li><a href="#"><img src="<?php echo Template::theme_url('images/download_i.svg'); ?>" class="hvr-push" alt=""></a></li>
                            <li><a href="#"><img src="<?php echo Template::theme_url('images/share_i.svg'); ?>" class="hvr-push" alt=""></a></li>
                            <li><a href="<?php echo site_url('logout'); ?>"><img src="<?php echo Template::theme_url('images/logout_i.svg'); ?>"class="hvr-push" alt=""></a></li>
                            <li class="nav_space"><a href="#"><img src="<?php echo Template::theme_url('images/nave_btn.svg'); ?>" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="user_deta text-right">
                    <div class="user_img"><img src="<?php echo Template::theme_url('images/user_img.png'); ?>" alt=""></div>
                    <div class="user_name">
                        <?php
                        echo $userDisplayName = isset($current_user->display_name) && !empty($current_user->display_name) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email);
                        ?>
                      </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>

                <div class="big_breadcrumb">
                    <div class="col-md-12">
                        <div class="nav-parent-div">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php if($current_user->role_id == 7){
                                    ?>
                                    <li role="presentation" class="active"><a href="<?php echo base_url('/ishop') ?>">PRIMARY SALES</a></li>
                                    <li role="presentation"><a href="<?php echo base_url('/ishop/primary_sales_view_details') ?>">PRIMARY SALES INVOICE</a></li>
                                    <li role="presentation"><a href="#">ORDER APPROVAL</a></li>
                                <?php
                                } ?>

                                <?php if($current_user->role_id == 9){
                                    ?>
                                    <li role="presentation" class="active"><a href="<?php echo base_url('/ishop/secondary_sales_details') ?>">SECONDARY SALES</a></li>
                                    <li role="presentation"><a href="<?php echo base_url('/ishop/secondary_sales_details_view') ?>">SECONDARY SALES INVOICE</a></li>
                                <?php
                                }
                                ?>
                                <li role="presentation"><a href="<?php echo base_url('/ishop/order_place') ?>">ORDER PLACE</a></li>

                                <?php if($current_user->role_id == 7) {
                                    ?>
                                    <li role="presentation"><a href="<?php echo base_url('/ishop/set_rol') ?>">ROL</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 7 || $current_user->role_id == 8 || $current_user->role_id == 9) {
                                    ?>
                                    <li role="presentation"><a href="#">TARGET</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 9 || $current_user->role_id == 10) {
                                    ?>
                                    <li role="presentation"><a href="<?php echo base_url('/ishop/physical_stock') ?>">PHYSICAL STOCK</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 7 ||  $current_user->role_id == 8 || $current_user->role_id == 10) {
                                    ?>
                                    <li role="presentation"><a href="#">SCHEMES</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 7 || $current_user->role_id == 9) {
                                    ?>
                                    <li role="presentation"><a href="#">E-INVOICE / E-STATEMENT</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 7) {
                                    ?>
                                    <li role="presentation"><a href="#">COMPANY CURRENT STOCK</a></li>
                                    <li role="presentation"><a href="#">CREDIT LIMIT</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 9 || $current_user->role_id == 10) {
                                    ?>
                                    <li role="presentation"><a href="#">PERSPECTIVE ORDER</a></li>
                                    <?php
                                }
                                ?>
                                <?php if($current_user->role_id == 9) {
                                    ?>
                                    <li role="presentation"><a href="<?php echo base_url('/ishop/invoice_received_confirmation') ?>">INVOICE RECEIVED CONFIRMATION</a></li>
                                    <?php
                                }
                                ?>

                                <?php if($current_user->role_id == 8) {
                                    ?>
                                    <li role="presentation"><a href="<?php echo base_url('/ishop/ishop_sales') ?>">SALES UPDATE</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--end right contain part-->
    <div class="clearfix"></div>
</div>
<?php }?>
