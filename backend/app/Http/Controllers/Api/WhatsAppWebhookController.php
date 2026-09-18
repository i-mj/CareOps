<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\MockMessageProvider;
use App\Services\AiOrchestrator;
use Illuminate\Http\Request;
class WhatsAppWebhookController extends Controller {
 public function receive(Request $request,MockMessageProvider $provider,AiOrchestrator $ai){
  $event=$provider->normalizeWebhook($request->all());
  if(!$event)return response()->json(['accepted'=>false],422);
  $patient='patient_'.substr(hash('sha256',$event['from']),0,12);
  return ['accepted'=>true,'normalized_event'=>$event,'result'=>$ai->handle('demo-tenant',$patient,$event['from'],$event['text'])];
 }
}
