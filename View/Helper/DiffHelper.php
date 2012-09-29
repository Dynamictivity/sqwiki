<?php
App::uses('AppHelper', 'View/Helper');
App::import('Vendor', 'php-diff/lib/Diff');
App::import('Vendor', 'php-diff/lib/Diff/Renderer/Html/Inline');
App::import('Vendor', 'php-diff/lib/Diff/Renderer/Html/SideBySide');
App::import('Vendor', 'php-diff/lib/Diff/Renderer/Text/Unified');
App::import('Vendor', 'php-diff/lib/Diff/Renderer/Text/Context');

class DiffHelper extends AppHelper {
	//public $helpers = array('Html');

	public function showDiff($old, $new, $options = array(), $type = 'SideBySide') {
		if (!in_array($type, array('SideBySide', 'Inline', 'Unified', 'Context'))) {
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
		$diff = new Diff($a, $b, $options);
		$escape = false;
		switch ($type) {
			case 'SideBySide':
				$renderer = new Diff_Renderer_Html_SideBySide;
				break;
			case 'Inline':
				$renderer = new Diff_Renderer_Html_Inline;
				break;
			case 'Unified':
				$renderer = new Diff_Renderer_Text_Unified;
				$escape = true;
				break;
			case 'Context':
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