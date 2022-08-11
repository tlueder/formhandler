<?php

declare(strict_types=1);

namespace Typoheads\Formhandler\Controller;

use DOMDocument;

class FormInfo extends Form {
  public function process(): string {
    $this->init();
    $content = $this->processNotSubmitted();

    $info = [
      'name' => $this->settings['name'] ?? null,
      'formID' => $this->settings['formID'] ?? null,
      'formValuesPrefix' => $this->settings['formID'] ?? null,
      'finishers' => $this->getFinishers(),
      'validators' => $this->getValidators(),
      'fields' => $this->getFields($content),
    ];

    header('Content-Type: application/json');
    echo json_encode($info);

    exit;

    return '';
  }

  /**
   * @return array<int, array<string, mixed>>
   */
  private function getFields(string $content): array {
    $content = str_replace(' & ', ' &amp; ', $content);

    $fields = [];

    $document = new DOMDocument();
    $document->loadHTML('<?xml encoding="utf-8" ?>'.$content);

    // Find all select boxes
    foreach ($document->getElementsByTagName('select') as $selectField) {
      $field = [
        'element' => 'select',
        'value' => $selectField->getAttribute('value'),
        'id' => $selectField->getAttribute('id'),
        'name' => $selectField->getAttribute('name'),
        'option' => [],
      ];

      foreach ($selectField->getElementsByTagName('option') as $option) {
        $field['option'][] = [
          'value' => $option->getAttribute('value'),
          'text' => $option->textContent,
        ];
      }

      $fields[] = $field;
    }

    // Find all input fields
    foreach ($document->getElementsByTagName('input') as $inputField) {
      $fields[] = [
        'element' => 'input',
        'type' => $inputField->getAttribute('type'),
        'value' => $inputField->getAttribute('value'),
        'id' => $inputField->getAttribute('id'),
        'name' => $inputField->getAttribute('name'),
      ];
    }

    return $fields;
  }

  /**
   * @return array<int, string>
   */
  private function getFinishers(): array {
    $finishers = [];
    foreach ($this->settings['finishers.'] ?? [] as $finisher) {
      $finishers[] = $finisher['class'];
    }

    return $finishers;
  }

  /**
   * @return array<int, array<string, mixed>>
   */
  private function getValidators(): array {
    $validators = [];
    foreach ($this->settings['validators.'] ?? [] as $validatorElement) {
      $validator = ['class' => $validatorElement['class'], 'fields' => []];

      foreach ($validatorElement['config.']['fieldConf.'] ?? [] as $fieldName => $fieldConfig) {
        $config = ['field' => rtrim($fieldName, '.'), 'checks' => []];

        foreach ($fieldConfig['errorCheck.'] ?? [] as $errorKey => $error) {
          if (is_string($error)) {
            $check = ['type' => $error];
          } else {
            $check = array_pop($config['checks']);
            $check = array_merge($check, $error);
          }

          $config['checks'][] = $check;
        }

        $validator['fields'][] = $config;
      }

      $validators[] = $validator;
    }

    return $validators;
  }
}
