<?php $this->extend('/Layouts/SubLayouts/article_toolbar'); ?>
<?php $this->assign('title', __('Article Revision Queue')); ?>
<div class="articleRevisions index">
    <?php if (empty($article)) : ?>
        <h2><?php echo __('Article Revisions'); ?></h2>
    <?php endif; ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('article_id'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
        foreach ($articleRevisions as $articleRevision): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($articleRevision['Article']['title'], array('controller' => 'articles', 'action' => 'view', $articleRevision['Article']['id'], 'manage' => false)); ?>
                </td>
                <td>
                    <?php echo h($articleRevision['User']['username']); ?>
                </td>
                <td><?php echo $this->Time->timeAgoInWords($articleRevision['ArticleRevision']['created']); ?>
                    &nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $articleRevision['ArticleRevision']['id'], 'manage' => false)); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
