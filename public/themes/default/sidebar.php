<?php if ($this->session->userdata('user_id') !='') {
    $segment = $this->uri->segment(1);
    ?>

<div class="left_contain left_contain_big">
        <div class="side_menu_space pr_slide_menu">
            <ul class="sid_button">
                <li>
                    <span>
                        <a href="<?php echo base_url('/ecp') ?>" title="Activity Planner">
                            <span class="ecp_icon">
                            </span>
                            <div class="li_title pr_title">Activity Planner</div>
                        </a>
                    </span>
                    <div class="clearfix"></div>
                </li>
                <li class="<?php echo ($segment=='ishop') ? 'active' :'' ;?>" title="Channel Sales">
                    <span>
                        <a href="<?php echo base_url('/ishop') ?>">
                            <span class="i_shop_icon"></span>
                            <div class="li_title pr_title">Channel Sales</div>
                        </a></span>
                    <div class="clearfix"></div>
                </li>
                <li class="<?php echo ($segment=='esp') ? 'active' :'' ;?>" title="Sales Planner">
                    <span>
                        <a href="<?php echo base_url('/esp') ?>"><span class="esp_icon"></span><div class="li_title pr_title">Sales Planner</div></a>
                    </span>
                    <div class="clearfix"></div>
                </li>
                <li title="Reports">
                    <span>
                        <a href="#"><span class="reports_icon"></span><div class="li_title pr_title">Reports</div></a>
                    </span>
                    <div class="clearfix"></div>
                </li>
                <li title="E Assassments">
                    <span>
                        <a href="#"><span class="e_assassments_icon"></span><div class="li_title pr_title">E- Assessment</div></a>
                    </span>
                    <div class="clearfix"></div>
                </li>
                <li title="E Learnings">
                    <span>
                        <a href="#"><span class="e_learning_icon"></span><div class="li_title pr_title">E- Learnings</div></a>
                    </span>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>
    </div>
<?php }?>