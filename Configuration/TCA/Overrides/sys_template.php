<?php

defined('TYPO3') or exit;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
  'formhandler',
  'Configuration/TypoScript/Json',
  'Activate JSON Output (optional)'
);
