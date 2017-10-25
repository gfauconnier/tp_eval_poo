<?php

$form_new = new Form();
$form_new->addSelect('type', ['Voiture', 'Moto', 'Camion']);
$form_new->addInput('text', 'license_plate');
$form_new->addInput('text', 'brand');
$form_new->addInput('text', 'model');
$form_new->addInput('text', 'price');
$form_new->addInput('submit', 'creer', 'Créer');

if(isset($_POST['creer'])) {
  $vehicule_post = [];
  if(isset($_POST['license_plate'], $_POST['brand'], $_POST['model'], $_POST['price']) && !empty($_POST['license_plate']) && !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
    foreach ($_POST as $key => $value){
      $vehicule_post[$key] = sanitizeStr($value);
    }
  }
}

require '../view/new_vehicule_v.php';
