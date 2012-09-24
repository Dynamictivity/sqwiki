<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Add Article')); ?>
<div class="articles form">
	<?php echo $this->Form->create('Article'); ?>
		<fieldset>
			<legend><?php echo __('Add Article'); ?></legend>
			<?php
				echo $this->Form->input('title');
				echo $this->Form->input('slug');
				echo $this->Form->input('user_id');
				echo $this->Form->input('article_revision_count');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>