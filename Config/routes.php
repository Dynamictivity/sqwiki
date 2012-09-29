<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connectNamed(array('slug'));
	Router::connect('/', array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Sqwiki routes
 */
	Router::connect('/:slug', array('controller' => 'articles', 'action' => 'view'), array('persist' => array('slug')));
	Router::connect('/:slug/revision/add', array('controller' => 'articles', 'action' => 'revise'), array('persist' => array('slug')));
	Router::connect('/:slug/revision/view/:id', array('controller' => 'article_revisions', 'action' => 'view'), array('persist' => array('slug')));
	//Router::connect('/:slug/revision/activate/:id', array('controller' => 'article_revisions', 'action' => 'activate'), array('persist' => array('slug')));
	//Router::connect('/:slug/revision/deactivate/:id', array('controller' => 'article_revisions', 'action' => 'deactivate'), array('persist' => array('slug')));
	Router::connect('/:slug/history', array('controller' => 'articles', 'action' => 'history'), array('persist' => array('slug')));
	Router::connect('/:slug/history/*', array('controller' => 'article_revisions', 'action' => 'history'), array('persist' => array('slug')));
	Router::connect('/:slug/talk', array('controller' => 'articles', 'action' => 'talk'), array('persist' => array('slug')));
	Router::connect('/:slug/talk/add', array('controller' => 'comments', 'action' => 'add'), array('persist' => array('slug')));
	Router::connect('/:slug/talk/*', array('controller' => 'comments', 'action' => 'talk'), array('persist' => array('slug')));

/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
