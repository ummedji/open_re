<script>

    window.ajaxUrl1 = "<?php echo base_url(SITE_AREA . "/content/newsletter/camp_who_opened"); ?>";
    window.ajaxUrl2 = "<?php echo base_url(SITE_AREA . "/content/newsletter/CpUnsubscribes"); ?>";
    window.ajaxUrl3 = "<?php echo base_url(SITE_AREA . "/content/newsletter/hardBounce"); ?>";
    window.ajaxUrl4 = "<?php echo base_url(SITE_AREA . "/content/newsletter/SoftBounces"); ?>";
    window.ajaxUrl5 = "<?php echo base_url(SITE_AREA . "/content/newsletter/clickDetail"); ?>";
    window.ajaxUrl6 = "<?php echo base_url(SITE_AREA . "/content/newsletter/campaignContent"); ?>";

    window.divId = "mydiv";

</script>
<div class="admin-box">
    <div>
    <table class="table table-striped" align="center">
        <tr>
            <th colspan="7">Campaign Sent To : <?php echo $result['emails_sent']; ?> Subscribers</th>
        </tr>

        <tr>
            <th>Total opens</th>
            <th>Last open</th>
            <th>Total Clicks</th>
            <th>Last Click</th>
            <th>Hard Bounce</th>
            <th>Soft Bounce</th>
            <th>Unsubscribed</th>
        </tr>
        <?php
        if (isset($result) && is_array($result) && count($result))
        {

                ?>
                <tr align="center">
                    <td>
                        <?php
                        if(isset($result['opens']) && $result['opens']!=0)
                        { ?>
                            <a onclick="call_camp_open('<?php echo $cid; ?>',ajaxUrl1,divId)" href="javascript:void(0);">

                                <?php echo $result['opens']; ?>
                            </a>
                            <?php
                        }
                        else
                        {
                            echo $result['opens'];
                        }   ?>

                    </td>

                    <td> <?php
                        if(isset($result['opens']) && $result['opens']!=0) {
                            echo my_datetime_diff($result['last_open'], '-5:00:00');
                        }
                        else
                        {
                            echo "---";
                        }
                        ?></td>
                    <td>
                        <?php
                        if(isset($result['clicks']) && $result['clicks']!=0) {
                            //echo $result[clicks];
                            ?>
                            <a onclick="call_camp_open('<?php echo $cid; ?>',ajaxUrl5,divId)" href="javascript:void(0)">
                                <?php echo $result['clicks']; ?>
                            </a>
                        <?php
                        }
                        else
                        {
                            echo $result['clicks'];
                        }
                        ?>
                    </td>

                    <td> <?php if(isset($result['clicks']) && $result['clicks']!=0) {
                                echo my_datetime_diff($result['last_click'], '-5:00:00');
                        }
                        else
                        {
                            echo "---";
                        }?></td>
                    <td>
                        <?php
                        if(isset($result['hard_bounces']) && $result['hard_bounces']!=0) {
                            ?>
                            <a onclick="call_camp_open('<?php echo $cid; ?>',ajaxUrl3,divId)" href="javascript:void(0)">
                                <?php echo $result['hard_bounces']; ?>
                            </a>
                        <?php
                        }
                        else
                        {
                            echo $result['hard_bounces'];
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if(isset($result['soft_bounces']) && $result['soft_bounces']!=0) {
                            ?>
                            <a onclick="call_camp_open('<?php echo $cid; ?>',ajaxUrl4,divId)" href="javascript:void(0)">
                                <?php echo $result['soft_bounces']; ?>
                            </a>
                        <?php
                        }
                        else
                        {
                            echo $result['soft_bounces'];
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        if(isset($result['unsubscribes']) && $result['unsubscribes']!=0) {
                            ?>
                            <a onclick="call_camp_open('<?php echo $cid; ?>',ajaxUrl2,divId)" href="javascript:void(0)">
                                <?php echo $result['unsubscribes']; ?>
                            </a>
                        <?php
                        }
                        else
                        {
                            echo $result['unsubscribes'];
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
        ?>
    </table>
    </div>
    <div id="ajax_loader2"></div>
    <div id="mydiv" style="margin-top: 20px;  min-height: 200px"></div>
</div>