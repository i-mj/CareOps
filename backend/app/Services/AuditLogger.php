<?php
namespace App\Services;
class AuditLogger {
 public function record(string $tenantId,string $actor,string $action,string $resource,?string $id,array $meta=[]):array{
  return ['tenant_id'=>$tenantId,'actor_type'=>$actor,'action'=>$action,'resource_type'=>$resource,'resource_id'=>$id,'metadata'=>$meta,'recorded_at'=>now()->toIso8601String()];
 }
}
