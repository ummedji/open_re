<?php echo theme_view('header'); ?>
<!-- Start of Main Container -->
    <?php
    echo isset($content) ? $content : Template::content();

    echo theme_view('footer', array('show' => true));
?>