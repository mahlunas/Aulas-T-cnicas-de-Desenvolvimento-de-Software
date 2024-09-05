<?php

class Autoload
{
    static public function loadModels($className)
    {
      $pathToFile = ROOT_PATH . '/src/model/' . $className . '.php';

      if (file_exists($pathToFile))
        require $pathToFile;
    }

    static public function loadControllers($className)
    {
      $pathToFile = ROOT_PATH . '/src/controller/' . $className . '.php';

      if (file_exists($pathToFile))
        require $pathToFile;
    }

    static public function loadSystems($className)
    {
      $pathToFile = ROOT_PATH . '/system/' . $className . '.php';

      if (file_exists($pathToFile))
        require $pathToFile;
    }
}

spl_autoload_register('Autoload::loadSystems');
spl_autoload_register('Autoload::loadModels');
spl_autoload_register('Autoload::loadControllers');
