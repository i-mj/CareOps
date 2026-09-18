<?php
use Illuminate\Support\Facades\Route;
use App\Services\AiToolRegistry;
use App\Services\MockHealthcareConnector;
use App\Http\Controllers\Api\WhatsAppWebhookController;
Route::prefix('v1')->group(function(){
 Route::get('/health',fn()=>['ok'=>true,'version'=>'v5']);
 Route::get('/ai/tools',fn(AiToolRegistry $r)=>['tools'=>$r->all()]);
 Route::get('/demo/doctors',fn(MockHealthcareConnector $c)=>['data'=>$c->getDoctors()]);
 Route::post('/webhooks/whatsapp',[WhatsAppWebhookController::class,'receive']);
 Route::post('/ai/patient-message',function(\Illuminate\Http\Request $r,\App\Services\AiOrchestrator $ai){
  $d=$r->validate(['patient_id'=>'required|string','phone'=>'required|string','message'=>'required|string|max:2000']);
  return ['data'=>$ai->handle('demo-tenant',$d['patient_id'],$d['phone'],$d['message'])];
 });
});
