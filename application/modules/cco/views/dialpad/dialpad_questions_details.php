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
                        <li role="presentation" class="active"><a class="phase_question_data" rel="<?php echo $phase_data["phase_id"]; ?>" href="#phase-<?php echo $phase_data["phase_id"]; ?>" aria-controls="phase-<?php echo $phase_data["phase_id"]; ?>" role="tab" data-toggle="tab"><?php echo $phase_data["phase_name"]; ?></a></li>
                <?php
                    }
                }

                ?>

            </ul>
            <div class="tab-content">

                <?php

                if(!empty($campagain_phase_data))
                {
                    $i = 0;
                foreach($campagain_phase_data as $key_data => $phase_data)
                {
                    $class = "";
                    if($key_data == 0){
                        $class="active";
                    }
                ?>
                    <div role="tabpanel" class="tab-pane <?php echo $class; ?>" id="phase-<?php echo $phase_data["phase_id"]; ?>">
                        <ul class="in-ques-ans-par">
                            <li>
                                <ul class="fn-ques-ans">
                                    <li class="qsh-txt">Q 1</li>
                                    <li style="width: auto;"> Lorem ipsum dolor sit amet, nunc dui leo, senectus malesuada ?</li>
                                </ul>
                                <ul class="fn-ques-ans">
                                    <li class="qsh-txt">Ans.</li>
                                    <li class="ansh-txt"><input class="form-control" name="Campaign" id="Campaign" placeholder="" type="text"></li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <ul class="fn-ques-ans">
                                    <li class="qsh-txt">Q 2</li>
                                    <li style="width: auto;"> Lorem ipsum dolor sit amet, nunc dui leo, senectus malesuada ?</li>
                                </ul>
                                <ul class="fn-ques-ans">
                                    <li class="qsh-txt">Ans.</li>
                                    <li class="ansh-txt">
                                        <div class="radio_space">
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio" id="radio1" value="1" type="radio">
                                                <label for="radio1">Lorem ipsum</label>
                                            </div>
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio" id="radio2" value="2" type="radio">
                                                <label for="radio2">Lorem ipsum</label>
                                            </div>
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio" id="radio3" value="3" type="radio">
                                                <label for="radio3">Lorem ipsum</label>
                                            </div>
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio" id="radio4" value="4" type="radio">
                                                <label for="radio4">Lorem ipsum</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <ul class="fn-ques-ans">
                                    <li class="qsh-txt">Q 2</li>
                                    <li style="width: auto;"> Lorem ipsum dolor sit amet, nunc dui leo, senectus malesuada ?</li>
                                </ul>
                                <ul class="fn-ques-ans">
                                    <li class="qsh-txt">Ans.</li>
                                    <li class="ansh-txt">
                                        <div class="radio_space">
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio1" id="radio5" value="5" type="radio">
                                                <label for="radio5">Lorem ipsum</label>
                                            </div>
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio1" id="radio6" value="6" type="radio">
                                                <label for="radio6">Lorem ipsum</label>
                                            </div>
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio1" id="radio7" value="7" type="radio">
                                                <label for="radio7">Lorem ipsum</label>
                                            </div>
                                            <div class="radio">
                                                <input class="select_customer_type" name="radio1" id="radio8" value="8" type="radio">
                                                <label for="radio8">Lorem ipsum</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </div>
                <?php

                    $i++;

                }
                }

                ?>

            </div>
            <div class="clearfix"></div>
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