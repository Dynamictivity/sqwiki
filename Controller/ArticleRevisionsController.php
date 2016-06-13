<?php
App::uses('AppController', 'Controller');

/**
 * ArticleRevisions Controller
 *
 * @property ArticleRevision $ArticleRevision
 */
class ArticleRevisionsController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        switch (AuthComponent::user('role_id')) {
            case '2':
                $this->Auth->allow(array('manage_review_queue', 'manage_history', 'manage_view', 'manage_approve', 'manage_reject'));
            default:
                $this->Auth->allow(array('index', 'history', 'view'));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = array(
            'conditions' => array(
                'OR' => array(
                    'Article.role_id >=' => AuthComponent::user('role_id'),
                    'Article.role_id' => null
                )
            )
        );
        $this->ArticleRevision->recursive = 0;
        $this->set('articleRevisions', $this->paginate());
        $this->render('history');
    }

    /**
     * history method
     *
     * @return void
     */
    public function history()
    {
        $this->paginate = array(
            'conditions' => array(
                'OR' => array(
                    'Article.role_id >=' => AuthComponent::user('role_id'),
                    'Article.role_id' => null
                )
            )
        );
        if (!empty($this->request->params['slug'])) {
            $id = $this->ArticleRevision->Article->slugToId($this->request->params['slug']);
            $this->ArticleRevision->Article->id = $id;
            $this->paginate = array(
                'conditions' => array(
                    'article_id' => $id,
                    'OR' => array(
                        'Article.role_id >=' => AuthComponent::user('role_id'),
                        'Article.role_id' => null
                    )
                )
            );
            $this->ArticleRevision->Article->recursive = -1;
            $article = $this->ArticleRevision->Article->getCurrentVersion($id);
            $this->set(compact('article'));
        }
        if (!$this->ArticleRevision->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->ArticleRevision->recursive = 0;
        $this->set('articleRevisions', $this->paginate());
    }

    /**
     * view method
     * wrapper for admin_view
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!empty($this->request->params['id'])) {
            $this->ArticleRevision->id = $this->request->params['id'];
        } else {
            $this->ArticleRevision->id = $id;
        }
        if (!$this->ArticleRevision->exists()) {
            $this->redirect(array('action' => 'index'));
        }
        $articleRevision = $this->ArticleRevision->read(null, $id);
        $accessLevel = $articleRevision['Article']['role_id'];
        if (!empty($accessLevel) && (AuthComponent::user('role_id') > $accessLevel || AuthComponent::user('role_id') == NULL)) {
            throw new NotFoundException(__('Invalid article'));
        }
        $previousActiveRevision = $this->ArticleRevision->getPreviousApprovedRevision();
        $this->set(compact('articleRevision', 'previousActiveRevision'));
        $this->render('view');
    }

    /**
     * manage_review_queue method
     *
     * @return void
     */
    public function manage_review_queue()
    {
        $this->paginate = array(
            'conditions' => array(
                'ArticleRevision.reviewed_by_user_id' => NULL,
                'OR' => array(
                    'Article.role_id >=' => AuthComponent::user('role_id'),
                    'Article.role_id' => null
                )
            )
        );
        $this->ArticleRevision->recursive = 0;
        $this->set('articleRevisions', $this->paginate());
    }

    /**
     * manage_history method
     * wrapper for admin_history
     *
     * @return void
     */
    public function manage_history()
    {
        $this->history();
    }

    /**
     * manage_view method
     * wrapper for admin_view
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function manage_view($id = null)
    {
        $this->view($id);
    }

    /**
     * manage_approve method
     * wrapper for admin_approve
     *
     * @throws NotFoundException
     * @param string $id
     * @param bool $approve
     * @return void
     */
    public function manage_approve($id = null, $approve = true)
    {
        $this->admin_approve($id, $approve);
    }

    /**
     * manage_reject method
     * wrapper for admin_approve with reject flag
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function manage_reject($id = null)
    {
        $this->admin_approve($id, false);
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->index();
    }

    /**
     * admin_history method
     *
     * @return void
     */
    public function admin_history()
    {
        $this->history();
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->view($id);
    }

    /**
     * admin_approve method
     *
     * @throws NotFoundException
     * @param string $id
     * @param bool $approve
     * @return void
     */
    public function admin_approve($id = null, $approve = true)
    {
        $this->ArticleRevision->id = $id;
        if (!$this->ArticleRevision->exists()) {
            throw new NotFoundException(__('Invalid article revision'));
        }
        $createdByUserId = $this->ArticleRevision->field('user_id');
        if ($approve && $createdByUserId == AuthComponent::user('id') && AuthComponent::user('role_id') != 1) {
            $this->Flash->set(__('You can not approve your own revisions.'));
            $this->redirect(array('action' => 'view', ++$id, 'manage' => true));
        }
        $this->ArticleRevision->Article->id = $this->ArticleRevision->field('article_id');
        $accessLevel = $this->ArticleRevision->Article->field('role_id');
        if (!empty($accessLevel) && (AuthComponent::user('role_id') > $accessLevel || AuthComponent::user('role_id') == NULL)) {
            throw new NotFoundException(__('Invalid article'));
        }
        if ($this->ArticleRevision->approve($approve)) {
            $this->Flash->set(__('The article revision has been %s', ($approve ? __('approved') : __('rejected'))));
        } else {
            $this->Flash->set(__('The article revision has not been %s due to an error', ($approve ? __('approved') : __('rejected'))));
        }
        $this->redirect(array('action' => 'view', ++$id, 'manage' => true));
    }

    /**
     * admin_reject method
     * wrapper for admin_approve with reject flag
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_reject($id = null)
    {
        $this->admin_approve($id, false);
    }
}
