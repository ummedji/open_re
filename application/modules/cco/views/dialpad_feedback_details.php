<div class="actv-details-form">
    <h5>Feedback</h5>
    <div class="back_details">


        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_feedback_view_info','name'=>'dialpad_feedback_view_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_feedback_view_info',$attributes);
        ?>
        <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />


        <div class="row">

            <div class="col-md-11" id="feedback_detail_data">



                <div class="rotate_data">

                            <div class="row">

                                <div class="col-md-4 col-sm-6 com_form">
                                    <div class="form-group">
                                        <label for="Customer Name">Customer Name</label>

<?php
$customer_name = (isset($get_user_data['0']['username']) && !empty($get_user_data['0']['username'])) ? $get_user_data['0']['username'] : "";
$customer_type_c= (isset($get_user_data['0']['role_id']) && !empty($get_user_data['0']['role_id'])) ? $get_user_data['0']['role_id'] : "";
if($customer_type_c =="9"){
    $customer_type="Distributor";
}
if($customer_type_c =="10"){
    $customer_type="Retailer";
}
if($customer_type_c =="11"){
    $customer_type="Farmer";
}

?>

                                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="" value="<?php echo $customer_name; ?>"   />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 com_form">
                                    <div class="form-group">
                                        <label for="Subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="" value="" />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-md-12 com_form">
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea class="form-control" rows="3" name="description" id="description" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
             </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-1 col-md-1-n">
            <label class="space_llb">&nbsp;</label>
            <button type="submit" class="btn btn-default back_details-button">Save</button>
        </div>
        <div class="col-md-1 col-md-1-n">
            <label class="space_llb">&nbsp;</label>
            <button type="submit" class="btn btn-default back_details-button" onclick="location.reload();">Cancel</button>
        </div>

        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>


    <div id="no-more-tables" class="feedback_container">
        <table class="col-md-12 table-bordered table-striped table-condensed cf">
            <thead class="cf">
            <tr>
                <th>SR No
                    <span class="rts_bordet"></span>
                </th>
                <th>Date
                    <span class="rts_bordet"></span>
                </th>
                <th>Customer Type
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric">Subject
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric">Discription
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric">Entered By
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric">Edit
                    <span class="rts_bordet"></span>
                </th>
                <th class="numeric">Delete
                    <span class="rts_bordet"></span>
                </th>


            </tr>
            </thead>
            <tbody class="dialpad_main_screen">

            <?php
            if(!empty($get_feedback_data))
            {
                foreach($get_feedback_data as $key=>$feed_data)
                {
                    ?>
                    <tr>
                        <td data-title="Farmer Call Name"><?php echo $feed_data["feedback_id"]; ?></td>

                        <td data-title="First Name"><?php echo date("Y-m-d",strtotime($feed_data["created_on"])); ?></td>
                        <td data-title="Last Name"><?php echo $customer_type; ?></td>

                        <td data-title="Other No."><?php echo $feed_data["feedback_subject"]; ?></td>
                        <td data-title="Fixed Landline No."><?php echo $feed_data["feedback_description"]; ?></td>
                        <td data-title="Pincode"><?php echo $logged_in_user; ?></td>
                        <td data-title="Level 3"> <div class="edit_i" prdid ="<?php ?>" <?php ?>><a href="javascript: void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></div></td>
                        <td data-title="Level 2"> <div class="delete_i" prdid ="<?php ?>"><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></td>


                    </tr>

                <?php
                }
            }
            else{
                ?>
                <h1 align="center" class="on_data">No Data Available</h1>
            <?php
            }
            ?>

            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>



   </div>
   <div class="clearfix"></div>

