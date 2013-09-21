<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $useTable = 'user';
    public $primaryKey = 'user_id';
    
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Username required',
                'allowEmpty' => false,
                'required' => true
            ),
            'Username already used' => array(
                'rule' => 'isUnique'
            ),
            'Only alphanumeric characters allowed' => array(
                'rule' => 'alphaNumeric'
            ),
            'minlength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Min length is 5 chars',
                'on' => 'create'
            ),
            'maxlength' => array(
                'rule' => array('maxLength', 32),
                'message' => 'Max length is 32 chars',
                'on' => 'create'
            )
        ),
        'password' => array(
            'minlength' => array(
                'rule' => array('minLength', 8),
                'message' => 'Min length is 8 chars',
                'on' => 'create',
                'allowEmpty' => false,
                'required' => true
            ),
            'maxlength' => array(
                'rule' => array('maxLength', 32),
                'message' => 'Max length is 32 chars',
                'on' => 'create'
            ),
            'Password cannot be empty' => array(
                'rule' => 'notEmpty'
            )
        ),
        'email' => array(
            'Email already used, try another' => array(
                'rule' => 'isUnique'
            ),
            'Must be a valid email address' => array(
                'rule' => 'email'
            )
        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
}