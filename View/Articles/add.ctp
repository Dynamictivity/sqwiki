<?php $this->extend('/Layouts/SubLayouts/menu_left'); ?>
<?php $this->assign('title', __('New Article')); ?>
<?php echo $this->Html->script(array(
    'simplemde.js',
), array('inline' => false, 'block' => 'simplemde')); ?>
<div class="articles form">
    <?php // TODO: http://stackoverflow.com/questions/22148080/an-invalid-form-control-with-name-is-not-focusable ?>
    <?php echo $this->Form->create('Article', array('name' => 'foo', 'novalidate')); ?>
    <fieldset>
        <legend><?php echo __('Article Details'); ?></legend>
        <?php
        echo $this->Form->input('Article.title');
        if (!empty($roles)) {
            echo $this->Form->input('role_id', array('label' => 'Access Level', 'empty' => 'Public'));
        }
        echo $this->Form->input('ArticleRevision.0.summary');
        echo $this->Form->input('ArticleRevision.0.content');
        ?>
    </fieldset>
    <pre>
        <strong>Key:</strong></br>
        ##Sources## -- This will start the `sources` section of the page.
        [[Main]] -- Create an internal link to the `Main` article
    </pre>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
