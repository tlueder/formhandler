<?php

declare(strict_types=1);

/*
 * This file is part of TYPO3 CMS-based extension "Formhandler" by JAKOTA.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Typoheads\Formhandler\Domain\Model\Config\GeneralOptions;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Typoheads\Formhandler\Domain\Model\Config\FormModel;
use Typoheads\Formhandler\Domain\Model\Config\Validator\AbstractValidatorModel;
use Typoheads\Formhandler\Utility\Utility;

/** Documentation:Start:GeneralOptions/Step.rst.
 *
 *.. _step:
 *
 *====
 *Step
 *====
 *
 *Multistep forms settings
 *
 *.. list-table::
 *   :align: left
 *   :width: 100%
 *   :widths: 20 80
 *   :header-rows: 0
 *   :stub-columns: 0
 *
 *   * - **templateForm**
 *     - The template for a given step.
 *   * -
 *     -
 *   * - *Mandatory*
 *     - False
 *   * - *Data Type*
 *     - String
 *
 *.. list-table::
 *   :align: left
 *   :width: 100%
 *   :widths: 20 80
 *   :header-rows: 0
 *   :stub-columns: 0
 *
 *   * - **validators**
 *     - A list of :ref:`Validators` for a given step.
 *   * -
 *     -
 *   * - *Mandatory*
 *     - False
 *   * - *Data Type*
 *     - Array<String, :ref:`Validator <Validators>`>
 *
 *Documentation:End
 */
class StepModel {
  /** @var AbstractValidatorModel[] */
  public readonly array $validators;

  private readonly string $templateForm;

  /**
   * @param array<string, mixed> $settings
   */
  public function __construct(FormModel &$formConfig, array $settings, string $templateForm) {
    $utility = GeneralUtility::makeInstance(Utility::class);

    $this->templateForm = strval($settings['templateForm'] ?? $templateForm);

    if (!is_array($settings['validators'] ?? false)) {
      $this->validators = [];

      return;
    }

    $validators = [];
    foreach ($settings['validators'] as $validator) {
      if (empty($validator['model'])) {
        $validator['model'] = 'DefaultValidator';
      }

      /** @var AbstractValidatorModel $validatorModel */
      $validatorModel = GeneralUtility::makeInstance($utility::classString(strval($validator['model'].'Model'), 'Typoheads\\Formhandler\\Domain\\Model\\Config\\Validator\\'), $formConfig, $validator['config'] ?? []);

      $validators[] = $validatorModel;
    }

    $this->validators = $validators;
  }

  public function templateForm(): string {
    return $this->templateForm;
  }
}
