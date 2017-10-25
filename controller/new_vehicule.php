<?php

$form_new = new Form();
$form_new->addSelect('type', ['Voiture', 'Moto', 'Camion']);
$form_new->addInput('text', 'immatriculation');
$form_new->addInput('text', 'marque');
$form_new->addInput('text', 'modele');
$form_new->addInput('text', 'prix');
$form_new->addInput('submit', 'creer', 'Créer');

require '../view/new_vehicule_v.php';
