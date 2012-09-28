<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * admin_talk method
 *
 * @return void
 */
	public function admin_talk() {
		if (!empty($this->params['named']['article_id'])) {
			$this->Comment->Article->id = $this->params['named']['article_id'];
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $this->params['named']['article_id']
				)
			);
			$article['Article']['id'] = $this->params['named']['article_id'];
			$this->Set(compact('article'));
		}
		if (!$this->Comment->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if (!empty($this->params['named']['article_id'])) {
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $this->params['named']['article_id']
				)
			);
			$article['Article']['id'] = $this->params['named']['article_id'];
			$this->Set(compact('article'));
		} else {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'talk', 'article_id' => $this->params['named']['article_id']));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
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
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('Comment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Comment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
