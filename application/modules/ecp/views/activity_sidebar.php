<!--<div>-->
    <div class="top_form planning_parent" style="padding: 10px 5px 10px 5px;">
        <div class="panel act_panel with-nav-tabs panel-default">
            <?php /*if($action =='activity_execution') { */?><!--
            <label>Missed Activity</label>
                <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true">
                    <?php /* if (is_array($missed_activity) && count($missed_activity) > 0) {
                        $j = 0;
                        foreach ($missed_activity as $k => $activity_val) { */?>
                            <div class="panel panel-default" id="data_<?php /*echo date("j", strtotime($k)); */?>">
                                <?php /*foreach ($activity_val as $key => $val) { */?>
                                    <?php /*if ($key == 0) { */?>
                                        <div class="panel-heading" role="tab">
                                            <ul class="acc_list">
                                                <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php /*echo $j; */?>" aria-expanded="true" aria-controls="collapse<?php /*echo $j; */?>"><?php /*echo date('d', strtotime($val['activity_planning_date'])) */?>
                                                        <img src="<?php /*echo Template::theme_url('images/list_arrow.png') */?>"
                                                            alt="" style="vertical-align: middle;"></a></li>
                                                <li><a href="javascript: void(0);" onclick="getActivityById(<?php /*echo $val['activity_planning_id']; */?>);"><?php /*echo $val['activity_type_country_name'] */?></a>
                                                </li>
                                                <li><a href="javascript: void(0);" onclick="getActivityById(<?php /*echo $val['activity_planning_id']; */?>);">Execute</li>
                                                <li> <a href="#" id="activity_cancel"  data-toggle="modal" data-target="#ActivityCancelModal" onclick="getActivityPlanningId(<?php /*echo $val['activity_planning_id']; */?>);">Cancel</a></li>
                                                <li><a href="#" id="activity_re"  data-toggle="modal" data-target="#ActivityReModal" onclick="getActivityPlanningsId(<?php /*echo $val['activity_planning_id']; */?>);">Rescheduling</a></li>
                                            </ul>
                                        </div>
                                    <?php /*} else { */?>
                                        <?php /*if ($key == 1) { */?><div id="collapse<?php /*echo $j; */?>" class="panel-collapse collapse" role="tabpanel"><?php /*} */?>
                                        <ul class="acc_list">
                                            <li>&nbsp;</li>
                                            <li><a  href="javascript: void(0);" onclick="getActivityById(<?php /*echo $val['activity_planning_id']; */?>);"><?php /*echo $val['activity_type_country_name']; */?></a>
                                            </li>
                                            <li><a href="javascript: void(0);" onclick="getActivityById(<?php /*echo $val['activity_planning_id']; */?>);">Execute</li>
                                            <li><a href="javascript: void(0);" onclick="getActivityCancelById(<?php /*echo $val['activity_planning_id']; */?>);">Cancel</li>
                                            <li><a href="javascript: void(0);" onclick="">Rescheduling</li>
                                        </ul>
                                        <?php /*if ($key == count($activity_val)) { */?></div><?php /*} */?>
                                    <?php /*} */?>
                                <?php /*} */?>
                            </div>
                            <?php /*$j++;
                        }
                    }
                    else{ */?>
                        <div class="panel panel-default" id="data">
                            <div class="panel-heading" role="tab">
                                <ul class="acc_list">
                                    No Missed Activity
                                </ul>
                            </div>
                        </div>
                    <?php /*}  */?>
                </div>
                <br>
                <br>
                <label>Planned Activity</label>
                <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true">
                    <?php
/*                    if (is_array($current_activity) && count($current_activity) > 0) {
                        $j = 0;
                        foreach ($current_activity as $k => $activity_val) { */?>
                            <div class="panel panel-default" id="data_<?php /*echo date("j", strtotime($k)); */?>">
                                <?php /*foreach ($activity_val as $key => $val) {
                                     if ($key == 0) { */?>
                                        <div class="panel-heading" role="tab">
                                            <ul class="acc_list">
                                                <li><a data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapse<?php /*echo $j; */?>" aria-expanded="true"
                                                       aria-controls="collapse<?php /*echo $j; */?>"><?php /*echo date('d', strtotime($val['activity_planning_date'])) */?>
                                                        <img
                                                            src="<?php /*echo Template::theme_url('images/list_arrow.png') */?>"
                                                            alt="" style="vertical-align: middle;"></a></li>
                                                <li><a href="javascript: void(0);"
                                                                                      onclick="getActivityById(<?php /*echo $val['activity_planning_id']; */?>);"><?php /*echo $val['activity_type_country_name'] */?></a>
                                                </li>
                                                <li><?php /*echo date('h:i A', strtotime($val['activity_planning_time'])) */?></li>
                                                <li><?php /*echo $val['political_geography_name'] */?></li>
                                            </ul>
                                        </div>
                                    <?php /*} else { */?>
                                        <?php /*if ($key == 1) { */?>
                                             <div id="collapse<?php /*echo $j; */?>" class="panel-collapse collapse" role="tabpanel"><?php /*} */?>
                                        <ul class="acc_list">
                                            <li>&nbsp;</li>
                                            <li>
                                                <a  href="javascript: void(0);" onclick="getActivityById(<?php /*echo $val['activity_planning_id']; */?>);"><?php /*echo $val['activity_type_country_name']; */?></a>
                                            </li>
                                            <li><?php /*echo date('h:i A', strtotime($val['activity_planning_time'])); */?></li>
                                            <li><?php /*echo $val['political_geography_name']; */?></li>
                                        </ul>
                                        <?php /*if ($key == count($activity_val)) { */?>
                                             </div>
                                         <?php /*} */?>
                                    <?php /*} */?>
                                <?php /*} */?>
                            </div>
                            <?php /*$j++;
                        }
                    }
                    else{
                        */?>
                            <div class="panel panel-default" id="data">
                                <div class="panel-heading" role="tab">
                                    <ul class="acc_list">
                                        No Planned Activity
                                    </ul>
                                </div>
                            </div>
                        <?php
/*                    }
                    */?>
                </div>
                <div class="clearfix"></div>
            <?php /*} elseif($action =='activity_view') { */?>

            --><?php /*} elseif($action =='activity_planning') { */?>
                <div class="panel-heading" style="border: none;">
                    <ul class="activity_list">
                        <li class="active"><a href="#tab0default" data-toggle="tab" data-attr="all">All</a></li>
                        <li><a href="#tab1default" data-toggle="tab" data-attr="i">Incomplete Entry</a></li>
                        <li><a href="#tab2default" data-toggle="tab" data-attr="a">Approved</a></li>
                        <li><a href="#tab3default" data-toggle="tab" data-attr="r">Rejected</a></li>
                        <li><a href="#tab4default" data-toggle="tab" data-attr="p">Pending</a>
                        </li>
                    </ul>
                </div>
            <?php /*} */?>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                        <div class="calendar_space">
                            <div id="calendar">
                                <?php echo $cal_data; ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php if($action =='activity_planning') { ?>
                        <div class="add_new_space text-right save_btn">
                            <button type="button" id="add_new" class="btn btn-primary">Add New</button>
                        </div>
                        <?php }

                        if($action =='activity_view') {
                            //testdata($activity_data);
                            ?>
                            <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                if (is_array($activity_data) && count($activity_data) > 0) {
                                    $j = 0;
                                    foreach ($activity_data as $k => $activity_val) { ?>
                                        <div class="panel panel-default" id="data_<?php echo date("j", strtotime($k)); ?>">

                                            <?php foreach ($activity_val as $key => $val) {
                                                if($val['status'] == '0') {
                                                   $status = 'Incomplete';
                                                } elseif($val['status'] == '1') {
                                                    $status = 'Pending';
                                                } elseif($val['status'] == '2') {
                                                    $status = 'Planned';
                                                } elseif($val['status'] == '3') {
                                                    $status = 'Rejected';
                                                } elseif($val['status'] == '4') {
                                                    $status = 'Executed';
                                                } elseif($val['status'] == '5') {
                                                    $status = 'Canceled';
                                                }

                                                if((!empty($val['execution_date']) ? strtotime($val['execution_date']) : strtotime($val['activity_planning_date'])) < strtotime(date('Y-m-d')))
                                                {
                                                    $style = "pointer-events: none;";
                                                    //$style = "pointer-events: none;opacity: 0.7;";
                                                }
                                                else
                                                {
                                                    $style = "";
                                                }
                                                ?>
                                                <?php if ($key == 0) { ?>
                                                    <div class="panel-heading" role="tab">
                                                        <ul class="acc_list">
                                                            <li><a data-toggle="collapse" data-parent="#accordion"
                                                                   href="#collapse<?php echo $j; ?>" aria-expanded="true"
                                                                   aria-controls="collapse<?php echo $j; ?>"><?php echo date('d', (!empty($val['execution_date']) ? strtotime($val['execution_date']) : strtotime($val['activity_planning_date']))) ?><img src="<?php echo Template::theme_url('images/list_arrow.png') ?>" alt="" style="vertical-align: middle;"></a>
                                                            </li>
                                                            <li style="<?php echo $style; ?>" ><a href="javascript: void(0);" onclick="getActivityById(<?php echo $val['activity_planning_id']; ?>);"><?php echo $val['activity_type_country_name'] ?></a>
                                                            </li>
                                                            <li><?php echo date('h:i A', (!empty($val['execution_time']) ? strtotime($val['execution_time']) : strtotime($val['activity_planning_time']))) ?></li>
                                                            <li><?php echo $val['political_geography_name'] ?></li>
                                                            <li><?php echo $status; ?></li>
                                                        </ul>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php if ($key == 1) { ?><div id="collapse<?php echo $j; ?>" class="panel-collapse collapse" role="tabpanel"><?php } ?>
                                                    <ul class="acc_list">
                                                        <li>&nbsp;</li>
                                                        <li style="<?php echo $style; ?>">
                                                            <a  href="javascript: void(0);"
                                                                onclick="getActivityById(<?php echo $val['activity_planning_id']; ?>);"><?php echo $val['activity_type_country_name']; ?></a>
                                                        </li>
                                                        <li><?php echo date('h:i A',  (!empty($val['execution_time']) ? strtotime($val['execution_time']) : strtotime($val['activity_planning_time']))); ?></li>
                                                        <li><?php echo $val['political_geography_name']; ?></li>
                                                        <li><?php echo $status ?></li>
                                                    </ul>
                                                    <?php if ($key == count($activity_val)) { ?></div><?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <?php $j++;
                                    }
                                } ?>
                            </div>
                            <div class="clearfix"></div>
                            <?php  }
                        elseif($action =='activity_execution'){  ?>
                        <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                if (is_array($activity_data) && count($activity_data) > 0) {
                                    $j = 0;
                                    foreach ($activity_data as $k => $activity_val) { ?>
                                        <div class="panel panel-default" id="data_<?php echo date("j", strtotime($k)); ?>">
                                            <?php foreach ($activity_val as $key => $val) {
                                                if(strtotime($val['execution_date']) < strtotime(date('Y-m-d')))
                                                {
                                                    $style = "pointer-events: none;";
                                                    //$style = "pointer-events: none;opacity: 0.7;";
                                                }
                                                else
                                                {
                                                    $style = "";
                                                }
                                                ?>
                                                <?php if ($key == 0) { ?>
                                                    <div class="panel-heading" role="tab">
                                                        <ul class="acc_list">
                                                            <li><a data-toggle="collapse" data-parent="#accordion"
                                                                   href="#collapse<?php echo $j; ?>" aria-expanded="true"
                                                                   aria-controls="collapse<?php echo $j; ?>"><?php echo date('d', strtotime($val['execution_date'])) ?>
                                                                    <img
                                                                        src="<?php echo Template::theme_url('images/list_arrow.png') ?>"
                                                                        alt="" style="vertical-align: middle;"></a></li>
                                                            <li style="<?php echo $style; ?>" ><a href="javascript: void(0);"
                                                                                                  onclick="getActivityById(<?php echo $val['activity_planning_id']; ?>);"><?php echo $val['activity_type_country_name'] ?></a>
                                                            </li>
                                                            <li><?php echo date('h:i A', strtotime($val['execution_time'])) ?></li>
                                                            <li><?php echo $val['political_geography_name'] ?></li>
                                                        </ul>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php if ($key == 1) { ?><div id="collapse<?php echo $j; ?>" class="panel-collapse collapse" role="tabpanel"><?php } ?>
                                                    <ul class="acc_list">
                                                        <li>&nbsp;</li>
                                                        <li style="<?php echo $style; ?>">
                                                            <a  href="javascript: void(0);"
                                                                onclick="getActivityById(<?php echo $val['activity_planning_id']; ?>);"><?php echo $val['activity_type_country_name']; ?></a>
                                                        </li>
                                                        <li><?php echo date('h:i A', strtotime($val['execution_time'])); ?></li>
                                                        <li><?php echo $val['political_geography_name']; ?></li>
                                                    </ul>
                                                    <?php if ($key == count($activity_val)) { ?></div><?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <?php $j++;
                                    }
                                } ?>
                    </div>
                            <?php }
                        else{ ?>
                            <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                if (is_array($activity_data) && count($activity_data) > 0) {
                                    $j = 0;
                                    foreach ($activity_data as $k => $activity_val) { ?>
                                        <div class="panel panel-default" id="data_<?php echo date("j", strtotime($k)); ?>">
                                            <?php foreach ($activity_val as $key => $val) {
                                                if(strtotime($val['activity_planning_date']) < strtotime(date('Y-m-d')))
                                                {
                                                    $style = "pointer-events: none;";
                                                    //$style = "pointer-events: none;opacity: 0.7;";
                                                }
                                                else
                                                {
                                                    $style = "";
                                                }
                                                ?>
                                                <?php if ($key == 0) { ?>
                                                    <div class="panel-heading" role="tab">
                                                        <ul class="acc_list">
                                                            <li><a data-toggle="collapse" data-parent="#accordion"
                                                                   href="#collapse<?php echo $j; ?>" aria-expanded="true"
                                                                   aria-controls="collapse<?php echo $j; ?>"><?php echo date('d', strtotime($val['activity_planning_date'])) ?>
                                                                    <img
                                                                        src="<?php echo Template::theme_url('images/list_arrow.png') ?>"
                                                                        alt="" style="vertical-align: middle;"></a></li>
                                                            <li style="<?php echo $style; ?>" ><a href="javascript: void(0);"
                                                                                                  onclick="getActivityById(<?php echo $val['activity_planning_id']; ?>);"><?php echo $val['activity_type_country_name'] ?></a>
                                                            </li>
                                                            <li><?php echo date('h:i A', strtotime($val['activity_planning_time'])) ?></li>
                                                            <li><?php echo $val['political_geography_name'] ?></li>
                                                        </ul>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php if ($key == 1) { ?><div id="collapse<?php echo $j; ?>" class="panel-collapse collapse" role="tabpanel"><?php } ?>
                                                    <ul class="acc_list">
                                                        <li>&nbsp;</li>
                                                        <li style="<?php echo $style; ?>">
                                                            <a  href="javascript: void(0);"
                                                                onclick="getActivityById(<?php echo $val['activity_planning_id']; ?>);"><?php echo $val['activity_type_country_name']; ?></a>
                                                        </li>
                                                        <li><?php echo date('h:i A', strtotime($val['activity_planning_time'])); ?></li>
                                                        <li><?php echo $val['political_geography_name']; ?></li>
                                                    </ul>
                                                    <?php if ($key == count($activity_val)) { ?></div><?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <?php $j++;
                                    }
                                } ?>
                            </div>

                        <?php } ?>

                       <!-- <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true"></div>-->

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--<div class="clearfix"></div>-->
<!--</div>-->

