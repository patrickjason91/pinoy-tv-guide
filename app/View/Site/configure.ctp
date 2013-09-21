<div id="configure-main">
    <h3 class="center">Pinoy TV Guide - First-Run Configuration</h3>
    <p>
        This is the first time Pinoy TV Guide runs on your server. To continue usage, please create a new user, which will then serve as your very first administrator account to use in overall administration of the system.
    </p>
    <div class="thin-gray-border">
        <?php
            echo $this->Form->create('User');
            echo $this->Form->input('username', array(
                'value' => 'admin'
            ));
            echo $this->Form->input('password', array(
                'maxlength' => 32
            ));
            echo $this->Form->input('email', array(
                'value' => 'admin@' . $this->request->host()
            ));
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->submit('Create a new account', array('class' => 'btn btn-primary'));
            echo $this->Form->end();
        ?>
    </div>
</div>