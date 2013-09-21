<?php $this->element('admin_header'); ?>
<div>
    <h3>Users/Admins</h3>
    <div class="row-fluid">
        <div class="span3">
            <h5>Logged Admin</h5>
            <dl class="dl-horizontal">
                <dt>Username</dt><dd><?php echo $users['username']; ?></dd>
                <dt>First Name</dt><dd><?php echo $users['first_name']; ?></dd>
                <dt>Last Name</dt><dd><?php echo $users['last_name']; ?></dd>
                <dt>Email</dt><dd><?php echo $users['email']; ?></dd>
            </dl>
            <h5>Quick Add User</h5>
            <div>
                <?php
                echo $this->Form->create('User',array(
                    'url' => array('controller' => 'admin', 'action' => 'add_user')
                ));

                echo $this->Form->input('User.username', array(
                    'maxlength' => 32
                ));
                echo $this->Form->input('User.email');
                echo $this->Form->input('User.password', array(
                    'maxlength' => 32
                ));
                echo $this->Form->input('User.status', array(
                    'type' => 'select',
                    'label' => 'User Type',
                    'options' => array('Regular user', 'Admin')
                ));
                echo $this->Form->submit('Add', array(
                    'class' => 'btn'
                ));

                echo $this->Form->end();
                ?>
            </div>
        </div>
        <div class="span8">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th colspan="2">Options</th>
                    </tr>
                    <?php
                        foreach($users_list as $user) {
                        $user_inner = $user['User'];
                    ?>
                    <tr>
                        <td><?php echo $user_inner['user_id']; ?></td>
                        <td><?php echo $user_inner['username']; ?></td>
                        <td><?php echo $user_inner['first_name']; ?></td>
                        <td><?php echo $user_inner['last_name']; ?></td>
                        <td><?php echo $this->Html->link('Edit', '/admin/edit_user/' . $user_inner['user_id']); ?></td>
                        <td>Delete</td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
