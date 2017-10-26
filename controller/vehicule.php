<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicule.php';


if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $vehicule = $manager->getVehicule($id);
  if($vehicule) {

    $form_modify = new Form();
    $form_modify->addInput('text', 'brand', '', $vehicule->getBrand());
    $form_modify->addInput('text', 'model', '', $vehicule->getModel());
    $form_modify->addInput('text', 'price', '', $vehicule->getPrice());
    $form_modify->addTextarea('description', '', $vehicule->getDescription());

    $form_delete = new Form('', ['home']);
    $form_delete->addHidden('id_vehicule', $vehicule->getId());
    $form_delete->addInput('submit', 'delete', 'btn btn-danger', 'Delete');
    require '../view/vehicule_v.php';

  } else {
    header('Location: home.php');
  }
}
