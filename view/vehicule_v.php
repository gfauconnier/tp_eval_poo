<div class="mod_card">
  <div class="vehicule_details col-10 col-lg-11">
    <h2>Modify this <?php echo $vehicule->getType(); ?></h2>
    <p>License plate : <?php echo $vehicule->getLicense_plate(); ?></p>
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
