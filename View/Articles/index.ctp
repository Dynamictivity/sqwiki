<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Articles')); ?>
<div class="articles index">
    <h2><?php echo __('All Articles'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('updated'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
        foreach ($articles as $article): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($article['Article']['title'], array('action' => 'view', $article['Article']['id'])); ?>
                </td>
                <td>
                    <?php echo h($article['User']['username']); ?>
                </td>
                <td><?php echo $this->Time->timeAgoInWords($article['Article']['created']); ?>&nbsp;</td>
                <td><?php echo $this->Time->timeAgoInWords($article['Article']['updated']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('History'), array('action' => 'history', $article['Article']['id'])); ?>
                    <?php echo $this->Html->link(__('Talk'), array('action' => 'talk', $article['Article']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="right button"><?php echo $this->Html->link(__('New Article'), array('action' => 'add')); ?></div>
</div>
