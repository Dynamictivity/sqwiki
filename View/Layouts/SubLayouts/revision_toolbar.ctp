<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
    <div class="article-toolbar right">
        <?php if (AuthComponent::user() && AuthComponent::user('role_id') < 3) : ?>
            <?php echo $this->Html->link(__('Article'), array('controller' => 'articles', 'action' => 'view', $articleRevision['Article']['id'])); ?>
            <?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', $articleRevision['Article']['id'])); ?>
            <?php if (empty($articleRevision['ReviewedByUser']['id'])) : ?>
                <?php echo $this->Html->link(__('Approve'), array('action' => 'approve', $articleRevision['ArticleRevision']['id'], 'manage' => true), array('class' => 'ui-state-highlight')); ?>
                <?php echo $this->Html->link(__('Reject'), array('action' => 'reject', $articleRevision['ArticleRevision']['id'], 'manage' => true), array('class' => 'ui-state-error')); ?>
            <?php elseif (!$articleRevision['ArticleRevision']['is_active']) : ?>
                <?php echo $this->Html->link(__('Approve'), array('action' => 'approve', $articleRevision['ArticleRevision']['id'], 'manage' => true), array('class' => 'ui-state-highlight')); ?>
            <?php else : ?>
                <?php echo $this->Html->link(__('Reject'), array('action' => 'reject', $articleRevision['ArticleRevision']['id'], 'manage' => true), array('class' => 'ui-state-error')); ?>
            <?php endif; ?>
        <?php else : ?>
            <?php echo $this->Html->link(__('Article'), array('controller' => 'articles', 'action' => 'view', 'slug' => $articleRevision['Article']['slug'])); ?>
            <?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', 'slug' => $articleRevision['Article']['slug'])); ?>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
<?php echo $this->fetch('content'); ?>
