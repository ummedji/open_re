<?php
echo theme_view('header');
?>
    <?php if ($this->session->userdata('user_id') !='') {
    ?>
    <div id="wrapper">
        <?php
    if($this->uri->segment(2) != 'dialpad') {
        echo theme_view('_sitenav');
    }
        ?>
        <!--inner contain-->
        <div class="inner_contain">

            <?php
          //  if($this->uri->segment(1) != 'cco') {
    if($this->uri->segment(2) != 'dialpad') {
        echo theme_view('sidebar');
    }
          //  }
            ?>
            <div class="right_contain">
                <div class="inn_right_contain pr_right_contain">
                    <div id="main">
                        <div class="col-md-12 full-height">
                            <div class="row">
                                <?php
                                echo Template::message();
                                echo isset($content) ? $content : Template::content();
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <?php  echo theme_view('bottombar'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!--inner contain-->
        </div>
    </div>
    <?php
    }
else{

    echo Template::message();
    echo isset($content) ? $content : Template::content();
}
?>


    <?php
    echo theme_view('footer');
    ?>