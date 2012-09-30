<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title><?php echo $title_for_layout; ?></title>
	</head>
	<body style="background-color: #FFF; color: #000; padding: 25px;">
		<p>
			<?php echo $content_for_layout; ?>
		</p>
		<p>
			_______________________________________________________
		</p>
		<p>
			Regards,
			<br />
			The <?php Configure::read('Sqwiki.title'); ?> team
		</p>
		<p>
			This email was sent from <a href="<?php Configure::read('Sqwiki.url'); ?>" style="color: #000;"><?php Configure::read('Sqwiki.url'); ?></a>
		</p>
	</body>
</html>