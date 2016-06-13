<?php
App::uses('AppController', 'Controller');

/**
 * Articles Controller
 *
 * @property Article $Article
 * @property array paginate
 */
class ArticlesController extends AppController
{

    /**
     * beforeFilter method
     *
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        switch (AuthComponent::user('role_id')) {
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
            $this->render('manage_index');
        }
    }

    /**
     * view method
     *
     * @param null $id
     * @return CakeResponse
     */
    public function view($id = null)
    {
        $slug = null;
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
            $id = @$this->Article->slugToId($slug);
        }
        $this->Article->id = $id;
        if (!$this->Article->exists() || $this->request->is('post')) {
            $this->Flash->set(__('The article does not exist yet'));
            $this->redirect(array('action' => 'add', 'slug' => $slug));
        }
        $accessLevel = $this->Article->field('role_id');
        if (!empty($accessLevel) && (AuthComponent::user('role_id') > $accessLevel || AuthComponent::user('role_id') == null)) {
            throw new NotFoundException(__('Invalid article'));
        }
        $article = $this->Article->getCurrentVersion($id);
        if (!$article) {
            $this->Flash->set(__('The article has no active revisions'));
            $this->redirect(array('controller' => 'article_revisions', 'action' => 'index', 'slug' => $slug, 'sort' => 'id', 'direction' => 'desc'));
        }
        $this->set(compact('article'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        $slug = null;
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
        }
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
        $this->request->data['Article']['title'] = $slug;
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
            $id = @$this->Article->slugToId($slug);
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
        if (AuthComponent::user('role_id') <= 2) {
            $roles = $this->Article->Role->find('list');
            $this->set(compact('roles'));
        }
    }

    /**
     * history method
     *
     * @param null $id
     */
    public function history($id = null)
    {
        if (!empty($this->request->params['slug'])) {
            $slug = $this->request->params['slug'];
            $id = @$this->Article->slugToId($slug);
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
            $id = @$this->Article->slugToId($slug);
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
