<?php

declare(strict_types=1);

namespace Typoheads\Formhandler\Utility;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This script is part of the TYPO3 project - inspiring people to share!
 *
 * TYPO3 is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2 as published by
 * the Free Software Foundation.
 *
 * This script is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
 * Public License for more details.
 */

/**
 * A PDF Template class for Formhandler generated PDF files for usage with Generator_TCPDF.
 */
class CaptchaUtility implements SingletonInterface {
  public function makeReCaptcha(string $formValuePrefix): string {
    $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('formhandler');
    if (is_array($extensionConfiguration) && is_array($extensionConfiguration['recaptcha']) && !empty($extensionConfiguration['recaptcha']['sitekey'])) {
      $sitekey = $extensionConfiguration['recaptcha']['sitekey'];
      $this->addRecaptchaJs();

      return '<input name="'.$formValuePrefix.'[ReCaptcha]" type="hidden" id="ReCaptchaField" data-siteKey="'.$sitekey.'" />';
    }

    return '';
  }

  public function makeTurnstile(string $formValuePrefix): string {
    $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('formhandler');
    if (is_array($extensionConfiguration) && is_array($extensionConfiguration['turnstile']) && !empty($extensionConfiguration['turnstile']['sitekey'])) {
      $sitekey = $extensionConfiguration['turnstile']['sitekey'];
      $this->addTurnstileJs();

      return '<div id="turnstileDiv" data-formValuePrefix="'.$formValuePrefix.'" data-siteKey="'.$sitekey.'"></div>';
    }

    return '';
  }

  private function addRecaptchaJs(): void {
    $GLOBALS['TSFE']->additionalHeaderData[] = '<script type="module" src="/typo3conf/ext/formhandler/Resources/Public/JavaScript/ReCaptcha.js"></script>';
  }

  private function addTurnstileJs(): void {
    $GLOBALS['TSFE']->additionalHeaderData[] = '<script id="turnstilScript" src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>';
    $GLOBALS['TSFE']->additionalFooterData[] = '<script type="module" src="/typo3conf/ext/formhandler/Resources/Public/JavaScript/Turnstile.js"></script>';
  }
}
