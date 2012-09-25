<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('View Article Revision')); ?>
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