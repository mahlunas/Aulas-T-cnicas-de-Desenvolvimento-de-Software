<?php

require 'controller/homeController.php';
require 'model/User.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new homeController();
$controller->{$action}();