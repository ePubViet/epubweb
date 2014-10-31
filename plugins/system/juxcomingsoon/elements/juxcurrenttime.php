<?php
/**
 * @version   $id: $
 * @author    JoomlaUX!
 * @package   Joomla!
 * @subpackage  plg_system_juxcomingsoon
 * @copyright Copyright (C) 2012 - 2014 by Joomlaux. All rights reserved.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL version 3, See LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Platform.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldJUXCurrenttime extends JFormField
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'JUXcurenttime';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string   The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '1';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		$data = $this->getData();

		return JHTML::_('select.genericlist', $data, $this->name, $attr, 'value', 'text', $this->value, $this->id, true);

		return implode($html);
	}

	/**
	 * Method to get list of countries.
	 *
	 * @return	array
	 */
	protected function getData()
	{
		// Get a database object.
		$current_date = date('d/m/Y == H:i:s');
		return $current_date;
	}

}

?>