<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Add User')); ?>
<div class="users form">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend><?php echo __('Add User'); ?></legend>
			<?php
				echo $this->Form->input('username');
				echo $this->Form->input('ip_address');
				echo $this->Form->input('email');
				echo $this->Form->input('new_password');
				echo $this->Form->input('confirm_password');
				echo $this->Form->input('role_id');
				echo $this->Form->input('token');
				echo $this->Form->input('article_count');
				echo $this->Form->input('article_revision_count');
				echo $this->Form->input('comment_count');
				echo $this->Form->input('article_revision_review_count');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>