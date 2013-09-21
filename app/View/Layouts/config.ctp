<?php echo $this->Html->doctype('html5'); ?>
<html>
    <head>
        <?php
            echo $this->element('header_includes');
            echo $this->Html->css('admin');
        ?>
    </head>
    <body>
        <div class="container">
            <?php echo $this->fetch('content'); ?>
        </div>
    </body>
</html>
