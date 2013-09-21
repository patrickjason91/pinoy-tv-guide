            <div id="top-additional-bar" class="clearfix">
                <div class="pull-left">
                    <?php // echo date('M d, Y, g:i A'); ?>
                    <?php echo $this->Html->image('clock_small.png', array('width' => '20px')); ?>
                    <?php
                        $date_details = getdate();
                        $buwan = $date_details['mon'] - 1;
                        $mga_buwan = array('Enero', 'Pebrero', 'Marso', 'Abril', 'Mayo',
                                'Hunyo', 'Hulyo', 'Agosto', 'Setyembre', 'Oktubre',
                                'Nobyembre', 'Disyembre'
                            );
                        echo "Ika-" . $date_details['mday'] . ' ng ' . $mga_buwan[$buwan] . ', ' . $date_details['year']
                                . ' | ' . date('g:i A');
                        echo " (Oras sa Maynila)";
                    ?>
                </div>
                <?php
                    /*echo $this->Form->create(false, array(
                        'class' => 'pull-right',
                        'type' => 'get',
                    ));
                    echo $this->Form->input(null, array(
                        'type' => 'text',
                        'name' => 'topSearch',
                        'placeholder' => 'Search',
                        'class' => 'search',
                        'label' => false,
                        'div', false
                    ));
                    echo $this->Form->end(); */
                ?>
            </div>
