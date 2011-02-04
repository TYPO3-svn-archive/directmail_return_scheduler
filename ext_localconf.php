
<?php

if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

    // Register information for the task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['tx_directmailreturnscheduler_returnAnalysis'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'LLL:EXT:' . $_EXTKEY . '/locallang.xml:directmailreturnscheduler.returnAnalysis.name',
    'description'      => 'LLL:EXT:' . $_EXTKEY . '/locallang.xml:directmailreturnscheduler.returnAnalysis.description',
    'additionalFields' => 'tx_directmailreturnscheduler_returnAnalysis_AdditionalFieldProvider'
);

?>


