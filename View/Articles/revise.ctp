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
        if (AuthComponent::user('role_id') === '1') {
            echo $this->Form->input('slug');
        }
        if (!empty($roles)) {
            echo $this->Form->input('role_id', array('label' => 'Access Level', 'empty' => 'Public'));
        }
        echo $this->Form->input('ArticleRevision.0.summary');
        echo $this->Form->input('ArticleRevision.0.content');
        ?>
    </fieldset>
    <pre>
        <strong>Key:</strong></br>
        ##Sources## -- This will start the `sources` section of the page.<br />
        [[Main]] -- Create an internal link to the `Main` article
    </pre>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
