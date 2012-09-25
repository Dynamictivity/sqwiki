<?php

/**
 * CakePHP Sluggable Behavior
 *
 * Makes generation of unique URL slugs for permalinks very simple in CakePHP
 * 
 * @version 1.0
 * @package CakePHP_Sluggable
 * @author Aaron Pollock <aaron.pollock@gmail.com>
 * @copyright Copyright (c) 2011, Aaron Pollock
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public Licence v3.0
 */

/**
 * The main Behavior class
 * 
 * @package CakePHP_Sluggable
 */
class SluggableBehavior extends ModelBehavior
{
	
	/**
	 * Settings as specified in the Cake model where the Behavior is applied
	 *
	 * @var array
	 * @access public
	 */
	public $settings = array();
	
	/**
	 * A suffix counter used in (@link _deduplicate_slug()) recursive function
	 *
	 * @var int
	 * @access private
	 */
	private $duplicate_suffix = 0;
	
	/**
	 * Set up the Behavior settings
	 *
	 * @access public
	 * @param mixed $model Instance of the model which has this Behavior
	 * @return void
	 */
	public function setup(&$model, $settings)
	{
		// Merge defaults
		$this->settings[$model->alias] = array_merge(
			array(
				'slug_field'		=>	'slug',
				'title_field'		=>	'title',
				'slug_max_length'	=>	100,
				'slug_type'	=>	'slug',
				'slug_separator'	=>	'-',
				'lowercase'	=>	true
			),
			(array)$settings
		);
		
	}
	
	/**
	 * Callback for before validation of associated model
	 * 
	 * Checks if a slug should be generated and, if so, puts it into the model's data before validation
	 *
	 * @param mixed $model Instance of the model which has this Behavior
	 * @return bool Always returns true, allowing CakePHP validation to proceed
	 */
	public function beforeValidate(&$model)
	{
		if (!$this->_slug_override_in_place($model) && $this->_record_needs_slug($model)){
			$this->_generate_slug($model);
		}
		
		return true;
	}
	
	/**
	 * Check if the *loaded* model data already contains a slug
	 *
	 * This will apply if the app has specified a slug manually, rather than having this behavior generate it
	 *
	 * @param mixed $model Instance of the model which has this Behavior
	 * @return bool True if data already contains slug
	 */
	private function _slug_override_in_place(&$model)
	{
		if (isset($model->data[$model->alias][$this->settings[$model->alias]['slug_field']])){
			$slug_in_data = $model->data[$model->alias][$this->settings[$model->alias]['slug_field']];
		}
		
		return (isset($slug_in_data) && !empty($slug_in_data));
	}
	
	/**
	 * Check if the record in the database needs a slug generated
	 *
	 * @param mixed $model Instance of the model which has this Behavior
	 * @return bool True if a slug is required (false if one exists)
	 */
	private function _record_needs_slug(&$model)
	{
		if (!isset($model->id)) {
			
			// new record, needs a slug in all cases
			return true;
			
		} else {
			
			// existing record; check to see if slug already present before generating one
			$existing_data = $model->findById($model->id);
			$existing_slug = $existing_data[$model->alias][$this->settings[$model->alias]['slug_field']];
			
			return ( null === $existing_slug || '' === $existing_slug );
			
		}
	}
	
	/**
	 * Generate the slug based on the specified source field, and assign it in the model data to the specified slug field
	 *
	 * @param mixed $model Instance of the model which has this Behavior
	 * @return mixed Nothing is returned
	 */
	private function _generate_slug(&$model)
	{
		$title_field = $this->settings[$model->alias]['title_field'];
		
		// use the record title as passed in the data being validated
		if (isset($model->data[$model->alias][$title_field])) {
			$slug_source = $model->data[$model->alias][$title_field];
		
		// use the record title in the database
		} elseif (isset($model->id) && $model->field($title_field)) {
			$slug_source = $model->field($title_field);
			
		}
		
		if (isset($slug_source)) {
			switch ($this->settings[$model->alias]['slug_type']) {
				case 'camelize':
					$slug = Inflector::camelize(Inflector::slug($slug_source));
					break;
				default:
					$slug = Inflector::slug($slug_source, $this->settings[$model->alias]['slug_separator']);
			}
			if ($this->settings[$model->alias]['lowercase']) {
				$slug = strtolower($slug);
			}
			if (strlen($slug) > $this->settings[$model->alias]['slug_max_length']) {
				$slug = substr($slug, 0, $this->settings[$model->alias]['slug_max_length']);
			}
			
			$slug = $this->_deduplicate_slug($model, $slug);
			$model->data[$model->alias][$this->settings[$model->alias]['slug_field']] = $slug;
		}
	}
	
	/**
	 * Recursive function which keeps incrementing a slug suffix until it is unique, before returning the result
	 *
	 * @param mixed $model Instance of the model which has this Behavior
	 * @param string $slug The generated slug which needs checked for uniqueness and amended if required
	 * @return string A final slug which has been found to be unique
	 */
	private function _deduplicate_slug(&$model, &$slug)
	{
		$dupes = $model->find(
			'count',
			array(
				'conditions' => array(
					$model->alias . '.' . $this->settings[$model->alias]['slug_field'] => $slug,
					$model->alias . '.id !=' => $model->id
				)
			)
		);
		
		if (0 === $dupes) {
			
			return $slug;
			
		} else {
			
			$previous_suffix = $this->duplicate_suffix;
			$this->duplicate_suffix++;
			
			$new_slug_suffix = (string)$this->duplicate_suffix;
			$new_suffix_length = strlen($new_slug_suffix);
			$slug_length = strlen($slug);
			$max_length = $this->settings[$model->alias]['slug_max_length'];
			
			if ($previous_suffix > 0 || $new_suffix_length + $slug_length > $max_length) {
				$replace_at = -1 * $new_suffix_length;
			} else {
				$replace_at = $slug_length;
			}
			
			$slug = substr_replace($slug, $new_slug_suffix, $replace_at);
			return $this->_deduplicate_slug($model, $slug);
			
		}
	}
	
}