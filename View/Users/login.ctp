<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Login')); ?>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Account Details'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
    <p>
        <?php echo $this->Html->link(__('Forgot Password'), array('controller' => 'users', 'action' => 'forgot')); ?>
    </p>
</div>
