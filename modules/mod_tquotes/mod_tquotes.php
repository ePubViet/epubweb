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
if(!defined('DS')){
define('DS',DIRECTORY_SEPARATOR);
error_reporting(0);
}

	//include helper file	
	require_once(dirname(__FILE__).DS.'helper.php'); 

	




$interval=$params->get('interval');

if ($interval=='random')
{

$list=getTquotesTextFile ($params);
}
else
{
$list=getTquotesTextFile2($params);
}

