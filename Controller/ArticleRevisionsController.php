<?php
App::uses('AppController', 'Controller');
/**
 * ArticleRevisions Controller
 *
 * @property ArticleRevision $ArticleRevision
 */
class ArticleRevisionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ArticleRevision->recursive = 0;
		$this->set('articleRevisions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ArticleRevision->id = $id;
		if (!$this->ArticleRevision->exists()) {
			throw new NotFoundException(__('Invalid article revision'));
		}
		$this->set('articleRevision', $this->ArticleRevision->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArticleRevision->create();
			if ($this->ArticleRevision->save($this->request->data)) {
				$this->Session->setFlash(__('The article revision has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article revision could not be saved. Please, try again.'));
			}
		}
		$articles = $this->ArticleRevision->Article->find('list');
		$users = $this->ArticleRevision->User->find('list');
		$this->set(compact('articles', 'users'));
	}
}
