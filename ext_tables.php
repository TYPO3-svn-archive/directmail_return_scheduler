<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
        // Initialize context sensitive help (csh) for the scheduler task
    t3lib_extMgm::addLLrefForTCAdescr('xMOD_tx_directmailreturnscheduler', 'EXT:' . $_EXTKEY . '/locallang_csh.xml');
}
?>

