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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ArticleRevisionReview.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ArticleRevisionReview.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Article Revision Reviews'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision'), array('controller' => 'article_revisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
