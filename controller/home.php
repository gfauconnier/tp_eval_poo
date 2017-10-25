<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicule.php';

$vehicules = $manager->getAllVehicules();

require '../view/home_v.php';
