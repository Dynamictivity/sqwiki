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
		$this->set('articleRevision', $this->ArticleRevision->read(null, $id));
	}
}
