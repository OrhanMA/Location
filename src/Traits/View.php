<?php

trait View
{
  public function renderView($viewPath, $data = [])
  {
    // viewPath prend le nom de la vue. Pour home par exemple on passe 'home' mais pour la page index des véhicules on passer vehicules/index
    // pas besoin de .php la concatenation se fera avec realpath qui va concatener le chemin + nom fichier + extension

    // récup le chemin du fichier
    $viewFilePath = $this->getViewFilePath($viewPath);


    // vérifie que le fichier existe et soit lisible
    if ($viewFilePath === false || !is_readable($viewFilePath)) {
      throw new InvalidArgumentException("View file '$viewPath' not found or not readable.");
    }

    // enregistre le contenu des echos, print... dans un buffer (mémoire temporaire) avant de l'envoyer au navigateur
    // ici je vais enregistrer dans le buffer la vue ainsi que les données que je veux passer. 
    ob_start();

    // extrait les données du tableau $data et crée des variable avec pour qu'elles soient manipulables dans la vue. Si je $data = ['user'=> 'test'] extract($data) va le transformer en $user = 'test ...
    extract($data);

    // require de la vue... Les données contenues dans $data sont passées à la vue
    require_once $viewFilePath;

    // stop le buffer et retourne son contenu qui est composé de tout ce qui est après ob_start()
    $output = ob_get_clean();

    // $output contient la vue récupérée et les données de $data rendus + faciles à manipuler
    return $output;
  }

  private function getViewFilePath($viewPath)
  {
    $viewsDirectory = __DIR__ . '/../Views/';
    $viewFilePath = realpath($viewsDirectory . $viewPath . '.php');
    return $viewFilePath;
  }
}
