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

<div class="width-100">
<fieldset class="adminform">
  <legend><?php echo JText::_('COM_SH404SEF_ANALYTICS_PERF_DATA'); ?></legend>
        
    <table class="admintable" cellspacing="1" width="100%">
      <tbody>
        <tr>
          <td width="50%" style="vertical-align: top;">
            <table>
              <?php  $title = JText::_('COM_SH404SEF_ANALYTICS_AVG_CREATION_TIME') . '::' . JText::_('COM_SH404SEF_ANALYTICS_TT_AVG_CREATION_TIME'); ?>
              <tr class="hasAnalyticsTip" title="<?php echo $title;?>"> 
                <td width="50%" style="text-align: right;" >
                <?php echo JText::_( 'COM_SH404SEF_ANALYTICS_AVG_CREATION_TIME' ); ?>&nbsp;
                </td>
                <td width="50%" class="key" style="text-align: left;">
                  <?php echo $this->escape(sprintf( '%0.2f', $this->analytics->analyticsData->perf->avgPageCreationTime)) . ' s.'; ?> 
                </td>
              </tr>
              
              <?php  $title = JText::_('COM_SH404SEF_ANALYTICS_AVG_MEMORY_USED') . '::' . JText::_('COM_SH404SEF_ANALYTICS_TT_AVG_MEMORY_USED'); ?>
              <tr class="hasAnalyticsTip" title="<?php echo $title;?>">   
                <td width="50%" style="text-align: right;" >
                <?php echo JText::_( 'COM_SH404SEF_ANALYTICS_AVG_MEMORY_USED' ); ?>&nbsp;
                </td>
                <td width="50%" class="key" style="text-align: left;">
                  <?php echo $this->escape(sprintf( '%0.1f', $this->analytics->analyticsData->perf->avgMemoryUsed)) . ' Mb'; ?> 
                </td>
              </tr>
            </table>
          </td>
          
          <td width="50%" style="vertical-align: top;">
            <table>
              <?php  $title = JText::_('COM_SH404SEF_ANALYTICS_USER_STATUS') . '::' . JText::_('COM_SH404SEF_ANALYTICS_TT_USER_STATUS'); ?>
              <tr class="hasAnalyticsTip" title="<?php echo $title;?>">   
                <td width="50%" style="text-align: right;" >
                <?php echo JText::_( 'COM_SH404SEF_ANALYTICS_USER_STATUS' ); ?>&nbsp;
                </td>
                <td width="50%" class="key" style="text-align: left;">
                   <?php echo $this->escape(sprintf( '%0.1f', $this->analytics->analyticsData->perf->loggedInUserRate * 100)) . ' %'; ?> 
                </td>
              </tr>
            </table>
          </td>
        </tr>
        
      </tbody>
      
    </table>
          
</fieldset>
</div>
