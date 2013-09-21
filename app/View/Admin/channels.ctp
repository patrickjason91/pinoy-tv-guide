<?php $this->element('admin_header'); ?>
<div>
    <h3>TV Channels</h3>
    <div class="row-fluid">
        <div class="span3">
            <h4>Options</h4>
            <ul>
                <li><?php echo $this->Html->link('Add new channel', '/admin/add_channel'); ?></li>
            </ul>
            <h5>Add Channel</h5>
            <div>
                <?php
                echo $this->Form->create('Channel', array(
                    'url' => array('controller' => 'Admin', 'action' => 'add_channel')
                ));

                echo $this->Form->input('Channel.channel_name');
                echo $this->Form->input('Channel.channel_no');
                echo $this->Form->input('Channel.channel_description', array(
                    'type' => 'textarea'
                ));
                echo $this->Form->select('region_id', $regions_list);

                echo $this->Form->submit('Add', array(
                    'class' => 'btn'
                ));

                echo $this->Form->end();
                ?>
            </div>
        </div>
        <div class="span8">
            <?php
                echo $this->Form->create(false, array(
                    'type' => 'get',                
                ));

                echo $this->Form->input(false, array(
                    'name' => 'region_id',
                    'label' => 'Region',
                    'type' => 'select', 
                    'options' => $regions_list
                ));
                echo $this->Form->submit('Change Region', array(
                    'class' => 'btn'
                ));

                echo $this->Form->end();
            ?>
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <th>Channel No</th>
                        <th>Name</th>
                        <th colspan="2">Options</th>
                    </tr>
                    <?php
                        foreach($channels_list as $channel) {
                    ?>
                    <tr>
                        <td><?php echo $channel['Channel']['channel_no'] ?></td>
                        <td><?php echo $channel['Channel']['channel_name']; ?></td>
                        <td><?php echo $this->Html->link('Edit', '/admin/edit_channel/' . $channel['Channel']['channel_id']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
