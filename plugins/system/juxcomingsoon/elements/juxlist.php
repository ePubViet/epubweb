<?php
/**
 * @version   $id: $
 * @author    JoomlaUX!
 * @package   Joomla!
 * @subpackage  plg_system_juxcomingsoon
 * @copyright Copyright (C) 2012 - 2014 by Joomlaux. All rights reserved.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL version 3, See LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
if(!class_exists('JFormFieldList')) {
	JFormHelper::loadFieldClass('list');
}

/**
 * Create Radio List Button. With the ability to show/hide sub-options.
 * Example xml:
 * <field
 * 	name="mod_jux_show_hide"
 * 	type="JUXList"
 * 	default="1"
 * 	label="MOD_JUX_LABEL"
 * 	description="MOD_JUX_DESC">
 * 	<option value="1" sub_fields="mod_yes_field_1,mod_yes_field_2">JYES</option>
 * 	<option value="0" sub_fields="mod_no_field_1,mod_no_field_2">JNO</option>
 * </field>
 */
class JFormFieldJUXList extends JFormFieldList {

	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	protected $type = 'JUXList';
	
	/**
	 * Active sub-fields.
	 * 
	 * @var		string
	 */
	protected $active_sub_fields = '';
	
	/**
	 * List of all sub-fields
	 * 
	 * @var		string
	 */
	protected $all_sub_fields = array();

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput() {
		if (!defined ('JUX_OPTION_FIELDS_ASSETS')) {
			define ('JUX_OPTION_FIELDS_ASSETS', 1);
			$uri = str_replace("\\","/", str_replace(JPATH_SITE, JURI::root(), dirname(__FILE__) ));
			if(JVERSION <= '3.0.0')
			{
				// load jQuery on older Joomla
				if(!defined('JUX_LOAD_JQUERY_MIN'))
				{	define('JUX_LOAD_JQUERY_MIN',1);
					JHTML::script($uri.'/assets/js/jquery.min.js');
					JHTML::script($uri.'/assets/js/jquery-noconflict.js');
				}
			}
			JHTML::script($uri.'/assets/js/juxoptions.js');
			JHTML::stylesheet($uri.'/assets/css/juxoptions.css');
		}

		// Initialize variables.
		$html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';

		// To avoid user's confusion, readonly="true" should imply disabled="true".
		if ((string) $this->element['readonly'] == 'true' || (string) $this->element['disabled'] == 'true')
		{
			$attr .= ' disabled="disabled"';
		}

		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$attr .= $this->multiple ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$on_change	= ' onchange="';
		$on_change	.= $this->element['onchange'] ? (string) $this->element['onchange'] : '';
		
		// Add new script
		$on_change .= ' jux_ToggleOption(\''.$this->id.'\');';
		$on_change	.= '"';
		
		$attr .= $on_change;

		// Get the field options.
		$options = (array) $this->getOptions();

		// Initialize sub fields data.
		$all_sub_fields		= !empty($this->all_sub_fields) ? ' data-all_sub_fields="' . implode(',', $this->all_sub_fields) . '"' : '';
		$attr .= $all_sub_fields;

		// Create a read-only list (no name) with a hidden input to store the value.
		if ((string) $this->element['readonly'] == 'true')
		{
			$html[] = JHtml::_('select.genericlist'
					, $options
					, ''
					, array('id' => $this->id, 'list.attr' => trim($attr), 'option.key' => 'value', 'option.text' => 'text', 'list.select' => $this->value, 'option.attr' => 'data_sub_fields')
					);
			$html[] = '<input type="hidden" name="' . $this->name . '" value="' . $this->value . '"/>';
		}
		// Create a regular list.
		else
		{
			$html[] = JHtml::_('select.genericlist'
					, $options
					, $this->name
					, array('id' => $this->id, 'list.attr' => trim($attr), 'option.key' => 'value', 'option.text' => 'text', 'list.select' => $this->value, 'option.attr' => 'data_sub_fields')
					);
		}

		// Onload Script
		$html[] = '<script type="text/javascript">';
		$html[] = '	window.addEvent("load", function() {';
		$html[] = '		jux_ToggleOption("'.$this->id.'");';
		$html[] = '	});';
		$html[] = '</script>';
		
		return implode("\n", $html);
	}

	/**
	 * Method to get the script onload
	 * 
	 * @return blank
	 */
	private function onload_script() {
		?>
		<script type="text/javascript">
//			var js_subfield_<?php echo $this->element['name']; ?> = "<?php echo implode(',', $this->all_sub_fields); ?>";
//			var js_subfield_<?php echo $this->element['name']; ?>_data = new Array();
			
			<?php // foreach($this->all_sub_fields as $key => $value): ?>
//				js_subfield_<?php // echo $this->element['name']; ?>_data["<?php // echo $key; ?>"] = "<?php // echo $value; ?>";
			<?php // endforeach; ?>
			window.addEvent('load', function() {
				jux_ToggleOption("<?php echo $this->id; ?>");
//				js_ShowOptions('<?php // echo $this->active_sub_fields; ?>');
			});
		</script>
		<?php

		return;
	}

	/**
	 * Override getOptions Method to get sub fields list.
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions() {
		// Initialize variables.
		$options = array();

		foreach ($this->element->children() as $option)
		{

			// Only add <option /> elements.
			if ($option->getName() != 'option')
			{
				continue;
			}

			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_(
				'select.option', (string) $option['value'],
				JText::alt(trim((string) $option), preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)), 'value', 'text',
				((string) $option['disabled'] == 'true')
			);

			// Set some option attributes.
			$tmp->class = (string) $option['class'];

			// Get sub_fields.
			$sub_fields = str_replace("\n", '', trim($option['sub_fields']));
			$sub_fields_id = '';
			if(!empty($sub_fields)) {
				$sub_fields_array = explode(',',$sub_fields);
				$sub_fields_id_list	= array();
				foreach($sub_fields_array as $sub_field) {
					if(strpos($sub_field, '/') != false) {
						$slash_pos	= strpos($sub_field, '/');
						$tmp_group = $this->group;
						$this->group = substr($sub_field, 0, $slash_pos);
						$sub_field = substr($sub_field, $slash_pos + 1);
						$sub_fields_id_list[] = $this->getId(null, $sub_field);
						$this->group = $tmp_group;

						continue;
					}
					$sub_fields_id_list[] = $this->getId(null, $sub_field);
				}
				$sub_fields_id = implode(',', $sub_fields_id_list);
				$this->all_sub_fields = array_merge($this->all_sub_fields, array((string)$option['value'] => $sub_fields_id));
			}

			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];

			// Set sub fields data
			$tmp->data_sub_fields = !empty($sub_fields_id) ? ' data-sub_fields="'.$sub_fields_id.'"' : '';

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}

}