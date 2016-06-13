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
        <li><?php echo $this->Html->link(__('Main Page'), array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false)); ?> </li>
        <li><?php echo $this->Html->link(__('Community Portal'), array('controller' => 'articles', 'action' => 'view', 'slug' => 'Portal', 'admin' => false, 'manage' => false)); ?> </li>
        <li><?php echo $this->Html->link(__('Recent Changes'), array('controller' => 'article_revisions', 'action' => 'index', 'sort' => 'id', 'direction' => 'desc', 'admin' => false, 'manage' => false)); ?> </li>
        <li><?php echo $this->Html->link(__('All Articles'), array('controller' => 'articles', 'action' => 'index', 'sort' => 'title', 'direction' => 'asc', 'admin' => false, 'manage' => false)); ?> </li>
        <li><?php echo $this->Html->link(__('Support'), array('controller' => 'articles', 'action' => 'view', 'slug' => 'Support', 'admin' => false, 'manage' => false)); ?> </li>
    </ul>
    <?php if (AuthComponent::user('role_id') == 1) : ?>
        <h3><?php echo __('Administration'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index', 'admin' => true, 'manage' => false)); ?> </li>
        </ul>
    <?php endif; ?>
    <?php if (AuthComponent::user() && AuthComponent::user('role_id') < 3) : ?>
        <h3><?php echo __('Moderation'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('Article Revision Queue'), array('controller' => 'article_revisions', 'action' => 'review_queue', 'admin' => false, 'manage' => true)); ?> </li>
            <li><?php echo $this->Html->link(__('Recent Talk'), array('controller' => 'comments', 'action' => 'index', 'admin' => false, 'manage' => true, 'sort' => 'id', 'direction' => 'desc')); ?> </li>
        </ul>
    <?php endif; ?>
    <h3><?php echo __('Account'); ?></h3>
    <ul>
        <?php if (!AuthComponent::user()) : ?>
            <li><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login', 'admin' => false, 'manage' => false)); ?> </li>
            <?php if (Configure::read('Sqwiki.enable_account_registration') == 'true') : ?>
                <li><?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'register', 'admin' => false, 'manage' => false)); ?> </li>
            <?php endif; ?>
        <?php else : ?>
            <li><?php echo $this->Html->link(__('Account'), array('controller' => 'users', 'action' => 'profile', 'admin' => false, 'manage' => false)); ?> </li>
            <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'admin' => false, 'manage' => false)); ?> </li>
        <?php endif; ?>
    </ul>
    <?php if (Configure::read('Sqwiki.allow_user_theme_switching') == 'true' && AuthComponent::user()) : ?>
        <p><?php echo $this->UiTheme->themeSelector(); ?></p>
    <?php endif; ?>
</div>
