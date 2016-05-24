<?php
App::uses('AppHelper', 'View/Helper');

class UiThemeHelper extends AppHelper
{
    public $helpers = array('Html', 'Form');

    public function themeSelector()
    {
        if (!CakeSession::check('UiTheme.list') || Configure::read('debug') > 0) {
            if (!$this->__generateThemeList()) {
                return;
            }
        }
        if (!CakeSession::check('UiTheme.activeTheme')) {
            CakeSession::write('UiTheme.activeTheme', Configure::read('Sqwiki.default_theme'));
        }
        $out = $this->Form->create('Theme', array('action' => 'set_theme'));
        $out .= $this->Form->input('selected', array("type" => "select", "label" => __('Change Theme'), "options" => CakeSession::read('UiTheme.list'), 'value' => CakeSession::read('UiTheme.activeTheme')));
        $out .= $this->Form->end('Go');
        return $out;
    }

    private function __generateThemeList()
    {
        $dir = CSS . DS . 'jqueryui';
        $files = scandir($dir);
        $themeList = array();
        foreach ($files as $theme) {
            $themeList[] = $theme;
        }
        unset($themeList[0]);
        unset($themeList[1]);
        $themeList = array_combine($themeList, $themeList);
        $themeList[Configure::read('Sqwiki.default_theme')] = __('%s (Default)', Configure::read('Sqwiki.default_theme'));
        return CakeSession::write('UiTheme.list', $themeList);
    }

}