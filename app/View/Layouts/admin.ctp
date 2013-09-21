<?php echo $this->Html->doctype('html5'); ?>
<html>
    <head>
        <?php
            echo $this->element('header_includes');
            echo $this->Html->css('admin');
            echo $this->Html->css('styles');
        ?>
    </head>
    <body>
        <div id="main" class="container">
            <?php echo $this->fetch('admin_header'); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </body>
</html>
