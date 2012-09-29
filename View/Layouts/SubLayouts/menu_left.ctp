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
		<li class="strike"><?php echo $this->Html->link(__('Main Page'), array('controller' => 'users', 'action' => 'index', 'admin' => false, 'manage' => false)); ?> </li>
		<li class="strike"><?php echo $this->Html->link(__('Browse Categories'), array('controller' => 'users', 'action' => 'index', 'admin' => false, 'manage' => false)); ?> </li>
		<li class="strike"><?php echo $this->Html->link(__('Community Portal'), array('controller' => 'users', 'action' => 'index', 'admin' => false, 'manage' => false)); ?> </li>
		<li class="strike"><?php echo $this->Html->link(__('Recent Changes'), array('controller' => 'users', 'action' => 'index', 'admin' => false, 'manage' => false)); ?> </li>
		<li class="strike"><?php echo $this->Html->link(__('Support'), array('controller' => 'users', 'action' => 'index', 'admin' => false, 'manage' => false)); ?> </li>
	</ul>
	<?php if (AuthComponent::user('role_id') == 1) : ?>
		<h3><?php echo __('Administration'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Achievements'), array('controller' => 'achievements', 'action' => 'index', 'admin' => true, 'manage' => false)); ?> </li>
			<li><?php echo $this->Html->link(__('Articles'), array('controller' => 'articles', 'action' => 'index', 'admin' => true, 'manage' => false)); ?> </li>
			<li><?php echo $this->Html->link(__('Article Revisions'), array('controller' => 'article_revisions', 'action' => 'index', 'admin' => true, 'manage' => false)); ?> </li>
			<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index', 'admin' => true, 'manage' => false)); ?> </li>
		</ul>
	<?php endif; ?>
	<?php if (AuthComponent::user() && AuthComponent::user('role_id') < 3) : ?>
		<h3><?php echo __('Moderation'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Articles'), array('controller' => 'articles', 'action' => 'index', 'admin' => false, 'manage' => true)); ?> </li>
			<li><?php echo $this->Html->link(__('Article Revision Queue'), array('controller' => 'article_revisions', 'action' => 'review_queue', 'admin' => false, 'manage' => true)); ?> </li>
			<li><?php echo $this->Html->link(__('Recent Talk'), array('controller' => 'comments', 'action' => 'index', 'admin' => false, 'manage' => true, 'sort' => 'id', 'direction' => 'desc')); ?> </li>
		</ul>
	<?php endif; ?>
	<h3><?php echo __('Account'); ?></h3>
	<ul>
		<?php if (!AuthComponent::user()) : ?>
			<li><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login', 'admin' => false, 'manage' => false)); ?> </li>
			<li class="strike"><?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'register', 'admin' => false, 'manage' => false)); ?> </li>
		<?php else : ?>
			<li class="strike"><?php echo $this->Html->link(__('Account'), array('controller' => 'users', 'action' => 'edit', 'admin' => false, 'manage' => false)); ?> </li>
			<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'admin' => false, 'manage' => false)); ?> </li>
		<?php endif; ?>
	</ul>
	<?php if (Configure::read('Sqwiki.allow_user_theme_switching')) : ?>
		<p><?php echo $this->UiTheme->themeSelector(); ?></p>
	<?php endif; ?>
</div>