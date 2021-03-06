<?php
class Form {
  protected $form;

// depending on sent parameters changes the action of the form
  public function __construct($cssclasses='', array $action=[])
  {
    $formaction = '';
    if(count($action) == 1) {
      $formaction = $action[0].'.php';
    }
    elseif(count($action) == 2) {
      $formaction = $action[0].'.php?id='.$action[1];
    }

    $this->form = '<form method="post" action="'.$formaction.'" class="'.$cssclasses.'">';
  }

  /**
  * Get the value of Form
  *
  * @return mixed
  */
  public function getForm()
  {
    return $this->form;
  }

// adds an input text or submit
  public function addInputText($name, $cssclasses='', $value='', $placeholder='')
  {
    $this->form .= '<div class="newVehicleFormDiv">';
    $this->form .= '<label for="'.$name.'" class="col-9 col-md-3">'.ucfirst($name).' : </label>';
    $this->form .= '<input type="text" id="'.$name.'" name ="'.$name.'" value="'.$value.'" class="'.$cssclasses.'" placeholder="'.$placeholder.'" required>';
    $this->form .= '</div>';
  }

// adds a select + options
  public function addSelect($name, array $options, $cssclasses='')
  {
    $this->form .= '<div class="newVehicleFormDiv"><label for="'.$name.'" class="col-3">'.ucfirst($name).' : </label><select id="'.$name.'" name="'.$name.'" class="'.$cssclasses.'">';
    foreach ($options as $option) {
      $this->form .= '<option value="'.$option.'">'.ucfirst($option).'</option>';
    }
    $this->form .= '</select></label></div>';
  }

// adds checkboxes with labels
  public function addCheckboxes(array $checkboxes, array $checked)
  {
    $this->form .= '<div class="row col-6 justify-content-start checkboxes">';
    foreach ($checkboxes as $value) {
      $ischecked = in_array($value, $checked) ? 'checked' : '';
      $this->form .= '<label for="'.$value.'" class="col-9 col-md-2 offset-md-1">'.$value.'</label><input id="'.$value.'" type="checkbox" name="'.$value.'" value="'.$value.'" '.$ischecked.'>';
    }
    $this->form .= '</div>';
  }

// adds a textarea
  public function addTextarea($name, $cssclasses='', $value='')
  {
    $this->form .= '<div class="newVehicleFormDiv"><label for="'.$name.'" class="col-9 col-md-3">'.ucfirst($name).' : </label><textarea id="'.$name.'" name="'.$name.'" class="'.$cssclasses.'">'.$value.'</textarea></div>';
  }

// adds a hidden input
  public function addHidden($name, $value)
  {
    $this->form .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
  }

// adds a submit button and closes the form
  public function addInputSubmit($name, $cssclasses='', $value='')
  {
    $this->form .= '<button type="submit" class="'.$cssclasses.'" name="'.$name.'" title="'.ucfirst($name).'">'.$value.'</button>';
    $this->form .= '</form>';
  }

}


 ?>
