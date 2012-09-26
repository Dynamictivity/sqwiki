<?php $this->extend('/Layouts/SubLayouts/admin_revision_toolbar'); ?>
<?php $this->assign('title', __('View Revision')); ?>
<div class="articleRevisions view">
	<h1><?php echo h($articleRevision['Article']['title']); ?></h1>
	<p><?php echo h($articleRevision['ArticleRevision']['summary']); ?></p>
	<p><?php echo $this->Markdown->parse($articleRevision['ArticleRevision']['content']); ?></p>
</div>