<?php $this->element('admin_header'); ?>
<div id="dashboard-container">
    <div class="row-fluid">
        <div class="span6 radial-border thin-gray-border">
            <h3><?php echo $this->Html->link('TV Programs', '/admin/tv_programs'); ?></h3>
            <div class="span5">
                <h5>Programs</h5>
                <?php echo $programs; ?>
                <h5>Categories</h5>
                <?php echo $categories;  ?>
            </div>
            <div class="span5">
                <ul>
                    <li><?php echo $this->Html->link('Add TV programs', '/admin/add_tv_program'); ?></li>
                    <li><?php echo $this->Html->link('Add program category', '/admin/add_tv_category'); ?></li>
                    <li><?php echo $this->Html->link('Add program schedules', '/admin/add_schedules'); ?></li>
                </ul>
            </div>
        </div>
        <div class="span6 radial-border thin-gray-border">
            <h3><?php echo $this->Html->link('Channels', '/admin/channels'); ?></h3>
            <div class="span5">
                <strong><?php echo $channels; ?></strong>
            </div>
            <div class="span5">
                <ul>
                    <li><?php echo $this->Html->link('Add channel', '/admin/add_channel'); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6 radial-border thin-gray-border">
            <h3><?php echo $this->Html->link('Regions', '/admin/regions'); ?></h3>
            <div>
                <?php echo $this->Html->link('Add a region', '/admin/add_region'); ?>
            </div>
        </div>
        <div class="span6 radial-border thin-gray-border">
            <h3><?php echo $this->Html->link('Users/Admins', '/admin/users'); ?></h4>
            <div class="span5">
                <h5>All Registered Users</h5>
                <?php echo $all_users; ?>
                <h5>Admins</h5>
                <?php echo $admins; ?>
            </div>
            <div class="span5">
                <?php
                echo $this->Html->link('Add user/admin', '/admin/add_user');
                ?>
            </div>
        </div>
    </div>
</div>
