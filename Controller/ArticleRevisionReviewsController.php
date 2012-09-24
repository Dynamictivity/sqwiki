<?php
App::uses('AppController', 'Controller');
/**
 * ArticleRevisionReviews Controller
 *
 * @property ArticleRevisionReview $ArticleRevisionReview
 */
class ArticleRevisionReviewsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ArticleRevisionReview->recursive = 0;
		$this->set('articleRevisionReviews', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ArticleRevisionReview->id = $id;
		if (!$this->ArticleRevisionReview->exists()) {
			throw new NotFoundException(__('Invalid article revision review'));
		}
		$this->set('articleRevisionReview', $this->ArticleRevisionReview->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArticleRevisionReview->create();
			if ($this->ArticleRevisionReview->save($this->request->data)) {
				$this->Session->setFlash(__('The article revision review has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article revision review could not be saved. Please, try again.'));
			}
		}
		$articleRevisions = $this->ArticleRevisionReview->ArticleRevision->find('list');
		$users = $this->ArticleRevisionReview->User->find('list');
		$this->set(compact('articleRevisions', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ArticleRevisionReview->id = $id;
		if (!$this->ArticleRevisionReview->exists()) {
			throw new NotFoundException(__('Invalid article revision review'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ArticleRevisionReview->save($this->request->data)) {
				$this->Session->setFlash(__('The article revision review has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article revision review could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ArticleRevisionReview->read(null, $id);
		}
		$articleRevisions = $this->ArticleRevisionReview->ArticleRevision->find('list');
		$users = $this->ArticleRevisionReview->User->find('list');
		$this->set(compact('articleRevisions', 'users'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ArticleRevisionReview->id = $id;
		if (!$this->ArticleRevisionReview->exists()) {
			throw new NotFoundException(__('Invalid article revision review'));
		}
		if ($this->ArticleRevisionReview->delete()) {
			$this->Session->setFlash(__('Article revision review deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Article revision review was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
