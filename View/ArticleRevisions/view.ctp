<div class="articleRevisions view">
<h2><?php  echo __('Article Revision'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($articleRevision['ArticleRevision']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article'); ?></dt>
		<dd>
			<?php echo $this->Html->link($articleRevision['Article']['title'], array('controller' => 'articles', 'action' => 'view', $articleRevision['Article']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Revision Id'); ?></dt>
		<dd>
			<?php echo h($articleRevision['ArticleRevision']['revision_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($articleRevision['User']['id'], array('controller' => 'users', 'action' => 'view', $articleRevision['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Summary'); ?></dt>
		<dd>
			<?php echo h($articleRevision['ArticleRevision']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($articleRevision['ArticleRevision']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($articleRevision['ArticleRevision']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($articleRevision['ArticleRevision']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Article Revision'), array('action' => 'edit', $articleRevision['ArticleRevision']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Article Revision'), array('action' => 'delete', $articleRevision['ArticleRevision']['id']), null, __('Are you sure you want to delete # %s?', $articleRevision['ArticleRevision']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
