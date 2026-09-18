<?php
namespace App\Services;
use RuntimeException;
class AiToolRegistry {
 private array $permissions=[
  'appointments.read'=>['agent:appointment','role:staff','role:manager','role:admin'],
  'appointments.book'=>['agent:appointment','role:staff','role:manager','role:admin'],
  'patient.message.send'=>['agent:appointment','agent:followup','role:staff','role:manager','role:admin'],
  'human.escalate'=>['agent:frontdesk','role:staff','role:manager','role:admin']
 ];
 public function execute(string $tool,array $principals,callable $handler):mixed{
  if(!isset($this->permissions[$tool])||!array_intersect($this->permissions[$tool],$principals)) throw new RuntimeException("Tool permission denied: {$tool}");
  return $handler();
 }
 public function all():array{return array_keys($this->permissions);}
}
