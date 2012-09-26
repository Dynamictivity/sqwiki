<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<div class="article-toolbar right">
	<?php if (empty($articleRevision['ReviewedByUser']['id'])) : ?>
		<?php echo $this->Html->link(__('Approve'), array('action' => 'approve', $articleRevision['ArticleRevision']['id'])); ?>
		<?php echo $this->Html->link(__('Reject'), array('action' => 'reject', $articleRevision['ArticleRevision']['id'])); ?>
	<?php else : ?>
		<?php if (!$articleRevision['ArticleRevision']['is_active']) : ?>
			<?php echo $this->Html->link(__('Activate'), array('action' => 'activate', $articleRevision['ArticleRevision']['id'])); ?>
		<?php else : ?>
			<?php echo $this->Html->link(__('Deactivate'), array('action' => 'deactivate', $articleRevision['ArticleRevision']['id'])); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>
<div class="clear"></div>
<?php echo $this->fetch('content'); ?>