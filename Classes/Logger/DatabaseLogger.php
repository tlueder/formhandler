<?php

declare(strict_types=1);

namespace Typoheads\Formhandler\Logger;

use Typoheads\Formhandler\Domain\Model\Config\FormModel;
use Typoheads\Formhandler\Domain\Model\Config\Logger\AbstractLoggerModel;
use Typoheads\Formhandler\Domain\Model\Config\Logger\DatabaseLoggerModel;

class DatabaseLogger extends AbstractLogger {
  public function process(FormModel &$formConfig, AbstractLoggerModel &$loggerConfig): void {
    if (!$loggerConfig instanceof DatabaseLoggerModel) {
      return;
    }
  }
}