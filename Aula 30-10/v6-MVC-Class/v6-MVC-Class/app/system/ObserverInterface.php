<?php

interface ObserverInterface {
    public function update($serviceName, $isOnline);
}
