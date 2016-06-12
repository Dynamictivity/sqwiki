<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Users')); ?>
<div class="users index">
    <h2><?php echo __('All Users'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('username'); ?></th>
            <th><?php echo $this->Paginator->sort('email'); ?></th>
            <th><?php echo $this->Paginator->sort('role_id'); ?></th>
            <th><?php echo $this->Paginator->sort('article_count'); ?></th>
            <th><?php echo $this->Paginator->sort('article_revision_count'); ?></th>
            <th><?php echo $this->Paginator->sort('comment_count'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('updated'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
        foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                <td>
                    <?php echo h($user['Role']['name']); ?>
                </td>
                <td><?php echo h($user['User']['article_count']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['article_revision_count']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['comment_count']); ?>&nbsp;</td>
                <td><?php echo $this->Time->timeAgoInWords($user['User']['created']); ?>&nbsp;</td>
                <td><?php echo $this->Time->timeAgoInWords($user['User']['updated']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['User']['id'], 'admin' => true), array('class' => 'ui-state-error'), __('Are you sure you want to delete # %s?', $user['User']['username'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="right button"><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></div>
</div>
