<!-- Modal -->
<div id="missedcall_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Missed Calls</h4>
            </div>
            <div class="modal-body">

                <?php
                if ($this->input->is_ajax_request()) {
                    echo theme_view('common/middle');
                }
                ?>

                <?php if(!$this->input->is_ajax_request()){ ?>
                <div id="feedback_data">

                </div>


                    <div id="middle_container" class="feedback">

                    </div>

                <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>





    </div>
</div>