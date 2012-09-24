<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article Count'); ?></dt>
		<dd>
			<?php echo h($user['User']['article_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article Revision Count'); ?></dt>
		<dd>
			<?php echo h($user['User']['article_revision_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment Count'); ?></dt>
		<dd>
			<?php echo h($user['User']['comment_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article Revision Review Count'); ?></dt>
		<dd>
			<?php echo h($user['User']['article_revision_review_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($user['User']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revision Reviews'), array('controller' => 'article_revision_reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision Review'), array('controller' => 'article_revision_reviews', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article Revision'), array('controller' => 'article_revisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Article Revision Reviews'); ?></h3>
	<?php if (!empty($user['ArticleRevisionReview'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Article Revision Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['ArticleRevisionReview'] as $articleRevisionReview): ?>
		<tr>
			<td><?php echo $articleRevisionReview['id']; ?></td>
			<td><?php echo $articleRevisionReview['article_revision_id']; ?></td>
			<td><?php echo $articleRevisionReview['user_id']; ?></td>
			<td><?php echo $articleRevisionReview['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'article_revision_reviews', 'action' => 'view', $articleRevisionReview['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'article_revision_reviews', 'action' => 'edit', $articleRevisionReview['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'article_revision_reviews', 'action' => 'delete', $articleRevisionReview['id']), null, __('Are you sure you want to delete # %s?', $articleRevisionReview['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Article Revision Review'), array('controller' => 'article_revision_reviews', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Article Revisions'); ?></h3>
	<?php if (!empty($user['ArticleRevision'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Article Id'); ?></th>
		<th><?php echo __('Revision Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['ArticleRevision'] as $articleRevision): ?>
		<tr>
			<td><?php echo $articleRevision['id']; ?></td>
			<td><?php echo $articleRevision['article_id']; ?></td>
			<td><?php echo $articleRevision['revision_id']; ?></td>
			<td><?php echo $articleRevision['user_id']; ?></td>
			<td><?php echo $articleRevision['summary']; ?></td>
			<td><?php echo $articleRevision['content']; ?></td>
			<td><?php echo $articleRevision['created']; ?></td>
			<td><?php echo $articleRevision['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'article_revisions', 'action' => 'view', $articleRevision['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'article_revisions', 'action' => 'edit', $articleRevision['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'article_revisions', 'action' => 'delete', $articleRevision['id']), null, __('Are you sure you want to delete # %s?', $articleRevision['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Article Revision'), array('controller' => 'article_revisions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Articles'); ?></h3>
	<?php if (!empty($user['Article'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Article Revision Count'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Article'] as $article): ?>
		<tr>
			<td><?php echo $article['id']; ?></td>
			<td><?php echo $article['title']; ?></td>
			<td><?php echo $article['slug']; ?></td>
			<td><?php echo $article['user_id']; ?></td>
			<td><?php echo $article['article_revision_count']; ?></td>
			<td><?php echo $article['created']; ?></td>
			<td><?php echo $article['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'articles', 'action' => 'view', $article['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'articles', 'action' => 'edit', $article['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'articles', 'action' => 'delete', $article['id']), null, __('Are you sure you want to delete # %s?', $article['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($user['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Article Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id']; ?></td>
			<td><?php echo $comment['user_id']; ?></td>
			<td><?php echo $comment['article_id']; ?></td>
			<td><?php echo $comment['comment']; ?></td>
			<td><?php echo $comment['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
