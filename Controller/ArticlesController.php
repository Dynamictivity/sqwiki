<?php
App::uses('AppController', 'Controller');
/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends AppController {

/**
 * manage_index method
 *
 * @return void
 */
	public function manage_index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate());
	}

/**
 * manage_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function manage_view($id = null) {
		$this->admin_view($id);
	}

/**
 * manage_revise method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function manage_revise($id = null) {
		$this->admin_revise($id);
	}

/**
 * manage_history method
 *
 * @param string $id
 * @return void
 */
	public function manage_history($id = null) {
		$this->admin_history($id);
	}

/**
 * manage_talk method
 *
 * @param string $id
 * @return void
 */
	public function manage_talk($id = null) {
		$this->admin_talk($id);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists() || $this->request->is('post')) {
			$this->Session->setFlash(__('The article does not exist yet'));
			$this->admin_add();
			return $this->render('admin_add');
		}
		$article = $this->Article->getCurrentVersion($id);
		if (!$article) {
			$this->Session->setFlash(__('The article has no active revisions'));
			$this->redirect(array('controller' => 'article_revisions', 'action' => 'index', 'article_id' => $id, 'sort' => 'id', 'direction' => 'desc'));
		}
		$this->set(compact('article'));
		$this->render('view');
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Article->create();
			if ($this->Article->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved'));
				$this->redirect(array('action' => 'view', $this->Article->id));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
			}
		}
		$this->render('add');
	}

/**
 * admin_revise method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_revise($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Article->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved'));
				$this->redirect(array('action' => 'view', $this->Article->id));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Article->getCurrentVersion($id, array('merge' => false));
		}
		$this->render('revise');
	}

/**
 * admin_history method
 *
 * @param string $id
 * @return void
 */
	public function admin_history($id = null) {
		$this->redirect(array('controller' => 'article_revisions', 'action' => 'history', 'article_id' => $id, 'sort' => 'id', 'direction' => 'desc'));
	}

/**
 * admin_comments method
 *
 * @param string $id
 * @return void
 */
	public function admin_talk($id = null) {
		$this->redirect(array('controller' => 'comments', 'action' => 'talk', 'article_id' => $id, 'sort' => 'id', 'direction' => 'desc'));
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
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('Article deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Article was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
