<?php
namespace App\Contracts;
interface MessageProvider {
 public function sendText(string $recipient,string $text):array;
 public function verifyWebhook(array $headers,string $rawBody):bool;
 public function normalizeWebhook(array $payload):?array;
}
