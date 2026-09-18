<?php
namespace App\Contracts;
interface HealthcareConnector {
 public function getDoctors():array;
 public function getAvailability(string $doctorId,string $date):array;
 public function createAppointment(array $data):array;
}
