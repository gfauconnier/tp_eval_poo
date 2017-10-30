<?php
require '../view/template/head.php';
require '../view/template/header.php';
?>
<div class="container collapse" id="collapseNewVehicle">
<?php
  echo $form_new->getForm();
?>
</div>
<?php
if (isset($message) && $message!='') {
  echo '<p>'.$message.'</p>';
}
 ?>
