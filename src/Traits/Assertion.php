<?php

trait Assertion
{
  /**
   * Vérifie qu'une valeur est set et n'est pas vide
   * @param $value la valeur a vérifier
   * @return true si la valeur est set et n'est pas vide
   * @return false si la valeur n'est pas set ou est vide
   */
  public function sne($value)
  {
    return isset($value) && !empty($value);
  }

  /**
   * Vérifie si une valeur est vide ou n'est pas set
   * @param $value la valeur a vérifier
   * @return true si la valeur est n'est pas set et ou est vide
   * @return false si la valeur est set et n'est pas vide
   */
  public function not_se($value)
  {
    return !isset($value) || empty($value);
  }
}
