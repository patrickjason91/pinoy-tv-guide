<?php

class TvCategory extends AppModel {
    public $useTable = 'tv_category';
    public $primaryKey = 'tv_category_id';
    public $hasMany = array(
        'TvProgram' => array(
            'className' => 'TvProgram',
            'foreignKey' => 'tv_category_id'
        )
    );
    
    public $validate = array(
        'category_name' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Required',
                'allowEmpty' => false,
                'required' => true
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Already exists.'
            )
        )
    );
}