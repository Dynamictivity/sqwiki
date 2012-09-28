<?php
App::uses('AppController', 'Controller');
/**
 * ArticleRevisions Controller
 *
 * @property ArticleRevision $ArticleRevision
 */
class ArticleRevisionsController extends AppController {

/**
 * manage_review_queue method
 *
 * @return void
 */
	public function manage_review_queue() {
		$this->paginate = array(
			'conditions' => array(
				'ArticleRevision.reviewed_by_user_id' => NULL
			)
		);
		$this->ArticleRevision->recursive = 0;
		$this->set('articleRevisions', $this->paginate());
	}

/**
 * manage_history method
 *
 * @return void
 */
	public function manage_history() {
		$this->admin_history();
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
 * manage_approve method
 *
 * @throws NotFoundException
 * @param string $id
 * @param bool $approve
 * @return void
 */
	public function manage_approve($id = null, $approve = true) {
		$this->ArticleRevision->id = $id;
		if (!$this->ArticleRevision->exists()) {
			throw new NotFoundException(__('Invalid article revision'));
		}
		if ($this->ArticleRevision->approve($approve)) {
			$this->Session->setFlash(__('The article revision has been %s', ($approve ? __('approved') : __('rejected'))));
		} else {
			$this->Session->setFlash(__('The article revision has not been %s due to an error', ($approve ? __('approved') : __('rejected'))));
		}
		$this->redirect(array('action' => 'review_queue'));
	}

/**
 * manage_reject method
 * wrapper for manage_reject
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function manage_reject($id = null) {
		$this->manage_approve($id, false);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ArticleRevision->recursive = 0;
		$this->set('articleRevisions', $this->paginate());
		$this->render('admin_history');
	}

/**
 * admin_history method
 *
 * @return void
 */
	public function admin_history() {
		if (!empty($this->params['named']['article_id'])) {
			$this->ArticleRevision->Article->id = $this->params['named']['article_id'];
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $this->params['named']['article_id']
				)
			);
			$article['Article']['id'] = $this->params['named']['article_id'];
			$this->Set(compact('article'));
		}
		if (!$this->ArticleRevision->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->ArticleRevision->recursive = 0;
		$this->set('articleRevisions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->ArticleRevision->id = $id;
		if (!$this->ArticleRevision->exists()) {
			throw new NotFoundException(__('Invalid article revision'));
		}
		$articleRevision = $this->ArticleRevision->read(null, $id);
		$previousActiveRevision = $this->ArticleRevision->getPreviousActiveRevision();
		$this->set(compact('articleRevision', 'previousActiveRevision'));
		$this->render('view');
	}

/**
 * admin_approve method
 *
 * @throws NotFoundException
 * @param string $id
 * @param bool $approve
 * @return void
 */
	public function admin_approve($id = null, $approve = true) {
		$this->ArticleRevision->id = $id;
		if (!$this->ArticleRevision->exists()) {
			throw new NotFoundException(__('Invalid article revision'));
		}
		if ($this->ArticleRevision->approve($approve)) {
			$this->Session->setFlash(__('The article revision has been %s', ($approve ? __('approved') : __('rejected'))));
		} else {
			$this->Session->setFlash(__('The article revision has not been %s due to an error', ($approve ? __('approved') : __('rejected'))));
		}
		$this->redirect(array('controller' => 'articles', 'action' => 'view', $this->ArticleRevision->field('article_id')));
	}

/**
 * admin_reject method
 * wrapper for admin_approve with reject flag
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_reject($id = null) {
		$this->admin_approve($id, false);
	}
}
