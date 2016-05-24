<?php
/*
 *	Sendgrid Email Component
 */

App::uses('CakeEmail', 'Network/Email');

class SendGridComponent extends Component
{

    private $__xSmtpApiHeader;
    private $__xSmtpApiHeader_vars = array();
    private $__xSmtpApiHeader_subs = array();
    private $__smtpOptions = false;
    protected $_toList = array();
    protected $_nameList = array();
    public $email;
    public $category;
    public $subject;
    public $layout = 'default';
    public $template = 'default';
    public $emailFormat = 'both';
    public $deliveryMethod = 'smtp';

    /**
     *    Component construct
     */
    public function __construct(ComponentCollection $collection, $settings = array())
    {
        parent::__construct($collection, $settings);
    }

    public function startup(Controller $Controller)
    {
        // Setup the Sendgrid X-SMTPAPI Array
        $this->__xSmtpApiHeader = new SmtpApiHeader();
        $this->__xSmtpApiHeader_vars = array();
        $this->__xSmtpApiHeader_subs = array();
        // Setup CakeEmail
        $this->email = new CakeEmail();
    }

    /*
     *	$params =
     *	{
     *		'to' 			=> array('address' => 'name'),  REQUIRED - must be array
     *		'subject 		=> <subject>,					REQUIRED
     *		'unique'		=> <unique id for x-SMTPAPI>,
     *		'category'		=> <category for sendgrid reports>,
     *		'layout'		=> <email layout filename>,
     *		'template'		=> <template filename>,
     *		'emailFormat'	=> <[text|html|both]>, 			DEFAULT = both
     *		'deliveryMethod'	=> <smtp>,						DEFAULT = smtp
     *		'mergeValues' 	=> array(
     *			<key> => <values>,
     *			<key> => <values>,..    For doing bulk messages with single call
     *		)
     *	}
     */
    public function sendEmail($params = array())
    {
        // Bring our params into the local symbol table
        extract($params);

        // Setup Message Basics
        if (!empty($to) && is_array($to)) {
            $this->addTo($to);
        } else {
            return false;
        }

        // Set subject
        if (!empty($subject)) {
            $this->setSubject($subject);
        } elseif (!$this->subject) {
            return false;
        }

        // Setup CakePHP layout and template files for the email
        if (!empty($layout)) {
            $this->setLayout($layout);
        } elseif (!$this->layout) {
            return false;
        }

        if (!empty($template)) {
            $this->setTemplate($template);
        } elseif (!$this->template) {
            return false;
        }

        // Set email format content-type
        if (!empty($emailFormat)) {
            $this->setEmailFormat($emailFormat);
        }

        // Set email category for sendgrid reports
        if (!empty($category)) {
            $this->setCategory($category);
        }

        // Set delivery method
        if (!empty($deliveryMethod)) {
            $this->setDeliveryMethod($deliveryMethod);
        }

        // Setup SendGrid Unique Message ID
        if (!empty($unique)) {
            $this->setSendGridUnique($unique);
        }

        // Setup SendGrid Substitution Values
        if (!empty($mergeValues) && is_array($mergeValues)) {
            $this->setSubstitution($mergeValues);
        }

        // Send the message
        return $this->send();

    }

    /*  Implementing setter functions for all major elements of email
     *  NOT strictly needed, but for ease of migration, etc, I am
     *  abstracting things.
     */
    public function addTo($recipients)
    {
        if (!is_array($recipients)) {
            return false;
        }
        // Set the to value(s)
        $this->_toList = array_merge($this->_toList, array_keys($recipients));
        $this->_nameList = array_merge($this->_nameList, array_values($recipients));
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setLayout($layout)
    {
        $this->layout = str_replace('.ctp', '', $layout);
    }

    public function setTemplate($template)
    {
        $this->template = str_replace('.ctp', '', $template);
    }

    public function setEmailFormat($emailFormat)
    {
        $this->emailFormat = $emailFormat;
    }

    public function setDeliveryMethod($deliveryMethod)
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    public function setSendGridUnique($unique)
    {
        $this->__xSmtpApiHeader->addFilterSetting('opentrack', 'enable', 1);
        $this->__xSmtpApiHeader_vars['messageID'] = $unique;
    }

    public function setSubstitution($subs)
    {
        foreach ($subs as $key => $values) {
            $this->__xSmtpApiHeader_subs[$key] = $values;
        }
    }

    /**
     *  Send Function
     *
     *    Sets the SendGrid X-SMTPAPI Header and sends the email
     */
    public function send()
    {
        // Set delivery configuration
        $this->email->config($this->deliveryMethod);

        // Add to's
        $this->__xSmtpApiHeader->addTo($this->_toList);

        // Set to as from to avoid cakephp errors
        $this->email->addTo($this->email->from());

        // Add names
        $this->setSubstitution(array('%name%' => $this->_nameList));

        // Set email format
        $this->email->emailFormat($this->emailFormat);

        // Set subject
        $this->email->subject($this->subject);

        // Set template and layout
        $this->email->template($this->template, $this->layout);

        // Set any unique variables
        $this->__xSmtpApiHeader->setUniqueArgs($this->__xSmtpApiHeader_vars);

        // Set email category
        $this->__xSmtpApiHeader->setCategory($this->category);

        // Handle any substitutions
        foreach ($this->__xSmtpApiHeader_subs as $key => $values) {
            $this->__xSmtpApiHeader->addSubVal($key, $values);
        }

        // Strip duplicate header definition
        $this->email->addHeaders(array('X-SMTPAPI' => $this->__removeDuplicateHeaderLabels($this->__xSmtpApiHeader->as_string())));

        // Send the email
        return $this->email->send();
    }

    private function __removeDuplicateHeaderLabels($string)
    {
        return trim(str_replace('X-SMTPAPI: ', '', $string));
    }

}
