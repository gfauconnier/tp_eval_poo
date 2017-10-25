<?php

echo $form_check->getForm();
?>
<table>
  <thead>
    <tr>
      <th>Type</th><th>License Plate</th><th>Brand</th><th>Model</th><th>Price</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($vehicules as $vehicule) { ?>
  <tr>
    <td><?php echo $vehicule->getType(); ?></td>
    <td><?php echo $vehicule->getLicense_plate(); ?></td>
    <td><?php echo $vehicule->getBrand(); ?></td>
    <td><?php echo $vehicule->getModel(); ?></td>
    <td><?php echo $vehicule->getPrice(); ?></td>
  </tr>
<?php }
 ?>
  </tbody>
</table>
