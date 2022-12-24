<div class="comments index large-9 medium-8 columns content">
    <?php
        if ($this->request->session()->read('Bitbucket_OAuth2')) {
            echo __('Connected!');
            echo '<br><br>';
            echo $this->Html->link(__('Logout now!'), ['controller' => 'Bitbucket', 'action' => 'logout']);
        } else {
            echo __('Not connected!');
            echo '<br><br>';
            echo $this->Html->link(__('Login now!'), ['controller' => 'Bitbucket', 'action' => 'index']);
        }
    ?>
</div>
