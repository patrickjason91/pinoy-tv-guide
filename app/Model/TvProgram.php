<?php

class TvProgram extends AppModel {
    public $useTable = 'tv_program';
    public $primaryKey = 'program_id';
    public $belongsTo = array(
        'TvCategory' => array(
            'className' => 'TvCategory',
            'foreignKey' => 'tv_category_id'
        )
    );
    public $hasMany = array(
        'TvProgramSchedule' => array(
            'className' => 'TvProgramSchedule',
            'foreignKey' => 'program_id'
        )
    );
    
    public $validate = array(
        'program_name' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Cannot be empty',
                'required' => true,
            )
        )
    );
    
    public function getCurrentHourSchedule() {
        
    }
}