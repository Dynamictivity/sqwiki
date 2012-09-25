<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Edit Comment')); ?>
<div class="comments form">
	<?php echo $this->Form->create('Comment'); ?>
		<fieldset>
			<legend><?php echo __('Edit Comment'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('user_id');
				echo $this->Form->input('article_id');
				echo $this->Form->input('comment');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>