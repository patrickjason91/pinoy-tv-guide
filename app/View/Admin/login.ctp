<?php
echo $this->Form->create('User', array(
    'id' => 'form-admin-login',
    'class' => 'radial-border thin-gray-border',
    'url' => '/admin/login',
    'type' => 'post'
));
?>
<?php echo $this->Html->image('pinoy_tv_guide_logo_top.png', array('url' => '/')); ?>
<h3 class="form-signin-heading">Admin Panel</h3>
<?php
echo $this->Form->input('username', array(
    'label' => false,
    'maxlength' => 32,
    'placeholder' => 'Username')
    );
echo $this->Form->input('password', array(
    'label' => false,
    'maxlength' => 32,
    'placeholder' => 'Password')
    );
echo $this->Form->submit('Login', array(
    'div' => false,
    'class' => 'btn btn-primary')
    );
echo $this->Form->end();
?>
<div>
    <?php echo $this->Html->link('Home','/',array('target'=> '_blank')) ?> | Copyright <?php echo date('Y'); ?> Patrick Jason Lim
</div>
