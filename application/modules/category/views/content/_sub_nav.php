<ul class="nav nav-pills">
    <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA . '/content/category') ?>" id="list">List</a>
    </li>
    <?php if ($this->auth->has_permission('Category.Content.Create')) : ?>
        <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
            <a href="<?php echo site_url(SITE_AREA . '/content/category/create') ?>" id="create_new">New</a>
        </li>
    <?php endif; ?>
</ul>