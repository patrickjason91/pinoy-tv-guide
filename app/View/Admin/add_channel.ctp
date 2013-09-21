<?php $this->element('admin_header'); ?>
<div>
    <h3>
        Add TV Channel
    </h3>
    <?php
        $error_wrap_span = array('attributes' => array('wrap' => 'span'));
        
        echo $this->Form->create('Channel', array(
            'inputDefaults' => array(
                'error' => $error_wrap_span
            )
        ));
        
        echo $this->Form->input('Channel.channel_name');
        echo $this->Form->input('Channel.channel_no');
        echo $this->Form->input('Channel.channel_description', array(
            'type' => 'textarea'
        ));
        echo $this->Form->select('region_id', $region_options);
        
        echo $this->Form->submit('Add', array(
            'class' => 'btn'
        ));
        
        echo $this->Form->end();
    ?>
</div>