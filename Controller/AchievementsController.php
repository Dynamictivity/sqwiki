<?php
App::uses('AppController', 'Controller');
/**
 * Achievements Controller
 *
 * @property Achievement $Achievement
 */
class AchievementsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Achievement->recursive = 0;
		$this->set('achievements', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Achievement->id = $id;
		if (!$this->Achievement->exists()) {
			throw new NotFoundException(__('Invalid achievement'));
		}
		$this->set('achievement', $this->Achievement->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Achievement->create();
			if ($this->Achievement->save($this->request->data)) {
				$this->Session->setFlash(__('The achievement has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The achievement could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Achievement->id = $id;
		if (!$this->Achievement->exists()) {
			throw new NotFoundException(__('Invalid achievement'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Achievement->save($this->request->data)) {
				$this->Session->setFlash(__('The achievement has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The achievement could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Achievement->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Achievement->id = $id;
		if (!$this->Achievement->exists()) {
			throw new NotFoundException(__('Invalid achievement'));
		}
		if ($this->Achievement->delete()) {
			$this->Session->setFlash(__('Achievement deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Achievement was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
