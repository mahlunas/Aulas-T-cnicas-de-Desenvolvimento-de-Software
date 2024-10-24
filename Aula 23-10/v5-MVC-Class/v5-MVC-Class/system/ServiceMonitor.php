<?php

class ServiceMonitor{
    private $services = [];
    private $observers = [];

    static private $instance = FALSE;

    private final function __construct(){
        $this->load();
    }

    public function load(){
        if(isset($_SESSION['SERVICE_MONITOR_SERVICES']))
            $this->services = unserialize ($_SESSION['SERVICE_MONITOR_SERVICES']);

        if(isset($_SESSION['SERVICE_MONITOR_OBSERVERS']))
            $this->services = unserialize ($_SESSION['SERVICE_MONITOR_OBSERVERS']);
    }

    public function destroy(){
        unset($_SESSION['SERVICE_MONITOR_SERVICES']);
        unset($_SESSION['SERVICE_MONITOR_OBSERVERS']);
    }

    public function save(){
        $_SESSION['SERVICE_MONITOR_SERVICES'] = serialize ($this->services);
        $_SESSION['SERVICE_MONITOR_OBSERVERS'] = serialize ($this->observers);
    }

    static public function singleton ()
	{
		if (self::$instance !== FALSE)
			return self::$instance;

		$class = __CLASS__;

		self::$instance = new $class ();

		return self::$instance;
	}

    public function addService($serviceName){
        $this->services[$serviceName] = TRUE;
    }

    public function addObsever(ObserverInterface $observer){
        $this->observers[] = $observers;
    }

    public function markServiceAsOffline($serviceName){
        if((isset($this->services[$serviceName]))
            && $this->services [$serviceName] == TRUE){
                $this->services
        }
    }

    public function notifyObservers($serviceName){
        foreach($this->observers as $observer){
            $observer->update()
        }
    }

    public static function isURLAvailable($url){
        $content  = @file_get_contents ($url);

        return $content !== FALSE;
    }
}