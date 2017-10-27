<div class="mod_card">
  <div>
    <h2>Modify this <?php echo $vehicule->getType(); ?></h2>
    <p>License plate : <?php echo $vehicule->getLicense_plate(); ?></p>
    <?php
    echo $form_modify->getForm(); ?>
  </div>
  <div class="del_div">
    <?php
    echo $form_delete->getForm();
    require '../view/template/foot.php';

    ?>
  </div>
</div>
