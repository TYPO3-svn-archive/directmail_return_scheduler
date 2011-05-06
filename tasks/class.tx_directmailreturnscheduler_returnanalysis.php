<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) Johannes Feustel
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

require_once(t3lib_extMgm::extPath('direct_mail') . 'res/scripts/class.readmail.php');


/**
 * A Task for return mails analysis  via the scheduler for direct_mail
 *
 * based on EXT:directmail_return_scheduler which is based on the returnmail.phpsh shipped with direct_mail
 *
 * @author	 Johannes Feustel
 * @package	TYPO3
 * @subpackage tx_directmailreturnscheduler
 * @version	SVN: $Id$
 */
class tx_directmailreturnscheduler_returnAnalysis extends tx_scheduler_Task {


	/**
	 * Executes return mail analysis
	 *
	 * @return boolean
	 */
	public function execute() {


		$_EXTKEY = 'directmail_return_scheduler';
		$lockfile = PATH_site . 'typo3temp/tx_sldirectmailreturn_cron.lock';

		// Check if cronjob is already running:
		if (@file_exists($lockfile)) {
			// If the lock is not older than 1 day abort execution
			if (filemtime($lockfile) > (time() - (60 * 60 * 24))) {
				t3lib_div::devLog('Aborting, another process is already running!', $_EXTKEY, 2);
				return true;
			} else {
				t3lib_div::devLog('TYPO3 directmail_return_scheduler Cron: A .lock file was found but it is older than 1 day! Processing mails ...', $_EXTKEY, 2);
			}
		}
		touch($lockfile);
		// Fixing filepermissions
		t3lib_div::fixPermissions($lockfile);

		// create the connection string
		$port = $this->mail_port;
		$mb = '';
		switch (strtoupper($this->mail_type)) {
			case "IMAP":
				if (!trim($port)) $port = '143';
				$mb = "{" . $this->mail_host . ":" . $port . "}" . $this->mail_inbox;
				;
				break;
			case "IMAPS":
				if (!trim($port)) $port = '993';
				$mb = "{" . $this->mail_host . ":" . $port . "/imap/ssl/novalidate-cert" . "}" . $this->mail_inbox;
				break;
			case "POP":
			case "POP3":
				if (!trim($port)) $port = '110';
				$mb = "{" . $this->mail_host . ":" . $port . "/pop3" . "}" . $this->mail_inbox;
				break;
			default:
				$mb = $this->mail_type;
				break;
		}

		$mbox = @imap_open($mb, $this->mail_user, $this->mail_password);
		if ($mbox===false) {
			unlink($lockfile);
			throw new Exception('TYPO3 directmail_return_scheduler Cron: Cannot open connection! (' . $mb . ')');
 		}
		$mails = imap_sort($mbox, SORTDATE, 0);
		$cnt = 0;
		$readMail = t3lib_div::makeInstance('readmail');
		foreach ($mails as $mail) {
			@set_time_limit(30);
			$content = imap_fetchheader($mbox, $mail) . imap_body($mbox, $mail);

			if (trim($content)) {
				// Split mail into head and content
				$mailParts = $readMail->extractMailHeader($content);
				// Find id
				$midArr = $readMail->find_XTypo3MID($content);
				if (!is_array($midArr)) {
					$midArr = $readMail->find_MIDfromReturnPath($mailParts['to']);
				}

				// Extract text content
				$c = trim($readMail->getMessage($mailParts));
				$cp = $readMail->analyseReturnError($c);

				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,email', 'sys_dmail_maillog', 'rid=' . intval($midArr['rid']) . ' AND rtbl="' . $GLOBALS['TYPO3_DB']->quoteStr($midArr['rtbl'], 'sys_dmail_maillog') . '" AND mid=' . intval($midArr['mid']) . ' AND response_type=0');
				if (!$GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
					$midArr = array();
					$cp = $mailParts;
				} else {
					$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
					$midArr['email'] = $row['email'];
				}

				$insertFields = array(
					'tstamp' => time(),
					'response_type' => -127,
					'mid' => intval($midArr['mid']),
					'rid' => intval($midArr['rid']),
					'email' => $midArr['email'],
					'rtbl' => $midArr['rtbl'],
					'return_content' => serialize($cp),
					'return_code' => intval($cp['reason'])
				);
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_dmail_maillog', $insertFields);
			}

			imap_delete($mbox, $mail);

			$cnt++;
			if ($cnt >= $this->mails_per_cycle) break;
		}

		imap_close($mbox, CL_EXPUNGE);
		unlink($lockfile);

		return true;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/direct_mailreturn_scheduler/class.tx_directmailreturnscheduler_returnanalysis.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/direct_mailreturn_scheduler/class.tx_directmailreturnscheduler_returnanalysis.php']);
}