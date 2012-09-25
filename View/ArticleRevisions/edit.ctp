<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Edit Article Revision')); ?>
<div class="articleRevisions form">
	<?php echo $this->Form->create('ArticleRevision'); ?>
		<fieldset>
			<legend><?php echo __('Edit Article Revision'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('article_id');
				echo $this->Form->input('revision_id');
				echo $this->Form->input('user_id');
				echo $this->Form->input('summary');
				echo $this->Form->input('content');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>