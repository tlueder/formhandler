<?php

declare(strict_types=1);

/*
 * This file is part of TYPO3 CMS-based extension "Formhandler" by JAKOTA.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Typoheads\Formhandler\Validator\ErrorCheck;

use Typoheads\Formhandler\Domain\Model\Config\FormModel;
use Typoheads\Formhandler\Domain\Model\Config\Validator\ErrorCheck\AbstractErrorCheckModel;
use Typoheads\Formhandler\Domain\Model\Config\Validator\ErrorCheck\FileSizeMaxModel;

class FileSizeMax extends AbstractErrorCheck {
  public function isValid(FormModel &$formConfig, AbstractErrorCheckModel &$errorCheckConfig, string $fieldNamePathBrackets, string $fieldNamePathDots, mixed $value): bool {
    if (!$errorCheckConfig instanceof FileSizeMaxModel) {
      return false;
    }

    if (false === $errorCheckConfig->fileSizeMax) {
      return true;
    }

    $isValid = true;
    foreach ($formConfig->formUploads->files[$fieldNamePathBrackets] as $file) {
      if ($file->size > $errorCheckConfig->fileSizeMax) {
        $isValid = false;
        $file->error = true;
      }
    }

    return $isValid;
  }
}
