<?php $this->element('admin_header'); ?>
<div>
    <h3>Add TV Program</h3>
    <?php
        $error_wrap_span = array('attributes' => array('wrap' => 'span'));
        echo $this->Form->create('TvProgram', array(
            'inputDefaults' => $error_wrap_span
        ));
        
        echo $this->Form->input('TvProgram.program_name');
        echo $this->Form->input('TvProgram.program_description', array(
            'type' => 'textarea'
        ));
        echo $this->Form->select('TvProgram.tv_category_id', $categories_list);
        echo $this->Form->submit('Add', array(
            'class' => 'btn'
        ));
        
        echo $this->Form->end();
    ?>
</div>