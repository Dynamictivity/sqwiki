<div class="achievements form">
<?php echo $this->Form->create('Achievement'); ?>
	<fieldset>
		<legend><?php echo __('Add Achievement'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('user_field');
		echo $this->Form->input('user_field_count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Achievements'), array('action' => 'index')); ?></li>
	</ul>
</div>
