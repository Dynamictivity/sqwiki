<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

/**
 * talk method
 *
 * @return void
 */
	public function talk() {
		if (!empty($this->request->params['slug'])) {
			$id = $this->Comment->Article->slugToId($this->request->params['slug']);
			$this->Comment->Article->id = $id;
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $id
				)
			);
		}
		if (!$this->Comment->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'talk', 'article_id' => $this->request->params['slug']));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->params['slug'])) {
			throw new NotFoundException(__('Invalid article'));
		}
		$article['Article']['id'] = $this->Comment->Article->slugToId($this->request->params['slug']);
		$this->Comment->Article->id = $article['Article']['id'];
		if (!$this->Comment->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->Set(compact('article'));
	}

/**
 * manage_talk method
 *
 * @return void
 */
	public function manage_talk() {
		$this->admin_talk();
	}

/**
 * manage_add method
 *
 * @return void
 */
	public function manage_add() {
		$this->admin_add();
	}

/**
 * manage_index method
 *
 * @return void
 */
	public function manage_index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * admin_talk method
 *
 * @return void
 */
	public function admin_talk() {
		if (!empty($this->request->params['named']['article_id'])) {
			$this->Comment->Article->id = $this->request->params['named']['article_id'];
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $this->request->params['named']['article_id']
				)
			);
			$article['Article']['id'] = $this->request->params['named']['article_id'];
			$this->Set(compact('article'));
		}
		if (!$this->Comment->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if (!empty($this->request->params['named']['article_id'])) {
			/*
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $this->request->params['named']['article_id']
				)
			);
			*/
			$article['Article']['id'] = $this->request->params['named']['article_id'];
			$this->Set(compact('article'));
		} else {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'talk', 'article_id' => $this->request->params['named']['article_id']));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		$this->Render('add');
	}
}
