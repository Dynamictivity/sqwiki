<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Articles Index')); ?>
<div class="articles index">
	<h2><?php echo __('Articles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('article_revision_count'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		foreach ($articles as $article): ?>
			<tr>
				<td><?php echo h($article['Article']['id']); ?>&nbsp;</td>
				<td><?php echo h($article['Article']['title']); ?>&nbsp;</td>
				<td><?php echo h($article['Article']['slug']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($article['User']['id'], array('controller' => 'users', 'action' => 'view', $article['User']['id'])); ?>
				</td>
				<td><?php echo h($article['Article']['article_revision_count']); ?>&nbsp;</td>
				<td><?php echo h($article['Article']['created']); ?>&nbsp;</td>
				<td><?php echo h($article['Article']['updated']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $article['Article']['id'])); ?>
					<?php echo $this->Html->link(__('Revise'), array('action' => 'revise', $article['Article']['id'])); ?>
					<?php echo $this->Html->link(__('History'), array('action' => 'history', $article['Article']['id'])); ?>
					<?php echo $this->Html->link(__('Talk'), array('controller' => 'comments', 'action' => 'index', $article['Article']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $article['Article']['id']), null, __('Are you sure you want to delete # %s?', $article['Article']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div class="right button"><?php echo $this->Html->link(__('New Article'), array('action' => 'add')); ?></div>
</div>