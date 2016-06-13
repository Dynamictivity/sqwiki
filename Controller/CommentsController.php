<?php
App::uses('AppController', 'Controller');

/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property array paginate
 */
class CommentsController extends AppController
{

    /**
     * beforeFilter method
     *
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        switch (AuthComponent::user('role_id')) {
            case '2':
                $this->Auth->allow(array('manage_index'));
            case '3':
                $this->Auth->allow(array('add'));
            default:
                $this->Auth->allow(array('talk'));
        }
    }

    /**
     * talk method
     *
     * @return void
     */
    public function talk()
    {
        if (!empty($this->request->params['slug'])) {
            $id = @$this->Comment->Article->slugToId($this->request->params['slug']);
            $this->Comment->Article->id = $id;
            $this->paginate = array(
                'conditions' => array(
                    'article_id' => $id
                )
            );
            $this->Comment->Article->recursive = -1;
            $article = $this->Comment->Article->getCurrentVersion($id);
            $this->set(compact('article'));
        }
        if (!$this->Comment->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->Comment->recursive = 0;
        $this->set('comments', $this->paginate());
        $this->render('talk');
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Comment->create();
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->set(__('The comment has been saved'));
                $this->redirect(array('action' => 'talk', 'slug' => $this->request->params['slug']));
            } else {
                $this->Flash->set(__('The comment could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->params['slug'])) {
            throw new NotFoundException(__('Invalid article'));
        }
        $article['Article']['id'] = @$this->Comment->Article->slugToId($this->request->params['slug']);
        $this->Comment->Article->id = $article['Article']['id'];
        if (!$this->Comment->Article->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $this->Set(compact('article'));
        $this->render('add');
    }

    /**
     * manage_index method
     *
     * @return void
     */
    public function manage_index()
    {
        $this->Comment->recursive = 0;
        $this->set('comments', $this->paginate());
    }
}
