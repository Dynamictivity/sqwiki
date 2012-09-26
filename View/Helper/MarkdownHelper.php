<?php
App::uses('AppHelper', 'View/Helper');
App::import('Vendor', 'Markdown/markdown');

class MarkdownHelper extends AppHelper {
	//public $helpers = array('Html');

	public function parse($markup) {
		return Markdown($markup);
	}

}