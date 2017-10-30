<main>

    <div class="sort_type">
      <?php
      echo $form_check->getForm();
      ?>
    </div>
    <table id="vehiclesTable">
      <thead>
        <tr>
          <th>Type</th><th>License Plate</th><th>Brand</th><th>Model</th><th>Price</th><th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($vehicles as $vehicle) { ?>
          <!-- <a href="vehicle.php?id="> -->
          <tr class="container" id="<?php echo $vehicle->getId(); ?>" title="Show details">
            <td><?php echo $vehicle->getType(); ?></td>
            <td><?php echo $vehicle->getLicense_plate(); ?></td>
            <td><?php echo $vehicle->getBrand(); ?></td>
            <td><?php echo $vehicle->getModel(); ?></td>
            <td><?php echo $vehicle->getPrice(); ?></td>
            <td class="row buttons_td">
              <a href="vehicle.php?id=<?php echo $vehicle->getId(); ?>" class="btn btn-primary"><i class="material-icons">create</i></a>
              <?php
              $form_delete = new Form('', ['home']);
              $form_delete->addHidden('id_vehicle', $vehicle->getId());
              $form_delete->addInputSubmit('delete', 'btn btn-danger', '<i class="material-icons">delete_sweep</i>');
              echo $form_delete->getForm();
              ?>
            </td>
          </tr>
          <!-- </a> -->
        <?php }
        ?>
      </tbody>
    </table>
    
  </main>

<?php
require '../view/template/foot.php';
