<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php if (!empty($article['Article']['id']) || !empty($this->request->params['slug'])) : ?>
    <div class="article-toolbar right">
        <?php if (!empty($article['Article']['role_id'])): ?><span class="protected">[Protected]</span><?php endif; ?>
        <?php echo $this->Html->link(__('Article'), array('controller' => 'articles', 'action' => 'view', 'slug' => $article['Article']['slug'])); ?>
        <?php echo $this->Html->link(__('Edit'), array('controller' => 'articles', 'action' => 'revise', 'slug' => $article['Article']['slug']), array('class' => 'ui-state-highlight')); ?>
        <?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', 'slug' => $article['Article']['slug'])); ?>
        <?php echo $this->Html->link(__('Talk'), array('controller' => 'articles', 'action' => 'talk', 'slug' => $article['Article']['slug'])); ?>
        <?php if (AuthComponent::user('role_id') == 1) : ?>
            <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'articles', 'action' => 'delete', $article['Article']['id'], 'admin' => true), array('class' => 'ui-state-error'), __('Are you sure you want to delete %s?', $article['Article']['title'])); ?>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
<?php endif; ?>
<?php echo $this->fetch('content'); ?>
