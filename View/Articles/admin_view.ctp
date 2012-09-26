<?php $this->extend('/Layouts/SubLayouts/admin_article_toolbar'); ?>
<?php $this->assign('title', __('View Article')); ?>
<div class="articleRevisions view">
	<h1><?php echo h($article['Article']['title']); ?></h1>
	<p><?php echo h($article['ArticleRevision']['summary']); ?></p>
	<p><?php echo $this->Markdown->parse($article['ArticleRevision']['content']); ?></p>
</div>