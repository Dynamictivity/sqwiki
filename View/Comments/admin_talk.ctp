<?php $this->extend('/Layouts/SubLayouts/admin_article_toolbar'); ?>
<?php $this->assign('title', __('Article Talk')); ?>
<div class="comments index">
	<h2><?php echo __('Comments'); ?></h2>
		<?php
		foreach ($comments as $comment): ?>
			<div class="comment">
				<div class="comment-user-info">
					By <?php echo $this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?> <?php echo $this->Time->timeAgoInWords($comment['Comment']['created']); ?>
				</div>
				<div class="comment-body">
					<?php echo $this->Markdown->parse($comment['Comment']['comment']); ?>
				</div>
			</div>
		<?php endforeach; ?>
	<div class="right button"><?php echo $this->Html->link(__('New Comment'), array('action' => 'add', 'article_id' => $article['Article']['id'])); ?></div>
</div>