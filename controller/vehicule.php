<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicule.php';


if(isset($_GET['id'])) {
  // gets the sent id and cleans whatever is sent
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  // attempts to create an object depending on sent id
  $vehicule = $manager->getVehicule($id);
  // checks if an objects was returned if not goes back to home.php
  if($vehicule) {

    if(isset($_POST['modify'])) {
// checks sent data, cleans it and tries to update the vehicule in db
      if(isset($_POST['brand'], $_POST['model'], $_POST['price'], $_POST['description']) &&  !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
        foreach ($_POST as $key => $value){
          $vehicule_mod[$key] = sanitizeStr($value);
        }
        // rehydrates the object before sending it in VehiculeManager updateVehicule
        $vehicule->hydrate($vehicule_mod);
        $manager->updateVehicule($vehicule);
      }
    }

// creates the modify vehicule form
    $form_modify = new Form('modify_vehicule');
    $form_modify->addInputText('brand', '', $vehicule->getBrand());
    $form_modify->addInputText('model', '', $vehicule->getModel());
    $form_modify->addInputText('price', '', $vehicule->getPrice());
    $form_modify->addTextarea('description', '', $vehicule->getDescription());
    $form_modify->addInputSubmit('modify', 'btn btn-primary', 'Modify');

// delete form
    $form_delete = new Form('', ['home']);
    $form_delete->addHidden('id_vehicule', $vehicule->getId());
    $form_delete->addInputSubmit('delete', 'btn btn-danger', '<i class="material-icons">delete_sweep</i>');

    require '../view/vehicule_v.php';

  } else {
    header('Location: home.php');
  }
} else {
  header('Location: home.php');
}
