<?php
//App::uses('Component', 'Controller');
//App::import(array('Security'));

class SecureComponent extends Component {

	public $modOnlyActions = array();
	private $__Controller = null;
	
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
	}

	public function initialize($Controller) {
		$this->__Controller = $Controller;
		// If the user is logged-in
		if (AuthComponent::user('id')) {
			// Refresh the user session
			CakeSession::write('Auth', ClassRegistry::init('User')->findById(AuthComponent::user('id')));
			// Set userId and roleId to variables for brevity
			$userId = AuthComponent::user('id');
			$roleId = AuthComponent::user('role_id');
			// Catch invalid roles
			if (empty($roleId) || $roleId > 3) {
				$Controller->redirect($Controller->Auth->logout());
			}
			// Allow global access to logged-in user
			$Controller->Auth->allow(array('*'));
			/**
			 * Check prefix
			 *		Make sure they have permission
			 * Check role_id
			 *		Log them out if they attempt to access admin or mod
			 */
			switch (true){
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
		} else {
			// Only allow certain actions
			$Controller->Auth->allow(array('login', 'logout', 'register'));
		}
		// Ensure that a moderator/admin is accessing a modOnlyAction URL
		$this->modOnlyActions = (array)$this->modOnlyActions;
		if (!empty($this->modOnlyActions) && ($this->modOnlyActions[0] == '*' || in_array($Controller->request->action, $this->modOnlyActions))) {
			$Controller->Session->setFlash(__('That action is restricted to moderators.'));
			$Controller->redirect(array('controller' => 'articles', 'action' => 'index', 'manage' => false));
		}
	}

	public function checkExistsAndOwnership($valueToCompare = null, $fieldToCheck = 'user_id', $recordId = null, $modelToCheck = null) {
		if (!$modelToCheck) {
			$modelToCheck = $this->__Controller->{$this->__Controller->modelClass};
		}
		if (!$recordId) {
			$recordId = $this->__Controller->{$this->__Controller->modelClass}->id;
		} else {
			$modelToCheck->id = $recordId;
		}
		if (!$valueToCompare) {
			$valueToCompare = AuthComponent::user('id');
		}
		if (!$modelToCheck->exists() || $modelToCheck->field($fieldToCheck) != $valueToCompare) {
			throw new NotFoundException(__('That') . ' ' . strtolower(Inflector::humanize(Inflector::underscore($modelToCheck->name))) . ' ' . __('does not exist.'));
		}
	}

}
