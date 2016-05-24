<?php
// Note: my_datetime_diff('your date time with/without format', 'time diff EX: 5:30:00 or -5:30:00'); it is a helper function
?>
<div class="admin-box">

    <table id="data"  class="table table-striped" align="center">
        <thead>
        <tr>
            <th colspan="6">Total Campaign : <?php echo $result['total']; ?></th>
        </tr>

        <tr>
            <th>#</th>
            <th>Campaign Title</th>
            <th>Send Status</th>
            <th>Created On</th>
            <th>Sent On</th>
            <th>Template</th>
        </tr>
        </thead>
        <tbody>

        <?php
    if (isset($result) && is_array($result) && count($result))
    {
        for($i=0; $i<$result['total'];$i++)
        {
            $data = $result['data'][$i];
            $cid = $data['id'];
            ?>
            <tr align="center">
            <td> <?php echo ($i+1); ?></td>
            <td><a href="<?php echo site_url(SITE_AREA .'/content/newsletter/campaignStats/'.$cid) ?>"><?php echo $data['title']; ?></a></td>
            <td><?php echo $data['status']; ?></td>
            <td><?php echo my_datetime_diff($data['create_time'], '-5:00:00'); ?></td>
            <td>
                <?php

                echo my_datetime_diff($data['send_time'],'-5:00:00');
                ?>
            </td>
            <td>
                <a target="_blank" href="<?php echo base_url(SITE_AREA . "/content/newsletter/campaignContent/$cid"); ?>">
                    <u>View</u>
                </a>
            </td>
            </tr>
        <?php
        }
    }
?>
        </tbody>
        </table>
</div>