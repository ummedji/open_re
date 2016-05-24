<?php if (!isset($keyword)): ?>
<input type="text" name="search_user" id="search_user" autocomplete="off" style="margin-top: 10px;" /><br/>
<?php endif; ?>
<div id="user_email_list" class="user_email_list">        
    <ul>
        <?php foreach ($users as $user): ?>
            <?php //if ($user->banned == '0' && $user->active == '1'): ?>
                <li>
                    <input type="checkbox" name="selected_emails[]" value="<?php echo $user->ID.','.$user->emailID; ?>" />
                    <span>
                        <?php echo $user->emailID; ?>
                    </span>
                </li>
            <?php //endif; ?>
        <?php endforeach; ?>
    </ul>
</div>