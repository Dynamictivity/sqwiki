<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Edit Article Revision Review')); ?>
<div class="articleRevisionReviews form">
	<?php echo $this->Form->create('ArticleRevisionReview'); ?>
		<fieldset>
			<legend><?php echo __('Edit Article Revision Review'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('article_revision_id');
				echo $this->Form->input('user_id');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>