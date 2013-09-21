            <div id="page-footer">
                <div class="clearfix">
                    <ul id="footer-links" class="pull-left inline">
                        <li><?php echo $this->Html->link('Home', '/'); ?></li>
                        <li><?php echo $this->Html->link('About', '/about'); ?></li>
                    </ul>
                    <div class="pull-right">
                        Copyright <?php echo date('Y'); ?> Pinoy TV Guide
                    </div>
                </div>                
                <div id="footer-logo" class="pull-right">
                    <?php
                        echo $this->Html->image('pinoy_tv_guide_logo_small_white.png',
                                    array(
                                        'width' => '80px',
                                    )
                                );
                    ?>
                </div>
            </div>
