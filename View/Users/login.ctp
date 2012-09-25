<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('User Login')); ?>
<div class="users form">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend><?php echo __('User Login'); ?></legend>
			<?php
				echo $this->Form->input('username');
				echo $this->Form->input('password');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Login')); ?>
</div>