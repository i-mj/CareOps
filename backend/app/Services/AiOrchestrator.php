<?php
namespace App\Services;
use App\Contracts\HealthcareConnector;
use App\Contracts\MessageProvider;
class AiOrchestrator {
 public function __construct(private AiToolRegistry $tools,private HealthcareConnector $healthcare,private MessageProvider $messages,private AuditLogger $audit,private UsageMeter $usage){}
 public function handle(string $tenantId,string $patientId,string $phone,string $text):array{
  $intent=$this->classify($text); $this->usage->increment($tenantId,'ai_messages');
  $this->audit->record($tenantId,'ai','message.classified','patient',$patientId,['intent'=>$intent]);
  if($intent==='appointment_request'){
   $slots=$this->tools->execute('appointments.read',['agent:appointment'],fn()=> $this->healthcare->getAvailability('doc_1',date('Y-m-d',strtotime('+1 day'))));
   $reply='Available slots tomorrow: '.implode(', ',array_map(fn($x)=>$x['time'],$slots)).'. Reply with your preferred time.';
   $sent=$this->tools->execute('patient.message.send',['agent:appointment'],fn()=> $this->messages->sendText($phone,$reply));
   $this->usage->increment($tenantId,'outbound_messages'); $this->audit->record($tenantId,'ai','message.sent','conversation',$patientId,['provider_id'=>$sent['message_id']]);
   return ['intent'=>$intent,'action'=>'availability_presented','slots'=>$slots,'outbound'=>$sent];
  }
  $sent=$this->tools->execute('human.escalate',['agent:frontdesk'],fn()=> $this->messages->sendText($phone,'I’ll connect you with the clinic team for this request.'));
  $this->usage->increment($tenantId,'human_escalations'); $this->audit->record($tenantId,'ai','human.escalated','conversation',$patientId);
  return ['intent'=>$intent,'action'=>'human_escalation','outbound'=>$sent];
 }
 private function classify(string $text):string{
  $m=strtolower($text);
  if(preg_match('/appointment|available|availability|book|slot|doctor|kal|tomorrow/',$m))return 'appointment_request';
  if(preg_match('/human|staff|agent|call me|talk to/',$m))return 'human_help';
  return 'unknown';
 }
}
