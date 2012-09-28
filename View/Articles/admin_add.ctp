<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('New Article')); ?>
<div class="articles form">
	<?php echo $this->Form->create('Article'); ?>
		<fieldset>
			<legend><?php echo __('Article Details'); ?></legend>
			<?php
				echo $this->Form->input('Article.title');
				echo $this->Form->input('ArticleRevision.0.summary');
				echo $this->Form->input('ArticleRevision.0.content');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>