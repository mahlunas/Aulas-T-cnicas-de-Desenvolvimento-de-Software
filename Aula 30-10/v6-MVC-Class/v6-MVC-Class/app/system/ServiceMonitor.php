<?php

class ServiceMonitor
{
    private $services = [];

    private $observers = [];

    static private $instance = FALSE;

    private final function __construct ()
	{
        $this->load ();
	}

    static public function singleton ()
	{
		if (self::$instance !== FALSE)
			return self::$instance;

		$class = __CLASS__;

		self::$instance = new $class ();

		return self::$instance;
	}

    public function load ()
	{
		if (isset ($_SESSION['SERVICE_MONITOR_SERVICES']))
			$this->services = unserialize ($_SESSION['SERVICE_MONITOR_SERVICES']);
        if (isset ($_SESSION['SERVICE_MONITOR_SERVICES']))
			$this->observers = unserialize ($_SESSION['SERVICE_MONITOR_OBSERVERS']);
	}
    public function destroy()
    {
        unset ($_SESSION['SERVICE_MONITOR_SERVICES']);
        unset ($_SESSION['SERVICE_MONITOR_OBSERVERS']);
    }

    public function save ()
	{
		$_SESSION['SERVICE_MONITOR_SERVICES'] = serialize ($this->services);
        $_SESSION['SERVICE_MONITOR_OBSERVERS'] = serialize ($this->observers);
	}

    public function addService($serviceName) {
        $this->services[$serviceName] = true; // Inicialmente, todos os serviços são considerados online
    }

    public function addObserver(ObserverInterface $observer) {
        $this->observers[] = $observer;
    }

    public function markServiceAsOffline($serviceName) {
        if (isset($this->services[$serviceName]) && $this->services[$serviceName] === true) {
            $this->services[$serviceName] = false;
            $this->notifyObservers($serviceName);
        }
    }

    private function notifyObservers($serviceName) {
        foreach ($this->observers as $observer) {
            $observer->update($serviceName, $this->services[$serviceName]);
        }
    }

    public static function isURLAvailable($url) 
    {
        return TRUE;
    }
}
