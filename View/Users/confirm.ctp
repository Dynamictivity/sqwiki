<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Account Confirmation')); ?>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('New Password Details'); ?></legend>
        <?php
        echo $this->Form->hidden('token');
        echo $this->Form->input('new_password', array('type' => 'password'));
        echo $this->Form->input('confirm_password', array('type' => 'password'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Continue')); ?>
</div>
