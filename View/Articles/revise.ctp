<?php
// Set this variable into the view for the toolbar
$this->set('article', $this->request->data);
?>
<?php $this->extend('/Layouts/SubLayouts/article_toolbar'); ?>
<?php $this->assign('title', __('Revise Article')); ?>
<?php echo $this->Html->script(array(
    'simplemde.js',
), array('inline' => false, 'block' => 'simplemde')); ?>
<div class="articles form">
    <?php echo $this->Form->create('Article'); ?>
    <fieldset>
        <legend><?php echo $this->request->data['Article']['title']; ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('title');
        if (!empty($roles)) {
            echo $this->Form->input('role_id', array('label' => 'Access Level', 'empty' => 'Public'));
        }
        echo $this->Form->input('ArticleRevision.0.summary');
        echo $this->Form->input('ArticleRevision.0.content');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
