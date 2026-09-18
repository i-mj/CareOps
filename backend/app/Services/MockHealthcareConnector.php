<?php
namespace App\Services;
use App\Contracts\HealthcareConnector;
class MockHealthcareConnector implements HealthcareConnector {
 public function getDoctors():array{return [
  ['id'=>'doc_1','name'=>'Dr. A. Sharma','specialty'=>'General Medicine'],
  ['id'=>'doc_2','name'=>'Dr. N. Mehta','specialty'=>'Dermatology']
 ];}
 public function getAvailability(string $doctorId,string $date):array{return [
  ['slot_id'=>'slot_1','doctor_id'=>$doctorId,'date'=>$date,'time'=>'10:30 AM'],
  ['slot_id'=>'slot_2','doctor_id'=>$doctorId,'date'=>$date,'time'=>'12:00 PM'],
  ['slot_id'=>'slot_3','doctor_id'=>$doctorId,'date'=>$date,'time'=>'04:30 PM']
 ];}
 public function createAppointment(array $data):array{return ['id'=>'apt_'.bin2hex(random_bytes(4)),'status'=>'confirmed',...$data];}
}
