<?

class EmailNotificationObserver implements ObserverInterface
{
    public function update($serviceName, $isOnline)
    {
        if (!$isOnline)
        {
            error_log ('E-mail notification: The service ' . $serviceName . ' is offline.' . PHP_EOL);
        }
    }
}
