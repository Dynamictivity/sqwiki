	<div class="big_block">
	<?php echo $this->fetch('content'); ?>
	<div class="clear"></div>
	<?php
		if (!empty($this->Paginator)) {
			echo $this->element('pagination');
		}
	?>
</div>
<div class="actions">
	<h3><?php echo __('Wiki Navigation'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revision Reviews'), array('controller' => 'article_revision_reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Achievements'), array('controller' => 'achievements', 'action' => 'index')); ?> </li>
	</ul>
</div>