<tr>
    <?php
        $current_iter_channel = 0;
        $num_iter = 0;
        foreach ($schedules_array as $value) {
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
        <td>
            <?php echo date('g:i A',strtotime($value['TvProgramSchedule']['time_start'])); ?> - <?php echo date('g:i A',strtotime($value['TvProgramSchedule']['time_end'])); ?>
        </td>
        <td><?php echo $value['TvProgram']['program_name']; ?></td>
    </tr>
    <?php
        }
    ?>
</tr>