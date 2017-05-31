<?php
	require_once __DIR__ . '/vendor/autoload.php';
	use PhpAmqpLib\Connection\AMQPStreamConnection;
	use PhpAmqpLib\Message\AMQPMessage;

	if( $_GET["data"] )
  	{
     		echo "You want to send message : ". $_GET['data']. "<br />";
		$data=$_GET["data"];      

  	}

	
	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
	$channel = $connection->channel();
	$channel->queue_declare('hello', false, false, false, false);
	#$msg = new AMQPMessage('Hello World!');
	

	$msg = new AMQPMessage("$data");
	
	#$msg = $imes;
	
	$channel->basic_publish($msg, '', 'hello');
	
	#echo " [x] Sent 'Hello World!'\n";
	echo $msg->body;
	
	$channel->close();
	$connection->close();
?>

