<div class="main-actv-details-form">
    <div class="col-md-12">



        <div class="actv-details-form ques-ans-par">
            <div class="script-box">
                <a href="#" class="btn btn-default script-btn">Script</a>
                <div class="script-cont">

                    <?php

                    if(!empty($campagain_phase_data))
                    {
                        foreach($campagain_phase_data as $key_data => $phase_data)
                        {

                            echo $phase_data["script"];
                            break;
                        }
                    }

                    ?>

                </div>
                <div class="clearfix"></div>
            </div>
            <ul class="phase-list" role="tablist">

                <?php

                if(!empty($campagain_phase_data))
                {
                    foreach($campagain_phase_data as $key_data => $phase_data)
                    {
                ?>
                        <li role="presentation" class="active"><a id="phase_data_<?php echo $phase_data["phase_id"]; ?>" class="phase_question_data" rel="<?php echo $phase_data["phase_id"]; ?>" href="#phase-<?php echo $phase_data["phase_id"]; ?>" aria-controls="phase-<?php echo $phase_data["phase_id"]; ?>" role="tab" data-toggle="tab"><?php echo $phase_data["phase_name"]; ?></a></li>
                <?php
                    }
                }

                ?>

            </ul>

            <?php
            $attributes = array('class' => '', 'id' => 'dialpad_question_data','name'=>'dialpad_question_data', 'autocomplete'=>'off');
            echo form_open('cco/add_update_question_data',$attributes);

            $customer_id = (isset($customer_id) && !empty($customer_id))? $customer_id : "";

            ?>

            <div class="tab-content">
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                <?php

                if(!empty($campagain_phase_data))
                {
                    $i = 0;
                foreach($campagain_phase_data as $key_data => $phase_data)
                {
                    $class = "";
                    if($key_data == 0)
                    {
                        $class="active";
                    }
                ?>
                    <div role="tabpanel" class="tab-pane <?php echo $class; ?>" id="phase-<?php echo $phase_data["phase_id"]; ?>">
                        <ul class="in-ques-ans-par" id="ul-phase-<?php echo $phase_data["phase_id"]; ?>">

                        </ul>
                    </div>
                <?php

                    $i++;

                }
                }

                ?>

            </div>


            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <div class="col-md-12 text-right">
                <div class="row save_btn">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

            <?php echo form_close(); ?>

        </div>

        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".script-btn").click(function(){
            $(".script-cont").toggle();
        });
    });
</script>