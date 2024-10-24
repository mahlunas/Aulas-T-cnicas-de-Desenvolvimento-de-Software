<?php

$message = Message::singleton();

if ($message->has ())
{
	while ($msg = $message->get ()) echo $msg;

	$message->clear ();
}
