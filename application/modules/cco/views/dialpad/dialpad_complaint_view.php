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
        <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />
        <div class="row">
            <div class="cco-feld">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Id">Complaint Type</label>
                                <select class="form-control" name="complaint_type" id="complaint_type_view">
                                    <option value="">Select Complaint Type</option>

                                    <?php
                                    if(!empty($get_customer_complaint_type))
                                    {
                                        foreach($get_customer_complaint_type as $comp_key => $complaint_data)
                                        {
                                            /* $selected = "";
                                             foreach($financial_electronic_data as $sel_key => $selected_electronic_data)
                                             {
                                                 if($electronic_data["electonic_id"] == $selected_electronic_data["electronic_owned_id"])
                                                 {
                                                     $selected = "selected = 'selected'";
                                                 }
                                             }
                                             */

                                            ?>
                                            <option <?php //echo $selected; ?> value="<?php echo $complaint_data["complaint_type_id"]; ?>"><?php echo $complaint_data["complaint_type_name"]; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>

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
                        <div id="complaint_data">
                            <?php
                            if ($this->input->is_ajax_request())
                            {
                               //echo theme_view('common/middle');
                            }

                         //   echo theme_view('sub_complaint_detail');

                            ?>

                        </div>
                        <?php  if(!$this->input->is_ajax_request())
                        { ?>

                            <div id="middle_container" class="feedback">

                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="cco-feld">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Id">Complaint Id</label>
                                <input type="text" class="form-control" id="complaint_id" name="complaint_id" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select class="form-control" name="complaint_status" id="complaint_status">
                                    <option value="0" selected="selected">Pending</option>
                                    <option value="1">In Progress</option>
                                    <option value="2">Resolved</option>
                                    <option value="3">Reopen</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Type">Complaint Type</label>
                                <select class="form-control" name="complaint_type" id="complaint_type_edit">
                                    <option value="">Select Complaint Type</option>

                                    <?php
                                    if(!empty($get_customer_complaint_type))
                                    {
                                        foreach($get_customer_complaint_type as $comp_key => $complaint_data)
                                        {
                                            /* $selected = "";
                                             foreach($financial_electronic_data as $sel_key => $selected_electronic_data)
                                             {
                                                 if($electronic_data["electonic_id"] == $selected_electronic_data["electronic_owned_id"])
                                                 {
                                                     $selected = "selected = 'selected'";
                                                 }
                                             }
                                             */

                                            ?>
                                            <option <?php //echo $selected; ?> value="<?php echo $complaint_data["complaint_type_id"]; ?>"><?php echo $complaint_data["complaint_type_name"]; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Complaint Subject</label>
                                <select class="form-control" id="complaint_subject_edit" name="complaint_subject">
                                    <option>Select Subject</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Entry Date">Complaint Entry Date</label>
                                <input type="text" class="form-control" id="Complaint_entry_date_edit" name="Complaint_entry_date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Due Date">Complaint Due Date</label>
                                <input type="text" class="form-control" id="complaint_date1_edit" name="complaint_date1" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Updated Due Date</label>
                                <input type="text" class="form-control"  placeholder="">
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
                                <textarea class="form-control" rows="3" id="remark_edit" name="remark" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Complaint Body</label>
                                <textarea class="form-control" rows="3" name="Comments" id="Comments"  placeholder=""></textarea>
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
                                <input type="text" class="form-control" id="complaint_date1_edit" name="complaint_date1" placeholder="First Education Data">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Designstion</label>
                                <select class="form-control" name="designstion" id="designstion_edit">
                                    <option>Select Designation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="complaint_date2_edit" name="complaint_date2" placeholder="Second Education Data">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="Complaint Subject">Person Name</label>
                                <select class="form-control" name="person_name" id="person_name_edit">
                                    <option>Select Person</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="complaint_date3_edit" name="complaint_date3" placeholder="Third Education Data">
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

<script type="application/javascript">
    $("#complaint_type_view").change(function () {



        var complaint_type_id = $(this).val();
        var customer_id= $('#customer_id').val();

        get_complaint_data_from_complaint_type_id(complaint_type_id,customer_id);

    });
    $("#complaint_type_edit").change(function () {



        var complaint_type_id = $(this).val();
        var customer_id= $('#customer_id').val();

        get_complaint_subject_from_complaint_type_edit(complaint_type_id);

    });
    $("#complaint_subject_edit").change(function () {

        var complaint_subject_id = $(this).val();

        get_complaint_date_from_complaint_subject_edit(complaint_subject_id);
    });
    $("#designstion_edit").change(function () {



        var desigination_country_id = $(this).val();

        get_person_data_from_desigination_edit(desigination_country_id);
    });

</script>