<?php
namespace App\Services;
use App\Contracts\MessageProvider;
class MockMessageProvider implements MessageProvider {
 public function sendText(string $recipient,string $text):array {
  return ['provider'=>'mock','message_id'=>'wamid.'.bin2hex(random_bytes(5)),'recipient'=>$recipient,'status'=>'sent','text'=>$text];
 }
 public function verifyWebhook(array $headers,string $rawBody):bool{return true;}
 public function normalizeWebhook(array $payload):?array {
  if(!isset($payload['from'],$payload['text'])) return null;
  return ['external_message_id'=>$payload['message_id']??null,'from'=>$payload['from'],'text'=>$payload['text'],'channel'=>'whatsapp'];
 }
}
