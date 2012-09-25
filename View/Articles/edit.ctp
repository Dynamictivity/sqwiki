<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Edit Article')); ?>
<div class="articles form">
	<?php echo $this->Form->create('Article'); ?>
		<fieldset>
			<legend><?php echo __('Edit Article'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('title');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>