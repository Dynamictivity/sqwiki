<?php
App::uses('AppController', 'Controller');

/**
 * Themes Controller
 *
 * @property Theme $Theme
 */
class ThemesController extends AppController
{

    /**
     * beforeFilter method
     *
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        switch (AuthComponent::user('role_id')) {
            default:
                $this->Auth->allow(array('*'));
        }
    }

    /**
     * set_theme method
     */
    public function set_theme()
    {
        if (empty($this->request->data['Theme']['selected'])) {
            throw new NotFoundException(__('Invalid theme'));
        }
        if (CakeSession::write('UiTheme.activeTheme', $this->request->data['Theme']['selected'])) {
            $this->Flash->set(__('The theme has been changed to %s', $this->request->data['Theme']['selected']));
            $this->redirect('/');
        }
    }
}
