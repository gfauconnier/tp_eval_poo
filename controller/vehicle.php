<?php
require '../model/data.php';
require '../service/autoloader.php';
require '../service/sanitize.php';

require 'new_vehicle.php';


if (isset($_GET['id'])) {
    // gets the sent id and cleans whatever is sent
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // attempts to create an object depending on sent id
    $vehicle = $manager->getVehicle($id);
    // checks if an objects was returned if not goes back to home.php
    if ($vehicle) {
        if (isset($_POST['modify'])) {
            // checks sent data, cleans it and tries to update the vehicle in db
            if (isset($_POST['brand'], $_POST['model'], $_POST['price'], $_POST['description']) &&  !empty($_POST['brand']) && !empty($_POST['model']) && !empty($_POST['price'])) {
                foreach ($_POST as $key => $value) {
                    $vehicle_mod[$key] = sanitizeStr($value);
                }
                $vehicle_mod['price'] = (int) $vehicle_mod['price'];
                $update_message = '';
                // rehydrates the object before sending it in VehicleManager updateVehicle
                if (strlen($vehicle_mod['brand']) <= 25 && strlen($vehicle_mod['model']) <= 30 && is_numeric($vehicle_post['price'])) {
                    $vehicle->hydrate($vehicle_mod);
                    $manager->updateVehicle($vehicle);
                    $update_message = 'Vehcle data has been updated.';
                } else {
                  $update_message = 'At least one field wasn\'t correctly filled. Try again.';
                }
            }
        }

        // creates the modify vehicle form
        $form_modify = new Form('modify_vehicle');
        $form_modify->addInputText('brand', 'col-9', $vehicle->getBrand(), 'Max 25 characters');
        $form_modify->addInputText('model', 'col-9', $vehicle->getModel(), 'Max 30 characters');
        $form_modify->addInputText('price', 'col-9', $vehicle->getPrice(), 'Ex : 25000');
        $form_modify->addTextarea('description', 'col-9', $vehicle->getDescription());
        $form_modify->addInputSubmit('modify', 'btn btn-primary mx-auto col-4', 'Modify');

        // delete form
        $form_delete = new Form('', ['home']);
        $form_delete->addHidden('id_vehicle', $vehicle->getId());
        $form_delete->addInputSubmit('delete', 'btn btn-danger', '<i class="material-icons">delete_sweep</i>');

        require '../view/vehicle_v.php';
    } else {
        header('Location: home.php');
    }
} else {
    header('Location: home.php');
}
