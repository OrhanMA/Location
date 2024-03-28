<?php

trait FormValidation
{
  /**
   * Redirige vers une page si un champ du formulaire n'est pas set, est vide, ou n'est pas valide contre son regex attitré
   * @param $fields: la liste des champs du formulaire: tableau associatif ex: 'first_name' => regex
   */
  public function validate_form_fields($fields, $redirect_view)
  {
    foreach ($fields as $field_name => $regex) {
      if (!isset($_POST[$field_name]) || empty($_POST[$field_name])) {
        $message = ucfirst($field_name) . ' est requis.';
        echo $this->renderView($redirect_view, ['message' => $message]);
        exit();
      }

      if (!preg_match($regex, htmlspecialchars($_POST[$field_name]))) {
        $message = ucfirst($field_name) . ' est invalide.';
        echo $this->renderView($redirect_view, ['message' => $message]);
        exit();
      }
    }
  }
}
