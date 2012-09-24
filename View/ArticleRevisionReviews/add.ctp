<div class="articleRevisionReviews form">
<?php echo $this->Form->create('ArticleRevisionReview'); ?>
	<fieldset>
		<legend><?php echo __('Add Article Revision Review'); ?></legend>
	<?php
		echo $this->Form->input('article_revision_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Article Revision Reviews'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision'), array('controller' => 'article_revisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
