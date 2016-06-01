<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Forgot Password')); ?>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Reset Account'); ?></legend>
        <?php
        echo $this->Form->input('email');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Continue')); ?>
</div>
