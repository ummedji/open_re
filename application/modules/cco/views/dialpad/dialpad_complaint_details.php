<link rel="stylesheet" type="text/css" href="http://webcluesglobal.com/qa/re/public/themes/default/css/bootstrap-select.min.css" media="screen" />
<script type="text/javascript" src="http://localhost/open_re/trunk/public/themes/default/js/bootstrap-select.min.js"></script>
<div class="actv-details-form">
    <div class="col-md-12 text-center plng_sub_nave_cco">
        <div class="inn_sub_nave">
            <ul>

                <li class="active"><a href="javascript:void(0);" onclick="get_complaint_detail_data(<?php echo $customer_id; ?>);">Add A Complaint</a></li>
                <li class=""><a href="javascript:void(0);" onclick="get_complaint_view_data(<?php echo $customer_id; ?>);">View Complaint</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <h5>Complaint</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_complaint_info','name'=>'dialpad_complaint_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_complaint_info',$attributes);
        ?>

        <div class="row">
            <div class="cco-feld">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Id">Complaint Id</label>
                                <input type="text" class="form-control" id="Complaint Id" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select class="form-control">
                                    <option>Status1</option>
                                    <option>Status2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Type">Complaint Type</label>
                                <select class="form-control">
                                    <option>Complaint Type1</option>
                                    <option>Complaint Type2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Entry Date">Complaint Entry Date</label>
                                <input type="text" class="form-control" id="Complaint Id" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Due Date">Complaint Due Date</label>
                                <input type="text" class="form-control" id="Complaint Due Date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Complaint Subject</label>
                                <input type="text" class="form-control" id="Complaint Subject" placeholder="">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="cco-feld" style="border-bottom: solid 1px #bbbdc0;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Remark</label>
                                <textarea class="form-control" rows="3" name="Comments" id="Comments" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Complaint Body</label>
                                <textarea class="form-control" rows="3" name="Comments" id="Comments" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="cco-feld">
                <div class="col-md-12"><h4 style="margin-top: 0;">Responsible Person</h4></div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Department</label>
                                <select class="form-control">
                                    <option>Complaint Type1</option>
                                    <option>Complaint Type2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="Complaint Subject" placeholder="First Education Data">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Designstion</label>
                                <select class="form-control">
                                    <option>Complaint Type1</option>
                                    <option>Complaint Type2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="Complaint Subject" placeholder="Second Education Data">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Person Name</label>
                                <select class="form-control">
                                    <option>Complaint Type1</option>
                                    <option>Complaint Type2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="Complaint Subject" placeholder="Third Education Data">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 text-right">
            <div class="row save_btn">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="submit" class="btn btn-primary">Cancel</button>
            </div>
        </div>

        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>