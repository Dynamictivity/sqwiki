<?php
App::uses('AppHelper', 'View/Helper');
App::import('Vendor', 'Markdown/markdown');

class MarkdownHelper extends AppHelper {
	//public $helpers = array('Html');

	public function parse($markup) {
		$markup = Sanitize::html($markup);
		return $this->__formatForWiki(Markdown($markup));
	}

	private function __formatForWiki($output) {
		$output = str_replace(array('</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>', '[[Sources]]'), array('</h1><hr />', '</h2><hr />', '</h3><hr />', '</h4><hr />', '</h5><hr />', '</h6><hr />', '<a name="source">Sources:</a>'), $output);
		$output = str_replace('href="#source"', 'href="#source" class="source"', $output);
		return $output;
	}

}