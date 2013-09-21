<?php

class Region extends AppModel {
    public $useTable = 'region';
    public $primaryKey = 'region_id';
    public $hasMany = array(
        'Channel' => array(
            'className' => 'Channel',
            'foreignKey' => 'region_id'
        )
    );
    public $validate = array(
        'region_name' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'cannot be empty',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'location' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'cannot be empty',
                'allowEmpty' => false,
                'required' => true
            )
        )
    );
}
