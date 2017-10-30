<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicle.php';


$checked = [];

if (isset($_POST['Submitcheck'])) {
    foreach ($_POST as $value) {
        $checked[]=$value;
    }
} else {
    $checked = ['Car', 'Bike', 'Truck', 'dud'];
}

if (isset($_POST['delete'])) {
    $manager->deleteVehicle($_POST['id_vehicle']);
}

$form_check = new Form('row checkboxes');
$form_check->addCheckboxes(['Car', 'Bike', 'Truck'], $checked);
$form_check->addInputSubmit('Submitcheck', 'btn btn-primary', 'Display selected');

$vehicles = $manager->getAllVehicles($checked);

require '../view/home_v.php';
