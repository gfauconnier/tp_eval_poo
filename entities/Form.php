<?php
class Form {
  protected $form;

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
  public function addInput($type, $name, $cssclasses='', $value='')
  {
    $required = '';
    if($type == 'text') {
      $this->form .= '<label for="'.$name.'">'.ucfirst($name).'</label>';
      $required = 'required';
    }
    $this->form .= '<input type="'.$type.'" id="'.$name.'" name ="'.$name.'" value="'.$value.'" class="'.$cssclasses.'" '.$required.'>';
    if ($type == 'submit') {
      $this->form .= '</form>';
    }
  }

// adds a select + options
  public function addSelect($name, array $options, $cssclasses='')
  {
    $this->form .= '<label for="'.$name.'"></label><select id="'.$name.'" name="'.$name.'" class="'.$cssclasses.'">';
    foreach ($options as $option) {
      $this->form .= '<option value="'.$option.'">'.ucfirst($option).'</option>';
    }
    $this->form .= '</select>';
  }

// adds checkboxes with labels
  public function addCheckboxes(array $checkboxes, array $checked)
  {
    foreach ($checkboxes as $value) {
      $ischecked = in_array($value, $checked) ? 'checked' : '';
      $this->form .= '<input type="checkbox" name="'.$value.'" value="'.$value.'" '.$ischecked.'>'.$value;
    }
  }

// adds a textarea
  public function addTextarea($name, $cssclasses='', $value='')
  {
    $this->form .= '<label for="'.$name.'">Description : </label><textarea id="'.$name.'" name="'.$name.'" class="'.$cssclasses.'">'.$value.'</textarea>';
  }

// adds a hidden input
  public function addHidden($name, $value)
  {
    $this->form .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
  }

}


 ?>
