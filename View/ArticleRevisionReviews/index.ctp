<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Article Revision Reviewss Index')); ?>
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
	<div class="right button"><?php echo $this->Html->link(__('New Article Revision Review'), array('action' => 'add')); ?></div>
</div>