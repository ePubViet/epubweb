<?php
/**
 * @version   $id: $
 * @author    JoomlaUX!
 * @package   Joomla!
 * @subpackage  plg_system_juxcomingsoon
 * @copyright Copyright (C) 2012 - 2014 by Joomlaux. All rights reserved.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL version 3, See LICENSE.txt
 */
require_once JPATH_SITE . '/components/com_users/helpers/route.php';
require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

defined('_JEXEC') or die('Restricted access');
$load_mootools = $seconds_online || $background_image || $acymailing_enabled;
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <base href="<?php echo JURI::base(); ?>" />
            <meta content="IE=edge" http-equiv="X-UA-Compatible" />
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <!-- <meta http-equiv="content-type" content="text/html; charset=utf-8" /> -->
            <meta name="robots" content="index, follow" />
            <meta name="generator" content="JUX Coming Soon" />
            <!-- Process keywords -->
            <meta name="keywords" content="<?php echo $jux_metadata_keywords; ?>" />
            <!-- Process description -->
            <meta name="description" content="<?php echo $jux_metadata_description; ?>" />
            <!-- Process metadata title -->
            <title><?php echo $jux_metadata_title ?></title>
            <!-- Add CSS -->
            <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/bootstrap.min.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/font-awesome.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/stylesoon.css" type="text/css" />
            <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/jquery.fullPage.css" type="text/css" />

            <!-- Process Import Css Countdown -->
            <?php if ($jux_countdown_style == "1") { ?>
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/kinetic.css" type="text/css" />
            <?php } ?>
            <?php if ($jux_countdown_style == "2") { ?>
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/county.css" type="text/css" />
            <?php } ?>
            <?php if ($jux_countdown_style == "4") { ?>
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/slide_main.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/timeTo.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/slide_dark.css" type="text/css" />
            <?php } ?>
            <?php if ($jux_countdown_style == "5") { ?>
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/flipclock.css" type="text/css" />
            <?php } ?>
            <?php if ($jux_background_style == "1") { ?>
                <link rel="stylesheet" href="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/css/smooth_slider.css" type="text/css" />
            <?php } ?>
            <!-- Process Font Import Fonts Style -->
            <?php if ($jux_font_style == "custom") { ?>
                <link rel="stylesheet" href="<?php echo $jux_font_custom; ?>" type="text/css" />
            <?php } else { ?>
                <link rel="stylesheet" href="<?php echo $jux_font_style; ?>" type="text/css" />
            <?php } ?>
            <!-- Load JS Libraries -->
            <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.min.js" type="text/javascript"></script>
            <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery-ui.min.js" type="text/javascript"></script>
            <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/bootstrap.min.js" type="text/javascript"></script>
            <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.fullPage.js" type="text/javascript"></script>
            <!-- Process Import Countdown JS -->
            <?php if ($jux_countdown_style == "1") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/kinetic.js" type="text/javascript"></script>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.final-countdown.js" type="text/javascript"></script>
            <?php } ?>
            <?php if ($jux_countdown_style == "2") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/county.js" type="text/javascript"></script>
            <?php } ?>
            <?php if ($jux_countdown_style == "3") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.countdown.js" type="text/javascript"></script>
            <?php } ?>
            <?php if ($jux_countdown_style == "4") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.timeTo.js" type="text/javascript"></script>
            <?php } ?>
            <?php if ($jux_countdown_style == "5") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/flipclock.js" type="text/javascript"></script>
            <?php } ?>
            
            <!-- Process Import Background video JS -->
            <?php if ($jux_background_style == "2") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery.tubular.1.0.js" type="text/javascript"></script>
            <?php } ?>
            <!-- Process Import Background slideshow JS -->
            <?php if ($jux_background_style == "1") { ?>
                <script src="<?php echo JURI::root(true); ?>/media/plg_juxcomingsoon/javascript/jquery-slider.js" type="text/javascript"></script>
            <?php } ?>
            <!-- Process favicon -->
            <?php if ($jux_favicon) { ?>
                <link type="image/x-icon" rel="shortcut icon" href="<?php echo JURI::root(true) . '/'; ?><?php echo $jux_favicon; ?>">
                <?php } ?>
                <!-- Process -->
                <?php if ($load_mootools) { ?>
                    <script src="<?php echo JURI::root(true); ?>/media/system/js/mootools-core.js" type="text/javascript"></script>
                <?php } ?>
                <!-- Process seconds_online(countdown) -->
                <?php if ($seconds_online) { ?>  
                <?php } ?>

                <!-- Process acymailing -->
                <?php if ($acymailing_enabled) { ?>
                    <script src="<?php echo JURI::root(true); ?>/media/com_acymailing/js/acymailing_module.js" type="text/javascript"></script>
                    <?php acymailing_initJSStrings(''); ?>
                <?php } ?>
                <!-- Process slideshow CSS -->
                <?php if ($jux_background_style == "1") { ?>
                    <style>
                        html,body { /* For full page slideshow that spans entire page (with no other content), the below CSS is needed */
                            height:100%;
                            padding:0px;
                            margin:0px;
                        }
                    </style>
                <?php } ?>
                <!-- Process Custom CSS -->
                <?php if ($custom_css) { ?>
                    <style type="text/css">
                        <!--
                        <?php echo $custom_css; ?>
                        -->
                    </style>  
                <?php } ?>
                <style type="text/css">
                    #ref_butn.hidden {
                        display: none;
                    }
                </style>
                <!-- Process Check On Mobile Devices -->
                <script>
                    jQuery(document).ready(function($){
                        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                            $(".overlay_video").css("z-index","2");
                        }
                    });
                   
                </script>
                <!-- .Process Reload page --> 
                <?php if ($jux_countdown_end_style == "1") { ?>
                <script>
                function ReloadPage() {
                    window.location.reload(true);
                    };
                $(document).ready(function() {
                var timeout = parseInt(<?php echo $reloadtime_auto ;?>);
                if(timeout>2147483647){//max value of parameter because use 32bit
                        timeout = 2147483647;
                    }
                    else{
                        timeout = timeout;
                    }
                setTimeout("ReloadPage()", timeout);
                });
                </script>
                <?php } ?>
                <?php if ($jux_countdown_end_style == "2") { ?>
                <script>
                jQuery(document).ready(function($){
                    var count = <?php echo $reloadtime_button ;?>;
                    var timerID = setInterval(function() {
                             if(count > 0){
                                $('#showcount').html(Math.floor(count-=1));
                             } else {               
                                $('#ref_butn').removeClass('hidden');
                             }
                    }, 1000 );
                 });
                </script>
                <script>
                $(document).ready(function(){
                  $("#ref_butn").click(function(){
                 location.reload();
                  });
                });
                </script>
                <?php } ?>
                <!-- Sendmail -->
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#submit_btn").click(function() { 
                           
                            var proceed = true;
                            //simple validation at client's end
                            //loop through each field and we simply change border color to red for invalid fields       
                            $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
                                $(this).css('border-color',''); 
                                if(!$.trim($(this).val())){ //if this field is empty 
                                    $(this).css('border-color','red'); //change border color to red   
                                    proceed = false; //set do not proceed flag
                                }
                                //check invalid email
                                var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
                                if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                                    $(this).css('border-color','red'); //change border color to red   
                                    proceed = false; //set do not proceed flag              
                                }   
                            });
                           
                            if(proceed) //everything looks good! proceed...
                            {
                                //get input field values data to be sent to server
                                post_data = {
                                    'to_email'     : $('input[name=to_email]').val(), 
                                    'user_name'     : $('input[name=name]').val(), 
                                    'user_email'    : $('input[name=email]').val(), 
                                    'subject'       : $('input[name=subject]').val(), 
                                    'msg'           : $('textarea[name=message]').val()
                                };
                                
                                //Ajax post data to server
                                $.post('<?php echo JURI::base()."media/plg_juxcomingsoon/contact_me.php";?>', post_data, function(response){  
                                    if(response.type == 'error'){ //load json data from server and output message     
                                        output = '<div class="error">'+response.text+'</div>';
                                    }else{
                                        output = '<div class="success">'+response.text+'</div>';
                                        //reset values in all input fields
                                        $("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
                                        $("#contact_form #contact_body").slideUp(); //hide form after success
                                    }
                                    $("#contact_form #contact_results").hide().html(output).slideDown();
                                }, 'json');
                            }   
                        });
                        
                        //reset previously set border colors and hide all message on .keyup()
                        $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
                            $(this).css('border-color',''); 
                            $("#result").slideUp();
                        });
                    });
                    </script> 
                </head>
                
                <body style="color:<?php echo $jux_text_color;?>;">
                <?php 
                $document = JFactory::getDocument();
              // Add styles
                  $style = 'body {'
                          . 'background: #000!important;'
                          . '}'; 
                          // echo $style;
                  $document->addStyleSheet($style);
                ?>
                    <?php if ($jux_background_style == "2"): ?>
                        <div class="overlay_video" style="background:url('<?php echo Juri::base() . $jux_background_video_image; ?>') no-repeat top left; position:absolute;top:0;left:0;width:100%;height:100%; background-size: cover;"></div>
                    <?php endif; ?>
                    <ul id="menu">
                        <li data-menuanchor="homePage"><a href="#homePage"><i class="fa fa-home menu_onepage"></i></a></li>
                        <?php if ($jux_about_page == "1"): ?>
                        <li data-menuanchor="aboutPage"><a href="#aboutPage"><i class="fa fa-user menu_onepage"></i></a></li>
                        <?php endif;?>
                        <?php if ($jux_contact_page == "1"): ?>
                        <li data-menuanchor="contactPage"><a href="#contactPage"><i class="fa fa-envelope-o menu_onepage"></i></a></li>
                        <?php endif;?>
                        <?php if ($jux_login_form == "1"): ?>
                        <li data-menuanchor="loginPage"><a href="#loginPage"><i class="fa fa-sign-in menu_onepage"></i></a></li>
                        <?php endif;?>
                    </ul>
                    <?php if ($jux_background_style == "0"): ?>
                        <div class="overlay" style="background:url('<?php echo Juri::base() . $jux_background_image; ?>') no-repeat top left; position:absolute;top:0;left:0;width:100%;height:100%; background-size:cover;"></div>
                    <?php endif; ?>
                    <?php if ($jux_background_style == "1"): ?>
                        <div id="throbber"><img src="<?php echo Juri::base() ?>media/plg_juxcomingsoon/images/throbber.gif"></div>
                        <div id="resume" style="display:none">Replay</div>
                        <div id="pan_area" style="height:100%;position:fixed;top:0px;width:100%;z-index:1;"></div>
                        <div id="img_msg_area" style="display:none"><span></span></div>
                        <div id="static_text_area" style="display:none">There is nothing more amazing than nature, the miracle that is every creature in her domain. The birds, the lions, down to every insect, together they form the circle of life that supports each other.</div>
                    <?php endif; ?>
                    <?php if ($jux_homepage_overlay == "1"): ?>
                        <div class="bg_overlay" style="background-color:rgba(<?php echo $rgb; ?>)"></div>
                    <?php endif; ?>
                    
                    <div id="container">
                        <div class="section" id="section0">
                            <div class="intro">
                                <div class="wrapper container">
                                    <div class="header" style="text-align:center">
                                        <?php if ($jux_logo != NULL): ?><!-- Process Logo -->
                                            <img class="vcb_logo <?php echo $jux_logo_effect; ?> img-responsive" src="<?php echo $jux_logo ?>" alt="logo" />
                                        <?php endif; ?>
                                    </div><!-- /.header -->
                                    <div class="main">
                                        <?php if ($jux_homepage_content == "1"): ?><!-- Process Homepage Content -->
                                            <div class="vcb_messages">
                                                <h2 class="title"><?php echo $jux_homepage_content_title ?></h2>
                                                <h3 class="caption"><?php echo $jux_homepage_content_description ?></h3>
                                            </div><!-- /.messages -->
                                        <?php endif; ?>
                                        <?php if (($seconds_online) && ($jux_countdown_enable == "1")): ?><!-- Process Countdown -->
                                            <div class="row vcb_countdown">
                                                <?php if ($jux_countdown_style == "1"): ?><!-- /.timecircle -->
                                                    <div class="countdown-container container">
                                                        <div class="clock row">

                                                            <!-- days -->
                                                            <div class="clock-item clock-days countdown-time-value col-sm-6 col-md-3">
                                                                <div class="wrap">
                                                                    <div class="inner">
                                                                        <div id="canvas_days" class="clock-canvas"></div>
                                                                        <div class="text">
                                                                            <p class="val">0</p>
                                                                            <p class="type-days type-time">DAYS</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- hours -->

                                                            <div class="clock-item clock-hours countdown-time-value col-sm-6 col-md-3">
                                                                <div class="wrap">
                                                                    <div class="inner">
                                                                        <div id="canvas_hours" class="clock-canvas"></div>
                                                                        <div class="text">
                                                                            <p class="val">0</p>
                                                                            <p class="type-hours type-time">HOURS</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- minutes -->
                                                            <div class="clock-item clock-minutes countdown-time-value col-sm-6 col-md-3">
                                                                <div class="wrap">
                                                                    <div class="inner">
                                                                        <div id="canvas_minutes" class="clock-canvas"></div>
                                                                        <div class="text">
                                                                            <p class="val">0</p>
                                                                            <p class="type-minutes type-time">MINUTES</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- seconds -->
                                                            <div class="clock-item clock-seconds countdown-time-value col-sm-6 col-md-3">
                                                                <div class="wrap">
                                                                    <div class="inner">
                                                                        <div id="canvas_seconds" class="clock-canvas"></div>
                                                                        <div class="text">
                                                                            <p class="val">0</p>
                                                                            <p class="type-seconds type-time">SECONDS</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($jux_countdown_style == "2"): ?><!-- /.county -->
                                                    <div id="county_style"></div>
                                                <?php endif; ?>
                                                <?php if ($jux_countdown_style == "3"): ?><!-- /.normal -->
                                                    <div id="clock"></div>
                                                <?php endif; ?>
                                                <?php if ($jux_countdown_style == "4"): ?><!-- /.counter -->
                                                    <div id="time_to"></div>
                                                <?php endif; ?>
                                                <?php if ($jux_countdown_style == "5"): ?><!-- /.flip -->
                                                    <div id="flipclock" style="margin:2em;"></div>
                                                <?php endif; ?>
                                                <button id="showcount" style="display:none"></button>
                                                <button id="ref_butn" class="hidden">Refresh the page</button>
                                            </div>
                                            <?php if ($jux_countdown_online == "1"): ?>
                                                <h3 class="online_time"><p><?php echo JText::_('PLG_SYSTEM_JUXCOMINGSOON_DATE_ONLINE') . ' ' . $date_online; ?></p></h3>
                                            <?php endif; ?>
                                        <?php endif; ?><!-- /.vcb_countdown -->
                                    </div><!-- /.main -->
                                    
                                    <div class="footer">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--Message subcrible mail-->
                                                <?php if ($jux_homepage_email == "1"): ?>
                                                    <div class="block-email">
                                                        <div id="system-message-container" class="maillistWrapper">
                                                        </div>
                                                        <div id="acymailing_module_formAcymailing" class="maillistWrapper<?php echo $maillist_name ? '' : ' maillistNoName'; ?>">
                                                            <div id="acymailing_fulldiv_formAcymailing">
                                                                <form name="formAcymailing" method="post" onsubmit="return submitacymailingform('optin', 'formAcymailing')" action="<?php echo JURI::root(true); ?>/index.php" id="formAcymailing">
                                                                    <i class="fa fa-envelope-o"></i>
                                                                    <span class="acyfield_email"><input type="text" size="50" name="user[email]" id="user_email_formAcymailing" placeholder="Enter your email here to stay tuned"/>
                                                                        <button type="submit" onclick="try{ return submitacymailingform('optin', 'formAcymailing'); } catch (err){alert('The form could not be submitted ' + err); return false; }" ><i class="fa fa-arrow-circle-right fa-lg"></i></button>
                                                                    </span>
                                                                    <input type="hidden" value="1" name="ajax" />
                                                                    <input type="hidden" value="sub" name="ctrl" />
                                                                    <input type="hidden" value="optin" name="task" />
                                                                    <input type="hidden" value="com_acymailing" name="option" />
                                                                    <input type="hidden" value="<?php echo $maillist_lists; ?>" name="hiddenlists" />
                                                                </form>
                                                            </div>
                                                        </div><!-- /.acymailing -->
                                                    </div>
                                                <?php endif; ?>
                                            </div><!-- /.col-md-6 -->
                                        </div><!-- /.row -->
                                        <div class="clearfix"></div><!-- /.clearfix -->
                                        <?php if ($jux_homepage_social_networks == "1"): ?>
                                            <ul class="social">
                                                <?php if($jux_facebook_show == "1"): ?>
                                                <li><a href="<?php echo $jux_facebook ?>" target="<?php echo $jux_target ?>"><i class="fa fa-facebook jux_facebook"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_google_show == "1"): ?>
                                                <li><a href="<?php echo $jux_twitter ?>" target="<?php echo $jux_target ?>"><i class="fa fa-twitter jux_twitter"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_twitter_show == "1"): ?>
                                                <li><a href="<?php echo $jux_google ?>" target="<?php echo $jux_target ?>"><i class="fa fa-google-plus jux_google_plus"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_pinterest_show == "1"): ?>
                                                <li><a href="<?php echo $jux_pinterest ?>" target="<?php echo $jux_target ?>"><i class="fa fa-pinterest jux_pinterest"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_instagram_show == "1"): ?>
                                                <li><a href="<?php echo $jux_instagram ?>" target="<?php echo $jux_target ?>"><i class="fa fa-instagram jux_instagram"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_youtube_show == "1"): ?>
                                                <li><a href="<?php echo $jux_youtube ?>" target="<?php echo $jux_target ?>"><i class="fa fa-youtube-square jux_youtube"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_vimeo_show == "1"): ?>
                                                <li><a href="<?php echo $jux_vimeo ?>" target="<?php echo $jux_target ?>"><i class="fa fa-vimeo-square jux_vimeo"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_skype_show == "1"): ?>
                                                <li><a href="<?php echo $jux_skype ?>" target="<?php echo $jux_target ?>"><i class="fa fa-skype jux_skype"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_dribbble_show == "1"): ?>
                                                <li><a href="<?php echo $jux_dribbble ?>" target="<?php echo $jux_target ?>"><i class="fa fa-dribbble jux_dribbble"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_delicious_show == "1"): ?>
                                                <li><a href="<?php echo $jux_delicious ?>" target="<?php echo $jux_target ?>"><i class="fa fa-delicious jux_delicious"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_tumbler_show == "1"): ?>
                                                <li><a href="<?php echo $jux_tumbler ?>" target="<?php echo $jux_target ?>"><i class="fa fa-tumblr-square jux_tumbler"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_lastfm_show == "1"): ?>
                                                <li><a href="<?php echo $jux_lastfm ?>" target="<?php echo $jux_target ?>"><i class="fa fa-lastfm-square jux_lastfm"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_dropbox_show == "1"): ?>
                                                <li><a href="<?php echo $jux_dropbox ?>" target="<?php echo $jux_target ?>"><i class="fa fa-dropbox jux_dropbox"></i></a>
                                                </li>
                                                <?php endif;?>
                                                <?php if($jux_devianart_show == "1"): ?>
                                                <li><a href="<?php echo $jux_devianart ?>" target="<?php echo $jux_target ?>"><i class="fa fa-deviantart jux_devianart"></i></a>
                                                </li>
                                                <?php endif;?>
                                            </ul><!-- /.social -->
                                        <?php endif; ?>
                                    </div>
                                </div><!-- /.wrapper -->

                            </div>
                        </div>
                        <?php if ($jux_about_page == "1"): ?>
                        <div class="section" id="section1">
                            <div class="intro">
                                <?php echo $jux_about_us;?>
                                <!-- /.row -->
                                
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if ($jux_contact_page == "1"): ?>
                        <div class="section" id="section2">
                            <div class="intro">
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 col-xs-5 col-xs-offset-1 contact_mail">
                                        <?php if ($jux_contact_us_email_title != NULL): ?>
                                        <h1><?php echo $jux_contact_us_email_title; ?></h1>
                                        <?php endif;?>
                                        <?php if ($jux_contact_us_email_description != NULL): ?>
                                        <p><?php echo $jux_contact_us_email_description; ?></p>
                                        <?php endif;?>
                                        <div class="form-style" id="contact_form">
                                            <div id="contact_results"></div>
                                            <div id="contact_body">
                                                <label>
                                                    <input type="hidden" name="to_email" id="to_email" required="true" class="input-field" value="<?php echo $admin_email;?>" />
                                                </label>
                                                <label class="col-md-12 jux_contact_form"><span><span class="required"></span></span>
                                                    <i class="fa fa-user jux_user_contact"></i> 
                                                    <input type="text" name="name" id="name" required="true" class="input-field" placeholder="Your Name"/>
                                                </label>
                                                <label class="col-md-12 jux_contact_form"><span><span class="required"></span></span>
                                                    <i class="fa fa-at jux_email_contact"></i>
                                                    <input type="email" name="email" required="true" class="input-field" placeholder="Your Email"/>
                                                </label>
                                                <label class="col-md-12 jux_contact_form"><span><span class="required"></span></span>
                                                    <i class="fa fa-envelope-o jux_user_contact"></i>
                                                    <input type="text" name="subject" required="true" class="input-field" placeholder="Email Subject"/>
                                                </label>
                                                <label class="col-md-12 jux_contact_form" for="field5"><span><span class="required"></span></span>
                                                    <i class="fa fa-bars jux_message_contact"></i>
                                                    <textarea name="message" id="message" class="textarea-field" required="true" placeholder="Your message"></textarea>
                                                </label>
                                                <label class="col-md-4 jux_submit">
                                                    <span></span><input type="submit" id="submit_btn" value="SEND US" class="button jux_button_send"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-6 col-sm-6 col-xs-6 jux_info">
                                        <?php if ($jux_contact_us_info_title != NULL): ?>
                                        <h1><?php echo $jux_contact_us_info_title; ?></h1>
                                        <?php endif;?>
                                        <?php if ($jux_contact_us_info_description != NULL): ?>
                                        <p><?php echo $jux_contact_us_info_description; ?></p>
                                        <?php endif;?>
                                        <?php if($jux_contact_us_map_show =="1"):?>
                                        <div class="col-md-12 contact_map"><?php echo $jux_contact_us_map; ?></div>
                                        <?php endif;?>
                                        <div class="jux_information">
                                            <?php if($jux_contact_us_street_show =="1"):?>
                                            <div class="jux_address"><i class="fa fa-home"></i><?php echo $jux_contact_us_street ?></div>
                                            <?php endif;?>
                                            <?php if($jux_contact_us_phone_show  =="1"):?>
                                            <div class="jux_email"><i class="fa fa-envelope"></i><?php echo $jux_contact_us_email ?></div>
                                            <?php endif;?>
                                            <?php if($jux_contact_us_email_show =="1"):?>
                                            <div class="jux_phone"><i class="fa fa-phone"></i><?php echo $jux_contact_us_phone ?></div>
                                            <?php endif;?>
                                        </div>
                                    </div><!-- /.col-md-6 -->
                                </div><!-- /.row -->
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if ($jux_login_form == "1"): ?>
                        <div class="section" id="section3">
                            <div class="intro">
                                <div class="wrap">
                                    <div class="container">
                                        <div class="main-login">
                                          <?php if($jux_logo_login != NULL):?>
                                            <div class="jux_login_logo">
                                              <img src="<?php echo JURI::base().$jux_logo_login; ?>">
                                            </div>
                                          <?php endif;?>
                                            <div class="vcb_messages">
                                              <?php if($jux_login_title != NULL):?>
                                                <h2 class="title"><?php echo $jux_login_title; ?></h2>
                                              <?php endif;?>
                                              <?php if($jux_login_intro != NULL):?>
                                                <p><?php echo $jux_login_intro; ?></p>
                                              <?php endif;?>  
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="block_login">
                                                    <div class="col-md-4 col-md-offset-4  block-login">
                                                        <form action="<?php echo JRoute::_('index.php', true) ?>" method="post" id="form-login">
                                                            <div id="form-login-username">
                                                                <i class="fa fa-user jux_user_login"></i>
                                                                <input name="username" id="username" type="text" placeholder="Username" autocomplete="off" class="inputbox" alt="" size="18" />
                                                            </div>
                                                            <div id="form-login-password">
                                                                <i class="fa fa-lock jux_password_login"></i>
                                                                <input type="password" name="password" placeholder="Password" class="inputbox" size="18" alt="" id="passwd" />
                                                            </div>
                                                            <div id="form-login-submit">
                                                            <input type="submit" name="Submit" class="button jux_button" value="<?php echo JText::_('JLOGIN') ?>" />
                                                            </div>
                                                            <input type="hidden" name="option" value="com_users" />
                                                            <input type="hidden" name="task" value="user.login" />
                                                            <input type="hidden" name="return" value=" <?php echo base64_encode(JURI::base()) ?>" />
                                                            <?php echo JHtml::_("form.token") ?>
                                                        </form>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </body>
                <!--.ProcessOnePage -->
                <script>
                  $(document).ready(function() {
                  $('#container').fullpage({
                    anchors: [<?php echo $onepage_string; ?>],
                    scrollingSpeed: 0,
                    css3:true,
                    scrollOverflow: true,
                    menu: '#menu'
                  });
                  });
                </script>
                <!--.ProcessCountdownTimecircles -->
                <?php if ($jux_countdown_style == "1"): ?>
                    <script >
                                $(document).ready(function() {
                        $('.countdown').final_countdown({
                        start: '1362139200',
                                end: '<?php echo $online_final;?>',
                                now: '<?php echo $now_final;?>',
                                selectors: {
                                value_seconds: '.clock-seconds .val',
                                        canvas_seconds: 'canvas_seconds',
                                        value_minutes: '.clock-minutes .val',
                                        canvas_minutes: 'canvas_minutes',
                                        value_hours: '.clock-hours .val',
                                        canvas_hours: 'canvas_hours',
                                        value_days: '.clock-days .val',
                                        canvas_days: 'canvas_days'
                                },
                                seconds: {
                                borderColor: '<?php echo $circle_second_color;?>',
                                        borderWidth: '<?php echo $circle_second_border;?>'
                                },
                                minutes: {
                                borderColor: '<?php echo $circle_minute_color;?>',
                                        borderWidth: '<?php echo $circle_minute_border;?>'
                                },
                                hours: {
                                borderColor: '<?php echo $circle_hour_color;?>',
                                        borderWidth: '<?php echo $circle_hour_border;?>'
                                },
                                days: {
                                borderColor: '<?php echo $circle_day_color;?>',
                                        borderWidth: '<?php echo $circle_day_border;?>'
                                }}, function() {
                        // Finish callback
                        });
                        });</script>
                <?php endif; ?>
                <?php if ($jux_countdown_style == "2"): ?><!-- /.county -->
                    <script>
                                $(document).ready(function () {
                        //set width of wrapper;
                        $('#county_style').county({ endDateTime: new Date('<?php echo $online;?>'), reflection: <?php echo $county_reflection; ?>, animation: '<?php echo $county_animation; ?>', theme: '<?php echo $county_theme; ?>' });
                        });</script>
                <?php endif; ?>
                <?php if ($jux_countdown_style == "3"): ?><!-- /.normal -->
                    <script>
                        $('#clock').countdown('<?php echo $online; ?>', function(event) {
                        $(this).html(event.strftime('<div class="clock_normal">%D<span class="normal_style">DAYS</span></div><div class="clock_normal">%H<span class="normal_style">HOURS</span></div><div class="clock_normal">%M<span class="normal_style">MINUTES</span></div><div class="clock_normal">%S<span class="normal_style">SECONDS</span></div>'));
                        });</script>
                <?php endif; ?>
                <?php if ($jux_countdown_style == "4"): ?><!-- /.slide -->
                    <script>
                                $('#time_to').timeTo({
                        timeTo: new Date(new Date('<?php echo $online_slide;?>')),
                                displayDays: <?php echo $timeto_style_days_number;?>,
                                theme: "<?php echo $timeto_style;?>",
                                countdownAlertLimit: <?php echo $timeto_style_alert;?>,
                                displayCaptions: true,
                                fontSize: 54,
                                captionSize: 16
                        });</script>
                <?php endif; ?>

                <?php if ($jux_countdown_style == "5"): ?><!-- /.flip clock -->
                    <script type="text/javascript">
                    var clock;
                    $(document).ready(function() {
                      diff = <?php echo $seconds_online;?>;
                      // Instantiate a cutdown FlipClock
                      clock = $('#flipclock').FlipClock(diff, {
                        clockFace: 'DailyCounter',
                        countdown: true
                      });
                    });
                  </script>
                <?php endif; ?>
                <!--.Process backgroundvideo -->
                <?php if ($jux_background_style == "2"): ?>
                    <script>
                                $().ready(function() {
                        $('#container').tubular({
                        videoId: '<?php echo $this->params->def('youtubeid'); ?>',
                                mute: <?php echo $muteyt; ?>,
                                repeat: <?php echo $loopyt; ?>,
                                start: <?php echo $this->params->def('startyt'); ?>,
                                ratio: <?php echo $ratioyt; ?>
                        }); // where idOfYourVideo is the YouTube ID.

                        });</script>
                <?php endif; ?>

                <?php if ($jux_background_style == "1"): ?>
                    <script>
                                $(function() {
                                $('#resume').on('click', function(){ // set up resume button behavior
                                $("#pan_area").smoothslider("resume") // resume playing of this slideshow. Pass in "pause" to pause it instead
                                        $(this).hide() // hide resume button
                                })
                                        $("#pan_area").smoothslider("install", {
                                "playlist": <?php echo $playlist; ?>
                                ,
                                        "loops":<?php echo $slide_loop; ?>,
                                        "hold_time":<?php echo $slide_holdtime; ?>,
                                        "transition_time":<?php echo $slide_transition; ?>,
                                        "on_image_change":function(caption, image_url) {
                                        var area = $("#img_msg_area").find("span");
                                                area.animate({"opacity": 0}, 500, "swing", function() {
                                                area.text(caption);
                                                        area.animate({"opacity": 1}, 500);
                                                });
                                        },
                                        "throbber":$("#throbber"),
                                        on_pause:function(){
                                        $('#resume').show()
                                        }

                                });
                                });</script>
                <?php endif; ?>


                </html>

