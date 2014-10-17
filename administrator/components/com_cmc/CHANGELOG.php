<?php defined('_JEXEC') or die(); ?>

=====================================================================
CMC 1.5.2 - Released 08-October-2014
=====================================================================
+ check if the user is running the latest version of the component on the dashboard
# form was not validated on Safari
# the CB plugin was missing the language files
+ added back the module class suffix option
# using the required parameter for phone field was breaking the form

=====================================================================
CMC 1.5.1 - Released 24-July-2014
=====================================================================
# fatal error in dashboard on joomla 2.5

=====================================================================
CMC 1.5.0 - Released 23-July-2014
=====================================================================
~ code now doesn't rely on deprecated functions in the joomla library
~ removed all mootools code and switched to jQuery
+ registration plugin now works with the k2 registration
+ option to auto-populate the fields in the module for logged in users
+ option to unsubscribe from the newsletter
+ when the user is already on the list, we offer him the option to update the information on the list, instead of overriding everything
+ subscribe on registration now can read values from the other fields and won't require the user to add his email or name twice
+ cleaned up backend and now relying on our backend template
# no groups or interests were saved to mailchimp with the registration plugin
# fatal error class Jhtml not found
# using advanced module manager was causing an error in the cmc module
# if the user is new he was not written to the cmc_users table when subscribing in the module
# if lists were containing 1000,2000,3000 etc subscribers we were never showing the success sync message
# unnecessary space in the update url
~ improved user synchronization
# fixing the bug in the redshop plugin
# setting a locale for javascript


=====================================================================
LEGEND
=====================================================================
! Note
+ New feature or addition
^ Major change
~ Small change
$ Language change
* Security fix
# Bug fix
- Feature removal