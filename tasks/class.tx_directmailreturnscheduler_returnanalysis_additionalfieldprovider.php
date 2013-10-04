<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Johannes Feustel
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
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


class tx_directmailreturnscheduler_returnAnalysis_AdditionalFieldProvider implements tx_scheduler_AdditionalFieldProvider {


	/**
	 * Field generation.
	 * This method is used to define new fields for adding or editing a task
	 * In this case, it adds a page ID field
	 *
	 * @param	array			$taskInfo: reference to the array containing the info used in the add/edit form
	 * @param	object			$task: when editing, reference to the current task object. Null when adding.
	 * @param	tx_scheduler_Module	$parentObject: reference to the calling object (Scheduler's BE module)
	 * @return	array			Array containg all the information pertaining to the additional fields
	 */
	public function getAdditionalFields(array &$taskInfo, $task, tx_scheduler_Module $parentObject) {

		// Initialize extra field value
		if (empty($taskInfo['mail_type'])) {
			if ($parentObject->CMD == 'add') {
				// In case of new task and if field is empty, set default text
				$taskInfo['mail_type'] = 'IMAP';
			} elseif ($parentObject->CMD == 'edit') {
				// In case of edit, and editing a test task, set to internal value if not data was submitted already
				$taskInfo['mail_type'] = $task->mail_type;
			} else {
				// Otherwise set an empty value, as it will not be used anyway
				$taskInfo['mail_type'] = '';
			}
		}


		if (empty($taskInfo['mail_host'])) {
			if ($parentObject->CMD == 'add') {
				$taskInfo['mail_host'] = 'localhost';
			} elseif ($parentObject->CMD == 'edit') {
				$taskInfo['mail_host'] = $task->mail_host;
			} else {
				$taskInfo['mail_host'] = '';
			}
		}

		if (empty($taskInfo['mail_port'])) {
			if ($parentObject->CMD == 'edit') {
				$taskInfo['mail_port'] = $task->mail_port;
			} else {
				$taskInfo['mail_port'] = '';
			}
		}

		if (empty($taskInfo['mail_inbox'])) {
			if ($parentObject->CMD == 'add') {
				$taskInfo['mail_inbox'] = 'INBOX';
			} elseif ($parentObject->CMD == 'edit') {
				$taskInfo['mail_inbox'] = $task->mail_inbox;
			} else {
				$taskInfo['mail_inbox'] = '';
			}
		}

		if (empty($taskInfo['mail_user'])) {
			if ($parentObject->CMD == 'edit') {
				$taskInfo['mail_user'] = $task->mail_user;
			} else {
				$taskInfo['mail_user'] = '';
			}
		}

		if (empty($taskInfo['mail_password'])) {
			if ($parentObject->CMD == 'edit') {
				$taskInfo['mail_password'] = $task->mail_password;
			} else {
				$taskInfo['mail_password'] = '';
			}
		}

		if (empty($taskInfo['mails_per_cycle'])) {
			if ($parentObject->CMD == 'add') {
				$taskInfo['mails_per_cycle'] = '100';
			} elseif ($parentObject->CMD == 'edit') {
				$taskInfo['mails_per_cycle'] = $task->mails_per_cycle;
			} else {
				$taskInfo['mails_per_cycle'] = '';
			}
		}

		// Write the code for the field
		$fieldID = 'task_mail_type';
		$fieldCode = '<input type="text" name="tx_scheduler[mail_type]" id="' . $fieldID . '" value="' . $taskInfo['mail_type'] . '" size="30" />';
		$additionalFields = array();
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mail_type',
			'cshKey' => 'xMOD_tx_directmailreturnscheduler',
			'cshLabel' => $fieldID,
		);

		// Write the code for the field
		$fieldID = 'task_mail_host';
		$fieldCode = '<input type="text" name="tx_scheduler[mail_host]" id="' . $fieldID . '" value="' . $taskInfo['mail_host'] . '" size="30" />';
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mail_host',
		);

		// Write the code for the field
		$fieldID = 'task_mail_port';
		$fieldCode = '<input type="text" name="tx_scheduler[mail_port]" id="' . $fieldID . '" value="' . $taskInfo['mail_port'] . '" size="30" />';
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mail_port',
			'cshKey' => 'xMOD_tx_directmailreturnscheduler',
			'cshLabel' => $fieldID,
		);


		// Write the code for the field
		$fieldID = 'task_mail_inbox';
		$fieldCode = '<input type="text" name="tx_scheduler[mail_inbox]" id="' . $fieldID . '" value="' . $taskInfo['mail_inbox'] . '" size="30" />';
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mail_inbox',
		);

		// Write the code for the field
		$fieldID = 'task_mail_user';
		$fieldCode = '<input type="text" name="tx_scheduler[mail_user]" id="' . $fieldID . '" value="' . $taskInfo['mail_user'] . '" size="30" />';
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mail_user',
		);

		// Write the code for the field
		$fieldID = 'task_mail_password';
		$fieldCode = '<input type="text" name="tx_scheduler[mail_password]" id="' . $fieldID . '" value="' . $taskInfo['mail_password'] . '" size="30" />';
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mail_password',
		);

		// Write the code for the field
		$fieldID = 'task_mails_per_cycle';
		$fieldCode = '<input type="text" name="tx_scheduler[mails_per_cycle]" id="' . $fieldID . '" value="' . $taskInfo['mails_per_cycle'] . '" size="30" />';
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:directmail_return_scheduler/locallang.xml:directmailreturnscheduler.returnAnalysis.label.mails_per_cycle',
		);

		return $additionalFields;
	}

	/**
	 * Field validation.
	 * This method trims strings and checks if port and mails_per_cycle is int+
	 * If the task class is not relevant, the method is expected to return true
	 *
	 * @param  array				$submittedData: reference to the array containing the data submitted by the user
	 * @param  tx_scheduler_Module  $parentObject: reference to the calling object (Scheduler's BE module)
	 * @return boolean			  True if validation was ok (or selected class is not relevant), false otherwise
	 */

	public function validateAdditionalFields(array &$submittedData, tx_scheduler_Module $parentObject) {

		$submittedData['mail_type'] = trim($submittedData['mail_type']);
		$submittedData['mail_host'] = trim($submittedData['mail_host']);
		$submittedData['mail_port'] = t3lib_utility_Math::convertToPositiveInteger($submittedData['mail_port']);
		$submittedData['mail_inbox'] = trim($submittedData['mail_inbox']);
		$submittedData['mail_user'] = trim($submittedData['mail_user']);
		$submittedData['mail_password'] = trim($submittedData['mail_password']);
		$submittedData['mails_per_cycle'] = t3lib_utility_Math::convertToPositiveInteger($submittedData['mails_per_cycle']);

		return true;
	}

	/**
	 * Store field.
	 * This method is used to save any additional input into the current task object
	 * if the task class matches
	 *
	 * @param	array			$submittedData: array containing the data submitted by the user
	 * @param	tx_scheduler_Task	$task: reference to the current task object
	 * @return	void
	 */

	public function saveAdditionalFields(array $submittedData, tx_scheduler_Task $task) {
		$task->mail_type = $submittedData['mail_type'];
		$task->mail_host = $submittedData['mail_host'];
		$task->mail_port = $submittedData['mail_port'];
		$task->mail_inbox = $submittedData['mail_inbox'];
		$task->mail_user = $submittedData['mail_user'];
		$task->mail_password = $submittedData['mail_password'];
		$task->mails_per_cycle = $submittedData['mails_per_cycle'];
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/direct_mailreturn_scheduler/classes/class.tx_directmailreturnscheduler_returnanalysis_additionalfieldprovider.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/direct_mailreturn_scheduler/classes/class.tx_directmailreturnscheduler_returnanalysis_additionalfieldprovider.php']);
}