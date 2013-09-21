
<div id="content-container">
    <div class="row-fluid">
        <div class="span3">
            
        </div>
        <div class="span8">
            <div id="shows-current-hour">
                <h3>Anong palabas ngayon?&nbsp;<?php echo $this->Html->image('question_mark_inset.png', array('width' => '30px')); ?></h3>
                <table class="table">
                    <tbody>
                        <?php
                            $current_iter_channel = 0;
                            $num_iter = 0;
                            foreach ($all_current_hour_schedules as $value) {
                        ?>
                        <tr>

                            <td><strong>
                                <?php

                                if ($value['Channel']['channel_id']!= $current_iter_channel) {
                                    echo $value['Channel']['channel_name'] . ' (' . $value['Channel']['channel_no'] . ')';
                                    $current_iter_channel = $value['Channel']['channel_id'];
                                }
                                $num_iter++;
                                ?>
                                </strong>
                            </td>
                            <td><?php echo $value['TvProgram']['program_name']; ?></td>
                            <td>
                                <?php echo date('g:i A',strtotime($value['TvProgramSchedule']['time_start'])); ?> - <?php echo date('g:i A',strtotime($value['TvProgramSchedule']['time_end'])); ?></td>
                            <?php

                            ?>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
        
<!--        <div class="span4">
            <h4 class="header-block"><?php echo $this->Html->image('remote_control_white.png', array('width' => '12px')); ?>&nbsp;Mga Channel</h4>
            <ul class="unstyled">
                <?php
                    foreach ($ten_channels as $susi => $channel) {
                ?>
                <li><?php echo $this->Html->link($channel, '/listings/by_channel_id/'.$susi); ?></li>
                <?php
                    }
               ?>
            </ul>
            <?php echo $this->Html->link('..at iba pa','/channels'); ?>
        </div>-->
    </div>
</div>
<div id="home-featured-container">
    <div class="row-fluid">
        <div class="span8">
        <h2>Anong palabas na?</h2>
            <p>
                Alamin ang mga palabas sa oras na ito, pati na sa mga darating na oras. Asahan ang Pinoy TV Guide para sa iyong panunuod ng palabas sa telebisyon.
            </p>
            <p>
                Currently available listings are for Metro Manila local TV channels only.
            </p>
        </div>
        
    </div>
    
</div>