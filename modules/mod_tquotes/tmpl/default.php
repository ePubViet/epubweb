<?php 
/*------------------------------------------------------------------------
# mod_tquotes 
# ------------------------------------------------------------------------
# author    Kevin Burke
# copyright Copyright (C) 2012 Mytidbits.us All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.mytidbits.us
# Technical Support:  Forum - http://www.mytidbits.us/forum
-------------------------------------------------------------------
*/ 
//no direct access
defined('_JEXEC') or die('Restricted access'); 

//get css file
$css = JURI::base().'modules/mod_tquotes/assets/tquote.css';
$document = JFactory::getDocument();
$document->addStyleSheet($css);
 
 // get admin style params
$style_method=$params->get('style_method');
$filename=$params->get('filename','tquotes.txt');
$text_color=$params->get('text_color');
$background=$params->get('background');
$fontweight=$params->get('font-weight');
$fontsize=$params->get('font-size');
$fontstyle=$params->get('font-style');
$sep=$params->get('sep');
$quotemarks=$params->get('quotemarks');
$quotemarks=$params->get('quotemarks');
$moduleclass_sfx=$params->get('moduleclass_sfx');
if($sep)
{
$quote = $rows[$num];
	
		$parts=explode($sep,$quote);
	
		$quote= $parts[0];
	//	$author=$parts[1];
		$author=&$parts[1];
}
else
		$quote = $rows[$num];
		
		
 if($style_method==0)	: //inherit template display options ?>
 	
 		<div class="tquotes<?php echo $moduleclass_sfx; ?>">
 	<?php echo $quote;?>
	<div align = "right">
	<?php echo $author; ?>
	</div></div>
	<?php endif; ?> 
	

	<?php if($style_method==1)	: //below options ?>



	
<?php		if($quotemarks==0)	:	// no quotemarks ?>

	
 	<div style="color:<?php echo $text_color;?>;
	background:<?php echo $background; ?> ;
	font-weight:<?php echo $fontweight; ?> ;
	font-size:<?php echo $fontsize;?> ;
	font-style:<?php echo $fontstyle;?> "> 
 	<?php echo $quote?>
 	
 	</div>
 
	<div align = "right"  
   style="color:<?php echo $text_color;?>;
   background:<?php echo $background?>;
  	font-weight:<?php echo$fontweight;?>;
  	font-size:<?php echo $fontsize;?>">
   <?php echo $author?></div>
			
	<?php		else : 	//include quotemarks ?>
			 
	<div style="color:<?php echo $text_color;?>;
	background:<?php echo $background; ?> ;
	font-weight:<?php echo $fontweight; ?> ;
	font-size:<?php echo $fontsize;?>;
	font-style:<?php echo $fontstyle;?>" >"
	<?php echo $quote?>"</div>
 
				<div align = "right" ; 
 style="color:<?php echo $text_color;?>;
 background:<?php echo $background?>;
 font-weight:<?php echo$fontweight;?>;
 font-size:<?php echo $fontsize;?>;
 font-style:<?php echo $fontstyle;?>" >
 <?php echo $author?></div>
	<?php endif; ?>
	
	
		
			
	
	<?php elseif($style_method==2)	: //css file
	
		if($quotemarks==0)	:	// no quotemarks ?>
	
		<div class="mod_tquote_quote_text_file"><?php echo $quote; ?><br></div>
		<div class="mod_tquote_author_text_file"> <?php echo $author; ?><br></div>
		
 
 <?php	elseif($quotemarks==1)	:	//  quotemarks yes ?>

	<div class="mod_tquote_css"><p><span><?php echo $quote;?> </p></span>
	  <div class="mod_tquote_author_text_file"><?php echo $author; ?></div></div>
<?php endif; //quotemarks ?>


	<?php endif; //style method ?>
	

