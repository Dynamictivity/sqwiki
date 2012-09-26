<?php $this->extend('/Layouts/SubLayouts/admin_article_toolbar'); ?>
<?php $this->assign('title', $article['Article']['title']); ?>
<div class="articles form">
	<?php echo $this->Form->create('Article'); ?>
		<fieldset>
			<legend><?php echo __('Revise Article'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('title');
				echo $this->Form->input('ArticleRevision.0.summary');
				echo $this->Form->input('ArticleRevision.0.content');
				echo $this->Form->hidden('ArticleRevision.0.is_active', array('value' => 1));
			?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>