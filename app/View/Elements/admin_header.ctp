<?php
$this->start('admin_header');
?>
            <div>
                <div>
                    <?php echo $this->Html->image('pinoy_tv_guide_logo_top.png', array('width' => '140px','id' => 'header-logo')); ?>
                    <h2 class="pull-right">Admin Panel</h2>
                </div>
                <div>
                    <ul id="admin-top-navibar" class="inline">
                        <li><?php echo $this->Html->link('Dashboard','/admin'); ?></li>
                        <li><?php echo $this->Html->link('Channels','/admin/channels'); ?></li>
                        <li><?php echo $this->Html->link('TV Programs','/admin/tv_programs'); ?></li>
                    </ul>
                </div>
                <div>
                    <!-- breadcrumbs here -->
                    Logged in as: <strong><?php echo $users['username']; ?></strong>
                    <?php echo $this->Html->link('Logout', '/admin/logout'); ?>
                </div>
            </div>
<?php
$this->end();
?>