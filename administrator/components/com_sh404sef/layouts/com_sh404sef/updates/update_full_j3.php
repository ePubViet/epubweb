<?php
/**
 * sh404SEF - SEO extension for Joomla!
 *
 * @author      Yannick Gaultier
 * @copyright   (c) Yannick Gaultier 2014
 * @package     sh404SEF
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     4.4.4.1791
 * @date		2014-07-01
 */

defined('_JEXEC') or die;

/**
 * This layout displays a button to allow one-click update
 */

$button = ShlHtmlBs_Helper::button(JText::_('COM_SH404SEF_PERFORM_UPDATE'));
echo '<div id="sh-update-button" ><a href="index.php?option=com_sh404sef&view=liveupdate&task=startupdate&skipnag=1" onclick="javascript: shUpdateButtonClick();" >' . $button .'</a></div>';
