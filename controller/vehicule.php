<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicule.php';


if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $vehicule = $manager->getVehicule($id);
  if($vehicule) {

    if(isset($_POST['modify'])) {
      if(isset($_POST['brand'], $_POST['model'], $_POST['price'], $_POST['description']) &&  !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
        foreach ($_POST as $key => $value){
          $vehicule_mod[$key] = sanitizeStr($value);
        }
        $vehicule->hydrate($vehicule_mod);
        $manager->updateVehicule($vehicule);
      }
    }

    $form_modify = new Form();
    $form_modify->addInputText('brand', '', $vehicule->getBrand());
    $form_modify->addInputText('model', '', $vehicule->getModel());
    $form_modify->addInputText('price', '', $vehicule->getPrice());
    $form_modify->addTextarea('description', '', $vehicule->getDescription());
    $form_modify->addInputSubmit('modify', 'btn btn-primary', 'Modify');

    $form_delete = new Form('', ['home']);
    $form_delete->addHidden('id_vehicule', $vehicule->getId());
    $form_delete->addInputSubmit('delete', 'btn btn-danger', 'Delete');
    require '../view/vehicule_v.php';

  } else {
    header('Location: home.php');
  }
}
