<?php
namespace App\Services;
class UsageMeter {
 public function increment(string $tenantId,string $metric,int $quantity=1):array{
  return ['tenant_id'=>$tenantId,'metric'=>$metric,'quantity'=>$quantity];
 }
}
