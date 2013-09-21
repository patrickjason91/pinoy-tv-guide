<?php

class TvProgramSchedule extends AppModel {
    public $useTable = 'tv_program_schedule';
    public $primaryKey = 'tv_schedule_id';
    public $belongsTo = array(
        'Channel' => array(
            'className' => 'Channel',
            'foreignKey' => 'channel_id'
        ),
        'TvProgram' => array(
            'className' => 'TvProgram',
            'foreignKey' => 'program_id'
        ),
    );
    public $validate = array(
        
    );
}
