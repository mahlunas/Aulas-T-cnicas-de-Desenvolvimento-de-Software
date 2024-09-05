<?php

    class AppConfig{
        private static $instance = null;
        private $config = [];

        // Construtor privado: Este método deve carregar as configurações iniciais da aplicação.
        private function __construct() {
            $this->config=[
                'nomeApp' => 'Simulado',
                'version' => '1.0',
                'host' => 'localhost',
                'sgbd' => 'MySQL',
                'log' => 'C:\xampp\htdocs\Aula 04\v2-Released\system\AppConfig.php'
            ];
            
        }

        // Método estático getInstance: Este método deve garantir que apenas uma instância da classe seja criada.
        public static function getInstance() {
            if(self::$instance !==null){
                return self::$instance;
            }

            $class = __CLASS__;

            self::$instance = new $class();

            return self::$instance;
        }

        // Método get: Este método deve retornar o valor de uma chave específica de configuração.
        public function get($key) {
            if(array_key_exists ($key, $this->config))
                return $this->config [$key];

            return '';
        }

        // Método set: Este método deve permitir que os valores de configuração sejam atualizados.
        public function set($key, $value) {
            if(array_key_exists($key, $this->config))
                $this->config [$key] = $value;
        }
    }

?>