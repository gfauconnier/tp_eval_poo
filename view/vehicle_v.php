<main>
  <?php
  if (isset($update_message) && $message!='') {
    echo '<p>'.$update_message.'</p>';
  }
   ?>
  <div class="mod_card">
    <div class="vehicle_details col-10 col-lg-11">
      <h2>Modify this <?php echo $vehicle->getType(); ?></h2>
      <p>License plate : <?php echo $vehicle->getLicense_plate(); ?></p>
      <?php
      echo $form_modify->getForm(); ?>
    </div>
    <div class="del_div col-2 col-lg-1 justify-content-end">
      <?php
      echo $form_delete->getForm();
      require '../view/template/foot.php';

      ?>
    </div>
  </div>

</main>
