<?php echo $this->Html->docType('html5'); ?>
<html>
    <head>
        <?php
            echo $this->element('header_includes');
            echo $this->Html->css('styles');
        ?>
    </head>
    <body>
        <div id="main-container" class="container">
            <?php echo $this->element('top_navibar'); ?>
            <?php echo $this->element('top_additional_bar'); ?>
            <?php echo $this->fetch('content'); ?>
            <?php echo $this->element('footer'); ?>
        </div>
    </body>
</html>
