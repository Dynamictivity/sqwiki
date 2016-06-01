<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('User Profile')); ?>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Profile Details'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('new_password', array('type' => 'password'));
        echo $this->Form->input('confirm_password', array('type' => 'password'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
