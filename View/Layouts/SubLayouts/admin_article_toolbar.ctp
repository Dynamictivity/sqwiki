<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php if (!empty($article['Article']['id'])) : ?>
	<div class="article-toolbar right">
		<?php echo $this->Html->link(__('View'), array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?>
		<?php echo $this->Html->link(__('Revise'), array('controller' => 'articles', 'action' => 'revise', $article['Article']['id'])); ?>
		<?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', $article['Article']['id'])); ?>
		<?php echo $this->Html->link(__('Talk'), array('controller' => 'articles', 'action' => 'comments', $article['Article']['id'])); ?>
		<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'articles', 'action' => 'delete', $article['Article']['id']), array('class' => 'ui-state-error'), __('Are you sure you want to delete # %s?', $article['Article']['id'])); ?>
	</div>
	<div class="clear"></div>
<?php endif; ?>
<?php echo $this->fetch('content'); ?>