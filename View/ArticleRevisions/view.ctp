<?php $this->extend('/Layouts/SubLayouts/revision_toolbar'); ?>
<?php $this->assign('title', __('View Revision')); ?>
<div class="articleRevisions view">
	<?php if (empty($previousActiveRevision['ArticleRevision'])) :?>
	    <div id="flashMessage" class="message">No previous article version</div>
	<?php endif; ?>
	<h1><?php echo h($articleRevision['Article']['title']); ?></h1>
	<?php if (!empty($previousActiveRevision['ArticleRevision'])) :?>
	    <p><?php echo $this->Diff->showDiff($previousActiveRevision['ArticleRevision']['summary'], $articleRevision['ArticleRevision']['summary']); ?></p>
	<?php endif; ?>
	<p><?php echo h($articleRevision['ArticleRevision']['summary']); ?></p>
	<hr />
	<?php if (!empty($previousActiveRevision['ArticleRevision'])) :?>
	    <p><?php echo $this->Diff->showDiff($previousActiveRevision['ArticleRevision']['content'], $articleRevision['ArticleRevision']['content']); ?></p>
	<?php endif; ?>
	<p><?php echo $this->Markdown->parse($articleRevision['ArticleRevision']['content']); ?></p>
</div>