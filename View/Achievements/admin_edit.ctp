<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Edit Achievement')); ?>
<div class="achievements form">
	<?php echo $this->Form->create('Achievement'); ?>
		<fieldset>
			<legend><?php echo __('Edit Achievement'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name');
				echo $this->Form->input('user_field');
				echo $this->Form->input('user_field_count');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>