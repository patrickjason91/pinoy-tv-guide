<?php $this->element('admin_header'); ?>
<div>
    <h3>Edit User</h3>
    <?php 
        $error_wrap_span = array('attributes' => array('wrap' => 'span'));
        echo $this->Form->create('User');

        echo $this->Form->input('User.username', array(
            'maxlength' => 32,
            'error' => $error_wrap_span
        ));
        echo $this->Form->input('User.email', array(
            'error' => $error_wrap_span
        ));
        echo $this->Form->input('User.first_name');
        echo $this->Form->input('User.last_name');
        echo $this->Form->input('User.status', array(
            'type' => 'select',
            'label' => 'User Type',
            'options' => array('Regular user', 'Admin')
        ));
        echo $this->Form->submit('Ok', array(
            'class' => 'btn'
        ));

        echo $this->Form->end();
    ?>
</div>