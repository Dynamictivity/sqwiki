<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('Add Comment')); ?>
<div class="comments form">
	<?php echo $this->Form->create('Comment'); ?>
		<fieldset>
			<legend><?php echo __('Add Comment'); ?></legend>
			<?php
				echo $this->Form->hidden('article_id', array('value' => $article['Article']['id']));
				echo $this->Form->input('comment');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>