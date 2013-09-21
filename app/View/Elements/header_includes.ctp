<?php
    echo $this->fetch('meta');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->script(array('jquery-1.8.2.min', 'bootstrap.min'));
    echo $this->Html->meta(
                'favicon.ico',
                '/favicon.ico',
                array('type' => 'icon')
            );
    echo $this->fetch('jqueryui');
?>
<title><?php echo $title_for_layout; ?></title>