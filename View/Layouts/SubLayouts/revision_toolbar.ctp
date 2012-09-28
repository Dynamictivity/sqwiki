<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<div class="article-toolbar right">
	<?php echo $this->Html->link(__('Article'), array('controller' => 'articles', 'action' => 'view', $articleRevision['Article']['id'])); ?>
	<?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', $articleRevision['Article']['id'])); ?>
	<?php if (AuthComponent::user() && AuthComponent::user('role_id') < 3) : ?>
		<?php if (empty($articleRevision['ReviewedByUser']['id'])) : ?>
			<?php echo $this->Html->link(__('Approve'), array('action' => 'approve', $articleRevision['ArticleRevision']['id']), array('class' => 'ui-state-highlight')); ?>
			<?php echo $this->Html->link(__('Reject'), array('action' => 'reject', $articleRevision['ArticleRevision']['id']), array('class' => 'ui-state-error')); ?>
		<?php else : ?>
			<?php if (!$articleRevision['ArticleRevision']['is_active']) : ?>
				<?php echo $this->Html->link(__('Approve'), array('action' => 'approve', $articleRevision['ArticleRevision']['id']), array('class' => 'ui-state-highlight')); ?>
			<?php else : ?>
				<?php echo $this->Html->link(__('Reject'), array('action' => 'reject', $articleRevision['ArticleRevision']['id']), array('class' => 'ui-state-error')); ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>
<div class="clear"></div>
<?php echo $this->fetch('content'); ?>