<?php
//App::uses('Component', 'Controller');
//App::import(array('Security'));

class SecureComponent extends Component
{

    public $modOnlyActions = array();
    private $__Controller = null;

    public function __construct(ComponentCollection $collection, $settings = array())
    {
        parent::__construct($collection, $settings);
    }

    public function initialize(Controller $Controller)
    {
        $this->__Controller = $Controller;
        // If the user is logged-in
        if (AuthComponent::user('id')) {
            // Refresh the user session
            $User = ClassRegistry::init('User');
            $User->recursive = -1;
            CakeSession::write('Auth', $User->findById(AuthComponent::user('id')));
            // Set userId and roleId to variables for brevity
//            $userId = AuthComponent::user('id');
            $roleId = AuthComponent::user('role_id');
            // Catch invalid roles
            if (empty($roleId) || $roleId > 3) {
                $Controller->redirect($Controller->Auth->logout());
            }
            // Deny global access to logged-in user
            $Controller->Auth->deny(array('*'));
            if ($roleId == 1) {
                // Grant full access to admin users
                $Controller->Auth->allow(array('*'));
            }
            /**
             * Check prefix
             *        Make sure they have permission
             * Check role_id
             *        Log them out if they attempt to access admin or mod
             */
            switch (true) {
                // Admin
                case ($Controller->params['prefix'] == 'admin') :
                    if ($roleId > 1) {
                        $Controller->redirect($Controller->Auth->logout());
                    }
                    break;
                // Management
                case ($Controller->params['prefix'] == 'manage') :
                    if ($roleId > 2) {
                        $Controller->redirect($Controller->Auth->logout());
                    }
                    break;
                // Banned/Deleted
                case ($roleId == 4) :
                    // Log them out
                    if ($Controller->params['action'] != 'logout') {
                        $Controller->redirect($Controller->Auth->logout());
                    }
                    break;
            }
        }
    }

}
