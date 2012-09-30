<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo Configure::read('Sqwiki.title'); ?>: <?php echo Configure::read('Sqwiki.slogan'); ?>: 
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			if (!CakeSession::check('UiTheme.activeTheme')) {
				CakeSession::write('UiTheme.activeTheme', Configure::read('Sqwiki.default_theme'));
			}
			//echo $this->Html->meta('icon');
			echo $this->Html->css(array(
				'jqueryui/' . CakeSession::read('UiTheme.activeTheme') . '/style',
				'../js/markitup/skins/markitup/style',
				'../js/markitup/sets/markdown/style',
				'php-diff/style',
				'sqwiki',
			), null, array('inline' => false));
			echo $this->Html->script(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js',
				'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js',
				'markitup/jquery.markitup',
				'markitup/sets/markdown/set',
				'sqwiki',
			), array('inline' => false));
			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><?php echo Configure::read('Sqwiki.title'); ?>: <?php echo Configure::read('Sqwiki.slogan'); ?>: <?php echo $this->fetch('title'); ?></h1>
			</div>
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer">
				<?php echo $this->Html->link(
						'Powered By Sqwiki',
						'http://sqwiki.dynamictivity.com',
						array('target' => '_blank')
					);
				?>
			</div>
		</div>
		<?php echo $this->fetch('script'); ?>
		<?php echo $this->element('analytics'); ?>
	</body>
</html>