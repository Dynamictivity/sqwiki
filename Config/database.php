<?php
class DATABASE_CONFIG {

	// dev
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'n7rk5sbi',
		'database' => 'sqwiki_dev',
	);

	public $production = array(
		'datasource' => 'Database/Mysql',
		'persistent' => true,
		'host' => '',
		'login' => '',
		'password' => '',
		'database' => '',
	);
}
