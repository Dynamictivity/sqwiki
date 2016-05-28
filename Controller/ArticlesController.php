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
        $this->admin_index();
    }

    /**
     * view method
     *
     * @return void
     */
    public function view()
    {
        if (empty($this->request->params['slug'])) {
            throw new NotFoundException(__('Invalid article'));
        }
        $slug = $this->request->params['slug'];
        $id = $this->Article->slugToId($slug);
        $this->Article->id = $id;
        if (!$this->Article->exists() || $this->request->is('post')) {
            $this->Flash->set(__('The article does not exist yet'));
            $this->add();
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
                $this->redirect(array('action' => 'view', 'slug' => $this->Article->field('slug')));
            } else {
                $this->Flash->set(__('The article could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * revise method
     *
     * @throws NotFoundException
     * @return void
     */
    public function revise()
    {
        if (empty($this->request->params['slug'])) {
            throw new NotFoundException(__('Invalid article'));
        }
        $slug = $this->request->params['slug'];
        $id = $this->Article->slugToId($slug);
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Article->saveAssociated($this->request->data)) {
                $this->Flash->set(__('The article has been saved'));
                $this->redirect(array('action' => 'view', 'slug' => $slug));
            } else {
                $this->Flash->set(__('The article could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Article->getCurrentVersion($id, array('merge' => false));
        }
        $this->render('revise');
    }

    /**
     * history method
     *
     * @return void
     */
    public function history()
    {
        if (empty($this->request->params['slug'])) {
            throw new NotFoundException(__('Invalid article'));
        }
        $slug = $this->request->params['slug'];
        $id = $this->Article->slugToId($slug);
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->redirect(array('controller' => 'article_revisions', 'action' => 'history', 'slug' => $slug, 'sort' => 'id', 'direction' => 'desc'));
    }

    /**
     * talk method
     *
     * @return void
     */
    public function talk()
    {
        if (empty($this->request->params['slug'])) {
            throw new NotFoundException(__('Invalid article'));
        }
        $slug = $this->request->params['slug'];
        $id = $this->Article->slugToId($slug);
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->redirect(array('controller' => 'comments', 'action' => 'talk', 'slug' => $slug, 'sort' => 'id', 'direction' => 'desc'));
    }

    /**
     * manage_index method
     *
     * @return void
     */
    public function manage_index()
    {
        $this->admin_index();
    }

    /**
     * manage_view method
     *
     * @param string $id
     * @return void
     */
    public function manage_view($id = null)
    {
        $this->admin_view($id);
    }

    /**
     * manage_add method
     *
     * @return void
     */
    public function manage_add()
    {
        $this->admin_add();
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
        $this->admin_revise($id);
    }

    /**
     * manage_history method
     *
     * @param string $id
     * @return void
     */
    public function manage_history($id = null)
    {
        $this->admin_history($id);
    }

    /**
     * manage_talk method
     *
     * @param string $id
     * @return void
     */
    public function manage_talk($id = null)
    {
        $this->admin_talk($id);
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->Article->recursive = 0;
        $this->set('articles', $this->paginate());
    }

    /**
     * admin_view method
     *
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->Article->id = $id;
        if (!$this->Article->exists() || $this->request->is('post')) {
            $this->Flash->set(__('The article does not exist yet'));
            $this->admin_add();
            return $this->render('admin_add');
        }
        $article = $this->Article->getCurrentVersion($id);
        if (!$article) {
            $this->Flash->set(__('The article has no active revisions'));
            $this->redirect(array('controller' => 'article_revisions', 'action' => 'index', 'article_id' => $id, 'sort' => 'id', 'direction' => 'desc'));
        }
        $this->set(compact('article'));
        $this->render('view');
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
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
        $this->render('add');
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
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Article->saveAssociated($this->request->data)) {
                $this->Flash->set(__('The article has been saved'));
                $this->redirect(array('action' => 'view', $this->Article->id));
            } else {
                $this->Flash->set(__('The article could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Article->getCurrentVersion($id, array('merge' => false));
        }
        $this->render('revise');
    }

    /**
     * admin_history method
     *
     * @param string $id
     * @return void
     */
    public function admin_history($id = null)
    {
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->redirect(array('controller' => 'article_revisions', 'action' => 'history', 'article_id' => $id, 'sort' => 'id', 'direction' => 'desc'));
    }

    /**
     * admin_talk method
     *
     * @param string $id
     * @return void
     */
    public function admin_talk($id = null)
    {
        $this->Article->id = $id;
        if (!$this->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->redirect(array('controller' => 'comments', 'action' => 'talk', 'article_id' => $id, 'sort' => 'id', 'direction' => 'desc'));
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
