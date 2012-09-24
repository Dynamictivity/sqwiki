<?php if ($this->Paginator->hasPage(null, 2)) : ?>
	<div class="paging">
		<div class="right">
			<?php echo $this->Paginator->prev('&larr; ' . __('Previous'), array('escape' => false), null, array('escape' => false)); ?>
					<?php echo $this->Paginator->numbers(array('separator' => ', ')); ?>
			<?php echo $this->Paginator->next(__('Next') . ' &rarr;', array('escape' => false), null, array('escape' => false)); ?>
		</div>
		<div class="right">
			<?php echo $this->Paginator->counter(array(
				'format' => __('Showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			)); ?>
		</div>
	</div>
	<div class="clear"></div>
<?php endif; ?>