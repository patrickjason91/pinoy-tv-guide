<?php $this->element('admin_header'); ?>
<div>
    <h3>Add TV Schedule</h3>
    <?php
        $curr_date = getdate();
        echo $this->Form->create('TvProgramSchedule', array(
            'inputDefaults' => array(
                'error' => array('wrap' => 'span')
            )
        ));
        
        echo $this->Form->input('TvProgramSchedule.program_id', array(
            'type' => 'select',
            'options' => $all_programs
        ));
        
        echo $this->Form->input('TvProgramSchedule.channel_id',array(
            'type' => 'select',
            'options' => $all_channels
        ));
        
        echo $this->Form->input('alternate_name');
        
        echo $this->Form->input('sched_day', array(
            'label' => 'Schedule Day',
            'id' => 'sched_day',
            'minYear' => 2012,
            'maxYear' => ($curr_date['year'] + 1)
        ));
        /* echo $this->Form->input('TvProgramSchedule.time_start', array(
            'label' => 'Starting Time',
            'type' => 'datetime',
            'interval' => 5
        ));
        echo $this->Form->input('TvProgramSchedule.time_end', array(
            'label' => 'Ending Time',
            'type' => 'datetime',
            'interval' => 5
        )); */
        
        echo $this->Form->input('TvProgramSchedule.time_start', array(
            'label' => 'Starting Time',
            'type' => 'time',
            'interval' => 5
        ));
        echo $this->Form->input('TvProgramSchedule.time_end', array(
            'label' => 'Ending Time',
            'interval' => 5
        ));
        
        echo $this->Form->radio('occurrence', array(
            '1' => 'Only One Day',
            '2' => 'Weekdays inclusive (starting schedule day to friday)',
            '3' => 'Next n days inclusive (input days in the box)',
            '4' => 'Weekly, next n weeks (input weeks in the box)',
        ), array('value' => '1'));
        echo $this->Form->text('n_repeat', array(
            'maxlength' => 3
        ));
        echo $this->Form->submit('Add', array(
            'class' => 'btn'
        ));
        
        echo $this->Form->end();
    ?>
</div>