<?php $this->element('admin_header'); ?>
<div>
    <h3>Regions</h3>
    <div class="row-fluid">
        <div class="span3">
            <h5>Quick Add Region</h5>
            <div>
                <?php
                    echo $this->Form->create('Region', array(
                        'url' => array('controller' => 'admin', 'action' => 'add_region')
                    ));

                    echo $this->Form->input('Region.region_name');
                    echo $this->Form->input('Region.location', array('type' => 'textarea'));

                    echo $this->Form->submit('Add', array(
                        'class' => 'btn'
                    ));

                    echo $this->Form->end();
                ?>
            </div>
            <ul>
                <li><?php echo $this->Html->link('Add region', '/admin/add_channel'); ?></li>
            </ul>
        </div>
        <div class="span8">
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <th>Region ID</th>
                        <th>Name</th>
                        <th colspan="2">Options</th>
                    </tr>
                    <?php
                        foreach($regions_list as $region) {
                    ?>
                    <tr>
                        <td><?php echo $region['Region']['region_id'] ?></td>
                        <td><?php echo $region['Region']['region_name']; ?></td>
                        <td><?php echo $this->Html->link('Edit', '/admin/edit_region/' . $region['Region']['region_id']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>