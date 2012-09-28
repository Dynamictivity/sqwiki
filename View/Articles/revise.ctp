<?php
	// Set this variable into the view for the toolbar
	$this->set('article', $this->request->data);
?>
<?php $this->extend('/Layouts/SubLayouts/article_toolbar'); ?>
<?php $this->assign('title', __('Revise Article')); ?>
<div class="articles form">
	<?php echo $this->Form->create('Article'); ?>
		<fieldset>
			<legend><?php echo $this->request->data['Article']['title']; ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('title');
				echo $this->Form->input('ArticleRevision.0.summary');
				echo $this->Form->input('ArticleRevision.0.content');
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>