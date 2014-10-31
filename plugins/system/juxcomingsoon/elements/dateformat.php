<?php
/**
 * @version   $id: $
 * @author    JoomlaUX!
 * @package   Joomla!
 * @subpackage  plg_system_juxcomingsoon
 * @copyright Copyright (C) 2012 - 2014 by Joomlaux. All rights reserved.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL version 3, See LICENSE.txt
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

JFormHelper::loadFieldClass('list');

class JFormFieldDateFormat extends JFormFieldList
{

	protected $type = 'DateFormat';

	protected function getOptions()
	{
    $date_now = JFactory::getDate();
    $date_now->setTimeZone(new DateTimeZone(JFactory::getApplication()->getCfg('offset')));

		$options = array();
    $options[] = JHtml::_('select.option', 'DATE_FORMAT_LC', $date_now->format(JText::_('DATE_FORMAT_LC'),true), 'value', 'text');
    $options[] = JHtml::_('select.option', 'DATE_FORMAT_LC1', $date_now->format(JText::_('DATE_FORMAT_LC1'),true), 'value', 'text');
    $options[] = JHtml::_('select.option', 'DATE_FORMAT_LC2', $date_now->format(JText::_('DATE_FORMAT_LC2'),true), 'value', 'text');
    $options[] = JHtml::_('select.option', 'DATE_FORMAT_LC3', $date_now->format(JText::_('DATE_FORMAT_LC3'),true), 'value', 'text');
    $options[] = JHtml::_('select.option', 'DATE_FORMAT_LC4', $date_now->format(JText::_('DATE_FORMAT_LC4'),true), 'value', 'text');

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
