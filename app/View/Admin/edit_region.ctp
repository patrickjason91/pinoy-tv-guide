<?php $this->element('admin_header'); ?>
<div>
    <h3>
        Edit Region
    </h3>
    <?php
        $error_wrap_span = array('attributes' => array('wrap' => 'span'));
        
        echo $this->Form->create('Channel', array(
            'inputDefaults' => array(
                'error' => $error_wrap_span
            )
        ));
        
        echo $this->Form->input('Region.region_name');
        echo $this->Form->input('Region.location', array('type' => 'textarea'));
        
        echo $this->Form->submit('Add', array(
            'class' => 'btn'
        ));
        
        echo $this->Form->end();
    ?>
</div>
