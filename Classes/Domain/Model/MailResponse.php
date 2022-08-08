<?php

declare(strict_types=1);

namespace Typoheads\Formhandler\Domain\Model;

class MailResponse {
  /**
   * @var array<int, string>
   */
  private array $recipients = [];

  private bool $sent = false;

  /**
   * @return array<int, string>
   */
  public function getRecipients(): array {
    return $this->recipients;
  }

  public function getSent(): bool {
    return $this->sent;
  }

  /**
   * @param array<int, string> $recipients
   */
  public function setRecipients(array $recipients): void {
    $this->recipients = $recipients;
  }

  public function setSent(bool $sent): void {
    $this->sent = $sent;
  }
}
