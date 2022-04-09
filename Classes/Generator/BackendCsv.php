<?php

declare(strict_types=1);

namespace Typoheads\Formhandler\Generator;

use ParseCsv\Csv;
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
 * Class to generate CSV files in Backend.
 *
 * @uses export2CSV in csv.lib.php
 */
class BackendCsv extends AbstractComponent {
  /**
   * The internal CSV object.
   */
  protected Csv $csv;

  public function init(array $gp, array $settings): void {
    parent::init($gp, $settings);
    $fileName = $this->utilityFuncs->getSingle($this->settings, 'fileName');
    if (!$fileName) {
      $fileName = 'formhandler.csv';
    }
    $this->settings['fileName'] = $fileName;

    $delimiter = $this->utilityFuncs->getSingle($this->settings, 'delimiter');
    if (!$delimiter) {
      $delimiter = ',';
    }
    $this->settings['delimiter'] = $delimiter;

    $enclosure = $this->utilityFuncs->getSingle($this->settings, 'enclosure');
    if (!$enclosure) {
      $enclosure = '"';
    }
    $this->settings['enclosure'] = $enclosure;

    $encoding = $this->utilityFuncs->getSingle($this->settings, 'encoding');
    if (!$encoding) {
      $encoding = 'utf-8';
    }
    $this->settings['encoding'] = $encoding;
  }

  /**
   * Function to generate a CSV file from submitted form values. This function is called by Tx_Formhandler_Controller_Backend.
   *
   * @see Tx_Formhandler_Controller_Backend::generateCSV()
   */
  public function process(): array {
    $records = $this->settings['records'];
    $exportParams = $this->settings['exportFields'];

    $data = [];

    // build data array
    foreach ($records as $idx => $record) {
      if (!isset($record['params']) || !is_array($record['params'])) {
        $record['params'] = [];
      }
      foreach ($record['params'] as $subIdx => &$param) {
        if (is_array($param)) {
          $param = implode(';', $param);
        }
      }
      if (0 == count($exportParams) || in_array('pid', $exportParams)) {
        $record['params']['pid'] = $record['pid'];
      }
      if (0 == count($exportParams) || in_array('submission_date', $exportParams)) {
        $record['params']['submission_date'] = date('d.m.Y H:i:s', $record['crdate']);
      }
      if (0 == count($exportParams) || in_array('ip', $exportParams)) {
        $record['params']['ip'] = $record['ip'];
      }
      $data[] = $record['params'];
    }
    if (count($exportParams) > 0) {
      foreach ($data as $idx => &$params) {
        // fill missing fields with empty value
        foreach ($exportParams as $key => $exportParam) {
          if (!array_key_exists($exportParam, $params)) {
            $params[$exportParam] = '';
          }
        }

        // remove unwanted fields
        foreach ($params as $key => $value) {
          if (!in_array($key, $exportParams)) {
            unset($params[$key]);
          }
        }
      }
    }

    // sort data
    $dataSorted = [];
    foreach ($data as $idx => $array) {
      $dataSorted[] = $this->sortArrayByArray($array, $exportParams);
    }
    $data = $dataSorted;

    // create new parseCSV object.
    $csv = new Csv(null, null, null, []);
    $csv->delimiter = $csv->output_delimiter = $this->settings['delimiter'];
    $csv->enclosure = $this->settings['enclosure'];
    $csv->input_encoding = strtolower($this->getInputCharset());
    $csv->output_encoding = strtolower($this->settings['encoding']);
    $csv->convert_encoding = false;
    if ($csv->input_encoding !== $csv->output_encoding) {
      $csv->convert_encoding = true;
    }
    $csv->output($this->settings['fileName'], $data, $exportParams);

    exit();
  }

  /**
   * Get charset used by TYPO3.
   *
   * @return string Charset
   */
  private function getInputCharset(): string {
    if (is_object($GLOBALS['LANG']) && $GLOBALS['LANG']->charSet) {
      $charset = $GLOBALS['LANG']->charSet;
    } elseif ($GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset']) {
      $charset = $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'];
    } else {
      $charset = 'utf-8';
    }

    return $charset;
  }

  /**
   * Sorts the CSV data.
   *
   * @return array The sorted array
   */
  private function sortArrayByArray(array $array, array $orderArray): array {
    $ordered = [];
    foreach ($orderArray as $idx => $key) {
      if (array_key_exists($key, $array)) {
        $ordered[$key] = $array[$key];
        unset($array[$key]);
      }
    }

    return $ordered + $array;
  }
}
