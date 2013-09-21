<?php $this->element('admin_header'); ?>
<div>
    <h3>
        Edit TV Channel - <?php echo $current_channel['Channel']['channel_name'].' - '. $current_channel['Region']['region_name']; ?>
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
        echo $this->Form->input('region_id', array(
            'options' =>  $region_options
        ));
        
        echo $this->Form->submit('Edit', array(
            'class' => 'btn'
        ));
        
        echo $this->Form->end();
    ?>
</div>