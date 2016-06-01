<?php
App::uses('AppHelper', 'View/Helper');

class DiffHelper extends AppHelper
{

    public function showDiff($old, $new, $options = array(), $type = 'Inline')
    {
        if (!in_array($type, array('SideBySide', 'Inline', 'Unified', 'Context', 'Array'))) {
            return "Please select a proper type for diff.";
        }
        $options = array_merge(
            array(
                //'ignoreWhitespace' => true,
                //'ignoreCase' => true,
            ), $options
        );
        if (is_string($old) && is_string($new)) {
            $a = explode("\n", $old);
            $b = explode("\n", $new);
        }
        if (!isset($a) && !isset($b)) {
            return;
        }
        require_once(APP . 'Vendor/phpspec/php-diff/lib/Diff.php');
        $diff = new Diff($a, $b, $options);
        $escape = false;
        switch ($type) {
            case 'Array':
                require_once(APP . 'Vendor/phpspec/php-diff/lib/Diff/Renderer/Html/Array.php');
                $renderer = new Diff_Renderer_Html_Array;
                break;
            case 'SideBySide':
                require_once(APP . 'Vendor/phpspec/php-diff/lib/Diff/Renderer/Html/SideBySide.php');
                $renderer = new Diff_Renderer_Html_SideBySide;
                break;
            case 'Inline':
                require_once(APP . 'Vendor/phpspec/php-diff/lib/Diff/Renderer/Html/Inline.php');
                $renderer = new Diff_Renderer_Html_Inline;
                break;
            case 'Unified':
                require_once(APP . 'Vendor/phpspec/php-diff/lib/Diff/Renderer/Text/Unified.php');
                $renderer = new Diff_Renderer_Text_Unified;
                $escape = true;
                break;
            case 'Context':
                require_once(APP . 'Vendor/phpspec/php-diff/lib/Diff/Renderer/Text/Context.php');
                $renderer = new Diff_Renderer_Text_Context;
                $escape = true;
                break;
        }
        $output = $diff->render($renderer);
        if ($escape) {
            return h($output);
        }
        return $output;
    }

}
