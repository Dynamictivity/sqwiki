<?php
/*
 *	SendEMail Component
 */

App::uses('CakeEmail', 'Network/Email');

class SendEMailComponent extends Component
{
    public $email;
    public $subject;
    public $deliveryMethod;
    public $emailFormat = 'both';

    protected $_template = 'default';
    protected $_layout = 'default';
    protected $_recipients = array();
    protected $_viewVars = array();

    /**
     *    Component construct
     * @param ComponentCollection $collection
     * @param array $settings
     */
    public function __construct(ComponentCollection $collection, $settings = array())
    {
        parent::__construct($collection, $settings);
    }

    /**
     * @param Controller $Controller
     */
    public function startup(Controller $Controller)
    {
        // Setup CakeEmail
        $this->email = new CakeEmail();
        // Set default email config
        $this->email->config(Configure::read('Sqwiki.email_transport'));
    }

    /**
     * @param array $params =
     *	(
     *	  'to' => array('address' => 'name'),   REQUIRED
     *	  'subject => <subject>,                REQUIRED
     *	  'layout' => <email layout filename>,
     *	  'template' => <template filename>,
     *	  'emailFormat'	=> <[text|html|both]>,  DEFAULT = both
     *	  'deliveryMethod' => <smtp>,           DEFAULT = default
     *	  'viewVars' => array(
     *	    <key> => <value>,
     *	  )
     *	)
     * @return bool|mixed
     */
    public function sendEmail($params = array())
    {
        // Bring our params into the local symbol table
        extract($params);

        // Setup Message Basics
        if (!empty($to)) {
            $this->addTo($to);
        } elseif (empty($this->_recipients)) {
            return false;
        }

        // Set subject
        if (!empty($subject)) {
            $this->subject = $subject;
        } elseif (!$this->subject) {
            return false;
        }

        // Setup CakePHP layout and template files for the email
        if (!empty($layout)) {
            $this->setLayout($layout);
        } elseif (!$this->_layout) {
            return false;
        }

        if (!empty($template)) {
            $this->setTemplate($template);
        } elseif (!$this->_template) {
            return false;
        }

        // Set email format content-type
        if (!empty($emailFormat)) {
            $this->emailFormat = $emailFormat;
        }

        // Set delivery method
        if (!empty($deliveryMethod)) {
            $this->deliveryMethod = $deliveryMethod;
        }

        // mergeValues()
        if (!empty($viewVars) && is_array($viewVars)) {
            $this->addViewVars($viewVars);
        } elseif (!$this->_viewVars) {
            return false;
        }

        // Send the message
        return $this->send();

    }

    /*  Implementing setter functions for all major elements of email
     */

    /**
     * @param $recipients
     * @return bool
     */
    public function addTo($recipients)
    {
        if (empty($recipients)) {
            return false;
        }
        // Set the to value(s)
        $this->_recipients = array_merge($this->_recipients, (array)$recipients);
    }

    /**
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->_layout = str_replace('.ctp', '', $layout);
    }

    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->_template = str_replace('.ctp', '', $template);
    }

    /**
     * @param array $viewVars
     */
    public function addViewVars($viewVars = array())
    {
        // Set the to value(s)
        $this->_viewVars = array_merge($this->_viewVars, $viewVars);
    }

    /**
     * @return mixed
     */
    public function send()
    {
        // Set delivery configuration
        if (!empty($this->deliveryMethod)) {
            $this->email->config($this->deliveryMethod);
        }

        // Add to's
        $this->email->addTo($this->_recipients);

        // Set to as from to avoid cakephp errors
//        $this->addTo($this->email->from());

        // Set email format
        $this->email->emailFormat($this->emailFormat);

        // Set subject
        $this->email->subject($this->subject);

        // Set template and layout
        $this->email->template($this->_template, $this->_layout);

        // Set email viewVars
        $this->email->viewvars($this->_viewVars);

        // Send the email
        $email = $this->email->send();

        if (Configure::read('debug')) {
            debug($email);
        }

        return $email;
    }

}
