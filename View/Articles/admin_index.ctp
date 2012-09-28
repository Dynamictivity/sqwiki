<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Articles')); ?>
<div class="articles index">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('article_revision_count'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		foreach ($articles as $article): ?>
			<tr>
				<td><?php echo h($article['Article']['title']); ?>&nbsp;</td>
				<td><?php echo h($article['Article']['slug']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($article['User']['username'], array('controller' => 'users', 'action' => 'view', $article['User']['id'])); ?>
				</td>
				<td><?php echo h($article['Article']['article_revision_count']); ?>&nbsp;</td>
				<td><?php echo $this->Time->timeAgoInWords($article['Article']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $article['Article']['id'])); ?>
					<?php echo $this->Html->link(__('History'), array('action' => 'history', $article['Article']['id'])); ?>
					<?php echo $this->Html->link(__('Talk'), array('action' => 'talk', $article['Article']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div class="right button"><?php echo $this->Html->link(__('New Article'), array('action' => 'add')); ?></div>
</div>