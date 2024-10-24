<?php


class ControllerFactory {

    private $factories = [];

    public function __construct()
    {
        $this->loadFactoryList();
    }

    public function loadFactoryList() : void
    {
        $config = include ROOT_PATH . '/config/config.php';
        $this->factories = $config ['factories'];
    }

    public function __invoke ($type)
    {
        $factoryClass = array_key_exists ($type . 'ControllerFactory', $this->factories) ? $this->factories[$type . 'ControllerFactory'] : '';

        if (class_exists ($factoryClass))
        {
            $factory = new $factoryClass();

            if (!$factory instanceof FactoryInterface)
                throw new Exception ('Bad interface.');

            return $factory ();
        }

        throw new Exception ('Factory not found.');
    }
}
?>
