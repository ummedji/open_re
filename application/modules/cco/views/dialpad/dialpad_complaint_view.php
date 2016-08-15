
<div class="actv-details-form">
    <div class="col-md-12 text-center plng_sub_nave_cco">
        <div class="inn_sub_nave">
            <ul>

                <li><a href="javascript:void(0);" onclick="get_complaint_detail_data(<?php echo $customer_id; ?>);">Add A Complaint</a></li>
                <li class="active"><a href="javascript:void(0);" onclick="get_complaint_view_data(<?php echo $customer_id; ?>);">View Complaint</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <h5>Social Connections</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_complaint_view_info','name'=>'dialpad_complaint_view_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_complaint_view_info',$attributes);
        ?>

        <div class="row">
            <div class="cco-feld">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Id">Complaint Type</label>
                                <select class="form-control">
                                    <option>Complaint Type</option>
                                    <option>Complaint Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Status">Distributor Name</label>
                                <select class="form-control">
                                    <option>Distributor Name</option>
                                    <option>Distributor Name</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Contact No.">Contact No.</label>
                                <input type="text" class="form-control" id="Contact No." placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Address</label>
                                <textarea class="form-control" rows="3" name="Comments" id="Comments" placeholder=""></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="cco-feld">
                <div class="col-md-12">
                    <div class="row">
                        table put Here...
                    </div>
                </div>
            </div>

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
                                <input type="text" class="form-control" id="Complaint Due Data" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Complaint Subject</label>
                                <input type="text" class="form-control" id="Complaint Subject" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Updated Due Date</label>
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
            </div>
        </div>

        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>