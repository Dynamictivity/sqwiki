<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('View Article Revision Review')); ?>
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