<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('View Article')); ?>
<div class="articles view">
<h2><?php  echo __('Article'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($article['Article']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($article['Article']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($article['Article']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($article['User']['id'], array('controller' => 'users', 'action' => 'view', $article['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article Revision Count'); ?></dt>
		<dd>
			<?php echo h($article['Article']['article_revision_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($article['Article']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($article['Article']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>