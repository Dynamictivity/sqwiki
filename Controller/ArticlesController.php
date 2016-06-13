<?php
App::uses('AppController', 'Controller');

/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        switch (AuthComponent::user('role_id')) {
            case '2':
                $this->Auth->allow(array('manage_index', 'manage_view', 'manage_add', 'manage_revise', 'manage_history', 'manage_talk'));
            default:
                $this->Auth->allow(array('index', 'view', 'add', 'revise', 'history', 'talk'));
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
        $this->Article->recursive = 0;
        $this->set('articles', $this->paginate());
        if (AuthComponent::user('role_id') <= 2) {
            $this->render('admin_index');
        }
    }

    /**
     * view method
     *
     * @return void
     */
    public function view($id = null)
    {
        $slug = null;
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
            $id = $this->Article->slugToId($slug);
        }
        $this->Article->id = $id;
        $accessLevel = $this->Article->field('role_id');
        if (!empty($accessLevel) && (AuthComponent::user('role_id') > $accessLevel || AuthComponent::user('role_id') == NULL)) {
            throw new NotFoundException(__('Invalid article'));
        }
        if (!$this->Article->exists() || $this->request->is('post')) {
            $this->Flash->set(__('The article does not exist yet'));
            $this->add();
            $this->request->data['Article']['title'] = $slug;
            return $this->render('add');
        }
        $article = $this->Article->getCurrentVersion($id);
        if (!$article) {
            $this->Flash->set(__('The article has no active revisions'));
            $this->redirect(array('controller' => 'article_revisions', 'action' => 'index', 'slug' => $slug, 'sort' => 'id', 'direction' => 'desc'));
        }
        $this->set(compact('article'));
        $this->render('view');
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Article->create();
            if ($this->Article->saveAssociated($this->request->data)) {
                $this->Flash->set(__('The article has been saved'));
                $this->redirect(array('action' => 'view', $this->Article->id));
            } else {
                $this->Flash->set(__('The article could not be saved. Please, try again.'));
            }
        }
        if (AuthComponent::user('role_id') <= 2) {
            $roles = $this->Article->Role->find('list');
            $this->set(compact('roles'));
        }
        $this->render('add');
    }

    /**
     * revise method
     *
     * @param null $id
     * @throws Exception
     */
    public function revise($id = null)
    {
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
            $id = $this->Article->slugToId($slug);
        }
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        if (empty($this->request->params['slug'])) {
            $slug = $this->Article->field('slug');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Article->saveAssociated($this->request->data)) {
                $this->Flash->set(__('The article has been saved'));
                $this->redirect(array('action' => 'view', 'slug' => $slug, 'admin' => false, 'manage' => false));
            } else {
                $this->Flash->set(__('The article could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Article->getCurrentVersion($id, array('merge' => false));
        }
        if (AuthComponent::user('role_id') == 1) {
            $roles = $this->Article->Role->find('list');
            $this->set(compact('roles'));
        }
        $this->render('revise');
    }

    /**
     * history method
     *
     * @return void
     */
    public function history($id = null)
    {
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
            $id = $this->Article->slugToId($slug);
        }
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        if (empty($this->request->params['slug'])) {
            $slug = $this->Article->field('slug');
        }
        $this->redirect(array('controller' => 'article_revisions', 'action' => 'history', 'slug' => $slug, 'sort' => 'id', 'direction' => 'desc', 'admin' => false, 'manage' => false));
    }

    /**
     * talk method
     *
     * @param null $id
     */
    public function talk($id = null)
    {
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
            $id = $this->Article->slugToId($slug);
        }
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        if (empty($this->request->params['slug'])) {
            $slug = $this->Article->field('slug');
        }
        $this->redirect(array('controller' => 'comments', 'action' => 'talk', 'slug' => $slug, 'sort' => 'id', 'direction' => 'desc', 'admin' => false, 'manage' => false));
    }

    /**
     * manage_index method
     *
     * @return void
     */
    public function manage_index()
    {
        $this->index();
    }

    /**
     * manage_view method
     *
     * @param string $id
     * @return void
     */
    public function manage_view($id = null)
    {
        $this->view($id);
    }

    /**
     * manage_add method
     *
     * @return void
     */
    public function manage_add()
    {
        $this->add();
    }

    /**
     * manage_revise method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function manage_revise($id = null)
    {
        $this->revise($id);
    }

    /**
     * manage_history method
     *
     * @param string $id
     * @return void
     */
    public function manage_history($id = null)
    {
        $this->history($id);
    }

    /**
     * manage_talk method
     *
     * @param string $id
     * @return void
     */
    public function manage_talk($id = null)
    {
        $this->talk($id);
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
     * admin_view method
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->view($id);
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        $this->add();
    }

    /**
     * admin_revise method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_revise($id = null)
    {
        $this->revise($id);
    }

    /**
     * admin_history method
     *
     * @param string $id
     * @return void
     */
    public function admin_history($id = null)
    {
        $this->history($id);
    }

    /**
     * admin_talk method
     *
     * @param string $id
     * @return void
     */
    public function admin_talk($id = null)
    {
        $this->talk($id);
    }

    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        if ($this->Article->delete()) {
            $this->Flash->set(__('Article deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->set(__('Article was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
