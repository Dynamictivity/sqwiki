<?php $this->extend('/Layouts/SubLayouts/revision_toolbar'); ?>
<?php $this->assign('title', __('View Revision')); ?>
<div class="articleRevisions view">
	<h1><?php echo h($articleRevision['Article']['title']); ?></h1>
	<p><?php echo $this->Diff->showDiff($previousActiveRevision['ArticleRevision']['summary'], $articleRevision['ArticleRevision']['summary']); ?></p>
	<p><?php echo h($articleRevision['ArticleRevision']['summary']); ?></p>
	<hr />
	<p><?php echo $this->Diff->showDiff($previousActiveRevision['ArticleRevision']['content'], $articleRevision['ArticleRevision']['content']); ?></p>
	<p><?php echo $this->Markdown->parse($articleRevision['ArticleRevision']['content']); ?></p>
</div>