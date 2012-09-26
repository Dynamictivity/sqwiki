<?php $this->extend('/Layouts/SubLayouts/admin_article_toolbar'); ?>
<?php $this->assign('title', $article['Article']['title']); ?>
<div class="articleRevisions view">
	<p><?php echo h($article['ArticleRevision']['summary']); ?></p>
	<p><?php echo $this->Markdown->parse($article['ArticleRevision']['content']); ?></p>
</div>