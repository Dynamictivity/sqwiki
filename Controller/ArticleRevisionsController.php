<?php
App::uses('AppController', 'Controller');
/**
 * ArticleRevisions Controller
 *
 * @property ArticleRevision $ArticleRevision
 */
class ArticleRevisionsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		if (!empty($this->params['named']['article_id'])) {
			$this->paginate = array(
				'conditions' => array(
					'article_id' => $this->params['named']['article_id']
				)
			);
			$article['Article']['id'] = $this->params['named']['article_id'];
			$this->Set(compact('article'));
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
	}

/**
 * admin_approve method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_approve($id = null) {
		$this->ArticleRevision->id = $id;
		if (!$this->ArticleRevision->exists()) {
			throw new NotFoundException(__('Invalid article revision'));
		}
		if ($this->ArticleRevision->approve()) {
			$this->Session->setFlash(__('The article revision has been approved'));
		} else {
			$this->Session->setFlash(__('The article revision has not been approved due to an error'));
		}
		$articleId = $this->ArticleRevision->field('article_id');
		$this->redirect(array('controller' => 'articles', 'action' => 'view', $articleId));
	}

/**
 * admin_reject method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_reject($id = null) {
		$this->ArticleRevision->id = $id;
		if (!$this->ArticleRevision->exists()) {
			throw new NotFoundException(__('Invalid article revision'));
		}
		if ($this->ArticleRevision->approve(false)) {
			$this->Session->setFlash(__('The article revision has been rejected'));
		} else {
			$this->Session->setFlash(__('The article revision has not been rejected due to an error'));
		}
		$articleId = $this->ArticleRevision->field('article_id');
		$this->redirect(array('controller' => 'articles', 'action' => 'view', $articleId));
	}
}
