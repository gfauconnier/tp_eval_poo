<?php

$form_new = new Form('new_vehicule');
$form_new->addSelect('type', ['Car', 'Bike', 'Truck']);
$form_new->addInput('text', 'license_plate', 'col-7');
$form_new->addInput('text', 'brand', 'col-7');
$form_new->addInput('text', 'model', 'col-7');
$form_new->addInput('text', 'price', 'col-7');
$form_new->addTextarea('description', 'col-7');
$form_new->addInput('submit', 'create', 'btn btn-success col-4', 'Create');

if(isset($_POST['create'])) {
  $vehicule_post = [];
  if(isset($_POST['license_plate'], $_POST['brand'], $_POST['model'], $_POST['price']) && !empty($_POST['license_plate']) && !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
    foreach ($_POST as $key => $value){
      $vehicule_post[$key] = sanitizeStr($value);
    }
    $message = $manager->addVehicule($vehicule_post);
  }
}

require '../view/new_vehicule_v.php';
