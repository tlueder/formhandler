<?php

declare(strict_types=1);

namespace Typoheads\Formhandler\Finisher;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Typoheads\Formhandler\Component\AbstractComponent;

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
 * Abstract class for Finisher Classes used by Formhandler.
 */
abstract class AbstractFinisher extends AbstractComponent {
  protected function getNestedGp(string $pipeSeperatedField): ?string {
    $arrayPath = GeneralUtility::trimExplode('|', $pipeSeperatedField, true);
    if (empty($arrayPath)) {
      return null;
    }

    $dest = $this->gp;
    $finalKey = array_pop($arrayPath);
    foreach ($arrayPath as $key) {
      if (is_array($dest) && array_key_exists($key, $dest)) {
        $dest = $dest[$key];
      } else {
        return null;
      }
    }

    return $dest[$finalKey] ?? null;
  }
}
