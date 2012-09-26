<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<div class="article-toolbar right">
	<?php echo $this->Html->link(__('View'), array('action' => 'view', $article['Article']['id'])); ?>
	<?php echo $this->Html->link(__('Revise'), array('action' => 'revise', $article['Article']['id'])); ?>
	<?php echo $this->Html->link(__('History'), array('action' => 'history', $article['Article']['id'])); ?>
	<?php echo $this->Html->link(__('Talk'), array('controller' => 'comments', 'action' => 'index', $article['Article']['id'])); ?>
	<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $article['Article']['id']), null, __('Are you sure you want to delete # %s?', $article['Article']['id'])); ?>
</div>
<div class="clear"></div>
<?php echo $this->fetch('content'); ?>