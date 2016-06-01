<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php if (!empty($article['Article']['id']) || !empty($this->request->params['slug'])) : ?>
    <div class="article-toolbar right">
        <?php if (AuthComponent::user() && AuthComponent::user('role_id') < 3 && (!empty($this->request->params['admin']) || !empty($this->request->params['manage']))) : ?>
            <?php echo $this->Html->link(__('Article'), array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('controller' => 'articles', 'action' => 'revise', $article['Article']['id']), array('class' => 'ui-state-highlight')); ?>
            <?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', $article['Article']['id'])); ?>
            <?php echo $this->Html->link(__('Talk'), array('controller' => 'articles', 'action' => 'talk', $article['Article']['id'])); ?>
            <?php if (AuthComponent::user('role_id') == 1) : ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'articles', 'action' => 'delete', $article['Article']['id'], 'admin' => true), array('class' => 'ui-state-error'), __('Are you sure you want to delete # %s?', $article['Article']['id'])); ?>
            <?php endif; ?>
        <?php else : ?>
            <?php echo $this->Html->link(__('Article'), array('controller' => 'articles', 'action' => 'view', 'slug' => $this->request->params['slug'])); ?>
            <?php echo $this->Html->link(__('Edit'), array('controller' => 'articles', 'action' => 'revise', 'slug' => $this->request->params['slug']), array('class' => 'ui-state-highlight')); ?>
            <?php echo $this->Html->link(__('History'), array('controller' => 'articles', 'action' => 'history', 'slug' => $this->request->params['slug'])); ?>
            <?php echo $this->Html->link(__('Talk'), array('controller' => 'articles', 'action' => 'talk', 'slug' => $this->request->params['slug'])); ?>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
<?php endif; ?>
<?php echo $this->fetch('content'); ?>
