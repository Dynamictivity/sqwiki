<?php
App::uses('AppController', 'Controller');
/**
 * Themes Controller
 *
 * @property Theme $Theme
 */
class ThemesController extends AppController {

	public function set_theme() {
		if (empty($this->request->data['Theme']['selected'])) {
			throw new NotFoundException(__('Invalid theme'));
		}
		if (CakeSession::write('UiTheme.activeTheme', $this->request->data['Theme']['selected'])) {
			$this->Session->setFlash(__('The theme has been changed to %s', $this->request->data['Theme']['selected']));
			$this->redirect('/');
		}
	}

	public function manage_set_theme() {
		$this->set_theme();
	}

	public function admin_set_theme() {
		$this->set_theme();
	}
}
