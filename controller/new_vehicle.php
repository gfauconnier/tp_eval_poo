<?php

$form_new = new Form('new_vehicle');
$form_new->addSelect('type', ['Car', 'Bike', 'Truck']);
$form_new->addInputText('license_plate', 'col-7', '', 'Max 12 characters');
$form_new->addInputText('brand', 'col-7', '', 'Max 25 characters');
$form_new->addInputText('model', 'col-7', '', 'Max 30 characters');
$form_new->addInputText('price', 'col-7', '', 'Ex : 25000');
$form_new->addTextarea('description', 'col-7');
$form_new->addInputSubmit('create', 'btn btn-success col-4 mx-auto', 'Create');

if(isset($_POST['create'])) {
  $vehicle_post = [];
  $message = '';
  if(isset($_POST['license_plate'], $_POST['brand'], $_POST['model'], $_POST['price']) && !empty($_POST['license_plate']) && !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
    foreach ($_POST as $key => $value){
      $vehicle_post[$key] = sanitizeStr($value);
    }
    $vehicle_post['price'] = (int) $vehicle_post['price'];
    if (strlen($vehicle_post['license_plate']) > 12 || strlen($vehicle_post['brand']) > 25 || strlen($vehicle_post['model']) > 30 || !is_numeric($vehicle_post['price'])) {
      $message = 'At least one field wasn\'t correctly filled. Try again.';
    } else {
      switch ($vehicle_post['type']) {
        case 'Car':
          $new_vehicle = new Car($vehicle_post);
          break;
        case 'Bike':
          $new_vehicle = new Bike($vehicle_post);
          break;
        case 'Truck':
          $new_vehicle = new Truck($vehicle_post);
          break;
        default:
          break;
      }
      $message = $manager->addVehicle($new_vehicle);
    }
  }
}

require '../view/new_vehicle_v.php';
