<?php

$form_new = new Form('new_vehicle');
$form_new->addSelect('type', ['Car', 'Bike', 'Truck']);
$form_new->addInputText('license_plate', 'col-7');
$form_new->addInputText('brand', 'col-7');
$form_new->addInputText('model', 'col-7');
$form_new->addInputText('price', 'col-7');
$form_new->addTextarea('description', 'col-7');
$form_new->addInputSubmit('create', 'btn btn-success col-4 mx-auto', 'Create');

if(isset($_POST['create'])) {
  $vehicle_post = [];
  if(isset($_POST['license_plate'], $_POST['brand'], $_POST['model'], $_POST['price']) && !empty($_POST['license_plate']) && !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
    foreach ($_POST as $key => $value){
      $vehicle_post[$key] = sanitizeStr($value);
    }
    $message = $manager->addVehicle($vehicle_post);
  }
}

require '../view/new_vehicle_v.php';
