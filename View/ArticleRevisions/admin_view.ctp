<?php $this->extend('/Layouts/SubLayouts/admin_revision_toolbar'); ?>
<?php $this->assign('title', $articleRevision['Article']['title']); ?>
<div class="articleRevisions view">
	<p><?php echo h($articleRevision['ArticleRevision']['summary']); ?></p>
	<p><?php echo $this->Markdown->parse($articleRevision['ArticleRevision']['content']); ?></p>
</div>