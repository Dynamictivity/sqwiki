<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Achievements Index')); ?>
<div class="achievements index">
	<h2><?php echo __('Achievements'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('user_field'); ?></th>
			<th><?php echo $this->Paginator->sort('user_field_count'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		foreach ($achievements as $achievement): ?>
			<tr>
				<td><?php echo h($achievement['Achievement']['id']); ?>&nbsp;</td>
				<td><?php echo h($achievement['Achievement']['name']); ?>&nbsp;</td>
				<td><?php echo h($achievement['Achievement']['user_field']); ?>&nbsp;</td>
				<td><?php echo h($achievement['Achievement']['user_field_count']); ?>&nbsp;</td>
				<td><?php echo h($achievement['Achievement']['created']); ?>&nbsp;</td>
				<td><?php echo h($achievement['Achievement']['updated']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $achievement['Achievement']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $achievement['Achievement']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $achievement['Achievement']['id']), null, __('Are you sure you want to delete # %s?', $achievement['Achievement']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div class="right button"><?php echo $this->Html->link(__('New Achievement'), array('action' => 'add')); ?></div>
</div>