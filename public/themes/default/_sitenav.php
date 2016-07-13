<?php if ($this->session->userdata('user_id') !='') {
    $segment = $this->uri->segment(1);
    $segment2 = $this->uri->segment(2);
    $segment3 = $this->uri->segment(3);
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
                    <div class="slide_icon"><a href="#" title="Open Menu"><img src="<?php echo Template::theme_url('images/back_arrow.png'); ?>" alt=""></a></div>
                    <div class="right_nave">
                        <ul class="top_nv">
                            <li><a href="#" title="Download"><img src="<?php echo Template::theme_url('images/download_i.svg'); ?>" class="hvr-push" alt=""></a></li>
                            <li><a href="#" title="Share"><img src="<?php echo Template::theme_url('images/share_i.svg'); ?>" class="hvr-push" alt=""></a></li>
                            <li><a href="<?php echo site_url('logout'); ?>" title="Logout"><img src="<?php echo Template::theme_url('images/logout_i.svg'); ?>"class="hvr-push" alt=""></a></li>
                            <li class="nav_space"><a href="#" id="nav-expander" title="Nave"><img src="<?php echo Template::theme_url('images/nave_btn.svg'); ?>" alt=""></a></li>
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
                                <?php if($segment=='ishop'){
                                    ?>
                                    <?php if($current_user->role_id == 7){
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop') ?>">PRIMARY SALES</a></li>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='primary_sales_view_details') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/primary_sales_view_details') ?>">PRIMARY SALES INVOICE</a></li>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='order_approval' && $segment2=='order_approval') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_approval/all') ?>">ORDER APPROVAL</a></li>
                                        <?php
                                    } ?>

                                    <?php if($current_user->role_id == 9){
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='secondary_sales_details') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/secondary_sales_details') ?>">SECONDARY SALES</a></li>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='secondary_sales_details_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/secondary_sales_details_view') ?>">SECONDARY SALES INVOICE</a></li>
                                        <?php
                                    }
                                    ?>
                                    <li role="presentation" class="<?php echo ($segment=='ishop' && ($segment2=='order_place' || $segment2=='order_status' || $segment2=="po_acknowledgement")) ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_place') ?>">ORDER PLACE</a></li>

                                    <?php if($current_user->role_id == 7 || $current_user->role_id == 9 || $current_user->role_id == 10 ) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='set_rol') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/set_rol') ?>">ROL</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 7 || $current_user->role_id == 8) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && ($segment2=='target' || $segment2=='budget' )) ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/target') ?>">TARGET</a></li>
                                        <?php
                                    }
                                    if($current_user->role_id == 9)
                                    {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='target_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/target_view') ?>">TARGET</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 9 || $current_user->role_id == 10) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='physical_stock') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/physical_stock') ?>">PHYSICAL STOCK</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 7) {
                                        ?>
                                        <li role="presentation" class="<?php echo (($segment=='ishop' && $segment2=='set_schemes') || ($segment=='ishop' && $segment2=='schemes_view')) ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/set_schemes') ?>">SCHEMES</a></li>
                                        <?php
                                    }
                                    if($current_user->role_id == 8 || $current_user->role_id == 10)
                                    {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='schemes_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/schemes_view') ?>">SCHEMES</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 7 || $current_user->role_id == 9) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='' && $segment2=='') ? 'active' :'' ;?>"><a href="#">E-INVOICE / E-STATEMENT</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 7) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='company_current_stock') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/company_current_stock') ?>">COMPANY CURRENT STOCK</a></li>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='credit_limit') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/credit_limit') ?>">CREDIT LIMIT</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 9 || $current_user->role_id == 10) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='prespective_order') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/prespective_order') ?>">PERSPECTIVE ORDER</a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if($current_user->role_id == 9) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && $segment2=='invoice_received_confirmation') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/invoice_received_confirmation') ?>">INVOICE RECEIVED CONFIRMATION</a></li>
                                        <?php
                                    }
                                    ?>

                                    <?php if($current_user->role_id == 8) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ishop' && ($segment2=='ishop_sales' || $segment2=='physical_stock'  || $segment2=='sales_view')) ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/ishop_sales') ?>">SALES UPDATE</a></li>
                                        <?php
                                    }
                                }
                                elseif($segment=='esp'){
                                    ?>
                                    <li role="presentation" class=""><a href="<?php echo base_url('/esp'); ?>">Forecast</a></li>
                                    <li role="presentation" class=""><a href="<?php echo base_url('/esp/budget'); ?>">Budget</a></li>
                              <?php
                                }
                                elseif($segment=='ecp'){
                                    ?>
                                    <li role="presentation" class="">
                                        <a href="<?php echo base_url('ecp/activity_planning'); ?>">ACTIVITY</a>
                                    </li>
                                    <li role="presentation" class="<?php echo ($segment=='ecp' && ($segment2=='no_working' || $segment2=='set_leave')) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/no_working'); ?>">NO WORKING</a></li>

                                    <?php if($current_user->role_id == 7) {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ecp' && $segment2=='all_material_request') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ecp/all_material_request'); ?>">MATERIAL REQUEST</a></li>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <li role="presentation" class="<?php echo ($segment=='ecp' && $segment2=='material_request') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ecp/material_request'); ?>">MATERIAL REQUEST</a></li>
                                        <?php
                                    }?>


                                    <li role="presentation" class="<?php echo ($segment=='ecp' && ($segment2=='retailer_compititor_analysis'|| $segment2=='retailer_compititor_product' || $segment2=='retailer_compititor_view' || $segment2=='distributor_compititor_analysis' ||  $segment2=='distributor_compititor_product' || $segment2=='distributor_compititor_view' )) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_analysis'); ?>">COMPITITORS ANALYSIS</a></li>
                                    <?php
                                }
                                else{
                                    ?>
                                    <li role="presentation"></li>
                                <?
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
    <!--sidenave-->
    <nav>
        <ul class="list-unstyled main-menu">

            <!--Include your navigation here-->
            <li class="text-right"><a href="#" id="nav-close">X</a></li>

        </ul>
    </nav>
    <!--sidenave-->
<?php }?>
