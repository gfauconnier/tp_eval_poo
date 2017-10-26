<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicule.php';


$checked = [];

if (isset($_POST['Submitcheck'])) {
    foreach ($_POST as $value) {
        $checked[]=$value;
    }
} else {
    $checked = ['Car', 'Bike', 'Truck', 'dud'];
}

if (isset($_POST['delete'])) {
    $manager->deleteVehicule($_POST['id_vehicule']);
}

$form_check = new Form();
$form_check->addCheckboxes(['Car', 'Bike', 'Truck'], $checked);
$form_check->addInput('submit', 'Submitcheck', 'btn btn-primary', 'Display selected');

$vehicules = $manager->getAllVehicules($checked);

require '../view/home_v.php';
