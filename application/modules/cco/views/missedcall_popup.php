                    <div id="missedcall_data">
                    <?php
                    if ($this->input->is_ajax_request()) {
                        echo theme_view('common/middle');
                    }
                    ?>
                </div>

                <?php if(!$this->input->is_ajax_request()){ ?>

                    <div id="middle_container" class="feedback">

                    </div>

                <?php } ?>

