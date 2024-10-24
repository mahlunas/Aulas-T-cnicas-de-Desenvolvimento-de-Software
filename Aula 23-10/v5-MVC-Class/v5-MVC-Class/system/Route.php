<?php


class Route {

  const VIEW_PATH = ROOT_PATH . '/src/view/';

  const VIEW_PARTIAL_PATH = ROOT_PATH . '/src/view/partial/';

  const VIEW_APPLICATION_PATH = ROOT_PATH . '/src/view/application/';

  static public function route (array $route)
  {
    return self::VIEW_APPLICATION_PATH . $route ['module'] . '/' . $route ['action'] . '.php';
  }
}
 ?>
