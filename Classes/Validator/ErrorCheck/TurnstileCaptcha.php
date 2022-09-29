<?php

// Copyright JAKOTA Design Group GmbH. All rights reserved.
declare(strict_types=1);

namespace Typoheads\Formhandler\Validator\ErrorCheck;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Validates a Cloudflare Turnstile token.
 */
class TurnstileCaptcha extends AbstractErrorCheck {
  public function check(): string {
    $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('formhandler');
    if (is_array($extensionConfiguration) && is_array($extensionConfiguration['turnstile'])) {
      $privkey = $extensionConfiguration['turnstile']['privatekey'];
    } else {
      return $this->getCheckFailed();
    }

    // recaptcha field does not exist
    if (!isset($this->gp['Turnstile']) || !is_string($this->gp['Turnstile'])) {
      return $this->getCheckFailed();
    }

    if (!$this->makeCaptchaRequest($privkey, $this->gp['Turnstile'])) {
      return $this->getCheckFailed();
    }

    return '';
  }

  /**
   * @param array<string, mixed> $gp
   * @param array<string, mixed> $settings
   */
  public function init(array $gp, array $settings): void {
    parent::init($gp, $settings);
  }

  private function makeCaptchaRequest(string $privkey, string $token): bool {
    $postUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $postParams = "secret={$privkey}&response={$token}";

    $curl_request = curl_init();
    curl_setopt($curl_request, CURLOPT_URL, $postUrl);
    curl_setopt($curl_request, CURLOPT_POST, true);
    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $postParams);
    curl_setopt($curl_request, CURLOPT_HTTPHEADER, ['Content-Type:application/x-www-form-urlencoded']);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_request, CURLINFO_HEADER_OUT, true);

    $resp = curl_exec($curl_request);

    if (is_bool($resp)) {
      return false;
    }

    $responseJson = json_decode($resp, true);
    if (is_array($responseJson) && true === $responseJson['success']) {
      return true;
    }

    return false;
  }
}
