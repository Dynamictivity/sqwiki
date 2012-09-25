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
	<h3><?php echo __('%s Navigation', Configure::read('Sqwiki.title')); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Main Page'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Browse Categories'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Community Portal'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Recent Changes'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Support'), array('controller' => 'users', 'action' => 'index')); ?> </li>
	</ul>
	<?php if (AuthComponent::user('role_id') == 1) : ?>
		<h3><?php echo __('Administration'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Article Revision Reviews'), array('controller' => 'article_revision_reviews', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Achievements'), array('controller' => 'achievements', 'action' => 'index')); ?> </li>
		</ul>
	<?php endif; ?>
	<?php if (AuthComponent::user('role_id') < 3) : ?>
		<h3><?php echo __('Moderation'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Article Revision Queue'), array('controller' => 'article_revisions', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Comment Queue'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		</ul>
	<?php endif; ?>
	<h3><?php echo __('Account'); ?></h3>
	<ul>
		<?php if (!AuthComponent::user()) : ?>
			<li><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')); ?> </li>
			<li><?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'register')); ?> </li>
		<?php else : ?>
			<li><?php echo $this->Html->link(__('Account'), array('controller' => 'users', 'action' => 'edit')); ?> </li>
			<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
		<?php endif; ?>
	</ul>
</div>