<?php
require '../view/template/head.php';
require '../view/template/header.php';
if (isset($message)) {
  echo $message;
}
?>
<div class="container collapse" id="collapseNewVehicle">
<?php
  echo $form_new->getForm();
?>
</div>
