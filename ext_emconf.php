<?php

########################################################################
# Extension Manager/Repository config file for ext "directmail_return_scheduler".
#
# Auto generated 07-05-2011 00:22
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
	'version' => '0.1.2dev',
	'constraints' => array(
		'depends' => array(
			'direct_mail' => '',
			'typo3' => '4.6.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:12:{s:9:"ChangeLog";s:4:"0c1f";s:10:"README.txt";s:4:"ee2d";s:16:"ext_autoload.php";s:4:"8bbd";s:12:"ext_icon.gif";s:4:"e22b";s:17:"ext_localconf.php";s:4:"f57f";s:14:"ext_tables.php";s:4:"e7f1";s:13:"locallang.xml";s:4:"7552";s:17:"locallang_csh.xml";s:4:"d795";s:19:"doc/wizard_form.dat";s:4:"ffa6";s:20:"doc/wizard_form.html";s:4:"9d86";s:59:"tasks/class.tx_directmailreturnscheduler_returnanalysis.php";s:4:"1ea2";s:83:"tasks/class.tx_directmailreturnscheduler_returnanalysis_additionalfieldprovider.php";s:4:"5e8a";}',
	'suggests' => array(
	),
);

?>