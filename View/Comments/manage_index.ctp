<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Recent Talk')); ?>
<div class="comments index">
    <h2><?php echo __('Comments'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('user_id'); ?></th>
            <th><?php echo $this->Paginator->sort('article_id'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
        foreach ($comments as $comment): ?>
            <tr>
                <td>
                    <?php echo h($comment['User']['username']); ?>
                </td>
                <td>
                    <?php echo $this->Html->link($comment['Article']['title'], array('controller' => 'articles', 'action' => 'view', $comment['Article']['id'])); ?>
                </td>
                <td><?php echo $this->Time->timeAgoInWords($comment['Comment']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Talk'), array('controller' => 'articles', 'action' => 'talk', $comment['Article']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
