<?php
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 */
class AppController extends Controller
{
    public $components = array(
        'Session',
        'DebugKit.Toolbar',
        'Auth' => array(
            /*
                'authenticate' => array(
                    'all' => array(
                        'scope' => array('User.role_id <=' => 3)
                    )
                ),
            */
            'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin' => false, 'manage' => false),
            'logoutRedirect' => array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false),
            'loginRedirect' => array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false)
        ),
        'Paginator',
        'SendGrid',
        'Secure',
        'Security'
    );
    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Time',
        'Gravatar',
        'Markdown',
        'Diff',
        'UiTheme',
    );

    public function beforeFilter()
    {
        // Temporary for dev
//        $this->Auth->allow();
    }
}