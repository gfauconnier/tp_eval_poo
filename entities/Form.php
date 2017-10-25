<?php
class Form {
  protected $form;

  public function __construct()
  {
    $this->form = '<form method="post" action="">';
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

  public function addInput($type, $name, $value='')
  {
    if($type == 'text') {
      $this->form .= '<label for="'.$name.'">'.ucfirst($name).'</label>';
    }
    $this->form .= '<input type="'.$type.'" id="'.$name.'" name ="'.$name.'" value="'.$value.'">';
    if ($type == 'submit') {
      $this->form .= '</form>';
    }
  }

  public function addSelect($name, array $options)
  {
    $this->form .= '<label for="'.$name.'"></label><select id="'.$name.'" name="'.$name.'">';
    foreach ($options as $option) {
      $this->form .= '<option value="'.$option.'">'.ucfirst($option).'</option>';
    }
    $this->form .= '</select>';
  }

  public function addTextarea($name)
  {
    $form .= '<textarea name="'.$name.'">';
  }

}


 ?>
