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




function getTquotesTextFile($params)
	{
		$filename=$params->get('filename','tquotes.txt');
		$path= JPATH_BASE."/modules/mod_tquotes/mod_tquotes/$filename";
		$cleanpath=JPATH::clean($path);
		$contents=JFile::read($cleanpath);
		$lines=explode("\n", $contents);
		$count=count($lines);
		$rows=explode("\n", $contents);
		$num=rand(0,$count-1);

		require(JModuleHelper::getLayoutPath('mod_tquotes','default'));
	}
 

function getTquotesTextFile2($params)

	{	
		$interval=$params->get('interval','z');
		$filename=$params->get('filename','tquotes.txt');
		$path= JPATH_BASE."/modules/mod_tquotes/mod_tquotes/$filename";
		$cleanpath=JPATH::clean($path);
		$contents=JFile::read($cleanpath);
		$lines=explode("\n", $contents);
		$count=count($lines);
		$rows=explode("\n", $contents);
		$dayofyear=date($interval);
		$num=($dayofyear % $count)-1;
		
	require(JModuleHelper::getLayoutPath('mod_tquotes','default'));	
	}
	
