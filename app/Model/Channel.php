<?php

class Channel extends AppModel {
    public $useTable = 'channel';
    public $primaryKey = 'channel_id';
    public $belongsTo = array(
        'Region' => array(
            'className' => 'Region',
            'foreignKey' => 'region_id'
        )
    );
    public $hasMany = array(
        'TvProgramSchedule' => array(
            'className' => 'TvProgramSchedule',
            'foreignKey' => 'channel_id'
        )
    );
    
    public $validate = array(
        'channel_name' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'cannot be empty',
            )            
        ),
        'channel_description' => array(),
        'channel_no' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'cannot be empty',
                'required' => true,
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => 'naturalNumber',
                'message' => 'must be a number'
            )
        ),
        'region_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'no region selected',
                'required' => true,
                'allowEmpty' => false
            )
        )
    );
    
    public function getCurrentListings($channel_id) {
        
    }
}