<?php
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 */
class AppController extends Controller {
	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth'=> array(
			'authenticate' => array(
				'all' => array(
					'scope' => array('User.role_id <=' => 3)
				)
			),
			'loginAction' => array('controller' => 'users', 'action' => 'login'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'loginRedirect' => array('controller' => 'users', 'action' => 'view', 'admin' => false, 'manage' => false)
		),
		'Paginator',
		'SendGrid',
		//'Secure',
		//'Security'
	);
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Time',
		'Gravatar',
	);

	public function beforeFilter() {
		// Temporary for dev
		$this->Auth->allow('*');
	}
}