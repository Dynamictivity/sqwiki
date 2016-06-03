<?php
App::uses('AppHelper', 'View/Helper');

class MarkdownHelper extends AppHelper
{
    protected $_output = null;

    public function parse($markup)
    {
        $this->_output = $markup;
        $this->__purifyHTML();
        $this->__formatInternalLinks();
        $this->__markdown();
        $this->__formatForWiki();
        return $this->_output;
    }

    private function __purifyHTML()
    {
        require_once(APP . 'Vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php');
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $this->_output = $purifier->purify($this->_output);
    }

    private function __formatInternalLinks()
    {
        $this->_output = preg_replace_callback(
            '"([\[]{2})([a-zA-Z\_0-9]+)([\]]{2})"',
            function ($matches) {
                return '[' . $matches[2] . '](' . Router::url('/', true) . $matches[2] . ')';
            },
            $this->_output
        );

        $this->_output = str_replace(array('##Sources##'), array('<hr /><strong><a name="source">Sources:</a></strong>'), $this->_output);
    }

    private function __markdown()
    {
        require_once(APP . 'Vendor/erusev/parsedown/Parsedown.php');
        $Parsedown = new Parsedown();
        $this->_output = $Parsedown->text($this->_output);
    }

    private function __formatForWiki()
    {
        $this->_output = str_replace(array('</h1>'), array('</h1><hr />'), $this->_output);
//        $this->_output = str_replace('href="#source"', 'href="#source" class="source"', $this->_output);
    }

}
