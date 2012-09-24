<div class="articleRevisionReviews view">
<h2><?php  echo __('Article Revision Review'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($articleRevisionReview['ArticleRevisionReview']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article Revision'); ?></dt>
		<dd>
			<?php echo $this->Html->link($articleRevisionReview['ArticleRevision']['id'], array('controller' => 'article_revisions', 'action' => 'view', $articleRevisionReview['ArticleRevision']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($articleRevisionReview['User']['id'], array('controller' => 'users', 'action' => 'view', $articleRevisionReview['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($articleRevisionReview['ArticleRevisionReview']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Article Revision Review'), array('action' => 'edit', $articleRevisionReview['ArticleRevisionReview']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Article Revision Review'), array('action' => 'delete', $articleRevisionReview['ArticleRevisionReview']['id']), null, __('Are you sure you want to delete # %s?', $articleRevisionReview['ArticleRevisionReview']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revision Reviews'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision Review'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision'), array('controller' => 'article_revisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
