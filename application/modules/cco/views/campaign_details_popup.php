<!-- Start Call Campaign Popup -->
<div id="myModal2" class="modal fade default_popup campaign-popup" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="company-name campaign-grp">
                                <div class="form-inline">
                                    <label>Campaign Name</label>
                                    <select id="campaign_data" class="campaign_data selectpicker" name="campaign_data">
                                        <option value="">Select Campaign</option>
                                    <?php
                                    if(isset($cco_campaign_data) && !empty($cco_campaign_data))
                                    {
                                        foreach($cco_campaign_data as $k=> $val) { ?>
                                            <option value="<?php echo $val["campaign_id"]; ?>"><?php echo $val["campaign_name"]; ?></option>
                                            <?php
                                        }
                                    }
                                     ?>
                                    </select>
                                    <a href="#"><img src="<?php echo Template::theme_url('images/search1.png'); ?>"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="company-details">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 scroll-h">
                                        <div id="content-1" class="content mCustomScrollbar">
                                            <?php if(isset($campaign_details) && !empty($campaign_details)){ ?>
                                                <?php
                                                    foreach($campaign_details as $KEY => $cd) { ?>
                                                        <div class="b-box-border grey-colour" id="campaign_<?php echo $cd['campaign_id'];?>">
                                                            <div class="row">
                                                                <a href="javascript: void(0);" id="campaign_box" class="campaign_box" onclick="getAllPhaseDetails(<?php echo $cd['campaign_id'];?>);">
                                                                    <div class="col-md-2 col-sm-4">
                                                                        <div class="row">
                                                                            <div class="c-name">
                                                                                <h4><?php echo $cd['campaign'] ?></h4>
                                                                                <input name="campaign_id" type="hidden" id="campaign_id" value="<?php echo $cd['campaign_id'];?>"/>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="col-md-10 col-sm-8 ">
                                                                    <div class="row">
                                                                        <div class="c-details">
                                                                                <?php  foreach($cd['phase'] as $k=>$val){ ?>
                                                                                    <div class="col-md-3 r-border">
                                                                                        <div class="c-bottom-b">
                                                                                            <div class="row">
                                                                                                <div class="col-md-3 col-sm-3">
                                                                                                    <div class="p-comany">
                                                                                                        <h2><?php echo $val['phase_name']?></h2>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-9 col-sm-9">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-4 col-sm-7 col-xs-6">
                                                                                                            <div class="manth-s-e"><h6>starts</h6></div>
                                                                                                        </div>
                                                                                                        <div class="col-md-8 col-sm-5 col-xs-6">
                                                                                                            <div class="mont-date"><h6><?php echo date('d M Y',strtotime($val['start_date']))?></h6></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-4 col-sm-7 col-xs-6">
                                                                                                            <div class="manth-s-e"><h6>Ends</h6></div>
                                                                                                        </div>
                                                                                                        <div class="col-md-8 col-sm-5 col-xs-6">
                                                                                                            <div class="mont-date"><h6><?php echo date('d M Y',strtotime($val['end_date']))?></h6></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                        <div class="c-bottom-b">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-sm-12">
                                                                                                    <div class="parpose">
                                                                                                        <h6><?php echo $val['campaign_purpose']?></h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-7 col-sm-8 col-xs-7">
                                                                                                <div class="pandding-call">
                                                                                                    <h6>panding call</h6>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-5 col-sm-4 col-xs-5">
                                                                                                <div class="call-no">
                                                                                                    <h6><?php echo $val['total_call'].'/'.$val['customer_count'] ?></h6>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "phase_details">
                        <div class="row">
                            <div class="table-recorde">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>Phase</th>
                                            <th><img src="<?php echo Template::theme_url('images/watch.png'); ?>">Average Call Duration</th>
                                            <th><img src="<?php echo Template::theme_url('images/smile.png'); ?>">Desired Person</th>
                                            <th><img src="<?php echo Template::theme_url('images/customer.png'); ?>">Customer Allocated</th>
                                            <th><img src="<?php echo Template::theme_url('images/expiry.png'); ?>">Expiry Soon</th>
                                            <th><img src="<?php echo Template::theme_url('images/stuatus.png'); ?>">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody >

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Call Campaign Popup -->


<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>