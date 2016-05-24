<ul class="nav nav-pills">
    <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/newsletter') ?>" id="list">
            <?php echo lang('newsletter_list'); ?>
        </a>
    </li>
    <li <?php //echo $this->uri->segment(5) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/newsletter/create') ?>" id="list">Send Newsletter mail</a>
    </li>
    <li <?php //echo $this->uri->segment(6) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/newsletter/show_report') ?>" id="list">Report</a>
    </li>
    <?php /* if ($this->auth->has_permission('Newsletter.Content.Create')) : ?>
    <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
        <a href="<?php echo site_url(SITE_AREA .'/content/newsletter/create') ?>" id="create_new">
        <?php echo lang('newsletter_new'); ?></a>	</li>	<?php endif; */ ?>
</ul>