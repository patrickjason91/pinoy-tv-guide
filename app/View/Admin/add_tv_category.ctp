<?php $this->element('admin_header'); ?>
<div>
    <div class="row-fluid">        
        <h3>Add TV Category</h3>
        <div class="span5">
        
        <?php
        $error_wrap_span = array('attributes' => array('wrap' => 'span'));
        echo $this->Form->create('TvCategory');

        echo $this->Form->input('TvCategory.category_name', array(
            'error' => $error_wrap_span
        ));
        echo $this->Form->submit('Add', array(
            'class' => 'btn'
        ));
        
        echo $this->Form->end();
        ?>    
        </div>
        <div class="span5">
            <h4>All Categories</h4>
            <?php echo $this->Html->nestedList($all_categories); ?>
        </div>
    </div>
</div>
