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

// Security check to ensure this file is being included by a parent file.
if (!defined('_JEXEC')) die('Direct Access to this location is not allowed.');

?>

<table>
  <tr>
    <td align="left" nowrap="nowrap">
      <?php echo JText::_( 'Search' ); ?>:
      <input type="text" name="search_all" id="search_all" value="<?php echo $this->options->search_all;?>" size="35" maxlength="255" class="text_area" onchange="document.adminForm.limitstart.value=0;document.adminForm.submit();" />
      <button onclick="document.adminForm.limitstart.value=0;this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
      <button onclick="document.adminForm.limitstart.value=0;document.getElementById('search_all').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
    </td>
  </tr>
</table>