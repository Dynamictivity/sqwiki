<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('View Achievement')); ?>
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