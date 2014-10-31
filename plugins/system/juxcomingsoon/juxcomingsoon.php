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

jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.filesystem.file' );

class plgSystemJuxComingSoon extends JPlugin
{

    private $redirect = false;
    function plgSystemJuxComingSoon(& $subject, $config)
	{
            parent::__construct($subject, $config);
            $this->redirect = false;
	}
  
    private function extensionInstalled($name)
    {
    switch($name) {
      case 'com_acymailing':
        return include_once(JPATH_ADMINISTRATOR.'/components/com_acymailing/helpers/helper.php');
        break;
      case 'com_jnews':
        if (include_once(JPATH_SITE.'/components/com_jnews/defines.php'))
          return include_once(JPATH_ADMINISTRATOR.'/components/'.JNEWS_OPTION.'/classes/class.jnews.php');
        break;
    }
    return false;
    }

    private function getAcyMailingLists() {
    $acymailing_lists = $this->params->def('acymailing_lists', '');
    $listsClass = acymailing_get('class.list');
    $allLists = $listsClass->getLists('listid');
    $acyListsArray = array();
    if(acymailing_level(1)) {
      $allLists = $listsClass->onlyCurrentLanguage($allLists);
    }
    if(acymailing_level(3)){
    	$my = JFactory::getUser();
    	foreach($allLists as $listid => $oneList){
    		if(!$allLists[$listid]->published) continue;
    		if(!acymailing_isAllowed($oneList->access_sub)){
    			$allLists[$listid]->published = false;
    		}
    	}
    }
    if(strpos($acymailing_lists,',') OR is_numeric($acymailing_lists)){
    	$acymailing_lists = explode(',',$acymailing_lists);
    	foreach($allLists as $oneList){
    		if($oneList->published AND in_array($oneList->listid,$acymailing_lists)) $acyListsArray[] = $oneList->listid;
    	}
    }elseif($acymailing_lists == ''){
    	foreach($allLists as $oneList){
    		if(!empty($oneList->published)){$acyListsArray[] = $oneList->listid;}
    	}
    }
    return implode(',',$acyListsArray);
    }

    private function getMessages() {
		$buffer = '';
		$lists = null;
		$messages = JFactory::getApplication()->getMessageQueue();
		if (is_array($messages) && !empty($messages)) {
			foreach ($messages as $msg) {
				if (isset($msg['type']) && isset($msg['message']))
					$lists[$msg['type']][] = $msg['message'];
			}
		}

		if (is_array($lists)) {
			$buffer .= "\n<dl id=\"system-message\">";
			foreach ($lists as $type => $msgs)
			{
				if (count($msgs))
				{
					$buffer .= "\n<dt class=\"" . strtolower($type) . "\">" . JText::_($type) . "</dt>";
					$buffer .= "\n<dd class=\"" . strtolower($type) . " message\">";
					$buffer .= "\n\t<ul>";
					foreach ($msgs as $msg)
					{
						$buffer .= "\n\t\t<li>" . $msg . "</li>";
					}
					$buffer .= "\n\t</ul>";
					$buffer .= "\n</dd>";
				}
			}
			$buffer .= "\n</dl>";
		}
		return $buffer;
    }

    public function onAfterRender()   
    {
    // Process Login
    $session = JFactory::getSession();
    $app = JFactory::getApplication();
    
    // Process User group
    $params   = $this->params;
    $app = JFactory::getApplication();
    $user = JFactory::getUser() ;
    $userGroups = $user->getAuthorisedGroups();
    $cnx=0;
    $user_group = explode(',',$params->get('jux_group_user'));
    foreach ($user_group as $key => $row) {
      if(isset($user->groups[$row])) 
      {
        if($user->groups[$row] == $row ){
            $cnx = 1;
        }
        else{
          $cnx = 0;
          }
      }
    }

    // GetData Insert Countdown
    $jux_date_now = JFactory::getDate();
    $jux_date = $jux_date_now->tosql(true);
    $cyear = $this->params->def('cyear', '');
    $cmonth = $this->params->def('cmonth', '');
    $cday = $this->params->def('cday', '');
    $chour = $this->params->def('chour', '');
    $cminutes = $this->params->def('cminute', '');
    $cseconds = $this->params->def('csecond', '');
    //process if month, day, time <10
    $month = (int)$cmonth;
    if($month < 10){$cmonth = "0".$cmonth;}
    $day = (int)$cday;
    if($day < 10){$cmonth = "0".$cday;}
    $hour = (int)$chour;
    if($hour < 10){$chour = "0".$chour;}
    $minute = (int)$cminutes;
    if($minute < 10){$cminutes = "0".$cminutes;}
    $second = (int)$cseconds;
    if($second < 10){$cseconds = "0".$cseconds;}
    if($cnx == 0){
    if ($app->isSite()) {
      $can_display = false;
      // Process if insert value countdown
      $jux_countdown_launch_time = $this->params->def('jux_countdown_launch_time');
      $jux_calendar = $this->params->def('jux_calendar', '');
      
      if($jux_calendar != NULL){
      $calendar = explode(" ",$jux_calendar);
      $calendar_date = explode("-", $calendar[0]);
      $calendar_time = explode(":", $calendar[1]);
      }
      else{
        $calendar_date = array('','','');
        $calendar_time = array('','','');
      }
      
      if ($jux_countdown_launch_time == "2"){
        $calendar_date[0] = $cyear;
        $calendar_date[1] = $cmonth;
        $calendar_date[2] = $cday;
        $calendar_time[0] = $chour;
        $calendar_time[1] = $cminutes;
        $calendar_time[2] = $cseconds;
        $cdate = implode("-", $calendar_date);
        $ctime = implode(":", $calendar_time);
        $jux_calendar = $cdate." ".$ctime;
      }

      $online = $jux_calendar;
      // var_dump($online);die;
      $online_final = strtotime(date($online));
      $now_final = JFactory::getDate('now');
      $now_final->setTimeZone(new DateTimeZone($app->getCfg('offset')));
      $now_final = strtotime(date($now_final));

      // Process countdown flip
      $date = new DateTime($online);
      // Process Timeto Jquery
      $online_slide = $date->format('m d Y H:i:s');
      // $online = $this->params->def('jux_calendar', '');
      $get_filter = trim($this->params->def('get_filter', ''));
      $ip_filter = trim($this->params->def('ip_filter', ''));
      $acymailing_enabled = $this->params->def('maillist', 'none') == 'acymailing' && $this->extensionInstalled('com_acymailing');
      $jnews_enabled = $this->params->def('maillist', 'none') == 'jnews' && $this->extensionInstalled('com_jnews');
      if ($acymailing_enabled) {
        $maillist_lists = $this->getAcyMailingLists();
        // Backward compatibility. Will be removed.
        $acymailing_lists = $maillist_lists;
      }
      

      if ($online) {        
        $date_online = JFactory::getDate($online);
        $date_now = JFactory::getDate('now');
        $date_now->setTimeZone(new DateTimeZone($app->getCfg('offset')));
        $unix_now = $date_now->toUnix();
        $unix_now += $date_now->getOffsetFromGMT();

        if ($date_online->toUnix() <= $unix_now)
        { 
      	  $db = JFactory::getDBO();
          $query = $db->getQuery(true);
          $query->update('#__extensions')
                ->set('enabled=0')
                ->where('type="plugin"')
                ->where('element="juxcomingsoon"')
                ->where('folder="system"');
          $db->setQuery((string)$query);
          $db->query();
          $can_display = true;
        } else {
          $seconds_online = $date_online->toUnix() - $unix_now;
          $reloadtime_button = $seconds_online - 1;
          $reloadtime_auto = ($seconds_online-1) * 1000;
          $date_format = $this->params->def('date_format_lc', 'DATE_FORMAT_LC2');
          if ($date_format == 'custom') $date_format = $this->params->def('custom_date_format', '');
          else $date_format = JText::_($date_format);
          $date_online = $date_online->format($date_format);
        }
      } else {
        $seconds_online = 0;
        $date_online = false;
      }      
      if (!$can_display && $get_filter) {
        $can_display = $app->getUserStateFromRequest( $this->_name.".get_filter", $get_filter, '' );
      }
      if (!$can_display && $ip_filter) {
        $ip_filter = preg_split('/\s*\n\s*/', $ip_filter);
        $can_display = array_search($_SERVER['REMOTE_ADDR'], $ip_filter) !== false;
      }
      if (!$can_display && $acymailing_enabled) {
        $can_display = JRequest::getCmd('option') == 'com_acymailing'
          && JRequest::getCmd('task') == 'optin'
          && JRequest::getInt('ajax') == 1
          && JRequest::getCmd('ctrl') == 'sub'
          && JRequest::getString('hiddenlists') == $acymailing_lists;
      }
      if (!$can_display && $acymailing_enabled) {
        $can_display = JRequest::getCmd('option') == 'com_acymailing'
          && JRequest::getCmd('task') == 'confirm'
          && JRequest::getCmd('ctrl') == 'user';
        if ($can_display) $this->redirect = true;
      }
      if (!$can_display && $jnews_enabled) {
        $can_display = JRequest::getCmd('option') == 'com_jnews'
          && JRequest::getCmd('act') == 'noredsubscribe';
      }
      if (!$can_display && $jnews_enabled) {
        $can_display = JRequest::getCmd('option') == 'com_jnews'
          && JRequest::getCmd('act') == 'confirm';
        if ($can_display) $this->redirect = true;
      }
      if (!$can_display) {
        $custom_file = $this->params->def('custom_file', '');
                
  	    JResponse::setHeader('Content-Type', 'text/html; charset=utf-8');
        JResponse::sendHeaders();        

        $this->loadLanguage('', JPATH_ADMINISTRATOR);
        //GetData Tab Plugin
        $jux_font_style = $this->params->def('jux_font_style', '');
        $jux_font_custom = $this->params->def('jux_font_custom', '');
        // Process Font
        if($jux_font_style=="http://fonts.googleapis.com/css?family=Lato:300,400,300italic"){
          $jux_font_custom_name = "lato";
        }
        if($jux_font_style=="http://fonts.googleapis.com/css?family=Tangerine|Inconsolata|Droid+Sans"){
          $jux_font_custom_name = "Tangerine";
        }
        if($jux_font_style=="http://fonts.googleapis.com/css?family=Cantarell:italic|Droid+Serif:bold"){
          $jux_font_custom_name = "Cantarell";
        }
        if($jux_font_style=="custom"){
          $jux_font_custom_name = $this->params->def('jux_font_custom_name', '');;
        }
        
        $jux_text_color = $this->params->def('jux_text_color', '');
        $jux_background_style = $this->params->def('jux_background_style', '');
        $jux_login_form = $this->params->def('jux_login_form', '');
        $jux_contact_page = $this->params->def('jux_contact_page', '');
        $jux_about_page = $this->params->def('jux_about_page', '');
        $jux_homepage_email = $this->params->def('jux_homepage_email', '');
        $jux_background_image = $this->params->def('jux_background_image', '');
        $jux_background_video_image = $this->params->def('jux_background_video_image', '');
        // Process Onepage
        $onepage_string = "'homePage' ";
        if($jux_about_page =="1"){
          $onepage_string.=", 'aboutPage'";
        }
        if($jux_contact_page =="1"){
          $onepage_string.=", 'contactPage'";
        }
        if($jux_login_form =="1"){
          $onepage_string.=", 'loginPage'";
        }
        // var_dump($onepage_string);die;
        //GetData Metadata
        $jux_metadata_title = $this->params->def('jux_metadata_title', '');
        $jux_metadata_description = $this->params->def('jux_metadata_description', '');
        $jux_metadata_keywords = $this->params->def('jux_metadata_keywords', '');
        $jux_favicon = $this->params->def('jux_favicon', '');
        $jux_metadata_title = $this->params->def('jux_metadata_title', '');
        // GetData Homepage
        $jux_logo = $this->params->def('jux_logo', '');
        $jux_logo_effect = $this->params->def('jux_logo_effect', '');
        $jux_countdown_online = $this->params->def('jux_countdown_online', '');
        // Process logo effect
        if($jux_logo_effect == "0"){
          $jux_logo_effect="";
        }
        if($jux_logo_effect == "1"){
          $jux_logo_effect="pulse";
        }
        if($jux_logo_effect == "2"){
          $jux_logo_effect="pulse-grow";
        }
        if($jux_logo_effect == "3"){
          $jux_logo_effect="pulse-shrink";
        }
        $jux_homepage_overlay = $this->params->def('jux_homepage_overlay', '');
        $jux_overlay_color = $this->params->def('jux_overlay_color', '');
        $jux_overlay_color = str_replace("#", "", $jux_overlay_color);
        // GetDataCoutdown
        $jux_countdown_style = $this->params->def('jux_countdown_style', '');
        $jux_countdown_end_style = $this->params->def('jux_countdown_end_style', '');
        $jux_email = $this->params->def('jux_email', '');
        
        // Process color overlay
        if(strlen($jux_overlay_color) == 3) {
            $r = hexdec(substr($jux_overlay_color,0,1).substr($hex,0,1));
            $g = hexdec(substr($jux_overlay_color,1,1).substr($hex,1,1));
            $b = hexdec(substr($jux_overlay_color,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($jux_overlay_color,0,2));
            $g = hexdec(substr($jux_overlay_color,2,2));
            $b = hexdec(substr($jux_overlay_color,4,2));
        }
        $opacity = (float)$this->params->def('jux_overlay_opacity', '');
        $rgb = array($r, $g, $b,$opacity);
        $rgb = implode(",", $rgb);

        $jux_homepage_content = $this->params->def('jux_homepage_content', '');
        $jux_homepage_content_title = $this->params->def('jux_homepage_content_title', '');
        $jux_homepage_content_description = $this->params->def('jux_homepage_content_description', '');
        $jux_homepage_email = $this->params->def('jux_homepage_email', '');
        $jux_countdown_enable = $this->params->def('jux_countdown_enable', '');
        $jux_homepage_social_networks = $this->params->def('jux_homepage_social_networks', '');
        $custom_css = $this->params->def('custom_css', '');
        // GetData Login page
        $jux_logo_login = $this->params->def('jux_logo_login', '');
        $jux_login_title = $this->params->def('jux_login_title', '');
        $jux_login_intro = $this->params->def('jux_login_intro', '');
        // GetData Social Networks
        // target Link
        $jux_target = $this->params->def('jux_target', '');
        if($jux_target =="0"){
          $jux_target = "_blank";
        }
        if($jux_target =="1"){
          $jux_target = "_self";
        }
        // Get Options
        $jux_facebook_show = $this->params->def('jux_facebook_show');
        $jux_google_show = $this->params->def('jux_google_show');
        $jux_twitter_show = $this->params->def('jux_twitter_show');
        $jux_pinterest_show = $this->params->def('jux_pinterest_show');
        $jux_instagram_show = $this->params->def('jux_instagram_show');
        $jux_youtube_show = $this->params->def('jux_youtube_show');
        $jux_vimeo_show = $this->params->def('jux_vimeo_show');
        $jux_skype_show = $this->params->def('jux_skype_show');
        $jux_dribbble_show = $this->params->def('jux_dribbble_show');
        $jux_gigg_show = $this->params->def('jux_gigg_show');
        $jux_delicious_show = $this->params->def('jux_delicious_show');
        $jux_tumbler_show = $this->params->def('jux_tumbler_show');
        $jux_lastfm_show = $this->params->def('jux_lastfm_show');
        $jux_dropbox_show = $this->params->def('jux_dropbox_show');
        $jux_devianart_show = $this->params->def('jux_devianart_show');
        // Get Links
        $jux_facebook = $this->params->def('jux_facebook', '');
        $jux_google = $this->params->def('jux_google', '');
        $jux_twitter = $this->params->def('jux_twitter', '');
        $jux_pinterest = $this->params->def('jux_pinterest', '');
        $jux_instagram = $this->params->def('jux_instagram', '');
        $jux_youtube = $this->params->def('jux_youtube', '');
        $jux_vimeo = $this->params->def('jux_vimeo', '');
        $jux_skype = $this->params->def('jux_skype', '');
        $jux_dribbble = $this->params->def('jux_dribbble', '');
        $jux_gigg = $this->params->def('jux_gigg', '');
        $jux_delicious = $this->params->def('jux_delicious', '');
        $jux_tumbler = $this->params->def('jux_tumbler', '');
        $jux_lastfm = $this->params->def('jux_lastfm', '');
        $jux_dropbox = $this->params->def('jux_dropbox', '');
        $jux_devianart = $this->params->def('jux_devianart', '');
        //GetData Contact Page
        $jux_contact_us_email_title = $this->params->def('jux_contact_us_email_title');
        $jux_contact_us_email_description = $this->params->def('jux_contact_us_email_description');
        $jux_contact_us_info_title = $this->params->def('jux_contact_us_info_title');
        $jux_contact_us_info_description = $this->params->def('jux_contact_us_info_description');
        $jux_contact_us_map = $this->params->def('jux_contact_us_map');
        $jux_contact_us_map_show = $this->params->def('jux_contact_us_map_show');
        $jux_contact_us_street_show = $this->params->def('jux_contact_us_street_show');
        $jux_contact_us_phone_show = $this->params->def('jux_contact_us_phone_show');
        $jux_contact_us_email_show = $this->params->def('jux_contact_us_email_show');
        
        // Process default map
        if($jux_contact_us_map == NULL){
          $jux_contact_us_map="src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2483.6806277153723!2d-0.12462600000000001!3d51.500727999999995!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604c38c8cd1d9%3A0xb78f2474b9a45aa9!2sBig+Ben!5e0!3m2!1sen!2s!4v1411094777857\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\"";
        }
        $jux_contact_us_map = "<iframe ".$jux_contact_us_map."></iframe>";
        $jux_contact_us_street = $this->params->def('jux_contact_us_street');
        $jux_contact_us_zip = $this->params->def('jux_contact_us_zip');
        $jux_contact_us_city = $this->params->def('jux_contact_us_city');
        $jux_contact_us_phone = $this->params->def('jux_contact_us_phone');
        $jux_contact_us_email = $this->params->def('jux_contact_us_email');
        $jux_contact_us_country = $this->params->def('jux_contact_us_country');
        // GetData AboutUs page
        $jux_about_us = $this->params->def('jux_about_us');
        // GetData Video Tab
        $youtubeid = $this->params->def('youtubeid');
        $muteyt = $this->params->def('muteyt');
        if($muteyt=="1"){
          $muteyt = "true";
        }
        else{
          $muteyt = "false";
        }
        $loopyt = $this->params->def('loopyt');
        if($loopyt=="1"){
          $loopyt = "true";
        }
        else{
          $loopyt = "false";
        }
        $ratioyt = $this->params->def('muteyt');
        if($ratioyt =="1"){
          $ratioyt = "4/3";
        }
        else{
          $ratioyt = "16/9";
        }
        $startyt = $this->params->def('startyt');
        // GetData Tab Slideshow
        $slide_transition = $this->params->def('slide_transition');
        $slide_holdtime = $this->params->def('slide_holdtime');
        $slide_loop = $this->params->def('slide_loop');
        //Process Image Slide
        // $a=1;
        // echo '"z1":'.$a;die;
        $jux_image1 = $this->params->def('jux_image1');
        if($jux_image1=="1"){
          $jux_image1_source = $this->params->def('jux_image1_source');
          $jux_image1_effect = $this->params->def('jux_image1_effect');
          if(($jux_image1_source !=NULL) && ($jux_image1_effect != NULL)){
          switch ($jux_image1_effect) {
            case '1':
              $z1 = "z1";
              $z2 = "z2";
              $a11 = 1;
              $b11 = 1.5;
              break;
            case '2':
              $z1 = "z1";
              $z2 = "z2";
              $a21 = 2;
              $b21 = 1;
              break;
            case '3':
              $y1 = "y1";
              $y2 = "y2";
              $a31 = 0;
              $b31 = 200;
              break;
            case '4':
              $y1 = "y1";
              $y2 = "y2";
              $a41 = 200;
              $b41 = 0;
              break;
            case '5':
              $x1 = "x1";
              $x2 = "x2";
              $z1 = "z1";
              $a51 = 0;
              $b51 = 200;
              $c51 = 1;
              break;
            case '6':
              $x1 = "x1";
              $x2 = "z2";
              $z1 = "z1";
              $a61 = 1;
              $b61 = 200;
              $c61 = 0;
              break;
          }
        
        
        switch ($jux_image1_effect) {
            case '1':
                $jux_effect1 = '"z1":' . $a11 . ',' . '"z2":' . $b11;
                break;
            case '2':
                $jux_effect1 = '"z1":' . $a21 . ',' . '"z2":' . $b21;
                break;
            case '3':
                $jux_effect1 = '"y1":' . $a31 . ',' . '"y2":' . $b31;
                break;
            case '4':
                $jux_effect1 = '"y1":' . $a41 . ',' . '"y2":' . $b41;
                break;
            case '5':
                $jux_effect1 = '"x1":' . $a51 . ',' . '"x2":' . $b51 . ',' . '"z1":' . $c51;
                break;
            case '6':
                $jux_effect1 = '"x1":' . $a61 . ',' . '"x2":' . $b61 . ',' . '"z1":' . $c61;
                break;
        }
        }
        }  
        $jux_image2 = $this->params->def('jux_image2');
        if($jux_image2=="1"){
          $jux_image2_source = $this->params->def('jux_image2_source');
          $jux_image2_effect = $this->params->def('jux_image2_effect');
          if(($jux_image2_source !=NULL) && ($jux_image2_effect != NULL)){
          switch ($jux_image2_effect) {
            case '1':
              $z1 = "z1";
              $z2 = "z2";
              $a12 = 1;
              $b12 = 1.5;
              break;
            case '2':
              $z1 = "z1";
              $z2 = "z2";
              $a22 = 2;
              $b22 = 1;
              break;
            case '3':
              $y1 = "y1";
              $y2 = "y2";
              $a32 = 0;
              $b32 = 200;
              break;
            case '4':
              $y1 = "y1";
              $y2 = "y2";
              $a42 = 200;
              $b42 = 0;
              break;
            case '5':
              $x1 = "x1";
              $x2 = "x2";
              $z1 = "z1";
              $a52 = 0;
              $b52 = 200;
              $c52 = 1;
              break;
            case '6':
              $x1 = "x1";
              $x2 = "z2";
              $z1 = "z1";
              $a62 = 1;
              $b62 = 200;
              $c62 = 0;
              break;
          }
        
        switch ($jux_image2_effect) {
            case '1':
                $jux_effect2 = '"z1":' . $a12 . ',' . '"z2":' . $b12;
                break;
            case '2':
                $jux_effect2 = '"z1":' . $a22 . ',' . '"z2":' . $b22;
                break;
            case '3':
                $jux_effect2 = '"y1":' . $a32 . ',' . '"y2":' . $b32;
                break;
            case '4':
                $jux_effect2 = '"y1":' . $a42 . ',' . '"y2":' . $b42;
                break;
            case '5':
                $jux_effect2 = '"x1":' . $a52 . ',' . '"x2":' . $b52 . ',' . '"z1":' . $c52;
                break;
            case '6':
                $jux_effect2 = '"x1":' . $a62 . ',' . '"x2":' . $b62 . ',' . '"z1":' . $c62;
                break;
        }
      }
    }
        $jux_image3 = $this->params->def('jux_image3');
        if($jux_image3=="1"){
          $jux_image3_source = $this->params->def('jux_image3_source');
          $jux_image3_effect = $this->params->def('jux_image3_effect');
          if(($jux_image3_source !=NULL) && ($jux_image3_effect != NULL)){
          switch ($jux_image3_effect) {
            case '1':
              $z1 = "z1";
              $z2 = "z2";
              $a13 = 1;
              $b13 = 1.5;
              break;
            case '2':
              $z1 = "z1";
              $z2 = "z2";
              $a23 = 2;
              $b23 = 1;
              break;
            case '3':
              $y1 = "y1";
              $y2 = "y2";
              $a33 = 0;
              $b33 = 200;
              break;
            case '4':
              $y1 = "y1";
              $y2 = "y2";
              $a43 = 200;
              $b43 = 0;
              break;
            case '5':
              $x1 = "x1";
              $x2 = "x2";
              $z1 = "z1";
              $a53 = 0;
              $b53 = 200;
              $c53 = 1;
              break;
            case '6':
              $x1 = "x1";
              $x2 = "z2";
              $z1 = "z1";
              $a63 = 1;
              $b63 = 200;
              $c63 = 0;
              break;
          }
        
        switch ($jux_image3_effect) {
            case '1':
                $jux_effect3 = '"z1":' . $a13 . ',' . '"z2":' . $b13;
                break;
            case '2':
                $jux_effect3 = '"z1":' . $a23 . ',' . '"z2":' . $b23;
                break;
            case '3':
                $jux_effect3 = '"y1":' . $a33 . ',' . '"y2":' . $b33;
                break;
            case '4':
                $jux_effect3 = '"y1":' . $a43 . ',' . '"y2":' . $b43;
                break;
            case '5':
                $jux_effect3 = '"x1":' . $a53 . ',' . '"x2":' . $b53 . ',' . '"z1":' . $c53;
                break;
            case '6':
                $jux_effect3 = '"x1":' . $a63 . ',' . '"x2":' . $b63 . ',' . '"z1":' . $c63;
                break;
        }
      }
    }
        $jux_image4 = $this->params->def('jux_image4');
        if($jux_image4=="1"){
          $jux_image4_source = $this->params->def('jux_image4_source');
          $jux_image4_effect = $this->params->def('jux_image4_effect');
          if(($jux_image4_source !=NULL) && ($jux_image4_effect != NULL)){
          switch ($jux_image4_effect) {
            case '1':
              $z1 = "z1";
              $z2 = "z2";
              $a14 = 1;
              $b14 = 1.5;
              break;
            case '2':
              $z1 = "z1";
              $z2 = "z2";
              $a24 = 2;
              $b24 = 1;
              break;
            case '3':
              $y1 = "y1";
              $y2 = "y2";
              $a34 = 0;
              $b34 = 200;
              break;
            case '4':
              $y1 = "y1";
              $y2 = "y2";
              $a44 = 200;
              $b44 = 0;
              break;
            case '5':
              $x1 = "x1";
              $x2 = "x2";
              $z1 = "z1";
              $a54 = 0;
              $b54 = 200;
              $c54 = 1;
              break;
            case '6':
              $x1 = "x1";
              $x2 = "z2";
              $z1 = "z1";
              $a64 = 1;
              $b64 = 200;
              $c64 = 0;
              break;
          }
        
        switch ($jux_image4_effect) {
            case '1':
                $jux_effect4 = '"z1":' . $a14 . ',' . '"z2":' . $b14;
                break;
            case '2':
                $jux_effect4 = '"z1":' . $a24 . ',' . '"z2":' . $b24;
                break;
            case '3':
                $jux_effect4 = '"y1":' . $a34 . ',' . '"y2":' . $b34;
                break;
            case '4':
                $jux_effect4 = '"y1":' . $a44 . ',' . '"y2":' . $b44;
                break;
            case '5':
                $jux_effect4 = '"x1":' . $a54 . ',' . '"x2":' . $b54 . ',' . '"z1":' . $c54;
                break;
            case '6':
                $jux_effect4 = '"x1":' . $a64 . ',' . '"x2":' . $b64 . ',' . '"z1":' . $c64;
                break;
        }
      }
    }
        $jux_image5 = $this->params->def('jux_image5');
        if($jux_image5=="1"){
          $jux_image5_source = $this->params->def('jux_image5_source');
          $jux_image5_effect = $this->params->def('jux_image5_effect');
          if(($jux_image5_source !=NULL) && ($jux_image5_effect != NULL)){
          switch ($jux_image5_effect) {
            case '1':
              $z1 = "z1";
              $z2 = "z2";
              $a15 = 1;
              $b15 = 1.5;
              break;
            case '2':
              $z1 = "z1";
              $z2 = "z2";
              $a25 = 2;
              $b25 = 1;
              break;
            case '3':
              $y1 = "y1";
              $y2 = "y2";
              $a35 = 0;
              $b35 = 200;
              break;
            case '4':
              $y1 = "y1";
              $y2 = "y2";
              $a45 = 200;
              $b45 = 0;
              break;
            case '5':
              $x1 = "x1";
              $x2 = "x2";
              $z1 = "z1";
              $a55 = 0;
              $b55 = 200;
              $c55 = 1;
              break;
            case '6':
              $x1 = "x1";
              $x2 = "z2";
              $z1 = "z1";
              $a65 = 1;
              $b65 = 200;
              $c65 = 0;
              break;
          }
        
        switch ($jux_image5_effect) {
            case '1':
                $jux_effect5 = '"z1":' . $a15 . ',' . '"z2":' . $b15;
                break;
            case '2':
                $jux_effect5 = '"z1":' . $a25 . ',' . '"z2":' . $b25;
                break;
            case '3':
                $jux_effect5 = '"y1":' . $a35 . ',' . '"y2":' . $b35;
                break;
            case '4':
                $jux_effect5 = '"y1":' . $a45 . ',' . '"y2":' . $b45;
                break;
            case '5':
                $jux_effect5 = '"x1":' . $a55 . ',' . '"x2":' . $b55 . ',' . '"z1":' . $c55;
                break;
            case '6':
                $jux_effect5 = '"x1":' . $a65 . ',' . '"x2":' . $b65 . ',' . '"z1":' . $c65;
                break;
        }
      }
    }
        // Process Playlist
        $playlist = "[";
        if($jux_image1 =="1"){
          $playlist.="{\"url\":'".JURI::base().$jux_image1_source;
          $playlist.="',\"slide\":{".$jux_effect1."}},";
        }
        if($jux_image2 =="1"){
          $playlist.="{\"url\":'".JURI::base().$jux_image2_source;
          $playlist.="',\"slide\":{".$jux_effect2."}},";
        }
        if($jux_image3 =="1"){
          $playlist.="{\"url\":'".JURI::base().$jux_image3_source;
          $playlist.="',\"slide\":{".$jux_effect3."}},";
        }
        if($jux_image4 =="1"){
          $playlist.="{\"url\":'".JURI::base().$jux_image4_source;
          $playlist.="',\"slide\":{".$jux_effect4."}},";
        }
        if($jux_image5 =="1"){
          $playlist.="{\"url\":'".JURI::base().$jux_image5_source;
          $playlist.="',\"slide\":{".$jux_effect5."}}";
        }
        $playlist.="]";
        // GetData Countdown time
        // County Style Data
        $county_reflection = $this->params->def('county_reflection');
        if( $county_reflection == "0"){
          $county_reflection = "false";
        }
        if( $county_reflection == "1"){
          $county_reflection = "true";
        }
        $county_animation = $this->params->def('county_animation');
        $county_theme = $this->params->def('county_theme');
        // Circles data
        $circle_day_color = $this->params->def('circle_day_color');
        $circle_day_border = $this->params->def('circle_day_border');
        $circle_hour_color = $this->params->def('circle_hour_color');
        $circle_hour_border = $this->params->def('circle_hour_border');
        $circle_minute_color = $this->params->def('circle_minute_color');
        $circle_minute_border = $this->params->def('circle_minute_border');
        $circle_second_color = $this->params->def('circle_second_color');
        $circle_second_border = $this->params->def('circle_second_border');
        //Timeto Style
        $timeto_style = $this->params->def('timeto_style');
        $timeto_style_alert = $this->params->def('timeto_style_alert');
        $timeto_style_days_number = $this->params->def('timeto_style_days_number');
        
   
        
        $admin_email = $this->params->def('admin_email', '');
        $maillist_text = $this->params->def('maillist_text', '');
        $maillist_name = $this->params->def('maillist_name', 1);
        $messages = $this->getMessages();
        if ($this->params->def('prepare_content', 0)) {
          $title = JHtml::_('content.prepare', $title);
          $text = JHtml::_('content.prepare', $text); 
          $maillist_text = JHtml::_('content.prepare', $maillist_text);
        }
        
        if ($custom_file && JFile::exists(JPATH_BASE.'/'.$custom_file)) {
          require(JPATH_BASE.'/'.$custom_file);
        } else {                  
          require(JPATH_BASE.'/media/plg_juxcomingsoon/soon.php');
        }
        $app->close();
      }
    }
  }	
}
  public function onAfterDispatch()
  {
    if ($this->redirect) {
      $app = JFactory::getApplication();
      $app->redirect('/');
    }
  }
}