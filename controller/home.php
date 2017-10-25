<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicule.php';


$checked = [];

if(isset($_POST['Submit'])){
  foreach ($_POST as $value) {
    $checked[]=$value;
  }
}
else {
  $checked = ['Car', 'Bike', 'Truck'];
}

$form_check = new Form();
$form_check->addCheckboxes(['Car', 'Bike', 'Truck'], $checked);
$form_check->addInput('submit', 'Submit', 'Submit');

$vehicules = $manager->getAllVehicules($checked);


require '../view/home_v.php';
