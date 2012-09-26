<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('New User')); ?>
<div class="users form">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend><?php echo __('User Details'); ?></legend>
			<?php
				echo $this->Form->input('username');
				echo $this->Form->input('email');
				echo $this->Form->input('new_password');
				echo $this->Form->input('confirm_password');
				echo $this->Form->input('role_id');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>