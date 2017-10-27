<div class="sort_type">
  <?php
  echo $form_check->getForm();
  ?>
</div>
<table>
  <thead>
    <tr>
      <th>Type</th><th>License Plate</th><th>Brand</th><th>Model</th><th>Price</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($vehicules as $vehicule) { ?>
  <tr class="container">
    <td><?php echo $vehicule->getType(); ?></td>
    <td><?php echo $vehicule->getLicense_plate(); ?></td>
    <td><?php echo $vehicule->getBrand(); ?></td>
    <td><?php echo $vehicule->getModel(); ?></td>
    <td><?php echo $vehicule->getPrice(); ?></td>
    <td class="row buttons_td">
      <a href="vehicule.php?id=<?php echo $vehicule->getId(); ?>" class="btn btn-primary">Details</a>
      <?php
      $form_delete = new Form('', ['home']);
      $form_delete->addHidden('id_vehicule', $vehicule->getId());
      $form_delete->addInput('submit', 'delete', 'btn btn-danger', 'Delete');
      echo $form_delete->getForm();
       ?>
    </td>
  </tr>
<?php }
 ?>
  </tbody>
</table>

<?php
require '../view/template/foot.php';
