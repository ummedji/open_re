
<?php if(isset($phase_detail) && !empty($phase_detail)){ ?>
    <div class="row">
        <div class="table-recorde">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-default">
                    <tr>
                        <th>Phase</th>
                        <th><img src="<?php echo Template::theme_url('images/watch.png'); ?>">Average Call Duration</th>
                        <th><img src="<?php echo Template::theme_url('images/smile.png'); ?>">Desired Person</th>
                        <th><img src="<?php echo Template::theme_url('images/customer.png'); ?>">Customer Allocated</th>
                        <th><img src="<?php echo Template::theme_url('images/expiry.png'); ?>">Expiry Soon</th>
                        <th><img src="<?php echo Template::theme_url('images/stuatus.png'); ?>">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($phase_detail as $k => $pd){

                            if($pd['phase_status'] == '0')
                            {
                                $status ='<button type="button" class="btn-complete">Pending</button>';
                            }
                            elseif($pd['phase_status'] == '1')
                            {
                                $status ='<button type="button" class="btn-complete">Completed</button>';
                            }
                            else{
                                $status ='<button type="button" class="btn-start-calling">Start Calling</button>';
                            }

                            $end_date=strtotime($pd['end_date']);
                            $curr_date=strtotime(date('Y-m-d'));

                            $datediff = $end_date - $curr_date;

                            if(0 < $datediff)
                            {
                                $days = floor($datediff / (3600*24));
                            }
                            else{
                                $days = 0;
                            }
                            $call = (isset($pd['total_call']) && !empty($pd['total_call'])) ? $pd['total_call'] : 0;
                            $total = (isset($pd['customer_count']) && !empty($pd['customer_count'])) ? $pd['customer_count'] : 0;
                            ?>

                            <tr>
                                <td><h2><?php echo $pd['phase_name']; ?></h2></td>
                                <td class="time-t"><?php echo $pd['avg_call_duration']; ?></td>
                                <td class="persone"><img src="<?php echo Template::theme_url('images/great-icon.png'); ?>">Great</td>
                                <td class="red-text"><?php echo $call.'/'.$total; ?></td>
                                <td class="red-text"><?php echo $days.' Days'; ?></td>
                                <td><?php echo $status ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>