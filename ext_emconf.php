<?php

########################################################################
# Extension Manager/Repository config file for ext "directmail_return_scheduler".
#
# Auto generated 02-02-2011 21:48
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'direct_mail return mail analysis scheduler task',
	'description' => 'scheduler task for direct_mail return mail analysis without fetchmail installed (ueses php imap functions) based on sl_direct_mail_return',
	'category' => 'misc',
	'author' => 'Johannes Feustel',
	'author_email' => 'j a feustel eu',
	'shy' => '',
	'dependencies' => 'direct_mail',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'direct_mail' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:5:{s:9:"ChangeLog";s:4:"0c1f";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:19:"doc/wizard_form.dat";s:4:"ffa6";s:20:"doc/wizard_form.html";s:4:"9d86";}',
);

?>