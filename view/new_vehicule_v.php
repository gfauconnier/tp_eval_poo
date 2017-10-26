<?php
require '../view/template/head.php';
require '../view/template/header.php';
if (isset($message)) {
  echo $message;
}
echo $form_new->getForm();
