<div class="articleRevisionReviews index">
	<h2><?php echo __('Article Revision Reviews'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('article_revision_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($articleRevisionReviews as $articleRevisionReview): ?>
	<tr>
		<td><?php echo h($articleRevisionReview['ArticleRevisionReview']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($articleRevisionReview['ArticleRevision']['id'], array('controller' => 'article_revisions', 'action' => 'view', $articleRevisionReview['ArticleRevision']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($articleRevisionReview['User']['id'], array('controller' => 'users', 'action' => 'view', $articleRevisionReview['User']['id'])); ?>
		</td>
		<td><?php echo h($articleRevisionReview['ArticleRevisionReview']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $articleRevisionReview['ArticleRevisionReview']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $articleRevisionReview['ArticleRevisionReview']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $articleRevisionReview['ArticleRevisionReview']['id']), null, __('Are you sure you want to delete # %s?', $articleRevisionReview['ArticleRevisionReview']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Article Revision Review'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision'), array('controller' => 'article_revisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
