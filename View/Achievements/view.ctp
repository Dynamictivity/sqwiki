<div class="achievements view">
<h2><?php  echo __('Achievement'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($achievement['Achievement']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($achievement['Achievement']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Field'); ?></dt>
		<dd>
			<?php echo h($achievement['Achievement']['user_field']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Field Count'); ?></dt>
		<dd>
			<?php echo h($achievement['Achievement']['user_field_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($achievement['Achievement']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($achievement['Achievement']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Achievement'), array('action' => 'edit', $achievement['Achievement']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Achievement'), array('action' => 'delete', $achievement['Achievement']['id']), null, __('Are you sure you want to delete # %s?', $achievement['Achievement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Achievements'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Achievement'), array('action' => 'add')); ?> </li>
	</ul>
</div>
