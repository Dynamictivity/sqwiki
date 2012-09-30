<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		switch (AuthComponent::user('role_id')) {
			default:
				$this->Auth->allow(array('register', 'login', 'logout', 'forgot', 'confirm'));
		}
	}

/**
 * profile method
 *
 * @throws NotFoundException
 * @return void
 */
	public function profile() {
		$id = AuthComponent::user('id');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
	}

/**
 * register method
 *
 * @return void
 */
	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if (($newUser = $this->User->saveNewUser($this->request->data, false))) {
				$this->Session->setFlash(__('Welcome to %s, please check your e-mail to confirm your account.', Configure::read('Sqwiki.title')));
				CakeSession::write('Auth', $newUser);
				$email = $this->SendGrid->sendEmail(
					array(
						'to' => array($newUser['User']['email'] => $newUser['User']['username']),
						'subject' => __('%s Account Registration', Configure::read('Sqwiki.title')),
						'category' => 'registration',
						'template' => 'registration',
						'mergeValues' => array(
							'%token%' => $newUser['User']['token'],
							'%appUrl%' => Configure::read('Sqwiki.url'),
							'%siteTitle%' => Configure::read('Sqwiki.title')
						)
					)
				);
				$this->redirect(array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
			} else {
				$this->Session->setFlash(__('Your account could not be registered. Please, try again.'));
			}
		}
	}

/**
 * forgot method
 *
 * @throws NotFoundException
 * @return void
 */
	public function forgot() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$user = $this->User->findByEmail($this->request->data['User']['email']);
			if (isset($user['User']['id'])) {
				$this->User->id = $user['User']['id'];
			}
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid email'));
			}
			// Generate new token
			$user['User']['token'] = String::uuid();
			if ($this->User->save($user)) {
				$email = $this->SendGrid->sendEmail(
					array(
						'to' => array($user['User']['email'] => $user['User']['username']),
						'subject' => __('%s Account Reset', Configure::read('Sqwiki.title')),
						'category' => 'account_reset',
						'template' => 'account_reset',
						'mergeValues' => array(
							'%token%' => $user['User']['token'],
							'%appUrl%' => Configure::read('Sqwiki.url'),
							'%siteTitle%' => Configure::read('Sqwiki.title')
						)
					)
				);
				$this->Session->setFlash(__('The account has been reset. Please check your e-mail.'));
				$this->redirect(array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
			} else {
				$this->Session->setFlash(__('The account could not be reset. Please contact support.'));
			}
		}
	}

/**
 * confirm method
 *
 * @throws NotFoundException
 * @param string $token
 * @return void
 */
	public function confirm($token = null) {
		if ((!$this->request->is('post') && !$this->request->is('put')) && (!$token || !($user = $this->User->findByToken($token)))) {
			throw new NotFoundException(__('Invalid token'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// Generate new token
			$this->request->data['User']['token'] = String::uuid();
			$this->request->data['User']['is_confirmed'] = true;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The account has been confirmed'));
				// Load the user into memory
				$user = $this->User->read();
				unset($user['User']['password']);
				CakeSession::write('Auth', $user);
				$this->redirect(array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
			} else {
				$this->Session->setFlash(__('The account could not be confirmed. Please try again.'));
			}
		}
		$this->request->data = $this->User->read(null, $user['User']['id']);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->redirect(array('action' => 'edit', $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->saveNewUser($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		/*
		$email = $this->SendGrid->sendEmail(
			array(
				'to' => array($user['User']['email'] => $user['User']['name']),
				'subject' => __('Orderbolt Account Registration'),
				'category' => 'registration',
				'template' => strtolower($accountType) . '_registration',
				'mergeValues' => array(
					'%token%' => $user['User']['token'],
					'%appUrl%' => Configure::read('Orderbolt.appUrl')
				)
			)
		);
		*/
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * login method
 *
 * @return void
 */
	public function login() {
		if (AuthComponent::user('id')) {
			$this->redirect(array('action' => 'view'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect.'), 'default', array(), 'auth');
			}
		}
	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		CakeSession::destroy();
		$this->redirect($this->Auth->logout());
	}
}