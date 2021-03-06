<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController
{

    public function beforeFilter()
    {
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
    public function profile()
    {
        $id = AuthComponent::user('id');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(__('The user has been saved'));
            } else {
                $this->Flash->set(__('The user could not be saved. Please, try again.'));
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
    public function register()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if (($newUser = $this->User->saveNewUser($this->request->data, false))) {
                $this->Flash->set(__('Welcome to %s, please check your e-mail to confirm your account.', Configure::read('Sqwiki.title')));
                //CakeSession::write('Auth', $newUser);
                $sentMail = $this->SendEMail->sendEmail(
                    array(
                        'to' => array($newUser['User']['email'] => $newUser['User']['username']),
                        'subject' => __('%s Account Registration', Configure::read('Sqwiki.title')),
                        'template' => 'registration',
                        'viewVars' => array(
                            'name' => $newUser['User']['username'],
                            'token' => $newUser['User']['token'],
                            'appUrl' => Configure::read('Sqwiki.url'),
                            'siteTitle' => Configure::read('Sqwiki.title')
                        )
                    )
                );
                if (!$sentMail) {
                    $this->Flash->set(__('Your account could not be registered. Please contact support.'));
                }
                $this->redirect(array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
            } else {
                $this->Flash->set(__('Your account could not be registered. Please contact support.'));
            }
        }
    }

    /**
     * forgot method
     *
     * @throws NotFoundException
     * @return void
     */
    public function forgot()
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if (isset($user['User']['id'])) {
                $this->User->id = $user['User']['id'];
            }
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid email'));
            }
            // Generate new token
            $user['User']['token'] = CakeText::uuid();
            if ($this->User->save($user)) {
                $this->Flash->set(__('The account has been reset. Please check your e-mail.'));
                $sentMail = $this->SendEMail->sendEmail(
                    array(
                        'to' => array($user['User']['email'] => $user['User']['username']),
                        'subject' => __('%s Account Reset', Configure::read('Sqwiki.title')),
                        'template' => 'account_reset',
                        'viewVars' => array(
                            'name' => $user['User']['username'],
                            'token' => $user['User']['token'],
                            'appUrl' => Configure::read('Sqwiki.url'),
                            'siteTitle' => Configure::read('Sqwiki.title')
                        )
                    )
                );
                if (!$sentMail) {
                    $this->Flash->set(__('The account could not be reset. Please contact support.'));
                }
                $this->redirect(array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
            } else {
                $this->Flash->set(__('The account could not be reset. Please contact support.'));
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
    public function confirm($token = null)
    {
        if (!$token || (!$user = $this->User->findByToken($token))) {
            throw new NotFoundException(__('Invalid token'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            // Generate new token
            $this->request->data['User']['id'] = $user['User']['id'];
            $this->request->data['User']['token'] = null;
            $this->request->data['User']['is_confirmed'] = true;
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(__('The account has been confirmed'));
                // Load the user into memory
                $user = $this->User->read();
                unset($user['User']['password']);
                CakeSession::write('Auth', $user);
                $this->redirect(array('controller' => 'articles', 'action' => 'view', 'slug' => 'Main', 'admin' => false, 'manage' => false));
            } else {
                $this->Flash->set(__('The account could not be confirmed. Please try again.'));
            }
        }
        $this->request->data = $this->User->read(null, $user['User']['id']);
    }

    /**
     * login method
     *
     * @return void
     */
    public function login()
    {
        if (AuthComponent::user('id')) {
            $this->redirect(array('action' => 'view'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->set(__('Username or password is incorrect.'));
            }
        }
    }

    /**
     * logout method
     *
     * @return void
     */
    public function logout()
    {
        CakeSession::destroy();
        $this->redirect($this->Auth->logout());
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
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
    public function admin_view($id = null)
    {
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
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->saveNewUser($this->request->data)) {
                $this->Flash->set(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The user could not be saved. Please, try again.'));
            }
        }
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
    public function admin_edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->set(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->set(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
